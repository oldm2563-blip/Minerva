<?php

class ChatMessage
{
    private int $id;
    private int $classId;
    private int $userId;
    private string $message;
    private string $createdAt;

    public function __construct(
        int $id,
        int $classId,
        int $userId,
        string $message,
        string $createdAt
    ) {
        $this->id        = $id;
        $this->classId   = $classId;
        $this->userId    = $userId;
        $this->message   = $message;
        $this->createdAt = $createdAt;
    }

   
    public function getId(): int
    {
        return $this->id;
    }

    public function getClassId(): int
    {
        return $this->classId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

   
    public function send(
        ChatService $chatService
    ): bool {
        return $chatService->sendMessage(
            $this->userId,
            $this->classId,
            $this->message
        );
    }

    
    public static function getHistory(
        int $classId,
        ChatService $chatService
    ): array {
        return $chatService->getMessagesByClass($classId);
    }
}
