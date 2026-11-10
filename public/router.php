<?php

declare(strict_types=1);

/**
 * Routeur du serveur de développement intégré.
 *
 *   php -S 127.0.0.1:8088 -t public public/router.php
 *
 * Seuls les fichiers réellement présents dans public/ sont servis. Toute
 * autre URL est confiée au front controller. Les fichiers PHP autres que
 * index.php ne sont jamais exécutés comme scripts autonomes.
 */

$uri = (string) ($_SERVER['REQUEST_URI'] ?? '/');
$path = parse_url($uri, PHP_URL_PATH);
$path = is_string($path) ? rawurldecode($path) : '/';

if ($path === '' || $path[0] !== '/') {
    http_response_code(400);
    exit;
}
if (str_contains($path, "\0") || str_contains($path, '..')) {
    http_response_code(400);
    exit;
}

$public = realpath(__DIR__);
if ($public === false) {
    http_response_code(500);
    exit;
}

$relative = ltrim(str_replace('\\', '/', $path), '/');

// Le routeur lui-même n'est jamais servi directement.
if ($relative === 'router.php') {
    http_response_code(404);
    exit;
}

// Aucun fichier caché (`.git`, `.env`, sauvegardes…) n'est exposé.
foreach (explode('/', $relative) as $segment) {
    if ($segment !== '' && $segment[0] === '.') {
        http_response_code(404);
        exit;
    }
}

if ($relative !== '' && $relative !== 'index.php') {
    $candidate = realpath($public . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relative));
    if (
        $candidate !== false
        && str_starts_with($candidate, $public . DIRECTORY_SEPARATOR)
        && is_file($candidate)
        && !str_ends_with(strtolower($candidate), '.php')
    ) {
        return false; // le serveur intégré sert le fichier statique
    }
}

require $public . DIRECTORY_SEPARATOR . 'index.php';
