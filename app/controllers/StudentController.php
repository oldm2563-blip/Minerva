<?php
namespace app\controllers;
use app\core\Controller;
use app\services\StudentService;

    class StudentController extends Controller{
        
        public function viewClasses(){
            $this->render('student/my_classes');
        }
        
        public function viewWorks(){
            $this->render('student/my_works');
        }
        
        public function dashboard(){
            $this->render('student/dashboard');
        }
        
        public function viewClass(){
            $this->render('student/my_classes');
        }
        
        public function viewGrades(){
            $this->render('student/my_grades');
        }
        
        public function viewWork(){
            $this->render('student/my_works');
        }
        
        public function submitWork(){
            $sub = new StudentService();
            $sub->submit();
            $this->redirect('/student');
        }
        
        public function viewChat(){
            $this->render('student/student_chat');
        }
        
        public function sendMessage(){
            $chat = new StudentService();
            $chat->sendMessage();
            $this->redirect('/student/chat');
        }
    }