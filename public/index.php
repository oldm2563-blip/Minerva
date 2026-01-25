<?php
require '../vendor/autoload.php';
session_start();

use app\core\Router;
use app\controllers\AuthController;
use app\controllers\StudentController;
use app\controllers\TeacherController;


$router = new Router();

$routes = [
        "GET /" => [AuthController::class , "Loginform"],
        "POST /" => [AuthController::class , "Login"],
        "GET /register" => [AuthController::class , "registerform"],
        "POST /register" => [AuthController::class , "register"],
        "GET /student" => [StudentController::class , "studentboard"],
        "GET /student/classes" => [StudentController::class , "myclasses"],
        "GET /student/works" => [StudentController::class , "myworks"],
        "GET /student/grades" => [StudentController::class , "mygrades"],
        "GET /student/chat" => [StudentController::class , "chat"],
        "POST /student/submit" => [StudentController::class , "submit"],
        "GET /teacher" => [TeacherController::class , "teacherboard"],
        "GET /teacher/addstudent" => [TeacherController::class , "add_student_form"],
        "POST /teacher/addstudent" => [TeacherController::class , "add_student"],
        "GET /teacher/addclass" => [TeacherController::class , "add_class_form"],
        "POST /teacher/addclass" => [TeacherController::class , "add_class"],
        "GET /teacher/classes" => [TeacherController::class , "classes"],
        "GET /teacher/assign" => [TeacherController::class , "assign_class_form"],
        "POST /teacher/assign" => [TeacherController::class , "assign_class"],
        "POST /teacher/work" => [TeacherController::class , "add_work"],
        "GET /teacher/works" => [TeacherController::class , "works"],
        "GET /teacher/evaluation" => [TeacherController::class , "evaluation"],
        "GET /teacher/attendance" => [TeacherController::class , "attendance"],
        "POST /teacher/attendance" => [TeacherController::class , "setattendance"],
        "GET /teacher/statistics" => [TeacherController::class , "statistics"],
        "GET /teacher/chat" => [TeacherController::class , "chat"],
        "POST /teacher/grade" => [TeacherController::class , "grade"],
        "GET /teacher/assignwork" => [TeacherController::class , "assign_work_form"],
        "POST /teacher/assignwork" => [TeacherController::class , "assign_work"],
        "GET /logout" => [TeacherController::class , "logout"],
    ];

$router->route($routes);
?>

