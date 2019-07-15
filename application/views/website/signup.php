<style type="text/css">
    li.row{
        padding: 5px;
    }
    label{
        padding-bottom: 5px;
    }
</style>
<div class="columns-container">
    <div class="container" id="columns">        
        <!-- row -->
        <div class="row">          
            <div class="col-md-12">
                <h3 style="margin-bottom: 15px;text-align: center">NEW CUSTOMER REGISTRATION FROM</h3>
                <form id="registration" name="registration" method="post" action="<?= site_url() ?>signup/register">
                    <div class="box-border">
                        <ul>
                            <li class="row">
                                <div class="col-sm-6">
                                    <label for="first_name" >First Name</label>
                                    <input id="first_name" type="text" name="first_name" class="input form-control">
                                </div>
                                <div class="col-sm-6">
                                    <label for="last_name" >Last Name</label>
                                    <input id="last_name" type="text" name="last_name" class="input form-control">
                                </div>
                            </li>
                            <li class="row">
                                <div class="col-sm-6">
                                    <label for="primary_mobile" >Mobile</label>
                                    <input id="primary_mobile" class="input form-control" type="text" name="primary_mobile">
                                </div>  
                                <div class="col-sm-6">
                                    <label for="primary_email" >Email Address</label>
                                    <input id="primary_email" type="email" class="input form-control" name="primary_email" >
                                </div>
                            </li>
                            <li class="row"> 
                                <div class="col-xs-6">
                                    <label for="address" >Address Line 1</label>
                                    <textarea id="address" class="input form-control" name="address" rows="5"></textarea>
                                </div>
                                <div class="col-xs-6">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label for="city">City</label>
                                            <input id="city" class="input form-control" type="text" name="city" >
                                        </div>
                                        <?php $states = $this->common->getStates(); ?>
                                        <div class="col-sm-12" style="margin-top: 20px">
                                            <label>State</label>
                                            <select id="state" class="input form-control" name="state">
                                                <option value="-1">---Select---</option>
                                                <?php foreach ($states as $val) { ?>
                                                    <option value="<?= $val->id ?>"><?= $val->state_name ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </li>                           

                            <li class="row">
                                <div class="col-sm-6">
                                    <label for="landmark" >Address Line 2</label>
                                    <input id="landmark" class="input form-control" type="text" name="landmark" >
                                </div> 
                                <div class="col-sm-6">
                                    <label for="postal_code" >Zip/Postal Code</label>
                                    <input id="pincode" class="input form-control" type="text" name="pincode" >
                                </div>                                                      
                            </li>

                            <li class="row password_block">
                                <div class="col-sm-6">
                                    <label for="password" name="" >Password</label>
                                    <input id="password" class="input form-control" type="password" name="password" >
                                </div>

                                <div class="col-sm-6">
                                    <label for="cpassword" >Confirm Password</label>
                                    <input id="cpassword" class="input form-control" type="password" name="cpassword" >
                                </div>
                            </li>                            
                        </ul>
                        <center>                    
                            <button id="register" type="button" class="btn btn-default" style="font-weight: bold;color: #fff;height: 30px;border-radius: 2;background: #ff3366;border: none;margin-top: 10px;">Submit</button>
                        </center>
                    </div> 

                </form>
            </div>
        </div>
    </div>
</div>
<div id="emailcheckloader" class="screenhide" style="display:none">    
    <center>
        <img src="<?= base_url() ?>assets/images/loading_pink.gif" style="margin-top: 150px;width: 100px;height: 100px"/>
        <h3 class="page-heading-title2" style="color:#FF3366;font-size: 28px;margin-top: 50px;font-weight: 600;font-family: -webkit-body;">Please Wait ...!! We Check Your Email Is Valid</h3>
    </center>
</div>
<div id="pincodecheckloader" class="screenhide" style="display:none">    
    <center>
        <img src="<?= base_url() ?>assets/images/loading_pink.gif" style="margin-top: 150px;width: 100px;height: 100px"/>
        <h3 class="page-heading-title2" style="color:#FF3366;font-size: 28px;margin-top: 50px;font-weight: 600;font-family: -webkit-body;">Please Wait ...!! We Check Your Pincode Is Valid</h3>
    </center>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#primary_email').focusout(function () {
            $('#emailcheckloader').css('display', 'block');
            $.ajax({
                url: '<?= site_url() ?>cart/email_valid',
                type: 'POST',
                data: {'email': $(this).val()},
                success: function (data, textStatus, jqXHR) {
                    $('#emailcheckloader').css('display', 'none');
                    if (data != '0') {
                        $('#primary_email').val("");
                        alertify.error("This email Id Is Already Register");
                    }
                }
            });
        });

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

        $('#register').click(function () {            
            if ($.trim($('#first_name').val()) == "") {
                alertify.error("Enter First Name");
            } else if ($.trim($('#last_name').val()) == "") {
                alertify.error("Enter Last Name");
            } else if ($.trim($('#primary_mobile').val()) == "") {
                alertify.error("Enter Mobile Number");
            } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($.trim($('#primary_email').val()))) {
                alertify.error("Enter Valid Email Id");
            } else if ($.trim($('#primary_email').val()) == "") {
                alertify.error("Enter Email Id");
            } else if ($.trim($('#address').val()) == "") {
                alertify.error("Enter Address");
            } else if ($.trim($('#city').val()) == "") {
                alertify.error("Enter City Name");
            } else if ($('#state').val() == "-1") {
                alertify.error("Select State Name");
            } else if ($.trim($('#landmark').val()) == "") {
                alertify.error("Enter Landmark(Area)");
            } else if ($.trim($('#pincode').val()) == "") {
                alertify.error("Enter Pincode");
            } else if (($('#pincode').val()).length != 6) {
                alertify.error("Enter Valid Pincode");
            } else if ($('#password').val() == "") {
                alertify.error("Enter Password");
            } else if ($('#cpassword').val() == "") {
                alertify.error("Enter Confirm Password");
            } else if ($('#password').val() != $('#cpassword').val()) {
                alertify.error("Password Mismatch");
            } else {
                $('#registration').submit();
                $('#register').attr('disabled',true);
            }
        });
    });
</script>
