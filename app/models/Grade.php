<?php
use app\core\Database;


class Grade
{
    private int $id;
    private int $submissionId;
    private float $grade;
    private ?string $comment;
    private string $gradedAt;

    public function __construct(
        int $id,
        int $submissionId,
        float $grade,
        ?string $comment,
        string $gradedAt
    ) {
        $this->id           = $id;
        $this->submissionId = $submissionId;
        $this->grade        = $grade;
        $this->comment      = $comment;
        $this->gradedAt     = $gradedAt;
    }

   
    public function getId(): int
    {
        return $this->id;
    }

    public function getSubmissionId(): int
    {
        return $this->submissionId;
    }

    public function getGrade(): float
    {
        return $this->grade;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function getGradedAt(): string
    {
        return $this->gradedAt;
    }

    
    public function assignGrade(
        float $grade,
        ?string $comment,
        GradeService $gradeService
    ): bool {
        $this->grade   = $grade;
        $this->comment = $comment;

        return $gradeService->assign(
            $this->submissionId,
            $grade,
            $comment
        );
    }
}
