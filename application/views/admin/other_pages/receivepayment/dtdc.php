<section role="main" class="content-body">
    <header class="page-header">
        <h2>Dtdc Payment Master</h2>

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
                    <h2 class="panel-title">Payment Detail</h2>                    
                </header>
                <div class="panel-body">
                    <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                    <form id="tableform" method="POST" action="#">
                        <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th>Orders</th>
                                    <th>Details</th>
                                    <th>View</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                if (isset($payments)) {
                                    foreach ($payments as $payment) {
                                        ?>
                                        <tr>                                            
                                            <td style="width:80px;"><?= date("d-m-Y", strtotime($payment->payment_date)) ?></td>
                                            <td><i class="fa fa-rupee"></i> <?= $payment->payment_amount ?></td>                                            
                                            <td><?php
                                                if ($payment->payment_method == '1') {
                                                    echo "Cash";
                                                } else if ($payment->payment_method == '2') {
                                                    echo "Cheque";
                                                } else if ($payment->payment_method == '3') {
                                                    echo "NEFT";
                                                }
                                                ?></td>
                                            <td><?php
                                                $orders = explode(",", $payment->orders_id);
                                                echo count($orders);
                                                ?>
                                            </td>
                                            <td><?= $payment->payment_details ?></td>
                                            <td><a href="<?= site_url() ?>admin/others/paymentOrdersView?id=<?= base64_encode($payment->id) ?>" class="btn btn-success btn-xs" >View</a></td>
                                            <td><a href="<?= site_url() ?>admin/others/dtdcPaymentDelete?id=<?= base64_encode($payment->id) ?>" class="btn btn-danger btn-xs" >Delete</a></td>
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
    $(function() {
        $('#datatable-default').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4, 5, 6]
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