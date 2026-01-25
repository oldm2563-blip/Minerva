<?php
namespace app\models;
use app\core\Database;
use PDO;

class DashboardStats
{
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getTeacherStats($teacher_id) {
        $stats = [];

        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM classes WHERE teacher_id = ?");
        $stmt->execute([$teacher_id]);
        $stats['total_classes'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

        $stmt = $this->db->prepare("
            SELECT COUNT(DISTINCT cs.student_id) as count
            FROM class_students cs
            INNER JOIN classes c ON cs.class_id = c.id
            WHERE c.teacher_id = ?
        ");
        $stmt->execute([$teacher_id]);
        $stats['total_students'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

        $stmt = $this->db->prepare("
            SELECT COUNT(*) as count
            FROM works
            WHERE teacher_id = ? AND due_date >= CURDATE()
        ");
        $stmt->execute([$teacher_id]);
        $stats['active_works'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

        $stmt = $this->db->prepare("
            SELECT COUNT(*) as count
            FROM submissions s
            INNER JOIN works w ON s.work_id = w.id
            LEFT JOIN grades g ON s.id = g.submission_id
            WHERE w.teacher_id = ? AND g.id IS NULL
        ");
        $stmt->execute([$teacher_id]);
        $stats['pending_evaluations'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        
        return $stats;
    }
}
