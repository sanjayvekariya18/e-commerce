<!doctype html>
<html class="fixed">
    <head>

        <!-- Basic -->
        <meta charset="UTF-8">

        <title>SHOPKING24</title>
        <meta name="keywords" content="SHOPKING24" />
        <meta name="description" content="SHOPKING24">
        <meta name="author" content="SHOPKING24">

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <!-- Web Fonts  -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/font-awesome/css/font-awesome.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/magnific-popup/magnific-popup.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

        <!-- Theme CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/stylesheets/theme.css" />

        <!-- Skin CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/stylesheets/skins/default.css" />

        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/stylesheets/theme-custom.css">

        <!-- Alert CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/alertify.core.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/alertify.default.css">

        <!-- Head Libs -->
        <script src="<?= base_url() ?>assets/vendor/modernizr/modernizr.js"></script>

        <!-- Alert JS -->
        <script src="<?= base_url() ?>assets/javascripts/alertify.min.js"></script>
        <link rel="shortcut icon" type="image/ico" href="<?= base_url() ?>assets/images/favicon.ico"/>
        <style type="text/css">
            .screenhide{
                position: absolute;
                width: 100%;        
                z-index: 99999;
                opacity: 1;
                background-color: transparent;
                top: 120px;
            }
        </style>

    </head>
    <body>
        <!-- start: page -->
        <section class="body-sign">
            <div class="center-sign">
                <a href="<?= site_url() ?>" class="logo pull-left">
                    <img src="<?= base_url() ?>assets/images/logo.gif" height="54" alt="SHOPKING24" />
                </a>

                <div class="panel panel-sign">
                    <div class="panel-title-sign mt-xl text-right">
                        <h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
                    </div>
                    <div class="panel-body">
                        <form id="employeeloginform" action="<?= site_url() ?>employee/login/checkLogin" method="POST">
                            <div class="form-group mb-lg">
                                <label>Username</label>
                                <div class="input-group input-group-icon">
                                    <input id="useremail" name="email" type="text" class="form-control input-lg" />
                                    <span class="input-group-addon">
                                        <span class="icon icon-lg">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group mb-lg">  
                                <label>Password</label>
                                <div class="input-group input-group-icon">
                                    <input name="password" type="password" class="form-control input-lg" />
                                    <span class="input-group-addon">
                                        <span class="icon icon-lg">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                    </span>
                                </div> 
                                <div class="clearfix">                                    
                                    <a class="mb-xs mt-xs mr-xs btn pull-right hidden-xs" data-toggle="modal" data-target="#modalforget">Lost Password ??</a>
                                </div>
                            </div>                            
                            <div class="row">
                                <div class="col-sm-8">                                    
                                </div>
                                <div class="col-sm-4 text-right">
                                    <?php
                                    if ($otp->status == '1') {
                                        ?>
                                        <a id="otpinfo" class="mb-xs mt-xs mr-xs btn btn-primary hidden-xs" data-toggle="modal" data-target="#modalOTP">Sign In</a>
                                        <?php
                                    } else {
                                        ?>
                                        <button type="submit" class="btn btn-primary hidden-xs" >Sign In</button>
                                        <?php
                                    }
                                    ?>
                                    <!--<button id="signin" type="button" class="btn btn-primary hidden-xs">Sign In</button>-->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <p class="text-center text-muted mt-md mb-md">&copy; Copyright 2015. All Rights Reserved.</p>
            </div>
        </section>
        <div class="modal fade" id="modalOTP" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close otpclose" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    <div class="modal-body">
                        <p>Enter Your OTP Code</p>
                        <input id="myotp" type="text" name="myotp" class="form-control" />
                    </div>
                    <div class="modal-footer">
                        <button id="confirm" type="button" class="btn btn-primary">Confirm</button>
                        <button type="button" class="btn btn-default otpclose" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Forget Password Model Start-->
        <div class="modal fade" id="modalforget" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close otpclose" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    <div class="modal-body">
                        <p>Enter Register Email Id</p>
                        <input id="myemail" type="email" name="myemail" class="form-control" required/>
                    </div>
                    <div class="modal-footer">
                        <button id="confirmReset" type="button" class="btn btn-primary" data-dismiss="modal">Confirm</button>
                        <button type="button" class="btn btn-default otpclose" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="screenhide" style="display:none">
            <center>
                <img src="<?= base_url() ?>assets/images/loading_blue.gif" style="margin-top: 50px;width: 250px;height: 250px"/>
                <h3 class="page-heading-title2" style="color:#0088CC;font-size: 28px;margin-top: 120px;">Please Wait ..!!! We Are Sending New Password By Email and Sms.</h3>
            </center>
        </div>
        <!-- end: page -->

        <!-- Vendor -->
        <script src="<?= base_url() ?>assets/vendor/jquery/jquery.js"></script>
        <script src="<?= base_url() ?>assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
        <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.js"></script>
        <script src="<?= base_url() ?>assets/vendor/nanoscroller/nanoscroller.js"></script>
        <script src="<?= base_url() ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="<?= base_url() ?>assets/vendor/magnific-popup/magnific-popup.js"></script>
        <script src="<?= base_url() ?>assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

        <!-- Theme Base, Components and Settings -->
        <script src="<?= base_url() ?>assets/javascripts/theme.js"></script>

        <!-- Theme Custom -->
        <script src="<?= base_url() ?>assets/javascripts/theme.custom.js"></script>

        <!-- Theme Initialization Files -->
        <script src="<?= base_url() ?>assets/javascripts/theme.init.js"></script>

    </body>
</html>
<?php $msg = $this->input->get('msg'); ?>
<?php
switch ($msg) {
    case "R":
        $m = "Username Or Password Is Wrong..!";
        $t = "error";
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
        
        $('#otpinfo').click(function() {
            $username = $('#useremail').val();
            $otp = Math.floor(Math.random() * 90000) + 10000;
            
            $.ajax({
                url: "<?= site_url() ?>employee/login/sendOTP",
                type: 'POST',
                data: {'otp':$otp,'username':$username},
                success: function(data, textStatus, jqXHR) {

                }
            });
        });
        
        $('#confirm').click(function(){
            $myotp = $('#myotp').val();
            if($otp != $myotp){
                alertify.error("Your Otp Is Wrong");
            }else{
                $('#employeeloginform').submit();
            };
        });
        
        $('#confirmReset').click(function() {
            $('.screenhide').css('display', 'block');
            $email_id = $('#myemail').val();
            $.ajax({
                url: '<?=  site_url()?>reset/employee',
                type: 'post',
                data: {'email_id': $email_id},
                success: function(data, textStatus, jqXHR) {
                    if(data == 1){
                        alertify.error("New Password Send To Register Email.");
                        $('.screenhide').css('display', 'none');
                    }else{
                        alertify.error("Email Id Not Register");
                        $('.screenhide').css('display', 'none');
                    }
                }
            });
        });       

    });
</script>