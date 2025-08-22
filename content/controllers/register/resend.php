<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

if (!empty($_GET['id'])) {
    $option = [
        'order_by' => 'id',
    ];
    $notActiveUsers = getAll('users', $option);
    foreach ($notActiveUsers as $user) {
        if ($user['id'] == $_GET['id']) {
            $email = $user['user_email'];
            $username = $user['user_username'];
            $verificationCode = $user['verificationCode'];
        }
    }
    //send mail
    include 'lib/config/sendmail.php';
    $mail = new PHPMailer(true);

    try {
        $verificationLink = PATH_URL . "index.php?controller=register&action=activate&code=" . $verificationCode;
        //content
    $htmlStr = "";
    $htmlStr .= "Hello " . $username . ' (' . $email . "),<br /><br />";
    $htmlStr .= "Please click the button below to verify your registration and gain access to the admin page of Chi Koi Shop.<br /><br /><br />";
    $htmlStr .= "<a href='{$verificationLink}' target='_blank' style='padding:1em; font-weight:bold; background-color:blue; color:#fff;'>VERIFY EMAIL</a><br /><br /><br />";
    $htmlStr .= "Thank you for becoming a new member of the Chi Koi Shop website.<br><br>";
    $htmlStr .= "Best regards,<br />";
    $htmlStr .= "<a href='https://tanhongit.com/' target='_blank'>By Tan Hong IT</a><br />";
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
        $mail->setFrom(SMTP_UNAME, "Chị Kòi Quán");
        $mail->addAddress($email, $email);     // Add a recipient | name is option tên người nhận
        $mail->addReplyTo(SMTP_UNAME, 'Tân Hồng IT');
        //$mail->addCC('CCemail@gmail.com');
        //$mail->addBCC('BCCemail@gmail.com');
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Verification Users | Quán Chị Kòi | Subscription | By Tân Hồng IT';
        $mail->Body = $htmlStr;
        $mail->AltBody = $htmlStr; //None HTML
        $result = $mail->send();
        if (!$result) {
            $error = "An error occurred while sending the email";
        }
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
    echo "<div style='padding-top: 200px' class='container'><div style='text-align: center;' class='alert alert-success'><strong>Done! The activation code</strong> has been sent to the email: <strong>" . $email . "</strong>. <br><br>Please open your email inbox and click the provided link so you can log in.</div></div>";
    require('content/views/register/result.php');
}
