<?php

namespace app\controllers;

    class TeacherController{
        public function add_student_form(){
            require __DIR__ . "/../views/teacher/add_student.php";
        }
        public function teacherboard(){
            require __DIR__ . "/../views/teacher/dashboard.php";
        }
    }