<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

function userLogin($input, $password)
{
    global $linkConnectDB;
    //autoselect login with username or email : https://stackoverflow.com/questions/16436704/login-with-username-or-email

    // //cách 1
    // if (filter_var($input, FILTER_VALIDATE_EMAIL)) { //https://www.php.net/manual/pt_BR/function.filter-var.php
    //     $type = "user_email";
    // } else {
    //     $type = "user_username";
    // }
    // $sql = "SELECT * FROM users WHERE $type='$input' AND user_password='$password' LIMIT 0,1";

    // //cách 2
    // if (stripos($input, '@') !== FALSE) {
    //     $sql = "SELECT * FROM users WHERE user_email = '$input' AND user_password='$password' LIMIT 0,1";
    // } else {
    //     $sql = "SELECT * FROM users WHERE user_username = '$input' AND user_password='$password' LIMIT 0,1";
    // }

    //cách 3
    $sql = "SELECT * FROM `users` WHERE (LOWER(`user_username`)='" . strtolower($input) . "' OR
    LOWER(`user_email`)='" . strtolower($input) . "') AND `user_password`='" . $password . "'";

    $query = mysqli_query($linkConnectDB, $sql) or die(mysqli_error($linkConnectDB));
    if (mysqli_num_rows($query) > 0) {
        $_SESSION['user'] = mysqli_fetch_assoc($query);
        global $userNav;
        $userNav = $_SESSION['user']['id'];

        return true;
    }

    return false;
}
function userDestroy($id)
{
    $user = getRecord('users', $id);
    $image = 'public/upload/images/' . $user['user_avatar'];
    if (is_file($image)) {
        unlink($image);
    }
    global $linkConnectDB;
    $id = intval($id);
    $sql = "DELETE FROM users WHERE id=$id";
    mysqli_query($linkConnectDB, $sql) or die(mysqli_error($linkConnectDB));
}
function changePassword($id, $newpassword, $currentPassword)
{
    global $linkConnectDB;
    $sql = "Update users SET user_password='$newpassword' WHERE id='$id' AND user_password = '$currentPassword'";
    mysqli_query($linkConnectDB, $sql) or die(mysqli_error($linkConnectDB));
    $rows = mysqli_affected_rows($linkConnectDB); //Gets the number of affected rows in a previous MySQL operation
    if ($rows <> 1) {
        return  "<div style='padding-top: 200px' class='container'><div class='alert alert-danger' style='text-align: center;'><strong>NO!</strong> There was a problem changing the password. You entered the current password incorrectly!! <br><a href='javascript: history.go(-1)'>Go back</a> or <a href='admin.php'>Go to Dashboard</a></div></div>" . mysqli_error($linkConnectDB);
    } else {
        $options = [
            'id' => $id,
            'user_password' => $newpassword,
            'editTime' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),

        ];
        save('users', $options);
        //sendmail
        include 'lib/config/sendmail.php';
        $mail = new PHPMailer(true);
        $user = getRecord('users', $id);
        $email = $user['user_email'];

        try {
            //content
            $htmlStr = "";
            $htmlStr .= "Hello " . $user['user_username'] . ' (' . $email . "),<br /><br />";
            $htmlStr .= "Your password has just been changed...<br /><br />";
            $htmlStr .= "Please check and <a href='" . PATH_URL . "admin.php'>Login</a></div> again with your new password.<br><br>";
            $htmlStr .= "Regards,<br />";
            $htmlStr .= "<a href='https://ibrahimfofanah.com/' target='_blank'>By SmartWave Media</a><br />";
            //Server settings
            $mail->CharSet = "UTF-8";
            $mail->SMTPDebug = 0; // Enable verbose debug output (0 : ko hiện debug, 1 hiện)
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = SMTP_HOST;  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = SMTP_UNAME; // SMTP username
            $mail->Password = SMTP_PWORD; // SMTP password
            $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
            $mail->Port = SMTP_PORT; // TCP port to connect to
            //Recipients
            $mail->setFrom(SMTP_UNAME, "SaloneCart");
            $mail->addAddress($email, $email);     // Add a recipient | name is option tên người nhận
            $mail->addReplyTo(SMTP_UNAME, 'SmartWave Media');
            //$mail->addCC('CCemail@gmail.com');
            //$mail->addBCC('BCCemail@gmail.com');
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'You have Change your Password | SaloneCart | By SmartWave Media';
            $mail->Body = $htmlStr;
            $mail->AltBody = $htmlStr; //None HTML
            $result = $mail->send();
            if (!$result) {
                $error = "An error occurred while sending mail";
            }
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

    return '<div style="padding-top: 200px" class="container"><div class="alert alert-success" style="text-align: center;"><strong>Good!</strong> You have successfully changed your password. A notification message has been sent to this user\'s email. Please <a href="admin.php?controller=home&action=logout">Logout</a> and log in again.!!</div></div>';
    }
}
function user_update()
{
    global $userNav;
    $userLogin = getRecord('users', $userNav);
    if ($_POST['user_id'] <> 0) {
        $editTime = gmdate('Y-m-d H:i:s', time() + 7 * 3600);
    } else {
        $editTime = '0000-00-00 00:00:00';
    }

    if (isset($_POST['roleid']) && $userLogin['role_id'] == 1) {
        $roleid = $_POST['roleid'];
    } else {
        $roleid = $userLogin['role_id'];
    }

    $user_edit = [
        'id' => intval($_POST['user_id']),
        'user_email' => escape($_POST['email']),
        'user_username' => escape($_POST['username']),
        'user_name' => escape($_POST['name']),
        'user_address' => escape($_POST['address']),
        'user_phone' => escape($_POST['phone']),
        'editTime' => $editTime,
        'role_id' => $roleid,
    ];
    global $linkConnectDB;
    $email_check = addslashes($_POST['email']);
    $id_check = intval($_POST['user_id']);
    if (mysqli_num_rows(mysqli_query($linkConnectDB, "SELECT user_email FROM users WHERE user_email='$email_check'")) != 0 && mysqli_num_rows(mysqli_query($linkConnectDB, "SELECT user_email FROM users WHERE id='$id_check' AND user_email='$email_check'")) <> 1) {
        echo "<div style='padding-top: 200px' class='container'><div class='alert alert-danger' style='text-align: center;'><strong>NO!</strong> Email này đã có người dùng. Vui lòng chọn Email khác. <a href='javascript: history.go(-1)'>Trở lại</a></div></div>";
        require('admin/views/user/result.php');
        exit;
    } else {
        $get_currentEmail_user = getRecord('users', $_POST['user_id']);
        $currentEmail = $get_currentEmail_user['user_email'];
        $userId = save('users', $user_edit);
        $avatar_name = 'avatar-user' . $userId . '-' . slug($_POST['username']);
        $config = [
            'name' => $avatar_name,
            'upload_path' => 'public/upload/images/',
            'allowed_exts' => 'jpg|jpeg|png|gif',
        ];
        $avatar = upload('imagee', $config);
        //cập nhật ảnh mới
        if ($avatar) {
            $user_edit = [
                'id' => $userId,
                'user_avatar' => $avatar,
            ];
            save('users', $user_edit);
        }
        $user_edited = getRecord('users', $userId);
        if ($user_edited['user_email'] != $currentEmail) {
            //send mail
            include 'lib/config/sendmail.php';
            $email = $user_edited['user_email'];
            $mail = new PHPMailer(true);

            try {
                $verificationCode = md5(uniqid("Your email has just been changed and is not yet active. Click here to activate! Love you 3000", true)); //https://www.php.net/manual/en/function.uniqid
                $verificationLink = PATH_URL . "index.php?controller=register&action=reactivate&code=" . $verificationCode;
                //content
                $htmlStr = "";
                $htmlStr .= "Hello " . $user_edited['user_name'] . " (" . $user_edited['user_username']  . "),<br /><br />";
                $htmlStr .= "Did you just change your email for your account? Please click the button below to verify your email change and gain access to the Chi Koi Shop admin page.<br /><br /><br />";
                $htmlStr .= "<a href='{$verificationLink}' target='_blank' style='padding:1em; font-weight:bold; background-color:blue; color:#fff;'>VERIFY EMAIL</a><br /><br /><br />";
                $htmlStr .= "Thank you for joining the Chi Koi Shop website.<br><br>";
                $htmlStr .= "Regards,<br />";
                $htmlStr .= "<a href='https://ibrahimfofanah.com/' target='_blank'>By Ibrahim Fofanah</a><br />";
                //Server settings
                $mail->CharSet = "UTF-8";
                $mail->SMTPDebug = 0; // Enable verbose debug output (0 : ko hiện debug, 1 hiện)
                $mail->isSMTP(); // Set mailer to use SMTP
                $mail->Host = SMTP_HOST;  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true; // Enable SMTP authentication
                $mail->Username = SMTP_UNAME; // SMTP username
                $mail->Password = SMTP_PWORD; // SMTP password
                $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
                $mail->Port = SMTP_PORT; // TCP port to connect to
                //Recipients
                $mail->setFrom(SMTP_UNAME, "SaloneCart");
                $mail->addAddress($email, $email);     // Add a recipient | name is option tên người nhận
                $mail->addReplyTo(SMTP_UNAME, 'Reply Name');
                //$mail->addCC('CCemail@gmail.com');
                //$mail->addBCC('BCCemail@gmail.com');
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = 'Verification New Email | SaloneCart | Change Email | By Ibrahim Fofanah';
                $mail->Body = $htmlStr;
                $mail->AltBody = $htmlStr; //None HTML
                $result = $mail->send();
                if (!$result) {
                    $error = "An error occurred while sending mail";
                }
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
            $verificationCode_add = [
                'id' => $userId,
                'verificationCode' => $verificationCode,
                'verified' => 0,
            ];
            save('users', $verificationCode_add);
        }
        header('location:admin.php?controller=user&action=info&user_id=' . intval($_POST['user_id']));
    }
}
function user_add()
{
    $user_add = [
        'id' => intval($_POST['user_id']),
        'user_username' => escape($_POST['username']),
        'user_password' => md5($_POST['password']),
        'user_email' => escape($_POST['email']),
        'role_id' => escape($_POST['roleid']),
        'user_name' => escape($_POST['name']),
        'user_address' => escape($_POST['address']),
        'createDate' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
        'user_phone' => escape($_POST['phone']),
    ];
    global $linkConnectDB;
    $username = addslashes($_POST['username']);
    $email = addslashes($_POST['email']);
    //https://freetuts.net/xay-dung-chuc-nang-dang-nhap-va-dang-ky-voi-php-va-mysql-85.html
    if (mysqli_num_rows(mysqli_query($linkConnectDB, "SELECT user_username FROM users WHERE user_username='$username'")) > 0) {
        echo "<div style='padding-top: 200px' class='container'><div class='alert alert-danger' style='text-align: center;'><strong>NO!</strong> This username is already taken. Please choose another username. <a href='javascript: history.go(-1)'>Go back</a></div></div>";
        require('admin/views/user/addresult.php');
        exit;
    } elseif (!preg_match("/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i", $email)) {
        echo "<div style='padding-top: 200px' class='container'><div class='alert alert-danger' style='text-align: center;'><strong>NO!</strong> This email is invalid. Please enter another email. <a href='javascript: history.go(-1)'>Go back</a></div></div>";
        require('admin/views/user/addresult.php');
        exit;
    } elseif (strlen($_POST['password']) < 8) {
        echo "<div style='padding-top: 200px' class='container'><div style='text-align: center;' class='alert alert-danger'><strong>NO!</strong> Your password must be at least 8 characters long!! <br><a href='javascript: history.go(-1)'>Go back</a></div></div>";
        exit;
    } elseif (mysqli_num_rows(mysqli_query($linkConnectDB, "SELECT user_email FROM users WHERE user_email='$email'")) > 0) {
        echo "<div style='padding-top: 200px' class='container'><div class='alert alert-danger' style='text-align: center;'><strong>NO!</strong> This email is already in use. Please choose another email. <a href='javascript: history.go(-1)'>Go back</a></div></div>";
        require('admin/views/user/addresult.php');
        exit;
    } else {
        $userId = save('users', $user_add);
        $avatar_name = 'avatar-user' . $userId . '-' . slug($_POST['username']);
        $config = [
            'name' => $avatar_name,
            'upload_path' => 'public/upload/images/',
            'allowed_exts' => 'jpg|jpeg|png|gif',
        ];
        $avatar = upload('imagee', $config);
        if ($avatar) {
            $user_add = [
                'id' => $userId,
                'user_avatar' => $avatar,
            ];
            save('users', $user_add);
        }
        //send mail
        include 'lib/config/sendmail.php';
        $mail = new PHPMailer(true);

        try {
            $verificationCode = md5(uniqid("Your email has just been changed and is not yet active. Click here to activate! Love you 3000", true)); //https://www.php.net/manual/en/function.uniqid
            $verificationLink = PATH_URL . "index.php?controller=register&action=activate&code=" . $verificationCode;
            //content
            $htmlStr = "";
            $htmlStr .= "Hello " . $email . "),<br /><br />";
            $htmlStr .= "Please click the button below to verify your registration and gain access to the Chi Koi Shop admin page.<br /><br /><br />";
            $htmlStr .= "<a href='{$verificationLink}' target='_blank' style='padding:1em; font-weight:bold; background-color:blue; color:#fff;'>VERIFY EMAIL</a><br /><br /><br />";
            $htmlStr .= "Thank you for joining as a new member of the Chi Koi Shop website.<br><br>";
            $htmlStr .= "Regards,<br />";
            $htmlStr .= "<a href='https://ibrahimfofanah.com/' target='_blank'>By Ibrahim Fofanah</a><br />";
            //Server settings
            $mail->CharSet = "UTF-8";
            $mail->SMTPDebug = 0; // Enable verbose debug output (0 : ko hiện debug, 1 hiện)
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = SMTP_HOST;  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = SMTP_UNAME; // SMTP username
            $mail->Password = SMTP_PWORD; // SMTP password
            $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
            $mail->Port = SMTP_PORT; // TCP port to connect to
            //Recipients
            $mail->setFrom(SMTP_UNAME, "SaloneCart");
            $mail->addAddress($email, $email);     // Add a recipient | name is option tên người nhận
            $mail->addReplyTo(SMTP_UNAME, 'Reply Name');
            //$mail->addCC('CCemail@gmail.com');
            //$mail->addBCC('BCCemail@gmail.com');
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Verification Users | SaloneCart | Subscription | By Ibrahim Fofanah';
            $mail->Body = $htmlStr;
            $mail->AltBody = $htmlStr; //None HTML
            $result = $mail->send();
            if (!$result) {
                $error = "An error occurred while sending mail";
            }
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
        $verificationCode_add = [
            'id' => $userId,
            'verificationCode' => $verificationCode,
            'verified' => 0,
        ];
        save('users', $verificationCode_add);
        header('location:admin.php?controller=user&action=info&user_id=' . $userId);
    }
}
