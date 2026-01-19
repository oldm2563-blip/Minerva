<?php
require '../vendor/autoload.php';
session_start();

use app\core\Router;
$router = new Router();
$routes = [
        
    ];

$router->route($routes);
?>