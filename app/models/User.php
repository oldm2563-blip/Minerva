<?php

class User
{
    protected int $id;
    protected string $username;
    protected string $email;
    protected string $password;
    protected string $role;

    public function __construct(
        int $id,
        string $username,
        string $email,
        string $password,
        string $role
    ) {
        $this->id       = $id;
        $this->username = $username;
        $this->email    = $email;
        $this->password = $password;
        $this->role     = $role;
    }

   
    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getRole(): string
    {
        return $this->role;
    }

 
    public function login(): void
    {
        $_SESSION['user_id'] = $this->id;
        $_SESSION['role']    = $this->role;
        $_SESSION['name']    = $this->username;
    }

    public function logout(): void
    {
        session_destroy();
    }
}
