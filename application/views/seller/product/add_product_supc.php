<section role="main" class="content-body">
    <header class="page-header">
        <h2>Add Product By SUPC</h2>

        <div class="right-wrapper pull-right" style="padding-right: 10px;">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>seller">
                        <i class="fa fa-home"></i>
                    </a>
                </li>                
                <li><span>Add Product By SUPC</span></li>
            </ol>           
        </div>
    </header>
    <!-- start: page -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel form-wizard panel-featured panel-featured-primary" id="w4">
                <header class="panel-heading">                    
                    <h2 class="panel-title">Add Product By SUPC</h2>
                </header>
                <div class="panel-body">
                    <form id="productsearchform" name="productserchform" class="form-horizontal" novalidate="novalidate" method="post" action="<?= site_url() ?>seller/product/searchBySupc">
                        <div class="form-group">
                            <label class="col-sm-3 control-label text-danger" >Product SUPC *</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="product_supc" value="">                                
                            </div>
                            <div class="col-md-1" style="margin-top: -5px;">
                                <button type="submit" class="mb-xs mt-xs mr-xs btn btn-warning">search</button>
                            </div>
                        </div>                        
                    </form>
                </div>
            </section>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <section class="panel form-wizard panel-featured panel-featured-primary" id="w4">
                <header class="panel-heading">                    
                    <h2 class="panel-title">Product List</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <?php
                        if (isset($products)) {
                            if (count($products) > 0) {
                                foreach ($products as $val) {
                                    ?>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img src="<?= $val->image_medium ?>" width="150" height="175" style="border:1px;float: left;margin-right: 25px;"/>
                                            </div>
                                            <div class="col-md-8">
                                                <label class="text-primary" style="font-weight: bold"><?= $val->product_name ?></label><br>
                                                <label class="text-dark" style="font-weight: bold">SUPC :  <?= $val->product_supc ?></label><br>
                                                <label class="text-dark" style="font-weight: bold">SKU :  <?= $val->sku ?></label><br>
                                                <label class="text-dark" style="font-weight: bold">Brand : <?= $val->brand ?></label><br>
                                                <label class="text-dark" style="font-weight: bold">Selling Price : <?= $val->selling_price ?></label><br>
                                                <a class="btn btn-primary" href="<?= site_url() ?>seller/product/getProductBySupc?id=<?= base64_encode($val->product_id) ?>" target="_blank" style="width: 145px;">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            } else {
                                ?>
                                <hr>
                                <h2 class="panel-title" style="text-align: center">No Product Found </h2>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>
<?php $msg = $this->input->get('msg'); ?>
<?php
switch ($msg) {
    case "S":
        $m = "Product Successfully Saved ..!";
        $t = "success";
        break;
    default:
        $m = 0;
        break;
}
?>
<script type="text/javascript">
    $(document).ready(function() {
<?php if ($msg): ?>
            alertify.<?= $t ?>("<?= $m ?>");
<?php endif; ?>
    });
</script>