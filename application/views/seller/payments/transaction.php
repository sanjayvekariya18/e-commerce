<style type="text/css">
    .myFirstField{
        width:1px !important;
    }
</style>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Transaction Master</h2>

        <div class="right-wrapper pull-right" style="padding-right: 10px;">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>seller">
                        <i class="fa fa-home"></i>
                    </a>
                </li>                
                <li><span>Transaction Master</span></li>
            </ol>           
        </div>
    </header>
    <!-- start: page -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>                        
                    </div>

                    <h2 class="panel-title">Advance Search</h2>                    
                </header>
                <div class="panel-body"> 
                    <form name="search" method="POST" action="<?= site_url() ?>seller/payments/transactionSearch">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Date</label>
                                <div class="input-daterange input-group" data-plugin-datepicker>
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>    
                                    </span>
                                    <input type="text" class="form-control" name="start" required>
                                    <span class="input-group-addon">to</span>
                                    <input type="text" class="form-control" name="end" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Status</label> 
                                <select id="status" name="status" class="form-control">
                                    <option value="-1">--Select--</option>
                                    <option value="1">Approve</option>
                                    <option value="2">Ready-To-Shipped</option>
                                    <option value="3">Shipped</option>
                                    <option value="4">Delivered</option>
                                    <option value="5">Return</option>
                                    <option value="6">Cancel</option>
                                    <option value="7">Replace</option>
                                    <option value="8">Shipped-Cancel</option>
                                    <option value="9">Refund-Paid</option>
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 15px">
                            <div class="col-md-4">
                                <button class="btn btn-success btn-sm" type="submit" style="width:80px">Search</button>
                                <button class="btn btn-warning btn-sm" type="reset" style="width:80px">Clear</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>            
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">             
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Transaction Detail</h2>
                </header>
                <div class="panel-body">                    
                    <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px;margin-top: 15px">Export</button>
                    <label class="label label-primary" style="font-size: 16px;float: right;margin-top: 5px;padding: 10px;" >Balance : <?= ceil($balance) ?></label>
                    <!--Dynamic Table-->
                    <table class="table table-bordered table-striped mb-none" id="datatable-details">
                        <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Item Price</th>
                                <th>Settlement Price</th>
                                <th>Shipping Charge</th>
                                <th>Credit</th>
                                <th>Debit</th>
                                <th style="display:none">SKU</th>
                                <th style="display:none">QTY</th>
                                <th style="display:none">Product Name</th>
                                <th style="display:none">Weight</th>
                                <th style="display:none">Reason</th>
                                <th style="display:none">Payable</th>
                                <th style="display:none">Commission Fee</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($transaction) && is_array($transaction)) {
                                $cr = 0;
                                $dr = 0;
                                foreach ($transaction as $val) {
                                    $payable = 0;
                                    if ($this->common->isNotPayable($val->order_id)) {
                                        $color = "bisque";
                                    } else {
                                        $color = "white";
                                    }
                                    ?>                            
                                    <tr style="background-color:<?= $color ?>">
                                        <td class="text-center"><?= $val->order_id ?></td>
                                        <td class="text-center"><?= date('d-m-Y H:i:s', strtotime($val->order_date)) ?></td>
                                        <td class="text-center">
                                            <?php if ($val->order_status == 1) { ?>
                                                <span class="label label-primary">Approve</span>
                                            <?php } else if ($val->order_status == 2) { ?>
                                                <span class="label label-dark">Ready To Ship</span>
                                            <?php } else if ($val->order_status == 3) { ?>
                                                <span class="label label-info">Shipped</span>
                                            <?php } else if ($val->order_status == 4) { ?>
                                                <span class="label label-success">Delivery</span>
                                            <?php } else if ($val->order_status == 5) { ?>
                                                <span class="label label-warning">Return</span>
                                            <?php } else if ($val->order_status == 6) { ?>
                                                <span class="label label-danger">Cancel</span>
                                            <?php } else if ($val->order_status == 7) { ?>
                                                <span class="label label-default">Replacement</span>
                                            <?php } else if ($val->order_status == 8) { ?>
                                                <span class="label label-danger">Shipped Cancel</span>
                                            <?php } else if ($val->order_status == 9) { ?>
                                                <span class="label label-success">Refunded</span>    
                                            <?php } ?>
                                        </td>
                                        <td class="text-center"><i class="fa fa-rupee"></i> <?= $val->selling_price ?></td>
                                        <td class="text-center"><i class="fa fa-rupee"></i> <?= $val->settlement_price ?></td>
                                        <td class="text-center"><i class="fa fa-rupee"></i> <?= ($val->order_status != 6) ? $val->shipping_charge : "0" ?></td>
                                        <td class="text-center"><i class="fa fa-rupee"></i> <?php
                                            if ($val->order_status == 4) {
                                                $total = $val->settlement_price - $val->shipping_charge;
                                                $payable = $total;
                                                $cr += $total;
                                                echo $total;
                                            } else {
                                                $total = $val->settlement_price - $val->shipping_charge;
                                                $payable = $total;
                                                echo "0";
                                            }
                                            ?></td>
                                        <td class="text-center"><i class="fa fa-rupee"></i> <?php
                                            if ($val->order_status == 7 || $val->order_status == 8) {
                                                $total = $val->shipping_charge;
                                                $payable = $total;
                                                $dr += $total;
                                                echo $total;
                                            } else if ($val->order_status == 5 || $val->order_status == 9) {
                                                $total = ($val->selling_price - $val->settlement_price) + $val->shipping_charge;
                                                $payable = $total;
                                                $dr += $total;
                                                echo $total;
                                            } else {
                                                echo "0";
                                            }
                                            ?></td></td>
                                        <td style="display:none"><?= $val->sku ?></td>
                                        <td style="display:none"><?= $val->qty ?></td>
                                        <td style="display:none"><?= $val->product_name ?></td>
                                        <td style="display:none"><?= $val->weight * $val->qty ?></td>
                                        <td style="display:none"><?= $val->shipping_charge_reason ?></td>
                                        <td style="display:none"><i class="fa fa-rupee"></i> <?php
                                            if ($val->order_status == 4) {
                                                echo $payable;
                                            } else if ($val->order_status == 5 || $val->order_status == 7 || $val->order_status == 8 || $val->order_status == 9) {
                                                echo "- " . $payable;
                                            } else if ($val->order_status == 6) {
                                                echo "0";
                                            } else {
                                                echo $payable;
                                            }
                                            ?></td>
                                        <td style="display:none"><?= $val->selling_price - $val->settlement_price ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>                        
                    </table>
                    <table class="table table-bordered table-striped" style="margin-top:15px">
                        <tr style="font-size: 16px;font-weight: bold">
                            <td style="width: 90%;text-align: right;">Total Credit Amount :-</td>
                            <td><i class="fa fa-rupee"></i> <?= isset($cr) ? $cr : 0 ?></td>
                        </tr>
                        <tr style="font-size: 16px;font-weight: bold">
                            <td style="width: 90%;text-align: right;">Total Debit Amount :-</td>
                            <td><i class="fa fa-rupee"></i> <?= isset($dr) ? $dr : 0 ?></td>
                        </tr>
                    </table>
                    <!--Dynamic End-->   
                </div>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>

<script type="text/javascript">
    $(document).ready(function () {
        $("#btnExport1").click(function () {
            $("#datatable-details").btechco_excelexport({
                containerid: "datatable-details",
                datatype: $datatype.Table
            });
        });
    });
</script>