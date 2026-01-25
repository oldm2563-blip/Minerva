<?php
namespace app\controllers;
use app\services\Authservice;
use app\core\Controller;

    class AuthController extends Controller{
        
        public function loginform(){
            $error = [];
            $this->render("Auth/login", ['error' => $error]);
        }
        public function Login(){
            $auth = new Authservice();
            $redirect = $auth->login();
            if($redirect === 'student' || $redirect === 'teacher'){
                $this->redirect('/' . $redirect);
            }
            else{
                $this->render("Auth/login", ['error' => $redirect]);
            }
        }
        
        public function registerForm(){
            $error = [];
            $this->render("Auth/register", ['error' => $error]);
        }
        
        public function register(){
            $auth = new Authservice();
            $result = $auth->register();
            if($result === true){
                $this->redirect('/login');
            }
            else{
                $this->render("Auth/register", ['error' => $result]);
            }
        }
        
        public function logout(){
            session_destroy();
            $this->redirect('/');
        }
    }