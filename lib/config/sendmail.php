<?php
error_reporting(0);

// Primary SMTP Configuration (Gmail)
define("SMTP_HOST", $_ENV['SMTP_HOST'] ?? 'smtp.gmail.com');
define("SMTP_PORT", $_ENV['SMTP_PORT'] ?? '587'); // Use TLS instead of SSL
define("SMTP_SECURE", $_ENV['SMTP_SECURE'] ?? 'tls'); // TLS encryption
define("SMTP_UNAME", $_ENV['SMTP_UNAME'] ?? 'your-email@gmail.com'); // Replace with your email
define("SMTP_PWORD", $_ENV['SMTP_PWORD'] ?? 'your-app-password'); // Replace with your app password

// Fallback SMTP Configuration (Alternative service)
define("SMTP_HOST_FALLBACK", $_ENV['SMTP_HOST_FALLBACK'] ?? 'smtp.mailtrap.io');
define("SMTP_PORT_FALLBACK", $_ENV['SMTP_PORT_FALLBACK'] ?? '2525');
define("SMTP_UNAME_FALLBACK", $_ENV['SMTP_UNAME_FALLBACK'] ?? 'your-mailtrap-username');
define("SMTP_PWORD_FALLBACK", $_ENV['SMTP_PWORD_FALLBACK'] ?? 'your-mailtrap-password');

// Email settings
define("FROM_EMAIL", $_ENV['FROM_EMAIL'] ?? 'noreply@sierrashop.com');
define("FROM_NAME", $_ENV['FROM_NAME'] ?? 'Sierra Shop');
define("REPLY_TO", $_ENV['REPLY_TO'] ?? 'support@sierrashop.com');
