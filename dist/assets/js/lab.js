/* WebAcademy — atelier de code réel : HTML/CSS (iframe), PHP (sandbox), SQL. */
WA.lab = (function () {
    const { h, badge, toast, icon, iconBtn } = WA.ui;

    const TEMPLATES = {
        html: {
            label: 'Atelier HTML',
            lang: 'html',
            blurb: 'Rendu réel dans un iframe sandbox de votre navigateur. Aucun code n’est envoyé au serveur.',
            files: [
                { name: 'index.html', value: '<!DOCTYPE html>\n<html lang="fr">\n<head>\n  <meta charset="UTF-8">\n  <meta name="viewport" content="width=device-width, initial-scale=1">\n  <title>Mon TP</title>\n</head>\n<body>\n\n  <h1>Titre principal</h1>\n  <p>Écrivez votre HTML ici, puis lancez l’aperçu.</p>\n\n</body>\n</html>' },
                { name: 'style.css', value: 'body {\n  font-family: system-ui, sans-serif;\n  margin: 24px;\n  line-height: 1.6;\n}\n\nh1 {\n  color: #b0431f;\n}' },
                { name: 'script.js', value: "// JavaScript optionnel — s'exécute dans l'aperçu\nconsole.log('Hello depuis l’atelier');\n" }
            ]
        },
        css: {
            label: 'Atelier CSS',
            lang: 'html',
            blurb: 'Modifiez la feuille de style et observez le rendu immédiatement dans l’aperçu sandbox.',
            files: [
                { name: 'index.html', value: '<!DOCTYPE html>\n<html lang="fr">\n<head>\n  <meta charset="UTF-8">\n  <meta name="viewport" content="width=device-width, initial-scale=1">\n  <link rel="stylesheet" href="style.css">\n</head>\n<body>\n  <div class="box">\n    <h1>Boîte CSS</h1>\n    <p id="texte">Modifiez le fichier style.css pour transformer cette boîte.</p>\n  </div>\n</body>\n</html>' },
                { name: 'style.css', value: 'body {\n  margin: 20px;\n  font-family: system-ui, sans-serif;\n}\n\n.box {\n  padding: 24px;\n  border: 2px solid #b0431f;\n  border-radius: 12px;\n  background: #fff8f2;\n}\n\nh1 {\n  margin-top: 0;\n}' }
            ]
        },
        php: {
            label: 'Atelier PHP',
            lang: 'php',
            blurb: 'Exécution PHP réelle dans une sandbox isolée (CLI, open_basedir, fonctions sensibles désactivées).',
            files: [
                { name: 'index.php', value: '<?php\n\n$nom = "Étudiant";\necho "Salut, $nom !\\n\\n";\n\n// Ctrl+Entrée pour exécuter\nfor ($i = 1; $i <= 3; $i++) {\n    echo "Ligne $i\\n";\n}\n' }
            ]
        },
        sql: {
            label: 'Atelier SQL',
            lang: 'sql',
            blurb: 'SQLite réel et persistant. MySQL réel si WAMP est démarré. Oracle : aucune simulation, message honnête.',
            files: [
                { name: 'console.sql', value: '-- Base d’essai : dataset « school »\n-- Tables : professeur, etudiant, matiere, note\n\nSELECT * FROM etudiant;' }
            ],
            datasets: true
        },
        cpp: {
            label: 'Atelier C++',
            lang: 'cpp',
            blurb: 'Éditeur C++17 avec modèles complets. La compilation se fait localement avec g++ — aucun code C++ n’est exécuté sur le serveur.',
            files: [
                { name: 'main.cpp', value: '#include <iostream>\n#include <string>\n\nint main() {\n    std::string nom = "Étudiant";\n    std::cout << "Salam, " << nom << " !" << std::endl;\n\n    for (int i = 1; i <= 3; ++i) {\n        std::cout << "Ligne " << i << std::endl;\n    }\n\n    return 0;\n}\n' }
            ],
            localOnly: true
        },
        javascript: {
            label: 'Atelier JavaScript',
            lang: 'javascript',
            blurb: 'JavaScript exécuté dans un iframe sandbox isolé. Console réelle, erreurs affichées, aperçu HTML/CSS quand il y en a un.',
            files: [
                { name: 'index.html', value: '<!DOCTYPE html>\n<html lang="fr">\n<head>\n  <meta charset="UTF-8">\n  <meta name="viewport" content="width=device-width, initial-scale=1">\n  <title>Mon TP JavaScript</title>\n</head>\n<body>\n\n  <h1 id="titre">Bonjour JavaScript</h1>\n  <p id="message">Cliquez sur le bouton pour changer ce texte.</p>\n  <button id="action">Changer le texte</button>\n\n</body>\n</html>' },
                { name: 'style.css', value: 'body {\n  font-family: system-ui, sans-serif;\n  margin: 24px;\n  line-height: 1.6;\n}\n\nh1 { color: #b0431f; }\n\nbutton {\n  padding: 8px 14px;\n  border: 1px solid #b0431f;\n  background: #fff8f2;\n  cursor: pointer;\n}' },
                { name: 'script.js', value: "const message = document.getElementById('message');\nconst bouton = document.getElementById('action');\n\nbouton.addEventListener('click', () => {\n  message.textContent = 'Le bouton a été cliqué !';\n  console.log('Clic détecté à', new Date().toLocaleTimeString('fr-FR'));\n});\n\nconsole.log('Script chargé.');\n" }
            ]
        }
    };

    const session = {};
    let consoleCleanup = null;

    function nowFr() {
        return new Intl.DateTimeFormat('fr-FR', { hour: '2-digit', minute: '2-digit', second: '2-digit' }).format(new Date());
    }

    function stateFor(module) {
        if (!session[module]) {
            const tpl = TEMPLATES[module];
            session[module] = {
                values: {},
                active: 0,
                dialect: 'sqlite',
                dataset: module === 'sql' ? 'school' : null,
                mobilePane: 'editor',
                guideHidden: false
            };
            tpl.files.forEach(f => { session[module].values[f.name] = f.value; });
        }
        return session[module];
    }

    function editorLang(name) {
        if (name.endsWith('.css')) return 'css';
        if (name.endsWith('.js')) return 'javascript';
        if (name.endsWith('.php')) return 'php';
        if (name.endsWith('.sql')) return 'sql';
        if (name.endsWith('.cpp') || name.endsWith('.h') || name.endsWith('.hpp')) return 'cpp';
        return 'html';
    }

    function buildPreview(values) {
        let html = values['index.html'] || '<!DOCTYPE html><html><body></body></html>';
        const css = values['style.css'] || '';
        const js = values['script.js'] || '';

        if (css) {
            html = html.replace(/<link[^>]+href=["']style\.css["'][^>]*>/i, '<style>\n' + css + '\n</style>');
            if (!/<style[\s>]/i.test(html)) {
                html = html.replace(/<\/head>/i, '<style>\n' + css + '\n</style>\n</head>');
                if (!/<style[\s>]/i.test(html)) html = '<style>\n' + css + '\n</style>' + html;
            }
        }
        if (js) {
            html = html.replace(/<script[^>]+src=["']script\.js["'][^>]*><\/script>/i, '<script>\n' + js + '\n<\/script>');
            if (!/<script[\s>]/i.test(html)) {
                html = html.replace(/<\/body>/i, '<script>\n' + js + '\n<\/script>\n</body>');
                if (!/<script[\s>]/i.test(html)) html += '<script>\n' + js + '\n<\/script>';
            }
        }
        return html;
    }

    function withConsoleBridge(html, token) {
        const bridge = '<script>(function(){'
            + 'var t="' + token + '";'
            + 'function send(kind,text){try{parent.postMessage({__waLabConsole:t,kind:kind,text:text},"*");}catch(e){}}'
            + '["log","info","warn","error"].forEach(function(k){var o=console[k];console[k]=function(){'
            + 'var a=[];for(var i=0;i<arguments.length;i++){var v=arguments[i];try{a.push(typeof v==="object"?JSON.stringify(v):String(v));}catch(e){a.push(String(v));}}'
            + 'send(k,a.join(" "));if(o){try{o.apply(console,arguments);}catch(e){}}};});'
            + 'window.addEventListener("error",function(e){send("error",(e.message||"Erreur JavaScript")+(e.lineno?" (ligne "+e.lineno+")":""));});'
            + 'window.addEventListener("unhandledrejection",function(e){var r=e.reason&&(e.reason.message||e.reason);send("error","Promesse rejetée : "+String(r));});'
            + 'send("ready","");'
            + '})();<\/script>';
        if (/<body[^>]*>/i.test(html)) return html.replace(/<body([^>]*)>/i, '<body$1>' + bridge);
        if (/<head[^>]*>/i.test(html)) return html.replace(/<\/head>/i, bridge + '</head>');
        return bridge + html;
    }

    function guideContent(module, datasets) {
        const tips = [];
        if (module === 'html' || module === 'css') {
            tips.push(['iframe sandbox', 'Le rendu s’exécute dans un iframe isolé : le code ne peut pas accéder à votre session ni au serveur.']);
            tips.push(['Fichiers', module === 'css' ? 'index.html contient la structure, style.css la mise en forme.' : 'index.html, style.css et script.js sont assemblés automatiquement dans l’aperçu.']);
            tips.push(['Raccourci', 'Ctrl+Entrée (ou Cmd+Entrée) lance l’aperçu.']);
        } else if (module === 'php') {
            tips.push(['Exécution réelle', 'Le code est écrit dans un dossier temporaire privé, puis exécuté par le CLI PHP avec open_basedir et 6 secondes maximum.']);
            tips.push(['Fonctions bloquées', 'Shell, processus, réseau, écriture de fichiers et introspection du serveur sont interdits.']);
            tips.push(['Sortie', 'La sortie standard et les erreurs sont affichées, limitées à 64 Kio.']);
        } else if (module === 'sql') {
            tips.push(['SQLite', 'Exécution réelle sur data/sql_sandbox.sqlite. Les tables persistent entre les requêtes.']);
            tips.push(['MySQL', 'Si WAMP tourne, le moteur MySQL exécute réellement la requête sur la base sandbox.']);
            tips.push(['Oracle', 'Aucun client Oracle n’est installé : la requête n’est pas exécutée et aucune simulation n’est faite.']);
            const names = Object.keys(datasets || {}).map(id => datasets[id].label || id);
            if (names.length) tips.push(['Jeux de données', names.join(', ') + '. « Réinitialiser » recrée les tables du jeu sélectionné.']);
        } else if (module === 'cpp') {
            tips.push(['Pas d’exécution serveur', 'Le code C++ n’est jamais compilé ni exécuté sur le serveur : un binaire natif pourrait lire les fichiers, ouvrir des sockets ou lancer des processus.']);
            tips.push(['Compilation locale', 'Copiez main.cpp, puis lancez g++ -std=c++17 main.cpp -o main. Exécutez ensuite ./main (Linux/macOS) ou .\\main.exe (Windows).']);
            tips.push(['Erreurs du compilateur', 'Lisez la première erreur, son fichier et sa ligne. Corrigez une erreur à la fois, puis recompilez.']);
            tips.push(['Raccourci', 'Ctrl+Entrée affiche le rappel de compilation locale.']);
        } else if (module === 'javascript') {
            tips.push(['Sandbox navigateur', 'Le script s’exécute dans un iframe sandbox sans accès à votre session, aux cookies ni aux données de l’application.']);
            tips.push(['Console réelle', 'console.log(), les erreurs et les promesses rejetées sont affichés dans le panneau Sortie.']);
            tips.push(['Aperçu', 'Les fichiers index.html et style.css construisent l’aperçu ; script.js est exécuté dans la sandbox.']);
            tips.push(['Raccourci', 'Ctrl+Entrée lance l’exécution.']);
        }
        const box = h('div');
        tips.forEach(([title, text]) => box.appendChild(h('div.wa-guide-tip', {}, h('b', {}, title), h('span', {}, text))));
        return box;
    }

    function render(module) {
        const tpl = TEMPLATES[module];
        if (!tpl) {
            return h('div.wa-empty-state', {},
                h('div.wa-empty-icon', {}, icon('flask', 26)),
                h('h1', {}, 'Atelier inconnu'),
                h('p', {}, 'Ce module ne dispose pas encore d’atelier.'),
                h('div.wa-btn-row', {}, h('a.wa-btn.primary', { href: '#/dashboard' }, 'Retour au tableau de bord')));
        }

        const st = stateFor(module);
        const datasets = WA.app.data('datasets') || {};
        const root = h('div');
        root.appendChild(h('header.wa-page-head', {},
            h('div.wa-overline', {}, 'Pratique · ' + tpl.label),
            h('h1.wa-page-title', {}, tpl.label),
            h('p.wa-page-lead', {}, tpl.blurb)));

        const lab = h('div.wa-lab');
        root.appendChild(lab);

        const status = h('div.wa-statusline', { role: 'status', 'aria-live': 'polite' }, 'Prêt. ');
        const outContent = h('div.wa-lab-out');

        const runBtn = h('button.wa-btn.primary', { type: 'button' },
            icon(module === 'cpp' ? 'terminal' : 'play', 15),
            module === 'cpp' ? 'Compiler localement' : 'Exécuter',
            h('kbd', { style: 'font-size:9px;opacity:.75' }, 'Ctrl+Entrée'));

        const datasetSelect = tpl.datasets ? h('select.wa-select', {
            'aria-label': 'Jeu de données SQL',
            onchange: ev => { st.dataset = ev.target.value; run(); }
        }) : null;
        if (datasetSelect) {
            const entries = Object.values(datasets);
            if (!entries.length) datasetSelect.appendChild(h('option', { value: 'school' }, 'school'));
            entries.forEach(d => datasetSelect.appendChild(h('option', {
                value: d.id, selected: d.id === st.dataset ? '' : null
            }, d.label || d.id)));
        }

        const dialectSelect = tpl.datasets ? h('select.wa-select', {
            'aria-label': 'Moteur SQL',
            onchange: ev => {
                st.dialect = ev.target.value;
                status.textContent = 'Moteur : ' + st.dialect + '.';
                run();
            }
        },
            h('option', { value: 'sqlite' }, 'Moteur : SQLite (toujours dispo)'),
            h('option', { value: 'mysql' }, 'Moteur : MySQL (si WAMP)'),
            h('option', { value: 'oracle' }, 'Oracle — non exécutable ici')) : null;

        const guideBtn = h('button.wa-btn.ghost', {
            type: 'button',
            'aria-pressed': 'false',
            onclick: () => {
                st.guideHidden = !st.guideHidden;
                guidePane.classList.toggle('mobile-hidden', st.guideHidden);
                guideBtn.setAttribute('aria-pressed', st.guideHidden ? 'true' : 'false');
            }
        }, icon('book', 15), 'Guide');

        const toolbar = h('div.wa-lab-toolbar', {},
            runBtn,
            h('button.wa-btn.ghost', { type: 'button', onclick: resetFiles }, icon('refresh', 15), 'Fichiers'),
            tpl.datasets ? h('button.wa-btn.ghost', {
                type: 'button',
                onclick: resetDatabase
            }, icon('database', 15), 'Base') : null,
            h('span.spacer'),
            datasetSelect,
            dialectSelect,
            iconBtn('copy', 'Copier le fichier actif', copyActive),
            iconBtn('download', 'Télécharger le fichier actif', downloadActive),
            iconBtn('x', 'Vider la sortie', clearOutput));
        lab.appendChild(toolbar);

        /* Onglets mobiles */
        const tabs = h('div.wa-lab-tabs', { role: 'tablist', 'aria-label': 'Panneaux de l’atelier' });
        [['guide', 'Guide'], ['editor', 'Code'], ['output', 'Sortie']].forEach(([id, label]) => {
            tabs.appendChild(h('button.wa-lab-tab', {
                type: 'button',
                role: 'tab',
                'aria-selected': st.mobilePane === id ? 'true' : 'false',
                'aria-controls': 'wa-lab-' + id,
                onclick: () => showPane(id)
            }, label));
        });
        lab.appendChild(tabs);

        const grid = h('div.wa-lab-grid');

        /* Guide */
        const guidePane = h('section.wa-lab-pane.guide', { id: 'wa-lab-guide', 'aria-label': 'Guide de l’atelier' },
            h('div.wa-pane-head', {}, icon('book', 14), 'Guide & repères'),
            h('div.wa-pane-body', {}, guideContent(module, datasets)));
        grid.appendChild(guidePane);

        /* Éditeur */
        const editorPane = h('section.wa-lab-pane.editor', { id: 'wa-lab-editor', 'aria-label': 'Éditeur de code' });
        const fileTabs = h('div.wa-file-tabs', { role: 'tablist', 'aria-label': 'Fichiers de l’atelier' });
        const editorHost = h('div.wa-editor-host');
        editorPane.appendChild(h('div.wa-pane-head', {}, icon('pencil', 14), 'Éditeur'));
        editorPane.appendChild(fileTabs);
        editorPane.appendChild(editorHost);
        grid.appendChild(editorPane);

        /* Sortie */
        const outputPane = h('section.wa-lab-pane.output', { id: 'wa-lab-output', 'aria-label': 'Sortie de l’exécution' },
            h('div.wa-pane-head', {}, icon('eye', 14), 'Sortie'),
            h('div.wa-pane-body', {}, outContent),
            status);
        grid.appendChild(outputPane);

        lab.appendChild(grid);

        let editor = null;
        let activeFile = tpl.files[st.active] || tpl.files[0];

        function paintFileTabs() {
            fileTabs.innerHTML = '';
            tpl.files.forEach((file, index) => {
                const on = index === st.active;
                fileTabs.appendChild(h('button.wa-file-tab' + (on ? '.active' : ''), {
                    type: 'button',
                    role: 'tab',
                    'aria-selected': on ? 'true' : 'false',
                    onclick: () => selectFile(index)
                }, file.name));
            });
        }

        function selectFile(index) {
            if (editor) st.values[activeFile.name] = editor.getValue();
            st.active = index;
            activeFile = tpl.files[index];
            paintFileTabs();
            if (!editor) {
                editor = WA.editor.create(editorHost, {
                    lang: editorLang(activeFile.name),
                    value: st.values[activeFile.name] || '',
                    label: 'Éditeur de code — ' + activeFile.name,
                    onChange: value => { st.values[activeFile.name] = value; }
                });
            } else {
                editor.setValue(st.values[activeFile.name] || '');
            }
        }

        function showPane(id) {
            st.mobilePane = id;
            [['guide', guidePane], ['editor', editorPane], ['output', outputPane]].forEach(([key, pane]) => {
                pane.classList.toggle('mobile-active', key === id);
            });
            // Set aria-selected on tab buttons based on active pane
            const tabLabels = { guide: 'guide', editor: 'Code', output: 'Sortie' };
            tabs.querySelectorAll('.wa-lab-tab').forEach(btn => {
                const expectedLabel = tabLabels[id] || id;
                const on = btn.textContent.toLowerCase().indexOf(expectedLabel.toLowerCase()) !== -1;
                btn.setAttribute('aria-selected', on ? 'true' : 'false');
            });
        }

        function setStatus(text, kind) {
            status.innerHTML = '';
            status.appendChild(h('span', { class: kind || '' }, text));
        }

        function clearOutput() {
            outContent.innerHTML = '';
            outContent.appendChild(h('div.wa-empty-out', {},
                h('div', {}, icon('terminal', 22), h('p', { style: 'margin:8px 0 0' }, 'Lancez le code pour voir le résultat réel.'))));
            setStatus('Prêt. ');
        }

        function currentCode() {
            if (editor) st.values[activeFile.name] = editor.getValue();
            return st.values[activeFile.name] || '';
        }

        function copyActive() {
            const code = currentCode();
            WA.ui.copyText(code)
                .then(() => toast(activeFile.name + ' copié.', 'ok'))
                .catch(() => toast('Copie impossible dans ce navigateur.', 'err'));
        }

        function downloadActive() {
            const blob = new Blob([currentCode()], { type: 'text/plain;charset=utf-8' });
            const url = URL.createObjectURL(blob);
            const a = h('a', { href: url, download: activeFile.name });
            document.body.appendChild(a);
            a.click();
            a.remove();
            setTimeout(() => URL.revokeObjectURL(url), 1000);
        }

        function resetFiles() {
            tpl.files.forEach(file => { st.values[file.name] = file.value; });
            st.active = 0;
            activeFile = tpl.files[0];
            paintFileTabs();
            if (editor) editor.setValue(activeFile.value);
            clearOutput();
            toast('Fichiers réinitialisés.', 'ok');
        }

        function resetDatabase() {
            if (!tpl.datasets) return;
            WA.ui.ask('Les tables du jeu « ' + st.dataset + ' » seront recréées et les modifications perdues.', {
                title: 'Réinitialiser la base d’essai ?',
                confirmLabel: 'Réinitialiser',
                danger: true
            }).then(ok => {
                if (!ok) return;
                setStatus('Réinitialisation de la base…');
                WA.api.post('sql-reset', { dialect: st.dialect, dataset: st.dataset })
                    .then(res => {
                        toast(res.message || 'Base réinitialisée.', 'ok');
                        run();
                    })
                    .catch(err => {
                        outContent.innerHTML = '';
                        outContent.appendChild(oraclePanel(err) || h('div.verdict.fail', {}, err.message));
                        setStatus('Réinitialisation impossible.', 'err');
                    });
            });
        }

        function oraclePanel(err) {
            const payload = err && err.payload;
            if (!payload || payload.engine !== 'oracle') return null;
            return h('div.wa-callout.warning', { style: 'margin:0' },
                h('div.ttl', {}, icon('info', 15), 'Oracle non disponible'),
                h('p', { style: 'margin:0' }, payload.message || err.message),
                payload.install_hint ? h('p', { style: 'margin:8px 0 0;font-size:12.5px;color:var(--muted)' }, payload.install_hint) : null);
        }

        function showPreview(html) {
            outContent.innerHTML = '';
            outContent.style.padding = '0';
            outContent.style.display = 'flex';
            outContent.style.flexDirection = 'column';
            const frame = document.createElement('iframe');
            frame.className = 'wa-lab-preview';
            frame.setAttribute('sandbox', 'allow-scripts');
            frame.setAttribute('title', 'Aperçu du code ' + module.toUpperCase());
            frame.style.flex = '1';
            frame.style.height = '100%';
            frame.srcdoc = html;
            outContent.appendChild(frame);
        }

        function showConsole(text, isError) {
            outContent.innerHTML = '';
            outContent.style.padding = '';
            outContent.style.display = '';
            outContent.style.flexDirection = '';
            const pre = h('pre.wa-console', { tabindex: '0', 'aria-label': 'Sortie de l’exécution' });
            pre.textContent = text || '(aucune sortie)';
            if (isError) pre.classList.add('errline');
            outContent.appendChild(pre);
        }

        function showCppGuide() {
            outContent.innerHTML = '';
            outContent.style.padding = '';
            outContent.style.display = '';
            outContent.style.flexDirection = '';
            const commands = 'g++ -std=c++17 main.cpp -o main\n\n# Linux / macOS\n./main\n\n# Windows (PowerShell ou cmd)\n.\\main.exe';
            const box = h('div.wa-cpp-guide', {},
                h('div.wa-callout.warning', { style: 'margin:0 0 12px' },
                    h('div.ttl', {}, icon('shield', 15), 'Aucune exécution C++ sur le serveur'),
                    h('p', { style: 'margin:0' }, 'Un binaire natif pourrait lire les fichiers du serveur, ouvrir des sockets ou lancer des processus. WebAcademy ne compile donc jamais votre C++ côté serveur. Copiez le fichier et compilez-le sur votre machine avec g++.')),
                h('div.wa-pane-head', { style: 'padding-left:0' }, icon('terminal', 14), 'Compilation locale'),
                h('pre.wa-console', { tabindex: '0' }, commands),
                h('div.wa-btn-row', { style: 'margin-top:10px' },
                    h('button.wa-btn.primary', {
                        type: 'button',
                        onclick: () => {
                            WA.ui.copyText(currentCode())
                                .then(() => toast('main.cpp copié.', 'ok'))
                                .catch(() => toast('Copie impossible dans ce navigateur.', 'err'));
                        }
                    }, icon('copy', 15), 'Copier main.cpp'),
                    h('button.wa-btn', {
                        type: 'button',
                        onclick: () => downloadActive()
                    }, icon('download', 15), 'Télécharger main.cpp')));
            outContent.appendChild(box);
        }

        function showJsLab(html, token) {
            outContent.innerHTML = '';
            outContent.style.padding = '0';
            outContent.style.display = '';
            outContent.style.flexDirection = '';
            const split = h('div.wa-js-output');
            const frame = document.createElement('iframe');
            frame.className = 'wa-lab-preview';
            frame.setAttribute('sandbox', 'allow-scripts');
            frame.setAttribute('title', 'Aperçu JavaScript sandboxé');
            frame.srcdoc = html;
            const consoleBox = h('pre.wa-console.wa-js-console', { tabindex: '0', 'aria-label': 'Console JavaScript de l’aperçu' });
            consoleBox.textContent = '(console vide)';
            split.appendChild(frame);
            split.appendChild(consoleBox);
            outContent.appendChild(split);

            if (consoleCleanup) { consoleCleanup(); consoleCleanup = null; }
            const onMessage = ev => {
                const data = ev.data || {};
                if (data.__waLabConsole !== token) return;
                if (data.kind === 'ready') return;
                const prefix = data.kind === 'error' ? '✗ ' : data.kind === 'warn' ? '⚠ ' : '';
                const line = prefix + String(data.text == null ? '' : data.text);
                consoleBox.textContent = consoleBox.textContent === '(console vide)' ? line : consoleBox.textContent + '\n' + line;
                if (data.kind === 'error') consoleBox.classList.add('errline');
            };
            window.addEventListener('message', onMessage);
            consoleCleanup = () => window.removeEventListener('message', onMessage);
        }

        function showSql(res) {
            outContent.innerHTML = '';
            outContent.style.padding = '';
            outContent.style.display = '';
            outContent.style.flexDirection = '';
            const statements = res.statements && res.statements.length ? res.statements : [res];
            statements.forEach(stmt => {
                if (stmt.rows && stmt.rows.length) {
                    const wrap = h('div.wa-outtable');
                    const table = h('table.wa-sqltable');
                    if (stmt.columns && stmt.columns.length) {
                        table.appendChild(h('thead', {}, h('tr', {}, stmt.columns.map(c => h('th', { scope: 'col' }, c)))));
                    }
                    const tbody = h('tbody');
                    stmt.rows.forEach(row => {
                        tbody.appendChild(h('tr', {}, Object.values(row).map(v => h('td', {}, v))));
                    });
                    table.appendChild(tbody);
                    wrap.appendChild(table);
                    outContent.appendChild(wrap);
                }
                if (stmt.message) outContent.appendChild(h('div.wa-sql-note', {}, stmt.message));
                if (stmt.truncated) outContent.appendChild(h('div.wa-sql-note', {}, 'Affichage limité aux 200 premières lignes.'));
            });
            if (!statements.some(s => s.rows && s.rows.length)) {
                outContent.appendChild(h('div.wa-empty-out', {},
                    h('div', {}, icon('database', 22), h('p', { style: 'margin:8px 0 0' }, 'Requête exécutée — aucune ligne retournée.'))));
            }
        }

        function run() {
            if (module === 'cpp') {
                showCppGuide();
                setStatus('Compilation locale requise — aucun code C++ n’est exécuté sur le serveur · ' + nowFr(), 'warn');
                if (window.matchMedia('(max-width: 760px)').matches) showPane('output');
                return;
            }

            if (module === 'javascript') {
                const token = 'lab' + Date.now() + '_' + Math.random().toString(36).slice(2);
                showJsLab(withConsoleBridge(buildPreview(st.values), token), token);
                setStatus('Exécution JavaScript dans la sandbox · ' + nowFr(), 'ok');
                if (window.matchMedia('(max-width: 760px)').matches) showPane('output');
                return;
            }

            if (module === 'php') {
                const code = currentCode();
                setStatus('Exécution PHP…');
                runBtn.disabled = true;
                WA.api.post('php-run', { code })
                    .then(res => {
                        const text = [res.output || '', res.error || '', res.stderr || ''].filter(Boolean).join('\n');
                        showConsole(text, !res.ok);
                        setStatus('Terminé · ' + (res.runtime || 'PHP') + ' · ' + nowFr(), res.ok ? 'ok' : 'err');
                    })
                    .catch(err => {
                        showConsole(err.message, true);
                        setStatus('Échec de l’exécution.', 'err');
                    })
                    .finally(() => { runBtn.disabled = false; });
                return;
            }

            if (module === 'sql') {
                const sql = currentCode();
                setStatus('Exécution SQL (' + st.dialect + ')…');
                runBtn.disabled = true;
                WA.api.post('sql-run', { dialect: st.dialect, sql, dataset: st.dataset })
                    .then(res => {
                        showSql(res);
                        setStatus('Terminé · ' + st.dialect + ' · ' + (res.rows ? res.rows.length : 0) + ' ligne(s) · ' + nowFr(), 'ok');
                    })
                    .catch(err => {
                        outContent.innerHTML = '';
                        outContent.style.padding = '';
                        outContent.style.display = '';
                        const oracle = oraclePanel(err);
                        if (oracle) outContent.appendChild(oracle);
                        else outContent.appendChild(h('div.verdict.fail', {}, err.message));
                        setStatus('Requête en échec (' + st.dialect + ').', 'err');
                    })
                    .finally(() => { runBtn.disabled = false; });
                return;
            }

            // HTML / CSS : assemblage local, aucun appel réseau.
            const html = buildPreview(st.values);
            showPreview(html);
            setStatus('Aperçu rendu localement · ' + nowFr(), 'ok');
            if (window.matchMedia('(max-width: 760px)').matches) showPane('output');
        }

        runBtn.addEventListener('click', run);

        lab.addEventListener('keydown', ev => {
            if ((ev.ctrlKey || ev.metaKey) && ev.key === 'Enter') {
                ev.preventDefault();
                run();
            }
        });

        paintFileTabs();
        selectFile(st.active);
        clearOutput();
        showPane(st.mobilePane);

        return root;
    }

    return { render };
})();
