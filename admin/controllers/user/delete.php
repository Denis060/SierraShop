<?php

permission_user();
require_once('admin/models/users.php');
$userId = intval($_GET['user_id']);
global $userNav;
$user = getRecord('users', $userNav);
if ($_GET['user_id'] == $userNav || $user['role_id'] <> 1) {
    echo '<div style="padding-top: 200px" class="container"><div class="alert alert-danger" style="text-align: center;"><strong>Error!</strong> You do not have permission or are not allowed to delete this user.<br><br> Please <a href="javascript: history.go(-1)">Go back</a> .!!</div></div>';
    require('admin/views/user/result.php');
    exit;
} else {
    userDestroy($userId);
}
header('location:admin.php?controller=user&action=listall');
