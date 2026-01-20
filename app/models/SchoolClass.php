<?php

class SchoolClass
{
    private int $id;
    private string $name;
    private int $teacherId;

    public function __construct(
        int $id,
        string $name,
        int $teacherId
    ) {
        $this->id        = $id;
        $this->name      = $name;
        $this->teacherId = $teacherId;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTeacherId(): int
    {
        return $this->teacherId;
    }


    public function addStudents(
        array $studentIds,
        ClassService $classService
    ): bool {
        return $classService->addStudents(
            $this->id,
            $studentIds
        );
    }

    public function removeStudent(
        int $studentId,
        ClassService $classService
    ): bool {
        return $classService->removeStudent(
            $this->id,
            $studentId
        );
    }

    
    public function viewStudents(
        ClassService $classService
    ): array {
        return $classService->getStudentsByClass(
            $this->id
        );
    }
}
