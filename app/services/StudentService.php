<?php
    namespace app\services;
    use app\models\Student;
    use app\models\Work;
    use app\models\Grade;
    use app\models\ClassStudent;
    use app\models\WorkAssignment;
    use app\models\Submission;
    use app\models\EvaluationData;
    use app\services\MailerService;
    use PDO;
    use Exception;

    class StudentService{
        
        public function __construct() {
            // No longer needs Database instance
        }
        
        public function addStudent(){
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $class_id = $_POST['class_id'] ?? '';
            $generate_password = isset($_POST['generate_password']);
            
            $errors = [];
            
            if(empty($name)){
                $errors[] = "Le nom est requis";
            }
            
            if(empty($email)){
                $errors[] = "L'email est requis";
            } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors[] = "L'email n'est pas valide";
            }
            
            if(empty($class_id)){
                $errors[] = "La classe est requise";
            }
            
            $user = new \app\models\User("", $email, "", "");
            $existing = $user->getinfo();
            if(!empty($existing)){
                $errors[] = "Cet email est déjà utilisé";
            }
            
            if(!empty($errors)){
                $_SESSION['error'] = $errors;
                header('Location: /teacher/addstudent');
                exit;
            }
            
            if($generate_password){
                $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
            } else {
                $password = $_POST['password'] ?? '';
                if(empty($password)){
                    $errors[] = "Le mot de passe est requis";
                    $_SESSION['error'] = $errors;
                    header('Location: /teacher/addstudent');
                    exit;
                }
            }
            
            $student = new \app\models\User($name, $email, $password, 'student');
            $result = $student->create();
            
            if($result){
                // Assign to class - get student ID from database
                $classStudent = new \app\models\ClassStudent();
                $db = \app\core\Database::getInstance();
                $student_id = $db->lastInsertId();
                $classStudent->assignToClass($student_id, $class_id);
                
                // Send email with credentials
                $subject = "Bienvenue sur Minerva";
                $body = "
                    Bonjour $name,<br><br>
                    Votre compte étudiant a été créé.<br>
                    Vous pouvez vous connecter avec les identifiants suivants : <br>
                    <br>
                    Email: $email<br>
                    Mot de passe: $password<br>
                    <br>
                    Veuillez changer votre mot de passe lors de votre première connexion.
                ";
                
                if(class_exists('app\services\MailerService')){
                    $mail = new \app\services\MailerService();
                    $mail->send($email, $subject, $body);
                }
                
                $_SESSION['success'] = "Étudiant créé avec succès. Mot de passe: $password";
            } else {
                $_SESSION['error'] = ["Une erreur est survenue lors de la création de l'étudiant"];
            }
            
            header('Location: /teacher/addstudent');
            exit;
        }
        
        public function showStudents(){
            $show = new Student("" , "" , "");
            return $show->allstudents();
        }
        
        public function assign(){
            $class_id = $_POST['class_id'] ?? '';
            $student_ids = $_POST['students'] ?? [];
            
            if(empty($class_id) || empty($student_ids)){
                $_SESSION['error'] = ["Veuillez sélectionner une classe et au moins un étudiant"];
                header('Location: /teacher/assign');
                exit;
            }
            
            $assign = new ClassStudent();
            $success_count = 0;
            
            foreach($student_ids as $student_id){
                $result = $assign->assignToClass($student_id, $class_id);
                if($result){
                    $success_count++;
                }
            }
            
            if($success_count > 0){
                $_SESSION['success'] = "$success_count étudiant(s) assigné(s) avec succès";
            } else {
                $_SESSION['error'] = ["Aucun étudiant n'a pu être assigné"];
            }
            
            header('Location: /teacher/assign');
            exit;
        }
        
        public function create_work(){
            $title = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $teacher_id = $_SESSION['id'] ?? 0;
            $class_id = $_POST['class_id'] ?? ($_GET['id'] ?? 0);
            $file_path = $_POST['filepath'] ?? null;
            $due_date = $_POST['duedate'] ?? '';
            
            // Validate required fields
            if (empty($title) || empty($description) || empty($class_id)) {
                error_log("Validation failed - missing required fields");
                $_SESSION['error'] = ["Le titre, la description et la classe sont requis"];
                header('Location: /teacher/works');
                exit;
            }
            
            error_log("Validation passed, creating Work object");
            $add = new Work(null, $class_id, $teacher_id, $title, $description, $file_path, $due_date, '');
            $result = $add->create();
            
            error_log("Create result: " . ($result ? 'success' : 'failed'));
            
            if ($result) {
                $_SESSION['success'] = "Travail créé avec succès";
            } else {
                $_SESSION['error'] = ["Une erreur est survenue lors de la création du travail"];
            }
            
            header('Location: /teacher/works');
            exit;
        }

        public function getWorks() {
            $teacher_id = $_SESSION['id'] ?? 0;
            if (!$teacher_id) {
                return [];
            }
            
            $work = new Work(null, 0, 0, '', '', '', '', '');
            return $work->getWorksByTeacher($teacher_id);
        }

        public function getPendingEvaluations() {
            $teacher_id = $_SESSION['id'] ?? 0;
            if (!$teacher_id) {
                return [];
            }

            try {
                $evaluationData = new EvaluationData();
                return $evaluationData->getPendingEvaluations($teacher_id);
                
            } catch (Exception $e) {
                error_log("Pending evaluations error: " . $e->getMessage());
                return [];
            }
        }

        public function getCompletedEvaluations() {
            $teacher_id = $_SESSION['id'] ?? 0;
            if (!$teacher_id) {
                return [];
            }

            try {
                $evaluationData = new EvaluationData();
                return $evaluationData->getCompletedEvaluations($teacher_id);
                
            } catch (Exception $e) {
                error_log("Completed evaluations error: " . $e->getMessage());
                return [];
            }
        }

        public function submit(){
            $work_id = $_POST['work_id'];
            $student_id = $_SESSION['id'];
            $content = $_POST['description'] ?? '';
            $file_path = $_FILES['file']['name'] ?? '';
            $submitted_at = date('Y-m-d H:i:s');
            
            // Handle file upload
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $upload_dir = 'uploads/submissions/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                
                $file_name = time() . '_' . $_FILES['file']['name'];
                $file_path = $upload_dir . $file_name;
                
                if (move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
                    $file_path = $file_name; // Store just the filename
                }
            }
            
            $add = new Submission($work_id, $student_id, $content, $file_path, $submitted_at);
            $result = $add->submit();
            
            if ($result) {
                $_SESSION['success'] = "Travail soumis avec succès";
            } else {
                $_SESSION['error'] = ["Erreur lors de la soumission du travail"];
            }
        }

        public function grade(){
            $sub_id = $_POST['submission_id'];
            $gradeValue = $_POST['grade'];
            $comment = $_POST['comment'];
            $appreciation = $_POST['appreciation'] ?? '';
            
            $gradeObj = new Grade("", $sub_id, $gradeValue, $comment, $appreciation);
            $result = $gradeObj->grade();
            
            if ($result) {
                $_SESSION['success'] = "Évaluation enregistrée avec succès";
            } else {
                $_SESSION['error'] = ["Erreur lors de l'enregistrement de l'évaluation"];
            }
            
            header('Location: /teacher/evaluation');
            exit;
        }
    }
?>
