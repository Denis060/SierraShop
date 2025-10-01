<!DOCTYPE html>
<html>
<head>
    <title>Simple New Products Test</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <h1>Simple New Products Test</h1>
    <p>This page bypasses the admin template to test if the core functionality works.</p>
    
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    try {
        require_once('lib/config/database.php');
        require_once('lib/model.php');
        
        echo "<p class='success'>✓ Files loaded successfully</p>";
        
        $start_time = microtime(true);
        
        $options = [
            'where' => 'product_typeid = 2',
            'order_by' => 'createDate DESC',
            'limit' => '10'
        ];
        
        $products = getAll('products', $options);
        
        $end_time = microtime(true);
        $execution_time = $end_time - $start_time;
        
        echo "<p class='success'>✓ Query completed in " . number_format($execution_time, 4) . " seconds</p>";
        echo "<p class='success'>✓ Found " . count($products) . " new products</p>";
        
        if (!empty($products)) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Product Name</th><th>Price</th><th>Created Date</th></tr>";
            
            foreach ($products as $product) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($product['id']) . "</td>";
                echo "<td>" . htmlspecialchars($product['product_name']) . "</td>";
                echo "<td>" . number_format($product['product_price'], 0, ',', '.') . "</td>";
                echo "<td>" . htmlspecialchars($product['createDate']) . "</td>";
                echo "</tr>";
            }
            
            echo "</table>";
        } else {
            echo "<p>No new products found.</p>";
        }
        
    } catch (Exception $e) {
        echo "<p class='error'>✗ Error: " . $e->getMessage() . "</p>";
        echo "<p class='error'>Stack trace: " . $e->getTraceAsString() . "</p>";
    }
    ?>
    
    <hr>
    <p><a href="debug-loading.php">← Back to Debug Page</a></p>
    <p><a href="admin.php?controller=product&action=newproduct">→ Try Original New Products Page</a></p>
</body>
</html>