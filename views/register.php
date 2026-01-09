<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Project Tracker</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="container">
        <div class="auth-box">
            <h1>Project Tracker</h1>
            <h2>Register</h2>
            
            <?php if (isset($error) && !empty($error)): ?>
                <div class="alert alert-error">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($success) && !empty($success)): ?>
                <div class="alert alert-success">
                    <?php echo htmlspecialchars($success); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="/index.php?action=register">
                <div class="form-group">
                    <label for="oracle_id">Oracle ID: <span class="required">*</span></label>
                    <input type="text" id="oracle_id" name="oracle_id" required 
                           value="<?php echo isset($_POST['oracle_id']) ? htmlspecialchars($_POST['oracle_id']) : ''; ?>"
                           placeholder="Enter your unique Oracle ID">
                </div>

                <div class="form-group">
                    <label for="username">Username: <span class="required">*</span></label>
                    <input type="text" id="username" name="username" required 
                           value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="email">Email: <span class="required">*</span></label>
                    <input type="email" id="email" name="email" required 
                           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="password">Password: <span class="required">*</span></label>
                    <input type="password" id="password" name="password" required 
                           placeholder="Minimum 6 characters">
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password: <span class="required">*</span></label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>

                <div class="form-group">
                    <label for="role">Role: <span class="required">*</span></label>
                    <select id="role" name="role" required>
                        <option value="">Select a role</option>
                        <option value="Agent" <?php echo (isset($_POST['role']) && $_POST['role'] === 'Agent') ? 'selected' : ''; ?>>Agent</option>
                        <option value="Supervisor" <?php echo (isset($_POST['role']) && $_POST['role'] === 'Supervisor') ? 'selected' : ''; ?>>Supervisor</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Register</button>
            </form>

            <div class="auth-link">
                Already have an account? <a href="/index.php?action=login">Login here</a>
            </div>
        </div>
    </div>
</body>
</html>
