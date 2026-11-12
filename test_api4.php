<?php
// Test script for API bootstrap endpoint
// Does NOT define constants - they are defined in bootstrap.php

// Only set up error reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('log_errors', '1');

echo "=== Test API bootstrap endpoint ===\n\n";

// Include bootstrap first (defines all constants, autoloader, etc.)
require_once 'src/bootstrap.php';

// Now the Autoloader and functions should already be registered
// We just need to test the API handle method

// Simulate the API request
$_GET['api'] = 'bootstrap';
$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['HTTPS'] = 'off';

echo "RUTA: index.php?api=bootstrap\n";
echo "Método: GET\n";
echo "Endpoint: bootstrap\n\n";

// Include the index.php API handling logic
// But we need to handle it like the real server would
// The real flow is: index.php checks for $_GET['api'] and calls Api::handle()

// Let's manually test Api::handle
echo "Testing App\Core\Api::handle('bootstrap', 'GET', ...)\n";

try {
    // We need the autoloader to be registered first
    // It should already be registered from bootstrap.php
    
    $payload = $_GET;  // For GET requests, payload is $_GET
    $result = App\Core\Api::handle('bootstrap', 'GET', $payload);
    $status = (int)($result['status'] ?? 200);
    unset($result['status']);
    
    echo "SUCCESS! Status: $status\n";
    echo "Response: " . json_encode($result, JSON_UNESCAPED_UNICODE) . "\n";
} catch (Throwable $ex) {
    echo "ERROR: " . get_class($ex) . "\n";
    echo "Message: " . $ex->getMessage() . "\n";
    echo "File: " . $ex->getFile() . "\n";
    echo "Line: " . $ex->getLine() . "\n";
}

echo "\n=== Test completed ===\n";