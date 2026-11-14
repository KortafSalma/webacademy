/* WebAcademy — quiz de fin de chapitre (choix, saisie, SQL réel). */
WA.quiz = (function () {
    const { h, badge, toast, icon } = WA.ui;

    function normalizeAnswer(value) {
        return String(value == null ? '' : value)
            .toLowerCase()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .replace(/[.!?;:,]+$/g, '')
            .replace(/\s+/g, ' ')
            .trim();
    }

    function sameSet(a, b) {
        const left = (Array.isArray(a) ? a : []).map(Number).sort((x, y) => x - y);
        const right = (Array.isArray(b) ? b : []).map(Number).sort((x, y) => x - y);
        return left.length === right.length && left.every((v, i) => v === right[i]);
    }

    function sqlOutcome(test, res) {
        if (!test) return { ok: !!res.ok, detail: res.error || '' };
        switch (test.type) {
            case 'sql_ok':
                return { ok: !!res.ok, detail: res.ok ? '' : (res.error || 'la requête ne s’exécute pas') };
            case 'result_has': {
                if (!res.ok) return { ok: false, detail: res.error || 'requête invalide' };
                const wanted = Array.isArray(test.value) ? test.value : [test.value];
                const rows = (res.rows || []).map(r => Object.values(r).map(normalizeAnswer).join(' | '));
                const ok = rows.some(row => wanted.every(w => row.indexOf(normalizeAnswer(w)) !== -1));
                return { ok, detail: ok ? '' : 'le résultat attendu est absent' };
            }
            case 'result_lacks': {
                if (!res.ok) return { ok: true, detail: '' };
                const rows = (res.rows || []).map(r => Object.values(r).map(normalizeAnswer).join(' | '));
                const unwanted = Array.isArray(test.value) ? test.value : [test.value];
                const ok = !rows.some(row => unwanted.every(w => row.indexOf(normalizeAnswer(w)) !== -1));
                return { ok, detail: ok ? '' : 'le résultat ne doit pas contenir ces valeurs' };
            }
            case 'row_count': {
                if (!res.ok) return { ok: false, detail: res.error || 'requête invalide' };
                const count = Number(res.rowCount || 0);
                const value = Number(test.value);
                const op = test.op || '==';
                let ok = false;
                if (op === '==') ok = count === value;
                else if (op === '>=') ok = count >= value;
                else if (op === '<=') ok = count <= value;
                else if (op === '>') ok = count > value;
                else if (op === '<') ok = count < value;
                else if (op === '!=') ok = count !== value;
                return { ok, detail: ok ? '' : count + ' ligne(s) au lieu de ' + op + ' ' + value };
            }
            default:
                return { ok: false, detail: 'test SQL inconnu' };
        }
    }

    function questionKind(q) {
        if (q.type === 'multi') return 'multi';
        if (q.type === 'fill') return 'fill';
        if (q.type === 'sql') return 'sql';
        if (q.type === 'tf' || q.type === 'true_false') return 'tf';
        return 'single';
    }

    function render(data) {
        const quiz = data.quiz;
        const key = data.key;
        const questions = quiz.questions || [];

        let state = freshState();
        let submitting = false;

        function freshState() {
            return {
                answers: questions.map(() => null),
                submitted: false,
                results: []
            };
        }

        const section = h('section.wa-quiz', { id: 'sec-quiz', 'aria-labelledby': 'wa-quiz-title' });
        const head = h('div.wa-section-head', { style: 'margin-top:0' },
            h('div', {},
                h('div', { style: 'margin-bottom:8px' }, badge('accent', 'Quiz')),
                h('h2#wa-quiz-title', { style: 'margin:0' }, quiz.title || 'Quiz du chapitre')),
            h('span.wa-meta', {}, questions.length + ' questions' + (data.lastQuiz ? ' · dernier score ' + data.lastQuiz.score + '/' + data.lastQuiz.total : '')));
        section.appendChild(head);

        const body = h('div');
        const actions = h('div');
        const after = h('div', { 'aria-live': 'polite' });
        section.appendChild(body);
        section.appendChild(actions);
        section.appendChild(after);

        function optionsFor(q) {
            if (q.type === 'tf') return ['Vrai', 'Faux'];
            if (q.type === 'true_false') return ['Faux', 'Vrai'];
            return Array.isArray(q.options) ? q.options : [];
        }

        function correctIndexes(q) {
            if (q.type === 'multi') return Array.isArray(q.answer) ? q.answer.map(Number) : [];
            if (typeof q.answer === 'number') return [q.answer];
            return [];
        }

        function expectedText(q) {
            if (q.type === 'fill') {
                return String(q.expected != null ? q.expected : (q.answer != null ? q.answer : ''));
            }
            if (q.type === 'sql') return q.solution || '';
            const opts = optionsFor(q);
            const idx = correctIndexes(q);
            return idx.map(i => opts[i]).filter(Boolean).join(' · ');
        }

        function answerIsComplete(q, answer) {
            if (q.type === 'multi') return Array.isArray(answer) && answer.length > 0;
            if (q.type === 'sql') return typeof answer === 'string' && answer.trim() !== '';
            if (q.type === 'fill') return typeof answer === 'string' && answer.trim() !== '';
            return typeof answer === 'number';
        }

        function paint() {
            body.innerHTML = '';
            actions.innerHTML = '';
            after.innerHTML = '';

            questions.forEach((q, qi) => {
                const card = h('fieldset.wa-quizq', {});
                const legend = h('legend.wa-sr-only', {}, 'Question ' + (qi + 1));
                card.appendChild(legend);

                const board = h('div.qboard', {},
                    h('span.qn', {}, 'Q' + String(qi + 1).padStart(2, '0')),
                    h('span', { html: q.question || '' }));
                card.appendChild(board);
                if (q.concept) card.appendChild(h('span.tag', {}, q.concept));
                if (q.codeText) card.appendChild(WA.ui.codeBlock(q.codeText, q.lang || 'text', 'Extrait'));

                const kind = questionKind(q);
                const result = state.results[qi];
                const answer = state.answers[qi];

                if (kind === 'single' || kind === 'tf' || kind === 'multi') {
                    const opts = optionsFor(q);
                    const list = h('div.wa-quizopts');
                    opts.forEach((opt, oi) => {
                        const input = h('input', {
                            type: kind === 'multi' ? 'checkbox' : 'radio',
                            name: 'wa-q-' + qi,
                            value: String(oi),
                            id: 'wa-q-' + qi + '-' + oi,
                            checked: kind === 'multi'
                                ? (Array.isArray(answer) && answer.indexOf(oi) !== -1 ? '' : null)
                                : (answer === oi ? '' : null),
                            disabled: state.submitted ? '' : null,
                            onchange: () => {
                                if (kind === 'multi') {
                                    const current = Array.isArray(state.answers[qi]) ? state.answers[qi].slice() : [];
                                    const at = current.indexOf(oi);
                                    if (at === -1) current.push(oi);
                                    else current.splice(at, 1);
                                    state.answers[qi] = current;
                                } else {
                                    state.answers[qi] = oi;
                                }
                            }
                        });
                        const label = h('label', { for: input.id },
                            input,
                            h('span', { html: opt }));
                        if (state.submitted) {
                            const good = correctIndexes(q).indexOf(oi) !== -1;
                            const picked = kind === 'multi'
                                ? Array.isArray(answer) && answer.indexOf(oi) !== -1
                                : answer === oi;
                            if (good) label.classList.add('good');
                            else if (picked) label.classList.add('bad');
                        }
                        list.appendChild(label);
                    });
                    card.appendChild(list);
                } else if (kind === 'fill') {
                    const input = h('input.wa-input', {
                        type: 'text',
                        id: 'wa-q-' + qi,
                        value: typeof answer === 'string' ? answer : '',
                        autocomplete: 'off',
                        disabled: state.submitted ? '' : null,
                        placeholder: 'Votre réponse…',
                        oninput: ev => { state.answers[qi] = ev.target.value; }
                    });
                    card.appendChild(h('div.wa-field', {},
                        h('label', { for: input.id }, 'Réponse'),
                        input));
                } else if (kind === 'sql') {
                    const ta = h('textarea.wa-textarea', {
                        id: 'wa-q-' + qi,
                        rows: '4',
                        spellcheck: 'false',
                        disabled: state.submitted ? '' : null,
                        placeholder: '-- Écrivez votre requête SQL',
                        oninput: ev => { state.answers[qi] = ev.target.value; }
                    });
                    ta.value = typeof answer === 'string' ? answer : '';
                    card.appendChild(h('div.wa-field', {},
                        h('label', { for: ta.id }, 'Requête SQL (' + (q.dialect || 'sqlite') + ')'),
                        ta));
                }

                if (state.submitted && result) {
                    const explanation = q.explainFr || q.explainDarija || '';
                    const expected = expectedText(q);
                    const exp = h('div.exp.' + (result.ok ? 'right' : 'wrong'));
                    exp.appendChild(h('div', {},
                        h('b', {}, result.ok ? '✓ Correct. ' : '✗ Réponse incorrecte. '),
                        expected ? h('span', {}, 'Réponse attendue : ' + expected) : null));
                    if (result.detail) exp.appendChild(h('div', { style: 'margin-top:4px' }, result.detail));
                    if (explanation) exp.appendChild(h('div', { style: 'margin-top:6px', html: explanation }));
                    if (q.explainDarija) {
                        exp.appendChild(h('div.wa-darija', {
                            style: 'margin:7px 0 0;padding:8px 10px;font-size:12.5px'
                        }, h('span.flag', {}, 'Darija'), h('div', { html: q.explainDarija })));
                    }
                    card.appendChild(exp);
                }

                body.appendChild(card);
            });

            if (state.submitted) {
                const score = state.results.filter(r => r.ok).length;
                const total = questions.length;
                const pct = total ? Math.round((score / total) * 100) : 0;
                const afterBox = h('div.wa-quizafter', {},
                    h('h3', {}, 'Résultat : ' + score + ' / ' + total + ' — ' + pct + ' %'),
                    h('p', { style: 'color:var(--muted);margin:0' },
                        pct >= 80 ? 'Excellent. Vous pouvez passer au chapitre suivant.' :
                        pct >= 50 ? 'Les bases sont là. Relisez les explications des questions manquées.' :
                        'Reprenez la leçon puis retentez le quiz : les corrections sont affichées ci-dessus.'),
                    h('div.wa-btn-row', { style: 'margin-top:14px' },
                        h('button.wa-btn.primary', {
                            type: 'button',
                            onclick: () => {
                                state = freshState();
                                paint();
                                const first = body.querySelector('input, textarea');
                                if (first) first.focus();
                            }
                        }, icon('refresh', 15), 'Recommencer'),
                        h('a.wa-btn', { href: '#/lesson/' + data.lesson.module + '/' + data.lesson.ch + '~sec-resume' }, 'Relire le résumé')));
                after.appendChild(afterBox);
                return;
            }

            const submit = h('button.wa-btn.primary', { type: 'submit' }, icon('check', 15), 'Valider le quiz');
            actions.appendChild(h('div.wa-btn-row', { style: 'margin-top:18px' }, submit,
                h('span', { style: 'color:var(--muted);font-size:12px' }, 'Une seule tentative par validation ; vous pourrez recommencer ensuite.')));
        }

        const form = h('form', { novalidate: 'novalidate' });
        form.appendChild(body);
        form.appendChild(actions);
        form.appendChild(after);
        section.innerHTML = '';
        section.appendChild(head);
        section.appendChild(form);

        form.addEventListener('submit', async ev => {
            ev.preventDefault();
            if (submitting || state.submitted) return;

            const missing = questions.findIndex((q, i) => !answerIsComplete(q, state.answers[i]));
            if (missing !== -1) {
                toast('Répondez à toutes les questions avant de valider.', 'err');
                const focusable = body.querySelectorAll('fieldset')[missing];
                const input = focusable && focusable.querySelector('input, textarea');
                if (input) input.focus();
                return;
            }

            submitting = true;
            const submitBtn = actions.querySelector('button[type="submit"]');
            if (submitBtn) submitBtn.disabled = true;

            const results = [];
            for (let i = 0; i < questions.length; i++) {
                const q = questions[i];
                const answer = state.answers[i];
                if (q.type === 'sql') {
                    try {
                        const res = await WA.api.post('sql-run', {
                            dialect: q.dialect || 'sqlite',
                            sql: String(answer || ''),
                            dataset: q.dataset || (data.lesson && data.lesson.exercise && data.lesson.exercise.dataset) || null
                        });
                        results.push(sqlOutcome(q.test, res));
                    } catch (err) {
                        results.push({ ok: false, detail: err.message });
                    }
                } else if (q.type === 'fill') {
                    const expected = q.expected != null ? q.expected : q.answer;
                    const accepted = [expected].concat(Array.isArray(q.accept) ? q.accept : [])
                        .filter(v => v != null)
                        .map(normalizeAnswer);
                    const ok = accepted.indexOf(normalizeAnswer(answer)) !== -1;
                    results.push({ ok, detail: ok ? '' : 'la réponse saisie ne correspond pas' });
                } else if (q.type === 'multi') {
                    results.push({ ok: sameSet(answer, q.answer), detail: '' });
                } else {
                    results.push({ ok: Number(answer) === Number(q.answer), detail: '' });
                }
            }

            state.results = results;
            state.submitted = true;
            submitting = false;
            paint();

            const score = results.filter(r => r.ok).length;
            try {
                const progress = await WA.api.post('quiz-save', {
                    key,
                    score,
                    total: questions.length,
                    answers: state.answers
                });
                WA.app.applyProgress(progress);
            } catch (err) {
                toast('Résultat affiché, mais non enregistré : ' + err.message, 'err');
            }

            const heading = section.querySelector('.wa-quizafter h3');
            if (heading) heading.setAttribute('tabindex', '-1');
            if (heading) heading.focus();
            WA.ui.toast('Quiz terminé : ' + score + '/' + questions.length + '.', score >= questions.length / 2 ? 'ok' : 'info');
        });

        paint();
        return section;
    }

    return { render };
})();
