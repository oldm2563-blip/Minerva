<?php
namespace app\services;
use app\models\SchoolClass;
use app\models\Attendance;
use app\models\ClassStudent;
use app\models\DashboardStats;
use app\models\RecentActivities;
use app\models\Statistics;
use PDO;
use Exception;

class ClassService{
    public function showclasses(){
        $id = $_SESSION['id'] ?? null;
        if (!$id) {
            error_log("No teacher ID in session");
            return [];
        }
        
        try {
            $get = new SchoolClass("" , "");
            $found = $get->showclasses($id);
            
            // Get students for each class
            $classStudent = new ClassStudent();
            foreach ($found as &$class) {
                $students = $classStudent->getStudentDetailsByClass($class['id']);
                $class['students'] = $students;
                $class['student_count'] = count($students);
            }
            
            return $found;
        } catch (Exception $e) {
            error_log("Database error: " . $e->getMessage());
            throw $e;
        }
    }

    public function getDashboardStats() {
        $teacher_id = $_SESSION['id'] ?? null;
        if (!$teacher_id) {
            return [
                'total_classes' => 0,
                'total_students' => 0,
                'active_works' => 0,
                'pending_evaluations' => 0
            ];
        }

        try {
            $dashboardStats = new DashboardStats();
            return $dashboardStats->getTeacherStats($teacher_id);
            
        } catch (Exception $e) {
            error_log("Dashboard stats error: " . $e->getMessage());
            return [
                'total_classes' => 0,
                'total_students' => 0,
                'active_works' => 0,
                'pending_evaluations' => 0
            ];
        }
    }

    public function getRecentActivities() {
        $teacher_id = $_SESSION['id'] ?? null;
        if (!$teacher_id) {
            return [];
        }

        try {
            $recentActivities = new RecentActivities();
            return $recentActivities->getTeacherActivities($teacher_id);
            
        } catch (Exception $e) {
            error_log("Recent activities error: " . $e->getMessage());
            return [];
        }
    }

    public function addclass(){
        $name = $_POST['name'] ?? '';
        $id = $_SESSION['id'];
        
        if (empty($name)) {
            $_SESSION['error'] = ["Le nom de la classe est requis"];
            header('Location: /teacher/addclass');
            exit;
        }
        
        $add = new SchoolClass($name, $id);
        $add->createclass();
    }
    
    public function attendance(){
        $student_id = $_GET['s_id'] ?? '';
        $class_id = $_GET['c_id'] ?? '';
        $status = $_POST['stat'] ?? '';
        
        if(empty($student_id) || empty($class_id) || empty($status)){
            $_SESSION['error'] = ["Paramètres manquants"];
            return;
        }
        
        $set = new Attendance("",$class_id,$student_id,"");
        if($status === 'present'){
            $set->present();
        }
        else{
            $set->absent();
        }
    }

    public function getAttendanceData() {
        $teacher_id = $_SESSION['id'] ?? null;
        if (!$teacher_id) {
            return [
                'classes' => [],
                'students' => [],
                'history' => []
            ];
        }

        try {
            $attendance = new Attendance("", "", "", "");
            
            // Get teacher's classes
            $classes = $attendance->getTeacherClasses($teacher_id);
            
            // Get students for attendance (if a class is selected)
            $students = [];
            if (isset($_GET['class_id']) && !empty($_GET['class_id'])) {
                $class_id = $_GET['class_id'];
                $students = $attendance->getStudentsForAttendance($class_id);
            }
            
            // Get attendance history
            $history = $attendance->getAttendanceHistory($teacher_id);
            
            return [
                'classes' => $classes,
                'students' => $students,
                'history' => $history
            ];
            
        } catch (Exception $e) {
            error_log("Attendance data error: " . $e->getMessage());
            return [
                'classes' => [],
                'students' => [],
                'history' => []
            ];
        }
    }

    public function getStatistics() {
        $teacher_id = $_SESSION['id'] ?? null;
        if (!$teacher_id) {
            return [
                'overall_stats' => [],
                'class_stats' => [],
                'top_students' => []
            ];
        }

        try {
            $statistics = new Statistics();
            return $statistics->getTeacherStatistics($teacher_id);
            
        } catch (Exception $e) {
            error_log("Statistics error: " . $e->getMessage());
            return [
                'overall_stats' => [],
                'class_stats' => [],
                'top_students' => []
            ];
        }
    }
}
?>
