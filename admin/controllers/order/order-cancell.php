<?php

permission_user();

$options = [
    'where' => 'status = 3',
    'order_by' => 'createtime DESC',
];

$orderComplete = getAll('orders', $options);

$title = 'Cancelled Orders';
$orderNav = 'class="active open"';
$status = [
    0 => 'Not Processed',
    1 => 'Processed',
    2 => 'In Process',
    3 => 'Cancelled',
];

require('admin/views/order/order-cancell.php');
