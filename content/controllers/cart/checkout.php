<?php

require('admin/views/shared/header.php');
if (!empty($_POST)) {
    $order = [
        'id' => 0,
        'customer' => escape($_POST['name']),
        'province' => escape($_POST['province']),
        'address' => escape($_POST['address']),
        'phone' => escape($_POST['phone']),
        'cart_total' => $_POST['cart_total'],
        'createtime' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
        'message' => escape($_POST['message']),
        'user_id' => intval($_POST['user_id']),
    ];
    $orderId = save('orders', $order);

    $cart = cart_list();
    //lấy sản phẩm trong session cart
    foreach ($cart as $product) {
        $orderDetail = [
            'id' => 0,
            'order_id' => $orderId,
            'product_id' => $product['id'],
            'quantity' => $product['number'],
            'price' => $product['price'],
        ];
        save('order_detail', $orderDetail);
    }
    cartDestroy(); //xoá cart sau khi save order db
    global $userNav;
    if (isset($userNav)) {
        detroy_cart_user_db();
    } //xóa đồng bộ cart trên db sau khi đặt hàng
    $title = 'Order Successful - SaloneCart';
    header("refresh:15;url=" . PATH_URL . "home");
    echo '<div style="text-align: center;padding: 20px 10px;">Order placed successfully</div><div style="text-align: center;padding: 20px 10px;">Thank you for your order at SaloneCart. We will call you from the phone number you provided to confirm your order as soon as possible.<br>
                    The browser will automatically redirect to the homepage after 15 seconds, or you can click <a href="' . PATH_URL . 'home">here</a>.</div>';
} else {
    header('location:.');
}
