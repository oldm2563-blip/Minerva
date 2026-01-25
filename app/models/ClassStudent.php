<?php
namespace app\models;


use app\core\Database;
use PDO;

class ClassStudent {
    private int $student_id;
    private int $class_id;

    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }


    public function setStudentId(int $student_id): void {
        $this->student_id = $student_id;
    }

    public function setClassId(int $class_id): void {
        $this->class_id = $class_id;
    }

    

  
    public function assignToClass( $student_id,  $class_id) {
        $stmt = $this->db->prepare("
            INSERT INTO class_students (student_id, class_id) VALUES (:student_id, :class_id)
        ");
        $stmt->execute([
            ':student_id' => $student_id,
            ':class_id' => $class_id
        ]);
    }

   
    public function getStatus() {
        $stmt = $this->db->prepare("
            SELECT * FROM class_students WHERE student_id = :student_id AND class_id = :class_id
        ");
        $stmt->execute([
            ':student_id' => $this->student_id,
            ':class_id' => $this->class_id
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return 'assigned';
        } else {
            return 'not assigned';
        }
    }

   
    public function getStudentsByClass(int $class_id) {
        $stmt = $this->db->prepare("SELECT * FROM class_students WHERE class_id = :class_id");
        $stmt->execute([':class_id' => $class_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStudentDetailsByClass(int $class_id) {
        $stmt = $this->db->prepare("
            SELECT u.id, u.name, u.email 
            FROM users u
            INNER JOIN class_students cs ON u.id = cs.student_id
            WHERE cs.class_id = :class_id AND u.role = 'student'
        ");
        $stmt->execute([':class_id' => $class_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function getClassesByStudent(int $student_id) {
        $stmt = $this->db->prepare("SELECT * FROM class_students WHERE student_id = :student_id");
        $stmt->execute([':student_id' => $student_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
