<?php
namespace app\models;
use app\core\Database;
use PDO;

class RecentActivities
{
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getTeacherActivities($teacher_id) {
        $activities = [];

        $stmt = $this->db->prepare("
            SELECT s.submitted_at as date, CONCAT(u.name, ' a soumis un travail') as activity, c.name as class_name
            FROM submissions s
            INNER JOIN users u ON s.student_id = u.id
            INNER JOIN works w ON s.work_id = w.id
            INNER JOIN classes c ON w.class_id = c.id
            WHERE w.teacher_id = ?
            ORDER BY s.submitted_at DESC
            LIMIT 5
        ");
        $stmt->execute([$teacher_id]);
        $submissions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $stmt = $this->db->prepare("
            SELECT w.created_at as date, 'Création d\\'un nouveau travail' as activity, c.name as class_name
            FROM works w
            INNER JOIN classes c ON w.class_id = c.id
            WHERE w.teacher_id = ?
            ORDER BY w.created_at DESC
            LIMIT 3
        ");
        $stmt->execute([$teacher_id]);
        $works = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $stmt = $this->db->prepare("
            SELECT g.graded_at as date, CONCAT('Évaluation du travail de ', u.name) as activity, c.name as class_name
            FROM grades g
            INNER JOIN submissions s ON g.submission_id = s.id
            INNER JOIN works w ON s.work_id = w.id
            INNER JOIN users u ON s.student_id = u.id
            INNER JOIN classes c ON w.class_id = c.id
            WHERE w.teacher_id = ?
            ORDER BY g.graded_at DESC
            LIMIT 3
        ");
        $stmt->execute([$teacher_id]);
        $evaluations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        
        $all_activities = array_merge($submissions, $works, $evaluations);
        
        
        usort($all_activities, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });
        
        $activities = array_slice($all_activities, 0, 10);
        foreach ($activities as &$activity) {
            $activity['date'] = date('d/m/Y', strtotime($activity['date']));
        }
        
        return $activities;
    }
}
