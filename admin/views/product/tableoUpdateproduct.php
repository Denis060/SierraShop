<?php

$options_product_update = [
    'order_by' => 'editDate DESC',
];
$total_product_update = getAll('products', $options_product_update); ?>
<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Data Retrieval <strong>Recently Updated Products</strong></h2>
                <ul class="header-dropdown">
                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-right slideUp">
                            <li><a href="admin.php?controller=product&action=edit">Add New Product</a></li>
                            <li><a href="admin.php?controller=product&action=newproduct">New Products</a></li>
                            <li><a href="admin.php?controller=product&action=saleproduct">Sale Products</a></li>
                            <li><a href="admin.php?controller=product&action=hotproduct">Hot Products</a></li>
                        </ul>
                    </li>
                    <li class="remove">
                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Created Date</th>
                                <th>Update Time</th>
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
                                <th>Created Date</th>
                                <th>Update Time</th>
                                <th>Thumbnail</th>
                                <th>Total Views</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($total_product_update as $product) : ?>
                                <tr>
                                    <td><?= $product['id'] ?></td>
                                    <td><a href="admin.php?controller=product&amp;action=edit&amp;product_id=<?= $product['id']; ?>"><?= $product['product_name']; ?></a></td>
                                    <td><?= $product ? number_format($product['product_price'], 0, ',', '.') : 0; ?></td>
                                    <td><?= $product['createDate'] ?></td>
                                    <td><?= getTime($product['editDate'], gmdate('Y:m:d H:i:s', time() + 7 * 3600)) ?></td>
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
