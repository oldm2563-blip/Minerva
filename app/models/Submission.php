<?php
namespace app\Models;

use app\core\Database;
use PDO;

class Submission {
    private int $id;
    private int $work_id;
    private int $student_id;
    private string $content;
    private ?string $file_path;
    private string $submitted_at;

    private PDO $db;

    public function __construct() {
      
        $this->db = Database::getInstance();
    }

   
    public function setWorkId(int $work_id): void {
        $this->work_id = $work_id;
    }

    public function setStudentId(int $student_id): void {
        $this->student_id = $student_id;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }

    public function setFilePath(?string $file_path): void {
        $this->file_path = $file_path;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getSubmittedAt(): string {
        return $this->submitted_at;
    }

    
    public function submit(): bool {
        $this->submitted_at = date('Y-m-d H:i:s');

        $stmt = $this->db->prepare("
            INSERT INTO submissions (work_id, student_id, content, file_path, submitted_at) 
            VALUES (:work_id, :student_id, :content, :file_path, :submitted_at)
        ");

        return $stmt->execute([
            ':work_id' => $this->work_id,
            ':student_id' => $this->student_id,
            ':content' => $this->content,
            ':file_path' => $this->file_path,
            ':submitted_at' => $this->submitted_at
        ]);
    }

  
    public function getByStudent(int $student_id): array {
        $stmt = $this->db->prepare("SELECT * FROM submissions WHERE student_id = :student_id ORDER BY submitted_at DESC");
        $stmt->execute([':student_id' => $student_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function getByWork(int $work_id): array {
        $stmt = $this->db->prepare("SELECT * FROM submissions WHERE work_id = :work_id ORDER BY submitted_at DESC");
        $stmt->execute([':work_id' => $work_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
