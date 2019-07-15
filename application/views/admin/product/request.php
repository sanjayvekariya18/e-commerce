<section role="main" class="content-body">
    <header class="page-header">
        <h2>Product Approve Request Management</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
            </ol>

        </div>
    </header>
    <!-- start: page -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>                        
                    </div>

                    <h2 class="panel-title">Advance Search</h2>                    
                </header>
                <div class="panel-body"> 
                    <form id="search" name="search" method="POST" action="<?= site_url() ?>admin/product_request/search">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Sub Category Name</label>
                            <div class="col-md-4">
                                <select id="sub_category_id" name="sub_category_id" class="form-control">
                                    <option value="-1">--Select--</option>
                                    <?php
                                    if (isset($subcategory)) {
                                        foreach ($subcategory as $val) {
                                            ?>
                                            <option value="<?= $val->subcategory_id ?>"
                                            <?php
                                            if (isset($_POST['sub_category_id'])) {
                                                if ($val->subcategory_id == $_POST['sub_category_id']) {
                                                    echo "selected";
                                                }
                                            }
                                            ?>><?= $val->subcategory_name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                </select> 
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-success btn-sm" type="submit" style="width:80px">Search</button>
                            </div>
                        </div> 
                    </form>
                </div>
            </section>            
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>                                    
                    </div>
                    <h2 class="panel-title">Approval Request Details</h2>
                </header>
                <div class="panel-body">
                    <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                    <table class="table table-striped mb-none" id="datatable-default">
                        <thead>
                            <tr>                                
                                <th style="width:60%">Product details</th>
                                <th style="width:15%">Units in stock</th>
                                <th>Selling price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($products)) {
                                foreach ($products as $val) {
                                    ?>
                                    <tr>                                        
                                        <td>
                                            <img src="<?= $val->image_thumb ?>" width="100" height="100" style="border:1px;float: left;margin-right: 25px;"/>
                                            <table>
                                                <tr>
                                                    <td colspan="2"><label class="text-dark" style="font-weight: bold">SKU:  <?= $val->sku ?></label></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><label class="text-primary" style="font-weight: bold"><?= $val->product_name ?></label></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;"><label class="text-dark" style="font-weight: bold">SUPC</label></td>
                                                    <td><label class="text-dark"><?= $val->product_supc ?></label></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;"><label class="text-dark" style="font-weight: bold">Brand</label></td>
                                                    <td><label class="text-dark"><?= $val->brand ?></label></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;"><label class="text-dark" style="font-weight: bold">Style Code</label></td>
                                                    <td><label class="text-dark"><?= $val->style_code ?></label></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="text-align: center"><label class="text-dark" style="font-weight: bold"><?= $val->qty ?></label></td>
                                        <td>
                                            <table>
                                                <tr>
                                                    <td><label class="text-dark" style="font-weight: bold">Selling Price</label></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="text-primary" style="font-weight: bold"><?= $val->selling_price ?></label></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="text-dark" style="font-weight: bold">Competitive Price</label></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="text-primary" style="font-weight: bold"><?php
                                                            if (isset($competitive)) {
                                                                foreach ($competitive as $compval) {
                                                                    if ($compval->product_supc == $val->product_supc) {
                                                                        echo $compval->competitive_price;
                                                                    }
                                                                }
                                                            }
                                                            ?></label></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right"><a class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn-default view" href="#modalView" id="<?= $val->product_id ?>">View</a></td>
                                                    <td style="text-align: right;"><a class="mb-xs mt-xs mr-xs btn btn-default" href="<?= site_url() ?>admin/product_request/view?pid=<?= base64_encode($val->product_id) ?>"target="_blank">Preview</a></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
    <!--product Edit Model Start-->
    <div id="modalView" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
        <form id="modelViewProduct" method="POST" action="#">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">View Product</h2>
                </header>
                <div class="panel-body">
                    <input type="hidden" id="product_id" name="product_id" value=""/>
                    <div class="row">
                        <div class="col-md-4" style="padding: 0px 30px;border-right: 1px solid #eeeeee;">
                            <div class="row">
                                <div class="col-md-12">
                                    <img id="Vmodel_image" src="" width="100" height="125" style="border:1px;margin-bottom: 5px;"/>
                                </div>                                                
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label id="VEmodel_product_name" class="text-primary" style="font-weight: bold"></label>
                                </div>                                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-dark" style="font-weight: bold">Seller Id</label>
                                </div> 
                                <div class="col-md-6">
                                    <label id="Vmodel_seller_id"  class="text-dark"></label>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-dark" style="font-weight: bold">SUPC No</label>
                                </div> 
                                <div class="col-md-6">
                                    <label id="VEmodel_product_supc" class="text-dark"></label>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-dark" style="font-weight: bold">Brand</label>
                                </div> 
                                <div class="col-md-6">
                                    <label id="VEmodel_brand" class="text-dark"></label>
                                </div>                                               
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-dark" style="font-weight: bold">Style Code</label>
                                </div> 
                                <div class="col-md-6">
                                    <label id="VEmodel_style_code" class="text-dark"></label>
                                </div>                                               
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-dark" style="font-weight: bold">Status</label>
                                </div> 
                                <div class="col-md-6">
                                    <select id="approve_status" name="approve_status" class="form-control">
                                        <option  value="1">Approve</option>                                    
                                        <option  value="2">Reject</option>
                                        <option  value="3">Deleted</option>
                                    </select>
                                </div>                                               
                            </div>
                            <div class="row" id="reason_block" style="display:none;margin-top: 5px">
                                <div class="col-md-6">
                                    <label class="text-dark" style="font-weight: bold">Reason</label>
                                </div> 
                                <div class="col-md-6">
                                    <textarea id="reject_reason" name="reject_reason" class="form-control"></textarea>
                                </div>                                               
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="text-dark" style="font-weight: bold">SKU</label>
                                </div>
                                <div class="col-md-4">
                                    <label id="VEmodel_sku" class="text-dark" style="font-weight: bold"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="text-dark" style="font-weight: bold">Description</label>
                                </div>
                                <div class="col-md-9">
                                    <label id="VEmodel_product_desc" class="text-dark" style="font-weight: bold">Nullam quiris risus eget urna mollis ornare vel eu leo. Soccis natoque penatibus et magnis dis parturient montes. Soccis natoque penatibus et magnis dis parturient montes.</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="text-dark" style="font-weight: bold">MRP</label>
                                </div>
                                <div class="col-md-4">
                                    <label id="VEmodel_product_mrp" class="text-dark" style="font-weight: bold">8000</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="text-dark" style="font-weight: bold">Selling Price</label>
                                </div>
                                <div class="col-md-4">
                                    <label id="VEmodel_product_selling_price" class="text-dark" style="font-weight: bold">6000</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="text-dark" style="font-weight: bold">Settlement Price</label>
                                </div>
                                <div class="col-md-4">
                                    <label id="VEmodel_product_settlement_price" class="text-dark" style="font-weight: bold">4200</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="text-dark" style="font-weight: bold">Product Tag</label>
                                </div>
                                <div class="col-md-4">
                                    <label id="VEmodel_product_tag" class="text-dark" style="font-weight: bold"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="text-dark" style="font-weight: bold">Weight</label>
                                </div>
                                <div class="col-md-4">
                                    <label id="VEmodel_product_weight" class="text-dark" style="font-weight: bold"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="text-dark" style="font-weight: bold">Shipping Time</label>
                                </div>
                                <div class="col-md-4">
                                    <label id="VEmodel_shipping_time" class="text-dark" style="font-weight: bold"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="text-dark" style="font-weight: bold">Quantity</label>
                                </div>
                                <div class="col-md-4">
                                    <label id="VEmodel_product_qty" class="text-dark" style="font-weight: bold"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table width="100%" class="table table-bordered center">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center">Variation Type</th>
                                                <th style="text-align: center">Variation Name</th>
                                            </tr>
                                        </thead>
                                        <tbody class="vbody">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                           
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button id="viewconfirm" class="btn btn-primary modal-confirm">Confirm</button>
                            <button class="btn btn-default modal-dismiss">Cancel</button>
                        </div>
                    </div>
                </footer>
            </section>
        </form>
    </div>
    <!--product Edit Model End--> 
    <!-- end: page -->
</section>
<?php $msg = $this->input->get('msg'); ?>
<?php
switch ($msg) {
    case "S":
        $m = "Information Successfully Updated..!";
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

<script type="text/javascript">
    $(function() {
        $('#datatable-default').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2]
                }],
            iDisplayLength: -1
        });
        
        $("#btnExport1").click(function () {
            $("#datatable-default").btechco_excelexport({
                containerid: "datatable-default",              
                datatype: $datatype.Table
            });
        });

        $('#approve_status').change(function() {
            if ($(this).val() == '2')
            {
                $('#reason_block').css('display', 'block');
            }
            else {
                $('#reason_block').css('display', 'none');
                $('#reject_reason').val('');
            }
        });
        $('.view').click(function() {
            $('.vbody').html('');
            $product_id = $(this).prop('id');
            $variation_id = "";
            $.ajax({
                url: "<?= site_url() ?>admin/product/getProduct",
                type: 'POST',
                data: {'product_id': $product_id},
                success: function(data, textStatus, jqXHR) {

                    $product = JSON.parse(data);
                    $variation_id = $product['variation_id'];

                    $('#product_id').val($product['product_id']);
                    $('#Vmodel_seller_id').html($product['seller_id']);
                    $('#Vmodel_image').prop('src', $product['image_thumb']);
                    $('#VEmodel_product_name').html($product['product_name']);
                    $('#VEmodel_product_supc').html($product['product_supc']);
                    $('#VEmodel_brand').html($product['brand']);
                    $('#VEmodel_style_code').html($product['style_code']);
                    $('#VEmodel_product_desc').html($product['product_desc']);
                    $('#VEmodel_sku').html($product['sku']);
                    $('#VEmodel_product_mrp').html($product['mrp']);
                    $('#VEmodel_product_selling_price').html($product['selling_price']);
                    $('#VEmodel_product_settlement_price').html($product['settlement_price']);
                    $('#VEmodel_product_tag').html($product['product_tag']);
                    $('#VEmodel_product_weight').html($product['weight']);
                    $('#VEmodel_shipping_time').html($product['shipping_time']);
                    $('#VEmodel_product_qty').html($product['qty']);

                    if ($product['main_category_id'] == 2) {
                        $newtr = "<tr><td style='text-transform: capitalize;'>Width</td><td style='text-transform: capitalize;'>" + $product['width'] + "</td></tr>" +
                                "<tr><td style='text-transform: capitalize;'>Height</td><td style='text-transform: capitalize;'>" + $product['height'] + "</td></tr>" +
                                "<tr><td style='text-transform: capitalize;'>Length</td><td style='text-transform: capitalize;'>" + $product['length'] + "</td></tr>" +
                                "<tr><td style='text-transform: capitalize;'>Diameter</td><td style='text-transform: capitalize;'>" + $product['diameter'] + "</td></tr>";
                        $('.vbody').append($newtr);
                    } else if ($product['main_category_id'] == 3) {

                        $newtr = "<tr><td style='text-transform: capitalize;'>Length</td><td style='text-transform: capitalize;'>" + $product['length'] + "</td></tr>" +
                                "<tr><td style='text-transform: capitalize;'>Brand Name</td><td style='text-transform: capitalize;'>" + $product['company'] + "</td></tr>";
                        $('.vbody').append($newtr);
                    }

                    $.ajax({
                        url: "<?= site_url() ?>admin/product/getProductVariation",
                        type: 'POST',
                        data: {'variation_id': $variation_id},
                        success: function(data, textStatus, jqXHR) {
                            $variation = JSON.parse(data);
                            $.each($variation, function(k, v) {
                                var variation_name = k.replace(/_/g, " ");
                                $newtr = "<tr><td style='text-transform: capitalize;'>" + variation_name + "</td><td style='text-transform: capitalize;'>" + v + "</td></tr>";
                                $('.vbody').append($newtr);
                            });
                        }
                    });

                }
            });


        });
        $('#viewconfirm').click(function() {
            $.ajax({
                url: '<?= site_url() ?>admin/product/modelViewProductRequest',
                type: 'post',
                data: $('#modelViewProduct').serialize(),
                success: function(data, textStatus, jqXHR) {
                    alertify.success("Product Information Updated");
                    location.reload(true);
                }
            });
        });
    });
</script>
