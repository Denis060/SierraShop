<?php

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

// Include improved email helper
require_once 'lib/email_helper.php';

if (!empty($_POST['email'])) {
    $email = escape($_POST['email']);
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
        $verificationCode = '';
        $username = '';
        
        foreach ($users as $user) {
            if ($user['user_email'] == $email) {
                $verificationCode = $user['verificationCode'];
                $username = $user['user_username'];
                break;
            }
        }
        
        // Use improved email sending function
        $emailResult = sendPasswordResetEmail($email, $username, $verificationCode);
        
        if ($emailResult['success']) {
            $method = $emailResult['method'] == 'fallback' ? ' (using backup email service)' : '';
            echo "<div style='padding-top: 200px' class='container'><div style='text-align: center;' class='alert alert-success'><strong>DONE!</strong> You will receive a password reset confirmation email at the email address you just entered{$method}.<br><br>Please check your inbox and confirm the password reset link there!</div></div>";
        } else {
            echo "<div style='padding-top: 200px' class='container'><div style='text-align: center;' class='alert alert-danger'><strong>ERROR!</strong> Failed to send password reset email. Please try again later or contact support.<br><br>Error details: " . $emailResult['error'] . "</div></div>";
        }
        
        require('content/views/forgot-password/result.php');
    }
}
