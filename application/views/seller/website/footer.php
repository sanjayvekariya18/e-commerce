<div class="pixfort_text_4 dark soft_dark_gray_bg pix_builder_bg" id="section_footer_3_dark">
    <div class="footer3">
        <div class="container ">
            <div class="five columns alpha pix_text">
                <div class="content_div area_1">
                    <p class="small_text editContent">Our mission is to bring the world's best ethnic designs to your doorstep.</p>
                    <p class="small_text editContent">Our products make our customers look incredible. Shopking24 is extremely focused on ethnic wear and wants to dominate this space in the coming few years.</p>
                    <ul class="bottom-icons">
                        <li><a class="pi pixicon-facebook2" href="https://www.facebook.com/Shopking24com-511366578998110/timeline/"></a></li>
                        <li><a class="pi pixicon-twitter2" href="https://twitter.com/shopking24"></a></li>
                        <li><a class="pi pixicon-pinterest2" href="https://in.pinterest.com/shopking24com/"></a></li>
                        <li><a class="pi pixicon-googleplus2" href="#"></a></li>
                    </ul>
                </div>
            </div>
            <div class="three columns">
                <div class="content_div area_2">
                    <span class="pix_text"><span class="editContent footer3_title">Information</span></span>
                    <ul class="footer3_menu">
                        <li><a href="<?= site_url() ?>seller/seller-benefits" class="pix_text"><span class="editContent">Benefits and Rule</span></a></li>        
                        <li><a href="<?= site_url() ?>seller/seller-policy-and-rule" class="pix_text"><span class="editContent">Policy and Rule</span></a></li>
                        <li><a href="<?= site_url() ?>seller/seller-agreement" class="pix_text"><span class="editContent">User Agreement</span></a></li>
                        <li><a href="<?= site_url() ?>seller/seller-privacy-policy" class="pix_text"><span class="editContent">Privacy policy</span></a></li>
                        <li><a href="<?= site_url() ?>seller/seller-contact" class="pix_text"><span class="editContent">Contact Us</span></a></li>
                        <li><a href="<?= site_url() ?>seller/seller-faq" class="pix_text"><span class="editContent">FAQ</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="four columns">
                <div class="content_div area_3">
                    <span class="pix_text"><span class="editContent big_number">0261-6452111</span></span>                    
                    <p class="editContent small_bold">104-Shyamdham Society, Near Shyamdham Mandir, Sarthana Jakatnaka, Surat-395006</p>
                    <p class="editContent small_bold" style="margin: 0px;">Gujarat, India.</p>
                    <p class="editContent small_bold">Email : info@shopking24.com</p>
                </div>
            </div>
            <div class="four columns omega">
                <div class="content_div">
                    <span class="pix_text"><span class="editContent footer3_title">Vision</span></span>
                    <p class="editContent ">Shopking24's vision is to create India's most impactful digital commerce ecosystem that creates life-changing experiences for buyers and sellers</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="popup_6" class="well pix_popup pop_hidden blue_bg dark" style="display: none;">
    <div class="center_text ">
        <span class="editContent">
            <h4 class="margin_bottom pix_text" style="color: rgb(255, 255, 255); font-size: 21px; font-family: 'Open Sans', sans-serif; background-color: rgba(0, 0, 0, 0);"><strong>Login Form</strong></h4></span>

        <form action="<?= site_url() ?>seller/login/checkLogin" method="POST">
            <div id="result"></div>
            <input type="email" name="email" placeholder="Your Login Email Id" class="pix_text"> 
            <input type="password" name="password"  placeholder="Enter Your password" class="pix_text">
            <span class="send_btn">
                <button type="submit" class="submit_btn pix_text orange_bg">
                    <span class="">Sign In</span>
                </button>
            </span>
            <a id="otpverify" href="#popup_4" style="text-decoration: none;"><span class="editContent">Forgot Password</span></a>
        </form>
    </div>
</div>
<div id="popup_5" class="well pix_popup pop_hidden"> 
    <div class="center_text">
        <div class="big_icon orange">
            <span class="pi pixicon-mobile"></span>
        </div>
        <h4 class="bold_text margin_bottom">Verification Form</h4>
        <p>Enter Your Mobile Verification Code</p>
        <form id="contact_form" class="pix_form ">                            
            <input type="text" name="myotp" id="myotp" placeholder="Verification Code" class="pix_text">
            <span class="send_btn">
                <button type="button" class="submit_btn green_1_bg pix_text" id="confirm">
                    <span class="editContent">submit</span>
                </button>
            </span>
        </form>
    </div>
</div>
<div id="popup_4" class="well pix_popup pop_hidden"> 
    <div class="center_text">
        <div class="big_icon orange">
            <span class="pi pixicon-mobile"></span>
        </div>
        <h4 class="bold_text margin_bottom">Forgot Password</h4>
        <p>Enter Your Register Email Id</p>
        <form id="contact_form" class="pix_form ">                            
            <input type="email" name="myemail" id="myemail" placeholder="Email Id" class="pix_text">
            <span class="send_btn">
                <button type="button" class="submit_btn green_1_bg pix_text" id="forgot_confirm">
                    <span class="editContent">submit</span>
                </button>
            </span>
        </form>
    </div>
</div>
<div class="screenhide" style="display:none">
    <center>
        <img src="<?= base_url() ?>assets/images/loading_yellow.gif" style="margin-top: 50px;width: 250px;height: 250px"/>
        <h3 class="page-heading-title2" style="color:#FFD400;font-size: 28px;margin-top: 110px">Please Wait ..!!! We Are Sending New Password By Email and Sms.</h3>
    </center>
</div>
<script src="<?= base_url() ?>sellerassets/js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>sellerassets/js/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="<?= base_url() ?>sellerassets/js/jquery.common.min.js" type='text/javascript'></script>
<script src="<?= base_url() ?>sellerassets/js/jquery.ui.touch-punch.min.js"></script>
<script src="<?= base_url() ?>sellerassets/js/ticker.js" type="text/javascript"></script>
<script src="<?= base_url() ?>sellerassets/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>sellerassets/js/bootstrap-switch.js"></script>
<script src="<?= base_url() ?>sellerassets/js/appear.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>sellerassets/js/custom1.js" type="text/javascript"></script>
<script src="<?= base_url() ?>sellerassets/js/custom3.js" type="text/javascript"></script>
<script src="<?= base_url() ?>sellerassets/js/smoothscroll.min.js" type="text/javascript"></script>
<!-- Alert JS -->
<script src="<?= base_url() ?>assets/javascripts/alertify.min.js"></script>
<?php $msg = $this->input->get('msg'); ?>
<?php
switch ($msg) {
    case "R":
        $m = "Username Or Password Is Wrong..!";
        $t = "error";
        break;
    case "E":
        $m = "Email Is Not Verify..!";
        $t = "error";
        break;
    case "V":
        $m = "Registration Successfully Please Verify Your Email..!";
        $t = "success";
        break;
    case "EX":
        $m = "Email Already Exist..!";
        $t = "error";
        break;
    case "MX":
        $m = "Mobile Number Already Exist..!";
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

        $flag = 1;
        $('#email').focusout(function() {
            $.ajax({
                url: '<?= site_url() ?>seller/signup/email_valid',
                type: 'POST',
                data: {'email': $(this).val()},
                success: function(data, textStatus, jqXHR) {
                    if (data != '0') {
                        $('#email').val("");
                        $flag = 0;
                        alertify.error("This email Id Is Already Register");
                    }
                }
            });
        });

        $('#primary_mobile').focusout(function() {
            $.ajax({
                url: '<?= site_url() ?>seller/signup/mobile_valid',
                type: 'POST',
                data: {'primary_mobile': $(this).val()},
                success: function(data, textStatus, jqXHR) {
                    if (data != '0') {
                        $('#primary_mobile').val("");
                        $flag = 0;
                        alertify.error("This Mobile Number Already Register");
                    }
                }
            });
        });

        $('#register').mouseenter(function() {
            if ($('#email').val() != "") {
                $('#email').trigger('focusout');
            }
            if ($('#primary_mobile').val() != "") {
                $('#primary_mobile').trigger('focusout');
            }
        });

        $('#register').click(function() {
            if ($('#first_name').val() == "") {
                alertify.error("Enter First Name");
                $flag = 0;
            } else if ($('#last_name').val() == "") {
                alertify.error("Enter Last Name");
                $flag = 0;
            } else if ($('#email').val() == "") {
                alertify.error("Enter Email Address");
                $flag = 0;
            } else if ($('#primary_mobile').val() == "") {
                alertify.error("Enter Mobile Number");
                $flag = 0;
            } else if ($('#pwd').val() == "") {
                alertify.error("Enter Password");
                $flag = 0;
            } else if ($('#pwd_confirm').val() == "") {
                alertify.error("Enter Confirm Password");
                $flag = 0;
            } else if ($('#pwd').val() != $('#pwd_confirm').val()) {
                alertify.error("Password Mismatch");
                $flag = 0;
            } else if (!$('#AgreeTerms').is(':checked')) {
                alertify.error("Check Terms & Condition");
                $flag = 0;
            } else {
                $flag = 1;
                $('#otpverify').trigger('click');
                if ($flag) {
                    $mobile = $('#primary_mobile').val();
                    $otp = Math.floor(Math.random() * 90000) + 10000;
                    $.ajax({
                        url: "<?= site_url() ?>seller/signup/sendOTP",
                        type: 'POST',
                        data: {'mobile': $mobile, 'otp': $otp},
                        success: function(data, textStatus, jqXHR) {
                            
                        }
                    });                    
                }
            }
        });

        $('#confirm').click(function() {
            $myotp = $('#myotp').val();
            if ($otp != $myotp) {
                alertify.error("Your Otp Is Wrong");
            } else {
                $(this).attr('disabled',true);
                $('#contact_form').submit();
            }
            ;
        });

        $('#forgot_confirm').click(function() {
            $('.screenhide').css('display', 'block');
            $email_id = $('#myemail').val();
            $.ajax({
                url: '<?= site_url() ?>reset/seller',
                type: 'post',
                data: {'email_id': $email_id},
                success: function(data, textStatus, jqXHR) {
                    if (data == 1) {
                        alertify.error("New Password Send To Register Email.");
                        $('.screenhide').css('display', 'none');
                    } else {
                        alertify.error("Email Id Not Register");
                        $('.screenhide').css('display', 'none');
                    }
                    setTimeout(function() {
                        location.reload(true);
                    }, 500);
                }
            });
        });
    });
</script>    
</body>
</html>