<?php
// debug_test.php
// Test the autoloader and class loading

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

// Try to load Content class
echo "Trying to load App\Core\Content...\n";
try {
    $ref = new ReflectionClass("App\Core\Content");
    echo "SUCCESS: Content loaded from " . $ref->getFileName() . "\n";
} catch (Exception $e) {
    echo "FAILED: " . $e->getMessage() . "\n";
}

// Try to load Api class
echo "Trying to load App\Core\Api...\n";
try {
    $ref = new ReflectionClass("App\Core\Api");
    echo "SUCCESS: Api loaded from " . $ref->getFileName() . "\n";
} catch (Exception $e) {
    echo "FAILED: " . $e->getMessage() . "\n";
}

// Try to load Database class
echo "Trying to load App\Core\Database...\n";
try {
    $ref = new ReflectionClass("App\Core\Database");
    echo "SUCCESS: Database loaded from " . $ref->getFileName() . "\n";
} catch (Exception $e) {
    echo "FAILED: " . $e->getMessage() . "\n";
}