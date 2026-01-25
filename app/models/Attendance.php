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
        $stmt = $this->db->prepare('INSERT INTO attendance (class_id, student_id, date, status) VALUES(? ,? ,NOW() ,?)');
        $stmt->execute([$this->classId,$this->studentId,$this->status]);
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
   
   public function getTeacherClasses($teacher_id) {
        $stmt = $this->db->prepare("SELECT id, name FROM classes WHERE teacher_id = ?");
        $stmt->execute([$teacher_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
   public function getStudentsForAttendance($class_id) {
        $stmt = $this->db->prepare("
            SELECT u.id, u.name, u.email,
                   CASE WHEN a.status = 'present' THEN 'present' ELSE 'absent' END as status
            FROM users u
            INNER JOIN class_students cs ON u.id = cs.student_id
            LEFT JOIN attendance a ON u.id = a.student_id AND a.class_id = ? AND a.date = CURDATE()
            WHERE cs.class_id = ? AND u.role = 'student'
        ");
        $stmt->execute([$class_id, $class_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
   public function getAttendanceHistory($teacher_id) {
        $stmt = $this->db->prepare("
            SELECT a.date, c.name as class_name,
                   COUNT(CASE WHEN a.status = 'present' THEN 1 END) as presents,
                   COUNT(CASE WHEN a.status = 'absent' THEN 1 END) as absents,
                   ROUND(COUNT(CASE WHEN a.status = 'present' THEN 1 END) * 100.0 / COUNT(*), 0) as attendance_rate
            FROM attendance a
            INNER JOIN classes c ON a.class_id = c.id
            WHERE c.teacher_id = ?
            GROUP BY a.date, c.name
            ORDER BY a.date DESC
            LIMIT 20
        ");
        $stmt->execute([$teacher_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }
}
