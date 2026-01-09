<?php
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../models/User.php';

/**
 * Dashboard Controller
 */
class DashboardController {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    /**
     * Show dashboard based on user role
     */
    public function index() {
        requireAuth();

        $role = getCurrentUserRole();
        
        if ($role === 'Agent') {
            $this->agentDashboard();
        } elseif ($role === 'Supervisor') {
            $this->supervisorDashboard();
        } else {
            // Invalid role, logout
            header('Location: /index.php?action=logout');
            exit();
        }
    }

    /**
     * Show Agent dashboard
     */
    private function agentDashboard() {
        requireRole('Agent');
        require_once __DIR__ . '/../views/dashboard_agent.php';
    }

    /**
     * Show Supervisor dashboard
     */
    private function supervisorDashboard() {
        requireRole('Supervisor');
        require_once __DIR__ . '/../views/dashboard_supervisor.php';
    }
}
