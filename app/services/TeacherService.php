<?php
namespace app\services;
use app\models\User;
use app\models\SchoolClass;
use app\models\Work;
use app\models\WorkAssignment;
use app\models\Grade;
use app\models\Attendance;
use app\models\Student;
use app\core\Database;
use PDO;

class TeacherService {
    
    private PDO $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function showClasses() {
        $teacher_id = $_SESSION['id'] ?? 0;
        try {
            $stmt = $this->db->prepare("SELECT * FROM classes WHERE teacher_id = ?");
            $stmt->execute([$teacher_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }
    
    public function showStudents() {
        $teacher_id = $_SESSION['id'] ?? 0;
        try {
            $stmt = $this->db->prepare("
                SELECT u.* FROM users u
                JOIN class_students cs ON u.id = cs.student_id
                JOIN classes c ON cs.class_id = c.id
                WHERE c.teacher_id = ? AND u.role = 'student'
            ");
            $stmt->execute([$teacher_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }
    
    public function createStudent() {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? 'password123'; // Default password if not provided
        $class_id = $_POST['class_id'] ?? '';
        
        if (empty($name) || empty($email) || empty($class_id)) {
            return false;
        }
        
        try {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Créer l'étudiant
            $student = new Student($name, 'student', $email, $hashed_password);
            $student->addstudent();
            
            // Récupérer l'ID de l'étudiant créé
            $student_id = $this->db->lastInsertId();
            
            // Assigner à la classe
            $stmt = $this->db->prepare("INSERT INTO class_students (class_id, student_id) VALUES (?, ?)");
            $stmt->execute([$class_id, $student_id]);
            
            return true;
        } catch (Exception $e) {
            error_log("Error creating student: " . $e->getMessage());
            return false;
        }
    }
    
    public function createClass() {
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $teacher_id = $_SESSION['id'] ?? 0;
        
        if (empty($name) || empty($teacher_id)) {
            return false;
        }
        
        try {
            $class = new SchoolClass($name, $teacher_id);
            $class->createclass();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    
    public function createWork() {
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $class_id = $_POST['class_id'] ?? '';
        $teacher_id = $_SESSION['id'] ?? 0;
        $due_date = $_POST['due_date'] ?? date('Y-m-d H:i:s', strtotime('+7 days'));
        
        if (empty($title) || empty($class_id) || empty($teacher_id)) {
            return false;
        }
        
        try {
            $work = new Work(0, $class_id, $teacher_id, $title, $description, null, $due_date, '');
            return $work->create();
        } catch (Exception $e) {
            return false;
        }
    }
    
    public function assignWork() {
        $work_id = $_POST['work_id'] ?? '';
        $student_ids = $_POST['student_ids'] ?? [];
        
        if (empty($work_id) || empty($student_ids)) {
            return false;
        }
        
        try {
            foreach ($student_ids as $student_id) {
                $stmt = $this->db->prepare("INSERT INTO work_assignments (work_id, student_id, assigned_at) VALUES (?, ?, NOW())");
                $stmt->execute([$work_id, $student_id]);
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    
    public function gradeWork() {
        $assignment_id = $_POST['assignment_id'] ?? '';
        $grade = $_POST['grade'] ?? 0;
        $comment = $_POST['comment'] ?? '';
        
        if (empty($assignment_id) || $grade < 0 || $grade > 20) {
            return false;
        }
        
        try {
            $stmt = $this->db->prepare("
                INSERT INTO grades (assignment_id, grade, comment, graded_at) 
                VALUES (?, ?, ?, NOW())
                ON DUPLICATE KEY UPDATE grade = ?, comment = ?, graded_at = NOW()
            ");
            $stmt->execute([$assignment_id, $grade, $comment, $grade, $comment]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    
    public function takeAttendance() {
        $class_id = $_POST['class_id'] ?? '';
        $date = $_POST['date'] ?? date('Y-m-d');
        $attendance_data = $_POST['attendance'] ?? [];
        
        if (empty($class_id) || empty($attendance_data)) {
            return false;
        }
        
        try {
            foreach ($attendance_data as $student_id => $status) {
                $stmt = $this->db->prepare("
                    INSERT INTO attendance (class_id, student_id, date, status, recorded_at) 
                    VALUES (?, ?, ?, ?, NOW())
                    ON DUPLICATE KEY UPDATE status = ?, recorded_at = NOW()
                ");
                $stmt->execute([$class_id, $student_id, $date, $status, $status]);
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    
    public function getStatistics() {
        $teacher_id = $_SESSION['id'] ?? 0;
        
        try {
            // Total des étudiants
            $stmt = $this->db->prepare("
                SELECT COUNT(DISTINCT u.id) as total_students
                FROM users u
                JOIN class_students cs ON u.id = cs.student_id
                JOIN classes c ON cs.class_id = c.id
                WHERE c.teacher_id = ? AND u.role = 'student'
            ");
            $stmt->execute([$teacher_id]);
            $total_students = $stmt->fetchColumn();
            
            // Moyenne générale
            $average_grade = 0;
            
            // Taux de présence
            $stmt = $this->db->prepare("
                SELECT 
                    SUM(CASE WHEN status = 'present' THEN 1 ELSE 0 END) * 100.0 / COUNT(*) as attendance_rate
                FROM attendance a
                JOIN classes c ON a.class_id = c.id
                WHERE c.teacher_id = ?
            ");
            $stmt->execute([$teacher_id]);
            $attendance_rate = round($stmt->fetchColumn(), 2) ?: 0;
            
            // Devoirs en attente
            $pending_assignments = 0;
            
            return [
                'total_students' => (int)$total_students,
                'average_grade' => (float)$average_grade,
                'attendance_rate' => (float)$attendance_rate,
                'pending_assignments' => (int)$pending_assignments
            ];
        } catch (Exception $e) {
            return [
                'total_students' => 0,
                'average_grade' => 0,
                'attendance_rate' => 0,
                'pending_assignments' => 0
            ];
        }
    }
}
?>
