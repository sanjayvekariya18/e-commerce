<div class="listview" style="display:<?= ($layout == '1') ? "none" : "block" ?>">
    <?php
    $count = 0;
    foreach ($products as $key => $val) {
        if ($key >= $start && $productLimit > $count) {
            ?>
            <div class = 'col-md-3 col-sm-6 c-margin-b-20'>
                <div class = 'c-content-product-2 c-bg-white c-border'>
                    <div class = 'c-content-overlay'>
                        <a href = 'fullview.html?id=<?= $val->product_id ?>'>
                            <div class = 'c-bg-img-center c-overlay-object' data-height = 'height' style = 'height: 300px; background-size: 100% 300px;background-image: url(" <?= $val->image_medium ?> ")'></div>
                        </a>
                    </div>
                    <div class = 'c-info'>
                        <p class = 'c-title c-font-16 c-font-slim'><a href = 'fullview.html?id=<?= $val->product_id ?>'><?= substr($val->product_name, 0, 30) ?></a></p>
                        <p class = 'c-price c-font-14 c-font-slim' style="display: inline-block;float: right;"><i class="fa fa-rupee"> </i> <?= $val->selling_price ?>
                            <span class = 'c-font-14 c-font-line-through c-font-red'><i class="fa fa-rupee"> </i> <?= $val->mrp ?> </span>
                        </p>   
                        <div class="c-product-review">
                            <div class="c-product-rating" style="font-size: 12px">
                                <?php
                                if ($val->product_rating != 0) {
                                    $star = explode(".", $val->product_rating);
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
                    <div class = 'btn-group btn-group-justified' role = 'group'>
                        <div class = 'btn-group c-border-top' role = 'group'>
                            <a href = 'fullview.html?id=<?= $val->product_id ?>' class = 'btn btn-sm c-btn-white c-btn-uppercase c-btn-square c-font-grey-3 c-font-white-hover c-bg-red-2-hover c-btn-product'>View Product</a>
                        </div>                       
                    </div>
                </div>
            </div>
            <?php
            $count = $count + 1;
        }
    }
    ?>
</div>
<div class="gridview" style="display:<?= ($layout == '1') ? "block" : "none" ?>">
    <?php
    $count = 0;
    foreach ($products as $key => $val) {
        if ($key >= $start && $productLimit > $count) {
            ?>
            <div class="category">
                <div class="c-content-product-2 c-bg-white">
                    <div class="c-content-overlay">
                        <a href='fullview.html?id=<?= $val->product_id ?>'>
                            <div class="c-bg-img-center c-overlay-object" data-height="height" style="background-image: url(<?= $val->image_thumb ?>);height: 300px; background-size: 100% 300px;"></div>
                        </a>
                    </div>
                    <div class="c-info">
                        <p class="c-title c-font-12 c-font-slim"><a href='fullview.html?id=<?= $val->product_id ?>'><?= substr($val->product_name, 0, 20) ?></a></p>
                        <p class="c-price c-font-14 c-font-slim"><i class="fa fa-rupee"> </i> <?= $val->selling_price ?> &nbsp;
                            <span class="c-font-16 c-font-line-through c-font-red"><i class="fa fa-rupee"> </i> <?= $val->mrp ?></span>
                        </p>
                    </div>
                </div>
            </div>
            <?php
            $count = $count + 1;
        }
    }
    ?>
</div>