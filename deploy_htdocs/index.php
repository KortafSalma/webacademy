<?php

/**
 * WebAcademy — front controller for InfinityFree htdocs.
 * 
 * Point d'entrée unique exposé par le serveur web. 
 * Les dossiers src/, content/, views/ et data/ sont dans htdocs/ 
 * mais protégés par les règles Apache .htaccess.
 * 
 * NOTE: Ce fichier doit être placé à la racine de htdocs/.
 * Tous les chemins sont relatifs à htdocs/ (pas de répertoire parent).
 */

declare(strict_types=1);

// Les erreurs techniques restent dans les journaux, jamais dans la réponse.
ini_set('display_errors', '0');
ini_set('log_errors', '1');
error_reporting(E_ALL);

// Include the core bootstrap — src/ is at the same level as this file (both in htdocs/)
require_once __DIR__ . '/src/bootstrap.php';

use App\Core\Api;

$requestId = bin2hex(random_bytes(8));
header_remove('X-Powered-By');
header('X-Request-ID: ' . $requestId);
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('X-Frame-Options: DENY');
header('Permissions-Policy: camera=(), microphone=(), geolocation=(), payment=()');
header('Cross-Origin-Opener-Policy: same-origin');
header('Cross-Origin-Resource-Policy: same-origin');
header('X-Permitted-Cross-Domain-Policies: none');
header('X-XSS-Protection: 0');
header('Origin-Agent-Cluster: ?1');
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
    header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
}

/*
 * Les ateliers HTML/CSS exécutent du code utilisateur dans un iframe sandbox
 * via srcdoc. Le navigateur applique la CSP du document parent au document
 * srcdoc : 'unsafe-inline' est donc nécessaire pour que les scripts des
 * aperçus continuent de fonctionner. Toutes les ressources (polices et
 * CodeMirror) sont auto-hébergées : aucune origine externe n'est autorisée.
 */
header(
    "Content-Security-Policy: default-src 'self'; "
    . "base-uri 'self'; "
    . "object-src 'none'; "
    . "frame-ancestors 'none'; "
    . "form-action 'self'; "
    . "script-src 'self' 'unsafe-inline'; "
    . "style-src 'self' 'unsafe-inline'; "
    . "font-src 'self' data:; "
    . "img-src 'self' data: blob:; "
    . "frame-src 'self' data: blob:; "
    . "connect-src 'self'; "
    . "media-src 'none'; "
    . "worker-src 'none'; "
    . "manifest-src 'self'"
);

/** Vérifie que la requête d'écriture vient bien de la même origine. */
function wa_same_origin(): bool
{
    $site = strtolower((string) ($_SERVER['HTTP_SEC_FETCH_SITE'] ?? ''));
    if ($site === 'cross-site') {
        return false;
    }

    $origin = (string) ($_SERVER['HTTP_ORIGIN'] ?? '');
    if ($origin === '') {
        // Requêtes locales (curl, tests CLI) sans en-tête Origin.
        return true;
    }

    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = (string) ($_SERVER['HTTP_HOST'] ?? '');
    return $host !== '' && hash_equals($scheme . '://' . $host, rtrim($origin, '/'));
}

/** Le corps POST doit être du JSON, comme l'envoie le client vanilla. */
function wa_json_content_type(): bool
{
    $raw = strtolower((string) ($_SERVER['CONTENT_TYPE'] ?? ''));
    $type = trim(explode(';', $raw)[0]);
    return $type === 'application/json';
}

// ---------------------------------------------------------------- API JSON
if (isset($_GET['api'])) {
    $method = strtoupper((string) ($_SERVER['REQUEST_METHOD'] ?? 'GET'));
    if (!in_array($method, ['GET', 'POST'], true)) {
        header('Allow: GET, POST');
        api_out(['ok' => false, 'error' => 'Méthode non autorisée.'], 405);
    }

    if ($method === 'POST') {
        if (!wa_same_origin()) {
            api_out(['ok' => false, 'error' => 'Origine de la requête refusée.'], 403);
        }
        if (!wa_json_content_type()) {
            api_out(['ok' => false, 'error' => 'Content-Type application/json requis.'], 415);
        }
        $length = (int) ($_SERVER['CONTENT_LENGTH'] ?? 0);
        if ($length > APP_MAX_REQUEST_BYTES) {
            api_out(['ok' => false, 'error' => 'Requête trop volumineuse.'], 413);
        }
    }

    $endpoint = (string) $_GET['api'];
    if ($endpoint === '' || strlen($endpoint) > 64) {
        api_out(['ok' => false, 'error' => 'Endpoint invalide.'], 400);
    }

    try {
        $payload = $method === 'POST' ? api_input() : $_GET;
        $result = Api::handle($endpoint, $method, $payload);
        $status = (int) ($result['status'] ?? 200);
        unset($result['status']);
        api_out($result, $status);
    } catch (InvalidArgumentException $ex) {
        api_out(['ok' => false, 'error' => $ex->getMessage()], 400);
    } catch (Throwable $ex) {
        error_log(sprintf(
            '[WebAcademy] request=%s endpoint=%s %s: %s in %s:%d',
            $requestId,
            $endpoint,
            $ex::class,
            $ex->getMessage(),
            $ex->getFile(),
            $ex->getLine()
        ));
        api_out([
            'ok'        => false,
            'error'     => 'Erreur interne. Réessayez dans un instant.',
            'requestId' => $requestId,
        ], 500);
    }
}

// Ancien point de diagnostic : supprimé de l'interface web.
if (isset($_GET['devdump'])) {
    http_response_code(404);
    exit;
}

// Le routeur de développement n'est jamais une page de l'application.
$requestPath = parse_url((string) ($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH);
if (is_string($requestPath) && preg_match('#/router\.php$#i', $requestPath)) {
    http_response_code(404);
    exit;
}

// ---------------------------------------------------------------- Shell SPA
header('Content-Type: text/html; charset=utf-8');
header('Cache-Control: no-store, max-age=0');
include APP_ROOT . '/views/shell.php';