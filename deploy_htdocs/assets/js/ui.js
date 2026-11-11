/* WebAcademy — helpers UI : DOM, coloration, icônes, toasts, dialogues. */
WA.ui = (function () {

    /** Créateur DOM concis : h('div.foo#bar', {}, children…). */
    function h(spec, attrs, ...children) {
        if (typeof spec !== 'string' || spec === '') spec = 'div';
        const m = /^([a-zA-Z][\w-]*)?(#[\w-]+)?((?:\.[\w-]+)*)$/.exec(spec);
        let name = 'div', id = null, classes = [];
        if (m) {
            name = m[1] || 'div';
            id = m[2] ? m[2].slice(1) : null;
            classes = (m[3] || '').split('.').filter(Boolean);
        } else {
            name = spec.split(/[.#]/, 1)[0] || 'div';
        }
        const el = document.createElement(name);
        if (id) el.id = id;
        if (classes.length) el.className = classes.join(' ');
        if (attrs) {
            for (const [k, v] of Object.entries(attrs)) {
                if (v == null || v === false) continue;
                if (k === 'class') el.className = el.className ? el.className + ' ' + v : v;
                else if (k === 'html') el.innerHTML = v;
                else if (k === 'text') el.textContent = v;
                else if (k === 'dataset') Object.assign(el.dataset, v);
                else if (k === 'style' && typeof v === 'object') Object.assign(el.style, v);
                else if (k.startsWith('on') && typeof v === 'function') el.addEventListener(k.slice(2).toLowerCase(), v);
                else if (v === true) el.setAttribute(k, '');
                else el.setAttribute(k, String(v));
            }
        }
        append(el, children);
        return el;
    }

    function append(el, children) {
        for (const c of children.flat(9)) {
            if (c == null || c === false || c === '') continue;
            el.append(typeof c === 'object' ? c : document.createTextNode(String(c)));
        }
    }

    /** Échappe une chaîne pour insertion HTML. */
    function esc(s) {
        return String(s == null ? '' : s)
            .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;').replace(/'/g, '&#39;');
    }

    function debounce(fn, ms) {
        let t = null;
        return function (...args) {
            clearTimeout(t);
            t = setTimeout(() => fn.apply(this, args), ms);
        };
    }

    function formatDate(value) {
        if (!value) return '';
        const d = new Date(String(value).replace(' ', 'T') + (String(value).includes('T') ? '' : 'Z'));
        if (Number.isNaN(d.getTime())) return String(value).slice(0, 10);
        return new Intl.DateTimeFormat('fr-FR', { day: '2-digit', month: 'short', year: 'numeric' }).format(d);
    }

    /* ------------------------------------------------------------ toast */
    let toastTimer = null;
    function toast(message, kind) {
        let el = document.getElementById('wa-toast');
        if (!el) {
            el = h('div#wa-toast.wa-toast', { role: 'status', 'aria-live': 'polite' });
            document.body.appendChild(el);
        }
        el.textContent = String(message == null ? '' : message);
        el.className = 'wa-toast' + (kind ? ' ' + kind : '');
        // Force le navigateur à repartir de l'état masqué pour rejouer l'entrée.
        void el.offsetWidth;
        el.classList.add('show');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(() => el.classList.remove('show'), 3200);
    }

    /* ------------------------------------------------------------ coloration */
    const PHP_KW = /\b(?:abstract|array|as|bool|break|callable|case|catch|class|clone|const|continue|declare|default|die|do|echo|else|elseif|empty|endforeach|endif|endswitch|endwhile|enum|extends|final|finally|fn|for|foreach|function|global|if|implements|include|include_once|instanceof|interface|isset|match|namespace|new|null|private|protected|public|readonly|require|require_once|return|static|switch|throw|trait|try|unset|use|var|while|yield)\b/gi;
    const SQL_KW = /\b(?:SELECT|FROM|WHERE|INSERT|INTO|VALUES|UPDATE|SET|DELETE|CREATE|TABLE|DATABASE|DROP|ALTER|ADD|COLUMN|TRUNCATE|PRIMARY|KEY|FOREIGN|REFERENCES|NOT|NULL|UNIQUE|CHECK|DEFAULT|CONSTRAINT|AND|OR|IN|BETWEEN|LIKE|IS|ORDER|BY|GROUP|HAVING|DISTINCT|JOIN|INNER|LEFT|RIGHT|FULL|OUTER|ON|AS|COUNT|SUM|AVG|MAX|MIN|LIMIT|OFFSET|COMMIT|ROLLBACK|SAVEPOINT|BEGIN|TRANSACTION|VIEW|INDEX|DESC|ASC|EXISTS|ANY|ALL|CASE|WHEN|THEN|ELSE|END|MODIFY|RENAME|SUBSTR|TRIM|WITH|RETURNING)\b/gi;
    const JS_KW = /\b(?:async|await|break|case|catch|class|const|continue|debugger|default|delete|do|else|export|extends|finally|for|from|function|get|if|import|in|instanceof|let|new|of|return|set|static|super|switch|this|throw|try|typeof|var|void|while|with|yield|true|false|null|undefined|NaN|Infinity)\b/g;
    const CPP_KW = /\b(?:alignas|alignof|auto|bool|break|case|catch|char|class|const|constexpr|continue|decltype|default|delete|do|double|else|enum|explicit|export|extern|false|float|for|friend|goto|if|inline|int|long|mutable|namespace|new|noexcept|nullptr|operator|private|protected|public|register|return|short|signed|sizeof|static|static_assert|struct|switch|template|this|throw|true|try|typedef|typename|union|unsigned|using|virtual|void|volatile|while|std|string|vector|map|list|unique_ptr|shared_ptr|weak_ptr|make_unique|make_shared|cout|cin|cerr|endl|getline|size_t)\b/g;

    function escCode(s) {
        return String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    }

    function highlight(code, lang) {
        let rules;
        const l = String(lang || '').toLowerCase();
        if (l === 'html' || l === 'xml') {
            rules = [
                [/&lt;!--[\s\S]*?--&gt;/g, 'tok-com'],
                [/&lt;\/?[a-zA-Z][\w-]*/g, 'tok-tag'],
                [/[\w-]+(?=\s*=)/g, 'tok-attr'],
                [/".*?"/g, 'tok-str']
            ];
        } else if (l === 'css') {
            rules = [
                [/\/\*[\s\S]*?\*\//g, 'tok-com'],
                [/[\w-]+(?=\s*:)/g, 'tok-attr'],
                [/:\s*[^;{}]+/g, 'tok-str']
            ];
        } else if (l === 'php') {
            rules = [
                [/\/\/[^\n]*|#[^\n]*|\/\*[\s\S]*?\*\//g, 'tok-com'],
                [/'[^'\n]*'|"[^"\n]*"/g, 'tok-str'],
                [/\$[\w]+/g, 'tok-var'],
                [PHP_KW, 'tok-kw'],
                [/\b(?:strlen|array_keys|count|in_array|preg_match|str_replace|date|file_get_contents|password_hash|var_dump|print_r|strtoupper|strtolower|ucfirst|trim|strpos|substr|sort|rsort|array_push|array_pop|array_merge|array_sum|json_encode|json_decode|htmlspecialchars|filter_var|explode|implode|sprintf|printf)(\s*\()/g, 'tok-fn']
            ];
        } else if (['sql', 'oracle', 'sqlite', 'mysql'].includes(l)) {
            rules = [
                [/--[^\n]*|\/\*[\s\S]*?\*\//g, 'tok-com'],
                [/'[^'\n]*'/g, 'tok-str'],
                [SQL_KW, 'tok-kw']
            ];
        } else if (['js', 'javascript'].includes(l)) {
            rules = [
                [/\/\/[^\n]*|\/\*[\s\S]*?\*\//g, 'tok-com'],
                [/`(?:\\[\s\S]|[^`\\])*`|'[^'\n]*'|"[^"\n]*"/g, 'tok-str'],
                [JS_KW, 'tok-kw'],
                [/\b(?:console|document|window|Math|JSON|Object|Array|String|Number|Boolean|Promise|fetch|localStorage|sessionStorage)\b/g, 'tok-var'],
                [/\b(?:log|querySelector|querySelectorAll|addEventListener|map|filter|reduce|find|forEach|push|pop|slice|splice|join|split|trim|toUpperCase|toLowerCase|parseInt|parseFloat|stringify|parse)(?=\s*\()/g, 'tok-fn']
            ];
        } else if (['cpp', 'c++', 'cxx'].includes(l)) {
            rules = [
                [/\/\/[^\n]*|\/\*[\s\S]*?\*\//g, 'tok-com'],
                [/^\s*#[a-z]+[^\n]*/gm, 'tok-attr'],
                [/'[^'\n]*'|"[^"\n]*"/g, 'tok-str'],
                [CPP_KW, 'tok-kw'],
                [/\b(?:std|string|vector|map|list|unique_ptr|shared_ptr|cout|cin|endl|size_t)\b/g, 'tok-var'],
                [/\b(?:push_back|size|begin|end|at|sort|find|insert|erase|substr|length|empty|clear|emplace_back)(?=\s*\()/g, 'tok-fn']
            ];
        } else {
            return escCode(code);
        }
        let out = '';
        const s = escCode(String(code == null ? '' : code));
        let i = 0;
        while (i < s.length) {
            let bestPos = Infinity, bestLen = 0, bestCls = '';
            for (const [re, cls] of rules) {
                re.lastIndex = i;
                const m = re.exec(s);
                if (m && m.index < bestPos) {
                    bestPos = m.index;
                    bestLen = m[0].length;
                    bestCls = cls;
                }
            }
            if (bestPos >= s.length || bestPos === Infinity) {
                out += s.slice(i);
                break;
            }
            out += s.slice(i, bestPos);
            out += '<span class="' + bestCls + '">' + s.substr(bestPos, bestLen) + '</span>';
            i = bestPos + bestLen;
        }
        return out;
    }

    const LANG_LABELS = {
        html: 'HTML', css: 'CSS', php: 'PHP', sql: 'SQL', js: 'JS', javascript: 'JavaScript',
        cpp: 'C++', 'c++': 'C++', cxx: 'C++',
        text: 'texte', bash: 'shell', json: 'JSON', oracle: 'Oracle', mysql: 'MySQL', sqlite: 'SQLite'
    };

    function copyText(value) {
        if (navigator.clipboard && navigator.clipboard.writeText) {
            return navigator.clipboard.writeText(String(value));
        }
        return new Promise((resolve, reject) => {
            const ta = document.createElement('textarea');
            ta.value = String(value);
            ta.style.position = 'fixed';
            ta.style.opacity = '0';
            document.body.appendChild(ta);
            ta.select();
            try {
                document.execCommand('copy') ? resolve() : reject(new Error('Copie impossible'));
            } catch (err) {
                reject(err);
            } finally {
                ta.remove();
            }
        });
    }

    /** Bloc de code affiché (barre langue + copier). */
    function codeBlock(code, lang, title) {
        const value = String(code == null ? '' : code);
        const btn = h('button.cp', {
            type: 'button',
            'aria-label': 'Copier le code' + (title ? ' — ' + title : ''),
            onclick: () => {
                copyText(value)
                    .then(() => toast('Code copié dans le presse-papier', 'ok'))
                    .catch(() => toast('Copie impossible dans ce navigateur', 'err'));
            }
        }, 'Copier');
        return h('div.wa-pre', {},
            h('div.bar', {},
                h('span.lang', {}, LANG_LABELS[String(lang || '').toLowerCase()] || lang || 'code'),
                title ? h('span', {}, ' · ' + title) : null,
                btn),
            h('pre', { tabindex: '0', 'aria-label': (LANG_LABELS[String(lang || '').toLowerCase()] || 'Code') + (title ? ' — ' + title : '') },
                h('code', { html: highlight(value, lang) }))
        );
    }

    function badge(kind, text) {
        return h('span.wa-badge' + (kind ? '.' + kind : '.muted'), {}, text);
    }

    function progressbar(pct, ok, label) {
        const v = Math.max(0, Math.min(100, Math.round(Number(pct) || 0)));
        return h('div.wa-progressbar' + (ok ? '.ok' : ''), {
            role: 'progressbar',
            'aria-valuemin': '0',
            'aria-valuemax': '100',
            'aria-valuenow': String(v),
            'aria-valuetext': v + ' %',
            'aria-label': label || 'Progression'
        }, h('span', { style: 'width:' + v + '%' }));
    }

    /* ------------------------------------------------------------ icônes SVG */
    const ICONS = {
        search: '<circle cx="11" cy="11" r="7"/><path d="m20 20-3.6-3.6"/>',
        menu: '<path d="M4 7h16M4 12h16M4 17h16"/>',
        sun: '<circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/>',
        moon: '<path d="M20 14.5A8.5 8.5 0 0 1 9.5 4a7 7 0 1 0 10.5 10.5Z"/>',
        check: '<path d="m5 12.5 4.5 4.5L19 7"/>',
        undo: '<path d="M4 10h9a5 5 0 0 1 0 10H8"/><path d="m8 6-4 4 4 4"/>',
        star: '<path d="m12 3.5 2.6 5.4 5.9.8-4.3 4.1 1 5.9-5.2-2.9-5.2 2.9 1-5.9L3.5 9.7l5.9-.8Z"/>',
        book: '<path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H19v16H6.5A2.5 2.5 0 0 0 4 21.5Z"/><path d="M4 18.5h15"/>',
        flask: '<path d="M9 3h6M10 3v6.2L5.4 17a2 2 0 0 0 1.7 3h9.8a2 2 0 0 0 1.7-3L14 9.2V3"/><path d="M7.5 14h9"/>',
        rocket: '<path d="M14 4c3 1 5 4 5 8l-4 4-4-4 3-8Z"/><path d="M9 12 5 16l3 3 4-4"/><circle cx="14.5" cy="9.5" r="1.3"/>',
        note: '<path d="M5 4h9l5 5v11H5z"/><path d="M14 4v5h5"/><path d="M8.5 13h7M8.5 17h4.5"/>',
        chart: '<path d="M4 20V4"/><path d="M4 20h16"/><path d="m8 16 4-4 3 3 5-6"/>',
        clock: '<circle cx="12" cy="12" r="8.5"/><path d="M12 7.5V12l3 2"/>',
        chevron: '<path d="m9 6 6 6-6 6"/>',
        arrowLeft: '<path d="M19 12H5"/><path d="m11 6-6 6 6 6"/>',
        arrowRight: '<path d="M5 12h14"/><path d="m13 6 6 6-6 6"/>',
        arrowUp: '<path d="M12 19V5"/><path d="m6 11 6-6 6 6"/>',
        play: '<path d="M8 5.5v13l11-6.5Z"/>',
        refresh: '<path d="M20 11a8 8 0 1 0-2.6 6.4"/><path d="M20 5v6h-6"/>',
        copy: '<rect x="9" y="9" width="11" height="11" rx="2"/><path d="M15 5H6a2 2 0 0 0-2 2v9"/>',
        download: '<path d="M12 4v11"/><path d="m7.5 11 4.5 4.5L16.5 11"/><path d="M5 20h14"/>',
        trash: '<path d="M4 7h16"/><path d="M9 7V4.5h6V7"/><path d="M6 7l1 13h10l1-13"/><path d="M10 11v5M14 11v5"/>',
        pencil: '<path d="M4 20h4L18 10l-4-4L4 16Z"/><path d="m13 5 3-3 3 3-3 3"/>',
        x: '<path d="M6 6l12 12M18 6 6 18"/>',
        link: '<path d="M10 14a4 4 0 0 0 5.7 0l2.3-2.3a4 4 0 0 0-5.7-5.7L11 7.3"/><path d="M14 10a4 4 0 0 0-5.7 0L6 12.3a4 4 0 0 0 5.7 5.7l1.3-1.3"/>',
        save: '<path d="M5 4h11l3 3v13H5z"/><path d="M8 4v6h7V4"/><path d="M8 15h8"/>',
        alert: '<path d="M12 4 2.8 20h18.4Z"/><path d="M12 9v5M12 17h.01"/>',
        map: '<path d="m3 6 6-2 6 2 6-2v14l-6 2-6-2-6 2Z"/><path d="M9 4v14M15 6v14"/>',
        info: '<circle cx="12" cy="12" r="8.5"/><path d="M12 11v5M12 8h.01"/>',
        bulb: '<path d="M9 18h6"/><path d="M10 21h4"/><path d="M12 3a6 6 0 0 0-3.5 10.9V16h7v-2.1A6 6 0 0 0 12 3Z"/>',
        eye: '<path d="M2.5 12S6 5.5 12 5.5 21.5 12 21.5 12 18 18.5 12 18.5 2.5 12 2.5 12Z"/><circle cx="12" cy="12" r="3"/>',
        list: '<path d="M8 6h12M8 12h12M8 18h12"/><path d="M4 6h.01M4 12h.01M4 18h.01"/>',
        home: '<path d="m4 11 8-7 8 7"/><path d="M6 10v10h12V10"/>',
        settings: '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1-2.8 2.8-.1-.1a1.7 1.7 0 0 0-1.9-.3 1.7 1.7 0 0 0-1 1.6v.2h-4v-.2a1.7 1.7 0 0 0-1-1.6 1.7 1.7 0 0 0-1.9.3l-.1.1L4.2 17l.1-.1a1.7 1.7 0 0 0 .3-1.9 1.7 1.7 0 0 0-1.6-1H2.8v-4H3a1.7 1.7 0 0 0 1.6-1 1.7 1.7 0 0 0-.3-1.9L4.2 7 7 4.2l.1.1a1.7 1.7 0 0 0 1.9.3 1.7 1.7 0 0 0 1-1.6v-.2h4V3a1.7 1.7 0 0 0 1 1.6 1.7 1.7 0 0 0 1.9-.3l.1-.1L19.8 7l-.1.1a1.7 1.7 0 0 0-.3 1.9 1.7 1.7 0 0 0 1.6 1h.2v4H21a1.7 1.7 0 0 0-1.6 1Z"/>',
        filter: '<path d="M3 5h18l-7 8v6l-4 2v-8Z"/>',
        external: '<path d="M14 4h6v6"/><path d="M20 4 11 13"/><path d="M18 14v5H5V6h5"/>',
        command: '<path d="M9 6a3 3 0 1 0-3 3h12a3 3 0 1 0-3-3v12a3 3 0 1 0 3-3H6a3 3 0 1 0 3 3Z"/>',
        layers: '<path d="m12 3 9 5-9 5-9-5Z"/><path d="m3 13 9 5 9-5"/><path d="m3 17 9 5 9-5"/>',
        shield: '<path d="M12 3 5 6v5c0 4.4 2.8 7.8 7 10 4.2-2.2 7-5.6 7-10V6Z"/><path d="m9 12 2 2 4-4"/>',
        database: '<ellipse cx="12" cy="5.5" rx="8" ry="3"/><path d="M4 5.5v6c0 1.7 3.6 3 8 3s8-1.3 8-3v-6"/><path d="M4 11.5v6c0 1.7 3.6 3 8 3s8-1.3 8-3v-6"/>',
        terminal: '<path d="m4 7 5 5-5 5"/><path d="M11 17h9"/>',
        spark: '<path d="m12 3 1.8 5.2L19 10l-5.2 1.8L12 17l-1.8-5.2L5 10l5.2-1.8Z"/>',
        target: '<circle cx="12" cy="12" r="8.5"/><circle cx="12" cy="12" r="4.5"/><circle cx="12" cy="12" r="1"/>',
        calendar: '<rect x="3.5" y="5" width="17" height="16" rx="2"/><path d="M8 3v4M16 3v4M3.5 10h17"/>',
        code: '<path d="m8 7-5 5 5 5"/><path d="m16 7 5 5-5 5"/><path d="m13 4-2 16"/>',
        type: '<path d="M4 6V4h16v2"/><path d="M12 4v16"/><path d="M8 20h8"/>',
        palette: '<path d="M12 3a9 9 0 1 0 0 18h1.5a2 2 0 0 0 0-4H12a2 2 0 0 1 0-4h4a5 5 0 0 0 5-5c0-3-4-5-9-5Z"/><circle cx="7.5" cy="10" r="1"/><circle cx="9.5" cy="6.5" r="1"/><circle cx="14" cy="6.5" r="1"/>'
    };

    function icon(name, size) {
        const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        svg.setAttribute('class', 'wa-ico');
        svg.setAttribute('viewBox', '0 0 24 24');
        svg.setAttribute('width', String(size || 16));
        svg.setAttribute('height', String(size || 16));
        svg.setAttribute('fill', 'none');
        svg.setAttribute('stroke', 'currentColor');
        svg.setAttribute('stroke-width', '1.8');
        svg.setAttribute('stroke-linecap', 'round');
        svg.setAttribute('stroke-linejoin', 'round');
        svg.setAttribute('aria-hidden', 'true');
        svg.setAttribute('focusable', 'false');
        svg.innerHTML = ICONS[name] || ICONS.chevron;
        return svg;
    }

    /** Bouton icône seule : le libellé reste accessible (aria-label + title). */
    function iconBtn(name, label, onclick, cls) {
        return h('button.wa-iconbtn' + (cls ? '.' + cls : ''), {
            type: 'button', 'aria-label': label, title: label, onclick
        }, icon(name, 17));
    }

    /** Confirmation intégrée (dialog natif, focus piégé, retour du focus). */
    function ask(message, opts) {
        opts = opts || {};
        return new Promise(function (resolve) {
            const previous = document.activeElement;
            const titleId = 'wa-dialog-title-' + Math.random().toString(36).slice(2, 8);
            const descId = 'wa-dialog-desc-' + Math.random().toString(36).slice(2, 8);
            let settled = false;
            const dlg = h('dialog.wa-dialog', { 'aria-labelledby': titleId, 'aria-describedby': descId });
            const done = function (value) {
                if (settled) return;
                settled = true;
                try { dlg.close(); } catch (err) { /* déjà fermé */ }
                dlg.remove();
                if (previous && typeof previous.focus === 'function') previous.focus();
                resolve(value);
            };
            dlg.appendChild(h('h3#' + titleId, {}, opts.title || 'Confirmer'));
            dlg.appendChild(h('p#' + descId, {}, message));
            const cancel = h('button.wa-btn.ghost', { type: 'button', onclick: () => done(false) }, opts.cancelLabel || 'Annuler');
            const confirm = h('button.wa-btn' + (opts.danger ? '.danger.solid' : '.primary'), {
                type: 'button', onclick: () => done(true)
            }, opts.confirmLabel || 'Confirmer');
            dlg.appendChild(h('div.wa-btn-row', {}, cancel, confirm));
            dlg.addEventListener('cancel', function (ev) { ev.preventDefault(); done(false); });
            dlg.addEventListener('close', function () { if (!settled) done(false); });
            document.body.appendChild(dlg);
            if (typeof dlg.showModal === 'function') dlg.showModal();
            else dlg.setAttribute('open', '');
            (opts.danger ? cancel : confirm).focus();
        });
    }

    return {
        h, append, esc, debounce, formatDate, toast, highlight, codeBlock, badge,
        progressbar, icon, iconBtn, ask, copyText
    };
})();
