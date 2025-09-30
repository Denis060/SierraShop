<?php
require('content/views/shared/header.php'); ?>
<div role="main" class="main shop">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="alert alert-danger mt-4">
                    <h2><i class="fa fa-times-circle"></i> Payment Failed</h2>
                    <p>We're sorry, but there was a problem processing your payment.</p>
                    <p>Error: <?= isset($_GET['error']) ? htmlspecialchars($_GET['error']) : 'Unknown error occurred' ?></p>
                    <div class="mt-4">
                        <a href="<?= PATH_URL ?>cart/order" class="btn btn-primary">Try Again</a>
                        <a href="<?= PATH_URL ?>home" class="btn btn-info">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require('content/views/shared/footer.php'); ?>
