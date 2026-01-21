<?php
namespace app\controllers;


    class StudentController{
        
        public function studentboard(){
            require __DIR__ . "/../views/student/dashboard.php";
        }
    }