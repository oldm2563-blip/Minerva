<?php
    namespace app\services;
    use app\models\SchoolClass;
    use app\models\Attendance;
    class ClassService{
        public function showclasses(){
            $id = $_SESSION['id'];
            $get = new SchoolClass("" , "");
            $found = $get->showclasses($id);
            return $found;
        }
        public function addclass(){
            $name = $_POST['name'];
            $id = $_SESSION['id'];
            $add = new SchoolClass($name, $id);
            $add->createclass();
        }
        public function attendance(){
            $student_id = $_GET['s_id'];
            $class_id = $_GET['c_id'];
            $status = $_POST['stat'];
            $set = new Attendance("",$class_id,$student_id,"");
            if($status === 'present'){
                $set->present();
            }
            else{
                $set->absent();
            }
        }
    }