<?php
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../models/User.php';

/**
 * Authentication Controller
 */
class AuthController {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    /**
     * Handle login
     */
    public function login() {
        // Redirect to dashboard if already logged in
        if (isLoggedIn()) {
            header('Location: /index.php?action=dashboard');
            exit();
        }
        
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Validate inputs
            if (empty($email) || empty($password)) {
                $error = 'Please fill in all fields';
            } else {
                // Attempt login
                if ($this->user->login($email, $password)) {
                    // Set session variables
                    $_SESSION['user_id'] = $this->user->id;
                    $_SESSION['oracle_id'] = $this->user->oracle_id;
                    $_SESSION['username'] = $this->user->username;
                    $_SESSION['email'] = $this->user->email;
                    $_SESSION['role'] = $this->user->role;

                    // Redirect to dashboard
                    header('Location: /index.php?action=dashboard');
                    exit();
                } else {
                    $error = 'Invalid email or password';
                }
            }
        }

        // Show login page with error
        require_once __DIR__ . '/../views/login.php';
    }

    /**
     * Handle registration
     */
    public function register() {
        // Redirect to dashboard if already logged in
        if (isLoggedIn()) {
            header('Location: /index.php?action=dashboard');
            exit();
        }
        
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $oracle_id = $_POST['oracle_id'] ?? '';
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';
            $role = $_POST['role'] ?? '';

            // Validate inputs
            if (empty($oracle_id) || empty($username) || empty($email) || empty($password) || empty($confirm_password) || empty($role)) {
                $error = 'Please fill in all fields';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Invalid email format';
            } elseif ($password !== $confirm_password) {
                $error = 'Passwords do not match';
            } elseif (strlen($password) < 6) {
                $error = 'Password must be at least 6 characters';
            } elseif (!in_array($role, ['Agent', 'Supervisor'])) {
                $error = 'Invalid role selected';
            } elseif ($this->user->oracleIdExists($oracle_id)) {
                $error = 'Oracle ID already exists';
            } elseif ($this->user->emailExists($email)) {
                $error = 'Email already exists';
            } else {
                // Set user properties
                $this->user->oracle_id = $oracle_id;
                $this->user->username = $username;
                $this->user->email = $email;
                $this->user->password = $password;
                $this->user->role = $role;

                // Register user
                if ($this->user->register()) {
                    $success = 'Registration successful! Please login.';
                    // Redirect to login after 2 seconds
                    header('Refresh: 2; URL=/index.php?action=login');
                } else {
                    $error = 'Registration failed. Please try again.';
                }
            }
        }

        // Show registration page with error/success
        require_once __DIR__ . '/../views/register.php';
    }

    /**
     * Handle logout
     */
    public function logout() {
        // Clear session variables
        $_SESSION = array();
        
        // Destroy session
        session_destroy();
        
        // Redirect to login
        header('Location: /index.php?action=login');
        exit();
    }
}
