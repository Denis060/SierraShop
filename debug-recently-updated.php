<?php
// Debug version of Recently Updated Products - bypasses permission check
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Recently Updated Products (Debug Version)</h1>";
echo "<p><a href='admin.php'>← Back to Dashboard</a></p>";

try {
    // Load required files
    require_once('lib/config/database.php');
    require_once('lib/model.php');
    
    echo "<p style='color: green;'>✓ Files loaded successfully</p>";
    
    // Test the same query from tableoUpdateproduct.php
    echo "<h2>Loading recently updated products...</h2>";
    
    $start_time = microtime(true);
    
    $options_product_update = [
        'order_by' => 'editDate DESC',
        'limit' => '20'
    ];
    
    $total_product_update = getAll('products', $options_product_update);
    
    $end_time = microtime(true);
    $execution_time = $end_time - $start_time;
    
    echo "<p style='color: green;'>✓ Query completed in " . number_format($execution_time, 4) . " seconds</p>";
    echo "<p style='color: green;'>✓ Found " . count($total_product_update) . " recently updated products</p>";
    
    // Display results in a table
    if (!empty($total_product_update)) {
        echo "<style>
            table { border-collapse: collapse; width: 100%; margin-top: 20px; }
            th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
            th { background-color: #f2f2f2; }
            .btn { padding: 5px 10px; margin: 2px; text-decoration: none; border-radius: 3px; color: white; }
            .btn-success { background: #28a745; }
            .btn-warning { background: #ffc107; color: black; }
            .btn-danger { background: #dc3545; }
        </style>";
        
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Product Name</th>";
        echo "<th>Price</th>";
        echo "<th>Created Date</th>";
        echo "<th>Last Updated</th>";
        echo "<th>Total Views</th>";
        echo "<th>Actions</th>";
        echo "</tr>";
        
        foreach ($total_product_update as $product) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($product['id']) . "</td>";
            echo "<td>" . htmlspecialchars($product['product_name']) . "</td>";
            echo "<td>" . number_format($product['product_price'], 0, ',', '.') . "</td>";
            echo "<td>" . htmlspecialchars($product['createDate']) . "</td>";
            echo "<td>" . htmlspecialchars($product['editDate']) . "</td>";
            echo "<td>" . htmlspecialchars($product['totalView']) . "</td>";
            echo "<td>";
            echo "<a href='admin.php?controller=product&action=edit&product_id=" . $product['id'] . "' class='btn btn-warning'>Edit</a> ";
            echo "<a href='product/" . $product['id'] . "-" . htmlspecialchars($product['slug']) . "' target='_blank' class='btn btn-success'>View</a>";
            echo "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "<p>No recently updated products found.</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Error: " . $e->getMessage() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
?>

<hr>
<p><strong>Debug Info:</strong> This version bypasses admin template and permission checks.</p>
<p><a href="admin.php?controller=product&action=update">Try Original Recently Updated Page</a></p>
<p><a href="setup-database.php">Database Setup</a> | <a href="debug-loading.php">Full Diagnostic</a></p>