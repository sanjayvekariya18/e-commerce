<section role="main" class="content-body">
    <header class="page-header">
        <h2>Profile Management</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>admin">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
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
                    <h2 class="panel-title">Group Information</h2>                    
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="<?= site_url() ?>admin/seller/updateGroupInfo">
                        <input type="hidden" name="seller_id" value="<?= $seller->seller_id ?>"/>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Group Name</label>
                            <div class="col-md-4">
                                <select id="seller_group" name="seller_group" class="form-control">
                                    <?php
                                    if (isset($sellergroup)) {
                                        foreach ($sellergroup as $val) {
                                            ?>
                                            <option value="<?= $val->group_id ?>" <?= ($val->group_id == $seller->group_id) ? "selected" : "" ?>><?= $val->group_name ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" class="mb-xs mt-xs mr-xs btn btn-warning">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>                        
                    </div>
                    <h2 class="panel-title">Display Information</h2>                    
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="<?= site_url() ?>admin/seller/updateDisplayInfo">
                        <input type="hidden" name="seller_id" value="<?= $seller->seller_id ?>"/>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Your display name<br/>(Visible to buyers)</label>
                            <div class="col-md-4">
                                <input name="display_name" type="text" class="form-control" value="<?= $seller->display_name ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Describe your business</label>
                            <div class="col-md-4">
                                <textarea name="business_desc" class="form-control" rows="3" required><?= $seller->business_desc ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" class="mb-xs mt-xs mr-xs btn btn-warning">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>                        
                    </div>

                    <h2 class="panel-title">Pickup Address</h2>                    
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="<?= site_url() ?>admin/seller/updatePickupInfo">
                        <input type="hidden" name="seller_id" value="<?= $seller->seller_id ?>"/>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Address Line 1</label>
                            <div class="col-md-4">
                                <textarea name="pickup_address" class="form-control" rows="3" required><?= $seller->pickup_address ?></textarea>
                            </div>
                        </div>
                        <div class="form-group" style="display:none">                            
                            <label class="col-md-3 control-label">Address Line 2 *</label>
                            <div class="col-md-4">
                                <textarea id="pickup_landmark" name="pickup_landmark" class="form-control" rows="3"><?= $seller->pickup_landmark ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Pin code</label>
                            <div class="col-md-4">
                                <input id="pickup_pincode" name="pickup_pincode" type="text" class="form-control" value="<?= $seller->pickup_pincode ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Your pickup city</label>
                            <div class="col-md-4">
                                <input name="pickup_city" type="text" class="form-control" value="<?= $seller->pickup_city ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">State *</label>
                            <div class="col-md-4">
                                <select id="pickup_state" name="pickup_state" class="form-control" required>                                    
                                    <?php foreach ($states as $val) { ?>
                                        <option value="<?= $val->id ?>"><?= $val->state_name ?></option>
                                    <?php } ?>                                  
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" class="mb-xs mt-xs mr-xs btn btn-warning">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>                        
                    </div>

                    <h2 class="panel-title">Primary Contact <label style="font-size: 12px;color: gray;padding-left: 20px;margin-bottom: 0px">All confirmations, updates, transaction details, and other business communications will be sent to this primary contact</label></h2>                    
                </header>
                <div class="panel-body">
                    <form id="primaryinfoform" class="form-horizontal" method="post" action="<?= site_url() ?>admin/seller/updatePrimaryInfo">
                        <input type="hidden" name="seller_id" value="<?= $seller->seller_id ?>"/>
                        <div class="form-group">
                            <label class="col-md-3 control-label">First Name</label>
                            <div class="col-md-4">
                                <input name="first_name" type="text" class="form-control" value="<?= $seller->first_name ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Last Name</label>
                            <div class="col-md-4">
                                <input name="last_name" type="text" class="form-control" value="<?= $seller->last_name ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email</label>
                            <div class="col-md-4">
                                <input  type="email" class="form-control" value="<?= $seller->primary_email ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Mobile No</label>
                            <div class="col-md-4">
                                <input id="primary_mobile" name="primary_mobile" type="text" class="form-control" value="<?= $seller->primary_mobile ?>" <?= ($seller->mobile_status == '1') ? 'readonly' : 'required' ?>>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">
                                <?php
                                if ($seller->mobile_status == '0') {
                                    ?>
                                    <a id="primaryinfo" class="mb-xs mt-xs mr-xs btn btn-warning" data-toggle="modal" data-target="#modalOTP">Save Changes</a>
                                    <?php
                                } else {
                                    ?>
                                    <button type="submit" class="mb-xs mt-xs mr-xs btn btn-warning" >Save Changes</button>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>                        
                    </div>

                    <h2 class="panel-title">Business Details </h2>                    
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= site_url() ?>admin/seller/updateBusinessInfo">
                        <input type="hidden" name="seller_id" value="<?= $seller->seller_id ?>"/>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Business name</label>
                            <div class="col-md-4">
                                <input name="business_name" type="text" class="form-control" value="<?= $seller->business_name ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">PAN ID</label>
                            <div class="col-md-4">
                                <input name="pan_id" type="text" class="form-control" value="<?= $seller->pan_id ?>" required>
                            </div>
                        </div>

                        <div class="form-group" style="display:<?= ($seller->pan_url != "") ? 'block' : 'none' ?>">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">                                
                                <img src="<?= $seller->pan_url ?>" style="width: 370px;border: 4px double;height: 180px;"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">PAN Document</label>
                            <div class="col-md-6">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="input-append">
                                        <div class="uneditable-input">
                                            <i class="fa fa-file fileupload-exists"></i>
                                            <span class="fileupload-preview"></span>
                                        </div>
                                        <span class="btn btn-default btn-file">
                                            <span class="fileupload-exists">Change</span>
                                            <span class="fileupload-new">Select file</span>
                                            <input type="file" name="pan_doc" <?= ($seller->pan_url == "") ? 'required' : '' ?> />
                                        </span>
                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">TIN</label>
                            <div class="col-md-4">
                                <input name="tin_id" type="text" class="form-control" value="<?= $seller->tin_id ?>">
                            </div>
                        </div>
                        <div class="form-group" style="display:<?= ($seller->tin_url != "") ? 'block' : 'none' ?>">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">                                
                                <img src="<?= $seller->tin_url ?>" style="width: 370px;border: 4px double;height: 180px;"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">TIN Document</label>
                            <div class="col-md-6">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="input-append">
                                        <div class="uneditable-input">
                                            <i class="fa fa-file fileupload-exists"></i>
                                            <span class="fileupload-preview"></span>
                                        </div>
                                        <span class="btn btn-default btn-file">
                                            <span class="fileupload-exists">Change</span>
                                            <span class="fileupload-new">Select file</span>
                                            <input type="file" name="tin_doc"/>
                                        </span>
                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">TAN ID</label>
                            <div class="col-md-4">
                                <input name="tan_id" type="text" class="form-control" value="<?= $seller->tan_id ?>">
                            </div>
                        </div>
                        <div class="form-group" style="display:<?= ($seller->tan_url != "") ? 'block' : 'none' ?>">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">                                
                                <img src="<?= $seller->tan_url ?>" style="width: 370px;border: 4px double;height: 180px;"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">TAN Document</label>
                            <div class="col-md-6">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="input-append">
                                        <div class="uneditable-input">
                                            <i class="fa fa-file fileupload-exists"></i>
                                            <span class="fileupload-preview"></span>
                                        </div>
                                        <span class="btn btn-default btn-file">
                                            <span class="fileupload-exists">Change</span>
                                            <span class="fileupload-new">Select file</span>
                                            <input type="file" name="tan_doc"/>
                                        </span>
                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" class="mb-xs mt-xs mr-xs btn btn-warning">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>                        
                    </div>

                    <h2 class="panel-title">Bank Account</h2>                    
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="<?= site_url() ?>admin/seller/updateBankInfo">
                        <input type="hidden" name="seller_id" value="<?= $seller->seller_id ?>"/>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Account Holder's Name</label>
                            <div class="col-md-4">
                                <input name="account_name" type="text" class="form-control" value="<?= $seller->account_name ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Account number</label>
                            <div class="col-md-4">
                                <input name="account_no" type="text" class="form-control" value="<?= $seller->account_no ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Bank name</label>
                            <div class="col-md-4">
                                <select id="bank" name="bank_name" class="form-control" required>
                                    <?php
                                    if (isset($bankname) && is_array($bankname)) {
                                        foreach ($bankname as $val) {
                                            ?>
                                            <option value="<?= $val->id ?>"><?= $val->bank_name ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">State</label>
                            <div class="col-md-4">
                                <select id="state" name="bank_state" class="form-control" required>
                                    <option value="-1">-- Select State --</option>
                                    <?php foreach ($states as $val) { ?>
                                        <option value="<?= $val->id ?>"><?= $val->state_name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">City</label>
                            <div class="col-md-4">
                                <input name="bank_city" type="text" class="form-control" value="<?= $seller->bank_city ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Branch</label>
                            <div class="col-md-4">
                                <input name="bank_branch" type="text" class="form-control" value="<?= $seller->bank_branch ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">IFSC Code</label>
                            <div class="col-md-4">
                                <input name="bank_ifsc" type="text" class="form-control" value="<?= $seller->bank_ifsc ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" class="mb-xs mt-xs mr-xs btn btn-warning">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>                        
                    </div>

                    <h2 class="panel-title">KYC Documents<label style="font-size: 12px;color: gray;padding-left: 20px;margin-bottom: 0px">Please submit documents belonging to bank account holder</label></h2>                    
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= site_url() ?>admin/seller/updateDocumentInfo">
                        <input type="hidden" name="seller_id" value="<?= $seller->seller_id ?>"/>
                        <div class="form-group" style="display:<?= ($seller->address_proof != "") ? 'block' : 'none' ?>">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">                                
                                <img src="<?= $seller->address_proof ?>" style="width: 370px;border: 4px double;height: 180px;"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Upload address proof</label>
                            <div class="col-md-6">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="input-append">
                                        <div class="uneditable-input">
                                            <i class="fa fa-file fileupload-exists"></i>
                                            <span class="fileupload-preview"></span>
                                        </div>
                                        <span class="btn btn-default btn-file">
                                            <span class="fileupload-exists">Change</span>
                                            <span class="fileupload-new">Select file</span>
                                            <input type="file" name="address_doc" required/>
                                        </span>
                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="display:<?= ($seller->id_proof != "") ? 'block' : 'none' ?>">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">                                
                                <img src="<?= $seller->id_proof ?>" style="width: 370px;border: 4px double;height: 180px;"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Upload ID proof</label>
                            <div class="col-md-6">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="input-append">
                                        <div class="uneditable-input">
                                            <i class="fa fa-file fileupload-exists"></i>
                                            <span class="fileupload-preview"></span>
                                        </div>
                                        <span class="btn btn-default btn-file">
                                            <span class="fileupload-exists">Change</span>
                                            <span class="fileupload-new">Select file</span>
                                            <input type="file" name="id_doc" required/>
                                        </span>
                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="display:<?= ($seller->cheque_proof != "") ? 'block' : 'none' ?>">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">                                
                                <img src="<?= $seller->cheque_proof ?>" style="width: 370px;border: 4px double;height: 180px;"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Upload Cancelled Cheque</label>
                            <div class="col-md-6">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="input-append">
                                        <div class="uneditable-input">
                                            <i class="fa fa-file fileupload-exists"></i>
                                            <span class="fileupload-preview"></span>
                                        </div>
                                        <span class="btn btn-default btn-file">
                                            <span class="fileupload-exists">Change</span>
                                            <span class="fileupload-new">Select file</span>
                                            <input type="file" name="cheque_doc" required/>
                                        </span>
                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" class="mb-xs mt-xs mr-xs btn btn-warning">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
    <div class="modal fade" id="modalOTP" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close otpclose" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body">
                    <p>Enter Your Verification Code</p>
                    <input id="myotp" type="text" name="myotp" class="form-control" />
                </div>
                <div class="modal-footer">
                    <button id="confirm" type="button" class="btn btn-primary">Confirm</button>
                    <button type="button" class="btn btn-default otpclose" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end: page -->
</section>
<?php $msg = $this->input->get('msg'); ?>
<?php
switch ($msg) {
    case "U":
        $m = "Information Updated Successfully..!";
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
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $bank = "<?= ($seller->bank_name != "") ? $seller->bank_name : '-1' ?>";
        $state = "<?= ($seller->bank_state != "") ? $seller->bank_state : '-1' ?>";
        $pickup_state = "<?= ($seller->pickup_state != "") ? $seller->pickup_state : '1' ?>";
        $otp = "";
        $('#bank').val($bank);
        $('#state').val($state);
        $('#pickup_state').val($pickup_state);

        $('#primaryinfo').click(function () {
            $mobile = $('#primary_mobile').val();
            $otp = Math.floor(Math.random() * 90000) + 10000;
            $.ajax({
                url: "<?= site_url() ?>admin/seller/sendOTP",
                type: 'POST',
                data: {'mobile': $mobile, 'otp': $otp},
                success: function (data, textStatus, jqXHR) {

                }
            });
        });

        $('#confirm').click(function () {
            $myotp = $('#myotp').val();
            if ($otp != $myotp) {
                alertify.error("Your Otp Is Wrong");
            } else {
                $('#primaryinfoform').submit();
            }
            ;
        });

        $('.otpclose').click(function () {
            $('#primary_mobile').val('');
        });

        $('#pickup_pincode').focusout(function () {
            $pincode = $(this).val();
            $.ajax({
                url: '<?= site_url() ?>admin/seller/checkPincode',
                type: 'post',
                data: {'pincode': $pincode},
                success: function (data, textStatus, jqXHR) {
                    if (data == 0) {
                        $('#pickup_pincode').val('');
                        $('#pickup_pincode').focus();
                        alertify.error('Pincode Is Not Valid ..!!');
                    }
                }
            });
        });
    });
</script>