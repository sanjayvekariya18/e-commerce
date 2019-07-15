<style type="text/css">
    .screenhide{
        position:fixed;
        width: 100%; 
        height: 100%;
        z-index: 99999;
        opacity: 1;
        background-color: transparent; 
        top: 0px;
        left:0px;            
    }
</style> 
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Request Payment</h2>

        <div class="right-wrapper pull-right" style="padding-right: 10px;">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Request Payment</span></li>
            </ol>           
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Request Payment</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form id="paymentform" class="form-horizontal" method="POST" action="<?= site_url() ?>admin/payments_request/payment">   
                                <input type="hidden" name="seller_id" value="<?= isset($request->seller_id) ? base64_encode($request->seller_id) : '' ?>"/>
                                <input type="hidden" name="request_id" value="<?= isset($request->request_id) ? base64_encode($request->request_id) : '' ?>"/>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Date :- </label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input id="req_date" name="payment_date" type="text" data-plugin-datepicker class="form-control" value="<?= date('d-m-Y') ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Seller :- </label>
                                    <div class="col-md-6">
                                        <input id="seller" name="seller" type="text" class="form-control" value="<?= isset($request->business_name) ? $request->business_name : '' ?>">
                                    </div>
                                </div>                        
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Amount :- </label>
                                    <div class="col-md-6">
                                        <input id="amount" name="amount" type="text" class="form-control" value="<?= isset($request->amount) ? $request->amount : '' ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Bank name</label>
                                    <div class="col-md-6">
                                        <select name="bank_name" class="form-control">
                                            <?php
                                            if (isset($bank) && is_array($bank)) {
                                                foreach ($bank as $val) {
                                                    ?>
                                                    <option value="<?= $val->bank_name ?>"><?= $val->bank_name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>                                
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Reference Id :- </label>
                                    <div class="col-md-6">
                                        <input id="reference_id" name="reference_id" type="text" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Transaction Id :- </label>
                                    <div class="col-md-6">
                                        <input id="transaction_id" name="transaction_id" type="text" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label"></label>
                                    <div class="col-md-8">
                                        <button id="save" name="saveBtn" type="button" class="mb-xs mt-xs mr-xs btn btn-success" style="width:100px" value="save">Submit</button>
                                        <button type="reset" class="mb-xs mt-xs mr-xs btn btn-danger" style="width:100px">Clear</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="col-md-6">
                            <form class="form-horizontal" method="POST" action="#">                        
                                <div class="form-group">
                                    <label class="col-md-6 control-label">Account Holder Name :- </label>
                                    <div class="col-md-6">
                                        <label class="control-label" style="text-align: left;"><?= isset($request->account_name) ? $request->account_name : '' ?> </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-6 control-label">Account Number :- </label>
                                    <div class="col-md-6">
                                        <label class="control-label" style="text-align: left;"><?= isset($request->account_no) ? $request->account_no : '' ?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-6 control-label">Bank Name :- </label>
                                    <div class="col-md-6">
                                        <label class="control-label" style="text-align: left;"><?= isset($request->bank_name) ? $request->bank_name : '' ?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-6 control-label">IFSC Code :- </label>
                                    <div class="col-md-6">
                                        <label class="control-label" style="text-align: left;"><?= isset($request->bank_ifsc) ? $request->bank_ifsc : '' ?> </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-6 control-label">Amount :- </label>
                                    <div class="col-md-6">
                                        <label class="control-label" style="text-align: left;"><?= isset($request->amount) ? $request->amount : '' ?> </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </div>
    <div id="paymentloader" class="screenhide" style="display:none;">        
        <center>
            <img src="<?= base_url() ?>assets/images/loading_blue.gif" style="width: 100px;height: 100px;margin-top: 350px;margin-left: 100px"/>
        </center>
    </div>
    <!-- end: page -->
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $('#save').click(function() {
            $('#paymentloader').css('display', 'block');
            $('#paymentform').submit();
        });
    });
</script>