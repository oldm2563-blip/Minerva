<?php
// Start session
session_start();

// Autoloader
spl_autoload_register(function ($class) {
    $prefix = 'app\\';
    $base_dir = __DIR__ . '/../app/';
    
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

// Get the requested URI and method
$uri = strtok($_SERVER['REQUEST_URI'], '?');
$uri = rtrim($uri, '/');
$method = $_SERVER['REQUEST_METHOD'];

// Remove /testmineva from URI if present
$uri = str_replace('/testmineva', '', $uri);

// Basic routing for fallback
switch ($uri) {
    case '':
    case '/':
        // Redirect to login or dashboard based on session
        if (isset($_SESSION['role'])) {
            header('Location: /' . $_SESSION['role']);
            exit;
        } else {
            header('Location: /login');
            exit;
        }
        break;
        
    case '/login':
        if ($method === 'GET') {
            $authController = new \app\controllers\AuthController();
            $authController->loginform();
        } elseif ($method === 'POST') {
            $authController = new \app\controllers\AuthController();
            $authController->Login();
        }
        break;
        
    case '/register':
        if ($method === 'GET') {
            $authController = new \app\controllers\AuthController();
            $authController->registerForm();
        } elseif ($method === 'POST') {
            $authController = new \app\controllers\AuthController();
            $authController->register();
        }
        break;
        
    case '/logout':
        $authController = new \app\controllers\AuthController();
        $authController->logout();
        break;
        
    case '/teacher':
    case '/teacher/':
        $teacherController = new \app\controllers\TeacherController();
        $teacherController->dashboard();
        break;
        
    case '/student':
    case '/student/':
        $studentController = new \app\controllers\StudentController();
        $studentController->studentboard();
        break;
        
    default:
        // Try to handle with the main router
        require __DIR__ . '/index.php';
        break;
}
