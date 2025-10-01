<?php
// Simple database connection test
require_once('lib/config/database.php');

echo "<h1>Database Connection Test</h1>";

try {
    echo "<p>Testing database connection...</p>";
    
    $linkConnectDB = connect();
    echo "<p style='color: green;'>✓ Database connection successful!</p>";
    
    // Test simple query
    $result = $linkConnectDB->query("SELECT COUNT(*) as count FROM products");
    if ($result) {
        $row = $result->fetch_assoc();
        echo "<p style='color: green;'>✓ Query successful! Total products: " . $row['count'] . "</p>";
    } else {
        echo "<p style='color: red;'>✗ Query failed: " . $linkConnectDB->error . "</p>";
    }
    
    // Test the getAll function specifically
    require_once('lib/model.php');
    
    $start_time = microtime(true);
    $options = [
        'order_by' => 'editDate DESC',
        'limit' => '5'
    ];
    $products = getAll('products', $options);
    $end_time = microtime(true);
    
    $execution_time = $end_time - $start_time;
    echo "<p style='color: blue;'>Query execution time: " . number_format($execution_time, 4) . " seconds</p>";
    echo "<p style='color: blue;'>Products retrieved: " . count($products) . "</p>";
    
    if (!empty($products)) {
        echo "<h3>Sample Product:</h3>";
        echo "<pre>" . print_r($products[0], true) . "</pre>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Error: " . $e->getMessage() . "</p>";
}

echo "<p><a href='admin.php?controller=product&action=update'>Go back to Product Update page</a></p>";
?>