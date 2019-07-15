<section role="main" class="content-body">
    <header class="page-header">
        <h2>Add Payout Request</h2>

        <div class="right-wrapper pull-right" style="padding-right: 10px;">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>seller">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Add Payout Request</span></li>
            </ol>           
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Payout Detail</h2>
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?= site_url() ?>seller/payments/addPayoutRequest">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Date :- </label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input id="req_date" name="req_date" type="text" class="form-control" value="<?= date('d-m-Y') ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Available Amount :- </label>
                            <div class="col-md-4">
                                <input id="available" name="available" type="text" class="form-control" value="<?= ceil($balance) ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Request Withdraw :- </label>
                            <div class="col-md-4">
                                <input id="request" name="request" type="text" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Remain Amount :- </label>
                            <div class="col-md-4">
                                <input id="remain" name="remain" type="text" class="form-control" value="" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">
                                <button id="save" name="saveBtn" type="submit" class="mb-xs mt-xs mr-xs btn btn-success" style="width:100px" value="save" disabled>Submit</button>
                                <button type="reset" class="mb-xs mt-xs mr-xs btn btn-danger" style="width:100px">Clear</button>
                            </div>
                        </div>

                    </form>
                </div>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $balance = "<?= isset($balance) ? $balance : 0 ?>";
        $min_balance = "<?= isset($amountpolicy->min_balance) ? $amountpolicy->min_balance : 0 ?>";
        $min_withdraw = "<?= isset($amountpolicy->min_withdraw_amount) ? $amountpolicy->min_withdraw_amount : 0 ?>";

        $('#request').focusout(function() {
            if (parseFloat($(this).val()) < parseFloat($min_withdraw)) {
                alertify.error("Minimun Withdraw Amount Is : " + $min_withdraw);
                $(this).val("0");                
                $('#remain').val("0");
                $('#save').prop('disabled', true);
            } else if (parseFloat($balance) - parseFloat($('#request').val()) < parseFloat($min_balance)) {
                alertify.error("Minimun Balance Required Is : " + $min_balance);
                $(this).val("0");                
                $('#remain').val("0");
                $('#save').prop('disabled', true);
            } else if($(this).val() == ""){
                alertify.error("Plese Enter Withdraw Amount");
                $(this).val("0");                
                $('#remain').val("0");
                $('#save').prop('disabled', true);
            }else {
                $remain = parseFloat($balance) - parseFloat($('#request').val());
                $('#remain').val($remain);
                $('#save').removeAttr('disabled');
            }
        });
    });
</script>