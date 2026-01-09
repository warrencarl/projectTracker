<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Dashboard - Project Tracker</title>
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
                <h2>Agent Dashboard</h2>
                <div class="role-badge agent">Agent</div>
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
                    <h3>Agent Features</h3>
                    <ul class="feature-list">
                        <li>View assigned projects</li>
                        <li>Update project status</li>
                        <li>Submit progress reports</li>
                        <li>Access project documentation</li>
                        <li>Communicate with supervisors</li>
                    </ul>
                </div>
            </div>

            <div class="dashboard-section">
                <h3>Recent Activities</h3>
                <p class="placeholder-text">No recent activities to display.</p>
            </div>
        </div>

        <footer class="dashboard-footer">
            <p>&copy; 2026 Project Tracker. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
