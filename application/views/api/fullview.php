<div class="c-layout-page">
    <div class="row" style="margin-left: 0px;margin-right: 0px;">
        <div class="col-md-12">
            <div class="c-content-title-1" style="padding: 20px;padding-bottom: 0px;">
                <h4 class="c-font-uppercase c-font-bold" style="font-size:14px"><?= $product->product_name ?></h4>
            </div>
            <div class="c-product-review" style="padding-left: 20px">
                <div class="c-product-rating">
                    <?php
                    if ($product->product_rating != 0) {
                        $star = explode(".", $product->product_rating);
                        if ($star[0] != 0) {
                            for ($i = 1; $i <= $star[0]; $i++) {
                                ?>
                                <i class="fa fa-star c-font-red"></i>
                                <?php
                            }
                            if (isset($star[1])) {
                                if ($star[1] != 0) {
                                    ?>
                                    <i class="fa fa-star-half-o c-font-red"></i>
                                    <?php
                                }
                            }
                        }
                    }
                    ?>
                </div>                                        
            </div>
        </div>
    </div>   
    <!-- BEGIN: PAGE CONTENT -->
    <!-- BEGIN: CONTENT/SHOPS/SHOP-PRODUCT-DETAILS-2 -->
    <div class="c-content-box c-size-md c-overflow-hide c-bg-white">
        <div class="container">
            <div class="c-shop-product-details-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="c-product-gallery">
                            <div class="c-product-gallery-content">
                                <div class="c-zoom">
                                    <img src="<?= $product->image_big ?>"> 
                                </div>
                                <?php foreach ($pimages as $val) { ?>
                                    <div class="c-zoom">
                                        <img src="<?= $val->image_big ?>">
                                    </div>                                
                                <?php } ?>
                            </div>
                            <div class="row c-product-gallery-thumbnail">
                                <div class="col-xs-3 c-product-thumb">
                                    <img id="1" src="<?= $product->image_thumb ?>">
                                </div>
                                <?php
                                $id = 1;
                                foreach ($pimages as $val) {
                                    $id += 1;
                                    ?>
                                    <div class="col-xs-3 c-product-thumb">
                                        <img id="<?= $id ?>" src="<?= $val->image_thumb ?>">
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <hr style="width: 90%;margin: 0px 15px;border-top: 1px solid #27A8B4">
                    <?php
                    if ($product->qty >= 1) {
                        ?>  
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6" style="float: left;width: 55%;">
                                    <div class="c-product-meta" style="border-right: 1px solid #27A8B4;border-right-style: dashed;">
                                        <div class="c-product-price" style="display: inline-block;padding-right: 15px;"><i class="fa fa-rupee"> </i><?= $product->selling_price ?></div>
                                        <div style="font-weight: bold;color: red;text-decoration: line-through;display: inline-block;padding-right: 15px;"><i class="fa fa-rupee"> </i><?= $product->mrp ?></div>

                                        <?php
                                        if (isset($variation['size'])) {
                                            if ($variation['size'][0] != null) {
                                                ?>  
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <p class="c-product-meta-label c-font-uppercase c-font-bold" style="width: 65px;">Size:</p>
                                                        <select id="size">
                                                            <?php
                                                            if (isset($variation['size'])) {
                                                                foreach ($variation['size'] as $val) {
                                                                    if ($val != null) {
                                                                        ?>
                                                                        <option value="<?= $val['id'] ?>"><?= $val['name'] ?></option>                                           
                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>                                       
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <?php
                                        if (isset($variation['colour'])) {
                                            if ($variation['colour'][0] != null) {
                                                ?>  
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <p class="c-product-meta-label c-font-uppercase c-font-bold" style="width: 65px;">Colour:</p>
                                                        <select id="colour">
                                                            <?php foreach ($variation['colour'] as $val) { ?>
                                                                <option value="<?= $val['id'] ?>"><?= $val['name'] ?></option>                                                        
                                                            <?php } ?>
                                                        </select>
                                                    </div>                                       
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="c-product-meta-label c-font-uppercase c-font-bold" style="width: 65px;">Qty:</p>
                                                <select id="qty">
                                                    <?php
                                                    for ($i = 1; $i <= $product->qty; $i++) {
                                                        if ($i <= 3) {
                                                            ?>
                                                            <option value="<?= $i ?>"><?= $i ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>                                       
                                        </div>
                                    </div>  
                                </div>
                                <div class="col-md-6" style="width: 45%;float: left;margin-top: 20px;padding-left: 0px">
                                    <strong style="color:#27A8B4"> SOLD BY : </strong><br>
                                    <strong><?= $this->wcommon->getSellerName($product->seller_id) ?></strong>                                    
                                    <div class="c-product-review">
                                        <div class="c-product-rating" style="font-size: 12px">
                                            <?php
                                            $seller_rate = $this->wcommon->getSellerRate($product->seller_id);
                                            if ($seller_rate != 0) {
                                                $star = explode(".", $seller_rate);
                                                if ($star[0] != 0) {
                                                    for ($i = 1; $i <= $star[0]; $i++) {
                                                        ?>
                                                        <i class="fa fa-star c-font-red"></i>
                                                        <?php
                                                    }
                                                    if (isset($star[1])) {
                                                        if ($star[1] != 0) {
                                                            ?>
                                                            <i class="fa fa-star-half-o c-font-red"></i>
                                                            <?php
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>                                        
                                    </div>
                                    <hr style="margin: 10px 0px;border-top: 1px dashed #27A8B4">
                                    <div style="font-size: 13px;">
                                        <p><strong style="color:#ff3366"> Shopking24 Guarantees </strong></p>
                                        <p><i class="fa fa-shield" style="font-size: 16px;padding-right: 10px;color: #ff3366;"> </i>TrustPay: 100% </p>
                                        <p>Moneyback, <?= $return->return_day ?> Days easy return policy </p>     
                                    </div>
                                </div>
                            </div>                          
                        </div>                          
                        <div class="c-product-add-cart">
                            <div class="row">                                            
                                <div class="col-sm-12 col-xs-12 c-margin-t-20">
                                    <button class="btn c-btn btn-lg c-font-bold c-font-white c-theme-btn c-btn-square c-font-uppercase addtocart" style="width: 100%;" value="<?= $product->product_id ?>">Add to Cart</button>
                                </div>
                                <div class="col-sm-12 col-xs-12" style="margin-top:5px">
                                    <button class="btn c-btn btn-lg c-font-bold c-font-white c-btn-square c-font-uppercase buynow" style="width: 100%;background-color: #ff3366" value="<?= $product->product_id ?>">Buy Now</button>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- END: CONTENT/SHOPS/SHOP-PRODUCT-DETAILS-2 -->
    <!-- BEGIN: CONTENT/SHOPS/SHOP-PRODUCT-TAB-1 -->
    <div class="c-content-box c-size-md c-no-padding" style="padding-top: 0px;">
        <div class="c-shop-product-tab-1" role="tabpanel">
            <div class="container">
                <ul class="nav nav-justified" role="tablist">
                    <li role="presentation" class="active">
                        <a class="c-font-uppercase c-font-bold" href="#tab-1" role="tab" data-toggle="tab">Information</a>
                    </li>
                    <li role="presentation">
                        <a class="c-font-uppercase c-font-bold" href="#tab-2" role="tab" data-toggle="tab">Reviews</a>
                    </li>
                    <li role="presentation">
                        <a class="c-font-uppercase c-font-bold" href="#tab-3" role="tab" data-toggle="tab">Return</a>
                    </li>
                    <li role="presentation">
                        <a class="c-font-uppercase c-font-bold" href="#tab-4" role="tab" data-toggle="tab">More Seller</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="tab-1">
                    <div class="container">
                        <p><?= $product->product_desc ?></p>
                        <table class="table table-bordered" style="margin-bottom:0px;">
                            <tr>
                                <td style="text-transform: capitalize;width: 150px">Product SUPC</td>
                                <td><?= $product->product_supc ?></td>
                            </tr>
                            <?php
                            if ($product->main_category_id == 2) {
                                ?>
                                <tr>
                                    <td width="150" style="text-transform: capitalize;">Width</td>
                                    <td><?= $product->width ?> mm</td>
                                </tr>
                                <tr>
                                    <td width="150" style="text-transform: capitalize;">Height</td>
                                    <td><?= $product->height ?> mm</td>
                                </tr>
                                <tr>
                                    <td width="150" style="text-transform: capitalize;">Length</td>
                                    <td><?= $product->length ?> mm</td>
                                </tr>
                                <tr>
                                    <td width="150" style="text-transform: capitalize;">Diameter</td>
                                    <td><?= $product->diameter ?></td>
                                </tr>
                                <?php
                            } else if ($product->main_category_id == 3) {
                                ?>
                                <tr>
                                    <td width="150" style="text-transform: capitalize;">Length</td>
                                    <td><?= $product->length ?></td>
                                </tr>
                                <tr>
                                    <td width="150" style="text-transform: capitalize;">Brand Name</td>
                                    <td><?= $product->company ?></td>
                                </tr>
                            <?php } ?>
                        </table> 
                        <?php
                        if (isset($variation['other'])) {
                            ?>
                            <table class="table table-bordered">                                        
                                <?php
                                foreach ($variation['other'] as $key => $val) {
                                    ?>
                                    <tr>
                                        <td style="text-transform: capitalize;;width: 150px"><?= str_replace("_", " ", $key) ?></td>
                                        <td><?= $val[0] ?></td>
                                    </tr>
                                <?php } ?>    
                            </table>
                        <?php } ?>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab-2">
                    <div class="container">
                        <h3 class="c-font-uppercase c-font-bold c-font-22 c-center c-margin-b-40 c-margin-t-40">Reviews For <?= $product->product_name ?></h3>
                        <?php
                        if (isset($review) && is_array($review)) {
                            foreach ($review as $val) {
                                ?>  
                                <div class="row">
                                    <div class="col-xs-6">                                        
                                        <div class="c-product-review-name">
                                            <h3 class="c-font-bold c-font-24 c-margin-b-5"><?= $val->first_name ?></h3>
                                            <p class="c-date c-theme-font c-font-14"><?= date('d-m-Y', strtotime($val->pratedate)) ?></p>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="c-product-rating c-right">
                                            <?php
                                            if ($val->prate != "") {
                                                $star = explode(".", $val->prate);
                                                if ($star[0] != 0) {
                                                    for ($i = 1; $i <= $star[0]; $i++) {
                                                        ?>
                                                        <i class="fa fa-star c-font-red"></i>
                                                        <?php
                                                    }
                                                    if (isset($star[1])) {
                                                        if ($star[1] != 0) {
                                                            ?>
                                                            <i class="fa fa-star-half-o c-font-red"></i>
                                                            <?php
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="c-product-review-content">
                                    <p> <?= $val->preview ?> </p>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab-3">
                    <div class="container">                                   
                        <p><strong>Time</strong></p>
                        <p>If you are not happy with a product you have received, don’t worry. You can always return it back within <?= $return->return_day ?> days without any deductions.</p>
                        <p><strong>Process</strong></p>
                        <p>Send us an email preferably within 48 hours of receiving the product. Our team will reply with the instructions and return shipping address to which you need to send back the product.</p>
                        <p><strong>Refunds/Replacements</strong></p>
                        <p>If you wish to replace a damaged product, we will send you a new one. We can also refund the amount to your credit card/bank account.</p>                                   
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="tab-4">
                    <div class="container"> 
                        <?php
                        if (isset($sproduct) && is_array($sproduct)) {
                            $total = count($sproduct);
                            if ($total > 0) {
                                ?>
                                <h4 style="background: #F36;margin-top: 15px;padding: 15px;margin-bottom: 0;color: white;">Sold By <?= $total ?> Seller</h4>
                                <?php
                                $count = 0;
                                foreach ($sproduct as $val) {
                                    $count +=1;
                                    ?>
                                    <div class="sellerbox" <?= ($count <= 3) ? "" : "style='display:none'" ?>>
                                        <div class="row">
                                            <div class="col-xs-12">                                        
                                                <div>
                                                    <h3 class="c-font-bold c-font-18 c-margin-b-5"><?= $val->brand ?></h3>                                                    
                                                    <p style="float:left;">Price : <i class="fa fa-rupee"></i> <?= $val->selling_price ?></p>
                                                    <div class="c-product-rating c-right">
                                                        <?php
                                                        $seller_rate = $this->wcommon->getSellerRate($val->seller_id);
                                                        if ($seller_rate != "") {
                                                            $star = explode(".", $seller_rate);
                                                            if ($star[0] != 0) {
                                                                for ($i = 1; $i <= $star[0]; $i++) {
                                                                    ?>
                                                                    <i class="fa fa-star c-font-red"></i>
                                                                    <?php
                                                                }
                                                                if (isset($star[1])) {
                                                                    if ($star[1] != 0) {
                                                                        ?>
                                                                        <i class="fa fa-star-half-o c-font-red"></i>
                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </div>                                                    
                                                    <p style="clear:both;"><i class="fa fa-rupee"></i> Cash on Delivery may be available!</p>
                                                </div>
                                            </div>                                            
                                        </div>                                        
                                        <p>Usually Delivered in <?= $val->shipping_time ?> business days.</p>
                                        <div class="c-product-add-cart">
                                            <div class="row">                                            
                                                <div class="col-md-6" style="display: inline-block;float: left;width: 50%">
                                                    <button class="btn c-btn c-font-bold c-font-white c-btn-square c-font-uppercase" style="width: 100%;background-color: #32c5d2;padding: 3px;border-radius: 5px" value="<?= $product->product_id ?>">Add to Cart</button>
                                                </div>
                                                <div class="col-md-6" style="display: inline-block;width: 50%">
                                                    <button class="btn c-btn c-font-bold c-font-white c-btn-square c-font-uppercase" style="width: 100%;background-color: #ff3366;padding: 3px;border-radius: 5px" value="<?= $product->product_id ?>">Buy Now</button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>                                    
                                <?php } ?>
                                <?php
                                if ($count > 3) {
                                    ?>                                  
                                    <div class="row">                                            
                                        <div class="col-md-12">
                                            <button id="view_more" class="btn c-btn btn-lg c-font-bold c-font-white c-theme-btn c-btn-square c-font-uppercase" style="width:100%">View More</button>
                                        </div>                                            
                                    </div>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
