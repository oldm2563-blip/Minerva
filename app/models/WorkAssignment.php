<?php
namespace app\models;

use app\core\Database;
use PDO;

class WorkAssignment {
    private int $id;
    private int $work_id;
    private int $student_id;

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

    public function getStatus(): string {
        $stmt = $this->db->prepare("
            SELECT * FROM submissions 
            WHERE work_id = :work_id AND student_id = :student_id
        ");
        $stmt->execute([
            ':work_id' => $this->work_id,
            ':student_id' => $this->student_id
        ]);

        $submission = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($submission) {
            return 'submitted';
        } else {
            return 'pending';
        }
    }

    
    public function assignToStudent(int $work_id, int $student_id): bool {
        $stmt = $this->db->prepare("
            INSERT INTO work_assignments (work_id, student_id) VALUES (:work_id, :student_id)
        ");
        return $stmt->execute([
            ':work_id' => $work_id,
            ':student_id' => $student_id
        ]);
    }

    public function getByWork(int $work_id): array {
        $stmt = $this->db->prepare("SELECT * FROM work_assignments WHERE work_id = :work_id");
        $stmt->execute([':work_id' => $work_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

  
    public function getByStudent(int $student_id): array {
        $stmt = $this->db->prepare("SELECT * FROM work_assignments WHERE student_id = :student_id");
        $stmt->execute([':student_id' => $student_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
