<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisor Dashboard - Project Tracker</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <nav class="navbar">
            <div class="nav-brand">
                <h1>Project Tracker</h1>
            </div>
            <div class="nav-menu">
                <span class="user-info">
                    Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> 
                    (Oracle ID: <?php echo htmlspecialchars($_SESSION['oracle_id']); ?>)
                </span>
                <a href="/index.php?action=logout" class="btn btn-logout">Logout</a>
            </div>
        </nav>

        <div class="dashboard-content">
            <div class="dashboard-header">
                <h2>Supervisor Dashboard</h2>
                <div class="role-badge supervisor">Supervisor</div>
            </div>

            <div class="dashboard-info">
                <div class="info-card">
                    <h3>Profile Information</h3>
                    <div class="info-row">
                        <span class="info-label">Username:</span>
                        <span class="info-value"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email:</span>
                        <span class="info-value"><?php echo htmlspecialchars($_SESSION['email']); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Oracle ID:</span>
                        <span class="info-value"><?php echo htmlspecialchars($_SESSION['oracle_id']); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Role:</span>
                        <span class="info-value"><?php echo htmlspecialchars($_SESSION['role']); ?></span>
                    </div>
                </div>

                <div class="info-card">
                    <h3>Supervisor Features</h3>
                    <ul class="feature-list">
                        <li>Manage all projects</li>
                        <li>Assign tasks to agents</li>
                        <li>Review agent submissions</li>
                        <li>Generate reports and analytics</li>
                        <li>Approve or reject project changes</li>
                        <li>Monitor team performance</li>
                    </ul>
                </div>
            </div>

            <div class="dashboard-section">
                <h3>Team Overview</h3>
                <p class="placeholder-text">No team data available yet.</p>
            </div>

            <div class="dashboard-section">
                <h3>Project Statistics</h3>
                <p class="placeholder-text">No project statistics to display.</p>
            </div>
        </div>

        <footer class="dashboard-footer">
            <p>&copy; 2026 Project Tracker. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
