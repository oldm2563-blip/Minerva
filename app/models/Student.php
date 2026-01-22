<?php
namespace app\models;
use app\core\Database;
use app\models\User;
use PDO;

class Student extends User
{
    private  $classId;
    private $db;

    public function __construct(
         $username,
         $email,
         $password,
    ) {
        parent::__construct($username, $email, $password, 'student');
        $this->db = Database::getInstance();
    }

  
    public function getClassId(): int
    {
        return $this->classId;
    }

    public function addstudent(){
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password, role) VALUES (?,?,?,?)");
        $stmt->execute([$this->username,$this->email,$this->password,$this->role]);
    }
    public function allstudents(){
        $stmt = $this->db->query("SELECT * FROM users WHERE role = 'student'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
