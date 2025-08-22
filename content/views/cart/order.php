<?php

/**
 * @var array $cart
 * @var array $userLogin
 */

require('content/views/shared/header.php');
?>
<div role="main" class="main shop">
    <div class="container">
        <hr class="tall">
        <div class="row">
            <div class="col-md-12">
                <h2 class="shorter"><strong>Checkout and Order Process</strong></h2>
                <?php if (!isset($userNav)) {
                    echo '<p>Customer feedback? <a href="admin.php">Click here to log in.</a></p>';
                } else {
                    echo '<p>Your feedback? <strong><a href="index.php&controller=feedback">Click here to send feedback.</a></strong></p>';
                } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                    <strong>Review & Payment</strong>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="accordion-body collapse in">
                            <div class="panel-body">
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">
                                                &nbsp;
                                            </th>
                                            <th class="product-name">
                                                Product
                                            </th>
                                            <th class="product-price">
                                                Price
                                            </th>
                                            <th class="product-quantity">
                                                Quantity
                                            </th>
                                            <th class="product-subtotal">
                                                Subtotal
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($cart as $productId => $product) { ?>
                                            <tr class="cart_table_item">
                                                <td class="product-thumbnail">
                                                    <a href="product/<?= $product['id'] . '-' . slug($product['name']); ?>">
                                                        <img width="100" height="100" alt="<?=$product['name']?>" class="img-responsive" src="<?= 'public/upload/products/' . $product['image'] ?>">
                                                    </a>
                                                </td>
                                                <td class="product-name">
                                                    <a href="product/<?= $product['id'] . '-' . slug($product['name']); ?>"><?= $product['name'] ?></a>
                                                </td>
                                                <td class="product-price">
                                                    <?php if ($product["typeid"] == 3) : ?>
                                                        <span class="amount"><?= $product ? number_format(($product['price']) - ($product['price']) * ($product['percent_off']) / 100, 0, ',', '.') : 0; ?> VNĐ</span>
                                                    <?php else : ?>
                                                        <span class="amount"><?= number_format($product['price'], 0, ',', '.'); ?> VNĐ</span>
                                                    <?php endif ?>
                                                </td>
                                                <td class="product-quantity">
                                                    <?= $product['number']; ?>
                                                </td>
                                                <td class="product-subtotal">
                                                    <?php if ($product["typeid"] == 3) : ?>
                                                        <span class="amount"><?= number_format((($product['price']) - ($product['price']) * ($product['percent_off']) / 100) * $product['number'], 0, ',', '.') ?> VNĐ</span>
                                                    <?php else : ?>
                                                        <span class="amount"><?= number_format($product['price'] * $product['number'], 0, ',', '.') ?> VNĐ</span>
                                                    <?php endif ?>
                                                </td>
                                            </tr><?php } ?>
                                    </tbody>
                                </table>
                                <hr class="tall">
                                <h4>Cart Summary</h4>
                                <table cellspacing="0" class="cart-totals">
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th>
                                                <strong>Total number of products</strong>
                                            </th>
                                            <td>
                                                <strong><span class="amount"><?= cart_number(); ?></span></strong>
                                            </td>
                                        </tr>
                                        <tr class="total">
                                            <th>
                                                <strong>Total cart value</strong>
                                            </th>
                                            <td>
                                                <strong><span class="amount"><?= number_format(cart_total(), 0, ',', '.'); ?> VNĐ</span></strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr class="tall">
                                <h3 style="text-align: center;"><strong>Order and Payment Notes</strong></h3>
                                <p><strong>We only support dine-in customers and free shipping within a 5km radius</strong>. If you order products in the <strong>Food</strong> category with a delivery address <strong>over 10km</strong>, we sincerely apologize for not being able to deliver!</p>
                                <p>For beauty and cosmetic products (outside the <strong>Food</strong> category), we still support free shipping within a 10km radius and nationwide COD shipping!</p>
                                <form action="" id="" method="post">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <span class="remember-box checkbox">
                                                <label>
                                                    <input type="checkbox" checked="checked">Cash on Delivery - Ship COD
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                    <strong>Shipping Address</strong>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="accordion-body collapse in">
                            <div class="panel-body">
                                <form action="index.php?controller=cart&amp;action=checkout" role="form" id="" method="post">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>Country</label>
                                                <select class="form-control">
                                                    <option value="">Vietnam</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if (!isset($userNav)) : ?>
                                        <input type="hidden" name="user_id" value="0">
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label><strong>Full Name</strong></label>
                                                    <input type="text" name="name" class="form-control" required="required" placeholder="Enter your real full name ...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label><strong>Province/City</strong></label>
                                                    <input type="text" name="province" required="required" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label><strong>Phone Number</strong></label>
                                                    <input type="text" name="phone" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label><strong>Address</strong> </label>
                                                    <input type="text" name="address" required="required" class="form-control" placeholder="Please enter your detailed address...">
                                                </div>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <input type="hidden" name="user_id" value="<?= $userNav ?>">
                                        <h3>The information below is automatically filled from your account. You can edit it if it is incorrect!</h3>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label><strong>Full Name</strong></label>
                                                    <input type="text" name="name" value="<?= $userLogin['user_name'] ?>" class="form-control" required="required" placeholder="Enter your real full name ...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label><strong>Province/City</strong></label>
                                                    <input type="text" name="province" required="required" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label><strong>Phone Number</strong></label>
                                                    <input type="text" value="<?= $userLogin['user_phone'] ?>" name="phone" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label><strong>Address </strong></label>
                                                    <input type="text" name="address" value="<?= $userLogin['user_address'] ?>" required="required" class="form-control" placeholder="Please enter your detailed address...">
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label><strong>Order Note: </strong></label>
                                                <textarea name="message" id="message" class="form-control" cols="30" rows="10" placeholder="Add notes for the seller...(You can add quantity, size, or other details about the products you want to order so we can arrange delivery for you.)"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input name="cart_total" type="hidden" value="<?= cart_total() ? cart_total() : '0'; ?>" />
                                    <div class="form-group" style="text-align: center">
                                        <button type="submit" class="btn btn-primary"><i class="fa  fa-check-square-o"></i> Place Order</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <h4>Cart Total</h4>
                <table cellspacing="0" class="cart-totals">
                    <tbody>
                        <tr class="cart-subtotal">
                            <th>
                                <strong>Total number of products</strong>
                            </th>
                            <td>
                                <strong><span class="amount"><?= cart_number(); ?></span></strong>
                            </td>
                        </tr>
                        <tr class="total">
                            <th>
                                <strong>Total cart value</strong>
                            </th>
                            <td>
                                <strong><span class="amount"><?= number_format(cart_total(), 0, ',', '.'); ?> VNĐ</span></strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require('content/views/shared/footer.php');
