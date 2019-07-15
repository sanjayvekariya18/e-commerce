<!doctype html>
<html class="fixed">
    <head>

        <!-- Basic -->
        <title>flipkart</title>
        <meta name="keywords" content="flipkart" />
        <meta name="description" content="flipkart">
        <meta name="author" content="flipkart">

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <!-- Web Fonts  -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/font-awesome/css/font-awesome.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/magnific-popup/magnific-popup.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

        <!-- Alert CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/alertify.core.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/alertify.default.css">

        <!-- Theme CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/stylesheets/theme.css" />

        <!-- Skin CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/stylesheets/skins/default.css" />

        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/stylesheets/theme-custom.css">

        <!-- Head Libs -->
        <script src="<?= base_url() ?>assets/vendor/modernizr/modernizr.js"></script>

    </head>
    <body>
        <!-- start: page -->
        <section class="body-sign">
            <div class="center-sign">
                <a href="/" class="logo pull-left">
                    <img src="<?= base_url() ?>assets/images/logo.png" height="54" alt="Porto Admin" />
                </a>

                <div class="panel panel-sign">
                    <div class="panel-title-sign mt-xl text-right">
                        <h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign Up</h2>
                    </div>
                    <div class="panel-body">
                        <form id="signup" method="post" action="<?= site_url() ?>seller/signup/addSignupData">
                            <div class="form-group mb-lg">
                                <label>First Name</label>
                                <input id="first_name" name="first_name" type="text" class="form-control input-lg" />
                            </div>
                            <div class="form-group mb-lg">
                                <label>Last Name</label>
                                <input id="last_name" name="last_name" type="text" class="form-control input-lg" />
                            </div>

                            <div class="form-group mb-lg">
                                <label>E-mail Address</label>
                                <input id="email" name="email" type="email" class="form-control input-lg" />
                            </div>

                            <div class="form-group mb-lg">
                                <label>Mobile No</label>
                                <input id="primary_mobile" name="primary_mobile" type="text" class="form-control input-lg" />
                            </div>

                            <div class="form-group mb-none">
                                <div class="row">
                                    <div class="col-sm-6 mb-lg">
                                        <label>Password</label>
                                        <input id="pwd" name="pwd" type="password" class="form-control input-lg" />
                                    </div>
                                    <div class="col-sm-6 mb-lg">
                                        <label>Password Confirmation</label>
                                        <input id="pwd_confirm" name="pwd_confirm" type="password" class="form-control input-lg" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="checkbox-custom checkbox-default">
                                        <input id="AgreeTerms" name="agreeterms" type="checkbox"/>
                                        <label for="AgreeTerms">I agree with <a href="#">terms of use</a></label>
                                    </div>
                                </div>
                                <div class="col-sm-4 text-right">
                                    <button id="register" type="button" class="btn btn-primary hidden-xs">Sign Up</button>
                                    <a id="otpverify" class="mb-xs mt-xs mr-xs btn btn-warning" data-toggle="modal" data-target="#modalOTP" style="display: none">Submit</a>
                                </div>
                            </div>

                            <span class="mt-lg mb-lg line-thru text-center text-uppercase">
                                <span>or</span>
                            </span>

                            <p class="text-center">Already have an account? <a href="<?= site_url() ?>seller/login">Sign In!</a>

                        </form>
                    </div>
                </div>

                <p class="text-center text-muted mt-md mb-md">&copy; Copyright 2014. All Rights Reserved.</p>
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

        <!-- Vendor -->
        <script src="<?= base_url() ?>assets/vendor/jquery/jquery.js"></script>
        <script src="<?= base_url() ?>assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
        <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.js"></script>
        <script src="<?= base_url() ?>assets/vendor/nanoscroller/nanoscroller.js"></script>
        <script src="<?= base_url() ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="<?= base_url() ?>assets/vendor/magnific-popup/magnific-popup.js"></script>
        <script src="<?= base_url() ?>assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

        <!-- Alert JS -->
        <script src="<?= base_url() ?>assets/javascripts/alertify.min.js"></script>

        <!-- Theme Base, Components and Settings -->
        <script src="<?= base_url() ?>assets/javascripts/theme.js"></script>

        <!-- Theme Custom -->
        <script src="<?= base_url() ?>assets/javascripts/theme.custom.js"></script>

        <!-- Theme Initialization Files -->
        <script src="<?= base_url() ?>assets/javascripts/theme.init.js"></script>

    </body>
</html>
<script type="text/javascript">
    $(document).ready(function() {
        $('#email').focusout(function() {
            $.ajax({
                url: '<?= site_url() ?>seller/signup/email_valid',
                type: 'POST',
                data: {'email': $(this).val()},
                success: function(data, textStatus, jqXHR) {
                    if (data != '0') {
                        $('#email').val("");
                        alertify.error("This email Id Is Already Register");
                    }
                }
            });
        });

        $('#register').click(function() {
            if ($('#first_name').val() == "") {
                alertify.error("Enter First Name");
            } else if ($('#last_name').val() == "") {
                alertify.error("Enter Last Name");
            } else if ($('#email').val() == "") {
                alertify.error("Enter Email Address");
            } else if ($('#primary_mobile').val() == "") {
                alertify.error("Enter Mobile Number");
            } else if ($('#pwd').val() == "") {
                alertify.error("Enter Password");
            } else if ($('#pwd_confirm').val() == "") {
                alertify.error("Enter Confirm Password");
            } else if ($('#pwd').val() != $('#pwd_confirm').val()) {
                alertify.error("Password Mismatch");
            } else if (!$('#AgreeTerms').is(':checked')) {
                alertify.error("Check Terms & Condition");
            } else {
                $mobile = $('#primary_mobile').val();
                $otp = Math.floor(Math.random() * 90000) + 10000;
                $.ajax({
                    url: "<?= site_url() ?>seller/profile/sendOTP",
                    type: 'POST',
                    data: {'mobile': $mobile, 'otp': $otp},
                    success: function(data, textStatus, jqXHR) {
                    }
                });
                $('#otpverify').trigger('click');
            }
        });

        $('#confirm').click(function() {
            $myotp = $('#myotp').val();
            if ($otp != $myotp) {
                alertify.error("Your Otp Is Wrong");
            } else {
                $('#signup').submit();
            }
            ;
        });
    });
</script>