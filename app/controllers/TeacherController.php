<?php
namespace app\controllers;

use app\core\Controller;
use app\services\ClassService;
use app\services\StudentService;

    class TeacherController extends Controller{
        public function add_student_form(){
            $get = new ClassService();
            $found = $get->showclasses();
            $this->render('teacher/add_student', ['classes'=>$found]);
        }
        public function add_student(){
            $add = new StudentService();
            $add->addstudent();
            $this->redirect('teacher');
        }
        public function teacherboard(){
            $get = new ClassService();
            $found = $get->showclasses();
            var_dump($found);
            $this->render('teacher/classes');
        }

        public function add_class_form(){
            $this->render('teacher/add_class');
        }

        public function add_class(){
            $add = new ClassService();
            $add->addclass();
            $this->redirect('teacher');
        }
        public function assign_class_form(){
            $got = new StudentService();
            $find = $got->showstudents();
            $get = new ClassService();
            $found = $get->showclasses();
            $this->render('teacher/assign',['classes' => $found, 'students' => $find]);
        }
        public function assign_class(){
            $assign = new StudentService();
            $assign->assign();
            $this->redirect('teacher');
        }
        public function add_work(){
            $add = new StudentService();
            $add->create_work();
            $this->redirect('teacher');
        }
        public function assign_work(){
            $assign = new StudentService();
            $assign->assign_work();
            $this->redirect('teacher');
        }
        public function grade(){
            $grade = new StudentService();
            $grade->grade();
            $this->redirect('teacher');
        }
    }