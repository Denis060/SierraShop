<?php

permission_user();

require_once('admin/models/products.php');

$title = 'All Products List';
$productNav = 'class="active open"';

require('admin/views/product/index.php');
