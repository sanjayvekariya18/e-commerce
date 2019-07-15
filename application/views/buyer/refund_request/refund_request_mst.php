<section role="main" class="content-body">
    <header class="page-header">
        <h2>Refund Request Master</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>buyer">
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
                    <form name="search" method="POST" action="<?= site_url() ?>buyer/refund/refundRequestSearch">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Refund Request Date</label>
                                <div class="input-daterange input-group" data-plugin-datepicker>
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>    
                                    </span>
                                    <input type="text" class="form-control" name="start">
                                    <span class="input-group-addon">to</span>
                                    <input type="text" class="form-control" name="end">
                                </div>   
                            </div> 
                            <div class="col-md-4">
                                <label class="control-label">Payment Date</label>
                                <div class="input-daterange input-group" data-plugin-datepicker>
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>    
                                    </span>
                                    <input type="text" class="form-control" name="pstart">
                                    <span class="input-group-addon">to</span>
                                    <input type="text" class="form-control" name="pend">
                                </div>   
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
                    <h2 class="panel-title">Refund Request Details</h2>                    
                </header>
                <div class="panel-body">                    
                    <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                        <thead>
                            <tr>                                    
                                <th>Request Date</th>
                                <th>Payment Date</th>
                                <th>Order Id</th>
                                <th>Product Name</th>
                                <th>Seller</th>                                
                                <th>Transaction Id</th>                                
                                <th>Transfer Bank Name</th> 
                                <th>Amount</th> 
                                <th>Status</th>                                
                            </tr>
                        </thead>
                        <tbody> 
                            <?php
                            if (isset($refund) && is_array($refund)) {
                                foreach ($refund as $val) {
                                    ?>
                                    <tr>                                            
                                        <td><?= date('d-m-Y', strtotime($val->request_date)) ?></td>
                                        <td><?= ($val->payment_date != "") ? date('d-m-Y', strtotime($val->payment_date)) : "" ?></td>
                                        <td><?= $val->order_id ?></td>
                                        <td><?= $val->product_name ?></td>
                                        <td><?= $val->business_name ?></td>
                                        <td><?= $val->transaction_id ?></td>
                                        <td><?= $val->pay_bank_name ?></td>
                                        <td><?= $val->amount ?></td>
                                        <td>                                            
                                            <?php if ($val->status == 0) { ?>
                                                <span class="label label-info">In-Review</span>
                                            <?php } else if ($val->status == 1) { ?>
                                                <span class="label label-info">Paid</span>                                            
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
                    aTargets: [0, 1, 2, 3, 4, 5, 6, 7]
                }],
            iDisplayLength: 10
        });
    });
</script>