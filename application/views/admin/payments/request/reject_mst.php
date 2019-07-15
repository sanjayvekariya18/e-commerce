<section role="main" class="content-body">
    <header class="page-header">
        <h2>Payout Request Reject Master</h2>

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
                        <a href="#" class="fa fa-caret-down"></a>                        
                    </div>

                    <h2 class="panel-title">Advance Search</h2>                    
                </header>
                <div class="panel-body"> 
                    <form name="search" method="POST" action="<?= site_url() ?>admin/payments_request/payoutRequestRejectSearch">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Date</label>
                                <div class="input-daterange input-group" data-plugin-datepicker>
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>    
                                    </span>
                                    <input type="text" class="form-control" name="start" required>
                                    <span class="input-group-addon">to</span>
                                    <input type="text" class="form-control" name="end" required>
                                </div>   
                            </div>  
                            <div class="col-md-4">
                                <label class="control-label">Business Name</label>                          
                                <input name="business_name" type="text" class="form-control" >
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Amount</label>                          
                                <input name="amount" type="text" class="form-control" >
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
                    <h2 class="panel-title">Payout Request Reject Detail</h2>                    
                </header>
                <div class="panel-body">       
                    <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                    <button class="btn btn-primary btn-sm mycheck" type="button" style="width:80px;margin-bottom: 15px" id="0">Inreview</button>
                    <button class="btn btn-info btn-sm mycheck" type="button" style="width:80px;margin-bottom: 15px" id="3">Rejected</button>
                    <button class="btn btn-warning btn-sm mycheck" type="button" style="width:80px;margin-bottom: 15px" id="2">Cancel</button>
                    <form id="actionform" name="actionform" method="POST" action="<?= site_url() ?>admin/payments_request/payoutStatusRejectUpdate">
                        <input type="hidden" name="status" id="status" value=""/>
                        <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                            <thead>
                                <tr>
                                    <th style="font-size: 17px;padding-right: 18px;text-align: center;">
                                        <i class="fa fa-level-down"></i>     
                                    </th>
                                    <th>Request Date</th>
                                    <th>Business Name</th>
                                    <th>Withdraw Amount</th>                                
                                    <th>Status</th>                                    
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                if (isset($request) && is_array($request)) {
                                    foreach ($request as $val) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php if ($val->status != 1) { ?>
                                                    <input name="allRequest[]" value="<?= $val->request_id ?>" type="checkbox" >
                                                <?php } ?>
                                            </td>
                                            <td><?= date('d-m-Y', strtotime($val->request_date)) ?></td>
                                            <td><?= $val->business_name ?></td>
                                            <td><?= $val->amount ?></td>
                                            <td>
                                                <?php if ($val->status == 0) { ?>
                                                    <span class="label label-primary">In-Review</span>
                                                <?php } else if ($val->status == 1) { ?>
                                                    <span class="label label-success">Paid</span>
                                                <?php } else if ($val->status == 2) { ?>
                                                    <span class="label label-info">Cancel</span>
                                                <?php } else if ($val->status == 3) { ?>
                                                    <span class="label label-danger">Rejected</span>
                                                <?php } ?>
                                            </td>                                            
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
<?php $msg = $this->input->get('msg'); ?>
<?php
switch ($msg) {
    case "S":
        $m = "Payment Successfully Done..!";
        $t = "success";
        break;
    case "U":
        $m = "Status Successfully Updated..!";
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
                    aTargets: [0, 1, 2]
                }],
            iDisplayLength: 10
        });
        
        $("#btnExport1").click(function () {
            $("#datatable-default").btechco_excelexport({
                containerid: "datatable-default",              
                datatype: $datatype.Table
            });
        });

        $('.mycheck').click(function() {
            $status = $(this).attr('id');
            $('#status').val($status);
            $('#actionform').submit();
        });
    });
</script>