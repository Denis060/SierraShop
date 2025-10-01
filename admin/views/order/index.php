<?php require('admin/views/shared/header.php'); ?>
<?php require('admin/views/shared/loader.php'); ?>
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<?php require('admin/views/shared/formsearch.php'); ?>
<?php require('admin/views/shared/rightnavbar.php'); ?>
<?php require('admin/views/shared/leftnavbar.php'); ?>
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Order List</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= PATH_URL . 'home' ?>"><i class="zmdi zmdi-home"></i> SierraShop</a></li>
                        <li class="breadcrumb-item"><a href="admin.php?controller=order">Orders</a></li>
                        <li class="breadcrumb-item active">All Orders List</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Data Retrieval</strong> "All Orders" </h2>
                            <ul class="header-dropdown">
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                    <ul class="dropdown-menu dropdown-menu-right slideUp">
                                        <li><a href="admin.php?controller=order&action=order-cancell">Cancelled Orders</a></li>
                                        <li><a href="admin.php?controller=order&action=order-complete">Completed Orders</a></li>
                                        <li><a href="admin.php?controller=order&action=order-noprocess">Not Processed</a></li>
                                        <li><a href="admin.php?controller=order&action=order-inprocess">Processing</a></li>
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
                                        <?php foreach ($orders as $order) : ?>
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
                                                <td><a href="admin.php?controller=order&amp;action=view&amp;order_id=<?= $order['id']; ?>" class="btn btn-<?php if ($order['status'] == 0) {
                                                    echo 'warning';
                                                } elseif ($order['status'] == 1) {
                                                    echo 'success';
                                                } else {
                                                    echo 'primary';
                                                } ?> waves-effect waves-float btn-sm waves-green"><i class="zmdi zmdi-<?php if ($order['status'] == 0) {
                                                    echo 'eyedropper';
                                                } elseif ($order['status'] == 1) {
                                                    echo 'eye';
                                                } else {
                                                    echo 'assignment-check';
                                                } ?>"></i></a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require('admin/views/shared/footer.php'); ?>
