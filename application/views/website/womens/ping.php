<?php if (isset($products)) { ?>
    <div class="mobile-layout">
        <?php foreach ($products as $val) {
            ?>
            <li class="col-sx-12 col-sm-4" style="padding-right: 10px;padding-left: 10px;">
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
                            <a title="Add to Cart" href="#">Add to Cart</a>
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
        <?php } ?>
    </div>
<?php } ?>
<?php if (isset($products) && is_array($products)) { ?>    
    <div class="row full-layout" style="margin-left:0px;margin-right:-30px;">
        <?php foreach ($products as $val) { ?>
            <div class="col-md-6" style="width:48%;float:left;border: 1px solid #eee;margin: 2px;padding-right: 5px;padding-left: 5px;">
                <a href="<?= site_url() ?>product?pname=<?= str_replace(" ", "-", $val->product_name) ?>&pid=<?= base64_encode($val->product_id) ?>">
                    <img class="img-responsive" style="width: 95%;" alt="product" src="<?= $val->image_medium ?>" />
                </a>
                <h5 class="product-name" style="height: 25px;font-size:10px;font-weight: bold;padding-top: 5px;"><a href="<?= site_url() ?>product?pname=<?= str_replace(" ", "-", $val->product_name) ?>&pid=<?= base64_encode($val->product_id) ?>"><?= substr($val->product_name, 0, 26) ?>..</a></h5>
                <div class="content_price" style="margin-top: 5px;font-size:10px;">
                    <span class="price product-price" style="margin-right: 5px;color: #FF3366;"><i class="fa fa-rupee"> </i><?= $val->selling_price ?></span>
                    <span class="price old-price" style="text-decoration: line-through"><i class="fa fa-rupee"> </i><?= $val->mrp ?></span>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>