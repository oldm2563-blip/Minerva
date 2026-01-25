<?php
namespace app\models;
use app\core\Database;

use PDO;
class Grade
{
    private  $id;
    private  $submissionId;
    private  $grade;
    private  $comment;
    private  $appreciation;
    private  $gradedAt;
    private $db;

    public function __construct(
         $id,
         $submissionId,
         $grade,
         $comment,
         $appreciation
    ) {
        $this->id           = $id;
        $this->submissionId = $submissionId;
        $this->grade        = $grade;
        $this->comment      = $comment;
        $this->appreciation = $appreciation;
        $this->gradedAt     = date('Y-m-d H:i:s');
        $this->db = Database::getInstance();
    }

   
    public function getId(): int
    {
        return $this->id;
    }

    public function getSubmissionId(): int
    {
        return $this->submissionId;
    }

    public function getGrade(): float
    {
        return $this->grade;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function getGradedAt(): string
    {
        return $this->gradedAt;
    }

    public function grade(){
        $stmt = $this->db->prepare("INSERT INTO grades (submission_id, grade, comment, appreciation, graded_at) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$this->submissionId, $this->grade, $this->comment, $this->appreciation, $this->gradedAt]);
    }
    public function showgrade($id){
        $stmt = $this->db->prepare("SELECT * WHERE submission_id = ?");
        $stmt->execute([$id]);
    }
    
    public function getRecentEvaluations($teacher_id) {
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
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
