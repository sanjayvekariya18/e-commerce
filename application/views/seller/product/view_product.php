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
                                <!--<p>Shipping Charge: <span style="color:#ff3366"><i class="fa fa-rupee"> </i><?= $product->shipping_charge ?></span></p>-->
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
                            <?php }
                            ?>
                        </div>
                    </div>

                    <!-- tab product -->
                    <div class="product-tab">
                        <ul class="nav-tab">
                            <li class="active">
                                <a aria-expanded="true" data-toggle="tab" href="#information">Information</a>
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
                                        ?>
                                        <tr>
                                            <td width="200" style="text-transform: capitalize;">Width</td>
                                            <td><?= $product->width ?> mm</td>
                                        </tr>
                                        <tr>
                                            <td width="200" style="text-transform: capitalize;">Height</td>
                                            <td><?= $product->height ?> mm</td>
                                        </tr>
                                        <tr>
                                            <td width="200" style="text-transform: capitalize;">Length</td>
                                            <td><?= $product->length ?> mm</td>
                                        </tr>
                                        <tr>
                                            <td width="200" style="text-transform: capitalize;">Diameter</td>
                                            <td><?= $product->diameter ?></td>
                                        </tr>
                                        <?php
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
                        </div>
                    </div>
                    <!-- ./tab product -->                                       
                </div>
                <!-- Product -->
            </div>
            <!-- ./ Center colunm -->
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
    });
</script>