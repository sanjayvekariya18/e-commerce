<style type="text/css">
    .th1{
        width: 5px !important;
    }
    .th2{
        width: 470px !important;
    }
    .th3{
        width: 150px !important;
    }
    .th4{
        width: 200px !important;
    }
    .th5{
        width: 120px !important;
    }
    .th6{
        width: 200px !important;
    }
</style>

<section role="main" class="content-body">
    <header class="page-header">
        <h2>Return Order Management</h2>

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
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <div class="panel-body">
                    <section class="panel">
                        <header class="panel-heading">                                        
                            <h2 class="panel-title">Return Order Details</h2>
                        </header>
                        <div class="panel-body">
                            <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                            <table class="table table-striped mb-none" id="datatable-default1" style="width:100%">
                                <thead>
                                    <tr>                                       
                                        <th class="th2">Order Summery</th>
                                        <th class="th3">Status</th>
                                        <th class="th4">Quantity and Price</th>
                                        <th class="th5">Return on</th>
                                        <th class="th6">Buyer details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($return) && is_array($return)) {
                                        foreach ($return as $val) {
                                            ?>
                                            <tr>
                                                <td>

                                                    <img src="<?= $val->image_medium ?>" width="80" height="100" style="border:1px;float: left;margin-right: 10px;"/>
                                                    <table>
                                                        <tr>
                                                            <td colspan="2"><label class="text-dark" style="font-weight: bold">SKU:  <?= $val->sku ?></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2"><label class="text-primary" style="font-weight: bold"><?= $val->product_name ?></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label class="text-dark" style="font-weight: bold">Colour</label></td>
                                                            <td><label class="text-dark"><?= $val->colour ?></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label class="text-dark" style="font-weight: bold">Size</label></td>
                                                            <td><label class="text-dark"><?= $val->size ?></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label class="text-dark" style="font-weight: bold">Order Date</label></td>
                                                            <td><label class="text-dark"><?= date('dS M\' Y', strtotime($val->order_date)) ?></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label class="text-dark" style="font-weight: bold">Order ID</label></td>
                                                            <td><label class="text-dark"><?= $val->order_id ?></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label class="text-dark" style="font-weight: bold">Tracking No</label></td>
                                                            <td><label class="text-dark"><?= $val->awb_no ?></label></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td style="text-align: center">                                                    
                                                    <?php if ($val->order_status == 5) { ?>
                                                        <span class="label label-warning">Return</span>
                                                    <?php } ?>
                                                    <p><?= $val->return_reason ?></p>
                                                </td>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td style="padding-right: 3px;"><label class="text-dark" style="font-weight: bold">Qty</label></td>
                                                            <td><label class="text-dark"><?= $val->qty ?></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding-right: 3px;"><label class="text-dark" style="font-weight: bold">Value</label></td>
                                                            <td><label class="text-dark"><?= $val->selling_price ?> (each)</label></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding-right: 3px;"><label class="text-dark" style="font-weight: bold">Shipping</label></td>
                                                            <td><label class="text-dark"><?= $val->shipping_charge ?></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding-right: 3px;"><label class="text-dark" style="font-weight: bold">Total</label></td>
                                                            <td><label class="text-dark"><?= $val->total_price ?></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding-right: 3px;"><label class="text-dark" style="font-weight: bold">Payment Type</label></td>
                                                            <td><label class="text-dark"><?= ($val->pay_method == "cod") ? 'Cash On Delivery' : 'Credit Card/ Debit Card / Net Banking' ?></label></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <label class="text-dark" style="font-weight: bold"><?= date('M d, Y', strtotime($val->return_date)); ?></label>
                                                </td>
                                                <td>
                                                    <label class="text-dark" style="font-weight: bold"><?= $val->address ?></label>
                                                    <label class="text-dark" style="font-weight: bold"><?= $val->city ?></label>
                                                    <label class="text-dark" style="font-weight: bold"><?= $val->state_name ?> - </label>
                                                    <label class="text-dark" style="font-weight: bold"><?= $val->pincode ?></label>
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
            </section>
        </div>
    </div>

    <!-- end: page -->
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable-default1').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4]
                }],
            iDisplayLength: -1
        });
        
        $("#btnExport1").click(function () {
            $("#datatable-default1").btechco_excelexport({
                containerid: "datatable-default1",              
                datatype: $datatype.Table
            });
        });
    });
</script>
