/* Applique le thème Neo-Brutalist avant le premier paint */
(function () {
    try {
        var saved = localStorage.getItem('wa-theme');
        if (saved !== 'light' && saved !== 'dark') {
            saved = 'light';
        }
        document.documentElement.setAttribute('data-theme', saved);
        document.documentElement.style.colorScheme = saved;
    } catch (err) {
        document.documentElement.setAttribute('data-theme', 'light');
    }
})();
