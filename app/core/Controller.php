<?php
    namespace app\core;

    class Controller{
        function render($view, $data = []){
            $viewpage =__DIR__ . '/../views/'. $view .'.php';

            if (!file_exists($viewpage)) {
            http_response_code(500);
            echo 'View not found';
            return;
        }
            extract($data);
            require $viewpage;
        }

        function redirect($path)
        {
            header('Location: /' . ltrim($path, '/'));
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