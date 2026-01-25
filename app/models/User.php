<?php
namespace app\models;
use app\core\Database;
use PDO;
class User
{
    protected $id;
    protected $username;
    protected $email;
    protected $password;
    protected $role;
    private PDO $db;

    public function __construct(
         $username,
         $email,
         $password,
         $role
    ) {
        $this->username = $username;
        $this->email    = $email;
        $this->password = $password ? password_hash($password, PASSWORD_DEFAULT) : null;
        $this->role     = $role;
        $this->db = Database::getInstance();
    }

   
    public function getId() 
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getRole()
    {
        return $this->role;
    }

 
    public function login()
    {
        $_SESSION['user_id'] = $this->id;
        $_SESSION['role']    = $this->role;
        $_SESSION['name']    = $this->username;
    }

    public function getinfo(){
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$this->email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(){
        $query = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            $this->username,
            $this->email,
            $this->password,
            $this->role
        ]);
    }

    public function logout(): void
    {
        session_destroy();
    }
}
