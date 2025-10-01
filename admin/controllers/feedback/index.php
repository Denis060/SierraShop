<?php

permission_user();
require_once('admin/models/feedbacks.php');

$title = 'All Feedback List';
$navFeedback = 'class="active open"';

require('admin/views/feedback/index.php');
