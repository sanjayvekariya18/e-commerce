<section role="main" class="content-body">
    <header class="page-header">
        <h2>Shipped Cancel Orders Master</h2>

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
                    <form name="search" method="POST" action="<?= site_url() ?>admin/others/allShippedCancel">
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
                    <form id="tableform" method="POST" action="#">
                        <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                            <thead>
                                <tr>                                    
                                    <th>Date</th>
                                    <th>Order Id</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Payment</th>
                                    <th>Discount</th>
                                    <th>Commission</th>
                                    <th>Profit</th>
                                    <th>Loss</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                if (isset($orders)) {
                                    $ttotal = 0;
                                    $tpayment = 0;
                                    $tdiscount = 0;
                                    $tcommission = 0;
                                    $tprofit = 0;
                                    $tloss = 0;
                                    foreach ($orders as $order) {
                                        $discount = $order->total_price - $order->payment_price + $order->cod_charge;
                                        $commission = $order->commission_fee * $order->qty;
                                        $total = $order->total_price;
                                        $profit = ($order->commission_fee + $order->payment_fee) * $order->qty;
                                        $loss = $discount + $order->cod_charge + ($order->cod_charge * 14.5 / 100);
                                        $ttotal += $order->total_price;
                                        $tpayment += $order->payment_price;
                                        $tdiscount += $discount;
                                        $tcommission += $commission;
                                        $tprofit += $profit;
                                        $tloss += $discount + $order->cod_charge + ($order->cod_charge * 14.5 / 100);
                                        ?>
                                        <tr>
                                            <td style="width:80px;"><?= date("d-m-Y", strtotime($order->order_date)) ?></td>
                                            <td><?= $order->order_id ?></td>
                                            <td><span class="label label-danger">Shipped Cancel</span></td>
                                            <td><i class="fa fa-rupee"></i> <?= $total ?></td>
                                            <td><i class="fa fa-rupee"></i> <?= $tpayment ?></td>
                                            <td><i class="fa fa-rupee"></i> <?= $discount ?></td>
                                            <td><i class="fa fa-rupee"></i> <?= $commission ?></td>
                                            <td><i class="fa fa-rupee"></i> <?= $profit ?></td>
                                            <td><i class="fa fa-rupee"></i> <?= $loss ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3"> Total </td>
                                    <td><i class="fa fa-rupee"></i> <?= isset($ttotal) ? $ttotal : "0" ?></td>
                                    <td><i class="fa fa-rupee"></i> <?= isset($tpayment) ? $tpayment : "0" ?></td>
                                    <td><i class="fa fa-rupee"></i> <?= isset($tdiscount) ? $tdiscount : "0" ?></td>
                                    <td><i class="fa fa-rupee"></i> <?= isset($tcommission) ? $tcommission : "0" ?></td>
                                    <td><i class="fa fa-rupee"></i> <?= isset($tprofit) ? $tprofit : "0" ?></td>
                                    <td><i class="fa fa-rupee"></i> <?= isset($tloss) ? $tloss : "0" ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>
            </section>            
        </div>
    </div>
    <!-- end: page -->
</section>
<script type="text/javascript">
    $(function () {
        $('#datatable-default').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4, 5, 6, 7]
                }],
            iDisplayLength: 10
        });

        $("#btnExport1").click(function () {
            $("#datatable-default").btechco_excelexport({
                containerid: "datatable-default",
                datatype: $datatype.Table
            });
        });

    });
</script>