<?php
namespace app\controllers;
use app\core\Controller;
use app\services\StudentService;

    class StudentController extends Controller{
        
        public function studentboard(){
            require __DIR__ . "/../views/student/dashboard.php";
        }
        public function submit(){
            $sub = new StudentService();
            $sub->submit();
            $this->redirect('teacher');
        }
    }