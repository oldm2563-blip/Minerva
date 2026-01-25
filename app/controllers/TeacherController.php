<?php
namespace app\controllers;

use app\core\Controller;
use app\services\ClassService;
use app\services\StudentService;
use app\services\TeacherService;

    class TeacherController extends Controller{
        
        public function showClasses(){
            $get = new ClassService();
            $found = $get->showclasses();
            $this->render('teacher/classes', ['classes'=>$found]);
        }
        
        public function showWorks(){
            error_log("TeacherController showWorks called");
            $this->render('teacher/works');
        }
        
        public function evaluationForm(){
            $this->render('teacher/evaluation');
        }
        
        public function chatForm(){
            $this->render('teacher/chat');
        }
        
        public function dashboard(){
            $stats = new TeacherService();
            $statistics = $stats->getStatistics();
            $this->render('teacher/dashboard', ['statistics' => $statistics]);
        }
        
        public function createStudentForm(){
            $get = new TeacherService();
            $found = $get->showClasses();
            $this->render('teacher/add_student', ['classes'=>$found]);
        }
        
        public function createStudent(){
            $add = new TeacherService();
            $add->createStudent();
            $this->redirect('/teacher');
        }
        
        public function createClassForm(){
            $this->render('teacher/add_class');
        }

        public function createClass(){
            $add = new TeacherService();
            $add->createClass();
            $this->redirect('/teacher');
        }
        
        public function assignWorkForm(){
            $got = new TeacherService();
            $find = $got->showStudents();
            $get = new TeacherService();
            $found = $get->showClasses();
            $this->render('teacher/assign',['classes' => $found, 'students' => $find]);
        }
        
        public function assignWork(){
            $assign = new TeacherService();
            $assign->assignWork();
            $this->redirect('/teacher');
        }
        
        public function createWorkForm(){
            $this->render('teacher/create_work');
        }
        
        public function createWork(){
            error_log("TeacherController createWork called");
            $add = new TeacherService();
            $result = $add->createWork();
            error_log("TeacherService createWork result: " . ($result ? 'success' : 'failed'));
            
            if($result) {
                $_SESSION['success_message'] = 'Travail créé avec succès !';
                error_log("Setting success message, redirecting to /teacher/works");
            } else {
                $_SESSION['error_message'] = 'Erreur lors de la création du travail.';
                error_log("Setting error message, redirecting to /teacher/works");
            }
            
            $this->redirect('/teacher/works');
        }
        
        public function gradeWorkForm(){
            $this->render('teacher/grade_work');
        }
        
        public function gradeWork(){
            $grade = new TeacherService();
            $grade->gradeWork();
            $this->redirect('/teacher');
        }
        
        public function attendanceForm(){
            $this->render('teacher/attendance');
        }
        
        public function takeAttendance(){
            $attendance = new TeacherService();
            $attendance->takeAttendance();
            $this->redirect('/teacher');
        }
        
        public function statistics(){
            $stats = new TeacherService();
            $statistics = $stats->getStatistics();
            $this->render('teacher/statistics', ['statistics' => $statistics]);
        }
    }