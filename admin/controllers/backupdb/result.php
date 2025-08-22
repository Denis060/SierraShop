<?php

permission_user();
permission_moderator();

$title = 'Database Backup Result';
$backupDbClass = 'class="active open"';

require('admin/views/backupdb/resultBackupdb.php');
