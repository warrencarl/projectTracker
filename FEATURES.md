# Project Tracker - Feature Overview

## Application Summary

Project Tracker is a secure, role-based web application built with PHP following MVC architecture. It provides user authentication and personalized dashboards for different user roles.

## Key Features

### 1. User Registration
- **Oracle ID**: Unique identifier required for each user
- **Role Selection**: Choose between Agent or Supervisor during registration
- **Validation**: Email format, password strength, unique constraints
- **Security**: Password hashing with BCRYPT algorithm

### 2. User Authentication
- **Secure Login**: Email and password-based authentication
- **Session Management**: Persistent sessions with security flags
- **Password Security**: No plain-text storage, secure hashing
- **Access Control**: Protected routes require authentication

### 3. Role-Based Dashboards

#### Agent Dashboard
**Purpose**: For team members working on projects

**Features**:
- View profile information (Username, Email, Oracle ID, Role)
- Access agent-specific functionality:
  - View assigned projects
  - Update project status
  - Submit progress reports
  - Access project documentation
  - Communicate with supervisors
- Recent activities section
- Clean, professional interface with blue role badge

#### Supervisor Dashboard
**Purpose**: For team leaders managing projects and agents

**Features**:
- View profile information (Username, Email, Oracle ID, Role)
- Access supervisor-specific functionality:
  - Manage all projects
  - Assign tasks to agents
  - Review agent submissions
  - Generate reports and analytics
  - Approve or reject project changes
  - Monitor team performance
- Team overview section
- Project statistics section
- Professional interface with orange role badge

### 4. Security Features

**Authentication Security**:
- PDO prepared statements (SQL injection prevention)
- Password hashing with PASSWORD_BCRYPT
- Input sanitization (XSS prevention)
- Session security with HTTP-only cookies
- CSRF protection through session-based auth

**Authorization Security**:
- Role-based access control
- Protected routes with middleware
- Session validation on each request
- Automatic redirection for unauthorized access

**Data Validation**:
- Server-side validation for all inputs
- Email format validation
- Password strength requirements (minimum 6 characters)
- Unique constraint enforcement (Oracle ID, Email)
- Role validation (only Agent or Supervisor allowed)

## Technical Architecture

### MVC Pattern Implementation

```
┌─────────────────────────────────────────┐
│           Browser/Client                │
└──────────────┬──────────────────────────┘
               │
               ▼
┌─────────────────────────────────────────┐
│          index.php (Router)             │
│  - Routes requests to controllers       │
└──────────────┬──────────────────────────┘
               │
               ▼
┌─────────────────────────────────────────┐
│           Controllers                    │
│  - AuthController (login, register)     │
│  - DashboardController (dashboards)     │
└──────────────┬──────────────────────────┘
               │
      ┌────────┴────────┐
      ▼                 ▼
┌────────────┐   ┌─────────────┐
│   Models   │   │    Views    │
│  - User    │   │  - login    │
│            │   │  - register │
│            │   │  - dashboards│
└────┬───────┘   └─────────────┘
     │
     ▼
┌────────────────┐
│   Database     │
│  - users table │
└────────────────┘
```

### File Structure

```
projectTracker/
├── index.php              # Entry point & router
├── .htaccess             # URL rewriting
├── database_schema.sql   # Database schema
│
├── config/
│   ├── database.php      # Database connection
│   └── session.php       # Session management
│
├── models/
│   └── User.php          # User model
│
├── controllers/
│   ├── AuthController.php      # Authentication
│   └── DashboardController.php # Dashboards
│
├── views/
│   ├── login.php               # Login page
│   ├── register.php            # Registration page
│   ├── dashboard_agent.php     # Agent dashboard
│   └── dashboard_supervisor.php # Supervisor dashboard
│
└── css/
    └── style.css         # Application styles
```

## User Workflows

### Registration Flow
```
1. User visits application
2. Clicks "Register here"
3. Fills registration form:
   - Oracle ID (unique)
   - Username
   - Email (unique, valid format)
   - Password (min 6 chars)
   - Confirm Password (must match)
   - Role (Agent or Supervisor)
4. Submits form
5. System validates inputs
6. System checks for duplicates
7. Password is hashed
8. User record saved to database
9. Success message shown
10. Auto-redirect to login after 2 seconds
```

### Login Flow
```
1. User enters email and password
2. Submits login form
3. System validates credentials
4. System verifies password hash
5. Session created with user data
6. User redirected to role-based dashboard
```

### Dashboard Access Flow
```
1. User attempts to access dashboard
2. System checks session authentication
3. If authenticated:
   - Check user role
   - Redirect to appropriate dashboard
4. If not authenticated:
   - Redirect to login page
```

## Database Schema

### Users Table
```sql
CREATE TABLE users (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    oracle_id       VARCHAR(50) UNIQUE NOT NULL,
    username        VARCHAR(100) NOT NULL,
    email           VARCHAR(150) UNIQUE NOT NULL,
    password        VARCHAR(255) NOT NULL,
    role            ENUM('Agent', 'Supervisor') NOT NULL,
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
                    ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_oracle_id (oracle_id),
    INDEX idx_email (email)
);
```

**Constraints**:
- `oracle_id`: Unique, cannot be NULL
- `email`: Unique, cannot be NULL
- `role`: Only 'Agent' or 'Supervisor' allowed
- `password`: Hashed with BCRYPT (255 chars for future algorithms)

## Design Highlights

### Color Scheme
- **Primary**: Purple gradient (#667eea to #764ba2)
- **Agent Badge**: Blue (#3498db)
- **Supervisor Badge**: Orange (#e67e22)
- **Success**: Green (#27ae60)
- **Error**: Red (#e74c3c)
- **Background**: Light gray (#f5f7fa)

### Responsive Design
- Mobile-first approach
- Breakpoint at 768px
- Flexible grid layout
- Touch-friendly buttons
- Readable on all devices

### User Experience
- Clear error messages
- Success feedback
- Auto-redirect after actions
- Consistent navigation
- Professional appearance
- Intuitive form layouts

## Security Best Practices Implemented

1. **Input Validation**
   - Server-side validation for all inputs
   - Type checking and format validation
   - Length restrictions

2. **SQL Injection Prevention**
   - PDO prepared statements
   - Parameter binding
   - No dynamic query construction

3. **XSS Prevention**
   - htmlspecialchars() on all output
   - strip_tags() on input
   - Content Security Policy ready

4. **Password Security**
   - BCRYPT hashing algorithm
   - No plain-text storage
   - No password display in UI

5. **Session Security**
   - HTTP-only cookies
   - Secure session configuration
   - Session regeneration on login

6. **Access Control**
   - Authentication middleware
   - Role-based authorization
   - Protected routes

## Extensibility

The application is designed to be easily extended:

### Potential Enhancements
1. **Project Management**
   - Create and manage projects
   - Assign projects to agents
   - Track project status

2. **Task Management**
   - Create tasks within projects
   - Assign tasks to agents
   - Set deadlines and priorities

3. **Reporting**
   - Generate project reports
   - View agent productivity
   - Export data to CSV/PDF

4. **Communication**
   - Internal messaging system
   - Email notifications
   - Comment threads on projects

5. **Advanced Features**
   - Two-factor authentication
   - Password reset via email
   - User profile editing
   - Activity logs
   - File uploads
   - API endpoints

### Easy Customization Points
- Dashboard content (views/dashboard_*.php)
- Styling (css/style.css)
- User roles (database schema and models)
- Validation rules (controllers)
- Database configuration (config/database.php)

## Browser Support

- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+
- Opera 76+

## Performance Considerations

- **Database Indexing**: Indexes on oracle_id and email for fast lookups
- **Session Caching**: PHP session handling with file storage
- **CSS Compression**: Ready for minification
- **Image Optimization**: No external images for fast loading
- **CDN Ready**: Can serve CSS/JS from CDN

## Compliance & Standards

- **PSR-12**: PHP coding standards (mostly followed)
- **OWASP**: Security best practices implemented
- **WCAG 2.1**: Basic accessibility (can be enhanced)
- **W3C**: Valid HTML5 and CSS3

## Summary

Project Tracker provides a solid foundation for a web-based project management system with:
- ✅ Secure authentication
- ✅ Role-based access control
- ✅ Clean MVC architecture
- ✅ Professional UI/UX
- ✅ Extensible design
- ✅ Security best practices
- ✅ Responsive layout
- ✅ Easy deployment

The application can be deployed immediately for basic user management or extended with additional features for comprehensive project tracking capabilities.
