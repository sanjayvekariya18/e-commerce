<?php
$sellername = $this->wcommon->getSellerName($product->seller_id);
?>
<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="<?= site_url() ?>" title="Return to Home">Home</a>
            <span class="navigation-pipe">&nbsp;</span>
            <?= $this->wcommon->getSubcategoryName($product->sub_category_id) ?>
            <span class="navigation-pipe">&nbsp;</span>
            <?= $product->product_name ?>            
        </div>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <!-- Product -->
                <div id="product">
                    <div class="primary-box row">
                        <div class="pb-left-column col-xs-12 col-sm-6">
                            <!-- product-imge-->
                            <div class="product-image">
                                <?php
                                if ($product->qty <= 0) {
                                    ?>                                            
                                    <label class="outofstock" style="top: 250px;left: 150px;">OUT OF STOCK</label>
                                    <?php
                                }
                                ?> 
                                <div class="product-full">
                                    <img id="product-zoom" src='<?= $product->image_big ?>' data-zoom-image="<?= $product->image_zoom ?>"/>
                                </div>
                                <?php
                                if (isset($pimages)) {
                                    ?>                                    
                                    <div class="product-img-thumb" id="gallery_01">
                                        <ul class="owl-carousel" data-items="3" data-nav="true" data-dots="false" data-margin="20" data-loop="true">
                                            <li>
                                                <a href="#" data-image="<?= $product->image_big ?>" data-zoom-image="<?= $product->image_zoom ?>">
                                                    <img id="product-zoom"  src="<?= $product->image_thumb ?>" /> 
                                                </a>
                                            </li> 
                                            <?php foreach ($pimages as $val) { ?>
                                                <li>
                                                    <a href="#" data-image="<?= $val->image_big ?>" data-zoom-image="<?= $val->image_zoom ?>">
                                                        <img id="product-zoom"  src="<?= $val->image_thumb ?>" /> 
                                                    </a>
                                                </li>                                               
                                            <?php } ?>                                    
                                        </ul>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- product-imge-->
                        </div>
                        <div class="pb-right-column col-xs-12 col-sm-6">
                            <h1 class="product-name"><?= $product->product_name ?></h1>
                            <div class="product-comments">
                                <div class="product-star">
                                    <?php
                                    if ($product->product_rating != 0) {
                                        $star = explode(".", $product->product_rating);
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
                                <div class="comments-advices">
<!--                                    <a href="#"><i class="fa fa-pencil"></i> write a review</a>-->
                                </div>
                            </div>
                            <div class="product-price-group">
                                <span class="price"><i class="fa fa-rupee"> </i><?= $product->selling_price ?></span>
                                <?php if ($product->selling_price != $product->mrp) { ?>
                                    <span class="old-price"><i class="fa fa-rupee"> </i><?= $product->mrp ?></span>
                                    <span class="discount"><?= round((1 - ($product->selling_price / $product->mrp)) * 100, 2) ?> %</span>
                                <?php } ?>
                            </div>
                            <div class="info-orther">
                                <p>Item Code: <?= $product->sku ?></p>
                                <p>Availability: <span class="in-stock"><?= ($product->qty >= 1) ? 'In Stock' : 'Out Of Stock' ?></span></p>
                                <!--<p>Shipping Charge: <span style="color:#3c3c3c"><i class="fa fa-rupee"> </i><?= $product->shipping_charge ?></span></p>-->
                            </div>
                            <div class="product-desc">
                                <?= $product->product_desc ?>
                            </div>
                            <?php
                            if ($product->qty >= 1) {
                                ?>  
                                <div class="form-option">
                                    <p class="form-option-title">Available Options:</p>
                                    <?php
                                    if (isset($variation['colour'])) {
                                        if ($variation['colour'][0] != null) {
                                            ?>                                    
                                            <div class="attributes">
                                                <div class="attribute-label">Color:</div>
                                                <div class="attribute-list">
                                                    <input id="colour" type="hidden" name="colour" value=""/>
                                                    <ul class="list-color">
                                                        <?php
                                                        if (isset($variation['colour'])) {
                                                            $cnt = 0;
                                                            foreach ($variation['colour'] as $val) {
                                                                $cnt +=1;
                                                                ?>
                                                                <li style="background:<?= $val['code'] ?>;" class="colorcode <?= ($cnt == 1) ? 'active' : '' ?>"><a id="<?= $val['id'] ?>" href="javascript:void(0)" class="colour"><?= $val['name'] ?></a></li>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <div class="attributes">
                                        <div class="attribute-label">Qty:</div>
                                        <select id="qty" name="qty" >
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
                                    <?php
                                    if (isset($variation['size'])) {
                                        if ($variation['size'][0] != null) {
                                            ?>    
                                            <div class="attributes">
                                                <div class="attribute-label">Size:</div>
                                                <div class="attribute-list">
                                                    <select id="size" name="size" style="width: 150px;">
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
                                                    <a id="size_chart" class="fancybox" href="<?= base_url() ?>webassets/data/size-chart.jpg">Size Chart</a>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="form-action">
                                    <div class="button-group" style="float:left;margin-right: 15px;">
                                        <button class="btn-add-cart add_to_cart" 
                                        <?php
                                        if ($this->session->userdata('product') != "") {
                                            if (array_key_exists($product->product_id, $this->session->userdata('product'))) {
                                                echo "style = 'background-color:#B4B4B4 !important'";
                                                echo "disabled";
                                            }
                                        }
                                        ?> value="<?= $product->product_id ?>">Add to cart</button>

                                    </div>
                                    <div class="button-group" style="float:left;">
                                        <button class="btn-add-cart buy_now" 
                                        <?php
                                        if ($this->session->userdata('product') != "") {
                                            if (array_key_exists($product->product_id, $this->session->userdata('product'))) {
                                                echo "style = 'background-color:#B4B4B4 !important'";
                                                echo "disabled";
                                            }
                                        }
                                        ?> value="<?= $product->product_id ?>">Buy Now</button>

                                    </div>
                                    <div class="button-group">
    <!--                                    <a class="wishlist" href="#"><i class="fa fa-heart-o"></i>
                                            <br>Wishlist</a>                                        -->
                                    </div>
                                </div>
                            <?php }
                            ?>
                        </div>
                    </div>
                    <!-- MORE SALLER -->
                    <?php
                    if (isset($sproduct) && is_array($sproduct)) {
                        $total = count($sproduct);
                        if ($total > 0) {
                            ?>
                            <div>                        
                                <h4 style="background: #F36;margin-top: 15px;padding: 15px;margin-bottom: 0;color: white;">Sold By <?= $total ?> Seller</h4>
                                <table class="table table-bordered table-wishlist">
                                    <thead>
                                        <tr>
                                            <th>Seller</th>
                                            <th>Rating</th>
                                            <th>Delivered  By</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 0;
                                        foreach ($sproduct as $val) {
                                            $count +=1;
                                            ?>
                                            <tr <?= ($count <= 3) ? "" : "style='display:none'" ?> class="sellermore">
                                                <td><p><?= $val->brand ?></p><p><i class="fa fa-rupee"></i> Cash on Delivery may be available!</p></td>
                                                <td><?= $this->wcommon->getSellerRate($val->seller_id) ?> / 5</td>
                                                <td><p>Usually Delivered in <?= $val->shipping_time ?> business days.</p></td>
                                                <td><i class="fa fa-rupee"></i> <?= $val->selling_price ?></td>
                                                <td>
                                                    <div class="button-group">
                                                        <button class="btn-add-cart add_to_cart" 
                                                        <?php
                                                        if ($this->session->userdata('product') != "") {
                                                            if (array_key_exists($val->product_id, $this->session->userdata('product'))) {
                                                                echo "style = 'background-color:#B4B4B4 !important' ";
                                                                echo "disabled";
                                                            }
                                                        }
                                                        ?> value="<?= $val->product_id ?>">Add to cart</button>

                                                    </div>
                                                    <div class="button-group" style="margin-top: 5px;width:150px;">
                                                        <button class="btn-add-cart buy_now" 
                                                        <?php
                                                        if ($this->session->userdata('product') != "") {
                                                            if (array_key_exists($val->product_id, $this->session->userdata('product'))) {

                                                                echo "style = 'background-color:#B4B4B4 !important' ";
                                                                echo "disabled";
                                                            }
                                                        }
                                                        ?> value="<?= $val->product_id ?>">Buy Now</button>
                                                    </div>
                                                </td>
                                            </tr>                                    
                                            <?php
                                        }
                                        if ($count > 3) {
                                            ?>                                  
                                            <tr>
                                                <td colspan="5">
                                                    <div class="button-group">
                                                        <center>
                                                            <button id="view_more" class="btn" style="background: orange;width: 200px;color: white;border-radius: 0;">View More</button>
                                                        </center>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <!-- MORE SALLER END -->

                    <!-- tab product -->
                    <div class="product-tab">
                        <ul class="nav-tab">
                            <li class="active">
                                <a aria-expanded="true" data-toggle="tab" href="#information">Information</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#reviews">Reviews</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#returns">Returns</a>
                            </li>
                        </ul>
                        <div class="tab-container">
                            <div id="information" class="tab-panel active">
                                <p><?= $product->product_desc ?></p>
                                <table class="table table-bordered">
                                    <tr>
                                        <td width="200" style="text-transform: capitalize;">Product SUPC</td>
                                        <td><?= $product->product_supc ?></td>
                                    </tr>
                                    <?php
                                    if ($product->main_category_id == 2) {
                                        if ($product->width != "") {
                                            ?>                                        
                                            <tr>
                                                <td width="200" style="text-transform: capitalize;">Width</td>
                                                <td><?= $product->width ?> mm</td>
                                            </tr>
                                        <?php } if ($product->height != "") { ?>
                                            <tr>
                                                <td width="200" style="text-transform: capitalize;">Height</td>
                                                <td><?= $product->height ?> mm</td>
                                            </tr>
                                        <?php } if ($product->length != "") { ?>
                                            <tr>
                                                <td width="200" style="text-transform: capitalize;">Length</td>
                                                <td><?= $product->length ?> mm</td>
                                            </tr>
                                        <?php } if ($product->diameter != "") { ?>
                                            <tr>
                                                <td width="200" style="text-transform: capitalize;">Diameter</td>
                                                <td><?= $product->diameter ?></td>
                                            </tr>                                        
                                            <?php
                                        }
                                    } else if ($product->main_category_id == 3) {
                                        ?>
                                        <tr>
                                            <td width="200" style="text-transform: capitalize;">Length</td>
                                            <td><?= $product->length ?></td>
                                        </tr>
                                        <tr>
                                            <td width="200" style="text-transform: capitalize;">Brand Name</td>
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
                                                <td width="200" style="text-transform: capitalize;"><?= str_replace("_", " ", $key) ?></td>
                                                <td><?= implode(",", $val) ?></td>
                                            </tr>
                                        <?php } ?>    
                                    </table>
                                <?php } ?>
                            </div>
                            <div id="reviews" class="tab-panel">
                                <div class="product-comments-block-tab">
                                    <?php
                                    if (isset($review) && is_array($review)) {
                                        foreach ($review as $val) {
                                            ?>        

                                            <div class="comment row">
                                                <div class="col-sm-3 author">
                                                    <div class="grade">
                                                        <span>Grade</span>
                                                        <span class="reviewRating">
                                                            <?php
                                                            if ($val->prate != "") {
                                                                $star = explode(".", $val->prate);
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
                                                        </span>
                                                    </div>

                                                    <div class="info-author">
                                                        <span><strong><?= $val->first_name ?></strong></span>
                                                        <em><?= date('d-m-Y', strtotime($val->pratedate)) ?></em>
                                                    </div>
                                                </div>
                                                <div class="col-sm-9 commnet-dettail">
                                                    <?= $val->preview ?>
                                                </div>
                                            </div> 
                                            <?php
                                        }
                                    }
                                    ?>
                                    <!--<p>
                                    <a class="btn-comment" href="#">Write your review !</a>
                                    </p>-->
                                </div>
                            </div>
                            <div id="returns" class="tab-panel">
                                <p><strong>Time</strong></p>
                                <p>If you are not happy with a product you have received, don’t worry. You can always return it back within <?= $return->return_day ?> days without any deductions.</p>
                                <p><strong>Process</strong></p>
                                <p>Send us an email preferably within 48 hours of receiving the product. Our team will reply with the instructions and return shipping address to which you need to send back the product.</p>
                                <p><strong>Refunds/Replacements</strong></p>
                                <p>If you wish to replace a damaged product, we will send you a new one. We can also refund the amount to your credit card/bank account.</p>
                            </div>
                        </div>
                    </div>
                    <!-- ./tab product -->                                          
                </div>
                <!-- Product -->
            </div>
            <!-- ./ Center colunm -->
            <!-- Left colunm -->
            <div class="column col-xs-12 col-sm-3" id="left_column">
                <!-- block best sellers -->
                <div class="block left-module">                    
                    <div class="block_content">
                        <ul class="products-block best-sell">
                            <li style="text-transform: uppercase;">
                                <p class="product-name" style="font-size: 14px;">
                                    <strong style="color:#3c3c3c;"> SOLD BY </strong> : <strong><a href="<?= site_url() ?>search?keyword=<?= str_replace(" ", "_", $sellername) ?>"  style="color:#F36;"><?= $sellername ?></a></strong>
                                </p>                               
                                <?php
                                $seller_rate = $this->wcommon->getSellerRate($product->seller_id);
                                if ($seller_rate != 0) {
                                    ?>
                                    <div class="product-star" style="font-size: 24px;padding-top: 12px;">
                                        <?php
                                        $star = explode(".", $seller_rate);
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
                                        ?>
                                    </div>            
                                <?php } ?>
                            </li> 
                            <li>
                                <img src="<?= base_url() ?>webassets/icon/assurance.png" />
                            </li> 
                            <li style="text-transform: uppercase;">
                                <p style="font-size: 14px;"><img src="<?= base_url() ?>webassets/icon/cod.png" /><label style="padding-top: 10px;padding-left: 5px;"> COD Available</label></p>
                            </li>
                            <li style="text-transform: uppercase;">
                                <p style="font-size: 14px;"><img src="<?= base_url() ?>webassets/icon/return.png" /><label style="padding-top: 10px;padding-left: 5px;"> <?= $return->return_day ?> Days return policy</label></p>
                            </li>
                            <li style="text-transform: uppercase;">
                                <p style="font-size: 14px;"><img src="<?= base_url() ?>webassets/icon/free_shipping.jpg" /><label style="padding-top: 10px;padding-left: 5px;"> Free Shipping In India</label></p>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ./block best sellers  -->
                <!-- Random Related Product -->
                <div class="block left-module mobile-layout">
                    <p class="title_block">RELATED PRODUCTS</p>
                    <div class="block_content">
                        <ul class="products-block best-sell">
                            <?php foreach ($rrproduct as $val) { ?>
                                <li>
                                    <div class="products-block-left">                                        
                                        <a href="<?= site_url() ?>product?pname=<?= str_replace(" ", "-", $val->product_name) ?>&pid=<?= base64_encode($val->product_id) ?>">
                                            <img class="img-responsive" alt="product" src="<?= $val->image_thumb ?>" style="margin: 5px;"/>
                                        </a>
                                    </div>
                                    <div class="products-block-right">
                                        <p class="product-name">
                                            <a href="<?= site_url() ?>product?pname=<?= str_replace(" ", "-", $val->product_name) ?>&pid=<?= base64_encode($val->product_id) ?>"><?= $val->product_name ?></a>
                                        </p>
                                        <p class="product-price"><i class="fa fa-rupee"> </i><?= $val->selling_price ?></p>
                                        <p class="product-star">
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
                                        </p>
                                    </div>
                                </li>  
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <!-- Random Related Product End -->
            </div>
            <!-- ./left colunm -->
        </div>
        <div class="row mobile-layout">
            <div class="col-md-12">
                <!-- box product -->
                <div class="page-product-box">
                    <h3 class="heading">Related Products</h3>
                    <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "15" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":4},"1000":{"items":4}}'>
                        <?php foreach ($rproduct as $val) { ?>
                            <li>
                                <div class="left-block">
                                    <a href="<?= site_url() ?>product?pname=<?= str_replace(" ", "-", $val->product_name) ?>&pid=<?= base64_encode($val->product_id) ?>"><img class="img-responsive" alt="product" src="<?= $val->image_medium ?>" /></a>
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a href="<?= site_url() ?>product?pname=<?= str_replace(" ", "-", $val->product_name) ?>&pid=<?= base64_encode($val->product_id) ?>"><?= $val->product_name ?></a></h5>
                                    <div class="content_price">
                                        <span class="price product-price"><i class="fa fa-rupee"> </i><?= $val->selling_price ?></span>
                                        <span class="price old-price"><i class="fa fa-rupee"> </i><?= $val->mrp ?></span>
                                    </div>
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
                                </div>
                            </li>
                        <?php } ?>                        
                    </ul>
                </div>
                <!-- ./box product -->  
            </div>
        </div>
        <!-- ./row-->
    </div>
</div>
<script type="text/javascript">
    $('document').ready(function() {

        $('#colour').val($('li.colorcode.active').children().attr('id'));

        $('.colour').click(function() {
            $('#colour').val($(this).attr('id'));
            $('.colour').parent().removeClass('active');
            $(this).parent().addClass('active');
        });

        $('.add_to_cart').click(function() {
            if ($('#colour').val() != "") {
                $product_id = $(this).val();
                $colour_id = $('#colour').val();
                $qty = $('#qty').val();
                $size = $('#size').val();

                $.ajax({
                    url: "<?= site_url() ?>session",
                    type: 'POST',
                    data: {'product_id': $product_id, 'colour_id': $colour_id, 'qty': $qty, 'size': $size},
                    success: function(data, textStatus, jqXHR) {

                        alertify.success("Product Added TO Your Cart");
                        location.reload(true);
                    }
                });
            } else {
                alertify.error("Please Select Color");
            }
        });

        $('.buy_now').click(function() {
            if ($('#colour').val() != "") {
                $product_id = $(this).val();
                $colour_id = $('#colour').val();

                $qty = $('#qty').val();
                $size = $('#size').val();

                $.ajax({
                    url: "<?= site_url() ?>session",
                    type: 'POST',
                    data: {'product_id': $product_id, 'colour_id': $colour_id, 'qty': $qty, 'size': $size},
                    success: function(data, textStatus, jqXHR) {
                        window.location.href = '<?= site_url() ?>cart';
                    }
                });
            } else {
                alertify.error("Please Select Color");
            }
        });

        $('#view_more').click(function() {
            $('.sellermore').removeAttr('style');
            $(this).parent().parent().parent().parent().css('display', 'none');
        });

    });
</script>