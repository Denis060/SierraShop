<?php

require_once('admin/models/order.php');

if (isset($_GET['order_id'])) {
    $orderId = intval($_GET['order_id']);
} else {
    $orderId = 0;
}

$order = getRecord('orders', $orderId);

if (!$order) {
    show404NotFound();
}

$title = 'Order Details';
$yourPurchaseNav = 'class="active open"';
$orderDetail = orderDetail($orderId);

$status = [
    0 => 'Order Confirmed',
    2 => 'In Delivery',
    1 => 'Delivered',
    3 => 'Order Cancelled',
];

require('admin/views/purchase/view.php');
