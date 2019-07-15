<?php
$total_product = "";
if (isset($products) && is_array($products)) {
    $total_product = count($products);
    ?>
    <?php
    if ($total_product != "" && $total_product != 0) {

        $count = 0;
        $total = 0;
        foreach ($products as $product) {
            $count += 1;
            $total += $product->selling_price * $product->qty;
            ?>
            <div class="row c-cart-table-row">
                <h2 class="c-font-uppercase c-font-bold c-theme-bg c-font-white c-cart-item-title c-cart-item-first">Item <?= $count ?></h2>
                <div class="col-md-2 col-sm-3 col-xs-5 c-cart-image">
                    <img src="<?= $product->image_thumb ?>" /> </div>
                <div class="col-md-4 col-sm-9 col-xs-7 c-cart-desc">
                    <h3><?= $product->product_name ?></h3>
                    <p>SKU: <?= $product->sku ?></p>
                    <?php if ($product->colour_id != "") { ?>
                        <p>Color: <?= $this->common->getVariationName($product->colour_id) ?></p>
                    <?php } else if ($product->size_id != "") { ?>
                        <p>Size: <?= $this->common->getVariationName($product->size_id) ?></p>
                    <?php } ?>
                </div>        
                <div class="col-md-1 col-sm-3" style="width: 33%;float: left;clear: both;">
                    <p class="c-cart-sub-title c-theme-font c-font-uppercase c-font-bold">QTY</p>
                    <select id="<?= $product->product_id ?>" name="qty" class="qty">
                        <?php
                        for ($i = 1; $i <= $product->product_qty; $i++) {
                            if ($i <= 3) {
                                ?>
                                <option value="<?= $i ?>"
                                <?php
                                if ($product->qty == $i) {
                                    echo 'selected';
                                }
                                ?>><?= $i ?></option>
                                        <?php
                                    }
                                }
                                ?>
                    </select>
                </div>
                <div class="col-md-2 col-sm-3" style="width: 33%;float: left;display: inline-block;">
                    <p class="c-cart-sub-title c-theme-font c-font-uppercase c-font-bold">Price</p>
                    <p class="c-cart-price c-font-bold"><i class="fa fa-rupee"></i> <?= $product->selling_price ?></p>
                </div>
                <div class="col-md-1 col-sm-3" style="width: 33%;float: left;display: inline-block;">
                    <p class="c-cart-sub-title c-theme-font c-font-uppercase c-font-bold">Total</p>
                    <p class="c-cart-price c-font-bold"><i class="fa fa-rupee"></i> <?= $product->selling_price * $product->qty ?></p>
                </div>
                <div class="col-md-1 col-sm-12 c-cart-remove">                
                    <a id="<?= $product->product_id ?>" href="#" class="c-cart-remove-mobile btn c-btn c-btn-md c-btn-square c-btn-red c-btn-border-1x c-font-uppercase remove ">Remove item</a>
                </div>
            </div>
        <?php } ?>
        <!-- BEGIN: SUBTOTAL ITEM ROW -->
        <div class="row">
            <div class="c-cart-subtotal-row c-margin-t-20">
                <div class="col-md-2 col-md-offset-9 col-sm-6 col-xs-6 c-cart-subtotal-border">
                    <h3 class="c-font-uppercase c-font-bold c-right c-font-16 c-font-grey-2">Grand Total</h3>
                </div>
                <div class="col-md-1 col-sm-6 col-xs-6 c-cart-subtotal-border">
                    <h3 class="c-font-bold c-font-16"><i class="fa fa-rupee"></i> <?= $total ?></h3>
                </div>
            </div>
        </div>
        <!-- END: SUBTOTAL ITEM ROW -->    
    <?php } ?>        
<?php }?>