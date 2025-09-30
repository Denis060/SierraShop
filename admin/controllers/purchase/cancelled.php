<?php

require_once('admin/models/purchase.php');

global $userNav;

if (!empty($userNav)) {
    $options = [
        'where' => 'status = 3 and user_id =' . $userNav,
        'order_by' => 'createtime DESC',
    ];
    $cancelledOrders = getAll('orders', $options);
    $title = 'Cancelled Orders';
    $yourPurchaseNav = 'class="active open"';
    $status = [
        0 => 'Order Confirmed',
        2 => 'Đang giao hàng',
        1 => 'Đã giao hàng',
        3 => 'Order Cancelled',
    ];
}

require('admin/views/purchase/cancelled.php');
