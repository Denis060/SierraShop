<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

if (!empty($_POST)) {
    $user_add = [
        'id' => 0,
        'user_username' => escape($_POST['username']),
        'user_password' => md5($_POST['password']),
        'user_email' => escape($_POST['email']),
        'createDate' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
    ];
    global $linkConnectDB;
    $username = addslashes($_POST['username']);
    $email = addslashes($_POST['email']);
    $get_user_email_option = [
        'order_by' => 'id',
    ];
    //lấy id người đăng ký để resend
    $user_of_email = getAll('users', $get_user_email_option);
    foreach ($user_of_email as $user) {
        if ($user['user_email'] == $email) {
            $get_userid_of_email = $user['id'];
        }
    }
    $title = 'Registration Result';
    if (mysqli_num_rows(mysqli_query($linkConnectDB, "SELECT user_username FROM users WHERE user_username='$username'")) > 0) {
        echo "<div style='padding-top: 200px' class='container'><div style='text-align: center;' class='alert alert-danger'><strong>NO!</strong> This username is already taken. Please choose another username. <a href='javascript: history.go(-1)'>Go back</a> or <a href='index.php'>Go to Homepage</a></div></div>";
    } elseif ($_POST['confirmPassword'] != $_POST['password']) {
        echo "<div style='padding-top: 200px' class='container'><div style='text-align: center;' class='alert alert-danger'><strong>NO!</strong> There was a problem with your registration. The password confirmation does not match! <br><a href='javascript: history.go(-1)'>Go back</a> or <a href='index.php'>Go to Homepage</a></div></div>";
    } elseif (!preg_match("/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i", $email)) {
        echo "<div style='padding-top: 200px' class='container'><div style='text-align: center;' class='alert alert-danger'><strong>NO!</strong> This email is invalid. Please enter another email. <a href='javascript: history.go(-1)'>Go back</a> or <a href='index.php'>Go to Homepage</a></div></div>";
    } elseif (mysqli_num_rows(mysqli_query($linkConnectDB, "SELECT user_email FROM users WHERE user_email='$email' and verified = 0")) > 0) {
        echo "<div style='padding-top: 200px' class='container'><div style='text-align: center;' class='alert alert-danger'><strong>NO!</strong> This email has been registered but not yet activated. If you have registered with this email before, please check your inbox or spam folder for the confirmation email. Click the link to activate your email. <br><br>Do you want to <a href='index.php?controller=register&action=resend&id=" . $get_userid_of_email . "'>resend the activation code</a>?<br><br>Or if you want to register a new account, <a href='javascript: history.go(-1)'>Go back</a> or <a href='index.php'>Go to Homepage</a></div></div>";
    } elseif (mysqli_num_rows(mysqli_query($linkConnectDB, "SELECT user_email FROM users WHERE user_email='$email'")) > 0) {
        echo "<div style='padding-top: 200px' class='container'><div style='text-align: center;' class='alert alert-danger'><strong>NO!</strong> This email is already in use. Please choose another email. <a href='javascript: history.go(-1)'>Go back</a> or <a href='index.php'>Go to Homepage</a></div></div>";
    } elseif (strlen($_POST['password']) < 8) {
        echo "<div style='padding-top: 200px' class='container'><div style='text-align: center;' class='alert alert-danger'><strong>NO!</strong> There was a problem with your registration. Your password must be at least 8 characters long! <br><a href='javascript: history.go(-1)'>Go back</a> or <a href='index.php'>Go to Homepage</a></div></div>";
    } else {
        // Load Composer's autoloader
        $userId = save('users', $user_add);
        //send mail
        include 'lib/config/sendmail.php';
        $mail = new PHPMailer(true);

        try {
            $verificationCode = md5(uniqid("Your email is not yet active. Click here to activate!", true)); //https://www.php.net/manual/en/function.uniqid
            $verificationLink = PATH_URL . "index.php?controller=register&action=activate&code=" . $verificationCode;
            //content
            $htmlStr = "";
            $htmlStr .= "Hello " . $username . ' (' . $email . "),<br /><br />";
            $htmlStr .= "Please click the button below to verify your registration and gain access to the SierraCart admin page.<br /><br /><br />";
            $htmlStr .= "<a href='{$verificationLink}' target='_blank' style='padding:1em; font-weight:bold; background-color:blue; color:#fff;'>VERIFY EMAIL</a><br /><br /><br />";
            $htmlStr .= "Thank you for becoming a new member of SierraCart website.<br><br>";
            $htmlStr .= "Best regards,<br />";
            $htmlStr .= "<a href='https:ibrahimfofanah.com/' target='_blank'>By Ibrahim Fofanah</a><br />";
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
            $mail->setFrom(SMTP_UNAME, "SierraCart");
            $mail->addAddress($_POST['email'], $email);     // Add a recipient | name is option tên người nhận
            $mail->addReplyTo(SMTP_UNAME, 'Reply Name');
            //$mail->addCC('CCemail@gmail.com');
            //$mail->addBCC('BCCemail@gmail.com');
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Verification Users | SierraCart | Subscription | By Ibrahim Fofanah';
            $mail->Body = $htmlStr;
            $mail->AltBody = $htmlStr; //None HTML
            $result = $mail->send();
            if (!$result) {
                $error = "An error occurred while sending the email";
            }
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
        $verificationCode_add = [
            'id' => $userId,
            'verificationCode' => $verificationCode,
        ];
        save('users', $verificationCode_add);
    echo "<div style='padding-top: 200px' class='container'><div style='text-align: center;' class='alert alert-success'><strong>Done! Activation code</strong> has been sent to email: <strong>" . $email . "</strong>. <br><br>Please check your email inbox and click the provided link to log in. <br><br><br>This unverified email has been saved to the database.</div></div>";
    }
}
require('content/views/register/result.php');
