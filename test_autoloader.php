<?php
// Test autoloader
define('APP_ROOT', 'deploy_htdocs');
define('APP_SRC', 'deploy_htdocs/src');

spl_autoload_register(function ($class) {
    if (!str_starts_with($class, 'App\\')) return;
    $relative = str_replace('\\', '/', substr($class, 4));
    $file = APP_SRC . '/' . $relative . '.php';
    echo "Trying to load: $class -> $file\n";
    if (is_file($file)) {
        require $file;
        echo "Loaded: $file\n";
    } else {
        echo "NOT FOUND: $file\n";
    }
});

echo "Attempting to load App\Core\Content...\n";
try {
    $c = new App\Core\Content();
    echo "Content loaded successfully\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}