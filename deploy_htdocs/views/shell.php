<?php
/**
 * WebAcademy — shell de la Single-Page Application.
 * La navigation et les vues sont rendues par public/assets/js/app.js.
 */
$v = rawurlencode(APP_VERSION);
?>
<!DOCTYPE html>
<html lang="fr" data-theme="dark">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>WebAcademy — HTML · CSS · PHP · SQL · C++ · JavaScript</title>
<meta name="description" content="WebAcademy : cours interactifs de développement (HTML, CSS, PHP, SQL, C++ et JavaScript) en français et en darija, avec ateliers de code, exercices et quiz corrigés.">
<meta name="color-scheme" content="light dark">
<meta name="theme-color" content="#f6f1e7" media="(prefers-color-scheme: light)">
<meta name="theme-color" content="#14110d" media="(prefers-color-scheme: dark)">
<meta name="robots" content="noindex, nofollow">
<link rel="icon" href="favicon.svg" type="image/svg+xml">
<script src="assets/js/theme-init.js?v=<?= $v ?>"></script>
<link rel="stylesheet" href="assets/css/fonts.css?v=<?= $v ?>">
<link rel="stylesheet" href="assets/vendor/codemirror/codemirror.min.css?v=<?= $v ?>">
<link rel="stylesheet" href="assets/vendor/codemirror/theme/material-darker.min.css?v=<?= $v ?>">
<link rel="stylesheet" href="assets/css/app.css?v=<?= $v ?>">
</head>
<body>
<a class="wa-skip" id="wa-skip" href="#wa-main">Aller au contenu principal</a>

<div id="wa-app" class="wa-app">
    <aside id="wa-sidebar" class="wa-sidebar" aria-label="Navigation principale">
        <div class="wa-sidebar-scroll" id="wa-sidebar-scroll">
            <div class="wa-boot-side" aria-hidden="true">
                <span class="wa-skeleton wa-skeleton-mark"></span>
                <span class="wa-skeleton wa-skeleton-line"></span>
                <span class="wa-skeleton wa-skeleton-line short"></span>
            </div>
        </div>
    </aside>

    <div id="wa-scrim" class="wa-scrim" hidden></div>

    <main id="wa-main" class="wa-main" tabindex="-1" aria-busy="true">
        <div class="wa-boot" role="status" aria-live="polite">
            <span class="wa-boot-mark" aria-hidden="true">&lt;/&gt;</span>
            <span>Chargement de WebAcademy…</span>
        </div>
    </main>
</div>

<div id="wa-route-status" class="wa-sr-only" role="status" aria-live="polite" aria-atomic="true"></div>
<div id="wa-toast" class="wa-toast" role="status" aria-live="polite" aria-atomic="true"></div>

<noscript>
    <div class="wa-noscript">
        <h1>JavaScript est nécessaire</h1>
        <p>WebAcademy a besoin de JavaScript pour afficher les cours et exécuter les ateliers. Activez-le dans votre navigateur, puis rechargez la page.</p>
    </div>
</noscript>

<script src="assets/vendor/codemirror/codemirror.min.js?v=<?= $v ?>" defer></script>
<script src="assets/vendor/codemirror/mode/xml.min.js?v=<?= $v ?>" defer></script>
<script src="assets/vendor/codemirror/mode/css.min.js?v=<?= $v ?>" defer></script>
<script src="assets/vendor/codemirror/mode/javascript.min.js?v=<?= $v ?>" defer></script>
<script src="assets/vendor/codemirror/mode/htmlmixed.min.js?v=<?= $v ?>" defer></script>
<script src="assets/vendor/codemirror/mode/clike.min.js?v=<?= $v ?>" defer></script>
<script src="assets/vendor/codemirror/mode/php.min.js?v=<?= $v ?>" defer></script>
<script src="assets/vendor/codemirror/mode/sql.min.js?v=<?= $v ?>" defer></script>
<script src="assets/js/api.js?v=<?= $v ?>" defer></script>
<script src="assets/js/ui.js?v=<?= $v ?>" defer></script>
<script src="assets/js/editor.js?v=<?= $v ?>" defer></script>
<script src="assets/js/runner.js?v=<?= $v ?>" defer></script>
<script src="assets/js/quiz.js?v=<?= $v ?>" defer></script>
<script src="assets/js/lesson.js?v=<?= $v ?>" defer></script>
<script src="assets/js/lab.js?v=<?= $v ?>" defer></script>
<script src="assets/js/app.js?v=<?= $v ?>" defer></script>
</body>
</html>
