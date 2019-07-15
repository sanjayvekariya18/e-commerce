<style type="text/css">
    th{
        text-align: center;
    }
</style>    
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Seller Group Master</h2>

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
            <a href="<?= site_url() ?>admin/sellergroup/addSellerGroup" class="btn btn-success btn-md" >Add Seller Group</a>
        </div>
    </div>    
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">                  
                    <h2 class="panel-title">Seller Group Detail</h2>                    
                </header>
                <div class="panel-body">
                    <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                    <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                        <thead>
                            <tr>
                                
                                <th>Group Name</th>
                                <th>Commission (%)</th>
                                <th>Fixed</th>
                                <th>Service Tax (%)</th>
                                <th>Listing Fee</th>
                                <th>Marketing Fee (%)</th>
                                <th>Payment Collection Fee (%)</th>
                                <th>Other Fee</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>  
                            <?php
                            if (isset($sellergroup)) {
                                foreach ($sellergroup as $val) {
                                    ?>
                                    <tr>
                                        <td><?=$val->group_name?></td>
                                        <td><?=$val->commission_fee?></td>
                                        <td><?=$val->fixed_fee?></td>
                                        <td><?=$val->service_fee?></td>
                                        <td><?=$val->listing_fee?></td>
                                        <td><?=$val->marketing_fee?></td>
                                        <td><?=$val->pay_fee?></td>
                                        <td><?=$val->other_fee?></td>
                                        <td><a href="<?=  site_url()?>admin/sellergroup/getSellerGroupData?id=<?=  base64_encode($val->group_id)?>" class="btn btn-success btn-xs" >Edit</a></td>
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
        $m = "Information Successfully Saved..!";
        $t = "success";
        break;
    case "U":
        $m = "Information Successfully Updated..!";
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
                    aTargets: [0, 1, 2, 3, 4, 5, 6, 7, 8]
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