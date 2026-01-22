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
                return ["Email Not Found"];
            }
            else{
                if($password === $found['password']){
                    $_SESSION['name'] = $found['name'];
                    $_SESSION['id'] = $found['id'];
                    return $found['role'];
                }
                else{
                    return ['Password Is Incorrect'];
                }
            }
            
        }
    }