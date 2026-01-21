<?php
namespace app\services;
use app\models\User;

    class Authservice{
        public function login(){
            $password = $_POST['password'];
            $email = $_POST['email'];
            $info = new User("", "", $email , $password , "");
            $found = $info->getinfo();
            if(empty($found)){
                return "wrong email";
            }
            else{
                if($password === $found['password']){
                    return $found['role'];
                }
                else{
                    return 'password is correct';
                }
            }
            
        }
    }