<?php
    namespace app\services;
    use app\models\SchoolClass;

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
    }