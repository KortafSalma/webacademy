<?php
// test_api_debug4.php - test bootstrap specifically
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

// Directly test Bootstrap
$result = App\Core\Api::handle('bootstrap', 'GET', []);
file_put_contents('/tmp/debug_result.txt', json_encode($result, JSON_UNESCAPED_UNICODE));