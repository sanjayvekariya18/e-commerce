<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="<?= site_url() ?>" title="Return to Home">Home</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">Lehenga Choli</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <!-- Left colunm -->
            <div class="column col-xs-12 col-sm-3 mobile-layout" id="left_column">

                <!-- block filter -->
                <div class="block left-module">
                    <p class="title_block">Filter selection</p>
                    <div class="block_content">
                        <!-- layered -->
                        <div class="layered layered-filter-price">                            
                            <!-- filter price -->
                            <div class="layered_subtitle">price</div>
                            <div class="layered-content slider-range">
                                <div data-label-reasult="Range:" data-min="0" data-max="10000" data-unit="Rs" class="slider-range-price myfilter" data-value-min="0" data-value-max="10000"></div>
                                <div class="amount-range-price">Range: Rs 0 - Rs 10000</div>
                                <input id="min_price" type="hidden" class="min-price" value="0"/>
                                <input id="max_price" type="hidden" class="max-price" value="10000"/>

                            </div>
                            <!-- ./filter price -->
                            <!-- filter color -->
                            <?php if (isset($colour) && is_array($colour)) { ?> 
                                <div class="layered_subtitle">Color</div>
                                <div class="layered-content filter-color">
                                    <ul class="check-box-list">
                                        <?php foreach ($colour as $val) { ?>
                                            <li>
                                                <input type="checkbox" id="color<?= $val['variation_id'] ?>" name="variation[]" value="<?= $val['variation_id'] ?>" class="myfilter"/>
                                                <label style=" background:<?= $val['variation_code'] ?>;" for="color<?= $val['variation_id'] ?>"><span class="button"></span></label>   
                                            </li>
                                        <?php } ?>  
                                    </ul>
                                </div>
                            <?php } ?>
                            <!-- ./filter color --> 

                            <!-- ./filter type -->
                            <?php if (isset($type) && is_array($type)) { ?> 
                                <div class="layered_subtitle">Type</div>
                                <div class="layered-content filter-size">
                                    <ul class="check-box-list">
                                        <?php foreach ($type as $val) { ?>
                                            <li style="width:100%">
                                                <input type="checkbox" id="type<?= $val['variation_id'] ?>" name="variation[]" value="<?= $val['variation_id'] ?>" class="myfilter"
                                                <?php
                                                if ($this->input->get('id') != "") {
                                                    if ($this->input->get('id') == $val['variation_id']) {
                                                        echo "checked";
                                                    }
                                                }
                                                ?>/>
                                                <label for="type<?= $val['variation_id'] ?>">
                                                    <span class="button"></span><?= $val['variation_name'] ?>
                                                </label>   
                                            </li>
                                        <?php } ?>  
                                    </ul>
                                </div>
                            <?php } ?>  
                            <!-- ./filter type -->
                            <!-- ./filter fabric care -->
                            <?php if (isset($fabric_care) && is_array($fabric_care)) { ?> 
                                <div class="layered_subtitle">Fabric Care</div>
                                <div class="layered-content filter-size">
                                    <ul class="check-box-list">
                                        <?php foreach ($fabric_care as $val) { ?>
                                            <li style="width:100%">
                                                <input type="checkbox" id="fabriccare<?= $val['variation_id'] ?>" name="variation[]" value="<?= $val['variation_id'] ?>" class="myfilter"/>
                                                <label for="fabriccare<?= $val['variation_id'] ?>">
                                                    <span class="button"></span><?= $val['variation_name'] ?>
                                                </label>   
                                            </li>
                                        <?php } ?>  
                                    </ul>
                                </div>
                            <?php } ?>  
                            <!-- ./filter fabric care -->
                            <!-- ./filter fabric -->
                            <?php if (isset($fabric) && is_array($fabric)) { ?> 
                                <div class="layered_subtitle">Fabric</div>
                                <div class="layered-content filter-size">
                                    <ul class="check-box-list">
                                        <?php foreach ($fabric as $val) { ?>
                                            <li style="width:100%">
                                                <input type="checkbox" id="fabric<?= $val['variation_id'] ?>" name="variation[]" value="<?= $val['variation_id'] ?>" class="myfilter"
                                                <?php
                                                if ($this->input->get('id') != "") {
                                                    if ($this->input->get('id') == $val['variation_id']) {
                                                        echo "checked";
                                                    }
                                                }
                                                ?>/>
                                                <label for="fabric<?= $val['variation_id'] ?>">
                                                    <span class="button"></span><?= $val['variation_name'] ?>
                                                </label>   
                                            </li>
                                        <?php } ?>  
                                    </ul>
                                </div>
                            <?php } ?>  
                            <!-- ./filter fabric -->
                            <!-- ./filter blouse fabric -->
                            <?php if (isset($blouse_fabric) && is_array($blouse_fabric)) { ?> 
                                <div class="layered_subtitle">Blouse Fabric</div>
                                <div class="layered-content filter-size">
                                    <ul class="check-box-list">
                                        <?php foreach ($blouse_fabric as $val) { ?>
                                            <li style="width:100%">
                                                <input type="checkbox" id="blousefabric<?= $val['variation_id'] ?>" name="variation[]" value="<?= $val['variation_id'] ?>" class="myfilter"/>
                                                <label for="blousefabric<?= $val['variation_id'] ?>">
                                                    <span class="button"></span><?= $val['variation_name'] ?>
                                                </label>   
                                            </li>
                                        <?php } ?>  
                                    </ul>
                                </div>
                            <?php } ?>  
                            <!-- ./filter blouse fabric  -->
                            <!-- ./filter pattern -->
                            <?php if (isset($work) && is_array($work)) { ?> 
                                <div class="layered_subtitle">Pattern</div>
                                <div class="layered-content filter-size">
                                    <ul class="check-box-list">
                                        <?php foreach ($work as $val) { ?>
                                            <li style="width:100%">
                                                <input type="checkbox" id="work<?= $val['variation_id'] ?>" name="variation[]" value="<?= $val['variation_id'] ?>" class="myfilter"
                                                <?php
                                                if ($this->input->get('id') != "") {
                                                    if ($this->input->get('id') == $val['variation_id']) {
                                                        echo "checked";
                                                    }
                                                }
                                                ?>/>
                                                <label for="work<?= $val['variation_id'] ?>">
                                                    <span class="button"></span><?= $val['variation_name'] ?>
                                                </label>   
                                            </li>
                                        <?php } ?>  
                                    </ul>
                                </div>
                            <?php } ?>  
                            <!-- ./filter pattern -->                            
                            <!-- ./filter Occasion -->
                            <?php if (isset($occasion) && is_array($occasion)) { ?> 
                                <div class="layered_subtitle">Occasion</div>
                                <div class="layered-content filter-size">
                                    <ul class="check-box-list">
                                        <?php foreach ($occasion as $val) { ?>
                                            <li style="width:100%">
                                                <input type="checkbox" id="occasion<?= $val['variation_id'] ?>" name="variation[]" value="<?= $val['variation_id'] ?>" class="myfilter"
                                                <?php
                                                if ($this->input->get('id') != "") {
                                                    if ($this->input->get('id') == $val['variation_id']) {
                                                        echo "checked";
                                                    }
                                                }
                                                ?>/>
                                                <label for="occasion<?= $val['variation_id'] ?>">
                                                    <span class="button"></span><?= $val['variation_name'] ?>
                                                </label>   
                                            </li>
                                        <?php } ?>  
                                    </ul>
                                </div>
                            <?php } ?>  
                            <!-- ./filter Occasion -->
                        </div>
                        <!-- ./layered -->

                    </div>
                </div>
                <!-- ./block filter  -->               
            </div>
            <!-- ./left colunm -->
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9" id="center_column">

                <!-- view-product-list-->
                <div id="view-product-list" class="view-product-list">
                    <h2 class="page-heading">
                        <span class="page-heading-title">Womens Lehenga Cholis</span>
                    </h2>
                    <ul class="display-product-option">
                        <li class="view-as-grid selected">
                            <span>grid</span>
                        </li>
                        <li class="view-as-list">
                            <span>list</span>
                        </li>
                    </ul>
                    <!-- PRODUCT LIST -->
                    <ul class="row product-list grid productlist">
                        <div class="mobile-layout">
                            <?php
                            if (isset($products)) {
                                foreach ($products as $val) {
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
                        </div>
                        <!-- PRODUCT LIST FOR MOBILE LAYOUT -->
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
                        <!-- PRODUCT LIST FOR MOBILE LAYOUT END--> 
                    </ul>
                    <!-- ./PRODUCT LIST -->
                </div>

            </div>
            <!-- ./ Center colunm -->
        </div>
        <!-- ./row-->
    </div>
</div>
<div id="productload" class="screenhide" style="display:none;position: absolute;">  
    <img src="<?= base_url() ?>assets/images/loading_pink.gif" style="width: 100px;height: 100px"/>
</div>
<script type="text/javascript">
    $(document).ready(function() {       
        $variation_id = "";
        $minprice = 0;
        $maxprice = 0;
        $start = 0;
        $isFilter = 0;
        $productEnd = 1;
        $exFlag = 1;
        $('.myfilter').click(function() {
            $('html, body').animate({
                scrollTop: 0
            }, 500);
            $isFilter = 1;
            $start = 0;           
            $variation_id = "";
            $('input[name="variation[]"]:checked').each(function() {
                $variation_id += $(this).val() + ",";
            });
            $minprice = $('#min_price').val();
            $maxprice = $('#max_price').val();
            $variation_id = $variation_id.slice(0, -1);
            if ($exFlag)
            {
                $('#productload').css({top:500,left:$(window).width() / 2,display:"block"});
                $exFlag = 0;
                $.ajax({
                    url: "<?= site_url() ?>womens/lehengaCholisFilter",
                    type: "post",
                    data: {'min_price': $minprice, 'max_price': $maxprice, 'variation_id': $variation_id},
                    success: function(data, textStatus, jqXHR) {
                        $('#productload').css('display', 'none');
                        $exFlag = 1;
                        $('.productlist').html(data);
                        if (data != "") {
                            $productEnd = 1;
                        } else {
                            $productEnd = 0;
                        }
                    }
                });
            }
        });


        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() > $(document).height() - 300) {
                if ($exFlag)
                {
                    $exFlag = 0;
                    $start = $start + 24;
                    if ($productEnd) {
                        $('#productload').css({top:$(document).height() - 500,left:$(window).width() / 2,display:"block"});
                        if ($isFilter == 0) {
                            $.ajax({
                                url: "<?= site_url() ?>womens/pingLehengaCholis",
                                type: "post",
                                data: {'start': $start},
                                success: function(data, textStatus, jqXHR) {
                                    $exFlag = 1;
                                    $('.productlist').append(data);
                                    $('#productload').css('display', 'none');
                                    if (data != "") {
                                        $productEnd = 1;
                                    } else {
                                        $productEnd = 0;
                                    }
                                }
                            });
                        } else {
                            $.ajax({
                                url: "<?= site_url() ?>womens/PingFilterLehengaCholis",
                                type: "post",
                                data: {'start': $start, 'min_price': $minprice, 'max_price': $maxprice, 'variation_id': $variation_id},
                                success: function(data, textStatus, jqXHR) {
                                    $exFlag = 1;
                                    $('.productlist').append(data);
                                    $('#productload').css('display', 'none');
                                    if (data != "") {
                                        $productEnd = 1;
                                    } else {
                                        $productEnd = 0;
                                    }
                                }
                            });
                        }
                    } else {
                        $exFlag = 1;
                    }
                }
            }
        });
    });
</script>