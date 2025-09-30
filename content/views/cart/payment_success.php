<?php
require('content/views/shared/header.php'); ?>
<div role="main" class="main shop">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="alert alert-success mt-4">
                    <h2><i class="fa fa-check-circle"></i> Payment Successful!</h2>
                    <p>Thank you for your order at Sierra Shop. Your payment has been processed successfully.</p>
                    <p>We will process your order and update you about the delivery status.</p>
                    <p>Order ID: #<?= isset($_GET['orderId']) ? htmlspecialchars($_GET['orderId']) : 'N/A' ?></p>
                    <div class="mt-4">
                        <a href="<?= PATH_URL ?>home" class="btn btn-primary">Continue Shopping</a>
                        <a href="<?= PATH_URL ?>admin.php?controller=purchase" class="btn btn-info">View Order Status</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require('content/views/shared/footer.php'); ?>
