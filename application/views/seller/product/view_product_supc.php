<style>
    th,td{
        text-align: center;
    }
</style>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>View Product By SUPC</h2>

        <div class="right-wrapper pull-right" style="padding-right: 10px;">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>seller">
                        <i class="fa fa-home"></i>
                    </a>
                </li>                
                <li><span>View Product By SUPC</span></li>
            </ol>           
        </div>
    </header>
    <!-- start: page -->

    <div class="row">
        <div class="col-md-12">
            <section class="panel form-wizard panel-featured panel-featured-primary" id="w4">
                <header class="panel-heading">                    
                    <h2 class="panel-title">Product Details</h2>
                </header>
                <form id="supcform" name="supcform" method="post" action="<?= site_url() ?>seller/product/addProductBySupcData">
                    <input type="hidden" name="product_id" value="<?= $product->product_id ?>"/>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="<?= $product->image_medium ?>" width="150" height="175" style="border:1px dashed;float: left;margin-right: 25px;"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-primary" style="font-weight: bold"><?= $product->product_name ?></label>
                                        <label class="text-dark" style="font-weight: bold">SUPC :  <?= $product->product_supc ?></label><br>
                                        <label class="text-dark" style="font-weight: bold">SKU :  <?= $product->sku ?></label><br>
                                        <label class="text-dark" style="font-weight: bold">Brand : <?= $product->brand ?></label><br>
                                        <label class="text-dark" style="font-weight: bold">Selling Price : <?= $product->selling_price ?></label><br>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table width="100%" class="table table-bordered center">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center">Variation Type</th>
                                                            <th style="text-align: center">Variation Name</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($variations as $key => $value) {
                                                            $allvar = "";
                                                            ?>
                                                            <tr>
                                                                <td style="text-transform: capitalize;"><?= str_replace("_", " ", $key) ?></td>
                                                                <?php
                                                                foreach ($value as $val) {
                                                                    $allvar = $allvar . $val . ", ";
                                                                }
                                                                ?>
                                                                <td><?= $allvar ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
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
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>SKU</th>
                                                    <th>Quantity</th>
                                                    <th>MRP</th>
                                                    <th>Selling Price</th>
                                                    <th>Dispatch SLA</th>
                                                    <th>Competitive Price</th>
                                                    <th style="width: 140px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="text" id="sku" name="sku" class="form-control" required/></td>
                                                    <td><input type="number" id="qty" name="qty" class="form-control" required/></td>
                                                    <td><input type="number" id="mrp" name="mrp" class="form-control" required/></td>
                                                    <td><input type="number" id="selling_price" name="selling_price" class="form-control" required/></td>
                                                    <td><input type="number" id="sla" name="sla" class="form-control" required/></td>
                                                    <td><label class="text-dark"><?= isset($competitive_price) ? $competitive_price : '' ?></label></td>
                                                    <td><button id="brackup" type="button" class="btn btn-primary">Show Brackup</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="row brackupbox" style="display:none">
                                    <div class="col-md-12">
                                        <table width="100%" class="table table-bordered" style="text-align: center">
                                            <thead>
                                                <tr>
                                                    <th>Settlement Price</th>
                                                    <th>Commission</th>
                                                    <th>Fixed</th>
                                                    <th>Service Tax</th>
                                                    <th>Listing Fee</th>
                                                    <th>Marketing Fee</th>
                                                    <th>Payment Collection Fee</th>
                                                    <th>Other</th>
                                                    <th>Weight</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><label id="" class="text-dark settlementvalue"></label></td>
                                                    <td><label id="" class="text-dark tcommission"></label> (<label class="text-dark tcommissionrate"></label>%)</td>
                                                    <td><label id="" class="text-dark tfixed" ></label></td>
                                                    <td><label id="" class="text-dark tservice"></label> (<label class="text-dark tservicerate"></label>%)</td>
                                                    <td><label id="" class="text-dark tlisting"></label></td>
                                                    <td><label id="" class="text-dark tmarketing"></label> (<label  class="text-dark tmarketingrate"></label>%)</td>
                                                    <td><label id="" class="text-dark tpay"></label> (<label class="text-dark tpayrate"></label>%)</td>
                                                    <td><label id="" class="text-dark tother"></label></td>
                                                    <td><label id="" class="text-dark weight"><?= $product->weight ?></label></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>                                    
                                    <div class="col-md-12">
                                        <center>
                                            <p><input id="agree" type="checkbox" name="agree" > I Accept the Terms and Conditions</p>
                                            <button id="submit" class="btn btn-primary" type="submit" name="submit">SUBMIT</button>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>

<script type="text/javascript">
    $(document).ready(function() {
// SETTLEMENT VALUE CALCULATION 

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

        $('#brackup').on('click', function(e) {
            $sales_price = $('#selling_price').val();
            $flag = 0;
            if ($('#sku').val() == "") {
                alertify.error("Enter Product Sku");
                $('#sku').focus();
            } else if ($('#qty').val() == "") {
                alertify.error("Enter Product Quantity");
                $('#qty').focus();
            } else if ($('#mrp').val() == "") {
                alertify.error("Enter Product Mrp");
                $('#mrp').focus();
            } else if (parseInt($('#mrp').val()) < 150) {
                alertify.error("Minimum MRP is Rs.150");
                $('#mrp').focus();
            } else if ($('#selling_price').val() == "") {
                alertify.error("Enter Product Selling Price");
                $('#selling_price').focus();
            } else if (parseInt($('#selling_price').val()) < 150) {
                alertify.error("Minimum Selling Price is Rs.150");
                $('#selling_price').focus();
            } else if ($('#mrp').val() < $('#selling_price').val()) {
                alertify.error("Product Selling Price Not More Then MRP ");
                $('#selling_price').focus();
            } else if ($('#sla').val() == "") {
                alertify.error("Enter Product Sla");
                $('#sla').focus();
            } else {
                $flag = 1;
            }

            if ($flag) {
                $('.brackupbox').css('display', 'block');
                $commission_charge = $sales_price * $commission_fee / 100;
                //$service_charge = ($commission_charge + +$fixed_fee + +$listing_fee + +$other_fee) * $service_fee / 100;
                $service_charge = $commission_charge * $service_fee / 100;
                $marketing_charge = $sales_price * $marketing_fee / 100;
                $pay_charge = $sales_price * $pay_fee / 100;
                $('.tcommission').text(Math.round($commission_charge));
                $('.tservice').text(Math.round($service_charge));
                $('.tmarketing').text(Math.round($marketing_charge));
                $('.tpay').text(Math.round($pay_charge));
                $settlement_value = Math.round(($sales_price - (+$commission_charge + +$service_charge + +$marketing_charge + +$pay_charge + +$fixed_fee + +$listing_fee + +$other_fee)));
                $('.settlementvalue').text($settlement_value);
                $('#web_price').val($sales_price);
            } else {
                $('.brackupbox').css('display', 'none');
                clear();
            }

        });

        function clear() {
            $('.tcommission').text('0');
            $('.tservice').text('0');
            $('.tmarketing').text('0');
            $('.tpay').text('0');
            $('.settlementvalue').text('0');
        }

        $('#supcform').on('submit', function() {
            if ($('#agree').is(':checked')) {
                return true;
            } else {
                alertify.error("Please Select Agreement Box");
                return false;
            }
        });

        $('#sku').focusout(function() {
            $sku = $(this).val();
            $.ajax({
                url: '<?= site_url() ?>seller/product/checkSkuExist',
                type: 'post',
                data: {'sku': $sku},
                success: function(data, textStatus, jqXHR) {
                    if (data > 0) {
                        $('#sku').val("");
                        alertify.error('This SKU Already Exist ..!!');
                    }
                }
            });
        });
    });
</script>