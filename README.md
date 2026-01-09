# Project Tracker - MVC PHP Application

A comprehensive MVC-based PHP web application with user authentication, role-based access control, and dashboard functionality.

## Features

- **User Authentication**: Secure login and registration system
- **Role-Based Access**: Two distinct user roles (Agent and Supervisor)
- **Oracle ID Integration**: Unique Oracle ID requirement for each user
- **Role-Based Dashboards**: Different dashboards for Agents and Supervisors
- **Secure Password Hashing**: Using PHP's password_hash() with BCRYPT
- **Session Management**: Secure session handling with authentication middleware
- **MVC Architecture**: Clean separation of concerns following MVC best practices
- **Responsive Design**: Mobile-friendly interface

## Technology Stack

- **Backend**: PHP 7.4+
- **Database**: MySQL 5.7+
- **Architecture**: MVC (Model-View-Controller)
- **Frontend**: HTML5, CSS3
- **Security**: PDO prepared statements, password hashing, input sanitization

## Project Structure

```
projectTracker/
├── config/
│   ├── database.php       # Database configuration and connection
│   └── session.php        # Session management and authentication helpers
├── models/
│   └── User.php          # User model with authentication methods
├── views/
│   ├── login.php         # Login page
│   ├── register.php      # Registration page
│   ├── dashboard_agent.php      # Agent dashboard
│   └── dashboard_supervisor.php # Supervisor dashboard
├── controllers/
│   ├── AuthController.php      # Authentication controller
│   └── DashboardController.php # Dashboard controller
├── css/
│   └── style.css         # Application styles
├── index.php             # Application entry point and router
├── .htaccess            # Apache URL rewriting configuration
├── database_schema.sql  # Database schema
└── README.md            # This file
```

## Installation

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache web server with mod_rewrite enabled
- Web browser

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/warrencarl/projectTracker.git
   cd projectTracker
   ```

2. **Configure the database**
   
   Edit `config/database.php` to match your database credentials:
   ```php
   private $host = 'localhost';
   private $db_name = 'project_tracker';
   private $username = 'root';
   private $password = '';
   ```

3. **Create the database**
   
   Run the SQL schema file:
   ```bash
   mysql -u root -p < database_schema.sql
   ```
   
   Or manually execute the SQL commands in `database_schema.sql`

4. **Configure Apache**
   
   Ensure `mod_rewrite` is enabled:
   ```bash
   sudo a2enmod rewrite
   sudo systemctl restart apache2
   ```

5. **Set up the web directory**
   
   - Copy files to your web server directory (e.g., `/var/www/html/projectTracker`)
   - Or configure a virtual host pointing to the project directory

6. **Set proper permissions**
   ```bash
   chmod 755 /path/to/projectTracker
   chmod 644 /path/to/projectTracker/index.php
   ```

7. **Access the application**
   
   Open your browser and navigate to:
   ```
   http://localhost/projectTracker/
   ```

## Usage

### Registration

1. Navigate to the registration page
2. Fill in the required fields:
   - **Oracle ID**: Unique identifier (must be unique across all users)
   - **Username**: Your display name
   - **Email**: Valid email address (must be unique)
   - **Password**: Minimum 6 characters
   - **Role**: Select either "Agent" or "Supervisor"
3. Click "Register"
4. After successful registration, you'll be redirected to the login page

### Login

1. Enter your registered email and password
2. Click "Login"
3. You'll be redirected to your role-specific dashboard

### Dashboards

**Agent Dashboard:**
- View profile information
- Access agent-specific features
- View assigned projects
- Update project status
- Submit progress reports

**Supervisor Dashboard:**
- View profile information
- Access supervisor-specific features
- Manage all projects
- Assign tasks to agents
- Review submissions
- Generate reports and analytics

## Security Features

- **Password Hashing**: All passwords are hashed using BCRYPT
- **SQL Injection Prevention**: PDO prepared statements
- **XSS Prevention**: Input sanitization with htmlspecialchars()
- **Session Security**: HTTP-only cookies, secure session management
- **Authentication Middleware**: Protected routes require authentication
- **Role-Based Access Control**: Users can only access their authorized dashboards

## Database Schema

The application uses a single `users` table:

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    oracle_id VARCHAR(50) UNIQUE NOT NULL,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('Agent', 'Supervisor') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

## Troubleshooting

**Problem**: Cannot connect to database
- **Solution**: Check database credentials in `config/database.php`
- **Solution**: Ensure MySQL service is running

**Problem**: 404 errors on pages
- **Solution**: Ensure `mod_rewrite` is enabled in Apache
- **Solution**: Check `.htaccess` file is present and readable

**Problem**: "Oracle ID already exists" error
- **Solution**: Each Oracle ID must be unique. Use a different Oracle ID

**Problem**: Session issues
- **Solution**: Ensure PHP session support is enabled
- **Solution**: Check directory permissions for session storage

## Development

### Adding New Features

The application follows MVC architecture:

1. **Models**: Add new models in `models/` directory
2. **Views**: Add new views in `views/` directory
3. **Controllers**: Add new controllers in `controllers/` directory
4. **Routes**: Update `index.php` to add new routes

### Code Standards

- Follow PSR-12 coding standards
- Use prepared statements for all database queries
- Sanitize all user inputs
- Use meaningful variable and function names
- Add comments for complex logic

## Future Enhancements

- Password reset functionality
- Email verification
- User profile editing
- Project management features
- Team collaboration tools
- Advanced reporting and analytics
- API endpoints for mobile apps
- Two-factor authentication

## License

This project is open source and available for educational purposes.

## Support

For issues and questions, please open an issue on the GitHub repository.
