<?php

/**
* @var array $cart
 */
?>
<div class="featured-box featured-box-secundary featured-box-cart">
    <div class="box-content">
        <form method="post" action="index.php?controller=cart" role="form">
            <table cellspacing="0" class="shop_table cart">
                <thead>
                    <tr>
                        <th class="product-remove">
                            &nbsp;
                        </th>
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
                            <td class="product-remove">
                                <a title="Remove this item" class="remove" href="cart/delete/<?= $product['id']; ?>">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                            <td class="product-thumbnail">
                                <a href="product/<?= $product['id'] . '-' . slug($product['name']); ?>">
                                    <img width="100" height="100" alt="<?= $product['name'] ?>" class="img-responsive" src="<?= 'public/upload/products/' . $product['image'] ?>">
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
                                <div class="quantity">
                                    <input type="number" class="input-text qty text" title="Enter to change quantity" value="<?= $product['number']; ?>" name="number[<?= $product['id']; ?>]" min="1" step="1" max="100">
                                </div>
                            </td>
                            <td class="product-subtotal">
                                <?php if ($product["typeid"] == 3) : ?>
                                    <span class="amount"><?= number_format((($product['price']) - ($product['price']) * ($product['percent_off']) / 100) * $product['number'], 0, ',', '.') ?> VNĐ</span>
                                <?php else : ?>
                                    <span class="amount"><?= number_format($product['price'] * $product['number'], 0, ',', '.') ?> VNĐ</span>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td class="actions" colspan="6">
                            <div class="actions-continue">
                                <input type="submit" value="Update Cart" class="btn btn-default" title='Update if you changed the quantity'>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
<div class="featured-box featured-box-secundary featured-box-cart">
    <form method="post" action="index.php?controller=cart&action=destroy" role="form">
    <div class="box-content"><span style="float: left;"><a href="index.php" class="btn btn-success"><i class="fa fa-hand-o-left"></i> Go back and continue shopping</a></span><span style="float: right;"><strong>If you want to clear the cart, press</strong> <button onclick="return confirm('Are you sure to delete?')" type="submit" value="Clear Cart" class="btn btn-danger" title='Clear the cart if you want to empty it'><b><i class="fa fa-refresh"></i> Clear Cart</b>
        </button></span></div>
    </form>
</div>
