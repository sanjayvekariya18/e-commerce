<?php
if (isset($products)) {
    foreach ($products as $val) {
        ?>
        <li class="col-sx-12 col-sm-4">
            <div class="product-container">
                <div class="left-block">
                    <?php
                    if ($val->qty <= 0) {
                        ?>                                            
                        <label class="outofstock">OUT OF STOCK</label>
                        <?php
                    }
                    ?>                                                
                    <a href="<?= site_url() ?>product?pname=<?= str_replace(" ", "-", $val->product_name) ?>&pid=<?= base64_encode($val->product_id) ?>">
                        <img class="img-responsive" style="transform: none;" alt="product" src="<?= $val->image_large ?>" />
                    </a>
                    <div class="quick-view">
                        <!--  <a title="Add to my wishlist" class="heart" href="#"></a> -->
                        <!--  <a title="Quick view" class="search" href="#"></a> -->
                    </div>
                    <div class="add-to-cart">
                        <a title="Add to Cart" href="<?= site_url() ?>product?pname=<?= str_replace(" ", "-", $val->product_name) ?>&pid=<?= base64_encode($val->product_id) ?>">Add to Cart</a>
                    </div>
                </div>
                <div class="right-block">
                    <h5 class="product-name"><a href="<?= site_url() ?>product?pname=<?= str_replace(" ", "-", $val->product_name) ?>&pid=<?= base64_encode($val->product_id) ?>"><?= $val->product_name ?></a></h5>
                    <div class="product-star">
                        <?php
                        if ($val->product_rating != 0) {
                            $star = explode(".", $val->product_rating);
                            if ($star[0] != 0) {
                                for ($i = 1; $i <= $star[0]; $i++) {
                                    ?>
                                    <i class="fa fa-star"></i>
                                    <?php
                                }
                                if (isset($star[1])) {
                                    if ($star[1] != 0) {
                                        ?>
                                        <i class="fa fa-star-half-o"></i>
                                        <?php
                                    }
                                }
                            }
                        }
                        ?>  
                    </div>
                    <div class="content_price">
                        <span class="price product-price"><i class="fa fa-rupee"> </i><?= $val->selling_price ?></span>
                        <span class="price old-price"><i class="fa fa-rupee"> </i><?= $val->mrp ?></span>
                    </div>
                    <div class="info-orther">
                        <p>Item Code: <?= $val->sku ?></p>
                        <p class="availability">Availability: <span>In stock</span></p>
                        <div class="product-desc">
                            <?= $val->product_desc ?>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <?php
    }
}
?>