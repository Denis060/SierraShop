<?php

permission_user();

require_once('admin/models/users.php');
$title = 'Personal Information';
$nav_profile = $nav_user = 'class="active open"';
global $linkConnectDB;
if (isset($_GET['user_id'])) {
    $userId = intval($_GET['user_id']);
} else {
    $userId = 0;
}
if (mysqli_num_rows(mysqli_query($linkConnectDB, "SELECT id FROM users WHERE id='$userId'")) == 0) {
    echo "<div style='padding-top: 200px' class='container'><div class='alert alert-danger' style='text-align: center;'><strong>NO!</strong> This user does not exist. <a href='javascript: history.go(-1)'>Go back</a></div></div>";
    require('admin/views/user/result.php');
    exit;
}
global $userNav;
$loginUser = getRecord('users', $userNav);
if ($userId != $userNav && $loginUser['role_id'] == 0) {
    header('location:index.php');
    exit;
} elseif ($userId != $userNav && $loginUser['role_id'] == 2) {
    header('location:admin.php');
    exit;
}
$user_info = getRecord('users', $userId);
require('admin/views/user/info.php');
