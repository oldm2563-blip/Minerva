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
    ];

$router->route($routes);
?>