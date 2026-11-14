/* WebAcademy — exécution JavaScript isolée dans un iframe sandbox.
   API : WA.runner.run({ code, tests, html, css, timeout, settle }) → Promise
   - aucun eval() : le code est injecté via un <script> créé dans l'iframe ;
   - sandbox="allow-scripts" sans allow-same-origin : pas d'accès à la session,
     au DOM parent, aux cookies ni aux données de l'application ;
   - la CSP du parent (connect-src 'self') limite les appels réseau ;
   - le timer parent couvre les attentes asynchrones ; une boucle synchrone peut bloquer le navigateur. */
WA.runner = (function () {
    let seq = 0;

    const HARNESS = [
        '(function () {',
        '  var TOKEN = "__TOKEN__";',
        '  var logs = [];',
        '  var results = [];',
        '  function fmt(v) {',
        '    if (typeof v === "string") return v;',
        '    if (v instanceof Error) return v.name + ": " + v.message;',
        '    try { return JSON.stringify(v); } catch (e) { return String(v); }',
        '  }',
        '  function post(type, payload) {',
        '    var msg = Object.assign({ __waRunner: TOKEN, type: type }, payload || {});',
        '    try { parent.postMessage(msg, "*"); } catch (e) { /* parent absent */ }',
        '  }',
        '  ["log", "info", "warn", "error"].forEach(function (kind) {',
        '    var original = console[kind];',
        '    console[kind] = function () {',
        '      var parts = [];',
        '      for (var i = 0; i < arguments.length; i++) parts.push(fmt(arguments[i]));',
        '      logs.push((kind === "log" ? "" : kind.toUpperCase() + " ") + parts.join(" "));',
        '      if (original) { try { original.apply(console, arguments); } catch (e) {} }',
        '    };',
        '  });',
        '  window.addEventListener("error", function (e) {',
        '    post("runtime-error", { error: (e.message || "Erreur JavaScript") + (e.lineno ? " (ligne " + e.lineno + ")" : "") });',
        '  });',
        '  window.addEventListener("unhandledrejection", function (e) {',
        '    var reason = e.reason && (e.reason.message || e.reason);',
        '    post("runtime-error", { error: "Promesse rejetée : " + fmt(reason) });',
        '  });',
        '  window.__waTest = function (index, fn, detail) {',
        '    try { results.push({ index: index, ok: !!fn(), detail: detail || "" }); }',
        '    catch (e) { results.push({ index: index, ok: false, detail: (detail || "") + " — " + e.message }); }',
        '  };',
        '  window.__waAsyncTest = async function (index, fn, detail) {',
        '    try { results.push({ index: index, ok: !!(await fn()), detail: detail || "" }); }',
        '    catch (e) { results.push({ index: index, ok: false, detail: (detail || "") + " — " + e.message }); }',
        '  };',
        '  window.__waFail = function (e) { post("runtime-error", { error: String(e && e.message ? e.message : e) }); };',
        '  window.__waLogs = logs;',
        '  window.__waFinish = function () { post("results", { results: results, output: logs.join("\\n") }); };',
        '  window.addEventListener("message", function (ev) {',
        '    var data = ev.data || {};',
        '    if (data.__waRunner !== TOKEN || data.cmd !== "run") return;',
        '    post("started", {});',
        '    try {',
        '      var script = document.createElement("script");',
        '      script.textContent = "(async function () {\\n" + data.code + "\\n" + (data.testCode || "") + "\\n})().catch(function (e) { window.__waFail(e); });";',
        '      document.body.appendChild(script);',
        '    } catch (e) {',
        '      post("runtime-error", { error: "Impossible de lancer le script : " + e.message });',
        '      post("results", { results: results, output: logs.join("\\n") });',
        '      return;',
        '    }',
        '    setTimeout(function () { post("done", { output: logs.join("\\n") }); }, data.settle || 120);',
        '  });',
        '  post("ready", {});',
        '})();'
    ].join('\n');

    function buildTestCode(tests) {
        const lines = [];
        (tests || []).forEach((test, index) => {
            const detail = JSON.stringify(test.detail || test.message || '');
            switch (test.type) {
                case 'js_expr':
                case 'js_dom':
                    lines.push('__waTest(' + index + ', function () { return !!( ' + test.value + ' ); }, ' + detail + ');');
                    break;
                case 'js_not_expr':
                    lines.push('__waTest(' + index + ', function () { return !( ' + test.value + ' ); }, ' + detail + ');');
                    break;
                case 'js_async_expr':
                    lines.push('await __waAsyncTest(' + index + ', async function () { return !!( ' + test.value + ' ); }, ' + detail + ');');
                    break;
                case 'js_output_contains': {
                    const needle = JSON.stringify(String(test.value).toLowerCase());
                    lines.push('__waTest(' + index + ', function () { return (window.__waLogs || []).join("\\n").toLowerCase().indexOf(' + needle + ') !== -1; }, ' + detail + ');');
                    break;
                }
                case 'js_output_not_contains': {
                    const needle = JSON.stringify(String(test.value).toLowerCase());
                    lines.push('__waTest(' + index + ', function () { return (window.__waLogs || []).join("\\n").toLowerCase().indexOf(' + needle + ') === -1; }, ' + detail + ');');
                    break;
                }
                case 'js_output_equals': {
                    const want = JSON.stringify(String(test.value).replace(/\s+/g, ' ').trim().toLowerCase());
                    lines.push('__waTest(' + index + ', function () { return (window.__waLogs || []).join("\\n").replace(/\\s+/g, " ").trim().toLowerCase() === ' + want + '; }, ' + detail + ');');
                    break;
                }
                default:
                    lines.push('__waTest(' + index + ', function () { throw new Error("type de test inconnu : ' + String(test.type || '').replace(/"/g, '') + '"); }, ' + detail + ');');
            }
        });
        lines.push('__waFinish();');
        return lines.join('\n');
    }

    function run(opts) {
        opts = opts || {};
        const code = String(opts.code || '');
        const tests = Array.isArray(opts.tests) ? opts.tests : [];
        const token = 'wa' + (++seq) + '_' + Math.random().toString(36).slice(2);
        const timeout = Math.max(800, Math.min(8000, Number(opts.timeout) || 4000));
        const settle = Math.max(60, Math.min(1500, Number(opts.settle) || 180));
        const html = String(opts.html || '');
        const css = String(opts.css || '');

        return new Promise(resolve => {
            let finished = false;
            let runtimeError = '';
            let results = [];
            let output = '';
            let timer = null;

            const frame = document.createElement('iframe');
            frame.setAttribute('sandbox', 'allow-scripts');
            frame.setAttribute('title', opts.title || 'Exécution JavaScript isolée');
            frame.style.cssText = 'position:fixed;width:1px;height:1px;left:-9999px;top:0;border:0;opacity:0;';
            frame.srcdoc = '<!DOCTYPE html><html lang="fr"><head><meta charset="utf-8">'
                + '<style>html,body{background:#fff;color:#111;font-family:system-ui,sans-serif}'
                + css.replace(/<\/style/gi, '<\\/style')
                + '</style></head><body>' + html + '<script>' + HARNESS.replace('__TOKEN__', token) + '<\/script></body></html>';

            function cleanup() {
                if (timer) clearTimeout(timer);
                window.removeEventListener('message', onMessage);
                if (frame.parentNode) frame.parentNode.removeChild(frame);
            }

            function finish(extra) {
                if (finished) return;
                finished = true;
                cleanup();
                resolve(Object.assign({
                    ok: !runtimeError && results.length === tests.length && results.every(r => r.ok),
                    output: extra && extra.output != null ? extra.output : output,
                    error: runtimeError,
                    results: results,
                    timedOut: false
                }, extra || {}));
            }

            function onMessage(ev) {
                const data = ev.data || {};
                if (ev.source !== frame.contentWindow || data.__waRunner !== token) return;
                if (data.type === 'ready') {
                    frame.contentWindow.postMessage({
                        __waRunner: token,
                        cmd: 'run',
                        code: code,
                        testCode: buildTestCode(tests),
                        settle: settle
                    }, '*');
                } else if (data.type === 'runtime-error') {
                    runtimeError = String(data.error || 'Erreur JavaScript');
                } else if (data.type === 'results') {
                    results = Array.isArray(data.results) ? data.results : [];
                    output = String(data.output || output || '');
                    if (results.length === tests.length) finish();
                } else if (data.type === 'done') {
                    output = String(data.output || output || '');
                    // Laisse une courte fenêtre aux tests asynchrones pour répondre.
                    // Completion is reported by __waFinish after student code and tests.
                }
            }

            window.addEventListener('message', onMessage);
            document.body.appendChild(frame);

            timer = setTimeout(() => {
                if (finished) return;
                finished = true;
                cleanup();
                resolve({
                    ok: false,
                    output: output,
                    error: 'Délai dépassé (' + Math.round(timeout / 1000) + ' s). Le code contient peut-être une boucle infinie.',
                    results: results,
                    timedOut: true
                });
            }, timeout);
        });
    }

    return { run };
})();
