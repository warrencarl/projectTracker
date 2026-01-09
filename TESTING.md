# Testing Guide for Project Tracker

This document provides comprehensive testing scenarios to verify the application functionality.

## Pre-Testing Setup

1. Ensure database is set up with `database_schema.sql`
2. Verify environment with `check_requirements.php`
3. Clear browser cookies and cache
4. Open browser developer tools (F12) for debugging

## Test Scenarios

### 1. System Requirements Check

**Test Case 1.1: Verify Environment**
- Navigate to: `http://localhost/projectTracker/check_requirements.php`
- Expected: All checks should pass (green checkmarks)
- Verify: PHP version, PDO, Database connection, Required files

### 2. User Registration

**Test Case 2.1: Successful Registration (Agent)**
1. Navigate to registration page: `http://localhost/projectTracker/index.php?action=register`
2. Fill in form:
   - Oracle ID: `AGENT001`
   - Username: `John Agent`
   - Email: `agent1@test.com`
   - Password: `password123`
   - Confirm Password: `password123`
   - Role: `Agent`
3. Click "Register"
4. Expected: Success message displayed, redirect to login after 2 seconds

**Test Case 2.2: Successful Registration (Supervisor)**
1. Navigate to registration page
2. Fill in form:
   - Oracle ID: `SUPER001`
   - Username: `Jane Supervisor`
   - Email: `supervisor1@test.com`
   - Password: `password123`
   - Confirm Password: `password123`
   - Role: `Supervisor`
3. Click "Register"
4. Expected: Success message displayed, redirect to login

**Test Case 2.3: Duplicate Oracle ID**
1. Try registering with Oracle ID: `AGENT001` (already used)
2. Expected: Error message "Oracle ID already exists"

**Test Case 2.4: Duplicate Email**
1. Try registering with email: `agent1@test.com` (already used)
2. Expected: Error message "Email already exists"

**Test Case 2.5: Password Mismatch**
1. Fill form with different passwords in password and confirm fields
2. Expected: Error message "Passwords do not match"

**Test Case 2.6: Short Password**
1. Try password with less than 6 characters
2. Expected: Error message "Password must be at least 6 characters"

**Test Case 2.7: Invalid Email Format**
1. Enter invalid email: `notanemail`
2. Expected: Error message "Invalid email format"

**Test Case 2.8: Empty Fields**
1. Leave one or more fields empty
2. Expected: Error message "Please fill in all fields"

**Test Case 2.9: Invalid Role**
1. Manually submit form with invalid role (use browser dev tools)
2. Expected: Error message "Invalid role selected"

### 3. User Login

**Test Case 3.1: Successful Login (Agent)**
1. Navigate to login page: `http://localhost/projectTracker/`
2. Enter credentials:
   - Email: `agent1@test.com`
   - Password: `password123`
3. Click "Login"
4. Expected: Redirect to Agent Dashboard

**Test Case 3.2: Successful Login (Supervisor)**
1. Navigate to login page
2. Enter credentials:
   - Email: `supervisor1@test.com`
   - Password: `password123`
3. Click "Login"
4. Expected: Redirect to Supervisor Dashboard

**Test Case 3.3: Invalid Email**
1. Try logging in with non-existent email
2. Expected: Error message "Invalid email or password"

**Test Case 3.4: Wrong Password**
1. Enter correct email but wrong password
2. Expected: Error message "Invalid email or password"

**Test Case 3.5: Empty Fields**
1. Leave email or password empty
2. Expected: Error message "Please fill in all fields"

### 4. Agent Dashboard

**Test Case 4.1: Access Agent Dashboard**
1. Login as agent (agent1@test.com)
2. Expected: 
   - Page title shows "Agent Dashboard"
   - Role badge shows "Agent" in blue
   - Profile information displays correctly:
     - Username: John Agent
     - Email: agent1@test.com
     - Oracle ID: AGENT001
     - Role: Agent
   - Agent features list is visible
   - Recent Activities section exists

**Test Case 4.2: Dashboard Navigation**
1. Verify navigation bar shows:
   - Project Tracker logo
   - Welcome message with username and Oracle ID
   - Logout button

**Test Case 4.3: Agent Features Display**
- Verify features list shows:
  - View assigned projects
  - Update project status
  - Submit progress reports
  - Access project documentation
  - Communicate with supervisors

### 5. Supervisor Dashboard

**Test Case 5.1: Access Supervisor Dashboard**
1. Login as supervisor (supervisor1@test.com)
2. Expected:
   - Page title shows "Supervisor Dashboard"
   - Role badge shows "Supervisor" in orange
   - Profile information displays correctly
   - Supervisor features list is visible
   - Team Overview and Project Statistics sections exist

**Test Case 5.2: Supervisor Features Display**
- Verify features list shows:
  - Manage all projects
  - Assign tasks to agents
  - Review agent submissions
  - Generate reports and analytics
  - Approve or reject project changes
  - Monitor team performance

### 6. Authentication & Authorization

**Test Case 6.1: Direct Dashboard Access Without Login**
1. Logout (if logged in)
2. Try accessing: `http://localhost/projectTracker/index.php?action=dashboard`
3. Expected: Redirect to login page

**Test Case 6.2: Already Logged In - Registration Page**
1. Login as any user
2. Try accessing registration page
3. Expected: Redirect to dashboard

**Test Case 6.3: Already Logged In - Login Page**
1. Login as any user
2. Try accessing login page
3. Expected: Redirect to dashboard

**Test Case 6.4: Session Persistence**
1. Login to the application
2. Navigate to dashboard
3. Open new browser tab
4. Go to application URL
5. Expected: Still logged in, redirect to dashboard

**Test Case 6.5: Role Separation**
- Agent cannot see supervisor-specific features
- Supervisor cannot see agent-specific features (if implemented)
- Each role has appropriate dashboard

### 7. Logout Functionality

**Test Case 7.1: Logout from Agent Dashboard**
1. Login as agent
2. Click "Logout" button
3. Expected:
   - Redirect to login page
   - Session destroyed
   - Cannot access dashboard without logging in again

**Test Case 7.2: Logout from Supervisor Dashboard**
1. Login as supervisor
2. Click "Logout" button
3. Expected: Same as 7.1

**Test Case 7.3: Session Cleared After Logout**
1. Logout
2. Use browser back button
3. Expected: Cannot access protected pages, redirect to login

### 8. Security Testing

**Test Case 8.1: SQL Injection Prevention**
1. Try SQL injection in login:
   - Email: `' OR '1'='1`
   - Password: `' OR '1'='1`
2. Expected: Login fails, no SQL error

**Test Case 8.2: XSS Prevention**
1. Register with username: `<script>alert('XSS')</script>`
2. Login and check dashboard
3. Expected: Script tags are escaped, no alert popup

**Test Case 8.3: Password Hashing**
1. Check database directly:
   ```sql
   SELECT password FROM users LIMIT 1;
   ```
2. Expected: Password is hashed, not plain text

**Test Case 8.4: Session Security**
1. Check cookies in browser (F12 -> Application -> Cookies)
2. Expected: Session cookie has HttpOnly flag

### 9. UI/UX Testing

**Test Case 9.1: Responsive Design - Mobile**
1. Open developer tools
2. Switch to mobile view (iPhone, Android)
3. Expected: Layout adjusts properly, all elements visible

**Test Case 9.2: Form Validation Feedback**
1. Submit forms with errors
2. Expected: Error messages are clear and visible

**Test Case 9.3: Success Messages**
1. Complete successful registration
2. Expected: Success message is visible and clear

**Test Case 9.4: Navigation Links**
1. Click "Register here" from login page
2. Expected: Navigate to registration
3. Click "Login here" from registration page
4. Expected: Navigate to login

### 10. Browser Compatibility

**Test Case 10.1: Chrome/Edge**
- Test all functionality in Chrome/Edge
- Expected: All features work correctly

**Test Case 10.2: Firefox**
- Test all functionality in Firefox
- Expected: All features work correctly

**Test Case 10.3: Safari** (if available)
- Test all functionality in Safari
- Expected: All features work correctly

## Database Verification Tests

### Verify Data Integrity

```sql
-- Check user count
SELECT COUNT(*) FROM users;

-- View all users
SELECT oracle_id, username, email, role, created_at FROM users;

-- Check for duplicate Oracle IDs (should return 0)
SELECT oracle_id, COUNT(*) FROM users GROUP BY oracle_id HAVING COUNT(*) > 1;

-- Check for duplicate emails (should return 0)
SELECT email, COUNT(*) FROM users GROUP BY email HAVING COUNT(*) > 1;

-- Verify roles are correct
SELECT DISTINCT role FROM users;

-- Check password hashing (all should start with $2y$)
SELECT id, SUBSTRING(password, 1, 4) as hash_prefix FROM users;
```

## Performance Testing

**Test Case 11.1: Concurrent Users**
1. Open multiple browser windows/tabs
2. Login with different users simultaneously
3. Expected: All logins work correctly

**Test Case 11.2: Session Management**
1. Login on multiple devices
2. Expected: Each device maintains separate session

## Bug Testing Checklist

- [ ] Can register new users successfully
- [ ] Cannot register with duplicate Oracle ID
- [ ] Cannot register with duplicate email
- [ ] Login works with correct credentials
- [ ] Login fails with incorrect credentials
- [ ] Agent sees Agent dashboard
- [ ] Supervisor sees Supervisor dashboard
- [ ] Cannot access dashboard without login
- [ ] Logout clears session properly
- [ ] Session persists across page refreshes
- [ ] Error messages are displayed correctly
- [ ] Success messages are displayed correctly
- [ ] Password is hashed in database
- [ ] SQL injection is prevented
- [ ] XSS attacks are prevented
- [ ] Responsive design works on mobile
- [ ] All navigation links work

## Common Issues & Solutions

**Issue**: "Cannot connect to database"
- Solution: Check config/database.php credentials

**Issue**: Login redirects back to login page
- Solution: Check session configuration, ensure cookies enabled

**Issue**: Dashboard shows wrong user info
- Solution: Clear browser cookies, logout and login again

**Issue**: Registration doesn't redirect
- Solution: Check for JavaScript errors in console

## Test Data

Use this test data for comprehensive testing:

| Oracle ID | Username | Email | Password | Role |
|-----------|----------|-------|----------|------|
| AGENT001 | John Agent | agent1@test.com | password123 | Agent |
| AGENT002 | Mary Agent | agent2@test.com | password123 | Agent |
| SUPER001 | Jane Supervisor | super1@test.com | password123 | Supervisor |
| SUPER002 | Bob Supervisor | super2@test.com | password123 | Supervisor |

## Automated Testing (Future Enhancement)

For automated testing, consider:
- PHPUnit for unit tests
- Selenium for browser automation
- Behat for behavior-driven testing

## Reporting Issues

When reporting issues, include:
1. Test case number
2. Steps to reproduce
3. Expected result
4. Actual result
5. Browser and version
6. PHP and MySQL versions
7. Screenshots (if applicable)
8. Console errors (F12 -> Console)
