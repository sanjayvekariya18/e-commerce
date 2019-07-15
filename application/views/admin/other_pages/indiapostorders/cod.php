<section role="main" class="content-body">
    <header class="page-header">
        <h2>COD Orders Master</h2>

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
                    <form name="search" method="POST" action="<?= site_url() ?>admin/others/indiaPostCod">
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
                                    <th style="font-size: 17px;padding-right: 18px;text-align: center;">
                                        <i class="fa fa-level-down"></i>     
                                    </th>
                                    <th>Date</th>
                                    <th>Order Id</th>
                                    <th>AWB No</th>                                    
                                    <th>Expense</th>
                                    <th>Status</th>
                                    <th>Collect</th>
                                    <th>IND Status</th>
                                    <th>Exp Status</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                if (isset($orders)) {
                                    foreach ($orders as $order) {
                                        $tdiscount = $order->total_price - $order->payment_price + $order->cod_charge;
                                        ?>
                                        <tr>
                                            <td><input name="allOrders[]" value="<?= $order->order_id ?>" type="checkbox" ></td>
                                            <td style="width:80px;"><?= date("d-m-Y", strtotime($order->order_date)) ?></td>
                                            <td><?= $order->order_id ?></td>                                            
                                            <td></i> <?= $order->awb_no ?></td>                                            
                                            <td><i class="fa fa-rupee"></i> <?php
                                                if ($order->order_status == '5' || $order->order_status == '7' || $order->order_status == '8' || $order->order_status == '9') {
                                                    echo $tdiscount + $order->cod_charge + ($order->cod_charge * 14.5 / 100 );
                                                } else {
                                                    echo $tdiscount;
                                                }
                                                ?></td>
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
                                                }
                                                ?>
                                            </td>
                                            <td><i class="fa fa-rupee"></i> <?= $order->payment_price ?></td>
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