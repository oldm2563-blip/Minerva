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
        "GET /student" => [StudentController::class , "studentboard"],
        "GET /teacher" => [TeacherController::class , "teacherboard"],
        "GET /teacher/addstudent" => [TeacherController::class , "add_student_form"],
        "POST /teacher/addstudent" => [TeacherController::class , "add_student"],
        "GET /teacher/addclass" => [TeacherController::class , "add_class_form"],
        "POST /teacher/addclass" => [TeacherController::class , "add_class"],
        "GET /teacher/assign" => [TeacherController::class , "assign_class_form"],
        "POST /teacher/assign" => [TeacherController::class , "assign_class"],
        "POST /teacher/work" => [TeacherController::class , "add_work"],
    ];

$router->route($routes);
?>

