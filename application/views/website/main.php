<?php
//echo "<pre>";
//print_r($colour);
//die();
?>

<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="#" title="Return to Home">Home</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">Fashion</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <!-- Left colunm -->
            <div class="column col-xs-12 col-sm-3" id="left_column">

                <!-- block filter -->
                <div class="block left-module">
                    <p class="title_block">Filter selection</p>
                    <div class="block_content">
                        <!-- layered -->
                        <div class="layered layered-filter-price">                            
                            <!-- filter price -->
                            <div class="layered_subtitle">price</div>
                            <div class="layered-content slider-range">
                                <div data-label-reasult="Range:" data-min="0" data-max="50000" data-unit="Rs" class="slider-range-price myfilter" data-value-min="0" data-value-max="3500"></div>
                                <div class="amount-range-price">Range: Rs 0 - Rs 3500</div>
                                <input id="min_price" type="hidden" class="min-price" value="0"/>
                                <input id="max_price" type="hidden" class="max-price" value="0"/>

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
                            <!-- ./filter size -->
                            <?php if (isset($size) && is_array($size)) { ?> 
                                <div class="layered_subtitle">Size</div>
                                <div class="layered-content filter-size">
                                    <ul class="check-box-list">
                                        <?php foreach ($size as $val) { ?>
                                            <li>
                                                <input type="checkbox" id="size<?= $val['variation_id'] ?>" name="variation[]" value="<?= $val['variation_id'] ?>" class="myfilter"/>
                                                <label for="size<?= $val['variation_id'] ?>">
                                                    <span class="button"></span><?= $val['variation_name'] ?>
                                                </label>   
                                            </li>
                                        <?php } ?>  
                                    </ul>
                                </div>
                            <?php } ?>  
                            <!-- ./filter size -->
                            <!-- ./filter type -->
                            <?php if (isset($type) && is_array($type)) { ?> 
                                <div class="layered_subtitle">Type</div>
                                <div class="layered-content filter-size">
                                    <ul class="check-box-list">
                                        <?php foreach ($type as $val) { ?>
                                        <li style="width:100%">
                                                <input type="checkbox" id="type<?= $val['variation_id'] ?>" name="variation[]" value="<?= $val['variation_id'] ?>" class="myfilter"/>
                                                <label for="type<?= $val['variation_id'] ?>">
                                                    <span class="button"></span><?= $val['variation_name'] ?>
                                                </label>   
                                            </li>
                                        <?php } ?>  
                                    </ul>
                                </div>
                            <?php } ?>  
                            <!-- ./filter type -->
                            <!-- ./filter fabric -->
                            <?php if (isset($fabric) && is_array($fabric)) { ?> 
                                <div class="layered_subtitle">Fabric</div>
                                <div class="layered-content filter-size">
                                    <ul class="check-box-list">
                                        <?php foreach ($fabric as $val) { ?>
                                            <li style="width:100%">
                                                <input type="checkbox" id="fabric<?= $val['variation_id'] ?>" name="variation[]" value="<?= $val['variation_id'] ?>" class="myfilter"/>
                                                <label for="fabric<?= $val['variation_id'] ?>">
                                                    <span class="button"></span><?= $val['variation_name'] ?>
                                                </label>   
                                            </li>
                                        <?php } ?>  
                                    </ul>
                                </div>
                            <?php } ?>  
                            <!-- ./filter fabric -->
                            <!-- ./filter pattern -->
                            <?php if (isset($work) && is_array($work)) { ?> 
                                <div class="layered_subtitle">Pattern</div>
                                <div class="layered-content filter-size">
                                    <ul class="check-box-list">
                                        <?php foreach ($work as $val) { ?>
                                            <li style="width:100%">
                                                <input type="checkbox" id="work<?= $val['variation_id'] ?>" name="variation[]" value="<?= $val['variation_id'] ?>" class="myfilter"/>
                                                <label for="work<?= $val['variation_id'] ?>">
                                                    <span class="button"></span><?= $val['variation_name'] ?>
                                                </label>   
                                            </li>
                                        <?php } ?>  
                                    </ul>
                                </div>
                            <?php } ?>  
                            <!-- ./filter pattern -->
                            <!-- ./filter sleeve -->
                            <?php if (isset($sleeve) && is_array($sleeve)) { ?> 
                                <div class="layered_subtitle">Sleeve</div>
                                <div class="layered-content filter-size">
                                    <ul class="check-box-list">
                                        <?php foreach ($sleeve as $val) { ?>
                                            <li style="width:100%">
                                                <input type="checkbox" id="sleeve<?= $val['variation_id'] ?>" name="variation[]" value="<?= $val['variation_id'] ?>" class="myfilter"/>
                                                <label for="sleeve<?= $val['variation_id'] ?>">
                                                    <span class="button"></span><?= $val['variation_name'] ?>
                                                </label>   
                                            </li>
                                        <?php } ?>  
                                    </ul>
                                </div>
                            <?php } ?>  
                            <!-- ./filter sleeve -->
                            <!-- ./filter Occasion -->
                            <?php if (isset($occasion) && is_array($occasion)) { ?> 
                                <div class="layered_subtitle">Occasion</div>
                                <div class="layered-content filter-size">
                                    <ul class="check-box-list">
                                        <?php foreach ($occasion as $val) { ?>
                                            <li style="width:100%">
                                                <input type="checkbox" id="occasion<?= $val['variation_id'] ?>" name="variation[]" value="<?= $val['variation_id'] ?>" class="myfilter"/>
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
                <!-- category-slider -->
                <div class="category-slider">
                    <ul class="owl-carousel owl-style2" data-dots="false" data-loop="true" data-nav = "true" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-items="1">
                        <li>
                            <img src="<?= base_url() ?>webassets/data/category-slide.jpg" alt="category-slider">
                        </li>
                        <li>
                            <img src="<?= base_url() ?>webassets/data/slide-cart2.jpg" alt="category-slider">
                        </li>
                    </ul>
                </div>
                <!-- ./category-slider -->

                <!-- view-product-list-->
                <div id="view-product-list" class="view-product-list">
                    <h2 class="page-heading">
                        <span class="page-heading-title">Women</span>
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
                    <ul class="row product-list grid">
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
                                                <a title="Add to Cart" href="#">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="<?= site_url() ?>product?pname=<?= str_replace(" ", "-", $val->product_name) ?>&pid=<?= base64_encode($val->product_id) ?>"><?= $val->product_name ?></a></h5>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
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
                    </ul>
                    <!-- ./PRODUCT LIST -->
                </div>
                <!-- ./view-product-list-->
                <div class="sortPagiBar">
                    <div class="bottom-pagination">
                        <nav>
                            <ul class="pagination">
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li>
                                    <a href="#" aria-label="Next">
                                        <span aria-hidden="true">Next &raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="show-product-item">
                        <select name="">
                            <option value="">Show 18</option>
                            <option value="">Show 20</option>
                            <option value="">Show 50</option>
                            <option value="">Show 100</option>
                        </select>
                    </div>
                    <div class="sort-product">
                        <select>
                            <option value="">Product Name</option>
                            <option value="">Price</option>
                        </select>
                        <div class="sort-product-icon">
                            <i class="fa fa-sort-alpha-asc"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./ Center colunm -->
        </div>
        <!-- ./row-->
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.myfilter').click(function(){
            console.clear();
           $('input[name="variation[]"]:checked').each(function(){
               console.log($(this).val());
           });
           
        });
    });
</script>