/* WebAcademy — routeur SPA, shell, tableau de bord, notes, réglages. */
WA.app = (function () {
    const { h, badge, toast, progressbar, icon, iconBtn } = WA.ui;

    let BOOT = null;
    let NOTES = null;
    let lang = 'bilingual';
    let routeSeq = 0;
    let searchSeq = 0;
    let lastLessonKey = null;
    let currentRoute = null;
    let editingNote = 0;

    const ROUTES = {
        '': 'dashboard',
        dashboard: 'dashboard',
        login: 'login',
        lesson: 'lesson',
        lab: 'lab',
        course: 'course',
        projects: 'projects',
        glossary: 'glossary',
        notes: 'notes',
        progress: 'progress',
        search: 'search',
        settings: 'settings'
    };

    const PAGE_LABELS = {
        dashboard: 'Tableau de bord',
        login: 'Espace Membre',
        lesson: 'Leçon',
        lab: 'Atelier',
        course: 'Cours',
        projects: 'Projets',
        glossary: 'Glossaire',
        notes: 'Mes notes',
        progress: 'Ma progression',
        search: 'Recherche',
        settings: 'Paramètres',
        notfound: 'Page introuvable'
    };

    const AVATARS = [
        { id: 'neo-coder', name: 'Le Renard Codeur', code: 'DEV', icon: 'terminal', color: '#FF6B6B' },
        { id: 'pixel-bot', name: 'Le Robot Pixel', code: 'BOT', icon: 'cpu', color: '#00F0FF' },
        { id: 'cyber-cat', name: 'Le Hacker Cyber', code: 'SEC', icon: 'shield', color: '#FFE600' },
        { id: 'retro-hacker', name: 'Le Hacker Rétro', code: 'ROOT', icon: 'zap', color: '#A78BFA' },
        { id: 'code-alien', name: 'L\'Alien du Web', code: 'JS', icon: 'code', color: '#4ECCA3' },
        { id: 'ninja-panda', name: 'Le Panda Ninja', code: 'PHP', icon: 'database', color: '#FB923C' },
        { id: 'astro-dev', name: 'L\'Astro Dev', code: 'OPS', icon: 'rocket', color: '#38BDF8' },
        { id: 'syntax-wizard', name: 'Le Mage Syntax', code: 'C++', icon: 'layers', color: '#EC4899' }
    ];

    function getAvatar(id) {
        return AVATARS.find(a => a.id === id) || AVATARS[0];
    }

    function renderAvatar(id, size) {
        size = size || 36;
        const a = getAvatar(id);
        const el = h('div.wa-avatar-badge', {
            style: `width:${size}px;height:${size}px;background:${a.color};border:var(--bw) solid var(--line);box-shadow:2px 2px 0 var(--line);border-radius:var(--radius-sm);display:inline-flex;align-items:center;justify-content:center;font-weight:900;font-family:var(--font-mono);font-size:${Math.round(size * 0.38)}px;color:var(--line);text-transform:uppercase;flex-shrink:0;`,
            title: a.name,
            'aria-label': a.name
        });
        if (a.icon) {
            el.appendChild(icon(a.icon, Math.max(14, Math.round(size * 0.55))));
        } else {
            el.textContent = a.code || 'DEV';
        }
        return el;
    }

    const LAB_MODULES = ['html', 'css', 'php', 'sql', 'cpp', 'javascript'];
    const COURSE_IDS = ['cpp', 'javascript'];
    const LANG_MODES = ['fr', 'darija', 'bilingual'];

    /* ------------------------------------------------------------ helpers */

    function data(field) {
        return BOOT ? BOOT[field] : null;
    }

    function modules() {
        return (BOOT && BOOT.manifest && BOOT.manifest.modules) || [];
    }

    function moduleMeta(id) {
        return modules().find(m => m.id === id) || { id, name: id || 'Module', chapters: [], blurb: '' };
    }

    function isAvailable(module, ch) {
        const info = (BOOT && BOOT.availability && BOOT.availability[module]) || {};
        return !!info[ch];
    }

    function splitKey(key) {
        const m = String(key || '').match(/^([a-z]{2,20})-ch(\d{1,3})$/);
        return m ? [m[1], Number(m[2])] : [null, null];
    }

    function lessonTitle(module, ch) {
        const mod = moduleMeta(module);
        const c = (mod.chapters || []).find(x => Number(x.n) === Number(ch));
        return (c && c.title) || ('Chapitre ' + ch);
    }

    function lessonLongTitle(module, ch) {
        return moduleMeta(module).name + ' · Ch. ' + ch + ' — ' + lessonTitle(module, ch);
    }

    function availableLessons() {
        const out = [];
        modules().forEach(m => {
            (m.chapters || []).forEach(c => {
                if (isAvailable(m.id, c.n)) out.push({ module: m.id, ch: Number(c.n), title: c.title });
            });
        });
        return out;
    }

    function firstAvailable() {
        const list = availableLessons();
        return list.length ? list[0] : null;
    }

    function progressMap() {
        return (BOOT && BOOT.progress && BOOT.progress.map) || {};
    }

    function statusOf(module, ch) {
        const rec = progressMap()[module + '-ch' + ch];
        return rec ? rec.status : '';
    }

    function bookmarks() {
        return (BOOT && BOOT.progress && BOOT.progress.bookmarks) || [];
    }

    function isBookmarked(module, ch) {
        return bookmarks().indexOf(module + '-ch' + ch) !== -1;
    }

    function counts() {
        const list = availableLessons();
        let done = 0;
        list.forEach(l => { if (statusOf(l.module, l.ch) === 'done') done++; });
        return {
            total: list.length,
            done,
            pct: list.length ? Math.round((done / list.length) * 100) : 0
        };
    }

    function moduleCounts(module) {
        const mod = moduleMeta(module);
        let total = 0, done = 0;
        (mod.chapters || []).forEach(c => {
            if (!isAvailable(module, c.n)) return;
            total++;
            if (statusOf(module, c.n) === 'done') done++;
        });
        return { total, done, pct: total ? Math.round((done / total) * 100) : 0 };
    }

    function href(path) {
        return '#/' + String(path || '').replace(/^#?\/?/, '');
    }

    function navigate(path) {
        const next = href(path);
        if (location.hash === next) renderRoute();
        else location.hash = next;
    }

    function lessonHref(module, ch, anchor) {
        return href('lesson/' + module + '/' + ch + (anchor ? '~' + anchor : ''));
    }

    function setTitle(text) {
        document.title = text ? text + ' — WebAcademy' : 'WebAcademy — HTML · CSS · PHP · SQL · C++ · JavaScript';
    }

    function announce(text) {
        const el = document.getElementById('wa-route-status');
        if (el) el.textContent = text;
    }

    function closeNav() {
        const sidebar = document.getElementById('wa-sidebar');
        const scrim = document.getElementById('wa-scrim');
        if (!sidebar) return;
        sidebar.classList.remove('open');
        document.body.classList.remove('nav-open');
        if (scrim) scrim.hidden = true;
        const toggle = document.getElementById('wa-nav-toggle');
        if (toggle) toggle.setAttribute('aria-expanded', 'false');
        syncNavInert();
    }

    function openNav() {
        const sidebar = document.getElementById('wa-sidebar');
        const scrim = document.getElementById('wa-scrim');
        if (!sidebar) return;
        sidebar.classList.add('open');
        document.body.classList.add('nav-open');
        if (scrim) scrim.hidden = false;
        const toggle = document.getElementById('wa-nav-toggle');
        if (toggle) toggle.setAttribute('aria-expanded', 'true');
        sidebar.inert = false;
        const first = sidebar.querySelector('a, button, input');
        if (first) first.focus();
    }

    function syncNavInert() {
        const sidebar = document.getElementById('wa-sidebar');
        if (!sidebar) return;
        const mobile = window.matchMedia('(max-width: 980px)').matches;
        sidebar.inert = mobile && !sidebar.classList.contains('open');
    }

    function applyTheme(theme, persist) {
        const value = theme === 'dark' ? 'dark' : 'light';
        document.documentElement.setAttribute('data-theme', value);
        document.documentElement.style.colorScheme = value;
        try { localStorage.setItem('wa-theme', value); } catch (err) { /* stockage indisponible */ }
        const btn = document.getElementById('wa-theme-toggle');
        if (btn) {
            btn.setAttribute('aria-label', value === 'dark' ? 'Activer le thème clair' : 'Activer le thème sombre');
            btn.title = btn.getAttribute('aria-label');
            btn.innerHTML = '';
            btn.appendChild(icon(value === 'dark' ? 'sun' : 'moon', 17));
        }
        if (persist) {
            WA.api.post('settings-save', { theme: value }).catch(() => { /* préférence locale conservée */ });
        }
    }

    function applyLang(mode, persist) {
        lang = LANG_MODES.indexOf(mode) === -1 ? 'bilingual' : mode;
        document.body.setAttribute('data-lang', lang);
        document.documentElement.setAttribute('lang', lang === 'darija' ? 'ar' : 'fr');
        document.querySelectorAll('.wa-langswitch button').forEach(b => {
            const on = b.getAttribute('data-mode') === lang;
            b.classList.toggle('on', on);
            b.setAttribute('aria-pressed', on ? 'true' : 'false');
        });
        if (persist) {
            WA.api.post('settings-save', { langMode: lang }).catch(() => { /* préférence locale conservée */ });
        }
    }

    function toggleTheme() {
        const current = document.documentElement.getAttribute('data-theme');
        applyTheme(current === 'dark' ? 'light' : 'dark', true);
    }

    /* ------------------------------------------------------------ shell */

    function brand() {
        return h('a.wa-brand', { href: href('dashboard'), 'aria-label': 'WebAcademy — accueil' },
            h('span.wa-brand-mark', { 'aria-hidden': 'true' }, '</>'),
            h('span.wa-brand-name', {}, 'WebAcademy'));
    }

    
    function toggleSidebar() {
        document.body.classList.toggle('wa-sidebar-collapsed');
        try {
            const isCol = document.body.classList.contains('wa-sidebar-collapsed');
            localStorage.setItem('wa-sidebar-collapsed', isCol ? '1' : '0');
        } catch (e) {}
    }

    function renderSidebar() {
        const aside = document.getElementById('wa-sidebar');
        if (!aside) return;
        aside.innerHTML = '';
        const scroll = h('div.wa-sidebar-scroll', { id: 'wa-sidebar-scroll' });

        const brandRow = h('div.wa-brand-row', {},
            brand(),
            h('button.wa-collapse-btn', {
                type: 'button',
                title: 'Masquer la barre latérale (sortir)',
                'aria-label': 'Masquer la barre latérale',
                onclick: toggleSidebar
            }, icon('arrowLeft', 16))
        );
        scroll.appendChild(brandRow);

        const user = BOOT ? BOOT.user : null;
        if (user) {
            const userCard = h('div.wa-side-user', {
                style: 'display:flex;align-items:center;gap:10px;padding:10px;background:var(--surface);border:var(--bw) solid var(--line);border-radius:var(--radius);box-shadow:var(--shadow-flat);margin-bottom:10px;cursor:pointer;',
                onclick: () => navigate('login'),
                title: 'Gérer mon profil'
            },
                renderAvatar(user.avatar, 38),
                h('div', { style: 'flex:1;overflow:hidden;' },
                    h('b', { style: 'display:block;font-size:0.85rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;' }, user.username),
                    h('span.wa-badge' + (user.is_guest ? '.pink' : '.yellow'), { style: 'font-size:0.65rem;padding:2px 6px;margin-top:2px;' }, user.is_guest ? 'Invité' : 'Membre')
                ),
                icon('chevron', 13)
            );
            scroll.appendChild(userCard);
        } else {
            const authCard = h('a.wa-btn.primary.small', {
                href: href('login'),
                style: 'margin-bottom:10px;width:100%;justify-content:center;'
            }, icon('user', 14), 'Se connecter / Invité');
            scroll.appendChild(authCard);
        }

        const searchWrap = h('div.wa-navsearch');
        searchWrap.appendChild(icon('search', 15));
        const navSearch = h('input', {
            type: 'search',
            id: 'wa-nav-search',
            placeholder: 'Filtrer les chapitres…',
            'aria-label': 'Filtrer les chapitres du programme',
            autocomplete: 'off'
        });
        searchWrap.appendChild(navSearch);
        scroll.appendChild(searchWrap);

        const results = h('div.wa-navresults', { hidden: true });
        scroll.appendChild(results);

        scroll.appendChild(h('div.wa-nav-group', {}, 'Parcours'));
        scroll.appendChild(quickLink('home', 'Tableau de bord', 'dashboard'));
        scroll.appendChild(quickLink('chart', 'Ma progression', 'progress'));

        scroll.appendChild(h('div.wa-nav-group', {}, 'Langages'));
        modules().filter(m => m.course).forEach(m => {
            const c = moduleCounts(m.id);
            scroll.appendChild(h('a.wa-quick.wa-course-link', {
                href: href('course/' + m.id),
                'data-route': 'course',
                'data-id': m.id
            },
                h('span.wa-nav-mod-icon', { 'aria-hidden': 'true' }, m.icon || ''),
                h('span.wa-course-link-text', {},
                    h('b', {}, m.name),
                    h('span', {}, m.blurb + ' · ' + c.done + '/' + c.total)),
                h('span.wa-quick-arrow', { 'aria-hidden': 'true' }, icon('arrowRight', 13))));
        });

        scroll.appendChild(h('div.wa-nav-group', {}, 'Ateliers'));
        LAB_MODULES.forEach(id => {
            const meta = moduleMeta(id);
            scroll.appendChild(quickLink('flask', 'Atelier ' + meta.name, 'lab/' + id));
        });

        scroll.appendChild(h('div.wa-nav-group', {}, 'Ressources'));
        scroll.appendChild(quickLink('rocket', 'Projets guidés', 'projects'));
        scroll.appendChild(quickLink('book', 'Glossaire', 'glossary'));
        scroll.appendChild(quickLink('note', 'Mes notes', 'notes'));

        scroll.appendChild(h('div.wa-nav-group', {}, 'Préférences'));
        scroll.appendChild(quickLink('settings', 'Paramètres & Thème', 'settings'));

        scroll.appendChild(h('div.wa-nav-group', {}, 'Application'));
        scroll.appendChild(h('a.wa-quick', {
            href: 'webacademy.apk',
            download: 'webacademy.apk',
            title: 'Télécharger WebAcademy pour Android (.apk)'
        },
            h('span.wa-quick-icon', { 'aria-hidden': 'true' }, icon('download', 15)),
            h('span.wa-quick-label', {}, 'Application Android'),
            h('span.wa-quick-arrow', { 'aria-hidden': 'true', style: 'font-weight:900;font-size:10px;background:var(--neo-mint);padding:2px 6px;border-radius:4px;border:1.5px solid #111;' }, 'APK')
        ));

        aside.appendChild(scroll);



        markActiveNav();
        wireNavSearch(navSearch, results);
        syncNavInert();
    }

    function quickLink(iconName, label, path) {
        return h('a.wa-quick', { href: href(path), 'data-route': path.split('/')[0] },
            h('span.wa-quick-icon', { 'aria-hidden': 'true' }, icon(iconName, 15)),
            h('span.wa-quick-label', {}, label),
            h('span.wa-quick-arrow', { 'aria-hidden': 'true' }, icon('arrowRight', 13)));
    }

    function markActiveNav() {
        if (!currentRoute) return;
        document.querySelectorAll('.wa-quick').forEach(a => {
            const wantedId = a.getAttribute('data-id');
            const active = a.getAttribute('data-route') === currentRoute.name
                && (!wantedId || (currentRoute.params && currentRoute.params.id === wantedId));
            a.classList.toggle('active', active);
            if (active) a.setAttribute('aria-current', 'page');
            else a.removeAttribute('aria-current');
        });
        document.querySelectorAll('.wa-nav-chapter').forEach(a => {
            const active = currentRoute.name === 'lesson' &&
                a.getAttribute('data-key') === currentRoute.params.module + '-ch' + currentRoute.params.ch;
            a.classList.toggle('active', active);
            a.setAttribute('aria-current', active ? 'page' : 'false');
            if (active) {
                const mod = a.closest('.wa-nav-mod');
                if (mod) {
                    mod.classList.add('open');
                    const btn = mod.querySelector('.wa-nav-mod-btn');
                    if (btn) btn.setAttribute('aria-expanded', 'true');
                }
            }
        });
    }

    function wireNavSearch(input, results) {
        let items = [];
        modules().forEach(m => (m.chapters || []).forEach(c => {
            items.push({
                module: m.id,
                moduleName: m.name,
                ch: Number(c.n),
                title: c.title,
                available: isAvailable(m.id, c.n)
            });
        }));

        const paint = () => {
            const q = input.value.trim().toLowerCase();
            results.innerHTML = '';
            if (q.length < 2) { results.hidden = true; return; }
            const hits = items.filter(it =>
                (it.title + ' ' + it.moduleName + ' chapitre ' + it.ch).toLowerCase().indexOf(q) !== -1
            ).slice(0, 6);
            results.hidden = false;
            if (!hits.length) {
                results.appendChild(h('div.wa-navresults-empty', {}, 'Aucun chapitre trouvé.'));
                return;
            }
            hits.forEach(it => {
                results.appendChild(h('button.wa-navresult', {
                    type: 'button',
                    onclick: () => {
                        input.value = '';
                        results.hidden = true;
                        navigate('lesson/' + it.module + '/' + it.ch);
                    }
                },
                    h('b', {}, it.title),
                    h('span', {}, it.moduleName + ' · Chapitre ' + it.ch + (it.available ? '' : ' · non rédigé'))));
            });
        };

        input.addEventListener('input', WA.ui.debounce(paint, 140));
        input.addEventListener('keydown', ev => {
            if (ev.key === 'Escape') {
                input.value = '';
                results.hidden = true;
                input.blur();
            } else if (ev.key === 'Enter') {
                ev.preventDefault();
                const q = input.value.trim();
                if (q.length >= 2) {
                    input.value = '';
                    results.hidden = true;
                    navigate('search?q=' + encodeURIComponent(q));
                }
            }
        });
        input.addEventListener('blur', () => setTimeout(() => { results.hidden = true; }, 160));
    }

    function topbar() {
        const bar = h('header.wa-topbar');
        const start = h('div.wa-topbar-start');

        const toggle = h('button#wa-nav-toggle.wa-iconbtn.wa-sidebar-toggle', {
            type: 'button',
            'aria-label': 'Ouvrir la navigation',
            'aria-expanded': 'false',
            'aria-controls': 'wa-sidebar',
            onclick: () => {
                const sidebar = document.getElementById('wa-sidebar');
                if (sidebar && sidebar.classList.contains('open')) closeNav();
                else openNav();
            }
        }, icon('menu', 18));
        start.appendChild(toggle);

        start.appendChild(h('a.wa-mobile-brand', { href: href('dashboard') },
            h('span.wa-brand-mark', { 'aria-hidden': 'true' }, '</>'),
            h('span', {}, 'WebAcademy')));

        const desktopToggle = h('button.wa-iconbtn.wa-sidebar-desktop-toggle', {
            type: 'button',
            'aria-label': 'Afficher la barre latérale',
            title: 'Afficher la barre latérale',
            onclick: toggleSidebar
        }, icon('menu', 17));
        start.appendChild(desktopToggle);

        const crumbs = h('nav.wa-crumbs', { 'aria-label': 'Fil d’Ariane' });
        start.appendChild(crumbs);
        bar.appendChild(start);

        const actions = h('div.wa-topbar-actions');

        const user = BOOT ? BOOT.user : null;
        if (user) {
            const userChip = h('button.wa-user-chip' + (user.is_guest ? '.guest' : ''), {
                type: 'button',
                title: user.is_guest ? 'Mode Invité (Cliquez pour gérer)' : 'Mon profil (Cliquez pour gérer)',
                onclick: () => navigate('login')
            },
                renderAvatar(user.avatar, 26),
                h('span', {}, user.username),
                user.is_guest ? h('span.wa-badge.pink', { style: 'font-size:9px;padding:1px 5px;' }, 'INVITÉ') : null
            );
            actions.appendChild(userChip);
        }

        bar.appendChild(actions);

        return { bar, crumbs };
    }

    function paintCrumbs(crumbs, route) {
        if (!crumbs) return;
        crumbs.innerHTML = '';
        const home = h('a', { href: href('dashboard') }, icon('home', 13), 'Accueil');
        crumbs.appendChild(home);
        if (!route || route.name === 'dashboard') return;
        crumbs.appendChild(h('span.sep', { 'aria-hidden': 'true' }, '/'));
        let label = PAGE_LABELS[route.name] || '';
        if (route.name === 'lesson') {
            crumbs.appendChild(h('a', { href: href('lesson/' + route.params.module + '/' + route.params.ch) }, moduleMeta(route.params.module).name));
            crumbs.appendChild(h('span.sep', { 'aria-hidden': 'true' }, '/'));
            label = 'Chapitre ' + route.params.ch;
        } else if (route.name === 'lab') {
            label = 'Atelier ' + moduleMeta(route.params.module || 'html').name;
        } else if (route.name === 'course') {
            label = 'Cours ' + moduleMeta(route.params.id || 'cpp').name;
        }
        crumbs.appendChild(h('span.here', { 'aria-current': 'page' }, label));
    }

    /* ------------------------------------------------------------ routing */

    function parseRoute() {
        const raw = location.hash.replace(/^#\/?/, '');
        const qIndex = raw.indexOf('?');
        const pathPart = qIndex === -1 ? raw : raw.slice(0, qIndex);
        const query = new URLSearchParams(qIndex === -1 ? '' : raw.slice(qIndex + 1));
        const parts = pathPart.split('/').filter(Boolean);
        const route = { name: 'dashboard', params: {}, query };

        if (parts.length === 0) return route;
        const base = ROUTES[parts[0]];
        if (!base) { route.name = 'notfound'; return route; }
        route.name = base;

        if (base === 'lesson') {
            route.params.module = parts[1] || 'html';
            let chPart = parts[2] || '1';
            const tilde = chPart.indexOf('~');
            if (tilde !== -1) {
                route.params.anchor = decodeURIComponent(chPart.slice(tilde + 1));
                chPart = chPart.slice(0, tilde);
            }
            route.params.ch = Number(chPart) || 1;
        } else if (base === 'lab') {
            route.params.module = LAB_MODULES.indexOf(parts[1]) !== -1 ? parts[1] : 'html';
        } else if (base === 'course') {
            route.params.id = COURSE_IDS.indexOf(parts[1]) !== -1 ? parts[1] : 'cpp';
        }
        return route;
    }

    async function renderRoute() {
        if (!BOOT) return;
        const seq = ++routeSeq;
        currentRoute = parseRoute();
        closeNav();
        markActiveNav();

        const main = document.getElementById('wa-main');
        if (!main) return;
        const crumbs = main.querySelector('.wa-crumbs');
        paintCrumbs(crumbs, currentRoute);

        const view = document.getElementById('wa-view');
        if (!view) return;
        view.innerHTML = '';
        main.setAttribute('aria-busy', 'true');

        const name = currentRoute.name;
        setTitle(PAGE_LABELS[name] || 'WebAcademy');

        try {
            let node;
            if (name === 'dashboard') node = dashboardPage();
            else if (name === 'login') node = loginPage();
            else if (name === 'lesson') node = await lessonPage(currentRoute.params);
            else if (name === 'lab') node = labPage(currentRoute.params.module);
            else if (name === 'course') node = await coursePage(currentRoute.params.id);
            else if (name === 'projects') node = await projectsPage(currentRoute.query.get('course') || '');
            else if (name === 'glossary') node = await glossaryPage();
            else if (name === 'notes') node = await notesPage();
            else if (name === 'progress') node = progressPage();
            else if (name === 'search') node = searchPage(currentRoute.query.get('q') || '');
            else if (name === 'settings') node = settingsPage();
            else node = notFoundPage();

            if (seq !== routeSeq) return;
            view.appendChild(node);

            document.querySelectorAll('.wa-bottom-item').forEach(b => {
                const r = b.getAttribute('data-route');
                const active = (name === r) || (r === 'course' && name === 'lesson');
                b.classList.toggle('active', !!active);
            });
            main.setAttribute('aria-busy', 'false');
            announce((PAGE_LABELS[name] || 'Page') + ' affiché');

            if (name === 'lesson' && currentRoute.params.anchor) {
                const target = document.getElementById(currentRoute.params.anchor);
                if (target) target.scrollIntoView({ block: 'start', behavior: 'auto' });
            } else {
                window.scrollTo(0, 0);
            }
            main.focus({ preventScroll: true });
        } catch (err) {
            if (seq !== routeSeq) return;
            view.appendChild(errorState(err));
            main.setAttribute('aria-busy', 'false');
            announce('Erreur de chargement');
        }
    }

    /* ------------------------------------------------------------ page modules */

    function lessonPage(params) {
        return WA.lesson.render(params);
    }

    function labPage(module) {
        return WA.lab.render(module);
    }

    /* ------------------------------------------------------------ page cours */

    async function coursePage(id) {
        const m = moduleMeta(id);
        if (!m.course) return notFoundPage();

        const mc = moduleCounts(id);
        const chapters = m.chapters || [];
        const available = chapters.filter(c => isAvailable(id, c.n));
        const first = available[0];
        const [lastModule, lastChapter] = splitKey(data('settings') && data('settings').lastLesson);
        const resume = lastModule === id && isAvailable(id, lastChapter) ? lastChapter : null;

        let projects = [];
        try {
            const res = await WA.api.get('projects');
            projects = (res.projects || []).filter(p => p.course === id);
        } catch (err) { /* les projets restent visibles depuis la page globale */ }

        const root = h('div');

        const hero = h('section.wa-course-hero');
        const info = h('div.wa-course-info');
        info.appendChild(h('div.wa-overline', {}, 'Parcours langage · ' + (m.standard || '')));
        info.appendChild(h('h1.wa-page-title', {}, m.name + ' — ' + (m.blurb || '')));
        if (m.description) info.appendChild(h('p.wa-page-lead', {}, m.description));

        const facts = h('div.wa-course-facts');
        [
            [icon('book', 15), chapters.length + ' chapitres'],
            [icon('clock', 15), m.hours || ''],
            [icon('chart', 15), m.level || ''],
            [icon('target', 15), mc.done + '/' + mc.total + ' terminés']
        ].forEach(([ico, text]) => {
            if (!text) return;
            facts.appendChild(h('span', {}, ico, text));
        });
        info.appendChild(facts);

        const actions = h('div.wa-btn-row');
        if (first) {
            actions.appendChild(h('a.wa-btn.primary', {
                href: lessonHref(id, resume || first.n)
            }, icon('book', 15), resume ? 'Reprendre le chapitre ' + resume : 'Commencer le parcours'));
        }
        if (LAB_MODULES.indexOf(id) !== -1) {
            actions.appendChild(h('a.wa-btn', { href: href('lab/' + id) }, icon('flask', 15), 'Atelier ' + m.name));
        }
        if (projects.length) {
            actions.appendChild(h('a.wa-btn.ghost', { href: href('projects') + '?course=' + id }, icon('rocket', 15), projects.length + ' projets guidés'));
        }
        info.appendChild(actions);
        hero.appendChild(info);

        const ring = h('div.wa-ring', { style: '--p:' + mc.pct, role: 'img', 'aria-label': mc.pct + ' % du parcours terminé' },
            h('span.wa-ring-inner', {},
                h('span.wa-ring-value', {}, mc.pct + '%'),
                h('span.wa-ring-label', {}, 'terminé')));
        hero.appendChild(h('aside.wa-course-side', {},
            ring,
            h('p', {}, mc.done + ' chapitre' + (mc.done > 1 ? 's' : '') + ' terminé' + (mc.done > 1 ? 's' : '') + ' sur ' + mc.total + ' publiés.'),
            h('p.wa-course-note', {}, 'Les chapitres sont publiés au fur et à mesure de leur rédaction. Aucun contenu de remplacement n’est affiché.')));
        root.appendChild(hero);

        // --- BARRE DE CATÉGORIES / PARCOURS EXPRESS ---
        const catBar = h('div.wa-categories-bar');
        [
            { label: 'Web Front-End', icon: 'code', bg: 'var(--neo-orange)', route: 'lesson/html/1' },
            { label: 'JavaScript & DOM', icon: 'zap', bg: 'var(--neo-yellow)', route: 'course/javascript' },
            { label: 'PHP & Backend', icon: 'terminal', bg: 'var(--neo-pink)', route: 'lesson/php/1' },
            { label: 'SQL & Données', icon: 'database', bg: 'var(--neo-mint)', route: 'lesson/sql/1' },
            { label: 'C++ Moderne', icon: 'cpu', bg: 'var(--neo-blue)', route: 'course/cpp' },
            { label: 'Projets Pratiques', icon: 'rocket', bg: 'var(--neo-purple)', route: 'projects' }
        ].forEach(c => {
            catBar.appendChild(h('a.wa-category-pill', {
                href: href(c.route),
                style: '--pill-bg:' + c.bg + ';'
            }, h('span.cat-ico', {}, icon(c.icon, 16)), h('span.cat-lbl', {}, c.label)));
        });
        root.appendChild(catBar);

        const parts = Array.isArray(m.parts) && m.parts.length
            ? m.parts
            : [{ title: 'Programme', chapters: chapters.map(c => c.n) }];

        parts.forEach((part, pi) => {
            const section = h('section.wa-course-part');
            const numbers = Array.isArray(part.chapters) ? part.chapters : [];
            section.appendChild(h('div.wa-course-part-head', {},
                h('span.wa-course-part-num', {}, String(pi + 1).padStart(2, '0')),
                h('div', {},
                    h('h2', {}, part.title || 'Module'),
                    h('span.wa-meta', {}, numbers.length ? numbers.length + ' chapitres' : 'Projets pratiques'))));

            const list = h('div.wa-course-chapters');
            if (numbers.length) {
                numbers.forEach(n => {
                    const ch = chapters.find(c => Number(c.n) === Number(n));
                    if (!ch) return;
                    const ok = isAvailable(id, ch.n);
                    const st = statusOf(id, ch.n);
                    const statusBadge = ok
                        ? badge(st === 'done' ? 'ok' : st === 'in_progress' ? 'warn' : 'muted',
                            st === 'done' ? 'Terminé' : st === 'in_progress' ? 'En cours' : 'À lire')
                        : badge('muted', 'En rédaction');
                    const row = h(ok ? 'a.wa-course-chapter' : 'div.wa-course-chapter.ghost', {
                        href: ok ? lessonHref(id, ch.n) : null,
                        'aria-disabled': ok ? null : 'true'
                    },
                        h('span.wa-course-chapter-num', {}, String(ch.n).padStart(2, '0')),
                        h('span.wa-course-chapter-title', {}, ch.title),
                        statusBadge,
                        ok ? h('span.wa-course-chapter-arrow', { 'aria-hidden': 'true' }, icon('chevron', 14)) : null);
                    list.appendChild(row);
                });
            }

            if (!numbers.length && projects.length) {
                const grid = h('div.wa-course-projects');
                projects.forEach(p => {
                    grid.appendChild(h('a.wa-course-project', { href: href('projects') + '?course=' + id },
                        h('span.wa-course-project-index', {}, p.level || 'Projet'),
                        h('b', {}, p.title || 'Projet'),
                        h('span', {}, 'Ouvrir la fiche complète →')));
                });
                list.appendChild(grid);
            }
            if (!numbers.length && !projects.length) {
                list.appendChild(h('div.wa-empty', {}, 'Les projets de ce parcours seront publiés après les chapitres du module 6.'));
            }

            section.appendChild(list);
            root.appendChild(section);
        });

        return root;
    }

    /* ------------------------------------------------------------ page chrome */

    function pageHead(opts) {
        return h('header.wa-page-head', {},
            opts.overline ? h('div.wa-overline', {}, opts.overline) : null,
            h('h1.wa-page-title', { id: opts.id || null }, opts.title),
            opts.lead ? h('p.wa-page-lead', {}, opts.lead) : null,
            opts.actions ? h('div.wa-btn-row', {}, opts.actions) : null);
    }

    function errorState(err) {
        const box = h('div.wa-error-state', { role: 'alert' },
            h('h1', {}, 'Impossible de charger cette page'),
            h('p', {}, (err && err.message) || 'Une erreur inattendue est survenue.'),
            h('div.wa-btn-row', {},
                h('button.wa-btn.primary', { type: 'button', onclick: () => renderRoute() }, 'Réessayer'),
                h('a.wa-btn', { href: href('dashboard') }, 'Retour au tableau de bord')));
        return box;
    }

    function emptyState(iconName, title, text, actions) {
        return h('div.wa-empty-state', {},
            h('div.wa-empty-icon', {}, icon(iconName, 26)),
            h('h2', {}, title),
            h('p', {}, text),
            actions ? h('div.wa-btn-row', {}, actions) : null);
    }

    /* ------------------------------------------------------------ dashboard */

    function dashboardPage() {
        const root = h('div');
        const c = counts();
        const all = availableLessons();

        const last = data('settings') && data('settings').lastLesson;
        const lastParts = splitKey(last);
        let next = null;
        if (lastParts[0] && isAvailable(lastParts[0], lastParts[1])) {
            next = { module: lastParts[0], ch: lastParts[1], title: lessonTitle(lastParts[0], lastParts[1]), resume: true };
        } else if (all.length) {
            const undone = all.find(l => statusOf(l.module, l.ch) !== 'done') || all[0];
            next = { module: undone.module, ch: undone.ch, title: undone.title, resume: false };
        }

        const hero = h('section.wa-hero');
        const heroMain = h('div', {},
            h('div.wa-overline', {}, h('strong', {}, 'Parcours personnel · 2026')),
            h('h1.wa-display', {}, 'Apprendre à coder, une page à la fois.'),
            h('p.wa-page-lead', {},
                h('strong', {}, 'HTML, CSS, PHP, SQL, C++ et JavaScript'),
                ' : des leçons rédigées, des ateliers exécutés pour de vrai et des exercices corrigés — en français et en darija.'),
            h('div.wa-btn-row', { style: 'margin-top: 16px; display: flex; gap: 12px; flex-wrap: wrap;' },
                h('a.wa-btn.primary', { href: next ? href('lesson/' + next.module + '/' + next.ch) : href('course/html') },
                    icon('play', 14), (next && next.resume) ? 'Reprendre la leçon' : 'Commencer le parcours'
                ),
                h('a.wa-btn', {
                    href: 'webacademy.apk',
                    download: 'webacademy.apk',
                    style: 'background: var(--neo-mint); color: #111; font-weight: 800;'
                },
                    icon('download', 14), 'Télécharger l\'APK Android'
                )
            ));
        hero.appendChild(heroMain);

        const ring = h('div.wa-ring', { style: '--p:' + c.pct, role: 'img', 'aria-label': c.pct + ' % du parcours terminé' },
            h('span.wa-ring-inner', {},
                h('span.wa-ring-value', {}, c.pct + '%'),
                h('span.wa-ring-label', {}, 'terminé')));
        hero.appendChild(h('aside.wa-hero-side', {},
            ring,
            h('div', {},
                h('p', {}, c.done + ' chapitre' + (c.done > 1 ? 's' : '') + ' terminé' + (c.done > 1 ? 's' : '') + ' sur ' + c.total + ' disponibles.'),
                h('a.wa-btn.small', { href: href('progress') }, 'Voir ma progression'))));
        root.appendChild(hero);

        // --- BARRE DE CATÉGORIES EXPRESS ---
        const catBar = h('div.wa-categories-bar');
        [
            { label: 'Web Front-End', icon: 'code', bg: 'var(--neo-orange)', route: 'lesson/html/1' },
            { label: 'JavaScript & DOM', icon: 'zap', bg: 'var(--neo-yellow)', route: 'course/javascript' },
            { label: 'PHP & Backend', icon: 'terminal', bg: 'var(--neo-pink)', route: 'lesson/php/1' },
            { label: 'SQL & Données', icon: 'database', bg: 'var(--neo-mint)', route: 'lesson/sql/1' },
            { label: 'C++ Moderne', icon: 'cpu', bg: 'var(--neo-blue)', route: 'course/cpp' },
            { label: 'Projets Pratiques', icon: 'rocket', bg: 'var(--neo-purple)', route: 'projects' }
        ].forEach(c => {
            catBar.appendChild(h('a.wa-category-pill', {
                href: href(c.route),
                style: '--pill-bg:' + c.bg + ';'
            }, h('span.cat-ico', {}, icon(c.icon, 16)), h('span.cat-lbl', {}, c.label)));
        });
        root.appendChild(catBar);

        // --- NEO-BRUTALIST BIG CARDS SHOWCASE ---
        const bigGrid = h('div.wa-bigcards-grid');
        [
            {
                color: 'orange',
                sticker: 'PARCOURS WEB',
                title: 'Fullstack Moderne',
                desc: 'HTML5 sémantique, CSS3 moderne, PHP 8 et MySQL pour concevoir des applications web complètes.',
                btn: 'Démarrer le Web →',
                route: 'lesson/html/1',
                tag: '154 CHAPITRES'
            },
            {
                color: 'blue',
                sticker: 'LANGAGES CIBLÉS',
                title: 'C++ & JavaScript',
                desc: 'Algorithmique, programmation système C++17 et dynamique interactive du DOM JavaScript.',
                btn: 'Voir les Langages →',
                route: 'course/javascript',
                tag: 'COURS DÉDIÉS'
            },
            {
                color: 'yellow',
                sticker: 'PRATIQUE RÉELLE',
                title: '6 Ateliers de Code',
                desc: 'Exécution PHP isolée, bases SQLite & MySQL réelles, et bac à sable JS sans configuration.',
                btn: 'Ouvrir les Labs →',
                route: 'lab/html',
                tag: 'BAC À SABLE'
            },
            {
                color: 'mint',
                sticker: 'PROGRESSION LIBRE',
                title: 'Mode Invité & Profil',
                desc: 'Commence instantanément sans mot de passe ou sauvegarde ton profil avec un avatar néo-brutaliste.',
                btn: 'Gérer mon Profil →',
                route: 'login',
                tag: 'ZÉRO FRICTION'
            }
        ].forEach(c => {
            bigGrid.appendChild(h('a.wa-bigcard.' + c.color, {
                href: href(c.route),
                style: 'text-decoration:none;'
            },
                h('div.wa-bigcard-top', {},
                    h('span.wa-bigcard-sticker', {}, c.sticker),
                    h('span.wa-badge', { style: 'font-size:0.7rem;padding:2px 6px;background:#000;color:#fff;border-color:#000;' }, c.tag)
                ),
                h('h3.wa-bigcard-title', { style: 'font-family:var(--font-display);font-size:1.35rem;font-weight:900;margin:6px 0 2px;' }, c.title),
                h('p.wa-bigcard-desc', { style: 'font-size:0.88rem;line-height:1.45;flex:1;' }, c.desc),
                h('div.wa-bigcard-foot', { style: 'display:flex;align-items:center;justify-content:space-between;margin-top:10px;' },
                    h('span.wa-btn.small', { style: 'pointer-events:none;' }, c.btn)
                )
            ));
        });
        root.appendChild(bigGrid);

        if (next) {
            const meta = moduleMeta(next.module);
            root.appendChild(h('section.wa-continue', { 'data-index': String(next.ch).padStart(2, '0') },
                h('div.wa-continue-main', {},
                    h('div.wa-continue-kicker', {},
                        icon(next.resume ? 'clock' : 'spark', 13),
                        next.resume ? 'Reprendre où vous en étiez' : 'Commencer le parcours'),
                    h('h2.wa-continue-title', {}, next.title),
                    h('div.wa-continue-meta', {}, meta.name + ' · Chapitre ' + next.ch + ' · ' + (statusOf(next.module, next.ch) === 'done' ? 'terminé' : 'à lire'))),
                h('div.wa-continue-actions', {},
                    h('a.wa-btn.primary', { href: lessonHref(next.module, next.ch) }, icon('book', 15), next.resume ? 'Reprendre la leçon' : 'Ouvrir la leçon'),
                    h('a.wa-btn', { href: href('lab/' + next.module) }, icon('flask', 15), 'Atelier'))));
        } else {
            root.appendChild(emptyState('book', 'Aucun chapitre rédigé', 'Le programme est prêt mais les fichiers de contenu ne sont pas encore publiés.', null));
        }

        const notesCount = NOTES ? NOTES.length : 0;
        const stats = h('div.wa-grid.wa-stats');
        [
            [String(c.total), 'chapitres disponibles', 'sur l’ensemble du programme'],
            [String(c.done), 'chapitres terminés', c.pct + ' % du parcours'],
            [String(notesCount), 'notes personnelles', notesCount ? 'pensez à les relire' : 'aucune note pour le moment'],
            [String(bookmarks().length), 'favoris', 'leçons mises de côté']
        ].forEach(([value, label, note]) => {
            stats.appendChild(h('div.wa-stat', {},
                h('span.wa-stat-value', {}, value),
                h('span.wa-stat-label', {}, label),
                h('span.wa-stat-note', {}, note)));
        });
        root.appendChild(stats);

        const courseModules = modules().filter(m => m.course);
        if (courseModules.length) {
            root.appendChild(h('div.wa-section-head', {},
                h('h2', {}, 'Langages de programmation'),
                h('span.wa-meta', {}, courseModules.map(m => m.name).join(' · ') + ' — parcours complets')));
            const langGrid = h('div.wa-course-grid');
            courseModules.forEach(m => {
                const mc = moduleCounts(m.id);
                langGrid.appendChild(h('a.wa-langcard', { href: href('course/' + m.id) },
                    h('div.wa-langcard-top', {},
                        h('span.wa-langcard-icon', { 'aria-hidden': 'true' }, m.icon || m.name),
                        h('div', {},
                            h('h3', {}, m.name),
                            h('span.wa-langcard-blurb', {}, m.blurb || ''))),
                    h('p.wa-langcard-desc', {}, m.description || ''),
                    h('div.wa-langcard-facts', {},
                        h('span', {}, icon('book', 13), (m.chapters || []).length + ' chapitres'),
                        h('span', {}, icon('clock', 13), m.hours || ''),
                        h('span', {}, icon('chart', 13), m.level || '')),
                    h('div.wa-langcard-foot', {},
                        h('span', {}, mc.done + '/' + mc.total + ' terminés'),
                        h('span', {}, 'Ouvrir le cours →'))));
            });
            root.appendChild(langGrid);
        }

        root.appendChild(h('div.wa-section-head', {},
            h('h2', {}, 'Les modules web'),
            h('span.wa-meta', {}, modules().filter(m => !m.course).length + ' disciplines · ' + all.length + ' chapitres prêts')));
        const grid = h('div.wa-modgrid');
        modules().filter(m => !m.course).forEach((m, i) => {
            const mc = moduleCounts(m.id);
            const first = (m.chapters || [])[0] || { n: 1 };
            const isLab = LAB_MODULES.indexOf(m.id) !== -1;
            const target = isLab ? 'lab/' + m.id : (isAvailable(m.id, first.n) ? 'lesson/' + m.id + '/' + first.n : 'progress');
            const card = h('a.wa-modcard', { href: href(target) },
                h('span.wa-modcard-index', {}, 'M' + String(i + 1).padStart(2, '0')),
                h('div.wa-modcard-head', {},
                    h('span.wa-nav-mod-icon', { 'aria-hidden': 'true' }, m.icon || String(i + 1)),
                    h('h3.wa-modcard-title', {}, m.name)),
                h('p.wa-modcard-blurb', {}, m.blurb || ''),
                h('ul.wa-modcard-list', {},
                    (m.chapters || []).slice(0, 3).map(ch => h('li', {}, ch.title)),
                    (m.chapters || []).length > 3 ? h('li.more', {}, '+ ' + ((m.chapters || []).length - 3) + ' autres chapitres') : null),
                progressbar(mc.pct, mc.pct === 100, 'Progression ' + m.name),
                h('div.wa-modcard-foot', {},
                    h('span', {}, mc.done + '/' + mc.total + ' terminés'),
                    h('span', {}, isLab ? 'Atelier disponible →' : 'Voir le programme →')));
            grid.appendChild(card);
        });
        root.appendChild(grid);

        const recent = (data('progress') && data('progress').recent) || [];
        if (recent.length) {
            root.appendChild(h('div.wa-section-head', {},
                h('h2', {}, 'Reprises récentes'),
                h('a', { href: href('progress') }, 'Toute la progression →')));
            const list = h('div.wa-recent');
            recent.forEach(key => {
                const [module, ch] = splitKey(key);
                if (!module) return;
                list.appendChild(h('a.wa-recent-row', { href: lessonHref(module, ch) },
                    icon('book', 15),
                    h('span', {}, lessonLongTitle(module, ch)),
                    badge(statusOf(module, ch) === 'done' ? 'ok' : 'warn', statusOf(module, ch) === 'done' ? 'Terminé' : 'En cours')));
            });
            root.appendChild(list);
        }

        root.appendChild(h('div.wa-section-head', {},
            h('h2', {}, 'Ateliers & projets'),
            h('a', { href: href('projects') }, 'Tous les projets →')));
        const labs = h('div.wa-grid.auto');
        LAB_MODULES.forEach(id => {
            const m = moduleMeta(id);
            labs.appendChild(h('a.wa-card.accent', { href: href('lab/' + id), style: 'text-decoration:none;color:var(--ink)' },
                h('div', { style: 'display:flex;align-items:center;gap:8px;color:var(--accent);margin-bottom:8px' }, icon('terminal', 18)),
                h('h3', {}, 'Atelier ' + m.name),
                h('p', { style: 'color:var(--muted);font-size:13px;margin:0' },
                    id === 'php' ? 'Exécution PHP réelle dans une sandbox isolée.'
                        : id === 'sql' ? 'SQLite réel, MySQL si WAMP tourne, Oracle honnêtement indisponible.'
                        : id === 'cpp' ? 'Éditeur C++17, compilation locale guidée avec g++.' 
                        : id === 'javascript' ? 'JavaScript exécuté dans un iframe sandbox, console réelle.'
                        : 'Aperçu réel dans un iframe sandbox, sans serveur.')));
        });
        root.appendChild(labs);

        return root;
    }

    /* ------------------------------------------------------------ notes */

    async function notesPage() {
        if (NOTES === null) {
            const res = await WA.api.get('notes');
            NOTES = res.notes || [];
        }
        const root = h('div');
        root.appendChild(pageHead({
            overline: 'Carnet personnel',
            title: 'Mes notes',
            lead: 'Consignez une idée, un bloc de code ou une question. Chaque note peut être reliée à un chapitre et reste stockée localement.'
        }));

        const layout = h('div.wa-notes-layout');
        layout.appendChild(noteEditor());
        layout.appendChild(notesList());
        root.appendChild(layout);
        return root;
    }

    function noteEditor() {
        const current = editingNote ? NOTES.find(n => Number(n.id) === Number(editingNote)) : null;
        const form = h('form.wa-card.wa-note-editor', { id: 'wa-note-form' });
        form.appendChild(h('h3', {}, current ? 'Modifier la note' : 'Nouvelle note'));

        const title = h('input.wa-input', {
            id: 'wa-note-title', type: 'text', maxlength: '160',
            value: current ? current.title : '',
            placeholder: 'Titre de la note'
        });
        form.appendChild(h('div.wa-field', {}, h('label', { for: 'wa-note-title' }, 'Titre'), title));

        const select = h('select.wa-select', { id: 'wa-note-lesson' });
        select.appendChild(h('option', { value: '' }, 'Aucun chapitre lié'));
        modules().forEach(m => {
            const group = h('optgroup', { label: m.name });
            (m.chapters || []).forEach(ch => {
                if (!isAvailable(m.id, ch.n)) return;
                group.appendChild(h('option', {
                    value: m.id + '-ch' + ch.n,
                    selected: current && current.lesson_key === m.id + '-ch' + ch.n ? '' : null
                }, 'Ch. ' + ch.n + ' — ' + ch.title));
            });
            if (group.children.length) select.appendChild(group);
        });
        form.appendChild(h('div.wa-field', {}, h('label', { for: 'wa-note-lesson' }, 'Chapitre lié'), select));

        const body = h('textarea.wa-textarea', {
            id: 'wa-note-body', rows: '8', maxlength: '100000',
            placeholder: 'Votre note… (le texte est conservé tel quel)'
        });
        body.value = current ? current.body : '';
        form.appendChild(h('div.wa-field', {}, h('label', { for: 'wa-note-body' }, 'Contenu'), body));

        const status = h('div.wa-sr-only', { role: 'status', 'aria-live': 'polite' });
        const submit = h('button.wa-btn.primary', { type: 'submit' }, icon('save', 15), current ? 'Enregistrer' : 'Ajouter la note');
        const cancel = current ? h('button.wa-btn.ghost', {
            type: 'button',
            onclick: () => { editingNote = 0; renderRoute(); }
        }, 'Annuler') : null;
        form.appendChild(h('div.wa-btn-row', {}, submit, cancel));
        form.appendChild(status);

        form.addEventListener('submit', async ev => {
            ev.preventDefault();
            if (!title.value.trim() && !body.value.trim()) {
                toast('Ajoutez un titre ou du contenu.', 'err');
                title.focus();
                return;
            }
            submit.disabled = true;
            try {
                const res = await WA.api.post('note-save', {
                    id: editingNote || 0,
                    title: title.value.trim(),
                    body: body.value,
                    lessonKey: select.value || null
                });
                NOTES = res.notes || [];
                editingNote = 0;
                toast('Note enregistrée.', 'ok');
                renderRoute();
            } catch (err) {
                toast(err.message, 'err');
                status.textContent = err.message;
            } finally {
                submit.disabled = false;
            }
        });
        return form;
    }

    function notesList() {
        const box = h('section', { 'aria-label': 'Liste des notes' });
        const head = h('div.wa-overview-head', {},
            h('h2.wa-section-title', {}, NOTES.length + ' note' + (NOTES.length > 1 ? 's' : '')),
            h('span.wa-meta', {}, 'triées par mise à jour'));
        box.appendChild(head);

        if (!NOTES.length) {
            box.appendChild(h('div.wa-empty', {}, 'Aucune note pour le moment. Utilisez le formulaire pour en créer une.'));
            return box;
        }

        const grid = h('div.wa-notes-grid');
        NOTES.forEach(note => {
            const card = h('article.wa-notecard', {},
                h('h4', {}, note.title || 'Note'),
                note.lesson_key ? h('a.wa-notemeta', { href: href('lesson/' + note.lesson_key.replace('-ch', '/')) }, icon('link', 12), lessonLongTitle(...splitKey(note.lesson_key))) : null,
                h('div.wa-note-body', {}, note.body || ''),
                h('div.foot', {},
                    h('span.wa-notedate', {}, WA.ui.formatDate(note.updated_at || note.created_at)),
                    h('div.wa-btn-row', {},
                        h('button.wa-iconbtn', {
                            type: 'button', 'aria-label': 'Modifier la note ' + (note.title || ''), title: 'Modifier',
                            onclick: () => {
                                editingNote = Number(note.id);
                                renderRoute().then(() => {
                                    const t = document.getElementById('wa-note-title');
                                    if (t) t.focus();
                                });
                            }
                        }, icon('pencil', 15)),
                        h('button.wa-iconbtn', {
                            type: 'button', 'aria-label': 'Supprimer la note ' + (note.title || ''), title: 'Supprimer',
                            onclick: async () => {
                                const ok = await WA.ui.ask('Cette note sera définitivement supprimée.', {
                                    title: 'Supprimer la note ?',
                                    confirmLabel: 'Supprimer',
                                    danger: true
                                });
                                if (!ok) return;
                                try {
                                    const res = await WA.api.post('note-delete', { id: Number(note.id) });
                                    NOTES = res.notes || [];
                                    if (Number(note.id) === editingNote) editingNote = 0;
                                    toast('Note supprimée.', 'ok');
                                    renderRoute();
                                } catch (err) {
                                    toast(err.message, 'err');
                                }
                            }
                        }, icon('trash', 15)))));
            grid.appendChild(card);
        });
        box.appendChild(grid);
        return box;
    }

    /* ------------------------------------------------------------ progress */

    function progressPage() {
        const root = h('div.wa-progress-page');
        const c = counts();
        const all = availableLessons();
        const pMap = progressMap();

        let quizCount = 0;
        let quizSum = 0;
        Object.values(pMap).forEach(rec => {
            if (rec && typeof rec.quizScore === 'number') {
                quizCount++;
                quizSum += rec.quizScore;
            }
        });
        const avgQuiz = quizCount ? Math.round(quizSum / quizCount) : 0;
        const favCount = (BOOT.progress && Array.isArray(BOOT.progress.bookmarks)) ? BOOT.progress.bookmarks.length : 0;

        root.appendChild(pageHead({
            overline: 'Suivi & Performances',
            title: 'Ma progression',
            lead: 'Suivez l\'avancement détaillé de votre apprentissage, visualisez votre progression par langage et retrouvez vos scores aux quiz.',
            actions: [h('a.wa-btn.primary', { href: href('dashboard') }, icon('arrowLeft', 15), 'Tableau de bord')]
        }));

        // 1. Overview Hero Card
        const overview = h('section.wa-card.wa-progress-hero');
        const heroHead = h('div.wa-progress-hero-head', {},
            h('div.wa-progress-hero-titles', {},
                h('span.wa-badge.yellow', {}, 'VUE D\'ENSEMBLE'),
                h('h2.wa-progress-hero-title', {}, 'Parcours Global WebAcademy'),
                h('p.wa-progress-hero-sub', {}, c.done + ' chapitre' + (c.done > 1 ? 's' : '') + ' validé' + (c.done > 1 ? 's' : '') + ' sur ' + c.total + ' disponibles dans 8 modules.')
            ),
            h('div.wa-progress-hero-pct', {},
                h('span.wa-progress-big-number', {}, c.pct + '%'),
                h('span.wa-progress-big-lbl', {}, 'COMPLÉTÉ')
            )
        );
        overview.appendChild(heroHead);

        // Mega progress bar
        const bar = h('div.wa-progress-megabar', {
            role: 'progressbar',
            'aria-valuenow': String(c.pct),
            'aria-valuemin': '0',
            'aria-valuemax': '100',
            'aria-label': 'Progression globale'
        },
            h('div.wa-progress-megabar-fill' + (c.pct === 100 ? '.ok' : ''), { style: 'width:' + c.pct + '%' },
                c.pct > 10 ? h('span.wa-progress-megabar-text', {}, c.pct + '%') : null
            )
        );
        overview.appendChild(bar);

        // Stat cards row
        const statRow = h('div.wa-progress-stat-row', {},
            h('div.wa-stat-card', {},
                h('span.wa-stat-num', {}, String(c.done)),
                h('span.wa-stat-label', {}, 'Chapitres terminés')
            ),
            h('div.wa-stat-card', {},
                h('span.wa-stat-num', {}, String(c.total - c.done)),
                h('span.wa-stat-label', {}, 'Chapitres restants')
            ),
            h('div.wa-stat-card', {},
                h('span.wa-stat-num', {}, quizCount ? (avgQuiz + '%') : '0%'),
                h('span.wa-stat-label', {}, 'Moyenne quiz (' + quizCount + ' passé' + (quizCount > 1 ? 's' : '') + ')')
            ),
            h('div.wa-stat-card', {},
                h('span.wa-stat-num', {}, String(favCount)),
                h('span.wa-stat-label', {}, 'Favoris enregistrés')
            )
        );
        overview.appendChild(statRow);
        root.appendChild(overview);

        // 2. Modules Grid Section
        const modSection = h('section.wa-progress-mod-section');
        modSection.appendChild(h('div.wa-section-head', {},
            h('h2', {}, 'Avancement par Langage & Module'),
            h('span.wa-meta', {}, '8 technologies au programme')
        ));

        const modGrid = h('div.wa-progress-mod-grid');
        modules().forEach(m => {
            const mc = moduleCounts(m.id);
            if (!mc.total) return;

            const modCard = h('article.wa-card.wa-progress-mod-card', { 'data-mod': m.id },
                h('div.wa-prog-card-top', {},
                    h('div.wa-prog-card-badge-wrap', {},
                        h('span.wa-prog-sticker.' + (m.color || 'yellow'), {}, m.name),
                        h('span.wa-badge.ghost', {}, mc.done + '/' + mc.total)
                    ),
                    h('span.wa-prog-mod-pct', {}, mc.pct + '%')
                ),
                h('div.wa-prog-card-body', {},
                    h('h3.wa-prog-mod-name', {}, m.name),
                    h('p.wa-prog-mod-blurb', {}, m.blurb || 'Cursus interactif')
                ),
                h('div.wa-prog-card-bar-wrap', {},
                    h('div.wa-prog-mod-bar', {},
                        h('span.wa-prog-mod-bar-fill.' + (m.color || 'yellow'), { style: 'width:' + mc.pct + '%' })
                    )
                ),
                h('div.wa-prog-card-foot', {},
                    h('span.wa-prog-card-status', {}, mc.pct === 100 ? 'Validé' : (mc.pct > 0 ? 'En cours' : 'À commencer')),
                    h('a.wa-btn.small.primary', {
                        href: m.course ? href('course/' + m.id) : lessonHref(m.id, 1)
                    }, 'Ouvrir', icon('arrowRight', 12))
                )
            );
            modGrid.appendChild(modCard);
        });
        modSection.appendChild(modGrid);
        root.appendChild(modSection);

        // 3. Chapters Detail Section with Instant Filter
        const chapSection = h('section.wa-progress-chap-section');
        chapSection.appendChild(h('div.wa-section-head', {},
            h('h2', {}, 'Détail des 154 Chapitres'),
            h('span.wa-meta', {}, 'statut · quiz · favori')
        ));

        const chapCard = h('div.wa-card.wa-progress-chap-card');

        // Filter toolbar
        let currentFilter = 'all';
        const filterBar = h('div.wa-progress-filter-bar');
        const filterButtons = [
            { id: 'all', label: 'Tous (' + all.length + ')' },
            { id: 'done', label: 'Terminés (' + c.done + ')' },
            { id: 'in_progress', label: 'En cours' },
            { id: 'todo', label: 'À lire (' + (c.total - c.done) + ')' }
        ];

        const list = h('div.wa-progress-list');

        function renderChapters(filter) {
            list.innerHTML = '';
            const filtered = all.filter(l => {
                const status = statusOf(l.module, l.ch);
                if (filter === 'done') return status === 'done';
                if (filter === 'in_progress') return status === 'in_progress';
                if (filter === 'todo') return status !== 'done' && status !== 'in_progress';
                return true;
            });

            if (filtered.length === 0) {
                list.appendChild(h('div.wa-empty-hint', { style: 'padding:28px 16px;text-align:center;color:var(--muted);font-weight:700;' },
                    'Aucun chapitre dans cette catégorie.'
                ));
                return;
            }

            filtered.forEach(l => {
                const status = statusOf(l.module, l.ch);
                const rec = pMap[l.module + '-ch' + l.ch] || {};
                const mod = moduleMeta(l.module);
                list.appendChild(h('div.wa-progressrow', {},
                    h('div.wa-progressrow-left', {},
                        h('span.wa-progressrow-mod-tag.' + (mod.color || 'yellow'), {}, mod.name + ' · Ch.' + String(l.ch).padStart(2, '0')),
                        h('a.wa-progressrow-title', { href: lessonHref(l.module, l.ch) }, l.title)
                    ),
                    h('div.wa-progressrow-right', {},
                        badge(status === 'done' ? 'ok' : status === 'in_progress' ? 'warn' : 'muted',
                            status === 'done' ? 'Terminé' : status === 'in_progress' ? 'En cours' : 'À lire'),
                        rec.quizScore ? h('span.wa-badge.info', {}, 'Quiz ' + rec.quizScore + ' %') : null,
                        isBookmarked(l.module, l.ch) ? h('span.wa-badge.accent', {}, icon('star', 12), ' Favori') : null,
                        h('a.wa-btn.small', { href: lessonHref(l.module, l.ch) }, 'Ouvrir')
                    )
                ));
            });
        }

        filterButtons.forEach(fb => {
            const btn = h('button.wa-filter-btn' + (fb.id === currentFilter ? '.active' : ''), {
                type: 'button',
                onclick: () => {
                    currentFilter = fb.id;
                    filterBar.querySelectorAll('.wa-filter-btn').forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    renderChapters(currentFilter);
                }
            }, fb.label);
            filterBar.appendChild(btn);
        });

        chapCard.appendChild(filterBar);
        chapCard.appendChild(list);
        chapSection.appendChild(chapCard);
        root.appendChild(chapSection);

        // Initial chapters render
        renderChapters('all');

        // 4. Danger Zone
        const danger = h('section.wa-card.wa-danger-zone');
        danger.appendChild(h('div.wa-danger-head', {},
            h('span.wa-badge.err', {}, 'ZONE DE DANGER'),
            h('h3', {}, 'Réinitialiser la progression')
        ));
        danger.appendChild(h('p.wa-danger-desc', {},
            'Efface le statut de toutes les leçons, les scores de quiz et les exercices validés. Vos notes personnelles et vos favoris sont conservés intacts.'
        ));
        danger.appendChild(h('div.wa-btn-row', {},
            h('button.wa-btn.danger', {
                type: 'button',
                onclick: async () => {
                    const ok = await WA.ui.ask('Les statuts, scores de quiz et exercices seront effacés. Cette action est irréversible.', {
                        title: 'Réinitialiser la progression ?',
                        confirmLabel: 'Réinitialiser',
                        danger: true
                    });
                    if (!ok) return;
                    try {
                        const res = await WA.api.post('progress-reset', {});
                        applyProgress(res);
                        toast('Progression réinitialisée.', 'ok');
                        renderRoute();
                    } catch (err) {
                        toast(err.message, 'err');
                    }
                }
            }, icon('refresh', 15), 'Réinitialiser toute la progression')
        ));
        root.appendChild(danger);

        return root;
    }

    function applyProgress(res) {
        if (!BOOT) return;
        BOOT.progress = Object.assign({}, BOOT.progress, {
            map: res.map || {},
            bookmarks: res.bookmarks || [],
            recent: res.recent || [],
            exercises: res.exercises || []
        });
    }

    /* ------------------------------------------------------------ glossary */

    async function glossaryPage() {
        const root = h('div');
        root.appendChild(pageHead({
            overline: 'Référence',
            title: 'Glossaire',
            lead: 'Les termes essentiels du cours, expliqués en français et en darija, avec un exemple de code quand c’est utile.'
        }));

        let terms = [];
        try {
            const res = await WA.api.get('glossary');
            terms = (res.glossary && res.glossary.terms) || [];
        } catch (err) {
            root.appendChild(errorState(err));
            return root;
        }
        const tools = h('div.wa-glossary-tools');
        const search = h('input.wa-input', {
            type: 'search', id: 'wa-glossary-search', placeholder: 'Chercher un terme…',
            'aria-label': 'Rechercher dans le glossaire'
        });
        const filter = h('select.wa-select', { 'aria-label': 'Filtrer par module' });
        filter.appendChild(h('option', { value: '' }, 'Tous les modules'));
        modules().forEach(m => filter.appendChild(h('option', { value: m.id }, m.name)));
        tools.appendChild(search);
        tools.appendChild(filter);
        const counter = h('span.wa-meta', { role: 'status', 'aria-live': 'polite' });
        tools.appendChild(counter);
        root.appendChild(tools);

        const host = h('div');
        root.appendChild(host);

        const paint = () => {
            const q = search.value.trim().toLowerCase();
            const mod = filter.value;
            const visible = terms.filter(t => {
                if (mod && t.module !== mod) return false;
                if (!q) return true;
                return (String(t.term) + ' ' + (t.fr || '') + ' ' + (t.darija || '')).toLowerCase().indexOf(q) !== -1;
            });
            counter.textContent = visible.length + ' terme' + (visible.length > 1 ? 's' : '');
            host.innerHTML = '';
            if (!visible.length) {
                host.appendChild(h('div.wa-empty', {}, 'Aucun terme ne correspond à cette recherche.'));
                return;
            }
            const groups = {};
            visible.forEach(t => {
                const letter = String(t.term || '?').charAt(0).toUpperCase();
                (groups[letter] = groups[letter] || []).push(t);
            });
            Object.keys(groups).sort((a, b) => a.localeCompare(b, 'fr')).forEach(letter => {
                host.appendChild(h('h2.wa-glossletter', {}, letter));
                const grid = h('div.wa-gloss');
                groups[letter].forEach(t => {
                    const card = h('article.wa-kw', {});
                    card.appendChild(h('div', { style: 'display:flex;align-items:center;gap:8px;justify-content:space-between;margin-bottom:6px' },
                        h('b', {}, t.term),
                        badge(t.module === 'integration' ? 'accent' : 'info', moduleMeta(t.module).name)));
                    card.appendChild(h('span.f.fr-only', { html: t.fr || '' }));
                    if (t.darija) {
                        card.appendChild(h('div.wa-darija', { style: 'margin:8px 0 0;padding:8px 10px;font-size:12.5px' },
                            h('span.flag', {}, 'Darija'),
                            h('div', { html: t.darija })));
                    }
                    if (t.exemple) card.appendChild(WA.ui.codeBlock(t.exemple, t.lang || 'text', t.term));
                    grid.appendChild(card);
                });
                host.appendChild(grid);
            });
        };
        search.addEventListener('input', WA.ui.debounce(paint, 120));
        filter.addEventListener('change', paint);
        paint();
        return root;
    }

    /* ------------------------------------------------------------ projects */

    async function projectsPage(courseFilter) {
        const root = h('div');
        root.appendChild(pageHead({
            overline: 'Pratique guidée',
            title: 'Projets',
            lead: 'Des projets complets, étape par étape, pour relier HTML, CSS, PHP, SQL, C++ et JavaScript dans une vraie application.'
        }));

        let projects = [];
        try {
            const res = await WA.api.get('projects');
            projects = res.projects || [];
        } catch (err) {
            root.appendChild(errorState(err));
            return root;
        }
        if (!projects.length) {
            root.appendChild(emptyState('rocket', 'Aucun projet publié', 'Les projets guidés apparaîtront ici dès qu’ils seront disponibles.', null));
            return root;
        }

        const filters = h('div.wa-project-filters', { role: 'group', 'aria-label': 'Filtrer les projets par parcours' });
        [['', 'Tous'], ['html', 'HTML/CSS'], ['php', 'PHP'], ['sql', 'SQL'], ['cpp', 'C++'], ['javascript', 'JavaScript']].forEach(([value, label]) => {
            filters.appendChild(h('a.wa-filter-chip' + ((courseFilter || '') === value ? '.on' : ''), {
                href: href('projects') + (value ? '?course=' + value : '')
            }, label));
        });
        root.appendChild(filters);

        const visible = projects.filter(p => !courseFilter
            || p.course === courseFilter
            || (courseFilter === 'html' && (p.lang === 'html' || p.lang === 'css'))
            || (courseFilter === 'php' && p.lang === 'php' && !p.course)
            || (courseFilter === 'sql' && p.lang === 'sql' && !p.course));
        if (!visible.length) {
            root.appendChild(emptyState('rocket', 'Aucun projet dans ce parcours', 'Choisissez un autre filtre ou consultez tous les projets.', [h('a.wa-btn', { href: href('projects') }, 'Tous les projets')]));
            return root;
        }

        visible.forEach((p, index) => {
            const details = h('details.wa-project', { open: index === 0 });
            const projectCourse = p.course ? moduleMeta(p.course).name : 'Web';
            const summary = h('summary', {},
                h('div.wa-project-head', {},
                    badge('accent', projectCourse),
                    h('b', {}, p.title),
                    h('span.level', {}, p.level || ''),
                    h('span.chev', { 'aria-hidden': 'true' }, icon('chevron', 15))));
            details.appendChild(summary);

            const body = h('div.wa-project-body');
            body.appendChild(h('div.wa-project-intro', { html: p.objective || '' }));

            (p.steps || []).forEach((s, i) => {
                const step = h('div.wa-step');
                step.appendChild(h('div.wa-step-title', {}, 'Étape ' + (i + 1)));
                step.appendChild(h('h4', {}, s.title || ''));
                if (s.explain) step.appendChild(h('div', { html: s.explain }));
                if (s.darija) {
                    step.appendChild(h('div.wa-darija', {},
                        h('span.flag', {}, 'Darija'),
                        h('div', {}, s.darija)));
                }
                if (s.code) step.appendChild(WA.ui.codeBlock(s.code, s.lang || p.lang || 'php', s.file || s.title));
                if (s.files && Array.isArray(s.files)) {
                    s.files.forEach(f => {
                        if (f && f.code) step.appendChild(WA.ui.codeBlock(f.code, f.lang || 'php', f.name));
                    });
                }
                if (s.check) {
                    step.appendChild(h('div.wa-check', {}, icon('check', 14), h('span', { html: s.check })));
                }
                body.appendChild(step);
            });

            details.appendChild(body);
            root.appendChild(details);
        });
        return root;
    }

    /* ------------------------------------------------------------ search */

    function searchPage(initial) {
        const root = h('div');
        root.appendChild(pageHead({
            overline: 'Recherche',
            title: 'Trouver un passage',
            lead: 'La recherche parcourt les titres, les explications et les blocs de code des chapitres rédigés.'
        }));

        const form = h('form.wa-search-form', { role: 'search' });
        const input = h('input.wa-input', {
            type: 'search', name: 'q', value: initial, placeholder: 'Ex. : balise, flexbox, PDO…',
            'aria-label': 'Termes à rechercher', minlength: '2', maxlength: '120'
        });
        form.appendChild(input);
        form.appendChild(h('button.wa-btn.primary', { type: 'submit' }, icon('search', 15), 'Rechercher'));
        root.appendChild(form);

        const results = h('div.wa-search-results', { id: 'wa-search-results', 'aria-live': 'polite' });
        root.appendChild(results);

        form.addEventListener('submit', ev => {
            ev.preventDefault();
            const q = input.value.trim();
            if (q.length < 2) { toast('Saisissez au moins deux caractères.', 'err'); input.focus(); return; }
            const next = href('search') + '?q=' + encodeURIComponent(q);
            if (location.hash === next) run(q);
            else location.hash = next;
        });

        const run = async q => {
            const seq = ++searchSeq;
            if (!q || q.length < 2) {
                results.innerHTML = '';
                results.appendChild(h('div.wa-empty', {}, 'Saisissez au moins deux caractères pour lancer la recherche.'));
                return;
            }
            results.innerHTML = '';
            results.appendChild(h('div.wa-boot', { style: 'min-height:140px' }, h('span', {}, 'Recherche en cours…')));
            try {
                const res = await WA.api.get('search', { q });
                if (seq !== searchSeq) return;
                results.innerHTML = '';
                const hits = res.results || [];
                if (!hits.length) {
                    results.appendChild(emptyState('search', 'Aucun résultat', 'Essayez un terme plus court ou plus général, par exemple « balise » ou « requête ».', null));
                    return;
                }
                results.appendChild(h('div.wa-overview-head', {},
                    h('h2.wa-section-title', {}, hits.length + ' résultat' + (hits.length > 1 ? 's' : '')),
                    h('span.wa-meta', {}, 'pour « ' + q + ' »')));
                hits.forEach(hit => {
                    results.appendChild(h('a.wa-hit', { href: lessonHref(hit.module, hit.ch) },
                        h('div', {},
                            h('span.wa-hit-title', {}, hit.title),
                            h('span.wa-hit-meta', {}, moduleMeta(hit.module).name + ' · Ch. ' + hit.ch)),
                        hit.snippet ? h('div.wa-hit-snippet', {}, hit.snippet) : null));
                });
            } catch (err) {
                if (seq !== searchSeq) return;
                results.innerHTML = '';
                results.appendChild(errorState(err));
            }
        };

        run(initial);
        return root;
    }

    /* ------------------------------------------------------------ settings */

    function settingsPage() {
        const settings = data('settings') || {};
        const root = h('div');
        root.appendChild(pageHead({
            overline: 'Configuration du Système',
            title: 'Paramètres & Préférences',
            lead: 'Personnalisez le thème d\'affichage (Clair / Sombre), la langue des cours (Français / Darija / Bilingue), et gérez vos données.'
        }));

        const grid = h('div.wa-settings-grid');

        // 1. THEME & APPARENCE
        const appearance = h('section.wa-card.wa-setting');
        appearance.appendChild(h('div.wa-setting-head', {},
            h('h3', {}, 'Thème Visuel & Mode d\'Affichage'),
            h('span.wa-badge.yellow', {}, 'NÉO-BRUTALISME')
        ));
        appearance.appendChild(h('p.wa-setting-desc', {},
            'Choisissez votre ambiance visuelle. Basculez en un clic entre le Mode Clair et le Mode Sombre Cyber.'
        ));

        const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
        const themeGrid = h('div.wa-theme-cards-grid');

        const lightIndicator = h('span.wa-card-active-indicator', {}, currentTheme === 'light' ? 'ACTIF' : '');
        const darkIndicator = h('span.wa-card-active-indicator', {}, currentTheme === 'dark' ? 'ACTIF' : '');

        const lightCard = h('button.wa-theme-card' + (currentTheme === 'light' ? '.active' : ''), {
            type: 'button',
            onclick: () => {
                applyTheme('light', true);
                lightCard.classList.add('active');
                darkCard.classList.remove('active');
                lightIndicator.textContent = 'ACTIF';
                darkIndicator.textContent = '';
                WA.ui.toast('Mode Clair activé !');
            }
        },
            h('div.wa-theme-card-head', {},
                h('div.wa-theme-card-tags', {},
                    h('span.wa-bigcard-sticker', {}, 'MODE CLAIR'),
                    lightIndicator
                ),
                icon('sun', 24)
            ),
            h('h4.wa-theme-card-title', {}, 'Papier Crème & Encre Noire'),
            h('p.wa-theme-card-desc', {}, 'Ambiance solaire (#FFFDF5), bordures noires nettes et ombres dures tactiles.'),
            h('div.wa-theme-preview.light', {},
                h('span.wa-badge', { style: 'background:#FFE600;color:#000;border:1.5px solid #000;' }, 'Bouton'),
                h('span.wa-badge', { style: 'background:#4ECCA3;color:#000;border:1.5px solid #000;' }, 'Atelier'),
                h('span.wa-badge', { style: 'background:#FF6B8B;color:#000;border:1.5px solid #000;' }, 'PHP')
            )
        );

        const darkCard = h('button.wa-theme-card' + (currentTheme === 'dark' ? '.active' : ''), {
            type: 'button',
            onclick: () => {
                applyTheme('dark', true);
                darkCard.classList.add('active');
                lightCard.classList.remove('active');
                darkIndicator.textContent = 'ACTIF';
                lightIndicator.textContent = '';
                WA.ui.toast('Mode Sombre Cyber activé !');
            }
        },
            h('div.wa-theme-card-head', {},
                h('div.wa-theme-card-tags', {},
                    h('span.wa-bigcard-sticker', {}, 'MODE SOMBRE'),
                    darkIndicator
                ),
                icon('moon', 24)
            ),
            h('h4.wa-theme-card-title', {}, 'Cyber Ardoise & Néon'),
            h('p.wa-theme-card-desc', {}, 'Ardoise cyber (#111216), bordures élégantes, ombres profondes et néon vibrant.'),
            h('div.wa-theme-preview.dark', {},
                h('span.wa-badge', { style: 'background:#FFE600;color:#000;border:1.5px solid #FFE600;' }, 'Bouton'),
                h('span.wa-badge', { style: 'background:#4ECCA3;color:#000;border:1.5px solid #4ECCA3;' }, 'Atelier'),
                h('span.wa-badge', { style: 'background:#FF6B8B;color:#000;border:1.5px solid #FF6B8B;' }, 'PHP')
            )
        );

        themeGrid.appendChild(lightCard);
        themeGrid.appendChild(darkCard);
        appearance.appendChild(themeGrid);
        grid.appendChild(appearance);

        // 2. LANGUE DES CONTENUS
        const language = h('section.wa-card.wa-setting');
        language.appendChild(h('div.wa-setting-head', {},
            h('h3', {}, 'Langue des Explications Pédagogiques'),
            h('span.wa-badge.mint', {}, 'PEDAGOGIE')
        ));
        language.appendChild(h('p.wa-setting-desc', {},
            'Choisissez la langue d\'affichage des explications théoriques et des commentaires.'
        ));

        const langGrid = h('div.wa-lang-cards-grid');
        const langCards = [
            {
                id: 'fr',
                badge: 'FRANÇAIS',
                title: 'Français',
                desc: 'Explications rédigées en français uniquement.',
                flag: 'FR'
            },
            {
                id: 'darija',
                badge: 'DARIJA',
                title: 'Darija Marocain',
                desc: 'Explications en darija marocain (tournures naturelles et mots techniques).',
                flag: 'MA'
            },
            {
                id: 'bilingual',
                badge: 'RECOMMANDÉ',
                title: 'Mode Bilingue',
                desc: 'Explication en français suivie de la version darija pour une double compréhension.',
                flag: 'FR + MA'
            }
        ];

        langCards.forEach(l => {
            const isAct = lang === l.id;
            const langIndicator = h('span.wa-card-active-indicator', {}, isAct ? 'ACTIF' : '');
            const c = h('button.wa-lang-card' + (isAct ? '.active' : ''), {
                type: 'button',
                onclick: () => {
                    applyLang(l.id, true);
                    langGrid.querySelectorAll('.wa-lang-card').forEach(el => {
                        el.classList.remove('active');
                        const ind = el.querySelector('.wa-card-active-indicator');
                        if (ind) ind.textContent = '';
                    });
                    c.classList.add('active');
                    langIndicator.textContent = 'ACTIF';
                    WA.ui.toast('Langue changée : ' + l.title);
                }
            },
                h('div.wa-theme-card-head', {},
                    h('div.wa-theme-card-tags', {},
                        h('span.wa-bigcard-sticker', {}, l.badge),
                        langIndicator
                    ),
                    h('span.wa-badge', { style: 'font-weight:900;' }, l.flag)
                ),
                h('h4.wa-theme-card-title', {}, l.title),
                h('p.wa-theme-card-desc', {}, l.desc)
            );
            langGrid.appendChild(c);
        });

        language.appendChild(langGrid);
        grid.appendChild(language);

        const exam = h('section.wa-card.wa-setting');
        exam.appendChild(h('div.wa-setting-head', {}, h('h3', {}, 'Mode révision')));
        exam.appendChild(h('p.wa-setting-desc', {}, 'Un rappel visuel pour privilégier les quiz et les exercices avant la lecture complète.'));
        const switchLabel = h('label.wa-switch', { for: 'wa-exam-mode' });
        const examInput = h('input', {
            type: 'checkbox', id: 'wa-exam-mode',
            checked: settings.examMode ? '' : null,
            onchange: () => {
                WA.api.post('settings-save', { examMode: !!examInput.checked })
                    .then(() => toast('Mode révision ' + (examInput.checked ? 'activé' : 'désactivé') + '.', 'ok'))
                    .catch(err => toast(err.message, 'err'));
            }
        });
        switchLabel.appendChild(examInput);
        switchLabel.appendChild(h('span.wa-switch-track', { 'aria-hidden': 'true' }));
        switchLabel.appendChild(h('span.wa-switch-text', {},
            h('b', {}, 'Prioriser les quiz'),
            h('span', {}, 'Afficher les évaluations en premier dans les leçons.')));
        exam.appendChild(switchLabel);
        grid.appendChild(exam);

        const dataCard = h('section.wa-card.wa-setting');
        dataCard.appendChild(h('div.wa-setting-head', {}, h('h3', {}, 'Mes données')));
        dataCard.appendChild(h('p.wa-setting-desc', {}, 'Exportez vos notes et votre progression dans un fichier JSON, ou repartez de zéro.'));
        dataCard.appendChild(h('div.wa-data-actions', {},
            h('button.wa-btn', {
                type: 'button',
                onclick: async () => {
                    try {
                        const notesRes = await WA.api.get('notes');
                        const payload = {
                            exportedAt: new Date().toISOString(),
                            version: data('version'),
                            settings: data('settings'),
                            progress: data('progress'),
                            notes: notesRes.notes || []
                        };
                        const blob = new Blob([JSON.stringify(payload, null, 2)], { type: 'application/json' });
                        const url = URL.createObjectURL(blob);
                        const a = h('a', { href: url, download: 'webacademy-donnees.json' });
                        document.body.appendChild(a);
                        a.click();
                        a.remove();
                        setTimeout(() => URL.revokeObjectURL(url), 1000);
                        toast('Export téléchargé.', 'ok');
                    } catch (err) {
                        toast(err.message, 'err');
                    }
                }
            }, icon('download', 15), 'Exporter en JSON'),
            h('button.wa-btn.danger', {
                type: 'button',
                onclick: async () => {
                    const ok = await WA.ui.ask('Les statuts, scores et exercices seront effacés. Les notes et favoris restent intacts.', {
                        title: 'Réinitialiser la progression ?', confirmLabel: 'Réinitialiser', danger: true
                    });
                    if (!ok) return;
                    try {
                        const res = await WA.api.post('progress-reset', {});
                        applyProgress(res);
                        toast('Progression réinitialisée.', 'ok');
                    } catch (err) { toast(err.message, 'err'); }
                }
            }, icon('refresh', 15), 'Réinitialiser la progression')));
        grid.appendChild(dataCard);

        const mobileCard = h('section.wa-card.wa-setting');
        mobileCard.appendChild(h('div.wa-setting-head', {},
            h('h3', {}, 'Application Mobile Android'),
            h('span.wa-badge.yellow', {}, 'CAPACITOR · APK')
        ));
        mobileCard.appendChild(h('p.wa-setting-desc', {},
            'Installez WebAcademy sur votre smartphone Android avec le fichier APK officiel pour apprendre le code partout.'
        ));
        mobileCard.appendChild(h('div.wa-data-actions', {},
            h('a.wa-btn.primary', {
                href: 'webacademy.apk',
                download: 'webacademy.apk',
                style: 'display: inline-flex; align-items: center; gap: 8px; text-decoration: none;'
            }, icon('download', 16), 'Télécharger l\'APK Android (3.7 Mo)')
        ));
        grid.appendChild(mobileCard);

        const about = h('section.wa-card.wa-setting');
        about.appendChild(h('div.wa-setting-head', {}, h('h3', {}, 'À propos')));
        const mysql = data('mysql') || {};
        const datasets = data('datasets') || {};
        about.appendChild(h('dl.wa-kv', {},
            h('dt', {}, 'Version'), h('dd', {}, 'WebAcademy ' + (data('version') || '2.0.0')),
            h('dt', {}, 'Pile technique'), h('dd', {}, 'PHP 8 · SQLite · JavaScript vanilla · CodeMirror 5'),
            h('dt', {}, 'Base personnelle'), h('dd', {}, 'SQLite privée, hors racine publique'),
            h('dt', {}, 'MySQL'), h('dd', {}, mysql.reachable ? 'Joignable — ' + (mysql.detail || '') : 'Non joignable — les ateliers SQL basculent sur SQLite'),
            h('dt', {}, 'Jeux SQL'), h('dd', {}, Object.keys(datasets).map(id => datasets[id].label || id).join(', ') || 'Aucun'),
            h('dt', {}, 'Oracle'), h('dd', {}, 'Non installé — aucune exécution simulée, message pédagogique affiché')));
        grid.appendChild(about);

        root.appendChild(grid);
        return root;
    }

    /* ------------------------------------------------------------ espace membre / auth */

    function loginPage() {
        const root = h('div.wa-auth-container');
        const user = (BOOT && BOOT.user) || null;

        if (user) {
            // Profil de l'utilisateur connecté
            const card = h('div.wa-card.wa-auth-card');
            const header = h('div.wa-card-header', {},
                h('div.wa-tag' + (user.is_guest ? '.pink' : '.yellow'), {}, user.is_guest ? 'MODE INVITÉ ACTIF' : 'ÉTUDIANT CERTIFIÉ'),
                h('h1', { style: 'font-size:1.8rem;font-weight:900;' }, 'Mon Espace Membre')
            );
            card.appendChild(header);

            const profileBody = h('div', { style: 'display:flex;flex-direction:column;gap:18px;' });

            const userHero = h('div', {
                style: 'display:flex;align-items:center;gap:18px;background:var(--paper-deep);padding:18px;border:var(--bw) solid var(--line);border-radius:var(--radius);box-shadow:var(--shadow-card);'
            },
                renderAvatar(user.avatar, 64),
                h('div', { style: 'flex:1;' },
                    h('h2', { style: 'font-size:1.35rem;font-weight:900;margin-bottom:4px;' }, user.username),
                    h('div.wa-badge' + (user.is_guest ? '.orange' : '.mint'), {}, user.is_guest ? 'Session Invité Locale' : (user.email || 'Compte Validé')),
                    h('div', { style: 'font-size:0.75rem;color:var(--muted);font-weight:700;margin-top:6px;' }, 'Statut : Connecté et persistant')
                )
            );
            profileBody.appendChild(userHero);

            if (user.is_guest) {
                const guestCallout = h('div.wa-callout.warn', {},
                    h('div.ttl', {}, icon('alert', 16), 'Mode Invité : progression locale'),
                    h('p', {}, 'Votre progression, vos exercices et vos notes sont enregistrés dans ce navigateur. Pour ne rien perdre et synchroniser vos cours, créez un compte permanent !'),
                    h('button.wa-btn.primary', {
                        onclick: async () => {
                            await WA.api.logout();
                            if (BOOT) BOOT.user = null;
                            renderSidebar();
                            renderRoute();
                        }
                    }, 'Créer un compte permanent →')
                );
                profileBody.appendChild(guestCallout);
            }

            // Sélecteur d'Avatar Neo-Brutalist
            const avSection = h('div', { style: 'margin-top:8px;' });
            avSection.appendChild(h('h3', { style: 'font-size:1rem;font-weight:900;text-transform:uppercase;margin-bottom:10px;' }, 'Choisis ton Avatar Néo-Brutaliste :'));
            const avGrid = h('div.wa-avatar-grid');
            AVATARS.forEach(a => {
                const isSelected = (user.avatar || 'neo-coder') === a.id;
                const opt = h('button.wa-avatar-option' + (isSelected ? '.active' : ''), {
                    type: 'button',
                    title: a.name,
                    onclick: async () => {
                        await WA.api.setAvatar(a.id);
                        if (BOOT && BOOT.user) BOOT.user.avatar = a.id;
                        WA.ui.toast('Avatar changé : ' + a.name);
                        renderSidebar();
                        renderRoute();
                    }
                },
                    renderAvatar(a.id, 42),
                    h('span.wa-avatar-opt-name', {}, a.name)
                );
                avGrid.appendChild(opt);
            });
            avSection.appendChild(avGrid);
            profileBody.appendChild(avSection);

            // Boutons d'action
            const actions = h('div.wa-btn-row', { style: 'margin-top:14px;' },
                h('a.wa-btn.primary', { href: href('dashboard') }, icon('home', 15), 'Aller au Tableau de bord'),
                h('a.wa-btn.secondary', { href: href('progress') }, icon('chart', 15), 'Ma Progression'),
                h('button.wa-btn.danger', {
                    type: 'button',
                    onclick: async () => {
                        if (confirm('Voulez-vous vous déconnecter ?')) {
                            await WA.api.logout();
                            if (BOOT) BOOT.user = null;
                            WA.ui.toast('Session fermée.');
                            renderSidebar();
                            renderRoute();
                        }
                    }
                }, icon('x', 14), 'Se Déconnecter')
            );
            profileBody.appendChild(actions);

            card.appendChild(profileBody);
            root.appendChild(card);
            return root;
        }

        // Non connecté : Vue avec Onglets (Connexion / Inscription / Mode Invité)
        const card = h('div.wa-card.wa-auth-card');
        const header = h('div.wa-card-header', {},
            h('div.wa-tag.yellow', {}, 'REJOINDRE WEBACADEMY'),
            h('h1', { style: 'font-size:1.8rem;font-weight:900;' }, 'Accéder aux Cours & Ateliers'),
            h('p', { style: 'font-size:0.95rem;color:var(--muted);' }, 'Connecte-toi avec tes identifiants, inscris-toi gratuitement ou démarre immédiatement en Mode Invité !')
        );
        card.appendChild(header);

        let activeTab = 'login'; // 'login' | 'register' | 'guest'
        let selectedAvatar = 'neo-coder';
        const formContainer = h('div');

        function renderTabs() {
            const tabs = h('div.wa-auth-tabs');
            [
                { id: 'login', label: 'Connexion' },
                { id: 'register', label: 'Inscription' },
                { id: 'guest', label: 'Mode Invité' }
            ].forEach(t => {
                const btn = h('button.wa-auth-tab' + (activeTab === t.id ? '.active' : ''), {
                    type: 'button',
                    onclick: () => {
                        activeTab = t.id;
                        paintForm();
                    }
                }, t.label);
                tabs.appendChild(btn);
            });
            return tabs;
        }

        function paintForm() {
            formContainer.innerHTML = '';
            formContainer.appendChild(renderTabs());

            const content = h('div');

            if (activeTab === 'login') {
                const form = h('form', {
                    onsubmit: async (ev) => {
                        ev.preventDefault();
                        const id = form.querySelector('[name=identifier]').value.trim();
                        const pwd = form.querySelector('[name=password]').value;
                        if (!id || !pwd) {
                            WA.ui.toast('Veuillez remplir tous les champs.', 'error');
                            return;
                        }
                        try {
                            const btn = form.querySelector('button[type=submit]');
                            btn.disabled = true;
                            btn.textContent = 'Connexion en cours…';
                            const res = await WA.api.login(id, pwd);
                            if (res.user) {
                                if (BOOT) BOOT.user = res.user;
                                WA.ui.toast('Bienvenue, ' + res.user.username + ' !');
                                renderSidebar();
                                navigate('dashboard');
                            }
                        } catch (err) {
                            WA.ui.toast(err.message || 'Erreur de connexion.', 'error');
                            const btn = form.querySelector('button[type=submit]');
                            btn.disabled = false;
                            btn.textContent = 'Se Connecter →';
                        }
                    }
                });

                form.appendChild(h('div.wa-form-group', {},
                    h('label.wa-label', { for: 'wa-login-id' }, 'Pseudo ou Adresse Email'),
                    h('input.wa-input', {
                        id: 'wa-login-id',
                        name: 'identifier',
                        type: 'text',
                        placeholder: 'Ex: salma ou salma@example.com',
                        required: true,
                        autocomplete: 'username'
                    })
                ));

                form.appendChild(h('div.wa-form-group', {},
                    h('label.wa-label', { for: 'wa-login-pwd' }, 'Mot de Passe'),
                    h('input.wa-input', {
                        id: 'wa-login-pwd',
                        name: 'password',
                        type: 'password',
                        placeholder: '••••••••',
                        required: true,
                        autocomplete: 'current-password'
                    })
                ));

                form.appendChild(h('div', { style: 'margin:12px 0 20px;font-size:0.85rem;' },
                    h('label', { style: 'display:inline-flex;align-items:center;gap:8px;font-weight:700;cursor:pointer;' },
                        h('input', { type: 'checkbox', checked: true, style: 'width:18px;height:18px;accent-color:var(--neo-yellow);' }),
                        'Garder ma session active (Recommandé pour APK / Mobile)'
                    )
                ));

                form.appendChild(h('button.wa-btn.primary', {
                    type: 'submit',
                    style: 'width:100%;font-size:1.05rem;padding:14px;'
                }, 'Se Connecter →'));

                content.appendChild(form);
            } else if (activeTab === 'register') {
                const form = h('form', {
                    onsubmit: async (ev) => {
                        ev.preventDefault();
                        const username = form.querySelector('[name=username]').value.trim();
                        const email = form.querySelector('[name=email]').value.trim();
                        const pwd = form.querySelector('[name=password]').value;
                        if (!username || !pwd) {
                            WA.ui.toast('Le pseudo et le mot de passe sont obligatoires.', 'error');
                            return;
                        }
                        try {
                            const btn = form.querySelector('button[type=submit]');
                            btn.disabled = true;
                            btn.textContent = 'Création du compte…';
                            const res = await WA.api.register(username, pwd, email, selectedAvatar);
                            if (res.user) {
                                if (BOOT) BOOT.user = res.user;
                                WA.ui.toast('Compte créé avec succès ! Bienvenue, ' + res.user.username);
                                renderSidebar();
                                navigate('dashboard');
                            }
                        } catch (err) {
                            WA.ui.toast(err.message || 'Erreur lors de l\'inscription.', 'error');
                            const btn = form.querySelector('button[type=submit]');
                            btn.disabled = false;
                            btn.textContent = 'Créer mon Compte →';
                        }
                    }
                });

                form.appendChild(h('div.wa-form-group', {},
                    h('label.wa-label', { for: 'wa-reg-user' }, 'Pseudo Étudiant'),
                    h('input.wa-input', {
                        id: 'wa-reg-user',
                        name: 'username',
                        type: 'text',
                        placeholder: 'Ex: dev_coder',
                        required: true,
                        autocomplete: 'username'
                    })
                ));

                form.appendChild(h('div.wa-form-group', {},
                    h('label.wa-label', { for: 'wa-reg-email' }, 'Email (Optionnel)'),
                    h('input.wa-input', {
                        id: 'wa-reg-email',
                        name: 'email',
                        type: 'email',
                        placeholder: 'etudiant@example.com',
                        autocomplete: 'email'
                    })
                ));

                form.appendChild(h('div.wa-form-group', {},
                    h('label.wa-label', { for: 'wa-reg-pwd' }, 'Mot de Passe (4+ caractères)'),
                    h('input.wa-input', {
                        id: 'wa-reg-pwd',
                        name: 'password',
                        type: 'password',
                        placeholder: '••••••••',
                        required: true,
                        autocomplete: 'new-password'
                    })
                ));

                // Avatar picker
                const avWrapper = h('div.wa-form-group');
                avWrapper.appendChild(h('label.wa-label', {}, 'Choisis ton Avatar Néo-Brutaliste :'));
                const avGrid = h('div.wa-avatar-grid');
                AVATARS.forEach(a => {
                    const opt = h('button.wa-avatar-option' + (selectedAvatar === a.id ? '.active' : ''), {
                        type: 'button',
                        onclick: () => {
                            selectedAvatar = a.id;
                            avGrid.querySelectorAll('.wa-avatar-option').forEach(el => el.classList.remove('active'));
                            opt.classList.add('active');
                        }
                    },
                        renderAvatar(a.id, 40),
                        h('span.wa-avatar-opt-name', {}, a.name)
                    );
                    avGrid.appendChild(opt);
                });
                avWrapper.appendChild(avGrid);
                form.appendChild(avWrapper);

                form.appendChild(h('button.wa-btn.mint', {
                    type: 'submit',
                    style: 'width:100%;font-size:1.05rem;padding:14px;margin-top:10px;'
                }, 'Créer mon Compte & Démarrer →'));

                content.appendChild(form);
            } else if (activeTab === 'guest') {
                const guestCard = h('div', {
                    style: 'display:flex;flex-direction:column;gap:16px;text-align:center;padding:12px 0;'
                });

                guestCard.appendChild(h('div', { style: 'width:64px;height:64px;margin:0 auto;display:flex;align-items:center;justify-content:center;background:var(--neo-yellow);border:var(--bw) solid var(--line);box-shadow:var(--shadow-hard);border-radius:var(--radius-sm);' }, icon('user', 32)));
                guestCard.appendChild(h('h2', { style: 'font-size:1.4rem;font-weight:900;' }, 'Explorer en Mode Invité'));
                guestCard.appendChild(h('p', { style: 'color:var(--muted);font-size:0.95rem;line-height:1.6;' },
                    'Pas besoin d\'identifiants ni de mot de passe ! Le mode invité te permet d\'accéder à tous les cours, d\'exécuter du code et de pratiquer immédiatement.'
                ));

                const features = h('div', {
                    style: 'display:flex;flex-direction:column;gap:8px;text-align:left;background:var(--paper-deep);padding:14px 18px;border:var(--bw) solid var(--line);border-radius:var(--radius);margin:6px 0;'
                },
                    h('div', { style: 'display:flex;align-items:center;gap:8px;font-weight:700;' }, icon('check', 14), 'Accès illimité à l\'ensemble des 154 chapitres'),
                    h('div', { style: 'display:flex;align-items:center;gap:8px;font-weight:700;' }, icon('check', 14), 'Exécuteurs PHP et SQL opérationnels'),
                    h('div', { style: 'display:flex;align-items:center;gap:8px;font-weight:700;' }, icon('check', 14), 'Sauvegarde locale de ta progression et de tes notes'),
                    h('div', { style: 'display:flex;align-items:center;gap:8px;font-weight:700;' }, icon('spark', 14), 'Conversion en compte permanent disponible à tout moment')
                );
                guestCard.appendChild(features);

                guestCard.appendChild(h('button.wa-btn.primary', {
                    type: 'button',
                    style: 'font-size:1.1rem;padding:16px;',
                    onclick: async () => {
                        try {
                            const res = await WA.api.guest();
                            if (res.user) {
                                if (BOOT) BOOT.user = res.user;
                                WA.ui.toast('Session Invité activée !');
                                renderSidebar();
                                navigate('dashboard');
                            }
                        } catch (err) {
                            WA.ui.toast(err.message || 'Erreur lors de l\'activation.', 'error');
                        }
                    }
                }, 'Continuer en Mode Invité'));

                content.appendChild(guestCard);
            }

            formContainer.appendChild(content);
        }

        paintForm();
        card.appendChild(formContainer);
        root.appendChild(card);
        return root;
    }

    /* ------------------------------------------------------------ 404 */

    function notFoundPage() {
        return h('div.wa-empty-state', {},
            h('div.wa-empty-icon', {}, icon('alert', 26)),
            h('h1', {}, 'Page introuvable'),
            h('p', {}, 'L’adresse demandée ne correspond à aucune section de WebAcademy.'),
            h('div.wa-btn-row', {},
                h('a.wa-btn.primary', { href: href('dashboard') }, 'Retour au tableau de bord'),
                h('a.wa-btn', { href: href('search') }, 'Rechercher un chapitre')));
    }

    /* ------------------------------------------------------------ bottom nav (mobile APK) */

    function bottomNav() {
        const nav = h('nav.wa-bottom-nav', { 'aria-label': 'Navigation mobile' });
        const items = [
            { icon: 'home', label: 'Accueil', route: 'dashboard', path: 'dashboard' },
            { icon: 'book', label: 'Cours', route: 'course', path: 'course/javascript' },
            { icon: 'flask', label: 'Atelier', route: 'lab', path: 'lab/html' },
            { icon: 'note', label: 'Notes', route: 'notes', path: 'notes' },
            { icon: 'user', label: 'Profil', route: 'login', path: 'login' },
        ];
        items.forEach(it => {
            const a = h('a.wa-bottom-item', {
                href: href(it.path),
                'data-route': it.route
            },
                h('span.icon', {}, icon(it.icon, 20)),
                h('span.label', {}, it.label)
            );
            nav.appendChild(a);
        });
        return nav;
    }

    /* ------------------------------------------------------------ boot */

    function shell() {
        const main = document.getElementById('wa-main');
        if (!main) return;
        main.innerHTML = '';
        const chrome = topbar();
        main.appendChild(chrome.bar);

        if (BOOT && BOOT.user && BOOT.user.is_guest) {
            const banner = h('div.wa-guest-banner', {},
                h('span', {}, 'Mode Invité actif — Progression locale à cet appareil.'),
                h('a', { href: href('login') }, 'Créer un compte pour sauvegarder →')
            );
            main.appendChild(banner);
        }

        main.appendChild(h('div.wa-main-inner', { id: 'wa-view' }));
        paintCrumbs(chrome.crumbs, null);

        const oldNav = document.querySelector('.wa-bottom-nav');
        if (oldNav) oldNav.remove();
        document.body.appendChild(bottomNav());

        try {
            if (localStorage.getItem('wa-sidebar-collapsed') === '1' && window.innerWidth > 980) {
                document.body.classList.add('wa-sidebar-collapsed');
            }
        } catch (e) {}
    }

    async function boot() {
        try {
            BOOT = await WA.api.bootstrap();
            const settings = BOOT.settings || {};
            NOTES = null;
            try {
                const notesRes = await WA.api.get('notes');
                NOTES = notesRes.notes || [];
            } catch (err) {
                NOTES = null; // la page Notes retentera le chargement
            }
            applyTheme(settings.theme || localStorage.getItem('wa-theme') || 'light', false);
            applyLang(settings.langMode || 'bilingual', false);
            renderSidebar();
            shell();

            window.addEventListener('hashchange', renderRoute);
            window.addEventListener('resize', WA.ui.debounce(syncNavInert, 150));

            const scrim = document.getElementById('wa-scrim');
            if (scrim) scrim.addEventListener('click', closeNav);

            document.addEventListener('keydown', ev => {
                if ((ev.ctrlKey || ev.metaKey) && ev.key.toLowerCase() === 'k') {
                    ev.preventDefault();
                    const search = document.getElementById('wa-nav-search');
                    if (search && !document.getElementById('wa-sidebar').inert) {
                        search.focus();
                        search.select();
                    } else {
                        navigate('search');
                    }
                }
                if (ev.key === 'Escape') closeNav();
            });

            if (!location.hash || location.hash === '#' || location.hash === '#/') {
                location.replace('#/dashboard');
            }

            await renderRoute();
        } catch (err) {
            const main = document.getElementById('wa-main');
            if (!main) return;
            main.innerHTML = '';
            main.appendChild(h('div.wa-error-state', { role: 'alert', style: 'margin-top:12vh' },
                h('h1', {}, 'Serveur injoignable'),
                h('p', {}, (err && err.message) || 'Le chargement initial a échoué.'),
                h('div.wa-btn-row', {},
                    h('button.wa-btn.primary', { type: 'button', onclick: () => boot() }, 'Réessayer'),
                    h('button.wa-btn', { type: 'button', onclick: () => location.reload() }, 'Recharger la page'))));
            main.setAttribute('aria-busy', 'false');
        }
    }

    /* ------------------------------------------------------------ actions partagées */

    async function setLessonDone(key, done) {
        const res = await WA.api.post('progress-set', {
            key,
            status: done ? 'done' : 'in_progress'
        });
        applyProgress(res);
        refreshNavStatus();
        return !!done;
    }

    function refreshNavStatus() {
        document.querySelectorAll('.wa-nav-chapter').forEach(a => {
            const rec = progressMap()[a.getAttribute('data-key')];
            a.classList.toggle('done', !!rec && rec.status === 'done');
            a.classList.toggle('todo', !!rec && rec.status === 'in_progress');
        });
    }

    async function toggleBookmark(key) {
        const res = await WA.api.post('bookmark', { key });
        if (BOOT) {
            BOOT.progress = Object.assign({}, BOOT.progress, { bookmarks: res.bookmarks || [] });
        }
        return !!res.added;
    }

    function navIndex(module, ch) {
        const list = availableLessons().filter(l => l.module === module);
        const i = list.findIndex(l => l.ch === Number(ch));
        return {
            prev: i > 0 ? list[i - 1].ch : null,
            prevTitle: i > 0 ? list[i - 1].title : '',
            next: i !== -1 && i < list.length - 1 ? list[i + 1].ch : null,
            nextTitle: i !== -1 && i < list.length - 1 ? list[i + 1].title : ''
        };
    }

    return { boot, data, navigate, renderRoute, applyProgress, setLessonDone, toggleBookmark, navIndex };
})();

document.addEventListener('DOMContentLoaded', function () {
    WA.app.boot();
});
