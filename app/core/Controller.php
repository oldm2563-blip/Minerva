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



        function redirect($view, $data = []){
            header('Location: ' . $view);
        }

        public function IsSignedIn(){
            if(!isset($_SESSION['user'])){
                session_destroy();
                $this->redirect('/login');
            }
        }

        public function SingedIn(){
            if(isset($_SESSION['user'])){
                $this->redirect('/');
            }
        }
    }