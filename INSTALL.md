# Installation Guide

## Quick Setup Instructions

Follow these steps to get your Project Tracker application running:

### 1. System Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache web server with mod_rewrite
- Web browser (Chrome, Firefox, Safari, etc.)

### 2. Database Setup

#### Option A: Using MySQL Command Line

```bash
# Login to MySQL
mysql -u root -p

# Create database and user (optional)
CREATE DATABASE project_tracker;
CREATE USER 'tracker_user'@'localhost' IDENTIFIED BY 'your_password';
GRANT ALL PRIVILEGES ON project_tracker.* TO 'tracker_user'@'localhost';
FLUSH PRIVILEGES;

# Import schema
USE project_tracker;
SOURCE /path/to/projectTracker/database_schema.sql;
```

#### Option B: Using phpMyAdmin

1. Open phpMyAdmin in your browser
2. Click "New" to create a new database
3. Name it `project_tracker`
4. Click on the database
5. Go to "Import" tab
6. Choose `database_schema.sql` file
7. Click "Go"

### 3. Configure Database Connection

Edit `config/database.php`:

```php
private $host = 'localhost';        // Your MySQL host
private $db_name = 'project_tracker'; // Your database name
private $username = 'root';          // Your MySQL username
private $password = '';              // Your MySQL password
```

### 4. Web Server Configuration

#### For Apache (with mod_rewrite)

**Enable mod_rewrite:**

```bash
# On Ubuntu/Debian
sudo a2enmod rewrite
sudo systemctl restart apache2

# On CentOS/RHEL
# Usually enabled by default
sudo systemctl restart httpd
```

**Configure Apache Virtual Host (Optional):**

Create a new virtual host file:

```bash
sudo nano /etc/apache2/sites-available/projecttracker.conf
```

Add this configuration:

```apache
<VirtualHost *:80>
    ServerName projecttracker.local
    DocumentRoot /var/www/html/projectTracker
    
    <Directory /var/www/html/projectTracker>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/projecttracker_error.log
    CustomLog ${APACHE_LOG_DIR}/projecttracker_access.log combined
</VirtualHost>
```

Enable the site:

```bash
sudo a2ensite projecttracker.conf
sudo systemctl restart apache2
```

Add to `/etc/hosts`:

```
127.0.0.1   projecttracker.local
```

#### For Development/Testing

Simply place the project in your web server's document root:

- **XAMPP**: `C:\xampp\htdocs\projectTracker` (Windows) or `/opt/lampp/htdocs/projectTracker` (Linux)
- **WAMP**: `C:\wamp64\www\projectTracker`
- **MAMP**: `/Applications/MAMP/htdocs/projectTracker`
- **Ubuntu/Debian**: `/var/www/html/projectTracker`

### 5. Set Permissions (Linux/Mac)

```bash
cd /path/to/projectTracker
chmod -R 755 .
chmod 644 config/database.php
```

### 6. Test the Installation

Open your browser and navigate to:

- **With virtual host**: `http://projecttracker.local/`
- **Without virtual host**: `http://localhost/projectTracker/`

You should see the login page.

### 7. Create Your First User

1. Click "Register here" on the login page
2. Fill in all required fields:
   - Oracle ID: `ORA001` (or any unique ID)
   - Username: Your name
   - Email: Your email
   - Password: At least 6 characters
   - Role: Select "Agent" or "Supervisor"
3. Click "Register"
4. Login with your credentials

## Troubleshooting

### "Cannot connect to database"

- Check MySQL is running: `sudo systemctl status mysql`
- Verify database credentials in `config/database.php`
- Ensure database exists: `SHOW DATABASES;` in MySQL

### "404 Not Found" errors

- Ensure `.htaccess` file exists in project root
- Check mod_rewrite is enabled: `apache2ctl -M | grep rewrite`
- Verify AllowOverride is set to "All" in Apache config

### "Oracle ID already exists"

- Each Oracle ID must be unique
- Check database for existing IDs: `SELECT oracle_id FROM users;`
- Use a different Oracle ID

### "Session errors"

- Check PHP session directory permissions
- Verify session.save_path in php.ini
- Ensure cookies are enabled in browser

### Permission denied errors

```bash
# Set correct ownership (Linux)
sudo chown -R www-data:www-data /var/www/html/projectTracker

# Set correct permissions
sudo chmod -R 755 /var/www/html/projectTracker
```

## Security Notes

For production deployment:

1. **Change database credentials** in `config/database.php`
2. **Enable HTTPS** and set `session.cookie_secure = 1` in `config/session.php`
3. **Change default database user** from root to a limited user
4. **Set strong passwords** for database users
5. **Keep PHP and MySQL updated** to latest stable versions
6. **Restrict file permissions** appropriately
7. **Enable error logging** instead of displaying errors

## Testing Credentials

After setup, create test users:

**Test Agent:**
- Oracle ID: `TEST001`
- Email: `agent@test.com`
- Role: Agent

**Test Supervisor:**
- Oracle ID: `TEST002`
- Email: `supervisor@test.com`
- Role: Supervisor

## Next Steps

After successful installation:

1. Create users for your team
2. Customize dashboards as needed
3. Add project management features
4. Configure email notifications
5. Set up backups

## Support

If you encounter issues:

1. Check Apache error logs: `sudo tail -f /var/log/apache2/error.log`
2. Check PHP error logs: Location varies by system
3. Enable PHP error display (development only):
   ```php
   ini_set('display_errors', 1);
   error_reporting(E_ALL);
   ```

For more help, refer to the main README.md file.
