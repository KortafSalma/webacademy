/* WebAcademy — lecteur de leçon, blocs de contenu, exercices interactifs. */
WA.lesson = (function () {
    const { h, codeBlock, badge, toast, icon } = WA.ui;

    let tocObserver = null;
    const exerciseState = {};

    /* ------------------------------------------------------------ utilitaires */

    function lessonRoute(module, ch, anchor) {
        return '#/lesson/' + module + '/' + ch + (anchor ? '~' + anchor : '');
    }

    function plain(html) {
        return String(html || '').replace(/<[^>]*>/g, ' ').replace(/\s+/g, ' ').trim();
    }

    function inline(html) {
        return WA.ui.esc(String(html || '')).replace(/`([^`]+)`/g, '<code>$1</code>');
    }

    function moduleOf(data) {
        const mods = (WA.app.data('manifest') && WA.app.data('manifest').modules) || [];
        return mods.find(m => m.id === data.module) || { id: data.module, name: data.module, chapters: [] };
    }

    function chapterMeta(data) {
        const mod = moduleOf(data);
        return (mod.chapters || []).find(c => Number(c.n) === Number(data.ch)) || { n: data.ch, title: data.chapter.title };
    }

    function readingMinutes(chapter) {
        if (Number(chapter.minutes) > 0) return Math.round(Number(chapter.minutes));
        const words = plain(JSON.stringify(chapter)).split(/\s+/).filter(Boolean).length;
        return Math.max(3, Math.round(words / 180));
    }

    function exerciseLang(data, lv) {
        if (lv && lv.lang) return lv.lang;
        if (data.module === 'sql') return 'sql';
        if (data.module === 'php') return 'php';
        if (data.module === 'cpp') return 'cpp';
        if (data.module === 'javascript') return 'javascript';
        return 'html';
    }

    function isLabModule(module) {
        const labMods = ['html', 'css', 'php', 'sql', 'cpp', 'javascript'];
        return labMods.indexOf(module) !== -1;
    }

    /* ------------------------------------------------------------ blocs */

    function textBlock(b) {
        return h('div.wa-text', {},
            b.fr ? h('div.fr-only', { html: b.fr }) : null,
            b.darija ? h('div.wa-darija', {},
                h('span.flag', {}, 'Darija'),
                h('div', { html: b.darija })) : null);
    }

    function definitionBlock(b) {
        return h('div.wa-definition', {},
            h('div.hdr', {}, b.title || 'Définition'),
            h('div', {},
                b.fr ? h('div.fr-only', { html: b.fr }) : null,
                b.darija ? h('div.wa-darija', {
                    style: 'margin:10px 0 0;background:none;border-left:0;padding:0'
                }, h('span.flag', {}, 'Darija'), h('div', { html: b.darija })) : null));
    }

    function calloutBlock(b, kind) {
        const titles = { note: 'À noter', tip: 'Astuce', warning: 'Attention' };
        return h('div.wa-callout.' + kind, {},
            h('div.ttl', {}, icon(kind === 'tip' ? 'bulb' : kind === 'warning' ? 'alert' : 'info', 15), b.title || titles[kind]),
            b.fr ? h('div.fr-only', { html: b.fr }) : null,
            b.darija ? h('div.wa-darija', {},
                h('span.flag', {}, 'Darija'),
                h('div', { html: b.darija })) : null);
    }

    function tableBlock(b) {
        const wrap = h('div');
        const scroll = h('div.wa-tablewrap');
        const table = h('table.wa-table');
        if (Array.isArray(b.headers) && b.headers.length) {
            table.appendChild(h('thead', {}, h('tr', {}, b.headers.map(th => h('th', { scope: 'col' }, th)))));
        }
        const tbody = h('tbody');
        (b.rows || []).forEach(row => {
            tbody.appendChild(h('tr', {}, (Array.isArray(row) ? row : [row]).map(cell => h('td', {}, cell))));
        });
        table.appendChild(tbody);
        scroll.appendChild(table);
        wrap.appendChild(scroll);
        if (b.fr) wrap.appendChild(h('p', { style: 'color:var(--muted);font-size:13.5px', html: inline(b.fr) }));
        return wrap;
    }

    function keywordsBlock(b) {
        const grid = h('div.wa-keywords');
        (b.items || []).forEach(item => {
            grid.appendChild(h('div.wa-kw', {},
                h('b', {}, item.kw || ''),
                item.fr ? h('span.f.fr-only', { html: item.fr }) : null,
                item.darija ? h('span.d', { html: item.darija }) : null));
        });
        return grid;
    }

    function previewFrame(src, label) {
        const iframe = document.createElement('iframe');
        iframe.className = 'wa-lab-preview';
        iframe.setAttribute('sandbox', 'allow-scripts');
        iframe.setAttribute('title', label || 'Aperçu du code');
        iframe.setAttribute('loading', 'lazy');
        iframe.style.minHeight = '240px';
        iframe.srcdoc = src;
        return h('div', { style: 'padding:12px;background:var(--surface-2)' }, iframe);
    }

    function exampleBlock(b) {
        const card = h('div.wa-example-card');
        card.appendChild(h('div.etitle', {}, icon('code', 15), b.title || 'Exemple'));
        if (b.code) card.appendChild(codeBlock(b.code, b.lang || 'html', b.title));
        if (b.output) {
            card.appendChild(h('div.explain', {},
                h('div', { style: 'font-family:var(--font-mono);font-size:9.5px;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-bottom:4px' }, 'Résultat attendu'),
                h('div', {}, b.output)));
        }
        if (b.preview) {
            const src = b.preview === true ? b.code : b.preview;
            card.appendChild(previewFrame(src, 'Aperçu de « ' + (b.title || 'exemple') + ' »'));
        }
        if (b.explainFr || b.explainDarija) {
            card.appendChild(h('div.explain', {},
                b.explainFr ? h('div.fr-only', { html: b.explainFr }) : null,
                b.explainDarija ? h('div.wa-darija', {
                    style: 'margin:9px 0 0;padding:9px 11px;font-size:13.5px'
                }, h('span.flag', {}, 'Darija'), h('div', { html: b.explainDarija })) : null));
        }
        return card;
    }

    function renderBlock(b) {
        switch (b.type) {
            case 'text': return textBlock(b);
            case 'definition': return definitionBlock(b);
            case 'syntax': return codeBlock(b.code || '', b.lang || 'html', b.title || 'Syntaxe');
            case 'note': return calloutBlock(b, 'note');
            case 'tip': return calloutBlock(b, 'tip');
            case 'warning': return calloutBlock(b, 'warning');
            case 'table': return tableBlock(b);
            case 'keywords': return keywordsBlock(b);
            case 'example': return exampleBlock(b);
            default: return null;
        }
    }

    function mistakesBlock(items) {
        if (!Array.isArray(items) || !items.length) return null;
        const box = h('section', { id: 'sec-erreurs' });
        box.appendChild(h('h2.wa-section-title', {}, icon('alert', 20), h('span', {}, 'Erreurs fréquentes')));
        items.forEach(m => {
            box.appendChild(h('div.wa-mistake', {},
                h('code.m-code', {}, m.wrong || ''),
                h('code.m-code', {}, m.fix || ''),
                h('div', {},
                    m.fr ? h('div.fr-only', { html: m.fr }) : null,
                    m.darija ? h('div.wa-darija', {
                        style: 'margin:8px 0 0;padding:8px 10px;font-size:13px'
                    }, h('span.flag', {}, 'Darija'), h('div', { html: m.darija })) : null)));
        });
        return box;
    }

    function summaryBlock(summary) {
        if (!summary) return null;
        const box = h('section.wa-summary', { id: 'sec-resume' });
        box.appendChild(h('h2.wa-section-title', {}, icon('check', 20), h('span', {}, 'Résumé')));
        const parts = h('div.parts');
        if (summary.fr) parts.appendChild(h('div.wa-card', {}, h('h4', {}, 'En français'), h('div', { html: summary.fr })));
        if (summary.darija) parts.appendChild(h('div.wa-card', {}, h('h4', {}, 'Darija'), h('div', { html: summary.darija })));
        box.appendChild(parts);
        return box;
    }

    /* ------------------------------------------------------------ exercices */

    function norm(value) {
        return String(value == null ? '' : value).toLowerCase().replace(/\s+/g, ' ').replace(/\s*([(),;])\s*/g, '$1').trim();
    }

    function compare(a, op, b) {
        switch (op) {
            case '==': return a == b; // eslint-disable-line eqeqeq
            case '>=': return a >= b;
            case '<=': return a <= b;
            case '>': return a > b;
            case '<': return a < b;
            case '!=': return a != b; // eslint-disable-line eqeqeq
            default: return false;
        }
    }

    async function executeExercise(ex, lv, code) {
        const lang = String(lv.lang || '').toLowerCase();
        if (lang === 'php') return WA.api.post('php-run', { code });
        if (lang === 'sql') {
            return WA.api.post('sql-run', {
                dialect: lv.dialect || ex.dialect || 'sqlite',
                sql: code,
                dataset: lv.dataset || ex.dataset || null
            });
        }
        if (lang === 'javascript' || lang === 'js') {
            const res = await WA.runner.run({
                code: code,
                tests: lv.tests || [],
                html: lv.html || ex.html || '',
                css: lv.css || ex.css || '',
                timeout: 4500,
                settle: 220,
                title: 'Exercice JavaScript — niveau ' + lv.level
            });
            return Object.assign({ local: true }, res);
        }
        // C++ : aucune compilation sur le serveur public. Les tests sont
        // statiques (présence/motifs) et la correction reste la référence.
        return { ok: true, local: true, static: true, output: '', rows: [], columns: [] };
    }

    function testOutcome(test, res, code) {
        const t = test;
        let ok = false;
        let detail = '';
        switch (t.type) {
            case 'output_contains': {
                ok = norm(res.output || '').indexOf(norm(t.value)) !== -1;
                detail = ok ? '' : 'la sortie doit contenir « ' + t.value + ' »';
                break;
            }
            case 'output_not_contains': {
                ok = norm(res.output || '').indexOf(norm(t.value)) === -1;
                detail = ok ? '' : 'la sortie ne doit pas contenir « ' + t.value + ' »';
                break;
            }
            case 'output_equals': {
                ok = norm(res.output || '') === norm(t.value);
                detail = ok ? '' : 'sortie attendue : « ' + t.value + ' »';
                break;
            }
            case 'output_regex': {
                try { ok = new RegExp(t.value, t.flags || 'mi').test(norm(res.output || '')); }
                catch (err) { ok = false; detail = 'motif de test invalide'; }
                if (!ok && !detail) detail = 'la sortie doit correspondre à ' + t.value;
                break;
            }
            case 'html_contains': {
                ok = code.toLowerCase().replace(/\s+/g, ' ').indexOf(String(t.value).toLowerCase()) !== -1;
                detail = ok ? '' : 'le code doit contenir « ' + t.value + ' »';
                break;
            }
            case 'html_regex': {
                try { ok = new RegExp(t.value, t.flags || 'i').test(code); }
                catch (err) { ok = false; detail = 'motif de test invalide'; }
                if (!ok && !detail) detail = 'le code doit respecter ' + t.value;
                break;
            }
            case 'html_not_regex':
            case 'code_not_regex': {
                try { ok = !(new RegExp(t.value, t.flags || 'i').test(code)); }
                catch (err) { ok = false; detail = 'motif de test invalide'; }
                if (!ok && !detail) detail = 'le code ne doit pas contenir le motif ' + t.value;
                break;
            }
            case 'code_contains': {
                ok = code.toLowerCase().replace(/\s+/g, ' ').indexOf(String(t.value).toLowerCase()) !== -1;
                detail = ok ? '' : 'le code doit contenir « ' + t.value + ' »';
                break;
            }
            case 'code_not_contains': {
                ok = code.toLowerCase().replace(/\s+/g, ' ').indexOf(String(t.value).toLowerCase()) === -1;
                detail = ok ? '' : 'le code ne doit pas contenir « ' + t.value + ' »';
                break;
            }
            case 'code_regex': {
                try { ok = new RegExp(t.value, t.flags || 'i').test(code); }
                catch (err) { ok = false; detail = 'motif de test invalide'; }
                if (!ok && !detail) detail = 'le code doit respecter ' + t.value;
                break;
            }
            case 'sql_ok': {
                ok = !!res.ok;
                detail = ok ? '' : (res.error || 'la requête SQL ne s’est pas exécutée');
                break;
            }
            case 'result_has': {
                if (!res.ok) { detail = res.error || 'requête invalide'; break; }
                const wanted = Array.isArray(t.value) ? t.value : [t.value];
                const rows = (res.rows || []).map(r => Object.values(r).map(norm).join(' | '));
                ok = rows.some(row => wanted.every(w => row.indexOf(norm(w)) !== -1));
                detail = ok ? '' : 'aucun résultat ne contient [' + wanted.join(', ') + ']';
                break;
            }
            case 'result_lacks': {
                if (!res.ok) { ok = true; break; }
                const rows = (res.rows || []).map(r => Object.values(r).map(norm).join(' | '));
                const wanted = Array.isArray(t.value) ? t.value : [t.value];
                ok = !rows.some(row => wanted.every(w => row.indexOf(norm(w)) !== -1));
                detail = ok ? '' : 'le résultat ne doit pas contenir [' + wanted.join(', ') + ']';
                break;
            }
            case 'row_count': {
                if (!res.ok) { detail = res.error || 'requête invalide'; break; }
                const count = Number(res.rowCount || 0);
                ok = compare(count, t.op || '==', Number(t.value));
                detail = ok ? '' : (t.message || count + ' ligne(s) au lieu de ' + (t.op || '==') + ' ' + t.value);
                break;
            }
            default:
                detail = 'type de test inconnu : ' + t.type;
        }
        return { ok, detail, test: t };
    }

    function exerciseSection(data) {
        const ex = data.exercise;
        const key = data.key;
        if (!ex || !Array.isArray(ex.levels) || !ex.levels.length) return null;
        if (!exerciseState[key]) {
            exerciseState[key] = {
                level: ex.levels[0].level,
                passed: {},
                hints: {},
                solutions: {}
            };
        }
        const st = exerciseState[key];
        if (!ex.levels.some(l => l.level === st.level)) st.level = ex.levels[0].level;

        // Vérifier si le niveau actuel est en mode statique (ex: Oracle)
        const currentLv = ex.levels.find(l => l.level === st.level);
        const isStatic = !!(currentLv && currentLv.static);

        const box = h('section.wa-ex', { id: 'sec-exercices', 'aria-labelledby': 'wa-ex-title' });
        box.appendChild(h('div.exhead', {},
            badge('info', 'Exercices'),
            h('b', { id: 'wa-ex-title' }, ex.title || 'Exercices du chapitre'),
            h('span', {}, ex.brief || '')));
        const body = h('div.exbody');
        box.appendChild(body);

        const levels = h('div.wa-levels', { role: 'group', 'aria-label': 'Niveaux d’exercice' });
        const content = h('div');
        body.appendChild(levels);
        body.appendChild(content);

        function paintLevels() {
            levels.innerHTML = '';
            ex.levels.forEach(lv => {
                const on = lv.level === st.level;
                // Pour les modules en mode statique, griser les niveaux non actuels
                const disabled = isStatic && st.level !== lv.level;
                levels.appendChild(h('button', {
                    type: 'button',
                    class: on ? 'on' : '',
                    'aria-pressed': on ? 'true' : 'false',
                    onclick: () => { st.level = lv.level; paintLevels(); paint(); },
                    disabled: disabled
                }, 'Niveau ' + lv.level + ' — ' + (lv.title || 'Exercice') + (st.passed[lv.level] ? ' ✓' : '')));
            });
        }

        function paint() {
            const lv = ex.levels.find(l => l.level === st.level);
            content.innerHTML = '';
            if (!lv) return;

            // Affichage des consignes
            const consignes = h('div', { style: 'margin-bottom:10px' },
                h('div', { style: 'font-family:var(--font-mono);font-size:9.5px;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-bottom:5px' }, 'Consignes'),
                lv.instructions ? h('div', { html: lv.instructions }) : null,
                lv.instructionsDarija ? h('div.wa-darija', {},
                    h('span.flag', {}, 'Darija'),
                    h('div', { html: lv.instructionsDarija })) : null);

            content.appendChild(consignes);

            // Si le mode est statique, afficher un message au lieu du bouton Vérifier
            if (isStatic) {
                const staticMsg = h('div.wa-callout.note', {},
                    h('div.ttl', {}, icon('info', 15), 'Exercice en mode lecture'),
                    h('p', {}, 'Cet exercice est en mode lecture seule. Les réponses et la correction sont affichées ci-dessous.'),
                    h('pre.wa-console', { style: 'margin:8px 0', textContent: lv.solution || 'Aucune solution disponible.' }));
                content.appendChild(staticMsg);
                // Afficher les indices et la correction même s'ils ne sont pas encore consultés
                if (st.hints[lv.level]) {
                    const list = h('div.hints');
                    (lv.hints || []).slice(0, st.hints[lv.level]).forEach((hint, i) => {
                        list.appendChild(h('div.hint', {}, h('b', {}, 'Indice ' + (i + 1) + ' — '), hint));
                    });
                    content.appendChild(list);
                }
                if (st.solutions[lv.level]) {
                    const sol = h('div.solution', {},
                        codeBlock(lv.solution || '', exerciseLang(data, lv), 'Corrigé'),
                        lv.explainFr ? h('p', { style: 'margin-top:10px', html: lv.explainFr }) : null,
                        lv.explainDarija ? h('div.wa-darija', {}, h('span.flag', {}, 'Darija'), h('div', { html: lv.explainDarija })) : null);
                    content.appendChild(sol);
                } else {
                    // Bouton pour afficher la correction
                    const showSolBtn = h('button.wa-btn.ghost', { type: 'button', onclick: async () => {
                        if (!st.solutions[lv.level]) {
                            const ok = await WA.ui.ask('La correction s’affichera sous l’exercice. Essayez d’abord de résoudre le niveau par vous-même.', {
                                title: 'Voir la correction ?',
                                confirmLabel: 'Afficher la correction'
                            });
                            if (!ok) return;
                            st.solutions[lv.level] = true;
                        }
                        const sol = h('div.solution', {},
                            codeBlock(lv.solution || '', exerciseLang(data, lv), 'Corrigé'),
                            lv.explainFr ? h('p', { style: 'margin-top:10px', html: lv.explainFr }) : null,
                            lv.explainDarija ? h('div.wa-darija', {}, h('span.flag', {}, 'Darija'), h('div', { html: lv.explainDarija })) : null);
                        content.appendChild(sol);
                    } }, icon('eye', 15), 'Afficher la correction');
                    content.appendChild(showSolBtn);
                }
                // Toujours montrer l'indice par défaut
                if (lv.hints && !(lv.hints || []).length) {
                    content.appendChild(h('div.hint', {}, 'Relisez les exemples du chapitre : tous les éléments nécessaires y figurent.'));
                }
                // Créer l'éditeur quand même (pour afficher le code)
                const editorHost = h('div.editorhost-mini');
                const editor = WA.editor.create(editorHost, {
                    lang: exerciseLang(data, lv),
                    value: lv.starter || '',
                    label: 'Éditeur de l’exercice — niveau ' + lv.level,
                    describedby: 'wa-ex-instructions'
                });
                content.appendChild(editorHost);
                return;
            }

            // Sinon, affichage normal avec édition et vérification
            const editorHost = h('div.editorhost-mini');
            const editor = WA.editor.create(editorHost, {
                lang: exerciseLang(data, lv),
                value: lv.starter || '',
                label: 'Éditeur de l’exercice — niveau ' + lv.level,
                describedby: 'wa-ex-instructions'
            });
            content.appendChild(editorHost);

            const zone = h('div', { 'aria-live': 'polite' });
            content.appendChild(zone);

            const verifyBtn = h('button.wa-btn.primary', { type: 'button' }, icon('play', 15), 'Vérifier mon code');
            const resetBtn = h('button.wa-btn', { type: 'button', onclick: () => {
                editor.setValue(lv.starter || '');
                zone.innerHTML = '';
                editor.focus();
            } }, icon('refresh', 15), 'Réinitialiser');
            const hintBtn = h('button.wa-btn.ghost', { type: 'button', onclick: () => showHint(lv, content) }, icon('bulb', 15), 'Indice');
            const solutionBtn = h('button.wa-btn.ghost', { type: 'button', onclick: async () => {
                if (!st.solutions[lv.level]) {
                    const ok = await WA.ui.ask('La correction s’affichera sous l’exercice. Essayez d’abord de résoudre le niveau par vous-même.', {
                        title: 'Voir la correction ?',
                        confirmLabel: 'Afficher la correction'
                    });
                    if (!ok) return;
                    st.solutions[lv.level] = true;
                }
                showSolution(lv, content);
            } }, icon('eye', 15), 'Correction');

            const previewBtn = (lv.lang === 'html')
                ? h('button.wa-btn.ghost', { type: 'button', onclick: () => previewExercise(editor.getValue(), zone) }, icon('eye', 15), 'Aperçu')
                : null;

            verifyBtn.addEventListener('click', () => verify(lv, editor.getValue(), zone, verifyBtn));
            content.appendChild(h('div.wa-btn-row', { style: 'margin-top:10px' },
                verifyBtn, resetBtn, previewBtn, hintBtn, solutionBtn));

            editorHost.addEventListener('keydown', ev => {
                if ((ev.ctrlKey || ev.metaKey) && ev.key === 'Enter') {
                    ev.preventDefault();
                    verify(lv, editor.getValue(), zone, verifyBtn);
                }
            });

            if (st.solutions[lv.level]) showSolution(lv, content);
            if (st.hints[lv.level]) {
                const list = h('div.hints');
                (lv.hints || []).slice(0, st.hints[lv.level]).forEach((hint, i) => {
                    list.appendChild(h('div.hint', {}, h('b', {}, 'Indice ' + (i + 1) + ' — '), hint));
                });
                content.appendChild(list);
            }
        }

        async function verify(lv, code, zone, btn) {
            const lang = String(exerciseLang(data, lv)).toLowerCase();
            const isJs = lang === 'javascript' || lang === 'js';
            btn.disabled = true;
            zone.innerHTML = '';
            zone.appendChild(h('div.wa-statusline', {}, isJs ? 'Exécution dans la sandbox…' : 'Exécution et vérification…'));
            let res;
            try {
                res = await executeExercise(ex, lv, code);
            } catch (err) {
                zone.innerHTML = '';
                zone.appendChild(h('div.verdict.fail', {}, '⚠ ' + (err.message || 'Exécution impossible.')));
                btn.disabled = false;
                return;
            }

            let outcomes;
            if (isJs && Array.isArray(res.results) && res.results.length) {
                outcomes = res.results.map((r, i) => ({
                    ok: !!r.ok,
                    detail: r.ok ? '' : (r.detail || (lv.tests && lv.tests[i] && lv.tests[i].message) || 'résultat non conforme'),
                    test: (lv.tests || [])[i]
                }));
            } else {
                outcomes = (lv.tests || []).map(t => testOutcome(t, res, code));
            }
            const allPass = outcomes.length > 0 && outcomes.every(o => o.ok);
            zone.innerHTML = '';

            if (lang === 'php') {
                const pre = h('pre.wa-console', { tabindex: '0', 'aria-label': 'Sortie de l’exécution PHP' });
                pre.textContent = res.output || (res.error ? '' : '(aucune sortie)');
                if (res.error) pre.appendChild(h('div.errline', {}, res.error));
                if (res.stderr) pre.appendChild(h('div.errline', {}, res.stderr));
                zone.appendChild(pre);
            } else if (lang === 'html') {
                zone.appendChild(previewFrame(code, 'Aperçu réel de votre code'));
            } else if (lang === 'sql') {
                if (!res.ok) {
                    zone.appendChild(h('div.verdict.fail', {}, res.error || 'Erreur SQL'));
                } else {
                    zone.appendChild(sqlResultTable(res));
                    if (res.message) zone.appendChild(h('div.wa-sql-note', {}, res.message));
                }
            } else if (isJs) {
                const pre = h('pre.wa-console', { tabindex: '0', 'aria-label': 'Console JavaScript' });
                pre.textContent = res.output || '(aucune sortie console)';
                if (res.error) pre.appendChild(h('div.errline', {}, res.error));
                zone.appendChild(pre);
                zone.appendChild(h('div.wa-sql-note', {}, 'Exécution réelle dans un iframe sandbox isolé. Le délai maximal est de 4,5 s.'));
            } else if (lang === 'cpp') {
                zone.appendChild(h('div.wa-callout.warning', { style: 'margin:0' },
                    h('div.ttl', {}, icon('shield', 15), 'Vérification statique — pas de compilation serveur'),
                    h('p', { style: 'margin:0' }, 'Pour des raisons de sécurité, le code C++ n’est pas compilé sur le serveur. Les tests vérifient la présence des éléments demandés. Compilez localement avec g++ pour valider le comportement réel :'),
                    h('pre.wa-console', { style: 'margin-top:8px' }, 'g++ -std=c++17 main.cpp -o main\n./main        # Linux / macOS\n.\\main.exe   # Windows')));
            }

            outcomes.forEach(o => {
                zone.appendChild(h('div.verdict.' + (o.ok ? 'pass' : 'fail'), {},
                    (o.ok ? '✓ ' : '✗ ') + (o.ok ? 'Vérification réussie' : 'Vérification : ' + (o.detail || 'non conforme'))));
            });

            if (!outcomes.length) {
                zone.appendChild(h('div.verdict.fail', {}, 'Aucun test n’est défini pour ce niveau.'));
            }

            if (allPass && !st.passed[lv.level]) {
                st.passed[lv.level] = true;
                paintLevels();
                try {
                    const progress = await WA.api.post('exercise-done', { key: data.key, level: lv.level, passed: true });
                    WA.app.applyProgress(progress);
                } catch (err) { /* la réussite reste affichée localement */ }
                toast('Niveau ' + lv.level + ' validé.', 'ok');
            }
            btn.disabled = false;
        }

        function showHint(lv, host) {
            st.hints[lv.level] = (st.hints[lv.level] || 0) + 1;
            const list = host.querySelector('.hints') || host.appendChild(h('div.hints'));
            list.innerHTML = '';
            (lv.hints || []).slice(0, st.hints[lv.level]).forEach((hint, i) => {
                list.appendChild(h('div.hint', {}, h('b', {}, 'Indice ' + (i + 1) + ' — '), hint));
            });
            if (!(lv.hints || []).length) {
                list.appendChild(h('div.hint', {}, 'Relisez les exemples du chapitre : tous les éléments nécessaires y figurent.'));
            }
        }

        function showSolution(lv, host) {
            const old = host.querySelector('.solution');
            if (old) old.remove();
            const sol = h('div.solution', {},
                codeBlock(lv.solution || '', exerciseLang(data, lv), 'Corrigé'),
                lv.explainFr ? h('p', { style: 'margin-top:10px', html: lv.explainFr }) : null,
                lv.explainDarija ? h('div.wa-darija', {}, h('span.flag', {}, 'Darija'), h('div', { html: lv.explainDarija })) : null);
            host.appendChild(sol);
        }

        function previewExercise(code, zone) {
            zone.innerHTML = '';
            zone.appendChild(previewFrame(code, 'Aperçu de votre code'));
        }

        paintLevels();
        paint();
        return box;
    }

    function sqlResultTable(res) {
        const wrap = h('div.wa-outtable');
        const table = h('table.wa-sqltable');
        if (Array.isArray(res.columns) && res.columns.length) {
            table.appendChild(h('thead', {}, h('tr', {}, res.columns.map(c => h('th', { scope: 'col' }, c)))));
        }
        const tbody = h('tbody');
        (res.rows || []).slice(0, 50).forEach(row => {
            tbody.appendChild(h('tr', {}, Object.values(row).map(v => h('td', {}, v))));
        });
        table.appendChild(tbody);
        wrap.appendChild(table);
        const box = h('div', {}, wrap);
        if ((res.rows || []).length > 50) {
            box.appendChild(h('div.wa-sql-note', {}, 'Affichage limité aux 50 premières lignes.'));
        }
        return box;
    }

    /* ------------------------------------------------------------ page */

    function unavailable(params) {
        const mod = moduleOf({ module: params.module });
        const list = [];
        const availability = (WA.app.data('availability') || {})[params.module] || {};
        (mod.chapters || []).forEach(c => {
            if (availability[c.n]) list.push({ module: params.module, ch: c.n, title: c.title });
        });
        const box = h('div.wa-empty-state', {},
            h('div.wa-empty-icon', {}, icon('book', 26)),
            h('h1', {}, 'Chapitre pas encore rédigé'),
            h('p', {}, 'Le chapitre ' + params.ch + ' du module ' + mod.name + ' figure au programme, mais son contenu n’est pas encore publié. Aucun texte de remplacement n’est affiché.'),
            h('div.wa-btn-row', {},
                list.length ? h('a.wa-btn.primary', { href: lessonRoute(params.module, list[0].ch) }, 'Ouvrir le premier chapitre disponible') : null,
                h('a.wa-btn', { href: '#/lab/' + params.module }, icon('flask', 15), 'Atelier ' + mod.name),
                h('a.wa-btn.ghost', { href: '#/progress' }, 'Voir la progression')));
        if (list.length > 1) {
            const more = h('div.wa-recent', { style: 'margin-top:26px;text-align:left' });
            list.forEach(l => more.appendChild(h('a.wa-recent-row', { href: lessonRoute(l.module, l.ch) },
                icon('book', 15), h('span', {}, 'Ch. ' + l.ch + ' — ' + l.title), badge('info', 'Disponible'))));
            box.appendChild(more);
        }
        return box;
    }

    async function render(params) {
        if (tocObserver) { tocObserver.disconnect(); tocObserver = null; }
        let data;
        try {
            data = await WA.api.get('lesson', { module: params.module, ch: params.ch });
        } catch (err) {
            if (err.status === 404) return unavailable(params);
            throw err;
        }

        const ch = data.lesson.chapter;
        const mod = moduleOf(data.lesson);
        const meta = chapterMeta(data.lesson);
        const key = data.lesson.key;
        const done = data.progress && data.progress.status === 'done';
        let bookmarked = (data.bookmarks || []).indexOf(key) !== -1;

        document.title = (meta.title || ch.title) + ' — ' + mod.name + ' — WebAcademy';

        const root = h('article', {});
        const head = h('header.wa-lesson-head', {});
        head.appendChild(h('div.wa-overline', {}, mod.name + ' · Chapitre ' + data.lesson.ch));
        head.appendChild(h('h1.wa-page-title', {}, ch.title || meta.title));
        if (ch.subtitle) head.appendChild(h('p.wa-lesson-sub', {}, ch.subtitle));
        const statusBadge = badge(done ? 'ok' : 'warn', done ? 'Terminé' : 'À lire');
        head.appendChild(h('div.wa-lesson-meta', {},
            ch.level ? h('span', {}, icon('chart', 14), ch.level) : null,
            h('span', {}, icon('clock', 14), readingMinutes(ch) + ' min de lecture'),
            h('span', {}, icon('list', 14), (ch.lessons || []).length + ' sections'),
            h('span', {}, icon('target', 14), ((data.lesson.exercise && Array.isArray(data.lesson.exercise.levels) ? data.lesson.exercise.levels.length : 0) || 0) + ' exercices'),
            h('span', {}, statusBadge),
            data.lastQuiz ? h('span', {}, icon('target', 14), 'Dernier quiz : ' + data.lastQuiz.score + '/' + data.lastQuiz.total) : null));
        if (Array.isArray(ch.prerequisites) && ch.prerequisites.length) {
            head.appendChild(h('div.wa-lesson-prereq', {},
                h('span.wa-prereq-label', {}, 'Prérequis'),
                h('span', {}, ch.prerequisites.join(' · '))));
        }
        root.appendChild(head);

        const doneBtn = h('button.wa-btn' + (done ? '' : '.primary'), {
            type: 'button',
            'aria-pressed': done ? 'true' : 'false'
        }, icon(done ? 'undo' : 'check', 15), h('span', {}, done ? 'Marquer non terminé' : 'Marquer comme terminé'));
        const favBtn = h('button.wa-btn.ghost', {
            type: 'button',
            'aria-pressed': bookmarked ? 'true' : 'false'
        }, icon('star', 15), h('span', {}, bookmarked ? 'Dans les favoris' : 'Ajouter aux favoris'));

        doneBtn.addEventListener('click', async () => {
            const next = doneBtn.getAttribute('aria-pressed') !== 'true';
            doneBtn.disabled = true;
            try {
                await WA.app.setLessonDone(key, next);
                doneBtn.setAttribute('aria-pressed', next ? 'true' : 'false');
                doneBtn.classList.toggle('primary', !next);
                doneBtn.innerHTML = '';
                doneBtn.appendChild(icon(next ? 'undo' : 'check', 15));
                doneBtn.appendChild(h('span', {}, next ? 'Marquer non terminé' : 'Marquer comme terminé'));
                statusBadge.textContent = next ? 'Terminé' : 'À lire';
                statusBadge.className = 'wa-badge ' + (next ? 'ok' : 'warn');
                toast(next ? 'Chapitre marqué comme terminé.' : 'Chapitre remis en cours.', 'ok');
            } catch (err) {
                toast(err.message, 'err');
            } finally {
                doneBtn.disabled = false;
            }
        });

        favBtn.addEventListener('click', async () => {
            favBtn.disabled = true;
            try {
                const added = await WA.app.toggleBookmark(key);
                bookmarked = added;
                favBtn.setAttribute('aria-pressed', added ? 'true' : 'false');
                favBtn.innerHTML = '';
                favBtn.appendChild(icon('star', 15));
                favBtn.appendChild(h('span', {}, added ? 'Dans les favoris' : 'Ajouter aux favoris'));
                toast(added ? 'Ajouté aux favoris.' : 'Retiré des favoris.', 'ok');
            } catch (err) {
                toast(err.message, 'err');
            } finally {
                favBtn.disabled = false;
            }
        });

        const toolbar = h('div.wa-lesson-toolbar', {},
            h('div.wa-btn-row', {}, doneBtn, favBtn),
            isLabModule(data.lesson.module)
                ? h('div.wa-btn-row', {},
                    h('a.wa-btn.ghost', { href: '#/lab/' + data.lesson.module }, icon('flask', 15), 'Atelier ' + mod.name),
                    h('button.wa-btn.ghost', { type: 'button', onclick: () => window.print() }, icon('download', 15), 'Imprimer'))
                : null);
        root.appendChild(toolbar);

        const layout = h('div.wa-lesson-layout');
        const body = h('div.wa-lesson-body');
        const rail = h('aside.wa-lesson-rail', { 'aria-label': 'Repères du chapitre' });

        if (ch.objectives && ch.objectives.length) {
            rail.appendChild(h('section.wa-rail-card', {},
                h('h2', {}, 'Objectifs'),
                h('ul.wa-objectives', {}, ch.objectives.map(o => h('li', {}, o)))));
        }

        const sections = ch.lessons || [];
        if (sections.length) {
            const toc = h('nav.wa-rail-card.wa-toc', { 'aria-label': 'Sommaire du chapitre' },
                h('div.wa-toc-title', {}, icon('list', 14), 'Sommaire'),
                h('ol', {}, sections.map((lsn, i) => h('li', {},
                    h('a', {
                        href: lessonRoute(data.lesson.module, data.lesson.ch, lsn.id),
                        'data-target': 'sec-' + lsn.id,
                        onclick: ev => {
                            ev.preventDefault();
                            const target = document.getElementById('sec-' + lsn.id);
                            if (!target) return;
                            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                            try {
                                history.replaceState(null, '', lessonRoute(data.lesson.module, data.lesson.ch, lsn.id));
                            } catch (err) { /* URL non modifiable */ }
                            toc.querySelectorAll('a').forEach(a => a.classList.remove('active'));
                            ev.currentTarget.classList.add('active');
                        }
                    }, h('span.n', {}, String(i + 1).padStart(2, '0')), h('span', {}, lsn.title))))));
            rail.appendChild(toc);
        }

        if (data.lesson.exercise || data.lesson.quiz) {
            const jump = h('section.wa-rail-card', {});
            jump.appendChild(h('h2', {}, 'Évaluation'));
            const list = h('div', { style: 'display:grid;gap:6px' });
            if (data.lesson.exercise) list.appendChild(h('a.wa-btn.small', { href: '#sec-exercices' }, icon('terminal', 14), 'Exercices'));
            if (data.lesson.quiz) list.appendChild(h('a.wa-btn.small', { href: '#sec-quiz' }, icon('target', 14), 'Quiz du chapitre'));
            jump.appendChild(list);
            rail.appendChild(jump);
        }

        sections.forEach(lsn => {
            const sec = h('section', { id: 'sec-' + lsn.id });
            sec.appendChild(h('h2.wa-section-title', {},
                h('span', { 'aria-hidden': 'true', style: 'font-size:20px' }, lsn.icon || ''),
                h('span', {}, lsn.title)));
            (lsn.blocks || []).forEach(b => {
                const node = renderBlock(b);
                if (node) sec.appendChild(node);
            });
            body.appendChild(sec);
        });

        const mistakes = mistakesBlock(ch.mistakes);
        if (mistakes) body.appendChild(mistakes);
        const summary = summaryBlock(ch.summary);
        if (summary) body.appendChild(summary);
        if (data.lesson.exercise) {
            const ex = exerciseSection({ exercise: data.lesson.exercise, key, module: data.lesson.module });
            if (ex) body.appendChild(ex);
        }
        if (data.lesson.quiz) {
            body.appendChild(WA.quiz.render({
                quiz: data.lesson.quiz,
                key,
                lesson: data.lesson,
                lastQuiz: data.lastQuiz
            }));
        }

        const idx = WA.app.navIndex(data.lesson.module, data.lesson.ch);
        body.appendChild(h('nav.wa-navbottom', { 'aria-label': 'Navigation entre les chapitres' },
            idx.prev ? h('a.wa-btn', { href: lessonRoute(data.lesson.module, idx.prev) },
                icon('arrowLeft', 15), h('span', {}, 'Ch. ' + idx.prev + ' — ' + idx.prevTitle)) : h('span'),
            h('div', {},
                h('a.wa-btn.ghost', { href: '#/lab/' + data.lesson.module }, icon('flask', 15), 'Atelier'),
                idx.next ? h('a.wa-btn.primary', { href: lessonRoute(data.lesson.module, idx.next) },
                    h('span', {}, 'Ch. ' + idx.next + ' — ' + idx.nextTitle), icon('arrowRight', 15)) : null)));

        layout.appendChild(body);
        layout.appendChild(rail);
        root.appendChild(layout);

        // Suivi de la section visible pour le sommaire.
        requestAnimationFrame(() => {
            if (typeof IntersectionObserver !== 'function') return;
            const links = rail.querySelectorAll('.wa-toc a');
            tocObserver = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (!entry.isIntersecting) return;
                    const id = entry.target.id;
                    links.forEach(a => {
                        const on = a.getAttribute('data-target') === id;
                        a.classList.toggle('active', on);
                        if (on) a.setAttribute('aria-current', 'true');
                        else a.removeAttribute('aria-current');
                    });
                });
            }, { rootMargin: '-18% 0px -68% 0px', threshold: 0 });
            sections.forEach(lsn => {
                const sec = document.getElementById('sec-' + lsn.id);
                if (sec) tocObserver.observe(sec);
            });
        });

        return root;
    }

    return { render };
})();
