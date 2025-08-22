<?php

if (!empty($_GET['code'])) {

    $selectUserOption = [
        'order_by' => 'id',
    ];
    $userVerifyId = 0;
    $needChangePassUsers = getAll('users', $selectUserOption);
    foreach ($needChangePassUsers as $user) {
        if ($user['verificationCode'] == $_GET['code']) {
            $userVerifyId = 1;
            $userId = $user['id'];
        }
    }
    if ($userVerifyId != 1) {
        echo "<div style='padding-top: 200px' class='container'><div style='text-align: center;' class='alert alert-danger'><strong>Oh No!</strong> The account verification link to change your password is incorrect. Please check again. <br><br>If this is a system error, please send feedback <a href='index.php?controller=feedback'>here</a></div></div>";
        require('content/views/forgot-password/result.php');
    } else {
        header('location:' . PATH_URL . 'index.php?controller=forgot-password&action=change-password&id=' . $userId);
    }
}
