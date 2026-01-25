<?php
    namespace app\core;

    class Controller{
        function render($view, $data = []){
            $viewpage =__DIR__ . '/../views/'. $view .'.php';
            error_log("Attempting to render view: " . $viewpage);

            if (!file_exists($viewpage)) {
                error_log("View file not found: " . $viewpage);
                http_response_code(500);
                echo 'View not found: ' . $view;
                return;
            }
            
            error_log("View file exists, rendering: " . $view);
            extract($data);
            require $viewpage;
        }

        function redirect($path)
        {
            // Debug logging
            error_log("Redirecting to: " . $path);
            
            // If path starts with http, use as-is
            if (strpos($path, 'http') === 0) {
                header('Location: ' . $path);
            } else {
                // Ensure proper URL format
                $path = '/' . ltrim($path, '/');
                error_log("Final redirect URL: " . $path);
                header('Location: ' . $path);
            }
            exit;
        }

        public function IsSignedIn(){
            if(!isset($_SESSION['name'])){
                session_destroy();
                $this->redirect('/login');
            }
        }

        public function SingedIn(){
            if(isset($_SESSION['name'])){
                $this->redirect('/');
            }
        }
    }