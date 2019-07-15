<section role="main" class="content-body">
    <header class="page-header">
        <h2>Payout  Master</h2>

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
                    <form name="search" method="POST" action="<?= site_url() ?>admin/payments_request/payoutSearch">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Payment Date</label>
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
                                <label class="control-label">Transaction Id</label>                          
                                <input name="transaction_id" type="text" class="form-control" >
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
                    <h2 class="panel-title">Payout Detail</h2>                    
                </header>
                <div class="panel-body">  
                    <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                    <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                        <thead>
                            <tr>                                    
                                <th>Payment Date</th>
                                <th>Business Name</th>
                                <th>Paid Amount</th>                                
                                <th>Bank Name</th>                                
                                <th>Transaction Id</th>                                
                                <th>Status</th>                                
                            </tr>
                        </thead>
                        <tbody> 
                            <?php
                            if (isset($payout) && is_array($payout)) {
                                foreach ($payout as $val) {
                                    ?>
                                    <tr>                                            
                                        <td><?= date('d-m-Y', strtotime($val->payment_date)) ?></td>
                                        <td><?= $val->business_name ?></td>
                                        <td><?= $val->amount ?></td>
                                        <td><?= $val->pay_bank_name ?></td>
                                        <td><?= $val->transaction_id ?></td>
                                        <td>                                            
                                            <?php if ($val->status == 1) { ?>
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