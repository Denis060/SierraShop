<?php

require_once('admin/models/purchase.php');

global $userNav;

if (!empty($userNav)) {
    $options = [
        'where' => 'status = 2 and user_id =' . $userNav,
        'order_by' => 'createtime DESC',
    ];
    $deliveryOrders = getAll('orders', $options);
    $title = 'Orders In Transit';
    $yourPurchaseNav = 'class="active open"';
    $status = [
        0 => 'Order Confirmed',
        2 => 'In Delivery',
        1 => 'Delivered',
    ];
}

require('admin/views/purchase/delivery.php');
