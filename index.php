<?php
// Start session
session_start();

// Autoloader
spl_autoload_register(function ($class) {
    $prefix = 'app\\';
    $base_dir = __DIR__ . '/app/';
    
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    
    if (file_exists($file)) {
        require $file;
    }
});

// Get the requested URI
$uri = strtok($_SERVER['REQUEST_URI'], '?');
$uri = rtrim($uri, '/');

// Basic routing
switch ($uri) {
    case '':
    case '/':
        require __DIR__ . '/public/index.php';
        break;
        
    case '/login':
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['url'] = 'login';
        require __DIR__ . '/public/index.php';
        break;
        
    case '/register':
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['url'] = 'register';
        require __DIR__ . '/public/index.php';
        break;
        
    default:
        // Handle other routes
        if (strpos($uri, '/login') === 0 || strpos($uri, '/register') === 0) {
            $_SERVER['REQUEST_METHOD'] = $_SERVER['REQUEST_METHOD'] ?? 'GET';
            $_GET['url'] = ltrim($uri, '/');
            require __DIR__ . '/public/index.php';
        } else {
            // For other routes, pass through to the main router
            $_GET['url'] = ltrim($uri, '/');
            require __DIR__ . '/public/index.php';
        }
        break;
}
