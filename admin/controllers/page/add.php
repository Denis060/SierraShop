<?php

permission_user();

require_once('admin/models/posts.php');

if (!empty($_POST)) {
    page_add();
}

if (isset($_GET['post_id'])) {
    $postId = intval($_GET['post_id']);
} else {
    $postId = 0;
}

$post = getRecord('posts', $postId);
$pageNav = 'class="active open"';
$title = 'Add New Page - SierraShop';

require('admin/views/page/add.php');
