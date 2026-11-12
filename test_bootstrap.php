<?php
// Test script to verify bootstrap paths work correctly in htdocs context
require 'deploy_htdocs/src/bootstrap.php';

echo 'APP_ROOT: ' . APP_ROOT . PHP_EOL;
echo 'APP_SRC: ' . APP_SRC . PHP_EOL;
echo 'APP_CONTENT: ' . APP_CONTENT . PHP_EOL;
echo 'APP_DATA: ' . APP_DATA . PHP_EOL;
echo 'APP_VERSION: ' . APP_VERSION . PHP_EOL;

// Test autoloader
spl_autoload_register(function ($class) {
    if (!str_starts_with($class, 'App\\')) return;
    $relative = str_replace('\\', '/', substr($class, 4));
    $file = APP_SRC . '/' . $relative . '.php';
    if (is_file($file)) require $file;
});

// Test loading functions.php
echo 'Testing App\Core\functions...' . PHP_EOL;
var_dump(function_exists('e'));

// Test loading Api.php
echo 'Testing App\Core\Api...' . PHP_EOL;
var_dump(class_exists('App\Core\Api'));

// Test loading Database.php
echo 'Testing App\Core\Database...' . PHP_EOL;
var_dump(class_exists('App\Core\Database'));