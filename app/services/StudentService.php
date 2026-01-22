<?php
    namespace app\services;
    use app\models\Student;
    use app\models\Work;
    use app\models\Grade;
    use app\models\ClassStudent;
    use app\models\WorkAssignment;
    use app\models\Submission;
    class StudentService{
        
    public function addstudent(){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $add = new Student($name, $email, "");
        $add->addstudent();
    }
    public function showstudents(){
        $show = new Student("" , "" , "");
        return $show->allstudents();
    }
    public function assign(){
        $class = $_POST['class'];
        $student = $_POST['student'];
        $assign = new ClassStudent();
        $assign->assignToClass($student, $class);
    }
    public function create_work(){
        $title = $_POST['name'];
        $descriptin = $_POST['description'];
        $teacher_id = $_SESSION['id'];
        $class_id = $_GET['id'];
        $file_path = $_POST['filepath'];
        $due_date = $_POST['duedate'];
        $add = new Work("" , $class_id, $teacher_id, $title, $descriptin, $file_path, $due_date, "");
        $add->create();
    }
    public function assign_work(){
        $student_id = $_GET['id'];
        $work_id = $_GET['work_id'];
        $assign = new WorkAssignment();
        $assign->assignToStudent($work_id, $student_id);
    }
    public function submit(){
        $work_id = $_GET['work_id'];
        $student_id = $_SESSION['id'];
        $content = $_POST['content'];
        $file_path = $_FILES['file'];
        $submitted_at = $_POST['sub_date'];
        $add = new Submission($work_id, $student_id, $content, $file_path, $submitted_at);
        $add->submit();
    }
    public function grade(){
        $sub_id = $_GET['sub_id'];
        $grade = $_POST['id'];
        $comment = $_POST['comment'];
        $grade = new Grade("", $sub_id, $grade, $comment, "");
        $grade->grade();
    }
    }