<?php

class Work
{
    private int $id;
    private int $classId;
    private int $teacherId;
    private string $title;
    private string $description;
    private ?string $filePath;
    private string $dueDate;
    private string $createdAt;

    public function __construct(
        int $id,
        int $classId,
        int $teacherId,
        string $title,
        string $description,
        ?string $filePath,
        string $dueDate,
        string $createdAt
    ) {
        $this->id          = $id;
        $this->classId     = $classId;
        $this->teacherId  = $teacherId;
        $this->title       = $title;
        $this->description = $description;
        $this->filePath    = $filePath;
        $this->dueDate     = $dueDate;
        $this->createdAt   = $createdAt;
    }

  
    public function getId(): int
    {
        return $this->id;
    }

    public function getClassId(): int
    {
        return $this->classId;
    }

    public function getTeacherId(): int
    {
        return $this->teacherId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    public function getDueDate(): string
    {
        return $this->dueDate;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

  
    public function assignToStudent(
        int $studentId,
        WorkAssignmentService $assignmentService
    ): bool {
        return $assignmentService->assign(
            $this->id,
            $studentId
        );
    }
}
