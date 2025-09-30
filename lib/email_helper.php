<?php

// Import PHPMailer classes
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

/**
 * Improved email sending function with fallback support
 * @param string $to Recipient email
 * @param string $subject Email subject
 * @param string $htmlBody HTML email body
 * @param string $fromName Sender name
 * @return array Status result
 */
function sendEmailWithFallback($to, $subject, $htmlBody, $fromName = 'Sierra Shop') {
    require_once 'lib/config/sendmail.php';
    
    $mail = new PHPMailer(true);
    
    try {
        // Try primary SMTP first
        return sendEmailAttempt($mail, $to, $subject, $htmlBody, $fromName, false);
        
    } catch (Exception $e) {
        // Log the primary failure
        error_log("Primary SMTP failed: " . $e->getMessage());
        
        try {
            // Try with fallback settings
            return sendEmailAttempt($mail, $to, $subject, $htmlBody, $fromName, true);
            
        } catch (Exception $e) {
            // Both failed, return error
            return [
                'success' => false,
                'error' => 'Both primary and fallback email services failed: ' . $e->getMessage()
            ];
        }
    }
}

/**
 * Attempt to send email with given configuration
 */
function sendEmailAttempt($mail, $to, $subject, $htmlBody, $fromName, $useFallback = false) {
    // Clear any previous configuration
    $mail->clearAddresses();
    $mail->clearAttachments();
    
    // Server settings
    $mail->CharSet = "UTF-8";
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    
    if ($useFallback) {
        // Use fallback configuration
        $mail->Host = defined('SMTP_HOST_FALLBACK') ? SMTP_HOST_FALLBACK : 'smtp.mailtrap.io';
        $mail->Port = defined('SMTP_PORT_FALLBACK') ? SMTP_PORT_FALLBACK : 2525;
        $mail->Username = defined('SMTP_UNAME_FALLBACK') ? SMTP_UNAME_FALLBACK : '';
        $mail->Password = defined('SMTP_PWORD_FALLBACK') ? SMTP_PWORD_FALLBACK : '';
        $mail->SMTPSecure = false; // Mailtrap doesn't use encryption
        $fromEmail = defined('FROM_EMAIL') ? FROM_EMAIL : 'noreply@sierrashop.com';
    } else {
        // Use primary configuration
        $mail->Host = SMTP_HOST;
        $mail->Port = defined('SMTP_PORT') ? SMTP_PORT : 587;
        $mail->Username = SMTP_UNAME;
        $mail->Password = SMTP_PWORD;
        $mail->SMTPSecure = defined('SMTP_SECURE') ? SMTP_SECURE : 'tls';
        $fromEmail = SMTP_UNAME;
    }
    
    $mail->SMTPAuth = true;
    
    // Recipients
    $mail->setFrom($fromEmail, $fromName);
    $mail->addAddress($to);
    $mail->addReplyTo(defined('REPLY_TO') ? REPLY_TO : $fromEmail, $fromName);
    
    // Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $htmlBody;
    $mail->AltBody = strip_tags($htmlBody);
    
    $result = $mail->send();
    
    if ($result) {
        return [
            'success' => true,
            'method' => $useFallback ? 'fallback' : 'primary'
        ];
    } else {
        throw new Exception('Mail sending failed');
    }
}

/**
 * Send password reset email
 */
function sendPasswordResetEmail($email, $username, $verificationCode) {
    $verificationLink = PATH_URL . "index.php?controller=forgot-password&action=resultcode&code=" . $verificationCode;
    
    $htmlStr = "";
    $htmlStr .= "Hello " . $username . ' (' . $email . "),<br /><br />";
    $htmlStr .= "Welcome to Sierra Shop.<br /><br /><br />";
    $htmlStr .= "Please visit the following link to verify your account and start resetting your new password.<br><br>";
    $htmlStr .= "<a href='{$verificationLink}' target='_blank' style='padding:1em; font-weight:bold; background-color:#007bff; color:#fff; text-decoration:none; border-radius:5px;'>Reset Password</a><br /><br /><br />";
    $htmlStr .= "If the button doesn't work, copy and paste this link into your browser:<br>";
    $htmlStr .= $verificationLink . "<br><br>";
    $htmlStr .= "Thank you for using Sierra Shop.<br><br>";
    $htmlStr .= "Best regards,<br />";
    $htmlStr .= "Sierra Shop Team<br />";
    
    $subject = 'Password Reset Request | Sierra Shop';
    
    return sendEmailWithFallback($email, $subject, $htmlStr);
}
