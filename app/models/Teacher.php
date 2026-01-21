<?php
namespace app\models;
use app\core\Database;
use app\models\User;

class Teacher extends User
{
    public function __construct(
        int $id,
        string $username,
        string $email,
        string $password
    ) {
        parent::__construct($id, $username, $email, $password, 'teacher');
    }

  
    public function createClass(
        string $className,
        ClassService $classService
    ): bool {
        return $classService->create(
            $className,
            $this->id
        );
    }

    
    public function createWork(
        int $classId,
        string $title,
        string $description,
        ?string $filePath,
        string $dueDate,
        WorkService $workService
    ): bool {
        return $workService->create(
            $classId,
            $this->id,
            $title,
            $description,
            $filePath,
            $dueDate
        );
    }

   
    public function assignWork(
        int $workId,
        int $studentId,
        WorkAssignmentService $assignmentService
    ): bool {
        return $assignmentService->assign(
            $workId,
            $studentId
        );
    }

   
    public function gradeSubmission(
        int $submissionId,
        float $score,
        string $comment,
        GradeService $gradeService
    ): bool {
        return $gradeService->grade(
            $submissionId,
            $score,
            $comment
        );
    }

   
    public function takeAttendance(
        int $classId,
        array $attendanceData,
        AttendanceService $attendanceService
    ): bool {
        return $attendanceService->record(
            $classId,
            $attendanceData
        );
    }

    
    public function viewStatistics(
        int $classId,
        StatisticsService $statisticsService
    ): array {
        return $statisticsService->getStatistics($classId);
    }
}
