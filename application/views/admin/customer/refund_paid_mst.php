<section role="main" class="content-body">
    <header class="page-header">
        <h2>Refund Paid Master</h2>

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
                    <form name="search" method="POST" action="<?= site_url() ?>admin/refund_paid/getRefundPaidSearchData">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Refund Request Date</label>
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
                    <h2 class="panel-title">Refund Paid Details</h2>                    
                </header>
                <div class="panel-body"> 
                    <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                    <table class="table table-bordered table-striped mb-none" id="datatable-default" style="text-align: center">
                        <thead>
                            <tr>                                  
                                <th>Payment Date</th>
                                <th>Order ID</th>
                                <th>Product Name</th>
                                <th>Customer</th>                                
                                <th>Seller</th>                                
                                <th>Transaction Id</th>                                
                                <th>Transfer Bank Name</th> 
                                <th>Amount</th> 
                                <th>View</th> 
                            </tr>
                        </thead>
                        <tbody> 
                            <?php
                            if (isset($refund) && is_array($refund)) {
                                foreach ($refund as $val) {
                                    ?>
                                    <tr>                                            
                                        <td><?= date('d-m-Y', strtotime($val->payment_date)) ?></td>
                                        <td><?= $val->order_id ?></td>
                                        <td><?= $val->product_name ?></td>
                                        <td><?= $val->first_name . " " . $val->last_name ?></td>
                                        <td><?= $val->business_name ?></td>
                                        <td><?= $val->transaction_id ?></td>
                                        <td><?= $val->pay_bank_name ?></td>
                                        <td><?= $val->amount ?></td>
                                        <td><a id="<?= $val->id ?>" class="mb-xs mt-xs mr-xs modal-with-move-anim information" href="#modalView"><i class="fa fa-th"></i></a></td>
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

    <!--Price Calculator Model Start -->
    <div id="modalView" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title">Information</h2>
            </header>
            <div class="panel-body">

                <div class="row">                

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                <label  class="control-label">Product Name</label>
                            </div>
                            <div class="col-md-8">
                                <label id="product_name" class="control-label"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Request Date :</label>
                            </div>
                            <div class="col-md-8">
                                <label id="request_date" class="control-label"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Payment Date :</label>
                            </div>
                            <div class="col-md-8">
                                <label id="payment_date" class="control-label"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Amount :</label>
                            </div>
                            <div class="col-md-8">
                                <label id="amount" class="control-label"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Transaction Id :</label>
                            </div>
                            <div class="col-md-8">
                                <label id="transaction_id" class="control-label"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Pay Bank Name :</label>
                            </div>
                            <div class="col-md-8">
                                <label id="pay_bank_name" class="control-label"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Account Name :</label>
                            </div>
                            <div class="col-md-8">
                                <label id="account_name" class="control-label"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Account No :</label>
                            </div>
                            <div class="col-md-8">
                                <label id="account_no" class="control-label"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Bank Name :</label>
                            </div>
                            <div class="col-md-8">
                                <label id="bank_name" class="control-label"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">IFSC Code :</label>
                            </div>
                            <div class="col-md-8">
                                <label id="ifsc" class="control-label"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                           
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">                        
                        <button class="btn btn-default modal-dismiss">Close</button>
                    </div>
                </div>
            </footer>
        </section>
    </div>
    <!--Price Calculator Model End-->
    <!-- end: page -->
</section>
<script type="text/javascript">
    $(function () {
        $('#datatable-default').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4, 5, 6]
                }],
            iDisplayLength: 10
        });

        $("#btnExport1").click(function () {
            $("#datatable-default").btechco_excelexport({
                containerid: "datatable-default",
                datatype: $datatype.Table
            });
        });

        information();

        $('.dataTables_paginate').click(function () {
            information();
        });

        $('.dataTables_filter input').change(function () {
            information();
        });

        function information() {
            $('.information').click(function () {
                $refund_id = $(this).attr('id');
                $.ajax({
                    url: "<?= site_url() ?>admin/refund_paid/getRefundDetail",
                    type: "post",
                    data: {'id': $refund_id},
                    success: function (data, textStatus, jqXHR) {
                        $data = JSON.parse(data);
                        $request_date = new Date($data['request_date']);
                        $payment_date = new Date($data['payment_date']);
                        $('#product_name').text($data['product_name']);
                        $('#request_date').text($request_date.getDate() + '-' + ($request_date.getMonth() + 1) + '-' + $request_date.getFullYear());
                        $('#payment_date').text($payment_date.getDate() + '-' + ($payment_date.getMonth() + 1) + '-' + $payment_date.getFullYear());
                        $('#amount').text($data['payment']);
                        $('#transaction_id').text($data['transaction_id']);
                        $('#pay_bank_name').text($data['pay_bank_name']);
                        $('#account_name').text($data['account_name']);
                        $('#account_no').text($data['account_no']);
                        $('#bank_name').text($data['bank_name']);
                        $('#ifsc').text($data['ifsc']);
                    }
                });
            });
        }
    });
</script>