<?php
// Test the permission system that might be causing the hang
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Permission System Test</h1>";

try {
    require_once('lib/config/database.php');
    require_once('lib/model.php');
    
    echo "<h2>Session Information:</h2>";
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
    
    echo "<h2>Testing userNav variable:</h2>";
    if (isset($_SESSION['user'])) {
        $userNav = $_SESSION['user']['id'];
        echo "<p>✓ userNav found: " . $userNav . "</p>";
        
        // Test the user lookup that permission_user() does
        echo "<h3>Testing user lookup...</h3>";
        $start_time = microtime(true);
        $userLogin = getRecord('users', $userNav);
        $end_time = microtime(true);
        
        if ($userLogin) {
            echo "<p>✓ User found in " . number_format($end_time - $start_time, 4) . " seconds</p>";
            echo "<p>User ID: " . $userLogin['id'] . "</p>";
            echo "<p>User Name: " . htmlspecialchars($userLogin['user_name']) . "</p>";
            echo "<p>Role ID: " . $userLogin['role_id'] . "</p>";
            
            if ($userLogin['role_id'] == 0) {
                echo "<p style='color: red;'>⚠️ This user has role_id = 0, which would cause redirect!</p>";
            } else {
                echo "<p style='color: green;'>✓ User has valid role_id for admin access</p>";
            }
        } else {
            echo "<p style='color: red;'>✗ User not found in database! This would cause permission_user() to fail.</p>";
        }
        
    } else {
        echo "<p style='color: red;'>✗ No user session found</p>";
        echo "<p>This means permission_user() will fail because \$userNav is not set.</p>";
    }
    
    echo "<h2>Manual Permission Test:</h2>";
    if (isset($_SESSION['user'])) {
        $userNav = $_SESSION['user']['id'];
        require_once('lib/functions.php');
        
        echo "<p>Calling permission_user()...</p>";
        permission_user();
        echo "<p>✓ permission_user() completed successfully</p>";
    } else {
        echo "<p style='color: red;'>Cannot test permission_user() - no user session</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Error: " . $e->getMessage() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}

echo "<h2>Quick Fix Test:</h2>";
echo "<p>If the permission system is the issue, try accessing:</p>";
echo "<p><a href='simple-new-products-test.php'>Simple New Products (bypasses permissions)</a></p>";
echo "<p><a href='admin.php'>Admin Dashboard (check if you're logged in)</a></p>";
?>