<?php
// Database setup checker and creator for Laragon
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>SierraShop Database Setup</h1>";
echo "<p>Current time: " . date('Y-m-d H:i:s') . "</p>";

// Test connection to MySQL without database
echo "<h2>Step 1: Testing MySQL Connection</h2>";
try {
    $mysql_connection = new mysqli('localhost', 'root', '', '', 3306);
    
    if ($mysql_connection->connect_error) {
        throw new Exception('MySQL Connection error: ' . $mysql_connection->connect_error);
    }
    
    echo "<p style='color: green;'>✓ MySQL connection successful!</p>";
    
    // Check if database exists
    echo "<h2>Step 2: Checking Database</h2>";
    $db_name = 'new_mvc_shop_db';
    $result = $mysql_connection->query("SHOW DATABASES LIKE '$db_name'");
    
    if ($result && $result->num_rows > 0) {
        echo "<p style='color: green;'>✓ Database '$db_name' already exists!</p>";
    } else {
        echo "<p style='color: orange;'>⚠ Database '$db_name' does not exist. Creating it...</p>";
        
        if ($mysql_connection->query("CREATE DATABASE `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci")) {
            echo "<p style='color: green;'>✓ Database '$db_name' created successfully!</p>";
        } else {
            throw new Exception("Error creating database: " . $mysql_connection->error);
        }
    }
    
    // Now connect to the specific database
    echo "<h2>Step 3: Testing Database Connection</h2>";
    $db_connection = new mysqli('localhost', 'root', '', $db_name, 3306);
    
    if ($db_connection->connect_error) {
        throw new Exception('Database Connection error: ' . $db_connection->connect_error);
    }
    
    echo "<p style='color: green;'>✓ Connected to database '$db_name' successfully!</p>";
    
    // Check if products table exists
    echo "<h2>Step 4: Checking Tables</h2>";
    $result = $db_connection->query("SHOW TABLES LIKE 'products'");
    
    if ($result && $result->num_rows > 0) {
        echo "<p style='color: green;'>✓ Products table exists!</p>";
        
        // Count products
        $count_result = $db_connection->query("SELECT COUNT(*) as count FROM products");
        if ($count_result) {
            $count = $count_result->fetch_assoc();
            echo "<p>Products in database: " . $count['count'] . "</p>";
        }
        
    } else {
        echo "<p style='color: red;'>✗ Products table does not exist!</p>";
        echo "<p>You need to import your database schema and data.</p>";
        
        // Check if there's a SQL file to import
        if (file_exists('admin/database/db.sql')) {
            echo "<p>Found database file: admin/database/db.sql</p>";
            echo "<p>You can import this manually in phpMyAdmin or using MySQL command line.</p>";
        }
    }
    
    echo "<h2>Step 5: Test Configuration</h2>";
    require_once('lib/config/database.php');
    
    $test_connection = connect();
    echo "<p style='color: green;'>✓ Configuration connection successful!</p>";
    
    echo "<h2>Database Setup Complete!</h2>";
    echo "<p style='color: green;'>Your database configuration is now correct for Laragon.</p>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Error: " . $e->getMessage() . "</p>";
    
    echo "<h3>Troubleshooting Steps:</h3>";
    echo "<ol>";
    echo "<li>Make sure Laragon is running</li>";
    echo "<li>Make sure MySQL service is started in Laragon</li>";
    echo "<li>Check if phpMyAdmin is accessible: <a href='http://localhost/phpmyadmin' target='_blank'>http://localhost/phpmyadmin</a></li>";
    echo "<li>If you have a different MySQL password, update the database config file</li>";
    echo "</ol>";
}

echo "<hr>";
echo "<h3>Next Steps:</h3>";
echo "<p><a href='debug-loading.php'>Re-run Database Diagnostic</a></p>";
echo "<p><a href='admin.php?controller=product&action=newproduct'>Test New Products Page</a></p>";
echo "<p><a href='admin.php'>Go to Admin Dashboard</a></p>";
?>