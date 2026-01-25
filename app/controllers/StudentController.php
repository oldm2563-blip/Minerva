<?php
namespace app\controllers;
use app\core\Controller;
use app\services\StudentService;
use app\services\StudentDataService;

    class StudentController extends Controller{
        
        public function studentboard(){
            $this->IsSignedIn();
            if($_SESSION['role'] !== 'student') {
                $this->redirect('/');
            }
            $studentDataService = new StudentDataService();
            $dashboardData = $studentDataService->getStudentDashboardData();
            $this->render("student/dashboard", $dashboardData);
        }
        public function submit(){
            $this->IsSignedIn();
            if($_SESSION['role'] !== 'student') {
                $this->redirect('/');
            }
            $sub = new StudentService();
            $sub->submit();
            $this->redirect('student');
        }
        public function myclasses(){
            $this->IsSignedIn();
            if($_SESSION['role'] !== 'student') {
                $this->redirect('/');
            }
            $studentDataService = new StudentDataService();
            $classes = $studentDataService->getStudentClasses();
            $this->render("student/my_classes", ['classes' => $classes]);
        }
        public function myworks(){
            $this->IsSignedIn();
            if($_SESSION['role'] !== 'student') {
                $this->redirect('/');
            }
            $studentDataService = new StudentDataService();
            $works = $studentDataService->getStudentWorks();
            $this->render("student/my_works", ['works' => $works]);
        }
        public function mygrades(){
            $this->IsSignedIn();
            if($_SESSION['role'] !== 'student') {
                $this->redirect('/');
            }
            $studentDataService = new StudentDataService();
            $grades = $studentDataService->getStudentGrades();
            $this->render("student/my_grades", ['grades' => $grades]);
        }
        public function chat(){
            $this->IsSignedIn();
            if($_SESSION['role'] !== 'student') {
                $this->redirect('/');
            }
            $this->render("student/student_chat");
        }
    }