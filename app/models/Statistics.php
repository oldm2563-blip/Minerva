<?php
namespace app\models;
use app\core\Database;
use PDO;

class Statistics
{
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getTeacherStatistics($teacher_id) {
        $overall_stats = [];
        $class_stats = [];
        $top_students = [];
        
        $stmt = $this->db->prepare("
            SELECT COUNT(DISTINCT cs.student_id) as total_students
            FROM class_students cs
            INNER JOIN classes c ON cs.class_id = c.id
            WHERE c.teacher_id = ?
        ");
        $stmt->execute([$teacher_id]);
        $overall_stats['total_students'] = $stmt->fetch(PDO::FETCH_ASSOC)['total_students'];
        
        $stmt = $this->db->prepare("
            SELECT ROUND(AVG(attendance_rate), 1) as avg_attendance
            FROM (
                SELECT COUNT(CASE WHEN a.status = 'present' THEN 1 END) * 100.0 / COUNT(*) as attendance_rate
                FROM attendance a
                INNER JOIN classes c ON a.class_id = c.id
                WHERE c.teacher_id = ?
                GROUP BY a.date, a.class_id
            ) as rates
        ");
        $stmt->execute([$teacher_id]);
        $overall_stats['avg_attendance'] = $stmt->fetch(PDO::FETCH_ASSOC)['avg_attendance'] ?? 0;

        $stmt = $this->db->prepare("
            SELECT ROUND(COUNT(CASE WHEN s.id IS NOT NULL THEN 1 END) * 100.0 / COUNT(*), 1) as completion_rate
            FROM work_assignments wa
            INNER JOIN works w ON wa.work_id = w.id
            INNER JOIN classes c ON w.class_id = c.id
            LEFT JOIN submissions s ON wa.work_id = s.work_id AND wa.student_id = s.student_id
            WHERE c.teacher_id = ?
        ");
        $stmt->execute([$teacher_id]);
        $overall_stats['completion_rate'] = $stmt->fetch(PDO::FETCH_ASSOC)['completion_rate'] ?? 0;
        
        $stmt = $this->db->prepare("
            SELECT c.name, COUNT(cs.student_id) as student_count,
                   ROUND(AVG(g.grade), 1) as avg_grade,
                   ROUND(AVG(CASE WHEN a.status = 'present' THEN 1 END) * 100.0, 1) as attendance_rate,
                   ROUND(COUNT(CASE WHEN s.id IS NOT NULL THEN 1 END) * 100.0 / COUNT(*), 1) as submission_rate
            FROM classes c
            LEFT JOIN class_students cs ON c.id = cs.class_id
            LEFT JOIN attendance a ON c.id = a.class_id
            LEFT JOIN work_assignments wa ON c.id = wa.work_id
            LEFT JOIN works w ON wa.work_id = w.id AND w.class_id = c.id
            LEFT JOIN submissions s ON wa.work_id = s.work_id AND wa.student_id = s.student_id
            LEFT JOIN grades g ON s.id = g.submission_id
            WHERE c.teacher_id = ?
            GROUP BY c.id, c.name
            ORDER BY c.name
        ");
        $stmt->execute([$teacher_id]);
        $class_stats = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $stmt = $this->db->prepare("
            SELECT u.name, c.name as class_name, AVG(g.grade) as avg_grade
            FROM users u
            INNER JOIN class_students cs ON u.id = cs.student_id
            INNER JOIN classes c ON cs.class_id = c.id
            INNER JOIN submissions s ON u.id = s.student_id
            INNER JOIN grades g ON s.id = g.submission_id
            WHERE c.teacher_id = ?
            GROUP BY u.id, u.name, c.name
            HAVING COUNT(g.grade) >= 2
            ORDER BY avg_grade DESC
            LIMIT 10
        ");
        $stmt->execute([$teacher_id]);
        $top_students = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return [
            'overall_stats' => $overall_stats,
            'class_stats' => $class_stats,
            'top_students' => $top_students
        ];
    }
}
