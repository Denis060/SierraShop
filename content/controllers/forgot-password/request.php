<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

if (!empty($_POST['email'])) {
    $email = $_POST['email'];
    global $linkConnectDB;
    if (!preg_match("/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i", $email)) {
        echo "<div style='padding-top: 200px' class='container'><div style='text-align: center;' class='alert alert-danger'><strong>NO!</strong> This email is not valid. Please enter another email. <a href='javascript: history.go(-1)'>Go back</a> or <a href='index.php'>Go to Homepage</a></div></div>";
        require('content/views/forgot-password/result.php');
        exit;
    } elseif (mysqli_num_rows(mysqli_query($linkConnectDB, "SELECT user_email FROM users WHERE user_email='$email'")) < 1) {
        echo "<div style='padding-top: 200px' class='container'><div style='text-align: center;' class='alert alert-danger'><strong>NO!</strong> This email does not belong to any user and does not exist on the server. Please choose another email. <a href='javascript: history.go(-1)'>Go back</a> or <a href='index.php'>Go to Homepage</a></div></div>";
        require('content/views/forgot-password/result.php');
        exit;
    } else {
        $option = [
            'order' => 'id',
        ];
        $users = getAll('users', $option);
        foreach ($users as $user) {
            if ($user['user_email'] == $email) {
                $verificationCode = $user['verificationCode'];
            }
        }
        include 'lib/config/sendmail.php';
        $mail = new PHPMailer(true);

        try {
            $verificationLink = PATH_URL . "index.php?controller=forgot-password&action=resultcode&code=" . $verificationCode;
            //content
            $htmlStr = "";
            $htmlStr .= "Hello " . $username . ' (' . $email . "),<br /><br />";
            $htmlStr .= "Welcome to Sierra Shop.<br /><br /><br />";
            $htmlStr .= "Please visit the following link to verify your account and start resetting your new password.<br><br>";
            $htmlStr .= "<a href='{$verificationLink}' target='_blank' style='padding:1em; font-weight:bold; background-color:blue; color:#fff;'>Change New Password</a><br /><br /><br />";
            $htmlStr .= "Thank you for joining and supporting Sierra Shop.<br><br>";
            $htmlStr .= "Sincerely,<br />";
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
            $mail->setFrom(SMTP_UNAME, "Sierra Shop");
            $mail->addAddress($email, $email);     // Add a recipient | name is option tên người nhận
            $mail->addReplyTo(SMTP_UNAME, 'Sierra Shop');
            //$mail->addCC('CCemail@gmail.com');
            //$mail->addBCC('BCCemail@gmail.com');
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Forgot Password | Sierra Shop | Reset your Password | By SmartWave Media';
            $mail->Body = $htmlStr;
            $mail->AltBody = $htmlStr; //None HTML
            $result = $mail->send();
            if (!$result) {
                $error = "An error occurred while sending the email.";
            }
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    echo "<div style='padding-top: 200px' class='container'><div style='text-align: center;' class='alert alert-success'><strong>Done!</strong> You will receive a password reset confirmation email at the email address you just entered.<br><br> Please check your inbox and confirm the password reset link there!</div></div>";
    require('content/views/forgot-password/result.php');
    }
}
