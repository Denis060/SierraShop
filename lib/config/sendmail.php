<?php
error_reporting(0);

define("SMTP_HOST", $_ENV['SMTP_HOST'] ?? 'smtp.gmail.com');

define("SMTP_PORT", $_ENV['SMTP_PORT'] ?? '465');

define("SMTP_UNAME", $_ENV['SMTP_UNAME'] ?? 'smiletvafrica10@gmail.com');

define("SMTP_PWORD", $_ENV['SMTP_PWORD'] ?? 'yfaidyjhnnyygaah');
