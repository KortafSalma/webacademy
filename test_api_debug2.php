<?php
// test_api_debug2.php - with actual exception capturing
error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');

// Set up paths like deploy_htdocs would have
define('APP_ROOT', 'deploy_htdocs');
define('APP_PUBLIC', 'deploy_htdocs/public');
define('APP_SRC', 'deploy_htdocs/src');
define('APP_CONTENT', 'deploy_htdocs/content');
define('APP_DATA', 'deploy_htdocs/data');
define('APP_ASSETS', 'deploy_htdocs/public/assets');
define('APP_VERSION', '2.0.1');

require_once 'src/Core/Autoloader.php';
App\Core\Autoloader::register();
require_once 'src/Core/functions.php';

// Test the bootstrap API endpoint
$_GET['api'] = 'bootstrap';
$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['HTTPS'] = 'off';

if (isset($_GET['api'])) {
    $method = strtoupper((string)($_SERVER['REQUEST_METHOD'] ?? 'GET'));
    if (!in_array($method, ['GET', 'POST'], true)) {
        http_response_code(405);
        exit;
    }

    $endpoint = (string)$_GET['api'];
    if ($endpoint === '' || strlen($endpoint) > 64) {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code(400);
        echo json_encode(['ok' => false, 'error' => 'Endpoint invalide.']);
        exit;
    }

    try {
        $payload = $method === 'POST' ? [] : $_GET;
        $result = App\Core\Api::handle($endpoint, $method, $payload);
        $status = (int)($result['status'] ?? 200);
        unset($result['status']);
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    } catch (InvalidArgumentException $ex) {
        http_response_code(400);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['ok' => false, 'error' => $ex->getMessage()]);
    } catch (Throwable $ex) {
        // Log the full error
        $errorMsg = sprintf(
            "[WebAcademy] request=%s endpoint=%s %s: %s in %s:%d",
            bin2hex(random_bytes(8)),
            $endpoint,
            get_class($ex),
            $ex->getMessage(),
            $ex->getFile(),
            $ex->getLine()
        );
        error_log($errorMsg);
        http_response_code(500);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['ok' => false, 'error' => 'Erreur interne. Réessayez dans un instant.']);
    }
}
exit;