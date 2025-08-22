<?php
require('content/views/shared/header.php'); ?>
<div role="main" class="main shop">
    <div class="container">
        <hr class="tall">
        <div class="row">
            <div class="col-md-12">
                <div class="row featured-boxes">
                    <div class="col-md-12">
                        <?php require('content/views/cart/list.php'); ?>
                    </div>
                </div>
                <div class="row featured-boxes cart">
                    <div class="col-md-12">
                        <div class="featured-box featured-box-secundary default">
                            <div class="box-content">
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
                                        <tr class="shipping">
                                            <th>
                                                Shipping
                                            </th>
                                            <td>
                                                Free Shipping within 5KM for all products & COD shipping nationwide (Except products in the food category)<input type="hidden" value="free_shipping" id="shipping_method" name="shipping_method">
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
                <div class="row featured-boxes">
                    <div class="col-md-12">
                        <div class="actions-continue">
                            <form action="cart/order" method="post">
                                <input type="submit" value="Proceed to Checkout →" name="proceed" class="btn btn-lg btn-primary"></form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require('content/views/shared/footer.php'); ?>
