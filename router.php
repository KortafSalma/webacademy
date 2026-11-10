<?php

declare(strict_types=1);

/**
 * Compatibilité avec l'ancienne commande :
 *   php -S 127.0.0.1:8088 router.php
 *
 * Le DocumentRoot reste la racine du projet ; les assets publics sont
 * servis depuis public/assets et tout le reste passe par le front controller.
 */

$uri = (string) ($_SERVER['REQUEST_URI'] ?? '/');
$path = parse_url($uri, PHP_URL_PATH);
$path = is_string($path) ? rawurldecode($path) : '/';

if ($path === '' || $path[0] !== '/' || str_contains($path, "\0") || str_contains($path, '..')) {
    http_response_code(400);
    exit;
}

// Les dossiers privés ne doivent jamais être accessibles via l'ancienne racine.
if (preg_match('#^/(?:src|content|data|views|node_modules|\.git)(?:/|$)#i', $path)) {
    http_response_code(404);
    exit;
}
// Fichiers sensibles ou internes : configuration, dépendances, rapports,
// bases SQLite, sauvegardes, fichiers cachés. Rien de tout cela n'est public.
if (
    preg_match('#^/(?:config_local\.php|package(?:-lock)?\.json|.*\.md|.*\.sqlite(?:3)?(?:-wal|-shm|-journal)?|.*\.log|.*\.bak|.*\.tmp|router\.php|\.htaccess|\.gitignore)$#i', $path)
    || preg_match('#(?:^|/)\.#', $path)
) {
    http_response_code(404);
    exit;
}

// /favicon.svg → public/favicon.svg
if ($path === '/favicon.svg') {
    $icon = __DIR__ . '/public/favicon.svg';
    if (is_file($icon)) {
        header('Content-Type: image/svg+xml');
        header('X-Content-Type-Options: nosniff');
        header('Cache-Control: public, max-age=86400');
        readfile($icon);
        exit;
    }
    http_response_code(404);
    exit;
}

// /assets/… → public/assets/…
if (preg_match('#/assets/(.+)$#', $path, $m)) {
    $base = realpath(__DIR__ . '/public/assets');
    $file = $base !== false ? realpath($base . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $m[1])) : false;
    if ($file === false || !str_starts_with($file, $base . DIRECTORY_SEPARATOR) || !is_file($file)) {
        http_response_code(404);
        exit;
    }
    if (str_ends_with(strtolower($file), '.php')) {
        http_response_code(404);
        exit;
    }

    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $types = [
        'css'  => 'text/css; charset=utf-8',
        'js'   => 'text/javascript; charset=utf-8',
        'json' => 'application/json; charset=utf-8',
        'svg'  => 'image/svg+xml',
        'png'  => 'image/png',
        'jpg'  => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'webp' => 'image/webp',
        'ico'  => 'image/x-icon',
        'woff' => 'font/woff',
        'woff2'=> 'font/woff2',
        'map'  => 'application/json; charset=utf-8',
    ];
    header('Content-Type: ' . ($types[$ext] ?? 'application/octet-stream'));
    header('X-Content-Type-Options: nosniff');
    header('Cache-Control: public, max-age=3600');
    readfile($file);
    exit;
}

require __DIR__ . '/public/index.php';
