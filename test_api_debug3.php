<?php
// test_api_debug3.php - minimal test, no headers
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

// Directly test Content class loading
try {
    $ref = new ReflectionClass("App\Core\Content");
    echo "Content class loaded OK from: " . $ref->getFileName() . "\n";
    
    // Try calling manifest method
    $manifest = $ref->getMethod('manifest')->invoke(null);
    echo "manifest() returned: " . json_encode($manifest, JSON_UNESCAPED_UNICODE) . "\n";
} catch (Exception $e) {
    echo "Error: " . get_class($e) . ": " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}