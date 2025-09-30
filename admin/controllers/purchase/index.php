<?php

require_once('admin/models/purchase.php');

global $userNav;

if (!empty($userNav)) {
    $options = [
        'where' => 'user_id =' . $userNav,
        'order_by' => 'createtime DESC',
    ];
    $orders = getAll('orders', $options);
    $title = 'All Your Orders';
    $yourPurchaseNav = 'class="active open"';
    $status = [
        0 => 'Order Confirmed',
        2 => 'In Delivery',
        1 => 'Delivered',
        3 => 'Order Cancelled',
    ];
}

require('admin/views/purchase/index.php');
