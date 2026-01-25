<?php
namespace app\services;
use app\models\StudentData;
use Exception;


class StudentDataService{
    
    public function getStudentDashboardData() {
        $student_id = $_SESSION['id'] ?? null;
        if (!$student_id) {
            return [
                'stats' => [],
                'upcoming_works' => [],
                'recent_grades' => []
            ];
        }

        try {
            $studentData = new StudentData();
            
            // Get student statistics
            $stats = $studentData->getStudentDashboardStats($student_id);
            
            // Get upcoming works
            $upcoming_works = $studentData->getUpcomingWorks($student_id);
            
            // Get recent grades
            $recent_grades = $studentData->getRecentGrades($student_id);
            
            return [
                'stats' => $stats,
                'upcoming_works' => $upcoming_works,
                'recent_grades' => $recent_grades
            ];
            
        } catch (Exception $e) {
            error_log("Student dashboard data error: " . $e->getMessage());
            return [
                'stats' => [],
                'upcoming_works' => [],
                'recent_grades' => []
            ];
        }
    }
    
    public function getStudentClasses() {
        $student_id = $_SESSION['id'] ?? null;
        if (!$student_id) {
            return [];
        }

        try {
            $studentData = new StudentData();
            return $studentData->getStudentClasses($student_id);
            
        } catch (Exception $e) {
            error_log("Student classes error: " . $e->getMessage());
            return [];
        }
    }
    
    public function getStudentWorks() {
        $student_id = $_SESSION['id'] ?? null;
        if (!$student_id) {
            return [];
        }

        try {
            $studentData = new StudentData();
            return $studentData->getStudentWorks($student_id);
            
        } catch (Exception $e) {
            error_log("Student works error: " . $e->getMessage());
            return [];
        }
    }
    
    public function getStudentGrades() {
        $student_id = $_SESSION['id'] ?? null;
        if (!$student_id) {
            return [];
        }

        try {
            $studentData = new StudentData();
            return $studentData->getStudentGrades($student_id);
            
        } catch (Exception $e) {
            error_log("Student grades error: " . $e->getMessage());
            return [];
        }
    }
}
?>
