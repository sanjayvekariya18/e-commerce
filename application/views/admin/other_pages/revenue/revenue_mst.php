<style type="text/css">
    th{
        text-align: center;
    }
</style>    
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Revenue Master</h2>
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
            <a href="<?= site_url() ?>admin/others/addRevenue" class="btn btn-success btn-md" >Add Revenue</a>
        </div>
    </div>
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
                    <form name="search" method="POST" action="<?= site_url() ?>admin/others/searchRevenue">
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
                            <div class="col-md-4">
                                <label class="control-label">Order Id</label>                          
                                <input name="order_id" type="text" class="form-control">
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
                    <h2 class="panel-title">Profit/Loss Detail</h2>                    
                </header>
                <div class="panel-body">
                    <form id="tableform" method="post" name="expensetableform" action="<?= site_url() ?>admin/others/deleteRevenueData">
                        <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                        <button id="delete" class="btn btn-danger btn-sm mycheck" type="submit" style="width:80px;margin-bottom: 15px">Delete</button>
                        <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                            <thead>
                                <tr>
                                    <th style="font-size: 17px;padding-right: 18px;text-align: center;">
                                        <i class="fa fa-level-down"></i>     
                                    </th>
                                    <th>Date</th>
                                    <th>Order Id</th>
                                    <th>Profit</th>
                                    <th>Loss</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>  
                                <?php
                                if (isset($revenue)) {
                                    $total_profit = 0;
                                    $total_loss = 0;
                                    foreach ($revenue as $val) {
                                        $total_profit += $val->profit;
                                        $total_loss += $val->loss;
                                        ?>
                                        <tr>
                                            <td><input name="allRevenue[]" value="<?= $val->revenue_id ?>" type="checkbox" ></td>
                                            <td><?= date('d-m-Y', strtotime($val->reg_date)) ?></td>
                                            <td><?= $val->order_id ?></td>
                                            <td><?= $val->profit ?></td>
                                            <td><?= $val->loss ?></td>                                            
                                            <td>
                                                <a href="<?= site_url() ?>admin/others/getRevenueData?id=<?= base64_encode($val->revenue_id) ?>" class="btn btn-success btn-xs" >Edit</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-right">Total Profit</td>
                                    <td>
                                        <?php
                                        if (isset($total_profit)) {
                                            echo $total_profit;
                                        } else {
                                            $total_profit = 0;
                                            echo $total_profit;
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-right">Total Loss</td>
                                    <td>
                                        <?php
                                        if (isset($total_loss)) {
                                            echo $total_loss;
                                        } else {
                                            $total_loss = 0;
                                            echo $total_loss;
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-right">Total Expense</td>
                                    <td>
                                        <?php
                                        if (isset($totalexpense)) {
                                            echo $totalexpense;
                                        } else {
                                            $totalexpense = 0;
                                            echo $totalexpense;
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-right">Total</td>
                                    <td><?= $total_profit - ( $total_loss + $totalexpense ) ?></td>
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
<?php $msg = $this->input->get('msg'); ?>
<?php
switch ($msg) {
    case "RI":
        $m = "Revenue Inserted..!";
        $t = "success";
        break;
    case "RE":
        $m = "Revenue Already Exist..!";
        $t = "error";
        break;
    case "NE":
        $m = "Order Not Exist..!";
        $t = "error";
        break;
    default:
        $m = 0;
        break;
}
?>
<script type="text/javascript">
    $(document).ready(function () {
<?php if ($msg): ?>
            alertify.<?= $t ?>("<?= $m ?>");
<?php endif; ?>
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#datatable-default').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4, 5]
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