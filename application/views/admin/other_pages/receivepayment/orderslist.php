<style type="text/css">
    .datepicker{
        z-index: 999999 !important;
    }
</style>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Orders List</h2>

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
                    <h2 class="panel-title">Orders Detail</h2>                    
                </header>
                <div class="panel-body">
                    <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                    <button class="btn btn-default btn-sm" type="button" style="width:80px;margin-bottom: 15px" onclick="history.go(-1);">Back</button>

                    <form id="tableform" method="POST" action="#">
                        <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                            <thead>
                                <tr>    
                                    <th>Date</th>
                                    <th>Order Id</th>
                                    <th>AWB No</th>
                                    <th>Method</th>
                                    <th>Expense</th>
                                    <th>Fed.Expense</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th>Collect</th>
                                    <th>FedEx Status</th>
                                    <th>Exp Status</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                if (isset($orders)) {
                                    foreach ($orders as $order) {
                                        ?>
                                        <tr>
                                            <td style="width:80px;"><?= date("d-m-Y", strtotime($order->order_date)) ?></td>
                                            <td><?= $order->order_id ?></td>                                            
                                            <td></i> <?= $order->awb_no ?></td>
                                            <td><?php
                                                if ($order->pay_method == "cod") {
                                                    echo "COD";
                                                } else {
                                                    echo "PREPAID";
                                                }
                                                ?></td>
                                            <td><i class="fa fa-rupee"></i> <?= $order->total_price - $order->payment_price + $order->cod_charge ?></td>
                                            <td><i class="fa fa-rupee"></i> <?= $order->shipping_charge + $order->cod_charge ?></td>
                                            <td>
                                                <?php
                                                if ($order->pay_method == "cod") {
                                                    if ($order->cod_payment == "0") {
                                                        ?>
                                                        <span class="label label-info">Pending</span>
                                                    <?php } else { ?>
                                                        <span class="label label-success">Received</span>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <span class="label label-success">Received</span>
                                                <?php } ?>
                                            </td>
                                            <td><i class="fa fa-rupee"></i> <?= $order->payment_price ?></td>
                                            <td><i class="fa fa-rupee"></i> <?php
                                                if ($order->pay_method == "cod") {
                                                    echo $order->payment_price;
                                                } else {
                                                    echo "0";
                                                }
                                                ?></td>
                                            <td><span class="label label-default"><?= $this->common->getOrderCurrentStatus($order->order_id) ?></span></td>
                                            <td><?php
                                                if ($order->expense_payment == "0") {
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
                        </table>
                    </form>
                </div>
            </section>            
        </div>
    </div>    
    <!-- end: page -->
</section>

<script type="text/javascript">
    $(document).ready(function() {

        $('#datatable-default').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }],
            iDisplayLength: 10
        });

        $("#btnExport1").click(function() {
            $("#datatable-default").btechco_excelexport({
                containerid: "datatable-default",
                datatype: $datatype.Table
            });
        });
    });
</script>