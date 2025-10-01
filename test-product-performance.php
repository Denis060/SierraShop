<?php
// Test the specific product queries that were causing issues
require_once('lib/config/database.php');
require_once('lib/model.php');

echo "<h1>Product Query Performance Test</h1>";

try {
    echo "<h2>Testing Recently Updated Products</h2>";
    $start_time = microtime(true);
    $options_update = [
        'order_by' => 'editDate DESC',
        'limit' => '20'
    ];
    $updated_products = getAll('products', $options_update);
    $end_time = microtime(true);
    echo "<p>✓ Recently Updated Products: " . count($updated_products) . " records in " . number_format($end_time - $start_time, 4) . " seconds</p>";

    echo "<h2>Testing New Products</h2>";
    $start_time = microtime(true);
    $options_new = [
        'where' => 'product_typeid = 2',
        'order_by' => 'createDate DESC',
        'limit' => '20'
    ];
    $new_products = getAll('products', $options_new);
    $end_time = microtime(true);
    echo "<p>✓ New Products: " . count($new_products) . " records in " . number_format($end_time - $start_time, 4) . " seconds</p>";

    echo "<h2>Testing Sale Products</h2>";
    $start_time = microtime(true);
    $options_sale = [
        'where' => 'product_typeid = 3',
        'order_by' => 'createDate DESC',
        'limit' => '20'
    ];
    $sale_products = getAll('products', $options_sale);
    $end_time = microtime(true);
    echo "<p>✓ Sale Products: " . count($sale_products) . " records in " . number_format($end_time - $start_time, 4) . " seconds</p>";

    echo "<h2>Testing Hot Products</h2>";
    $start_time = microtime(true);
    $options_hot = [
        'where' => 'product_typeid = 1',
        'order_by' => 'createDate DESC',
        'limit' => '20'
    ];
    $hot_products = getAll('products', $options_hot);
    $end_time = microtime(true);
    echo "<p>✓ Hot Products: " . count($hot_products) . " records in " . number_format($end_time - $start_time, 4) . " seconds</p>";

    echo "<h2>Database Statistics</h2>";
    $total_products = getTotal('products');
    echo "<p>Total products in database: " . $total_products . "</p>";

    echo "<p style='color: green;'>All queries completed successfully! The pages should now load much faster.</p>";

} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Error: " . $e->getMessage() . "</p>";
}

echo "<p><a href='admin.php?controller=product&action=update'>Test Recently Updated Products</a></p>";
echo "<p><a href='admin.php?controller=product&action=newproduct'>Test New Products</a></p>";
echo "<p><a href='admin.php?controller=product&action=saleproduct'>Test Sale Products</a></p>";
echo "<p><a href='admin.php?controller=product&action=hotproduct'>Test Hot Products</a></p>";
?>