<?php

permission_user();

$options = [
    'where' => 'status = 1',
    'order_by' => 'createtime DESC',
];
$orderComplete = getAll('orders', $options);

$title = 'Processed Orders';
$orderNav = 'class="active open"';
$status = [
    0 => 'Not Processed',
    1 => 'Processed',
    2 => 'In Process',
];
require('admin/views/order/order-complete.php');
