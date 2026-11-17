<?php
/**
 * WebAcademy — shell de la Single-Page Application.
 * La navigation et les vues sont rendues par public/assets/js/app.js.
 */
$v = rawurlencode(APP_VERSION);
?>
<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
<title>WebAcademy — Neo-Brutalist Code Learning Platform</title>
<meta name="description" content="WebAcademy : plateforme interactive d'apprentissage du code (HTML, CSS, PHP, SQL, C++, JS, Oracle) au style Neo-Brutalist.">
<meta name="color-scheme" content="light dark">
<meta name="theme-color" content="#FFE600">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="robots" content="noindex, nofollow">
<link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
<link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
<link rel="icon" href="favicon.svg" type="image/svg+xml">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;700;800;900&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
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
