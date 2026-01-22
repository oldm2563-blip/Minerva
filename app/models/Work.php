<?php
namespace app\models;
use app\core\Database;
use PDO;

class Work
{
    private int $id;
    private int $classId;
    private int $teacherId;
    private string $title;
    private string $description;
    private ?string $filePath;
    private string $dueDate;
    private string $createdAt;

    private PDO $db;

    public function __construct(
         $id,
         $classId,
         $teacherId,
         $title,
         $description,
         $filePath,
         $dueDate,
         $createdAt
    ) {
        $this->id          = $id;
        $this->classId     = $classId;
        $this->teacherId   = $teacherId;
        $this->title       = $title;
        $this->description = $description;
        $this->filePath    = $filePath;
        $this->dueDate     = $dueDate;
        $this->createdAt   = $createdAt;
        $this->db = Database::getInstance();
    }

    public function create()
    {
        $stmt = $this->db->prepare("
            INSERT INTO works (class_id, teacher_id, title, description, file_path, due_date)
            VALUES (:class_id, :teacher_id, :title, :description, :file_path, :due_date)
        ");
        return $stmt->execute([
            ':class_id'     => $this->classId,
            ':teacher_id'   => $this->teacherId,
            ':title'        => $this->title,
            ':description'  => $this->description,
            ':file_path'    => $this->filePath,
            ':due_date'     => $this->dueDate
        ]);
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

}
