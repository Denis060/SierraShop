<?php

permission_user();

require_once('admin/models/products.php');

$title = 'Recently Updated Products';
$productNav = 'class="active open"';

require('admin/views/product/update.php');
