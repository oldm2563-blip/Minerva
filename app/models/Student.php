<?php
namespace app\models;
use app\core\Database;
use app\models\User;

class Student extends User
{
    private int $classId;

    public function __construct(
        int $id,
        string $username,
        string $email,
        string $password,
        int $classId
    ) {
        parent::__construct($id, $username, $email, $password, 'student');
        $this->classId = $classId;
    }

  
    public function getClassId(): int
    {
        return $this->classId;
    }

   
    public function submitWork(
        int $workId,
        string $content,
        SubmissionService $submissionService
    ): bool {
        return $submissionService->submit(
            $workId,
            $this->id,
            $content
        );
    }

    
    public function viewGrades(
        GradeService $gradeService
    ): array {
        return $gradeService->getGradesByStudent($this->id);
    }

   
    public function message(
        string $message,
        ChatService $chatService
    ): bool {
        return $chatService->sendMessage(
            $this->id,
            $this->classId,
            $message
        );
    }

   
    public function viewClass(
        ClassService $classService
    ): array {
        return $classService->getClassDetails($this->classId);
    }
}
