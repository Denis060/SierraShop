<?php

permission_user();
permission_moderator();

require_once('admin/models/header-footer.php');

if (!empty($_POST)) {
    updateHeaderFooter();
}

$title = 'Edit Website Header Footer';
$navHF = 'class="active open"';
$contact = getRecord('contacts', 1);

require('admin/views/header-footer/index.php');
