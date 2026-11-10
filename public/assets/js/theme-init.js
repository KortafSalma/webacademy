/* Applique le thème avant le premier paint (aucun flash clair/foncé). */
(function () {
    try {
        var saved = localStorage.getItem('wa-theme');
        if (saved !== 'light' && saved !== 'dark') {
            saved = window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
        }
        document.documentElement.setAttribute('data-theme', saved);
        document.documentElement.style.colorScheme = saved;
    } catch (err) {
        document.documentElement.setAttribute('data-theme', 'dark');
    }
})();
