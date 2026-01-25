<?php
namespace app\models;
use app\core\Database;
use PDO;

class EvaluationData
{
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getPendingEvaluations($teacher_id) {
        $stmt = $this->db->prepare("
            SELECT s.id as submission_id, s.submitted_at, u.name as student_name, u.email as student_email,
                   w.title as work_title, w.due_date, c.name as class_name
            FROM submissions s
            INNER JOIN works w ON s.work_id = w.id
            INNER JOIN users u ON s.student_id = u.id
            INNER JOIN classes c ON w.class_id = c.id
            LEFT JOIN grades g ON s.id = g.submission_id
            WHERE w.teacher_id = ? AND g.id IS NULL
            ORDER BY s.submitted_at DESC
        ");
        $stmt->execute([$teacher_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCompletedEvaluations($teacher_id) {
        $stmt = $this->db->prepare("
            SELECT s.id as submission_id, s.submitted_at, u.name as student_name, u.email as student_email,
                   w.title as work_title, w.due_date, c.name as class_name,
                   g.grade, g.comment, g.appreciation, g.graded_at
            FROM submissions s
            INNER JOIN works w ON s.work_id = w.id
            INNER JOIN users u ON s.student_id = u.id
            INNER JOIN classes c ON w.class_id = c.id
            INNER JOIN grades g ON s.id = g.submission_id
            WHERE w.teacher_id = ?
            ORDER BY g.graded_at DESC
        ");
        $stmt->execute([$teacher_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
