<?php
namespace app\core;

use PDO;
use PDOException;
    class Database{
        private static ?Database $instance = null;
        private $conn;
        private function __construct()
        {
            $config = require __DIR__ . '/../../config/database.php';
            try{
                $dsn = "mysql:host=" . $config['host'] . ";port=" . $config['port'] . ";dbname=" . $config['db_name'];
                $this->conn = new PDO($dsn, $config['username'], $config['password']);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e){
                echo "DB connection error :" . $e->getMessage();
            }
        }
        public static function getInstance(): PDO
        {
            if(self::$instance === null){
                self::$instance = new Database();
            }
             return self::$instance->conn;
        }
    }
?>