# Security Guide

## Overview

This document outlines security measures implemented in Sierra Shop and best practices for maintaining security.

## Authentication & Authorization

### Password Security

1. **Password Hashing**
   ```php
   // Always use password_hash for storing passwords
   $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
   
   // Verify passwords using password_verify
   if (password_verify($input, $hashedPassword)) {
       // Valid password
   }
   ```

2. **Password Requirements**
   - Minimum 8 characters
   - At least one uppercase letter
   - At least one lowercase letter
   - At least one number
   - At least one special character

### Session Management

1. **Session Configuration**
   ```php
   // In php.ini or runtime
   session_set_cookie_params([
       'lifetime' => 3600,
       'path' => '/',
       'secure' => true,
       'httponly' => true,
       'samesite' => 'Strict'
   ]);
   ```

2. **Session Protection**
   - Regenerate session ID after login
   - Clear session on logout
   - Session timeout after inactivity
   - Check IP consistency

## Input Validation & Sanitization

### Form Inputs

1. **Input Validation**
   ```php
   // Example validation function
   function validateInput($input, $type) {
       switch ($type) {
           case 'email':
               return filter_var($input, FILTER_VALIDATE_EMAIL);
           case 'int':
               return filter_var($input, FILTER_VALIDATE_INT);
           // Add more validation types
       }
   }
   ```

2. **Output Escaping**
   ```php
   // Always escape output
   echo htmlspecialchars($userInput, ENT_QUOTES, 'UTF-8');
   ```

### SQL Injection Prevention

1. **Prepared Statements**
   ```php
   $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
   $stmt->execute([$userId]);
   ```

2. **Query Building**
   ```php
   // Use parameterized queries for dynamic conditions
   $where = [];
   $params = [];
   
   if ($status) {
       $where[] = "status = ?";
       $params[] = $status;
   }
   
   $sql = "SELECT * FROM orders";
   if ($where) {
       $sql .= " WHERE " . implode(" AND ", $where);
   }
   
   $stmt = $pdo->prepare($sql);
   $stmt->execute($params);
   ```

## CSRF Protection

### Token Generation

```php
function generateCSRFToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}
```

### Token Validation

```php
function validateCSRFToken($token) {
    if (!isset($_SESSION['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $token)) {
        throw new SecurityException('Invalid CSRF token');
    }
}
```

### Form Implementation

```html
<form method="POST" action="/action">
    <input type="hidden" name="csrf_token" 
           value="<?php echo generateCSRFToken(); ?>">
    <!-- form fields -->
</form>
```

## File Upload Security

### Upload Validation

```php
function validateUpload($file) {
    // Check file size
    if ($file['size'] > 5000000) {
        throw new UploadException('File too large');
    }

    // Check file type
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($file['type'], $allowedTypes)) {
        throw new UploadException('Invalid file type');
    }

    // Validate file extension
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
        throw new UploadException('Invalid file extension');
    }
}
```

### File Storage

```php
function storeUpload($file) {
    // Generate safe filename
    $filename = bin2hex(random_bytes(16)) . '.' . 
                pathinfo($file['name'], PATHINFO_EXTENSION);
    
    // Move to secure location
    $uploadDir = '/path/to/secure/uploads/';
    if (!move_uploaded_file($file['tmp_name'], 
                          $uploadDir . $filename)) {
        throw new UploadException('Upload failed');
    }
    
    return $filename;
}
```

## XSS Prevention

### Content Security Policy

```php
header("Content-Security-Policy: default-src 'self'; " .
       "script-src 'self' 'unsafe-inline' 'unsafe-eval'; " .
       "style-src 'self' 'unsafe-inline';");
```

### Input Filtering

```php
function cleanInput($input) {
    if (is_array($input)) {
        return array_map('cleanInput', $input);
    }
    
    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
}
```

## Error Handling & Logging

### Error Configuration

```php
// Production settings
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/error.log');
```

### Security Logging

```php
function logSecurityEvent($event, $details) {
    $log = date('Y-m-d H:i:s') . " | " . 
           $_SERVER['REMOTE_ADDR'] . " | " .
           ($details['user'] ?? 'anonymous') . " | " .
           $event . " | " . 
           json_encode($details) . "\n";
           
    file_put_contents('/path/to/security.log', $log, FILE_APPEND);
}
```

## Regular Maintenance

### Security Checklist

1. **Daily**
   - Monitor error logs
   - Check failed login attempts
   - Review security events

2. **Weekly**
   - Update dependencies
   - Scan for malware
   - Review user permissions

3. **Monthly**
   - Full security audit
   - Password policy review
   - Update security documentation

### Incident Response

1. **Detection**
   - Monitor logs
   - Set up alerts
   - User reporting system

2. **Response**
   - Isolate affected systems
   - Document incident
   - Implement fixes

3. **Recovery**
   - Restore from backups
   - Update security measures
   - User notification

## Additional Resources

- [OWASP Top 10](https://owasp.org/www-project-top-ten/)
- [PHP Security Guide](https://phpsecurity.readthedocs.io/en/latest/)
- [Security Checklist](SECURITY-CHECKLIST.md)
