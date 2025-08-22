<?php

permission_user();
permission_moderator();

require_once('admin/models/category.php');

$options = [
    'order_by' => 'id',
];
$title = 'Product Categories';
$subCategoryData = getAll('subcategory', $options);
$navCategory = 'class="active open"';

require('admin/views/category/index.php');
