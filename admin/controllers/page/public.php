<?php

permission_user();

require_once('admin/models/posts.php');

$pageId = intval($_GET['post_id']);

$post = getRecord('posts', $pageId);
global $userNav;
$loginUser = getRecord('users', $userNav);

if ($loginUser['role_id'] == 2) {
    if ($post['post_author'] == $userNav) {
        publicPost($pageId);
        require('admin/views/page/result.php');
    } else {
        header('location:admin.php?controller=page');
    }
} else {
    publicPost($pageId);
    echo '<div style="padding-top: 200px" class="container"><div class="alert alert-success" style="text-align: center;"><strong>Success!</strong> You have successfully changed the page status to "Public". This page is now visible to users.<br><br> Go to <a href="admin.php?controller=page">All Pages</a> or <a href="javascript: history.go(-1)">Go Back</a>!</div></div>';
    require('admin/views/page/result.php');
}
