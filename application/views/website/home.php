<!-- Home slideder-->
<div id="home-slider">
    <div class="container">
        <div class="row" style="margin-top: 10px;">           
            <div class="header-top-right" style="margin-left: 15px;">
                <div class="homeslider" style="width: 100%;">
                    <div class="content-slide">
                        <ul id="contenhomeslider">
                            <li><a href="<?= isset($slider->block1) ? $slider->block1 : "#" ?>"><img alt="Slide1" src="<?= base_url() ?>upload/banner/slider1.jpg" title="Slide1" /></a></li>
                            <li><a href="<?= isset($slider->block2) ? $slider->block2 : "#" ?>"><img alt="Slide2" src="<?= base_url() ?>upload/banner/slider2.jpg" title="Slide2" /></a></li>
                            <li><a href="<?= isset($slider->block3) ? $slider->block3 : "#" ?>"><img alt="Slide3" src="<?= base_url() ?>upload/banner/slider3.jpg" title="Slide3" /></a></li>
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
<!-- end services -->
<style type="text/css">
    .widebanner1{
        height: 100px;
        padding: 10px !important;
        padding-left: 0px !important;
    }
    .widebanner2{
        height: 100px;
        padding: 10px !important;
        padding-right:  0px !important;
    }
    .messagebox{
        z-index: 999999;
        position: fixed;
        bottom : 0px;
        background-color: #ff3366;
        color: white;
        padding: 5px;
        border: 2px solid #ffffff;
    }
</style>
<!---->
<div class="content-page">
    <div class="container">
        <!-- featured category fashion -->
        <div class="category-featured">
            <nav class="navbar nav-menu nav-menu-red show-brand">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-brand"><a href="#"><img alt="fashion" src="<?= base_url() ?>webassets/data/fashion.png" />fashion</a></div>
                    <span class="toggle-menu"></span>
                    <!-- Collect the nav links, forms, and other content for toggling -->

                </div><!-- /.container-fluid -->
                <div id="elevator-1" class="floor-elevator">
                    <a href="#" class="btn-elevator up disabled fa fa-angle-up"></a>
                    <a href="#elevator-2" class="btn-elevator down fa fa-angle-down"></a>
                </div>
            </nav>
            <div class="category-banner">
                <div class="row">
                    <div class="col-md-6">
                        <div class="banner widebanner1" style="height:200px">
                            <a href="<?= $main->block1 ?>"><img alt="banner1" class="img-responsive" src="<?= base_url() ?>upload/banner/fashion1.jpg" style="height:200px"/></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class=" col-md-12 banner widebanner1" >
                                <a href="<?= $main->block1 ?>"><img alt="banner1" class="img-responsive" src="<?= base_url() ?>upload/banner/fashion2.jpg" /></a>
                            </div>
                            <div class=" col-md-12 banner widebanner1" >
                                <a href="<?= $main->block1 ?>"><img alt="banner1" class="img-responsive" src="<?= base_url() ?>upload/banner/fashion3.jpg" /></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>            
        </div>   
        <!-- end featured category fashion -->

        <!-- featured category sarees -->
        <div class="category-featured">
            <nav class="navbar nav-menu nav-menu-green show-brand">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-brand"><a href="#">Sarees</a></div>
                    <span class="toggle-menu"></span>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse">           
                        <ul class="nav navbar-nav">
                            <li class="active"><a data-toggle="tab" href="#SRA">Recently Added</a></li>
                            <li><a data-toggle="tab" href="#STS">Top Selling</a></li>
                            <li><a data-toggle="tab" href="#STR">Top Rated</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
                <div id="elevator-2" class="floor-elevator">
                    <a href="#elevator-1" class="btn-elevator up fa fa-angle-up"></a>
                    <a href="#elevator-3" class="btn-elevator down fa fa-angle-down"></a>
                </div>
            </nav>
            <div class="category-banner">
                <div class="col-sm-6 banner widebanner1">
                    <a href="<?= $saree->block1 ?>"><img alt="saree1" class="img-responsive" src="<?= base_url() ?>upload/banner/saree1.jpg" /></a>
                </div>
                <div class="col-sm-6 banner widebanner2">
                    <a href="<?= $saree->block2 ?>"><img alt="saree2" class="img-responsive" src="<?= base_url() ?>upload/banner/saree2.jpg" /></a>
                </div>
            </div>
            <!--            <div class="product-featured clearfix">
                            <div class="banner-featured">
                                <div class="featured-text"><span>featured</span></div>
                                <div class="banner-img">
                                    <a href="<?= $saree->block3 ?>"><img alt="saree3" src="<?= base_url() ?>upload/banner/saree3.jpg" /></a>
                                </div>
                            </div>-->
            <div class="product-featured-content">
                <div class="product-featured-list">
                    <div class="tab-container autoheight">
                        <!-- tab product -->
                        <!-- Saree Recently Added Start-->
                        <?php if (isset($SRA) && is_array($SRA)) { ?>
                            <div class="tab-panel active" id="SRA">
                                <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                    <?php foreach ($SRA as $val) { ?>
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
                        <?php } ?>
                        <!-- Saree Recently Added End--> 

                        <!-- Saree Top Selling Start-->
                        <?php if (isset($STS) && is_array($STS)) { ?>
                            <div class="tab-panel" id="STS">
                                <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                    <?php foreach ($STS as $val) { ?>
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
                        <?php } ?>
                        <!-- Saree Top Selling End-->                      

                        <!-- Saree Top Rated Start-->
                        <div class="tab-panel" id="STR">
                            <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                <?php foreach ($STR as $val) { ?>
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
                        <!-- Saree Top Rated End-->
                        <!-- tab product -->
                    </div>
                </div>
            </div>
            <!--            </div>-->
        </div>
        <!-- end featured category sarees-->

        <!-- featured category Kurtis -->
        <div class="category-featured">
            <nav class="navbar nav-menu nav-menu-orange show-brand">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-brand"><a href="#">Kurtis</a></div>
                    <span class="toggle-menu"></span>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse">           
                        <ul class="nav navbar-nav">
                            <li class="active"><a data-toggle="tab" href="#KRA">Recently Added</a></li>
                            <li><a data-toggle="tab" href="#KTS">Top Selling</a></li>
                            <li><a data-toggle="tab" href="#KTR">Top Rated</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
                <div id="elevator-3" class="floor-elevator">
                    <a href="#elevator-2" class="btn-elevator up fa fa-angle-up"></a>
                    <a href="#elevator-4" class="btn-elevator down fa fa-angle-down"></a>
                </div>
            </nav>
            <div class="category-banner">
                <div class="col-sm-6 banner widebanner1">
                    <a href="<?= $kurti->block1 ?>"><img alt="kurti1" class="img-responsive" src="<?= base_url() ?>upload/banner/kurti1.jpg" /></a>
                </div>
                <div class="col-sm-6 banner widebanner2">
                    <a href="<?= $kurti->block2 ?>"><img alt="kurti2" class="img-responsive" src="<?= base_url() ?>upload/banner/kurti2.jpg" /></a>
                </div>
            </div>
            <!--            <div class="product-featured clearfix">
                            <div class="banner-featured">
                                <div class="featured-text"><span>featured</span></div>
                                <div class="banner-img">
                                    <a href="<?= $kurti->block3 ?>"><img alt="kurti3" src="<?= base_url() ?>upload/banner/kurti3.jpg" /></a>
                                </div>
                            </div>-->
            <div class="product-featured-content">
                <div class="product-featured-list">
                    <div class="tab-container autoheight">
                        <!-- tab product -->
                        <!-- Kurtis Recently Added Start-->
                        <?php if (isset($KRA) && is_array($KRA)) { ?>
                            <div class="tab-panel active" id="KRA">
                                <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                    <?php foreach ($KRA as $val) { ?>
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
                        <?php } ?>
                        <!-- Kurtis Recently Added End-->  

                        <!-- Kurtis Top Selling Start-->
                        <?php if (isset($KTS) && is_array($KTS)) { ?>
                            <div class="tab-panel" id="KTS">
                                <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                    <?php foreach ($KTS as $val) { ?>
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
                        <?php } ?>
                        <!-- Kurtis Top Selling End-->                      

                        <!-- Kurtis Top Rated Start-->
                        <div class="tab-panel" id="KTR">
                            <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                <?php foreach ($KTR as $val) { ?>
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
                        <!-- Kurtis Top Rated End-->
                        <!-- tab product -->
                    </div>
                </div>
            </div>
            <!--            </div>-->
        </div>
        <!-- end featured category Kurtis-->

        <!-- featured category salwar -->
        <div class="category-featured">
            <nav class="navbar nav-menu nav-menu-blue show-brand">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-brand"><a href="#">Salwar Kurta</a></div>
                    <span class="toggle-menu"></span>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse">           
                        <ul class="nav navbar-nav">
                            <li class="active"><a data-toggle="tab" href="#SLRA">Recently Added</a></li>
                            <li><a data-toggle="tab" href="#SLTS">Top Selling</a></li>
                            <li><a data-toggle="tab" href="#SLTR">Top Rated</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
                <div id="elevator-4" class="floor-elevator">
                    <a href="#elevator-3" class="btn-elevator up fa fa-angle-up"></a>
                    <a href="#elevator-5" class="btn-elevator down fa fa-angle-down"></a>
                </div>
            </nav>
            <div class="category-banner">
                <div class="col-sm-6 banner widebanner1" >
                    <a href="<?= $salwar->block1 ?>"><img alt="salwar1" class="img-responsive" src="<?= base_url() ?>upload/banner/salwar1.jpg" /></a>
                </div>
                <div class="col-sm-6 banner widebanner2" >
                    <a href="<?= $salwar->block2 ?>"><img alt="salwar2" class="img-responsive" src="<?= base_url() ?>upload/banner/salwar2.jpg" /></a>
                </div>
            </div>
            <!--            <div class="product-featured clearfix">
                            <div class="banner-featured">
                                <div class="featured-text"><span>featured</span></div>
                                <div class="banner-img">
                                    <a href="<?= $salwar->block3 ?>"><img alt="salwar3" src="<?= base_url() ?>upload/banner/salwar3.jpg" /></a>
                                </div>
                            </div>-->
            <div class="product-featured-content">
                <div class="product-featured-list">
                    <div class="tab-container autoheight">
                        <!-- tab product -->
                        <!-- Salwar Recently Added Start-->
                        <?php if (isset($SLRA) && is_array($SLRA)) { ?>
                            <div class="tab-panel active" id="SLRA">
                                <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                    <?php foreach ($SLRA as $val) { ?>
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
                        <?php } ?>
                        <!-- Salwar Recently Added End-->  

                        <!-- Salwar Top Selling Start-->
                        <?php if (isset($SLTS) && is_array($SLTS)) { ?>
                            <div class="tab-panel" id="SLTS">
                                <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                    <?php foreach ($SLTS as $val) { ?>
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
                        <?php } ?>
                        <!-- Salwar Top Selling End-->                      

                        <!-- Salwar Top Rated Start-->
                        <div class="tab-panel" id="SLTR">
                            <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                <?php foreach ($SLTR as $val) { ?>
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
                        <!-- Salwar Top Rated End-->
                        <!-- tab product -->                            
                    </div>
                </div>
            </div>
            <!--            </div>-->
        </div>
        <!-- end featured category salwar-->

        <!-- featured category lehenga cholis -->
        <div class="category-featured">
            <nav class="navbar nav-menu nav-menu-blue2 show-brand">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-brand"><a href="#">Lehenga Cholis</a></div>
                    <span class="toggle-menu"></span>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse">           
                        <ul class="nav navbar-nav">
                            <li class="active"><a data-toggle="tab" href="#CRA">Recently Added</a></li>
                            <li><a data-toggle="tab" href="#CTS">Top Selling</a></li>
                            <li><a data-toggle="tab" href="#CTR">Top Rated</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
                <div id="elevator-5" class="floor-elevator">
                    <a href="#elevator-4" class="btn-elevator up fa fa-angle-up"></a>
                    <a href="#elevator-6" class="btn-elevator down fa fa-angle-down"></a>
                </div>
            </nav>
            <div class="category-banner">
                <div class="col-sm-6 banner widebanner1" >
                    <a href="<?= $choli->block1 ?>"><img alt="lehenga choli1" class="img-responsive" src="<?= base_url() ?>upload/banner/choli1.jpg" /></a>
                </div>
                <div class="col-sm-6 banner widebanner2">
                    <a href="<?= $choli->block2 ?>"><img alt="lehenga choli2" class="img-responsive" src="<?= base_url() ?>upload/banner/choli2.jpg" /></a>
                </div>
            </div>
            <!--            <div class="product-featured clearfix">
                            <div class="banner-featured">
                                <div class="featured-text"><span>featured</span></div>
                                <div class="banner-img">
                                    <a href="<?= $choli->block3 ?>"><img alt="lehenga choli3" src="<?= base_url() ?>upload/banner/choli3.jpg" /></a>
                                </div>
                            </div>-->
            <div class="product-featured-content">
                <div class="product-featured-list">
                    <div class="tab-container autoheight">
                        <!-- tab product -->
                        <!-- Lehenga choli Recently Added Start-->
                        <?php if (isset($CRA) && is_array($CRA)) { ?>
                            <div class="tab-panel active" id="CRA">
                                <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                    <?php foreach ($CRA as $val) { ?>
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
                        <?php } ?>
                        <!-- Lehenga choli Recently Added End-->

                        <!-- Lehenga choli Top Selling Start-->
                        <?php if (isset($CTS) && is_array($CTS)) { ?>
                            <div class="tab-panel" id="CTS">
                                <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                    <?php foreach ($CTS as $val) { ?>
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
                        <?php } ?>
                        <!-- Lehenga choli Top Selling End-->                      

                        <!-- Lehenga choli Top Rated Start-->
                        <div class="tab-panel" id="CTR">
                            <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                <?php foreach ($CTR as $val) { ?>
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
                        <!-- Lehenga choli Top Rated End-->
                        <!-- tab product --> 
                    </div>
                </div>
            </div>
            <!--            </div>-->
        </div>
        <!-- end featured category lehenga choli-->

        <!-- featured category dress material -->
        <div class="category-featured">
            <nav class="navbar nav-menu nav-menu-gray show-brand">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-brand"><a href="#">Dress Material</a></div>
                    <span class="toggle-menu"></span>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse">           
                        <ul class="nav navbar-nav">
                            <li class="active"><a data-toggle="tab" href="#DRA">Recently Added</a></li>
                            <li><a data-toggle="tab" href="#DTS">Top Selling</a></li>
                            <li><a data-toggle="tab" href="#DTR">Top Rated</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
                <div id="elevator-6" class="floor-elevator">
                    <a href="#elevator-5" class="btn-elevator up fa fa-angle-up"></a>
                    <a href="#" class="btn-elevator disabled down fa fa-angle-down"></a>
                </div>
            </nav>
            <div class="category-banner">
                <div class="col-sm-6 banner widebanner1">
                    <a href="<?= $dress->block1 ?>"><img alt="dress1" class="img-responsive" src="<?= base_url() ?>upload/banner/dress1.jpg" /></a>
                </div>
                <div class="col-sm-6 banner widebanner2">
                    <a href="<?= $dress->block2 ?>"><img alt="dress2" class="img-responsive" src="<?= base_url() ?>upload/banner/dress2.jpg" /></a>
                </div>
            </div>
            <!--            <div class="product-featured clearfix">
                            <div class="banner-featured">
                                <div class="featured-text"><span>featured</span></div>
                                <div class="banner-img">
                                    <a href="<?= $dress->block3 ?>"><img alt="dress3" src="<?= base_url() ?>upload/banner/dress3.jpg" /></a>
                                </div>
                            </div>-->
            <div class="product-featured-content">
                <div class="product-featured-list">
                    <div class="tab-container autoheight">
                        <!-- tab product -->
                        <!-- Dress Material Recently Added Start-->
                        <?php if (isset($DRA) && is_array($DRA)) { ?>
                            <div class="tab-panel active" id="DRA">
                                <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                    <?php foreach ($DRA as $val) { ?>
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
                        <?php } ?>
                        <!-- Dress Material Recently Added End--> 

                        <!-- Dress Material Top Selling Start-->
                        <?php if (isset($DTS) && is_array($DTS)) { ?>
                            <div class="tab-panel" id="CTS">
                                <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                    <?php foreach ($DTS as $val) { ?>
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
                        <?php } ?>
                        <!-- Dress Material Top Selling End-->                      

                        <!-- Dress Material Top Rated Start-->
                        <div class="tab-panel" id="DTR">
                            <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                <?php foreach ($DTR as $val) { ?>
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
                        <!-- Dress Material Top Rated End-->
                        <!-- tab product --> 
                    </div>

                </div>
            </div>
            <!--            </div>-->
        </div>
        <!-- end featured category dress material-->

        <!-- Baner bottom -->
        <div class="row banner-bottom">
            <div class="col-sm-6">
                <div class="banner-boder-zoom">
                    <a href="<?= $footer->block1 ?>"><img alt="footer 1" class="img-responsive" src="<?= base_url() ?>upload/banner/footer1.jpg" /></a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="banner-boder-zoom">
                    <a href="<?= $footer->block2 ?>"><img alt="footer 2" class="img-responsive" src="<?= base_url() ?>upload/banner/footer2.jpg" /></a>
                </div>
            </div>
        </div>
        <!-- end banner bottom -->
    </div>
    <!--    <div class="messagebox">
            <h3>Please Do not purchase any product,Currently site in testing mode.You can purchase item after some few days.</h3>
        </div>-->
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
<?php $popupstatus = $this->common->getPopupStatus();?>
<script type="text/javascript">
    $(document).ready(function() {
<?php if($popupstatus == 1){ ?>        
        if(sessionStorage.getItem("popupstatus") === null) { 
            $('#popup').trigger('click');
            sessionStorage.setItem('popupstatus','1');
        }         
<?php } ?>        
<?php if ($msg): ?>
        alertify.<?= $t ?>("<?= $m ?>");
<?php endif; ?>
    });
</script>