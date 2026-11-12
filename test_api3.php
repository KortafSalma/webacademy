<?php
// Mostrar todos los errores
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('log_errors', '1');

// Set up paths like deploy_htdocs would have
define('APP_ROOT', 'deploy_htdocs');
define('APP_PUBLIC', 'deploy_htdocs/public');
define('APP_SRC', 'deploy_htdocs/src');
define('APP_CONTENT', 'deploy_htdocs/content');
define('APP_DATA', 'deploy_htdocs/data');
define('APP_ASSETS', 'deploy_htdocs/public/assets');
define('APP_VERSION', '2.0.1');

// Include bootstrap first (defines DB_MYSQL_CONFIG, etc.)
require_once 'src/bootstrap.php';

// Now include autoloader and functions
require_once 'src/Core/Autoloader.php';
App\Core\Autoloader::register();
require_once 'src/Core/functions.php';

echo "=== Iniciando prueba de API bootstrap ===\n";

// Test the bootstrap API endpoint
$_GET['api'] = 'bootstrap';
$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['HTTPS'] = 'off';

echo "=== RUTA: index.php?api=bootstrap ===\n";

if (isset($_GET['api'])) {
    $method = strtoupper((string)($_SERVER['REQUEST_METHOD'] ?? 'GET'));
    echo "Método: $method\n";
    
    if (!in_array($method, ['GET', 'POST'], true)) {
        http_response_code(405);
        exit;
    }

    $endpoint = (string)$_GET['api'];
    echo "Endoint: $endpoint\n";
    if ($endpoint === '' || strlen($endpoint) > 64) {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code(400);
        echo json_encode(['ok' => false, 'error' => 'Endpoint invalide.']);
        exit;
    }

    try {
        $payload = $method === 'POST' ? [] : $_GET;
        echo "Payload: " . json_encode($payload) . "\n";
        $result = App\Core\Api::handle($endpoint, $method, $payload);
        $status = (int)($result['status'] ?? 200);
        unset($result['status']);
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        $output = json_encode($result, JSON_UNESCAPED_UNICODE);
        echo "RESULT: $output\n";
    } catch (InvalidArgumentException $ex) {
        http_response_code(400);
        header('Content-Type: application/json; charset=utf-8');
        echo "ERROR (InvalidArgument): " . $ex->getMessage() . "\n";
    } catch (Throwable $ex) {
        $msg = sprintf(
            '[WebAcademy] request=%s endpoint=%s %s: %s in %s:%d',
            bin2hex(random_bytes(8)),
            $endpoint,
            get_class($ex),
            $ex->getMessage(),
            $ex->getFile(),
            $ex->getLine()
        );
        error_log($msg);
        http_response_code(500);
        header('Content-Type: application/json; charset=utf-8');
        echo "ERROR (Throwable): " . $ex->getMessage() . "\n";
        echo "CLASS: " . get_class($ex) . "\n";
        echo "FILE: " . $ex->getFile() . "\n";
        echo "LINE: " . $ex->getLine() . "\n";
    }
}
echo "=== Fin de prueba ===\n";
exit;