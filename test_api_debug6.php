<?php
// test_api_debug6.php - test without headers in CLI mode
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

// Test Content class loading first
try {
    $ref = new ReflectionClass("App\Core\Content");
    echo "Content loaded from: " . $ref->getFileName() . "\n";
    
    // Try manifest
    $m = $ref->getMethod('manifest')->invoke(null);
    echo "Manifest OK, modules: " . count($m['modules']) . "\n";
} catch (Exception $e) {
    echo "Content FAILED: " . get_class($e) . ": " . $e->getMessage() . "\n";
    exit(1);
}

// Now test Api::handle directly, bypassing header issues
echo "Calling Api::handle('bootstrap', 'GET', [])\n";
try {
    // We need to capture the result without header issues
    ob_start();
    $result = App\Core\Api::handle('bootstrap', 'GET', []);
    $content = ob_get_clean();
    echo "Result: " . $content . "\n";
} catch (Exception $e) {
    echo "Api::handle FAILED: " . get_class($e) . ": " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    exit(1);
}