<?php
/**
 * Main Entry Point - Router
 */

// Include session configuration
require_once __DIR__ . '/config/session.php';

// Include controllers
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/DashboardController.php';

// Get action from URL parameter
$action = $_GET['action'] ?? 'login';

// Route to appropriate controller and method
switch ($action) {
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;

    case 'register':
        $controller = new AuthController();
        $controller->register();
        break;

    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;

    case 'dashboard':
        $controller = new DashboardController();
        $controller->index();
        break;

    default:
        // Redirect to login for unknown actions
        header('Location: /index.php?action=login');
        exit();
}
