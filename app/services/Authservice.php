<?php
namespace app\services;
use app\models\User;

    class Authservice{
        public function login(){
            $password = $_POST['password'];
            $email = $_POST['email'];
            $info = new User("", $email, "", "");
            $found = $info->getinfo();
            if(empty($found)){
                return ["Email Not Found"];
            }
            else{
                if(password_verify($password, $found['password'])){
                    $_SESSION['name'] = $found['name'];
                    $_SESSION['id'] = $found['id'];
                    $_SESSION['role'] = $found['role'];
                    return $found['role'];
                }
                else{
                    return ['Password Is Incorrect'];
                }
            }
            
        }
        
        public function register(){
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';
            
            // Validation
            $errors = [];
            
            if(empty($name)){
                $errors[] = "Le nom est requis";
            }
            
            if(empty($email)){
                $errors[] = "L'email est requis";
            } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors[] = "L'email n'est pas valide";
            }
            
            if(empty($password)){
                $errors[] = "Le mot de passe est requis";
            } elseif(strlen($password) < 6){
                $errors[] = "Le mot de passe doit contenir au moins 6 caractères";
            }
            
            if($password !== $confirm_password){
                $errors[] = "Les mots de passe ne correspondent pas";
            }
            
            if(!empty($errors)){
                return $errors;
            }
            
            // Check if email already exists
            $user = new User("", $email, "", "");
            $existing = $user->getinfo();
            if(!empty($existing)){
                return ["Cet email est déjà utilisé"];
            }
            
            // Create new teacher
            $newUser = new User($name, $email, $password, 'teacher');
            $result = $newUser->create();
            
            if($result){
                return true;
            } else {
                return ["Une erreur est survenue lors de l'inscription"];
            }
        }
    }