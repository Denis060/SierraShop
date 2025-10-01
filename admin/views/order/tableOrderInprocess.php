<?php
$options = [
    'where' => 'status = 2',
    'order_by' => 'createtime DESC',
];
$orderInProcess = getAll('orders', $options);
$status = [
    0 => 'Not Processed',
    1 => 'Processed',
    2 => 'Processing',
]; ?>
<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Data Retrieval</strong> "Orders in Process" </h2>
                <ul class="header-dropdown">
                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-right slideUp">
                            <li><a href="admin.php?controller=order&action=order-cancell">Cancelled Orders</a></li>
                            <li><a href="admin.php?controller=order&action=order-complete">Completed Orders</a></li>
                            <li><a href="admin.php?controller=order&action=order-noprocess">Not Processed</a></li>
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
                                <th>Customer Name</th>
                                <th>Username | User ID</th>
                                <th>Order Date</th>
                                <th>Total Order Value</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Customer Name</th>
                                <th>Username | User ID</th>
                                <th>Order Date</th>
                                <th>Total Order Value</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($orderInProcess as $order) : ?>
                                <tr>
                                    <td><?= $order['id'] ?></td>
                                    <td><a href="admin.php?controller=order&amp;action=view&amp;order_id=<?= $order['id']; ?>"><?= $order['customer']; ?></a></td>
                                    <?php if ($order['user_id'] <> 0) : $user_order = getRecord('users', $order['user_id']) ?>
                                        <td><?= $user_order ? ($user_order['user_username'] . ' | ' . $user_order['id']) : 'User not found' ?></td>
                                    <?php else : ?>
                                        <td></td>
                                    <?php endif; ?>
                                    <td><?= $order['createtime'] ?></td>
                                    <td><?= number_format($order['cart_total'], 0, ',', '.') ?></td>
                                    <td><?= $status[$order['status']]; ?></td>
                                    <td><a href="admin.php?controller=order&amp;action=view&amp;order_id=<?= $order['id']; ?>" class="btn btn-warning waves-effect waves-float btn-sm waves-green"><i class="zmdi zmdi-assignment-check"></i></a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
