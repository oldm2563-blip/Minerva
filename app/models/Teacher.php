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
    
}
