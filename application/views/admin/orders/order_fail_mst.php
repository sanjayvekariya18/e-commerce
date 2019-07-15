<style type="text/css">
    th{
        text-align: center;
    }
</style>    
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Fail Order History</h2>

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
                    <h2 class="panel-title">Fail Order History</h2>                    
                </header>
                <div class="panel-body">
                    <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                    <a href="<?= site_url() ?>admin/order_failed/orderClear"><button class="btn btn-danger btn-sm " type="button" style="width:200px;margin-bottom: 15px">Delete All Orders</button></a>
                    <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                        <thead>
                            <tr>                                
                                <th>Order Date</th>
                                <th>Order Id</th>
                                <th>Buyer Name</th>
                                <th>Buyer Mobile</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>selling Price</th>
                                <th>Payment Price</th>
                            </tr>
                        </thead>
                        <tbody>  
                            <?php
                            if (isset($orders)) {
                                foreach ($orders as $val) {
                                    ?>
                                    <tr>
                                        <td><?= date('d-m-Y H:i:s', strtotime($val->order_date)) ?></td>
                                        <td><?= $val->order_id ?></td>
                                        <td><?= $val->first_name." ".$val->last_name ?></td>
                                        <td><?= $val->primary_mobile ?></td>
                                        <td><?= $val->product_name ?></td>
                                        <td><?= $val->qty ?></td>
                                        <td><?= $val->selling_price ?></td>
                                        <td><?= $val->payment_price ?></td>
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
    </div>
    <!-- end: page -->
</section>
<?php $msg = $this->input->get('msg'); ?>
<?php
switch ($msg) {
    case "S":
        $m = "Information Successfully Deleted..!";
        $t = "success";
        break;
    default:
        $m = 0;
        break;
}
?>
<script type="text/javascript">
    $(document).ready(function() {
<?php if ($msg): ?>
            alertify.<?= $t ?>("<?= $m ?>");
<?php endif; ?>
    });
</script>
<script type="text/javascript">
    $(function() {
        $('#datatable-default').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4, 5, 6, 7]
                }],
            iDisplayLength: -1
        });
        
        $("#btnExport1").click(function () {
            $("#datatable-default").btechco_excelexport({
                containerid: "datatable-default",              
                datatype: $datatype.Table
            });
        });
    });
</script>