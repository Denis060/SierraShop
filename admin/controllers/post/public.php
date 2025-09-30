<?php

permission_user();

require_once('admin/models/posts.php');

$postId = intval($_GET['post_id']);

$post = getRecord('posts', $postId);
global $userNav;
$loginUser = getRecord('users', $userNav);

if ($loginUser['role_id'] == 2) {
    if ($post['post_author'] == $userNav) {
        publicPost($postId);
        require('admin/views/post/result.php');
    } else {
        header('location:admin.php?controller=post');
    }
} else {
    publicPost($postId);
    echo '<div style="padding-top: 200px" class="container"><div class="alert alert-success" style="text-align: center;"><strong>Success!</strong> You have successfully changed the post status to "Public". This post is now visible to users.<br><br> Go to <a href="admin.php?controller=post">All Posts</a> or <a href="javascript: history.go(-1)">Go Back</a>!</div></div>';
    require('admin/views/post/result.php');
}
