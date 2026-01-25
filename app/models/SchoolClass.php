<?php
namespace app\models;
use app\core\Database;
use PDO;

class SchoolClass
{
    private $id;
    private $name;
    private $teacherId;
    private PDO $db;

    public function __construct(
         $name,
         $teacherId
    ) {
        $this->name      = $name;
        $this->teacherId = $teacherId;
        $this->db = Database::getInstance();
        
        error_log("SchoolClass constructor - Name: '$name', Teacher ID: '$teacherId'");
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTeacherId(): int
    {
        return $this->teacherId;
    }
    
    public function showclasses($id){
        $stmt = $this->db->prepare("SELECT * FROM classes WHERE teacher_id = ?");
        $stmt->execute([$id]);
        $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $classes;
    }
    
    public function createclass(){
        
        $stmt = $this->db->prepare("INSERT INTO classes (name, teacher_id) VALUES (? , ?)");
        $result = $stmt->execute([$this->name , $this->teacherId]);
        
        return $result;
    }
}
