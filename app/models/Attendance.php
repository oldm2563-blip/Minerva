<?php
namespace app\models;
use app\core\Database;
use PDO;
class Attendance
{
    private  $id;
    private  $classId;
    private  $studentId;
    private  $date;
    private  $status; 
    private $db;
    public function __construct(
         $id,
         $classId,
         $studentId,
         $date,
    ) {
        $this->id        = $id;
        $this->classId   = $classId;
        $this->studentId = $studentId;
        $this->date      = $date;
        $this->db = Database::getInstance();
    }

  
    public function getId(): int
    {
        return $this->id;
    }

    public function getClassId(): int
    {
        return $this->classId;
    }

    public function getStudentId(): int
    {
        return $this->studentId;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

   public function present(){
        $this->status = 'present';
        $stmt = $this->db->prepare('INSERT INTO attendance (class_id, student_id, date, status) VALUES(? ,? ,? ,?)');
        $stmt->execute([$this->classId,$this->studentId,$this->date]);
   }
   public function absent(){
        $this->status = 'absent';
        $stmt = $this->db->prepare('INSERT INTO attendance (class_id, student_id, date, status) VALUES(? ,? ,NOW() ,?)');
        $stmt->execute([$this->classId,$this->studentId,$this->status]);
   }
   public function checkstatus(){
        $stmt = $this->db->query('SELECT * FROM attendance');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }
}
