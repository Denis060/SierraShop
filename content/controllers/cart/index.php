<?php

//form submit
if (!empty($_POST)) {
    foreach ($_POST['number'] as $productId => $number) {
        cart_update($productId, $number);
        global $userNav;
        if (isset($userNav)) {
            mergeCartSessionWithDB();
        }
    }
    header('location:index.php?controller=cart');
}
$title = 'Shopping Cart - SierraCart';
$cart = cart_list();
//load view
require('content/views/cart/index.php');
