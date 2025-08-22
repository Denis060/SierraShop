<?php

permission_user();

require_once('admin/models/feedbacks.php');

$title = 'Customer Feedback Information for Product';
$navFeedback = 'class="active open"';

require('admin/views/feedback/product.php');
