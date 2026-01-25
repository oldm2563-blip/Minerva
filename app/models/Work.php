<?php
namespace app\models;
use app\core\Database;
use PDO;

class Work
{
    private ?int $id;
    private int $classId;
    private int $teacherId;
    private string $title;
    private string $description;
    private ?string $filePath;
    private string $dueDate;
    private string $createdAt;

    private PDO $db;

    public function __construct(
         ?int $id,
         ?int $classId,
         ?int $teacherId,
         ?string $title,
         ?string $description,
         ?string $filePath,
         ?string $dueDate,
         ?string $createdAt
    ) {
        $this->id          = $id;
        $this->classId     = $classId ?? 0;
        $this->teacherId   = $teacherId ?? 0;
        $this->title       = $title ?? '';
        $this->description = $description ?? '';
        $this->filePath    = $filePath;
        $this->dueDate     = $dueDate ?? '';
        $this->createdAt   = $createdAt ?? '';
        $this->db = Database::getInstance();
    }

    public function create()
    {
       
        
        $stmt = $this->db->prepare("
            INSERT INTO works (class_id, teacher_id, title, description, file_path, due_date)
            VALUES (:class_id, :teacher_id, :title, :description, :file_path, :due_date)
        ");
        
        $result = $stmt->execute([
            ':class_id'     => $this->classId,
            ':teacher_id'   => $this->teacherId,
            ':title'        => $this->title,
            ':description'  => $this->description,
            ':file_path'    => $this->filePath,
            ':due_date'     => $this->dueDate
        ]);
        
        if ($result) {
            $work_id = $this->db->lastInsertId();
            $this->assignWorkToClassStudents($work_id, $this->classId);
            
            error_log("Work created and assigned successfully. Work ID: $work_id");
        } else {
            error_log("Work creation failed. Statement error: " . print_r($stmt->errorInfo(), true));
        }
        
        return $result;
    }
    
    private function assignWorkToClassStudents($work_id, $class_id) {
        // Get all students in the class
        $stmt = $this->db->prepare("
            SELECT student_id FROM class_students WHERE class_id = :class_id
        ");
        $stmt->execute([':class_id' => $class_id]);
        $students = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        // Assign work to each student
        $assignmentStmt = $this->db->prepare("
            INSERT INTO work_assignments (work_id, student_id) VALUES (:work_id, :student_id)
        ");
        
        foreach ($students as $student_id) {
            $assignmentStmt->execute([
                ':work_id' => $work_id,
                ':student_id' => $student_id
            ]);
        }
        
        error_log("Assigned work to " . count($students) . " students in class $class_id");
    }

    public function read(int $id): ?self
    {
        $stmt = $this->db->prepare("SELECT * FROM works WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) return null;

        return new self(
            $data['id'],
            $data['class_id'],
            $data['teacher_id'],
            $data['title'],
            $data['description'],
            $data['file_path'],
            $data['due_date'],
            $data['created_at']
        );
    }

    public function getWorksByTeacher(int $teacher_id) {
        $stmt = $this->db->prepare("
            SELECT w.*, c.name as class_name 
            FROM works w
            LEFT JOIN classes c ON w.class_id = c.id
            WHERE w.teacher_id = :teacher_id
            ORDER BY w.created_at DESC
        ");
        $stmt->execute([':teacher_id' => $teacher_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update(): bool
    {
        $stmt = $this->db->prepare("
            UPDATE works SET
                class_id = :class_id,
                teacher_id = :teacher_id,
                title = :title,
                description = :description,
                file_path = :file_path,
                due_date = :due_date
            WHERE id = :id
        ");
        return $stmt->execute([
            ':class_id'    => $this->classId,
            ':teacher_id'  => $this->teacherId,
            ':title'       => $this->title,
            ':description' => $this->description,
            ':file_path'   => $this->filePath,
            ':due_date'    => $this->dueDate,
            ':id'          => $this->id
        ]);
    }
    
    public function getActiveWorksCount($teacher_id) {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as count
            FROM works
            WHERE teacher_id = ? AND due_date >= CURDATE()
        ");
        $stmt->execute([$teacher_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    }
    
    public function getPendingEvaluationsCount($teacher_id) {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as count
            FROM submissions s
            INNER JOIN works w ON s.work_id = w.id
            LEFT JOIN grades g ON s.id = g.submission_id
            WHERE w.teacher_id = ? AND g.id IS NULL
        ");
        $stmt->execute([$teacher_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    }
    
    public function getRecentSubmissions($teacher_id) {
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
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getRecentWorkCreations($teacher_id) {
        $stmt = $this->db->prepare("
            SELECT w.created_at as date, 'Création d\\'un nouveau travail' as activity, c.name as class_name
            FROM works w
            INNER JOIN classes c ON w.class_id = c.id
            WHERE w.teacher_id = ?
            ORDER BY w.created_at DESC
            LIMIT 3
        ");
        $stmt->execute([$teacher_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
