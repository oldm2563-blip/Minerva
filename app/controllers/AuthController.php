<?php
namespace app\controllers;
use app\services\Authservice;
use app\core\Controller;

    class AuthController extends Controller{
        
        public function loginform(){
            $this->render("Auth/login");
        }
        public function Login(){
            $auth = new Authservice();
            $redirect = $auth->login();
            if($redirect === 'student' || $redirect === 'teacher'){
                $this->redirect($redirect);
            }
            else{
                echo $redirect;
            }
        }
    }