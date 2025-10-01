<?php
// Temporary bypass version of new products controller
// This removes permission_user() to test if that's causing the hang

// Skip the permission check temporarily
// permission_user();

require_once('lib/config/database.php');
require_once('lib/model.php');

$title = 'New Products (Debug Version)';
$productNav = 'class="active open"';

// Simple debug version
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { padding: 5px 10px; margin: 2px; text-decoration: none; border-radius: 3px; }
        .btn-primary { background: #007bff; color: white; }
        .btn-warning { background: #ffc107; color: black; }
        .btn-danger { background: #dc3545; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h1><?= $title ?></h1>
        <p><a href="admin.php" class="btn btn-primary">← Back to Dashboard</a></p>
        
        <?php
        try {
            echo "<p>Loading new products...</p>";
            
            $start_time = microtime(true);
            
            $options = [
                'where' => 'product_typeid = 2',
                'order_by' => 'createDate DESC',
                'limit' => '20'
            ];
            
            $products = getAll('products', $options);
            
            $end_time = microtime(true);
            $execution_time = $end_time - $start_time;
            
            echo "<p style='color: green;'>✓ Found " . count($products) . " new products in " . number_format($execution_time, 4) . " seconds</p>";
            
            if (!empty($products)) {
                echo "<table>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Product Name</th>";
                echo "<th>Price</th>";
                echo "<th>Created Date</th>";
                echo "<th>Actions</th>";
                echo "</tr>";
                
                foreach ($products as $product) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($product['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($product['product_name']) . "</td>";
                    echo "<td>" . number_format($product['product_price'], 0, ',', '.') . "</td>";
                    echo "<td>" . htmlspecialchars($product['createDate']) . "</td>";
                    echo "<td>";
                    echo "<a href='admin.php?controller=product&action=edit&product_id=" . $product['id'] . "' class='btn btn-warning'>Edit</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                
                echo "</table>";
            } else {
                echo "<p>No new products found.</p>";
            }
            
        } catch (Exception $e) {
            echo "<p style='color: red;'>✗ Error: " . $e->getMessage() . "</p>";
        }
        ?>
        
        <hr>
        <p><strong>Debug Info:</strong> This page bypasses the permission system and admin template to test core functionality.</p>
        <p><a href="admin.php?controller=product&action=newproduct">Try Original New Products Page</a></p>
    </div>
</body>
</html>