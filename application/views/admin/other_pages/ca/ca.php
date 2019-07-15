<section role="main" class="content-body">
    <header class="page-header">
        <h2>CA Orders Master</h2>

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
                    <form id="search" name="search" method="POST" action="">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Date</label>
                                <div class="input-daterange input-group" data-plugin-datepicker>
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>    
                                    </span>
                                    <input type="text" class="form-control" name="start" value="<?= isset($_POST['start']) ? $_POST['start'] : '' ?>">
                                    <span class="input-group-addon">to</span>
                                    <input type="text" class="form-control" name="end" value="<?= isset($_POST['end']) ? $_POST['end'] : '' ?>" style="width: 115px;">
                                </div>   
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Status</label> 
                                <select id="status" name="status" class="form-control">
                                    <option value="-1">--Select--</option>
                                    <option value="4">Delivered</option>
                                    <option value="5">Return</option>
                                    <option value="7">Replace</option>
                                    <option value="8">Shipped Cancel</option>
                                    <option value="9">Refund</option>
                                </select>
                            </div> 
                        </div>
                        <div class="row" style="margin-top: 15px">
                            <div class="col-md-4">
                                <button id="searchbtn" class="btn btn-success btn-sm" type="button" style="width:80px">Search</button>
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
                    <button id="print" class="btn btn-info btn-sm" type="button" style="width:80px;margin-bottom: 15px">Print</button>
                    <form id="tableform" method="POST" action="#">
                        <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                            <thead>
                                <tr>                                    
                                    <th>Date</th>
                                    <th>Order Id</th>
                                    <th>Status</th>
                                    <th>Seller Name</th>
                                    <th>Buyer Name</th>
                                    <th>selling Price</th>
                                    <th>Income</th>
                                    <th>Expense</th>
                                    <th>Service Tax</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                if (isset($orders)) {
                                    $tincome = 0;
                                    $texpense = 0;
                                    $tservicetax = 0;

                                    foreach ($orders as $order) {
                                        $income = ($order->commission_fee + $order->payment_fee) * $order->qty;
                                        $tdiscount = $order->total_price - $order->payment_price + $order->cod_charge;
                                        $tincome += $income;
                                        ?>
                                        <tr>
                                            <td style="width:80px;"><?= date("d-m-Y", strtotime($order->order_date)) ?></td>
                                            <td><?= $order->order_id ?></td>
                                            <td>                                                
                                                <?php if ($order->order_status == 4) { ?>
                                                    <span class="label label-success">Delivery</span>
                                                <?php } else if ($order->order_status == 5) { ?>
                                                    <span class="label label-warning">Refund</span>                                                
                                                <?php } else if ($order->order_status == 7) { ?>
                                                    <span class="label label-default">Replacement</span>
                                                <?php } else if ($order->order_status == 8) { ?>
                                                    <span class="label label-danger">Shipped Cancel</span>
                                                <?php } else if ($order->order_status == 9) { ?>
                                                    <span class="label label-success">Refund Paid</span>
                                                <?php } ?>
                                            </td>
                                            <td><?= $order->business_name ?></td>
                                            <td><?= $order->first_name . " " . $order->last_name ?></td>
                                            <td><?= $order->selling_price ?></td>
                                            <td><i class="fa fa-rupee"></i> <?= $income ?></td>
                                            <td><i class="fa fa-rupee"></i> <?php
                                                if ($order->order_status == '5' || $order->order_status == '7' || $order->order_status == '8' || $order->order_status == '9') {
                                                    $expense = $tdiscount + $order->cod_charge + ($order->cod_charge * 14.5 / 100 );
                                                    echo $expense;
                                                    $texpense += $expense;
                                                } else {
                                                    echo $tdiscount;
                                                    $texpense += $tdiscount;
                                                }
                                                ?>
                                            </td>                                            
                                            <td><i class="fa fa-rupee"></i> 
                                                <?php
                                                $tax = $income * 14.5 / 100;
                                                $tservicetax += $tax;
                                                echo $tax;
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6">Total</td>
                                    <td><?= isset($tincome) ? $tincome : "0" ?></td>
                                    <td><?= isset($texpense) ? $texpense : "0" ?></td>
                                    <td><?= isset($tservicetax) ? $tservicetax : "0" ?></td>
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
        $status = "<?= isset($_POST['status']) ? $_POST['status'] : "-1" ?>";
        $('#status').val($status);

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

        $('#print').click(function () {
            $('#search').attr("action", "<?= site_url() ?>admin/others/caReportPrint");
            $('#search').attr("target", "_blank");
            $('#search').submit();
        });

        $('#searchbtn').click(function () {
            $('#search').attr("action", "<?= site_url() ?>admin/others/caReportSearch");
            $('#search').attr("target", "_self");
            $('#search').submit();
        });

    });
</script>