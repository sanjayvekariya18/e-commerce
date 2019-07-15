<style type="text/css">
    .screenhide{
        position: fixed;
        width: 100%;        
        height: 100%;        
        z-index: 99999;
        opacity: 0.5;
        background-color: white;
        top: 0px;
        left: 0px;
    }
</style>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Profile Management</h2>

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
                        <a href="#" class="fa fa-caret-down"></a>                        
                    </div>
                    <h2 class="panel-title">Profile Information</h2>                    
                </header>
                <div class="panel-body">
                    <form id="profileform" class="form-horizontal" method="post" action="<?= site_url() ?>buyer/profile/updateCustomerData">
                        <div class="form-group">
                            <label class="col-md-3 control-label">First Name</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="first_name" name="first_name" value="<?= $customer->first_name ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Last Name</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="last_name" name="last_name" value="<?= $customer->last_name ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Mobile No</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="primary_mobile" name="primary_mobile" value="<?= $customer->primary_mobile ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="primary_email" name="primary_email" value="<?= $customer->primary_email ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Gender</label>
                            <div class="col-md-4">
                                <select name="gender" class="form-control">                                   
                                    <option value="Male" selected>Male</option>
                                    <option value="Female" <?= ($customer->gender == "Female") ? 'selected' : '' ?>>Female</option>
                                </select>                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Address Line 1</label>
                            <div class="col-md-4">
                                <textarea class="form-control" rows="3" id="address" name="address" ><?= $customer->address ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Address Line 2</label>
                            <div class="col-md-4">
                                <textarea class="form-control" rows="3" id="landmark" name="landmark" ><?= $customer->landmark ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">City</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="city" name="city" value="<?= $customer->city ?>">
                            </div>
                        </div>
                        <?php $states = $this->common->getStates(); ?>
                        <div class="form-group">
                            <label class="col-md-3 control-label">State</label>
                            <div class="col-md-4">
                                <select id="state" class="input form-control" name="state">
                                    <option value="-1">---Select---</option>
                                    <?php foreach ($states as $val) { ?>
                                        <option value="<?= $val->id ?>"><?= $val->state_name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Pin code</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="pincode" name="pincode" value="<?= $customer->pincode ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Bank Name</label>
                            <div class="col-md-4">                                   
                                <select id="bank_name" name="bank_name" class="form-control">
                                    <?php
                                    if (isset($bankname) && is_array($bankname)) {
                                        foreach ($bankname as $val) {
                                            ?>
                                            <option value="<?= $val->id ?>"
                                            <?php
                                            if ($customer->bank_name == $val->id) {
                                                echo "selected";
                                            }
                                            ?>><?= $val->bank_name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                </select>   
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">IFSC Code</label>
                            <div class="col-md-4">                               
                                <input id="ifsc" name="ifsc" class="form-control" placeholder="IFSC Code" value="<?= $customer->ifsc ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">A/C Name</label>
                            <div class="col-md-4">                                     
                                <input id="accountname" name="account_name" class="form-control" placeholder="Account Holder Name" value="<?= $customer->account_name ?>"/>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 10px">
                            <label class="col-md-3 control-label">Account No</label>
                            <div class="col-md-4">                                     
                                <input id="accountno" name="account_no" class="form-control" placeholder="Account Number" value="<?= $customer->account_no ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">
                                <button id="saveBtn" type="button" class="mb-xs mt-xs mr-xs btn btn-warning">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>       
        </div>
    </div>
    <!-- end: page -->
    <div id="pincodecheckloader" class="screenhide" style="display:none">
        <center>
            <img src="<?= base_url() ?>assets/images/loading_blue.gif" style="margin-top: 200px;width: 150px;height: 150px"/>
            <h3 class="page-heading-title2" style="color:#0088CC;font-size: 28px;margin-top: 50px;">Please Wait ..!!! Pincode Checking...</h3>
        </center>
    </div>
</section>
<?php $msg = $this->input->get('msg'); ?>
<?php
switch ($msg) {
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
    $(document).ready(function () {
<?php if ($msg): ?>
            alertify.<?= $t ?>("<?= $m ?>");
<?php endif; ?>
        $state = "<?= isset($customer->state) ? $customer->state : '-1' ?>";
        $('#state').val($state);

        $('#pincode').focusout(function () {
            $('#pincodecheckloader').css('display', 'block');
            $pincode = $(this).val();
            $.ajax({
                url: '<?= site_url() ?>cart/checkPincode',
                type: 'post',
                data: {'pincode': $pincode},
                success: function (data, textStatus, jqXHR) {
                    $('#pincodecheckloader').css('display', 'none');
                    if (data == 0) {
                        $('#pincode').val('');
                        $('#pincode').focus();
                        alertify.error('Pincode Is Not Valid ..!!');
                    }
                }
            });
        });

        $('#saveBtn').click(function () {
            if ($.trim($('#first_name').val()) == "") {
                alertify.error("Enter First Name");
            } else if ($.trim($('#last_name').val()) == "") {
                alertify.error("Enter Last Name");
            } else if ($.trim($('#primary_mobile').val()) == "") {
                alertify.error("Enter Mobile Number");
            } else if ($.trim($('#primary_email').val()) == "") {
                alertify.error("Enter Email Id");
            } else if ($.trim($('#address').val()) == "") {
                alertify.error("Enter Address Line 1");
            } else if ($.trim($('#landmark').val()) == "") {
                alertify.error("Enter Address Line 2");
            } else if ($.trim($('#city').val()) == "") {
                alertify.error("Enter City Name");
            } else if ($('#state').val() == "-1") {
                alertify.error("Select State Name");
            } else if ($.trim($('#pincode').val()) == "") {
                alertify.error("Enter Pincode");
            } else if (($('#pincode').val()).length != 6) {
                alertify.error("Enter Valid Pincode");
            } else {
                $('#profileform').submit();
            }
        });
    });
</script>    