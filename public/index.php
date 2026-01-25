<?php
require '../vendor/autoload.php';
session_start();

use app\core\Router;
use app\controllers\AuthController;
use app\controllers\StudentController;
use app\controllers\TeacherController;

// Debug logging
error_log("=== REQUEST START ===");
error_log("Method: " . $_SERVER['REQUEST_METHOD']);
error_log("URI: " . $_SERVER['REQUEST_URI']);
error_log("Query string: " . ($_SERVER['QUERY_STRING'] ?? 'none'));

// Debug mode - show all routes
if (isset($_GET['debug'])) {
    echo "<h1>DEBUG MODE - Available Routes</h1>";
    echo "<pre>";
    print_r([
        "GET /" => [AuthController::class, "loginform"],
        "GET /login" => [AuthController::class, "loginform"],
        "GET /teacher" => [TeacherController::class, "dashboard"],
        "GET /teacher/works" => [TeacherController::class, "showWorks"],
        "GET /teacher/classes" => [TeacherController::class, "showClasses"],
        "POST /teacher/create-work" => [TeacherController::class, "createWork"],
    ]);
    echo "</pre>";
    exit;
}

$router = new Router();

$routes = [
    // Auth routes
    "GET /" => [AuthController::class, "loginform"],
    "POST /" => [AuthController::class, "Login"],
    "GET /login" => [AuthController::class, "loginform"],
    "POST /login" => [AuthController::class, "Login"],
    "GET /logout" => [AuthController::class, "logout"],
    "GET /register" => [AuthController::class, "registerForm"],
    "POST /register" => [AuthController::class, "register"],
    
    // Teacher routes
    "GET /teacher" => [TeacherController::class, "dashboard"],
    "GET /teacher/classes" => [TeacherController::class, "showClasses"],
    "GET /teacher/works" => [TeacherController::class, "showWorks"],
    "GET /teacher/evaluation" => [TeacherController::class, "evaluationForm"],
    "GET /teacher/chat" => [TeacherController::class, "chatForm"],
    "GET /teacher/create-class" => [TeacherController::class, "createClassForm"],
    "POST /teacher/create-class" => [TeacherController::class, "createClass"],
    "GET /teacher/create-student" => [TeacherController::class, "createStudentForm"],
    "POST /teacher/create-student" => [TeacherController::class, "createStudent"],
    "GET /teacher/create-work" => [TeacherController::class, "createWorkForm"],
    "POST /teacher/create-work" => [TeacherController::class, "createWork"],
    "GET /teacher/assign-work" => [TeacherController::class, "assignWorkForm"],
    "POST /teacher/assign-work" => [TeacherController::class, "assignWork"],
    "GET /teacher/grade-work" => [TeacherController::class, "gradeWorkForm"],
    "POST /teacher/grade-work" => [TeacherController::class, "gradeWork"],
    "GET /teacher/attendance" => [TeacherController::class, "attendanceForm"],
    "POST /teacher/attendance" => [TeacherController::class, "takeAttendance"],
    "GET /teacher/statistics" => [TeacherController::class, "statistics"],
    
    // Legacy routes (for compatibility)
    "GET /teacher/addstudent" => [TeacherController::class, "createStudentForm"],
    "POST /teacher/addstudent" => [TeacherController::class, "createStudent"],
    "GET /teacher/addclass" => [TeacherController::class, "createClassForm"],
    "POST /teacher/addclass" => [TeacherController::class, "createClass"],
    "GET /teacher/assign" => [TeacherController::class, "assignWorkForm"],
    "POST /teacher/assign" => [TeacherController::class, "assignWork"],
    "POST /teacher/work" => [TeacherController::class, "createWork"],
    
    // Student routes
    "GET /student" => [StudentController::class, "dashboard"],
    "GET /student/classes" => [StudentController::class, "viewClasses"],
    "GET /student/works" => [StudentController::class, "viewWorks"],
    "GET /student/grades" => [StudentController::class, "viewGrades"],
    "GET /student/chat" => [StudentController::class, "viewChat"],
    "GET /student/class" => [StudentController::class, "viewClass"],
    "GET /student/work" => [StudentController::class, "viewWork"],
    "POST /student/work" => [StudentController::class, "submitWork"],
    "POST /student/chat" => [StudentController::class, "sendMessage"],
];

$router->route($routes);
?>

