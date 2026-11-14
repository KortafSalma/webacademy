/* WebAcademy — éditeur de code : CodeMirror 5 si disponible, sinon textarea.
   API : WA.editor.create(host, {lang, value, label, describedby, onChange}) */
WA.editor = (function () {

    const MODES = {
        html: 'htmlmixed',
        css: 'css',
        php: 'application/x-httpd-php',
        javascript: 'javascript',
        js: 'javascript',
        cpp: 'text/x-c++src',
        cxx: 'text/x-c++src',
        'c++': 'text/x-c++src',
        sql: 'sql',
        text: 'text/plain'
    };

    function cmAvailable() {
        return typeof window.CodeMirror === 'function';
    }

    function create(host, opts) {
        opts = opts || {};
        const lang = opts.lang || 'text';
        const label = opts.label || ('Éditeur de code ' + (lang === 'text' ? '' : lang.toUpperCase())).trim();
        const describedby = opts.describedby || null;

        if (cmAvailable()) {
            host.classList.add('editorhost');
            host.innerHTML = '';
            const cm = CodeMirror(host, {
                value: opts.value || '',
                mode: MODES[lang] || 'text/plain',
                lineNumbers: true,
                indentUnit: 4,
                indentWithTabs: false,
                smartIndent: true,
                tabSize: 4,
                lineWrapping: !!opts.lineWrapping,
                theme: 'default',
                matchBrackets: true,
                scrollbarStyle: 'native',
                viewportMargin: 40
            });
            cm.on('change', () => opts.onChange && opts.onChange(cm.getValue()));

            const input = cm.getInputField();
            if (input) {
                input.setAttribute('aria-label', label);
                input.setAttribute('aria-multiline', 'true');
                input.setAttribute('spellcheck', 'false');
                input.setAttribute('autocapitalize', 'off');
                input.setAttribute('autocomplete', 'off');
                if (describedby) input.setAttribute('aria-describedby', describedby);
            }
            const wrapper = cm.getWrapperElement();
            wrapper.setAttribute('dir', 'ltr');
            wrapper.setAttribute('data-lang', lang);

            const fit = () => {
                const available = host.clientHeight > 80 ? host.clientHeight - 2 : 420;
                cm.setSize('100%', available);
                cm.refresh();
            };
            fit();
            requestAnimationFrame(fit);
            if (document.fonts && document.fonts.ready) document.fonts.ready.then(fit);
            if (window.ResizeObserver) {
                const ro = new ResizeObserver(fit);
                ro.observe(host);
            }

            return {
                cm,
                getValue: () => cm.getValue(),
                setValue: (v) => cm.setValue(v),
                focus: () => cm.focus(),
                refresh: fit
            };
        }

        /* Repli sans réseau : textarea natif, lui aussi étiqueté. */
        host.classList.add('editorhost', 'fallback');
        host.innerHTML = '';
        const ta = document.createElement('textarea');
        ta.spellcheck = false;
        ta.setAttribute('aria-label', label);
        ta.setAttribute('aria-multiline', 'true');
        ta.setAttribute('autocapitalize', 'off');
        ta.setAttribute('autocomplete', 'off');
        if (describedby) ta.setAttribute('aria-describedby', describedby);
        ta.value = opts.value || '';
        ta.style.height = '100%';
        host.appendChild(ta);
        ta.addEventListener('input', () => opts.onChange && opts.onChange(ta.value));
        return {
            getValue: () => ta.value,
            setValue: (v) => { ta.value = v; opts.onChange && opts.onChange(v); },
            focus: () => ta.focus(),
            refresh: () => {}
        };
    }

    return { create, cmAvailable };
})();
