<style type="text/css">
    .owl-item{
        border: 1px solid #f6f6f6;        
        padding: 10px;
        height: 340px;
        border-radius: 10px;
    }
    h5.product-name {
        height: 60px;
    }

    .header_marks {
        width: calc(100% - 200px);        
        padding: 0 0 0px 0;
        text-align: center;
        height: 22px;
        margin: auto;
        border-bottom: 1px dotted #939699;       
        margin-bottom: 30px;
    }

    .offset_title {    
        display: inline-block;
        padding: 10px 10px;
        color: #FFFFFF;
        font-size: 16px;
        background-color: #FF3366;        
        text-transform: uppercase;        
        letter-spacing: 1px;
    }

</style>

<!-- Home slideder-->
<div id="home-slider">
    <div class="container">
        <div class="row" style="margin-top: 10px;">           
            <div class="header-top-right" style="margin-left: 15px;">
                <div class="homeslider" style="width: 100%;">
                    <div class="content-slide">
                        <ul id="contenhomeslider">
                            <li><a href="<?= isset($banner->block1) ? $banner->block1 : "#" ?>"><img alt="Slide1" src="<?= base_url() ?>upload/banner/1.jpg" title="Slide1" /></a></li>
                            <li><a href="<?= isset($banner->block2) ? $banner->block2 : "#" ?>"><img alt="Slide2" src="<?= base_url() ?>upload/banner/2.jpg" title="Slide2" /></a></li>
                            <li><a href="<?= isset($banner->block3) ? $banner->block3 : "#" ?>"><img alt="Slide3" src="<?= base_url() ?>upload/banner/3.jpg" title="Slide3" /></a></li>
                        </ul>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>
<!-- END Home slideder-->
<!-- servives -->
<div class="container">
    <div class="service ">
        <div class="col-xs-6 col-sm-3 service-item">
            <div class="icon">
                <img alt="services" src="<?= base_url() ?>webassets/data/s1.png" />
            </div>
            <div class="info">
                <a href="#"><h3>Free Shipping</h3></a>
                <span>All Over In India</span>
            </div>
        </div>
        <div class="col-xs-6 col-sm-3 service-item">
            <div class="icon">
                <img alt="services" src="<?= base_url() ?>webassets/data/s2.png" />
            </div>
            <div class="info">
                <a href="#"><h3><?= $return->return_day ?>-day return</h3></a>
                <span>Moneyback guarantee</span>
            </div>
        </div>
        <div class="col-xs-6 col-sm-3 service-item">
            <div class="icon">
                <img alt="services" src="<?= base_url() ?>webassets/data/s3.png" />
            </div>

            <div class="info" >
                <a href="#"><h3>24/7 support</h3></a>
                <span>Premium Support</span>
            </div>
        </div>
        <div class="col-xs-6 col-sm-3 service-item">
            <div class="icon">
                <img alt="services" src="<?= base_url() ?>webassets/data/s4.png" />
            </div>
            <div class="info">
                <a href="#"><h3>SAFE SHOPPING</h3></a>
                <span>Safe Shopping Guarantee</span>
            </div>
        </div>
    </div>
</div>
<div class="content-page" style="background: #FFFFFF">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a href="<?= isset($banner->block4) ? $banner->block4 : "#" ?>">
                    <img alt="banner1" class="img-responsive" src="<?= base_url() ?>upload/banner/4.jpg" style="padding-bottom: 25px"/>
                </a>
            </div>
            <div class="col-md-6">
                <a href="<?= isset($banner->block5) ? $banner->block5 : "#" ?>">
                    <img alt="banner1" class="img-responsive" src="<?= base_url() ?>upload/banner/5.jpg" style="padding-bottom: 25px"/>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="<?= isset($banner->block6) ? $banner->block6 : "#" ?>">
                    <img alt="banner1" class="img-responsive" src="<?= base_url() ?>upload/banner/6.jpg" style="padding-bottom: 25px"/>
                </a>
            </div>
            <div class="col-md-6">
                <a href="<?= isset($banner->block7) ? $banner->block7 : "#" ?>">
                    <img alt="banner1" class="img-responsive" src="<?= base_url() ?>upload/banner/7.jpg" style="padding-bottom: 25px"/>
                </a>
            </div>
        </div>
        <div class="header_marks homeproductslider">
            <h3 class="offset_title">Featured Products</h3>
        </div>
        <div class="product-featured-content homeproductslider">
            <div class="product-featured-list">
                <div class="tab-container autoheight">
                    <!-- tab product -->
                    <!-- Saree Recently Added Start-->
                    <?php if (isset($slider1) && is_array($slider1)) { ?>                        
                        <ul class="owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "false" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":5}}'>
                            <?php foreach ($slider1 as $val) { ?>
                                <li>
                                    <div class="left-block">
                                        <a href="<?= site_url() ?>product?pname=<?= str_replace(" ", "-", $val->product_name) ?>&pid=<?= base64_encode($val->product_id) ?>">
                                            <img class="img-responsive" style="width: 95%;" alt="product" src="<?= $val->image_medium ?>" />
                                        </a>
                                    </div>
                                    <div class="right-block">
                                        <h5 class="product-name" style="line-height:20px"><a href="<?= site_url() ?>product?pname=<?= str_replace(" ", "-", $val->product_name) ?>&pid=<?= base64_encode($val->product_id) ?>"><?= $val->product_name ?></a></h5>
                                        <div class="content_price" style="margin-top: 5px;">
                                            <span class="price product-price" style="margin-right: 5px;color: #FF3366;"><i class="fa fa-rupee"> </i><?= $val->selling_price ?></span>
                                            <span class="price old-price" style="text-decoration: line-through"><i class="fa fa-rupee"> </i><?= $val->mrp ?></span>
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
                    <?php } ?>
                    <!-- Saree Recently Added End--> 
                </div>
            </div>
        </div>
        <?php if (isset($slider1) && is_array($slider1)) { ?>    
            <div class="row homeproduct" style="display: none">
                <?php foreach ($slider1 as $val) { ?>
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
        <div class="row" style="margin-top: 20px">
            <div class="col-md-6">
                <a href="<?= isset($banner->block8) ? $banner->block8 : "#" ?>">
                    <img alt="banner1" class="img-responsive" src="<?= base_url() ?>upload/banner/8.jpg" style="padding-bottom: 25px"/>
                </a>
            </div>
            <div class="col-md-6">
                <a href="<?= isset($banner->block9) ? $banner->block9 : "#" ?>">
                    <img alt="banner1" class="img-responsive" src="<?= base_url() ?>upload/banner/9.jpg" style="padding-bottom: 25px"/>
                </a>
            </div>
        </div>
        <div class="header_marks homeproductslider">
            <h3 class="offset_title">Popular Products</h3>
        </div>
        <div class="product-featured-content homeproductslider">
            <div class="product-featured-list">
                <div class="tab-container autoheight">
                    <!-- tab product -->
                    <!-- Saree Recently Added Start-->
                    <?php if (isset($slider2) && is_array($slider2)) { ?>                        
                        <ul class="owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "false" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":5}}'>
                            <?php foreach ($slider2 as $val) { ?>
                                <li>
                                    <div class="left-block">
                                        <a href="<?= site_url() ?>product?pname=<?= str_replace(" ", "-", $val->product_name) ?>&pid=<?= base64_encode($val->product_id) ?>">
                                            <img class="img-responsive" style="width: 95%;" alt="product" src="<?= $val->image_medium ?>" />
                                        </a>
                                    </div>
                                    <div class="right-block">
                                        <h5 class="product-name" style="line-height:20px"><a href="<?= site_url() ?>product?pname=<?= str_replace(" ", "-", $val->product_name) ?>&pid=<?= base64_encode($val->product_id) ?>"><?= $val->product_name ?></a></h5>
                                        <div class="content_price" style="margin-top: 5px;">
                                            <span class="price product-price" style="margin-right: 5px;color: #FF3366;"><i class="fa fa-rupee"> </i><?= $val->selling_price ?></span>
                                            <span class="price old-price" style="text-decoration: line-through"><i class="fa fa-rupee"> </i><?= $val->mrp ?></span>
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
                    <?php } ?>
                    <!-- Saree Recently Added End--> 
                </div>
            </div>
        </div>
        <?php if (isset($slider2) && is_array($slider2)) { ?>    
            <div class="row homeproduct" style="display: none">
                <?php foreach ($slider2 as $val) { ?>
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
        <div class="header_marks homelogo" style="margin-top: 20px">
            <h3 class="offset_title">Popular Seller</h3>
        </div>
        <div class="row homelogo">
            <div class="col-md-2">
                <img src="<?= base_url() ?>upload/banner/10.jpg" width="160" height="100"/>
            </div>
            <div class="col-md-2">
                <img src="<?= base_url() ?>upload/banner/11.jpg" width="160" height="100"/>
            </div>
            <div class="col-md-2">
                <img src="<?= base_url() ?>upload/banner/12.jpg" width="160" height="100"/>
            </div>
            <div class="col-md-2">
                <img src="<?= base_url() ?>upload/banner/13.jpg" width="160" height="100"/>
            </div>
            <div class="col-md-2">
                <img src="<?= base_url() ?>upload/banner/14.jpg" width="160" height="100"/>
            </div>
            <div class="col-md-2">
                <img src="<?= base_url() ?>upload/banner/15.jpg" width="160" height="100"/>
            </div>
        </div>
    </div>    
</div>
<label id="popup" for="section7-p-5"></label>
<input id="section7-p-5" name="section7-p-5" type="checkbox" class="hiddenInput" />
<div class="slickModals section7-m-5">
    <label for="section7-p-5" class="overlay linear slowest black"></label>
    <div class="window center slideTop ease slowest white shadow" style="background-image: url('<?= base_url() ?>assets/images/popup.png');background-size: 100% 100%;width: 800px;height: 300px;">
        <label for="section7-p-5" class="icon close"></label>       
    </div>
</div>
<?php $msg = $this->input->get('msg'); ?>
<?php
switch ($msg) {
    case "R":
        $m = "Username Or Password Is Wrong..!";
        $t = "error";
        break;
    case "RG":
        $m = "Customer Registration Successfully..!";
        $t = "success";
        break;
    case "ARG":
        $m = "Customer Already Register..!";
        $t = "error";
        break;
    default:
        $m = 0;
        break;
}
?>
<?php $popupstatus = $this->common->getPopupStatus(); ?>
<script type="text/javascript">
    $(document).ready(function() {
<?php if ($popupstatus == 1) { ?>
            if (sessionStorage.getItem("popupstatus") === null) {
                $('#popup').trigger('click');
                sessionStorage.setItem('popupstatus', '1');
            }
<?php } ?>
<?php if ($msg): ?>
            alertify.<?= $t ?>("<?= $m ?>");
<?php endif; ?>
    });
</script>