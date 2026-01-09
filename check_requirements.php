<?php
/**
 * System Requirements Checker
 * This script checks if your environment meets the requirements for Project Tracker
 */

// Error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check results
$checks = [];
$allPassed = true;

// 1. Check PHP Version
$phpVersion = phpversion();
$minPhpVersion = '7.4.0';
$phpCheck = version_compare($phpVersion, $minPhpVersion, '>=');
$checks['PHP Version'] = [
    'status' => $phpCheck,
    'message' => "PHP $phpVersion " . ($phpCheck ? '✓' : "✗ (Required: $minPhpVersion or higher)")
];
if (!$phpCheck) $allPassed = false;

// 2. Check PDO Extension
$pdoCheck = extension_loaded('pdo') && extension_loaded('pdo_mysql');
$checks['PDO MySQL Extension'] = [
    'status' => $pdoCheck,
    'message' => $pdoCheck ? '✓ Available' : '✗ Not available'
];
if (!$pdoCheck) $allPassed = false;

// 3. Check Session Support
$sessionCheck = function_exists('session_start');
$checks['Session Support'] = [
    'status' => $sessionCheck,
    'message' => $sessionCheck ? '✓ Available' : '✗ Not available'
];
if (!$sessionCheck) $allPassed = false;

// 4. Check Database Connection
$dbCheck = false;
$dbMessage = '';
try {
    require_once __DIR__ . '/config/database.php';
    $database = new Database();
    $conn = $database->getConnection();
    if ($conn) {
        $dbCheck = true;
        $dbMessage = '✓ Connected successfully';
        
        // Check if users table exists
        $stmt = $conn->query("SHOW TABLES LIKE 'users'");
        if ($stmt->rowCount() > 0) {
            $dbMessage .= ' (users table exists)';
        } else {
            $dbMessage .= ' ⚠ WARNING: users table not found. Run database_schema.sql';
        }
    }
} catch (Exception $e) {
    $dbMessage = '✗ Connection failed: ' . $e->getMessage();
}
$checks['Database Connection'] = [
    'status' => $dbCheck,
    'message' => $dbMessage
];
if (!$dbCheck) $allPassed = false;

// 5. Check File Permissions
$writable = is_writable(__DIR__);
$checks['Directory Permissions'] = [
    'status' => $writable,
    'message' => $writable ? '✓ Writable' : '⚠ Not writable (may cause issues)'
];

// 6. Check Required Files
$requiredFiles = [
    'index.php',
    'config/database.php',
    'config/session.php',
    'models/User.php',
    'controllers/AuthController.php',
    'controllers/DashboardController.php',
    'views/login.php',
    'views/register.php',
    '.htaccess'
];

$filesCheck = true;
$missingFiles = [];
foreach ($requiredFiles as $file) {
    if (!file_exists(__DIR__ . '/' . $file)) {
        $filesCheck = false;
        $missingFiles[] = $file;
    }
}
$checks['Required Files'] = [
    'status' => $filesCheck,
    'message' => $filesCheck ? '✓ All files present' : '✗ Missing: ' . implode(', ', $missingFiles)
];
if (!$filesCheck) $allPassed = false;

// 7. Check mod_rewrite (if Apache)
$modRewriteCheck = function_exists('apache_get_modules') ? in_array('mod_rewrite', apache_get_modules()) : null;
$checks['Apache mod_rewrite'] = [
    'status' => $modRewriteCheck !== false,
    'message' => $modRewriteCheck === true ? '✓ Enabled' : ($modRewriteCheck === false ? '✗ Not enabled' : '? Cannot detect (may be enabled)')
];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Requirements Check - Project Tracker</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 40px;
        }
        h1 {
            color: #667eea;
            margin-bottom: 10px;
        }
        .subtitle {
            color: #666;
            margin-bottom: 30px;
        }
        .status-summary {
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 30px;
            font-weight: bold;
            font-size: 18px;
        }
        .status-summary.pass {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .status-summary.fail {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .check-item {
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            background: #f8f9fa;
            border-left: 4px solid #ddd;
        }
        .check-item.pass {
            border-left-color: #28a745;
        }
        .check-item.fail {
            border-left-color: #dc3545;
        }
        .check-item.warning {
            border-left-color: #ffc107;
        }
        .check-name {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }
        .check-message {
            color: #666;
            font-size: 14px;
        }
        .actions {
            margin-top: 30px;
            padding-top: 30px;
            border-top: 2px solid #eee;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            margin-right: 10px;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .instructions {
            background: #e7f3ff;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
            border-left: 4px solid #2196F3;
        }
        .instructions h3 {
            color: #1976D2;
            margin-bottom: 10px;
        }
        .instructions ul {
            margin-left: 20px;
            color: #333;
        }
        .instructions li {
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Project Tracker - System Check</h1>
        <p class="subtitle">Verifying your environment meets all requirements</p>
        
        <div class="status-summary <?php echo $allPassed ? 'pass' : 'fail'; ?>">
            <?php if ($allPassed): ?>
                ✓ All checks passed! Your system is ready to run Project Tracker.
            <?php else: ?>
                ✗ Some checks failed. Please fix the issues below before proceeding.
            <?php endif; ?>
        </div>

        <?php foreach ($checks as $name => $check): ?>
            <div class="check-item <?php echo $check['status'] ? 'pass' : ($check['status'] === false ? 'fail' : 'warning'); ?>">
                <div class="check-name"><?php echo htmlspecialchars($name); ?></div>
                <div class="check-message"><?php echo $check['message']; ?></div>
            </div>
        <?php endforeach; ?>

        <div class="actions">
            <?php if ($allPassed): ?>
                <a href="index.php?action=login" class="btn">Go to Login Page</a>
                <a href="index.php?action=register" class="btn">Register New User</a>
            <?php else: ?>
                <a href="check_requirements.php" class="btn">Refresh Check</a>
            <?php endif; ?>
        </div>

        <?php if (!$allPassed): ?>
        <div class="instructions">
            <h3>How to Fix Issues:</h3>
            <ul>
                <?php if (!$phpCheck): ?>
                    <li><strong>PHP Version:</strong> Upgrade PHP to version <?php echo $minPhpVersion; ?> or higher</li>
                <?php endif; ?>
                
                <?php if (!$pdoCheck): ?>
                    <li><strong>PDO Extension:</strong> Install PHP PDO and PDO MySQL extensions</li>
                <?php endif; ?>
                
                <?php if (!$dbCheck): ?>
                    <li><strong>Database:</strong> 
                        <ul>
                            <li>Verify MySQL is running</li>
                            <li>Check database credentials in <code>config/database.php</code></li>
                            <li>Create the database: <code>CREATE DATABASE project_tracker;</code></li>
                            <li>Import schema: <code>mysql -u root -p project_tracker < database_schema.sql</code></li>
                        </ul>
                    </li>
                <?php endif; ?>
                
                <?php if (!$filesCheck): ?>
                    <li><strong>Missing Files:</strong> Ensure all project files are properly uploaded</li>
                <?php endif; ?>
            </ul>
            <p style="margin-top: 15px;">For detailed instructions, see <strong>INSTALL.md</strong></p>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
