<style type="text/css">
    .datepicker{
        z-index: 999999 !important;
    }
</style>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Payumoney Orders Master</h2>

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
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-up"></a>                        
                    </div>

                    <h2 class="panel-title">Advance Search</h2>                    
                </header>
                <div class="panel-body" style="display:none"> 
                    <form name="search" method="POST" action="<?= site_url() ?>admin/others/payumoneyOrders">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Date</label>
                                <div class="input-daterange input-group" data-plugin-datepicker>
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>    
                                    </span>
                                    <input type="text" class="form-control" name="start">
                                    <span class="input-group-addon">to</span>
                                    <input type="text" class="form-control" name="end" style="width: 115px;">
                                </div>   
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
                    <h2 class="panel-title">Orders Detail</h2>                    
                </header>
                <div class="panel-body">
                    <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                    <a class="mr-xs modal-with-move-anim btn btn-success btn-sm payment" style="margin-bottom: 15px" href="#modalpayment">Received Payment</a>
                    <form id="tableform" method="POST" action="#">
                        <input type="hidden" id="payment_date" name="payment_date" /> 
                        <input type="hidden" id="payment_amount" name="payment_amount" /> 
                        <input type="hidden" id="payment_method" name="payment_method" /> 
                        <input type="hidden" id="payment_details" name="payment_details" /> 
                        <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                            <thead>
                                <tr>    
                                    <th style="font-size: 17px;padding-right: 18px;text-align: center;">
                                        <i class="fa fa-level-down"></i>     
                                    </th>
                                    <th>Date</th>
                                    <th>Order Id</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                if (isset($orders)) {
                                    $total = 0;
                                    foreach ($orders as $order) {
                                        $total += $order->payment_price;
                                        ?>
                                        <tr>
                                            <td><input name="allOrders[]" value="<?= $order->order_id ?>" type="checkbox" ></td>
                                            <td style="width:80px;"><?= date("d-m-Y", strtotime($order->order_date)) ?></td>
                                            <td><?= $order->order_id ?></td>                                            
                                            <td><i class="fa fa-rupee"></i> <?= $order->payment_price ?></td>
                                            <td><?php
                                                if ($order->payumoney_payment == "0") {
                                                    ?>
                                                    <span class="label label-info">Pending</span>
                                                <?php } else { ?> 
                                                    <span class="label label-success">Paid</span>
                                                <?php } ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3">Total</td>
                                    <td><?= isset($total) ? $total : "0" ?></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>
            </section>            
        </div>
    </div>
    <!--Payment Received Model Start-->
    <div id="modalpayment" class="zoom-anim-dialog modal-block modal-block-sm mfp-hide">
        <form id="modalshippingchargeform" method="POST" class="form-horizontal" >
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Payment Information</h2>
                </header>
                <div class="panel-body">                    
                    <div class="form-group">
                        <label class="col-md-4 control-label">Date</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="paydate" name="pay_date" type="text" data-plugin-datepicker class="form-control" style="width: 95%;"  required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Amount</label>
                        <div class="col-md-8">
                            <input id="amount" name="amount" class="form-control" placeholder="Amount" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Method</label>
                        <div class="col-md-8">
                            <select id="method" name="method" class="form-control">
                                <option value="1">Cash</option>
                                <option value="2">Cheque</option>
                                <option value="3">NEFT</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Details</label>
                        <div class="col-md-8">
                            <textarea id="details" name="details" class="form-control" placeholder="Details" value=""></textarea>
                        </div>
                    </div>
                </div>                           
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button id="paymentconfirm" type="button" class="btn btn-primary modal-dismiss">Confirm</button>
                            <button id="paymentcancel" class="btn btn-default modal-dismiss">Cancel</button>
                        </div>
                    </div>
                </footer>
            </section>
        </form>
    </div>
    <!--Payment Received Model End-->
    <!-- end: page -->
</section>
<script type="text/javascript">
    $(function () {
        $('#datatable-default').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4]
                }],
            iDisplayLength: 10
        });

        $("#btnExport1").click(function () {
            $("#datatable-default").btechco_excelexport({
                containerid: "datatable-default",
                datatype: $datatype.Table
            });
        });

        $(".payment").click(function () {
            var amount = 0;
            $('#amount').val(amount);
            $("input:checked").each(function () {
                amount = amount + +$(this).parents('tr').children('td').eq(3).text();
                $('#amount').val(amount);
            });
        });

        $("#paymentconfirm").click(function () {
            $('#payment_date').val($('#paydate').val());
            $('#payment_amount').val($('#amount').val());
            $('#payment_method').val($('#method').val());
            $('#payment_details').val($('#details').val());
            $('#tableform').attr('action', '<?= site_url() ?>admin/others/payumoneyReceivePayment');
            $('#tableform').submit();
        });

    });
</script>