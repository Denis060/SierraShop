# Installation Guide

## System Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- Composer for dependency management
- Required PHP extensions:
  - PDO
  - MySQLi
  - GD Library
  - FileInfo
  - Zip

## Step-by-Step Installation

### 1. Server Setup

#### Using Laragon (Recommended for Development)
1. Download and install Laragon from https://laragon.org/
2. Clone the repository into the Laragon www directory:
   ```bash
   cd C:\laragon\www
   git clone https://github.com/Denis060/SierraShop.git
   ```

#### Manual Server Setup
1. Install Apache/Nginx
2. Install PHP 7.4+
3. Install MySQL 5.7+
4. Configure virtual host

### 2. Database Setup

1. Create new MySQL database:
   ```sql
   CREATE DATABASE sierrashop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

2. Import database structure:
   ```bash
   mysql -u your_username -p sierrashop < admin/database/db.sql
   ```

### 3. Application Setup

1. Copy configuration files:
   ```bash
   cp lib/config/config.example.php lib/config/config.php
   cp lib/config/database.example.php lib/config/database.php
   ```

2. Update database credentials in `lib/config/database.php`

3. Configure base URL in `lib/config/config.php`

4. Set directory permissions:
   ```bash
   chmod 755 public/upload/
   chmod 755 public/upload/images/
   chmod 755 admin/database/backups/
   ```

### 4. Install Dependencies

```bash
composer install
```

### 5. First Run

1. Access admin panel:
   - URL: `http://your-domain/admin.php`
   - Default username: `admin`
   - Default password: `admin123`

2. Change default credentials immediately

3. Configure basic shop settings:
   - Shop name
   - Contact information
   - Currency
   - Payment methods

## Troubleshooting

### Common Issues

1. **500 Internal Server Error**
   - Check file permissions
   - Verify PHP version
   - Enable error reporting in development

2. **Database Connection Failed**
   - Verify database credentials
   - Check MySQL service status
   - Confirm database exists

3. **Upload Issues**
   - Check directory permissions
   - Verify PHP file upload settings
   - Check file size limits

### Getting Help

If you encounter issues:
1. Check the troubleshooting guide
2. Search GitHub issues
3. Create new issue if needed

## Security Notes

1. Change default credentials immediately
2. Use strong passwords
3. Keep system updated
4. Regular backups
5. Set proper file permissions
