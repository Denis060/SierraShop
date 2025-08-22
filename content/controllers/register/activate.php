<?php

if (!empty($_GET['code'])) {
    $selectUserOption = [
        'order_by' => 'id',
    ];
    $user_need_activate = getAll('users', $selectUserOption);
    foreach ($user_need_activate as $user) {
        if ($user['verificationCode'] == $_GET['code']) {
            $userVerifyId = $user['id'];
        }
    }
    if (!isset($userVerifyId)) {
        show404NotFound();
    }
    $user_edit = [
        'id' => $userVerifyId,
        'verified' => 1,
    ];
    save('users', $user_edit);
    echo "<div style='padding-top: 200px' class='container'><div style='text-align: center;' class='alert alert-success'><strong>Done!</strong> Your account has been successfully activated. You can now log in to the Chị Kòi shop website. Please go to <a href='admin.php'>Login</a></div></div>";
    require('content/views/register/result.php');
}
