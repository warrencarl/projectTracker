<?php
/**
 * Session Configuration
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    
    // Set secure session parameters
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_secure', 0); // Set to 1 if using HTTPS
}

/**
 * Check if user is logged in
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['oracle_id']);
}

/**
 * Get current user ID
 */
function getCurrentUserId() {
    return $_SESSION['user_id'] ?? null;
}

/**
 * Get current user role
 */
function getCurrentUserRole() {
    return $_SESSION['role'] ?? null;
}

/**
 * Get current user oracle ID
 */
function getCurrentUserOracleId() {
    return $_SESSION['oracle_id'] ?? null;
}

/**
 * Require authentication
 */
function requireAuth() {
    if (!isLoggedIn()) {
        header('Location: /index.php?action=login');
        exit();
    }
}

/**
 * Require specific role
 */
function requireRole($role) {
    requireAuth();
    if (getCurrentUserRole() !== $role) {
        header('Location: /index.php?action=dashboard');
        exit();
    }
}
