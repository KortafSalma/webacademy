<?php
// test_api_debug7.php - test Api::handle with explicit error handling
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
    echo "Content loaded OK\n";
} catch (Exception $e) {
    echo "Content FAILED: " . $e->getMessage() . "\n";
    exit(1);
}

// Test Autoloader can find other classes
try {
    $ref = new ReflectionClass("App\Core\Api");
    echo "Api class found OK\n";
} catch (Exception $e) {
    echo "Api FAILED: " . $e->getMessage() . "\n";
    exit(1);
}

// Now let's manually call what Api::handle does for bootstrap
echo "Calling Content::manifest() directly:\n";
try {
    $content = App\Core\Content::manifest();
    echo "Manifest OK, " . count($content['modules']) . " modules\n";
} catch (Exception $e) {
    echo "Content::manifest() FAILED: " . get_class($e) . ": " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    exit(1);
}

// Now try the full Api::handle
echo "Calling Api::handle('bootstrap', 'GET', []):\n";
try {
    $result = App\Core\Api::handle('bootstrap', 'GET', []);
    // Try to get the result as a string
    $resultStr = var_export($result, true);
    echo "Result: " . $resultStr . "\n";
} catch (Throwable $e) {
    echo "Api::handle FAILED: " . get_class($e) . ": " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    // Don't exit, let's keep going
}