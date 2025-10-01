<?php
// Add error handling and limit for performance
error_log("Starting hot products query...");
$start_time = microtime(true);

try {
    $options = [
        'where' => 'product_typeid = 1',
        'order_by' => 'createDate DESC',
        'limit' => '20'  // Limit to 20 products for faster loading
    ];
    $products = getAll('products', $options);
    
    $end_time = microtime(true);
    $execution_time = $end_time - $start_time;
    error_log("Hot products query completed in: " . $execution_time . " seconds");
    error_log("Number of hot products retrieved: " . count($products));
    
} catch (Exception $e) {
    error_log("Error in hot products query: " . $e->getMessage());
    $products = [];
}
?>
<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Data Retrieval</strong> Featured Products </h2>
                <ul class="header-dropdown">
                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-right slideUp">
                            <li><a href="admin.php?controller=product&action=edit">Add New Product</a></li>
                        </ul>
                    </li>
                    <li class="remove">
                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Discounted Price</th>
                                <th>Created Date</th>
                                <th>Thumbnail</th>
                                <th>Total Views</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Discounted Price</th>
                                <th>Created Date</th>
                                <th>Thumbnail</th>
                                <th>Total Views</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($products as $product) : ?>
                                <tr>
                                    <td><?= $product['id'] ?></td>
                                    <td><a href="admin.php?controller=product&amp;action=edit&amp;product_id=<?= $product['id']; ?>"><?= $product['product_name']; ?></a></td>
                                    <td><?= $product ? number_format($product['product_price'], 0, ',', '.') : 0; ?></td>
                                    <td><?php if ($product["saleoff"] == 1) {
                                        echo number_format(($product['product_price'] - (($product['product_price']) * ($product['percentoff']) / 100)), 0, ',', '.');
                                    } ?></td>
                                    <td><?= $product['createDate'] ?></td>
                                    <td><?= '<image src="public/upload/products/' . $product['img1'] . '?time=' . time() . '" style="max-width:50px;" />'; ?></td>
                                    <td><?= $product['totalView'] ?></td>
                                    <td><a href="product/<?= $product['id']; ?>-<?= $product['slug'] ?>" target="_blank" class="btn btn-success waves-effect waves-float btn-sm waves-green"><i class="zmdi zmdi-eye"></i></a>
                                        <a href="admin.php?controller=product&amp;action=edit&amp;product_id=<?= $product['id']; ?>" class="btn btn-warning waves-effect waves-float btn-sm waves-green"><i class="zmdi zmdi-edit"></i></a>
                                        <a onclick="return confirm('Are you sure to delete?')" href="admin.php?controller=product&amp;action=delete&amp;product_id=<?= $product['id'] ?>" class="btn btn-danger waves-effect waves-float btn-sm waves-red"><i class="zmdi zmdi-delete"></i></a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
