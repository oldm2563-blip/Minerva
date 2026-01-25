<?php
namespace app\core;



class Router
{
    private $uri;
    private $methode;

    public function __construct()
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $this->uri = parse_url($uri, PHP_URL_PATH) ?: '/';
        $this->methode = $_SERVER['REQUEST_METHOD'];
        error_log("Router initialized - URI: " . $this->uri . ", Method: " . $this->methode);
    }
    
    public function route($routes)
    {
        $routeKey = $this->methode . " " . $this->uri;
        error_log("Looking for route key: " . $routeKey);
        
        if (array_key_exists($routeKey, $routes)) {
            error_log("Route found! Controller: " . $routes[$routeKey][0] . ", Action: " . $routes[$routeKey][1]);
            $route = $routes[$routeKey];
            $controllerName = $route[0];
            $action = $route[1];
            
            try {
                error_log("Instantiating controller: " . $controllerName);
                $controller = new $controllerName();
                error_log("Calling action: " . $action);
                $controller->$action();
            } catch (Exception $e) {
                error_log("Controller error: " . $e->getMessage());
                $this->abort(500, "Controller Error: " . $e->getMessage());
            }
        } else {
            error_log("Route not found for key: " . $routeKey);
            // Debug: show available routes
            if (isset($_GET['debug'])) {
                echo "<h3>Route not found: $routeKey</h3>";
                echo "<h4>Available routes:</h4>";
                echo "<ul>";
                foreach (array_keys($routes) as $availableRoute) {
                    echo "<li>$availableRoute</li>";
                }
                echo "</ul>";
            }
            $this->abort(404, "Route '$routeKey' not found");
        }
    }

    public function abort($code = 404, $message = "Page Not Found")
    {
        http_response_code($code);
        echo "<h1>Error $code</h1>";
        echo "<p>$message</p>";
    }
}
