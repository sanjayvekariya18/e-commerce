<section role="main" class="content-body">
    <header class="page-header">
        <h2>Seller Balance Master</h2>

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
                    <form name="search" method="POST" action="<?= site_url() ?>admin/others/sellerBalanceSearch">
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
                                <label class="control-label">First Name</label>                          
                                <input name="first_name" type="text" class="form-control" >
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Last Name</label>                          
                                <input name="last_name" type="text" class="form-control" >
                            </div> 
                        </div>
                        <div class="row" style="margin-top: 15px">
                            <div class="col-md-4">
                                <label class="control-label">Mobile No</label>                          
                                <input name="primary_mobile" type="text" class="form-control">
                            </div> 
                            <div class="col-md-4">
                                <label class="control-label">Email</label>                          
                                <input name="primary_email" type="email" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">City</label>                          
                                <input name="pickup_city" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 15px">
                            <div class="col-md-4">
                                <label class="control-label">Status</label> 
                                <select id="status" name="status" class="form-control">
                                    <option value="-1">--Select--</option>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
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
                    <h2 class="panel-title">Seller Detail</h2>                    
                </header>
                <div class="panel-body">
                    <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                    <form id="tableform" method="POST" action="#">
                        <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                            <thead>
                                <tr>                                    
                                    <th>Date</th>
                                    <th>Full Name</th>
                                    <th style="width: 150px;">Business Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Payable</th>
                                    <th>Paid</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                if (isset($sellers)) {
                                    $total_payable = 0;
                                    $total_paid = 0;
                                    foreach ($sellers as $seller) {
                                        $payable_amount = 0;
                                        $paid_amount = 0;
                                        ?>
                                        <tr>
                                            <td style="width:80px;"><?= date("d-m-Y", strtotime($seller->reg_date)) ?></td>
                                            <td><?= $seller->first_name . " " . $seller->last_name ?></td>
                                            <td><?= $seller->business_name ?></td>
                                            <td><?= $seller->primary_mobile ?></td>
                                            <td><?= $seller->primary_email ?></td>
                                            <td><i class="fa fa-rupee"></i> <?php
                                                $payable = $this->common->getPayableData($seller->seller_id);
                                                $payable_amount = $payable->credit - $payable->debit;
                                                $total_payable += $payable_amount;
                                                echo round($payable_amount);
                                                ?></td>
                                            <td><i class="fa fa-rupee"></i> <?php
                                                $paid_amount = $this->common->getPayoutData($seller->seller_id)->total;
                                                $total_paid += $paid_amount;
                                                echo ($paid_amount != "") ? round($paid_amount) : "0";
                                                ?></td>
                                            <td><i class="fa fa-rupee"></i> <?= round($payable_amount - $paid_amount) ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>                                
                            </tbody>
                            <tr>
                                <td colspan="7" style="text-align: right">Total Payable</td>
                                <td><i class="fa fa-rupee"></i> <?= round($total_payable) ?></td>
                            </tr>
                            <tr>
                                <td colspan="7" style="text-align: right">Total Paid</td>
                                <td><i class="fa fa-rupee"></i> <?= round($total_paid) ?></td>
                            </tr>
                            <tr>
                                <td colspan="7" style="text-align: right">Total Balance</td>
                                <td><i class="fa fa-rupee"></i> <?= round($total_payable - $total_paid) ?></td>
                            </tr>
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
                }], iDisplayLength: 10
        });

        $("#btnExport1").click(function () {
            $("#datatable-default").btechco_excelexport({
                containerid: "datatable-default",
                datatype: $datatype.Table
            });
        });

    });
</script>