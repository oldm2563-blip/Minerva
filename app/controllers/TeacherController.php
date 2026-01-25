<?php
namespace app\controllers;

use app\core\Controller;
use app\services\ClassService;
use app\services\StudentService;
use app\core\Database;
use PDO;
use Exception;


    class TeacherController extends Controller{
        public function __construct() {
            $this->IsSignedIn();
            if(isset($_SESSION['role']) && $_SESSION['role'] !== 'teacher') {
                $this->redirect('/');
            }
        }
        
        public function add_student_form(){
            $get = new ClassService();
            $found = $get->showclasses();
            $data = ['classes' => $found];
            
            if (isset($_SESSION['error'])) {
                $data['error'] = $_SESSION['error'];
                unset($_SESSION['error']);
            }
            if (isset($_SESSION['success'])) {
                $data['success'] = $_SESSION['success'];
                unset($_SESSION['success']);
            }
            
            $this->render('teacher/add_student', $data);
        }
        public function add_student(){
            $add = new StudentService();
            $add->addstudent();
            $this->redirect('teacher');
        }
        public function teacherboard(){
            $get = new ClassService();
            $found = $get->showclasses();
            $stats = $get->getDashboardStats();
            $activities = $get->getRecentActivities();
            
            $this->render('teacher/dashboard', [
                'classes' => $found, 
                'stats' => $stats,
                'activities' => $activities
            ]);
        }

        public function add_class_form(){
            $this->render('teacher/add_class');
        }

        public function add_class(){
            $add = new ClassService();
            $add->addclass();
            $_SESSION['success'] = "Classe créée avec succès";
            $this->redirect('/teacher/classes');
        }
        public function assign_class_form(){
            $got = new StudentService();
            $find = $got->showstudents();
            $get = new ClassService();
            $found = $get->showclasses();
            $data = ['classes' => $found, 'students' => $find];
            
            if (isset($_SESSION['error'])) {
                $data['error'] = $_SESSION['error'];
                unset($_SESSION['error']);
            }
            if (isset($_SESSION['success'])) {
                $data['success'] = $_SESSION['success'];
                unset($_SESSION['success']);
            }
            
            $this->render('teacher/assign', $data);
        }
        public function assign_class(){
            $assign = new StudentService();
            $assign->assign();
            $this->redirect('teacher');
        }
        public function add_work(){
            $add = new StudentService();
            $add->create_work();
            $this->redirect('teacher');
        }
        public function assign_work_form(){
            $classService = new ClassService();
            $classes = $classService->showclasses();
            
            $studentService = new StudentService();
            $works = $studentService->getWorks();
            
            $students = [];
            $db = Database::getInstance();
            $teacher_id = $_SESSION['id'] ?? 0;
            
            if ($teacher_id) {
                $stmt = $db->prepare("
                    SELECT u.id, u.name, u.email, c.name as class_name
                    FROM users u
                    INNER JOIN class_students cs ON u.id = cs.student_id
                    INNER JOIN classes c ON cs.class_id = c.id
                    WHERE c.teacher_id = ? AND u.role = 'student'
                    ORDER BY c.name, u.name
                ");
                $stmt->execute([$teacher_id]);
                $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            
            $data = [
                'works' => $works,
                'students' => $students,
                'classes' => $classes
            ];
            
            // Pass session messages to view
            if (isset($_SESSION['error'])) {
                $data['error'] = $_SESSION['error'];
                unset($_SESSION['error']);
            }
            if (isset($_SESSION['success'])) {
                $data['success'] = $_SESSION['success'];
                unset($_SESSION['success']);
            }
            
            $this->render('teacher/assign_work', $data);
        }
        
        public function assign_work(){
            $work_id = $_POST['work_id'] ?? '';
            $student_ids = $_POST['students'] ?? [];
            
            if (empty($work_id) || empty($student_ids)) {
                $_SESSION['error'] = ["Veuillez sélectionner un travail et au moins un étudiant"];
                header('Location: /teacher/assignwork');
                exit;
            }
            
            try {
                $db = Database::getInstance();
                
                $teacher_id = $_SESSION['id'] ?? 0;
                $stmt = $db->prepare("
                    SELECT w.id, w.title, c.name as class_name
                    FROM works w
                    INNER JOIN classes c ON w.class_id = c.id
                    WHERE w.id = ? AND c.teacher_id = ?
                ");
                $stmt->execute([$work_id, $teacher_id]);
                $work = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if (!$work) {
                    $_SESSION['error'] = ["Travail non trouvé ou accès non autorisé"];
                    header('Location: /teacher/assignwork');
                    exit;
                }
                
                $stmt = $db->prepare("INSERT IGNORE INTO work_assignments (work_id, student_id) VALUES (?, ?)");
                $success_count = 0;
                
                foreach ($student_ids as $student_id) {
                    $result = $stmt->execute([$work_id, $student_id]);
                    if ($result && $stmt->rowCount() > 0) {
                        $success_count++;
                    }
                }
                
                if ($success_count > 0) {
                    $_SESSION['success'] = "Travail assigné à $success_count étudiant(s) avec succès";
                } else {
                    $_SESSION['error'] = ["Aucune nouvelle assignation créée (les étudiants ont peut-être déjà ce travail)"];
                }
                
            } catch (Exception $e) {
                error_log("Work assignment error: " . $e->getMessage());
                $_SESSION['error'] = ["Une erreur est survenue lors de l'assignation du travail"];
            }
            
            header('Location: /teacher/assignwork');
            exit;
        }
        public function grade(){
            $grade = new StudentService();
            $grade->grade();
            $this->redirect('teacher');
        }
        public function setattendance(){
            $class_id = $_POST['class_id'] ?? '';
            $date = $_POST['date'] ?? '';
            $attendance_data = $_POST['attendance'] ?? [];
            
            if (empty($class_id) || empty($date) || empty($attendance_data)) {
                $_SESSION['error'] = ["Données incomplètes pour la prise de présence"];
                header('Location: /teacher/attendance');
                exit;
            }
            
            try {
                $db = Database::getInstance();
                
                // First, delete existing attendance for this class and date
                $stmt = $db->prepare("DELETE FROM attendance WHERE class_id = ? AND date = ?");
                $stmt->execute([$class_id, $date]);
                
                // Insert new attendance records
                $stmt = $db->prepare("INSERT INTO attendance (class_id, student_id, date, status) VALUES (?, ?, ?, ?)");
                
                foreach ($attendance_data as $student_id => $status) {
                    $attendance_status = ($status === 'present') ? 'present' : 'absent';
                    $stmt->execute([$class_id, $student_id, $date, $attendance_status]);
                }
                
                // Also mark absent students who weren't in the form
                $stmt = $db->prepare("
                    INSERT INTO attendance (class_id, student_id, date, status)
                    SELECT ?, cs.student_id, ?, 'absent'
                    FROM class_students cs
                    WHERE cs.class_id = ? 
                    AND cs.student_id NOT IN (" . implode(',', array_keys($attendance_data)) . ")
                ");
                $stmt->execute([$class_id, $date, $class_id]);
                
                $_SESSION['success'] = "Présence enregistrée avec succès";
                
            } catch (Exception $e) {
                error_log("Attendance save error: " . $e->getMessage());
                $_SESSION['error'] = ["Une erreur est survenue lors de l'enregistrement de la présence"];
            }
            
            header('Location: /teacher/attendance?class_id=' . $class_id . '&date=' . $date);
            exit;
        }
        public function classes(){
            $get = new ClassService();
            $found = $get->showclasses();
            $data = ['classes' => $found];
            
            if (isset($_SESSION['error'])) {
                $data['error'] = $_SESSION['error'];
                unset($_SESSION['error']);
            }
            if (isset($_SESSION['success'])) {
                $data['success'] = $_SESSION['success'];
                unset($_SESSION['success']);
            }
            
            $this->render('teacher/classes', $data);
        }
        public function works(){
            $get = new ClassService();
            $found = $get->showclasses();
            
            $studentService = new StudentService();
            $works = $studentService->getWorks();
            
            $data = ['classes' => $found, 'works' => $works];
            
            if (isset($_SESSION['error'])) {
                $data['error'] = $_SESSION['error'];
                unset($_SESSION['error']);
            }
            if (isset($_SESSION['success'])) {
                $data['success'] = $_SESSION['success'];
                unset($_SESSION['success']);
            }
            
            $this->render('teacher/works', $data);
        }
        public function evaluation(){
            $studentService = new StudentService();
            $pendingEvaluations = $studentService->getPendingEvaluations();
            $completedEvaluations = $studentService->getCompletedEvaluations();
            
            $this->render('teacher/evaluation', [
                'pendingEvaluations' => $pendingEvaluations,
                'completedEvaluations' => $completedEvaluations
            ]);
        }
        public function attendance(){
            $classService = new ClassService();
            $attendanceData = $classService->getAttendanceData();
            
            $this->render('teacher/attendance', $attendanceData);
        }
        public function statistics(){
            $classService = new ClassService();
            $statistics = $classService->getStatistics();
            
            $this->render('teacher/statistics', $statistics);
        }
        public function chat(){
            $this->render('teacher/chat');
        }
        public function logout(){
            session_destroy();
            $this->redirect('/');
        }
    }