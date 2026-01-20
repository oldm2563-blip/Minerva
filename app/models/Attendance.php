<?php

class Attendance
{
    private int $id;
    private int $classId;
    private int $studentId;
    private string $date;
    private string $status; 
    public function __construct(
        int $id,
        int $classId,
        int $studentId,
        string $date,
        string $status
    ) {
        $this->id        = $id;
        $this->classId   = $classId;
        $this->studentId = $studentId;
        $this->date      = $date;
        $this->status    = $status;
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

   
    public function markPresent(
        AttendanceService $attendanceService
    ): bool {
        $this->status = 'present';
        return $attendanceService->updateStatus(
            $this->id,
            'present'
        );
    }

    
    public function markAbsent(
        AttendanceService $attendanceService
    ): bool {
        $this->status = 'absent';
        return $attendanceService->updateStatus(
            $this->id,
            'absent'
        );
    }
}
