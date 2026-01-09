<?php
require_once __DIR__ . '/../config/database.php';

/**
 * User Model
 */
class User {
    private $conn;
    private $table = 'users';

    public $id;
    public $oracle_id;
    public $username;
    public $email;
    public $password;
    public $role;
    public $created_at;
    public $updated_at;

    /**
     * Constructor
     */
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    /**
     * Register a new user
     */
    public function register() {
        $query = "INSERT INTO " . $this->table . " 
                  (oracle_id, username, email, password, role) 
                  VALUES (:oracle_id, :username, :email, :password, :role)";

        $stmt = $this->conn->prepare($query);

        // Sanitize inputs
        $this->oracle_id = htmlspecialchars(strip_tags($this->oracle_id));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->role = htmlspecialchars(strip_tags($this->role));
        
        // Hash password
        $hashed_password = password_hash($this->password, PASSWORD_BCRYPT);

        // Bind parameters
        $stmt->bindParam(':oracle_id', $this->oracle_id);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':role', $this->role);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Login user
     */
    public function login($email, $password) {
        $query = "SELECT id, oracle_id, username, email, password, role 
                  FROM " . $this->table . " 
                  WHERE email = :email 
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $email = htmlspecialchars(strip_tags($email));
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            
            // Verify password
            if (password_verify($password, $row['password'])) {
                $this->id = $row['id'];
                $this->oracle_id = $row['oracle_id'];
                $this->username = $row['username'];
                $this->email = $row['email'];
                $this->role = $row['role'];
                return true;
            }
        }

        return false;
    }

    /**
     * Check if Oracle ID exists
     */
    public function oracleIdExists($oracle_id) {
        $query = "SELECT id FROM " . $this->table . " WHERE oracle_id = :oracle_id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $oracle_id = htmlspecialchars(strip_tags($oracle_id));
        $stmt->bindParam(':oracle_id', $oracle_id);
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }

    /**
     * Check if email exists
     */
    public function emailExists($email) {
        $query = "SELECT id FROM " . $this->table . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $email = htmlspecialchars(strip_tags($email));
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }

    /**
     * Get user by ID
     */
    public function getUserById($id) {
        $query = "SELECT id, oracle_id, username, email, role, created_at 
                  FROM " . $this->table . " 
                  WHERE id = :id 
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch();
        }

        return null;
    }
}
