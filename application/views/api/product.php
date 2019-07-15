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