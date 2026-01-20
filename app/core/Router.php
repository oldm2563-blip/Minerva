<?php
namespace app\core;



class Router
{
    private $uri;
    private $methode;

    public function __construct()
    {
        $this->uri = parse_url($_SERVER['REQUEST_URI'])['path'];
        $this->methode = $_SERVER['REQUEST_METHOD'];
    }
    public function route($routes)
    {

        if (array_key_exists($this->methode . " " . $this->uri, $routes)) {
            $route = $routes[$this->methode . " " . $this->uri];
            $controllerName = $route[0];
            $action = $route[1];
            $controller = new $controllerName();
            $controller->$action();
        }
        
        else {
            $this->abort();
            return;
        }
    }

    public function abort($code = 404)
    {
        http_response_code($code);
        echo "page not Found";
    }
    
}
