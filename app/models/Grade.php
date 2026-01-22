<?php
namespace app\models;
use app\core\Database;


class Grade
{
    private  $id;
    private  $submissionId;
    private  $grade;
    private  $comment;
    private  $gradedAt;
    private $db;

    public function __construct(
         $id,
         $submissionId,
         $grade,
         $comment,
         $gradedAt
    ) {
        $this->id           = $id;
        $this->submissionId = $submissionId;
        $this->grade        = $grade;
        $this->comment      = $comment;
        $this->gradedAt     = $gradedAt;
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
        $stmt = $this->db->prepare("INSERT INTO grades (submission_id ,grade , comment) VALUES (?, ?, ?)");
        $stmt->execute([$this->submissionId, $this->grade, $this->comment]);
    }
    public function showgrade($id){
        $stmt = $this->db->prepare("SELECT * WHERE submission_id = ?");
        $stmt->execute([$id]);
    }
}
