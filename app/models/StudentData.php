<?php
namespace app\models;
use app\core\Database;
use PDO;

class StudentData
{
    private PDO $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function getStudentDashboardStats($student_id) {
        $stats = [];
        
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as count
            FROM work_assignments wa
            INNER JOIN works w ON wa.work_id = w.id
            WHERE wa.student_id = ?
        ");
        $stmt->execute([$student_id]);
        $stats['total_works'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as count
            FROM work_assignments wa
            INNER JOIN works w ON wa.work_id = w.id
            LEFT JOIN submissions s ON wa.work_id = s.work_id AND wa.student_id = s.student_id
            WHERE wa.student_id = ? AND s.id IS NULL AND w.due_date >= CURDATE()
        ");
        $stmt->execute([$student_id]);
        $stats['pending_works'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        
        $stmt = $this->db->prepare("
            SELECT ROUND(COUNT(CASE WHEN a.status = 'present' THEN 1 END) * 100.0 / COUNT(*), 0) as attendance_rate
            FROM attendance a
            WHERE a.student_id = ?
        ");
        $stmt->execute([$student_id]);
        $stats['attendance_rate'] = $stmt->fetch(PDO::FETCH_ASSOC)['attendance_rate'] ?? 0;
        
        $stmt = $this->db->prepare("
            SELECT ROUND(AVG(g.grade), 1) as avg_grade
            FROM grades g
            INNER JOIN submissions s ON g.submission_id = s.id
            WHERE s.student_id = ?
        ");
        $stmt->execute([$student_id]);
        $stats['avg_grade'] = $stmt->fetch(PDO::FETCH_ASSOC)['avg_grade'] ?? 0;
        

        $stmt = $this->db->prepare("
            SELECT g.grade, g.graded_at
            FROM grades g
            INNER JOIN submissions s ON g.submission_id = s.id
            WHERE s.student_id = ?
            ORDER BY g.graded_at DESC
            LIMIT 1
        ");
        $stmt->execute([$student_id]);
        $last_grade = $stmt->fetch(PDO::FETCH_ASSOC);
        $stats['last_grade'] = $last_grade['grade'] ?? null;
        
        return $stats;
    }
    
    public function getUpcomingWorks($student_id) {
        $stmt = $this->db->prepare("
            SELECT w.id, w.title, w.description, w.due_date, c.name as class_name
            FROM work_assignments wa
            INNER JOIN works w ON wa.work_id = w.id
            INNER JOIN classes c ON w.class_id = c.id
            LEFT JOIN submissions s ON wa.work_id = s.work_id AND wa.student_id = s.student_id
            WHERE wa.student_id = ? AND s.id IS NULL AND w.due_date >= CURDATE()
            ORDER BY w.due_date ASC
            LIMIT 5
        ");
        $stmt->execute([$student_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getRecentGrades($student_id) {
        $stmt = $this->db->prepare("
            SELECT g.grade, g.comment, g.graded_at, w.title as work_title, c.name as class_name
            FROM grades g
            INNER JOIN submissions s ON g.submission_id = s.id
            INNER JOIN works w ON s.work_id = w.id
            INNER JOIN classes c ON w.class_id = c.id
            WHERE s.student_id = ?
            ORDER BY g.graded_at DESC
            LIMIT 5
        ");
        $stmt->execute([$student_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getStudentClasses($student_id) {
        $stmt = $this->db->prepare("
            SELECT c.id, c.name, u.name as teacher_name, u.email as teacher_email
            FROM classes c
            INNER JOIN class_students cs ON c.id = cs.class_id
            INNER JOIN users u ON c.teacher_id = u.id
            WHERE cs.student_id = ?
            ORDER BY c.name
        ");
        $stmt->execute([$student_id]);
        $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Get student count for each class
        foreach ($classes as &$class) {
            $stmt = $this->db->prepare("
                SELECT COUNT(*) as count
                FROM class_students cs
                WHERE cs.class_id = ?
            ");
            $stmt->execute([$class['id']]);
            $class['student_count'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        }
        
        return $classes;
    }
    
    public function getStudentWorks($student_id) {
        $stmt = $this->db->prepare("
            SELECT w.id, w.title, w.description, w.due_date, c.name as class_name,
                   CASE WHEN s.id IS NOT NULL THEN 'submitted' ELSE 'pending' END as status,
                   s.submitted_at, s.file_path as submission_file
            FROM work_assignments wa
            INNER JOIN works w ON wa.work_id = w.id
            INNER JOIN classes c ON w.class_id = c.id
            LEFT JOIN submissions s ON wa.work_id = s.work_id AND wa.student_id = s.student_id
            WHERE wa.student_id = ?
            ORDER BY w.due_date DESC
        ");
        $stmt->execute([$student_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getStudentGrades($student_id) {
        $stmt = $this->db->prepare("
            SELECT g.grade, g.comment, g.graded_at, 
                   w.title as work_title, w.description as work_description,
                   c.name as class_name, s.submitted_at
            FROM grades g
            INNER JOIN submissions s ON g.submission_id = s.id
            INNER JOIN works w ON s.work_id = w.id
            INNER JOIN classes c ON w.class_id = c.id
            WHERE s.student_id = ?
            ORDER BY g.graded_at DESC
        ");
        $stmt->execute([$student_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
