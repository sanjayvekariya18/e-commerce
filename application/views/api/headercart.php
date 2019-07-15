<?php
if (isset($products) && is_array($products)) {
    $total_product = count($products);
    if ($total_product != "" && $total_product != 0) {
        ?>
        <ul class="c-cart-menu-items">
            <?php
            foreach ($products as $product) {
                ?>
                <li>                    
                    <img src="<?= $product->image_thumb ?>" />
                    <div class="c-cart-menu-content">
                        <p><?= $product->qty ?> x
                            <span class="c-item-price c-theme-font"><?= $product->selling_price ?></span>
                        </p>
                        <p style="font-size: 12px;"><?= $product->product_name ?></p>
                    </div>
                </li>
            <?php } ?>
        </ul>        
        <!-- BEGIN: SUBTOTAL ITEM ROW -->
        <div class="c-cart-menu-footer" style="text-align: right;">
            <a href="cart.html" class="btn btn-xs c-btn c-btn-square c-theme-btn c-font-white c-font-bold c-center c-font-uppercase" style="font-size: 12px;background: #3c3c3c;padding: 5px 10px;">Checkout</a>
        </div>        
        <!-- END: SUBTOTAL ITEM ROW -->    
        <?php
    }
}
?>
