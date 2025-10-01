<?php
// Test session and login status
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Session & Login Test</h1>";

echo "<h2>Session Status:</h2>";
echo "<p>Session ID: " . session_id() . "</p>";
echo "<p>Session Status: " . session_status() . " (1=disabled, 2=active, 3=none)</p>";

echo "<h2>Session Data:</h2>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

echo "<h2>User Login Status:</h2>";
if (isset($_SESSION['user'])) {
    echo "<p style='color: green;'>✓ User is logged in</p>";
    echo "<p>User ID: " . $_SESSION['user']['id'] . "</p>";
    echo "<p>Username: " . htmlspecialchars($_SESSION['user']['user_name']) . "</p>";
    
    // Test user lookup
    try {
        require_once('lib/config/database.php');
        require_once('lib/model.php');
        
        $userNav = $_SESSION['user']['id'];
        $userInfo = getRecord('users', $userNav);
        
        if ($userInfo) {
            echo "<p style='color: green;'>✓ User found in database</p>";
            echo "<p>Role ID: " . $userInfo['role_id'] . "</p>";
        } else {
            echo "<p style='color: red;'>✗ User not found in database!</p>";
        }
        
    } catch (Exception $e) {
        echo "<p style='color: red;'>✗ Database error: " . $e->getMessage() . "</p>";
    }
    
} else {
    echo "<p style='color: red;'>✗ User is not logged in</p>";
    echo "<p>You need to log in to access admin pages.</p>";
    echo "<p><a href='admin.php'>Go to Admin Login</a></p>";
}

echo "<h2>Quick Tests:</h2>";
echo "<p><a href='debug-recently-updated.php'>Test Recently Updated (bypass login)</a></p>";
echo "<p><a href='admin.php?controller=product&action=update'>Test Recently Updated (with login)</a></p>";
echo "<p><a href='admin.php'>Admin Dashboard</a></p>";
?>