<section role="main" class="content-body">
    <header class="page-header">
        <h2>Approval Request Management</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>seller">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
            </ol>
        </div>
    </header>
    <!-- start: page -->
<!--    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-up"></a>                        
                    </div>

                    <h2 class="panel-title">Advance Search</h2>                    
                </header>
                <div class="panel-body" style="display:none"> 
                    <form name="search" method="POST" action="<?= site_url() ?>seller/request/search">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Sub Category Name</label>
                            <div class="col-md-4">
                                <select id="sub_category_id" name="sub_category_id" class="form-control">
                                    <option value="-1">--Select--</option>
                                    <?php
                                    if (isset($subcategory)) {
                                        foreach ($subcategory as $val) {
                                            ?>
                                            <option value="<?= $val->subcategory_id ?>"><?= $val->subcategory_name ?></option>
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
    </div>-->
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
                    <table class="table table-striped mb-none" id="datatable-default1">
                        <thead>
                            <tr>
                                <th></th>
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
                                        <td style="text-align: center"></td>
                                        <td>
                                            <img src="<?= $val->image_medium ?>" width="100" height="100" style="border:1px;float: left;margin-right: 25px;"/>
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
                                                    <td style="text-align: right;"><a id="<?= $val->product_id ?>" class="mb-xs mt-xs mr-xs modal-with-move-anim calculator" href="#modalPrice"><i class="fa fa-th"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><label class="text-primary" style="font-weight: bold"><?= $val->selling_price ?></label></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><label class="text-dark" style="font-weight: bold">Competitive Price</label></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><label class="text-primary" style="font-weight: bold"><?php
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
                                                    <td style="text-align: right"><a class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn-default edit" href="#modalEdit" id="<?= $val->product_id ?>">Edit</a></td>
                                                    <td style="text-align: right;"><a class="mb-xs mt-xs mr-xs btn btn-default" href="<?= site_url() ?>seller/product/view?pid=<?= base64_encode($val->product_id) ?>"target="_blank">Preview</a></td>
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
    <!--Price Calculator Model Start -->
    <div id="modalPrice" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title">Commission Calculator</h2>
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                                <label class="text-dark" style="font-weight: bold;">Set Selling Price :</label>
                            </div>
                            <div class="col-md-2">
                                <input id="model_selling_price" name="sell_price" type="number" class="form-control" />
                            </div>
                        </div>                                    
                        <div class="row" style="margin-top:10px;">
                            <div class="col-md-12">
                                <table width="100%" class="table table-bordered" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">Commission</th>
                                            <th style="text-align: center">Fixed</th>
                                            <th style="text-align: center">Service Tax</th>
                                            <th style="text-align: center">Listing Fee</th>
                                            <th style="text-align: center">Marketing Fee</th>
                                            <th style="text-align: center">Payment Collection Fee</th>
                                            <th style="text-align: center">Other</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><label id="" class="text-dark tcommission_sales"></label> (<label class="text-dark tcommissionrate"></label>%)</td>
                                            <td><label id="" class="text-dark tfixed" ></label></td>
                                            <td><label id="" class="text-dark tservice_sales"> </label> (<label class="text-dark tservicerate"></label>%)</td>
                                            <td><label id="" class="text-dark tlisting"></label></td>
                                            <td><label id="" class="text-dark tmarketing_sales"> </label> (<label  class="text-dark tmarketingrate"></label>%)</td>
                                            <td><label id="" class="text-dark tpay_sales"></label> (<label class="text-dark tpayrate"></label>%)</td>
                                            <td><label id="" class="text-dark tother"></label></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="text-align: right;font-size: 16px;">
                                <label class="text-dark" style="font-weight: bold">Settlement Value:</label>
                                <label class="text-primary settlementvalue_sales" style="font-weight: bold"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="text-align: right;font-size: 14px;">
                                <label class="text-muted ">(Note: Settlement value is calculated based on selling price.)</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="text-danger">Disclaimer: The commission and discount are based on the current rate card. The actual charges may vary depending on order date. The calculated Settlement Value exclude Shipping Charges.</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                           
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
<!--                        <button class="btn btn-primary modal-confirm">Confirm</button>-->
                        <button class="btn btn-default modal-dismiss">Cancel</button>
                    </div>
                </div>
            </footer>
        </section>
    </div>
    <!--Price Calculator Model End-->
    <!--product Edit Model Start-->
    <div id="modalEdit" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
        <form id="modelEditProduct" method="POST" action="#">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Edit Listing</h2>
                </header>
                <div class="panel-body">
                    <input type="hidden" id="product_id" name="product_id" value=""/>
                    <div class="row">
                        <div class="col-md-4" style="padding: 0px 30px;border-right: 1px solid #eeeeee;">
                            <div class="row">
                                <div class="col-md-12">
                                    <img id="Emodel_image" src="" width="100" height="125" style="border:1px;margin-bottom: 5px;"/>
                                </div>                                                
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label id="Emodel_product_name" class="text-primary" style="font-weight: bold"></label>
                                </div>                                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-dark" style="font-weight: bold">SUPC No</label>
                                </div> 
                                <div class="col-md-6">
                                    <label id="Emodel_product_supc" class="text-dark"></label>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-dark" style="font-weight: bold">Brand</label>
                                </div> 
                                <div class="col-md-6">
                                    <label id="Emodel_brand" class="text-dark"></label>
                                </div>                                               
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-dark" style="font-weight: bold">Style Code</label>
                                </div> 
                                <div class="col-md-6">
                                    <label id="Emodel_style_code" class="text-dark"></label>
                                </div>                                               
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-dark" style="font-weight: bold">Status</label>
                                </div> 
                                <div class="col-md-6">
                                    <select name="live_status" class="form-control">
                                        <option  value="0">Inactive</option>
                                        <option  value="1">Active</option>

                                    </select>
                                </div>                                               
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="text-dark" style="font-weight: bold">Price</label>                                                    
                                </div>
                                <div class="col-md-6">
                                    <label>MRP</label>
                                    <input id="Emodel_mrp" name="mrp" type="number" class="form-control" required/>
                                </div>
                                <div class="col-md-6">
                                    <label>Your Selling Price</label>
                                    <input id="Emodel_selling_price" name="selling_price" type="number" class="form-control" required/>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="text-dark" style="font-weight: bold">Stock and SLA</label>                                                    
                                </div>
                                <div class="col-md-6">
                                    <label >Stock count</label>
                                    <input id="Emodel_qty" name="qty" type="number" class="form-control" required/>
                                </div>
                                <div class="col-md-6">
                                    <label>Procurement SLA (days)</label>
                                    <input id="Emodel_shipping_time" name="sla" type="number" class="form-control" required/>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="text-dark" style="font-weight: bold">Shipping Charge</label>                                                    
                                </div>
                                <div class="col-md-4">                                    
                                    <input id="Emodel_shipping_charge"  name="shipping_charge" type="number" class="form-control" disabled/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                           
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button id="editconfirm" type="submit" class="btn btn-primary">Confirm</button>
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
    case "U":
        $m = "Product Updated..!";
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
        calculator();
        edit();
        editconfirm();
            
        $('#datatable-default1').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3]
                }],
            iDisplayLength: -1
        });
                
        $("#btnExport1").click(function () {
            $("#datatable-default1").btechco_excelexport({
                containerid: "datatable-default1",              
                datatype: $datatype.Table
            });
        });
        
        $('.dataTables_paginate').click(function() {
            calculator();
            edit();
            editconfirm();
        });

        $('.dataTables_filter input').change(function() {
            calculator();
            edit();
            editconfirm();
        });

        // Own Jquery Start

        $('#Emodel_selling_price').focusout(function() {
            if (parseInt($('#Emodel_mrp').val()) < parseInt($('#Emodel_selling_price').val())) {
                alertify.error('Selling price must be less or equal to MRP');
                $(this).val('');
                $(this).focus();
            }
        });

        //Settlement Value Calculator

        $commission_fee = "<?= isset($commission->commission_fee) ? $commission->commission_fee : '0' ?>";
        $fixed_fee = "<?= isset($commission->fixed_fee) ? $commission->fixed_fee : '0' ?>";
        $service_fee = "<?= isset($commission->service_fee) ? $commission->service_fee : '0' ?>";
        $listing_fee = "<?= isset($commission->listing_fee) ? $commission->listing_fee : '0' ?>";
        $marketing_fee = "<?= isset($commission->marketing_fee) ? $commission->marketing_fee : '0' ?>";
        $pay_fee = "<?= isset($commission->pay_fee) ? $commission->pay_fee : '0' ?>";
        $other_fee = "<?= isset($commission->other_fee) ? $commission->other_fee : '0' ?>";

        $('.tcommissionrate').text($commission_fee);
        $('.tservicerate').text($service_fee);
        $('.tmarketingrate').text($marketing_fee);
        $('.tpayrate').text($pay_fee);
        $('.tfixed').text($fixed_fee);
        $('.tlisting').text($listing_fee);
        $('.tother').text($other_fee);


        $('#model_selling_price').on('input', function(e) {
            $sales_price = $(this).val();
            if ($sales_price != "") {
                $commission_charge = $sales_price * $commission_fee / 100;
                //$service_charge = ($commission_charge + +$fixed_fee + +$listing_fee + +$other_fee) * $service_fee / 100;
                $service_charge = $commission_charge * $service_fee / 100;
                $marketing_charge = $sales_price * $marketing_fee / 100;
                $pay_charge = $sales_price * $pay_fee / 100;
                $('.tcommission_sales').text(Math.round($commission_charge));
                $('.tservice_sales').text(Math.round($service_charge));
                $('.tmarketing_sales').text(Math.round($marketing_charge));
                $('.tpay_sales').text(Math.round($pay_charge));

                $settlement_value = Math.round($sales_price - (+$commission_charge + +$service_charge + +$marketing_charge + +$pay_charge + +$fixed_fee + +$listing_fee + +$other_fee));
                $('.settlementvalue_sales').text($settlement_value);
            } else {
                clearSalesModel();
            }
        });


        function calculator(){
        $('.calculator').click(function() {
            $product_id = $(this).prop('id');
            $.ajax({
                url: "<?= site_url() ?>seller/product/getProduct",
                type: 'POST',
                data: {'product_id': $product_id},
                success: function(data, textStatus, jqXHR) {
                    $product = JSON.parse(data);
                    $('#model_selling_price').val($product['selling_price']);
                    $('#model_selling_price').trigger('input');

                }
            });
        });}

        function edit(){
        $('.edit').click(function() {
            $product_id = $(this).prop('id');
            $.ajax({
                url: "<?= site_url() ?>seller/product/getProduct",
                type: 'POST',
                data: {'product_id': $product_id},
                success: function(data, textStatus, jqXHR) {
                    $product = JSON.parse(data);

                    $('#product_id').val($product['product_id']);
                    $('#Emodel_image').prop('src', $product['image_thumb']);
                    $('#Emodel_product_name').html($product['product_name']);
                    $('#Emodel_product_supc').html($product['product_supc']);
                    $('#Emodel_brand').html($product['brand']);
                    $('#Emodel_style_code').html($product['style_code']);
                    $('#Emodel_mrp').val($product['mrp']);
                    $('#Emodel_selling_price').val($product['selling_price']);
                    $('#Emodel_qty').val($product['qty']);
                    $('#Emodel_shipping_time').val($product['shipping_time']);
                    $('#Emodel_shipping_charge').val($product['shipping_charge']);

                    var nowdt = formatedate(new Date(), 0);
                    var lastdt = formatedate(new Date($product['mod_date']), 1);

                    console.log(nowdt);
                    console.log(lastdt);

                }
            });
        });}

        function formatedate(mydate, addday) {
            now = new Date(mydate);
            year = "" + now.getFullYear();
            month = "" + (now.getMonth() + 1);
            if (month.length == 1) {
                month = "0" + month;
            }
            day = "" + (now.getDate() + addday);
            if (day.length == 1) {
                day = "0" + day;
            }
            hour = "" + now.getHours();
            if (hour.length == 1) {
                hour = "0" + hour;
            }
            minute = "" + now.getMinutes();
            if (minute.length == 1) {
                minute = "0" + minute;
            }
            second = "" + now.getSeconds();
            if (second.length == 1) {
                second = "0" + second;
            }
            return year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second;
        }
        
        function editconfirm(){
        $('#editconfirm').click(function() {
            if ($('#Emodel_selling_price').val() != "") {
                $.ajax({
                    url: '<?= site_url() ?>seller/product/modelEditProduct',
                    type: 'post',
                    data: $('#modelEditProduct').serialize(),
                    success: function(data, textStatus, jqXHR) {
                        alertify.success("Product Information Updated");
                        location.reload(true);
                    }
                });                
            }
        });}

        function clear() {
            $('.tcommission').text('0');
            $('.tservice').text('0');
            $('.tmarketing').text('0');
            $('.tpay').text('0');
            $('.settlementvalue').text('0');
        }

        function clearSalesModel() {
            $('.tcommission_sales').text('0');
            $('.tservice_sales').text('0');
            $('.tmarketing_sales').text('0');
            $('.tpay_sales').text('0');
            $('.settlementvalue_sales').text('0');
        }

        function clearSettlementsModel() {
            $('.tcommission_settlement').text('0');
            $('.tservice_settlement').text('0');
            $('.tmarketing_settlement').text('0');
            $('.tpay_settlement').text('0');
            $('.sallingprice').text('0');
        }
    });
</script>
