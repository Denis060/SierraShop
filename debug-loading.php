<?php
// Simple diagnostic page to identify loading issues
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h1>SierraShop Loading Diagnostic</h1>";
echo "<p>Current time: " . date('Y-m-d H:i:s') . "</p>";

// Test 1: Basic PHP functionality
echo "<h2>✓ PHP is working</h2>";

// Test 2: Check if we can include basic files
try {
    echo "<h2>Testing file includes...</h2>";
    
    if (file_exists('lib/config/database.php')) {
        echo "<p>✓ Database config file found</p>";
        require_once('lib/config/database.php');
        echo "<p>✓ Database config loaded</p>";
    } else {
        echo "<p>✗ Database config file NOT found</p>";
    }
    
    if (file_exists('lib/model.php')) {
        echo "<p>✓ Model file found</p>";
        require_once('lib/model.php');
        echo "<p>✓ Model file loaded</p>";
    } else {
        echo "<p>✗ Model file NOT found</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Include error: " . $e->getMessage() . "</p>";
}

// Test 3: Database connection
try {
    echo "<h2>Testing database connection...</h2>";
    $linkConnectDB = connect();
    echo "<p>✓ Database connected successfully</p>";
    
    // Test basic query
    $result = $linkConnectDB->query("SELECT 1 as test");
    if ($result) {
        echo "<p>✓ Basic query works</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Database error: " . $e->getMessage() . "</p>";
}

// Test 4: Check if products table exists
try {
    echo "<h2>Testing products table...</h2>";
    $result = $linkConnectDB->query("SHOW TABLES LIKE 'products'");
    if ($result && $result->num_rows > 0) {
        echo "<p>✓ Products table exists</p>";
        
        // Count products
        $count_result = $linkConnectDB->query("SELECT COUNT(*) as count FROM products");
        if ($count_result) {
            $count = $count_result->fetch_assoc();
            echo "<p>✓ Total products: " . $count['count'] . "</p>";
        }
        
        // Test simple select
        $sample_result = $linkConnectDB->query("SELECT id, product_name FROM products LIMIT 1");
        if ($sample_result && $sample_result->num_rows > 0) {
            $sample = $sample_result->fetch_assoc();
            echo "<p>✓ Sample product: ID " . $sample['id'] . " - " . htmlspecialchars($sample['product_name']) . "</p>";
        }
        
    } else {
        echo "<p style='color: red;'>✗ Products table does not exist</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Products table error: " . $e->getMessage() . "</p>";
}

// Test 5: Test the getAll function with minimal data
try {
    echo "<h2>Testing getAll function...</h2>";
    
    $start_time = microtime(true);
    $options = [
        'limit' => '3'  // Just 3 records
    ];
    $products = getAll('products', $options);
    $end_time = microtime(true);
    
    $execution_time = $end_time - $start_time;
    echo "<p>✓ getAll function works: " . count($products) . " products in " . number_format($execution_time, 4) . " seconds</p>";
    
    if (!empty($products)) {
        foreach ($products as $product) {
            echo "<p>- Product: " . htmlspecialchars($product['product_name']) . "</p>";
        }
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ getAll function error: " . $e->getMessage() . "</p>";
}

// Test 6: Check for session issues
echo "<h2>Testing session...</h2>";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    echo "<p>✓ Session started</p>";
} else {
    echo "<p>✓ Session already active</p>";
}

// Test 7: Memory and execution limits
echo "<h2>PHP Configuration:</h2>";
echo "<p>Memory limit: " . ini_get('memory_limit') . "</p>";
echo "<p>Max execution time: " . ini_get('max_execution_time') . "</p>";
echo "<p>Max input time: " . ini_get('max_input_time') . "</p>";

// Test 8: Create a minimal product page
echo "<h2>Creating minimal test page...</h2>";
$minimal_html = '<?php
// Minimal product page test
require_once("lib/config/database.php");
require_once("lib/model.php");

echo "<h1>Minimal Product Test</h1>";
try {
    $products = getAll("products", ["limit" => "5"]);
    echo "<p>Found " . count($products) . " products</p>";
    echo "<ul>";
    foreach ($products as $product) {
        echo "<li>" . htmlspecialchars($product["product_name"]) . "</li>";
    }
    echo "</ul>";
} catch (Exception $e) {
    echo "<p>Error: " . $e->getMessage() . "</p>";
}
?>';

file_put_contents('minimal-test.php', $minimal_html);
echo "<p>✓ Created minimal test page: <a href='minimal-test.php' target='_blank'>minimal-test.php</a></p>";

echo "<h2>Quick Links for Testing:</h2>";
echo "<p><a href='admin.php?controller=product&action=newproduct' target='_blank'>Test New Products</a></p>";
echo "<p><a href='admin.php?controller=product&action=update' target='_blank'>Test Recently Updated</a></p>";
echo "<p><a href='minimal-test.php' target='_blank'>Test Minimal Page</a></p>";

echo "<hr>";
echo "<p><strong>If the minimal test page works but the admin pages don't, the issue is likely in the admin template files or session handling.</strong></p>";
?>