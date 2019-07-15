<?php
$product = $this->wcommon->getCartProduct();
$session = $this->session->userdata('product');
if (isset($session) && is_array($session)) {
    $total_product = count($session);
} else {
    $total_product = "";
}
$checkout_flag = array();
?>
<!-- page wapper-->
<div class="columns-container cartblock">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="#" title="Return to Home">Home</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">Your shopping cart</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- page heading-->
        <h2 class="page-heading no-line">
            <span class="page-heading-title2">Shopping Cart Summary</span>
        </h2>
        <!-- ../page heading-->
        <?php
        if ($total_product != "" && $total_product != 0) {
            ?>        
            <div class="page-content page-order">
                <ul class="step">
                    <li id="summery" class="current-step"><span>01. Summary</span></li>
                    <li id="signin"><span>02. Sign in</span></li>
                    <li id="billing"><span>03. Address</span></li>
                    <li id="payment"><span>04. Payment</span></li>
                </ul>
                <form id="cartform" name="cartform" >
                    <div class="summery">                
                        <table class="table table-bordered table-responsive cart_summary">
                            <thead>
                                <tr>
                                    <th class="cart_product">Product</th>
                                    <th>Description</th>
                                    <th>Avail.</th>
                                    <th>Unit price</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th  class="action"><i class="fa fa-trash-o"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($product) && is_array($product)) {
                                    $total = 0;
                                    foreach ($product as $val) {
                                        if (!($session[$val->product_id]['qty'] <= $val->qty )) {
                                            $checkout_flag[] = 1;
                                        }
                                        $total += $val->selling_price * $session[$val->product_id]['qty'];
                                        ?>                        
                                        <tr>
                                            <td class="cart_product">
                                                <a href="#"><img src="<?= $val->image_thumb ?>" alt="Product"></a>
                                            </td>
                                            <td class="cart_description">
                                                <p class="product-name"><?= $val->product_name ?></p>
                                                <small class="cart_ref">SKU : <?= $val->sku ?></small><br>
                                                <?php if ($session[$val->product_id]['colour_id'] != "") { ?>
                                                    <small>Color : <?= $this->wcommon->getVariationName($session[$val->product_id]['colour_id']) ?></small><br>   
                                                <?php } ?>
                                                <?php if ($session[$val->product_id]['size'] != "") { ?>
                                                    <small>Size : <?= $this->wcommon->getVariationName($session[$val->product_id]['size']) ?></small>
                                                <?php } ?>
                                            </td>
                                            <td class="cart_avail"><span class="label label-success"><?= ($val->qty >= $session[$val->product_id]['qty']) ? 'In Stock' : 'Out Of Stock' ?></span></td>
                                            <td class="price"><span><i class="fa fa-rupee"></i> <?= $val->selling_price ?></span></td>
                                            <td class="qty">
                                                <select id="<?= $val->product_id ?>" name="qty" class="product_qty" style="border: 1px solid #CCC;width: 50px;padding: 3px;">
                                                    <?php
                                                    for ($i = 1; $i <= 3; $i++) {
                                                        ?>
                                                        <option value="<?= $i ?>"
                                                        <?php
                                                        if ($session[$val->product_id]['qty'] == $i) {
                                                            echo 'selected';
                                                        }
                                                        ?>><?= $i ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                </select>
                                            </td>
                                            <td class="price">
                                                <span><i class="fa fa-rupee"></i> <?= $val->selling_price * $session[$val->product_id]['qty'] ?></span>
                                            </td>
                                            <td class="action">
                                                <a id="<?= $val->product_id ?>" href="javascript:void(0)" class="remove_link">Remove</a>
                                            </td>
                                        </tr> 
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" rowspan="4"></td>
                                    <td colspan="3">Total products (tax incl.)</td>
                                    <td colspan="2"><i class="fa fa-rupee"></i> <?= isset($total) ? $total : '' ?></td>
                                </tr>
                                <tr>                                    
                                    <td colspan="3"><strong>Total Amount</strong></td>
                                    <td colspan="2"><i class="fa fa-rupee"></i> <strong><?= isset($total) ? $total : '' ?></strong></td>
                                </tr>                        
                            </tfoot>    
                        </table>                
                    </div>
                    <div class="signin" style="display:none">
                        <div class="page-content checkout-page">
                            <input id="signwith" type="hidden" name="signwith" value="0"/>
                            <div class="box-border">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h4>Register with us for future convenience:</h4>                              
                                        <ul>
                                            <li><label><input type="radio" name="register" checked>Register</label></li>
                                        </ul>
                                        <br>
                                        <h4>Register and save time!</h4>
                                        <p>Register with us for future convenience:</p>
                                        <p><i class="fa fa-check-circle text-primary"></i> Fast and easy check out</p>
                                        <p><i class="fa fa-check-circle text-primary"></i> Easy access to your order history and status</p>                                
                                    </div>
                                    <div class="col-sm-6">
                                        <h4>Login</h4>
                                        <p>Already registered? Please log in below:</p>
                                        <label>Email address</label>
                                        <input id="login_email" type="email" class="form-control input">
                                        <label>Password</label>
                                        <input id="login_password" type="password" class="form-control input">
                                        <p><a href="#">Forgot your password?</a></p>
                                        <button type="button" id="btnlogin" class="button">Login</button>                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="billing" style="display:none;line-height: 30px;">
                        <div class="page-content checkout-page">
                            <h3 class="checkout-sep">Billing Infomations</h3>
                            <div class="box-border">
                                <ul>
                                    <li class="row">
                                        <div class="col-sm-6">
                                            <label for="first_name" class="required">First Name</label>
                                            <input id="first_name" type="text" name="first_name" class="input form-control">
                                        </div><!--/ [col] -->
                                        <div class="col-sm-6">
                                            <label for="last_name" class="required">Last Name</label>
                                            <input id="last_name" type="text" name="last_name" class="input form-control" >
                                        </div><!--/ [col] -->
                                    </li><!--/ .row -->
                                    <li class="row">
                                        <div class="col-sm-6">
                                            <label for="primary_mobile" class="required">Mobile</label>
                                            <input id="primary_mobile" class="input form-control" type="text" name="primary_mobile" >
                                        </div>  
                                        <div class="col-sm-6">
                                            <label for="primary_email" class="required">Email Address</label>
                                            <input id="primary_email" type="email" class="input form-control" name="primary_email" >
                                        </div>
                                    </li>
                                    <li class="row"> 
                                        <div class="col-xs-6">
                                            <label for="address" class="required">Address Line 1</label>
                                            <textarea id="address" class="input form-control" name="address" rows="4"></textarea>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="city" class="required">City</label>
                                                    <input id="city" class="input form-control" type="text" name="city" >
                                                </div><!--/ [col] -->
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
                                            <label for="landmark" class="required">Address Line 2</label>
                                            <input id="landmark" class="input form-control" type="text" name="landmark" >
                                        </div> 
                                        <div class="col-sm-6">
                                            <label for="postal_code" class="required">Zip/Postal Code</label>
                                            <input id="pincode" class="input form-control" type="text" name="pincode" >
                                        </div>                                                      
                                    </li>

                                    <li class="row password_block">
                                        <div class="col-sm-6">
                                            <label for="password" name="" class="required">Password</label>
                                            <input id="password" class="input form-control" type="password" name="password" >
                                        </div><!--/ [col] -->

                                        <div class="col-sm-6">
                                            <label for="cpassword" class="required">Confirm Password</label>
                                            <input id="cpassword" class="input form-control" type="password" name="confirm" >
                                        </div><!--/ [col] -->
                                    </li><!--/ .row -->
                                    <li>
                                    </li>
                                </ul>
                            </div>            
                        </div>
                    </div>            
                    <div class="payment" style="display:none">
                        <div class="page-content checkout-page">                   
                            <h3 class="checkout-sep">Payment Information</h3>
                            <div class="box-border">
                                <ul>
                                    <li>
                                        <label for="cod"><input type="radio" name="pay_method" id="cod" value="cod" > Cash On Delivery</label>
                                    </li>

                                    <li>
                                        <label for="card"><input type="radio" name="pay_method" id="card" value="card" checked> Credit Card/ Debit Card / Net Banking</label>
                                    </li>
                                </ul>                       
                            </div>
                            <div class="box-border">
                                <div class="row">
                                    <div class="col-sm-3"><h3 style="text-transform: uppercase;">Total Amount :-</h3></div>
                                    <div class="col-sm-2"><h3 id="total_amount"></h3></div>
                                </div>                                
                                <div class="cod_block" style="display:none">
                                    <div class="row" style="margin-top:10px">
                                        <div class="col-sm-3"><h4 style="text-transform: uppercase;">COD Charge :-</h4></div>
                                        <div class="col-sm-2"><h4 id="total_cod_charge"></h4></div>
                                    </div>                                    
                                </div>
                                <div class="discount_block" style="display:none">
                                    <div class="row" style="margin-top:10px">
                                        <div class="col-sm-3"><h4 style="text-transform: uppercase;">Discount Amount :-</h4></div>
                                        <div class="col-sm-2"><h4 id="discount_amount"></h4></div>
                                    </div>                                    
                                </div>                                  
                                <div class="row" style="margin-top:10px">
                                    <div class="col-sm-3"><h4 style="text-transform: uppercase;">Payable Amount :-</h4></div>
                                    <div class="col-sm-2"><h4 id="pay_amount"></h4></div>
                                </div>
                            </div>
                            <div class="box-border">
                                <div class="row">
                                    <div class="col-sm-2" style="width: 10%;padding-right: 0px;margin-top: 5px"> Coupon Code</div>
                                    <div class="col-sm-2"> <input class="input form-control" type="text" name="coupon_code" id="coupon_code"></div>
                                    <div class="col-sm-2" style="margin-top: -20px;"> <button type="button" id="apply_code" class="button">Apply Code</button></div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </form>
                <div class="cart_navigation">
                    <!-- <a class="prev-btn" href="javascript:void(0);">Previous</a>-->
                    <?php
                    if ($checkout_flag == null) {
                        ?>
                        <a class="next-btn" href="javascript:void(0);">Proceed to checkout</a>
                        <?php
                    } else {
                        ?>
                        <h4 style="color:#ff3366">Please Remove Out Of Stock Item From Cart</h4>
                        <?php
                    }
                    ?>
                </div>
            </div>
        <?php } else { ?>
            <div class="row">          
                <div class="col-md-12" style="height:350px;padding-top: 150px;">
                    <center>
                        <h2>No Products Available In Your Cart</h2>
                        <a class="btn btn-default" href="<?= site_url() ?>" style="font-weight: bold;color: #fff;height: 30px;border-radius: 2;background: #ff3366;border: none;margin-top: 10px;">Continue Shopping</a>
                    </center>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<div class="blankblock" style="height:500px;display: none">    
</div>
<div id="cartloader" class="screenhide" style="display:none">    
    <center>
        <img src="<?= base_url() ?>assets/images/loading_pink.gif" style="margin-top: 150px;width: 100px;height: 100px"/>
        <h3 class="page-heading-title2" style="color:#FF3366;font-size: 28px;margin-top: 50px;font-weight: 600;font-family: -webkit-body;">Please Do not press "Reload", "Refresh", "Back" buttons until finish Order Request.</h3>
    </center>
</div>
<div id="emailcheckloader" class="screenhide" style="display:none">    
    <center>
        <img src="<?= base_url() ?>assets/images/loading_pink.gif" style="width: 100px;height: 100px"/>
        <h3 class="page-heading-title2" style="color:#FF3366;font-size: 28px;margin-top: 50px;font-weight: 600;font-family: -webkit-body;">Please Wait ...!! We Check Your Email Is Valid</h3>
    </center>
</div>
<div id="pincodecheckloader" class="screenhide" style="display:none">    
    <center>
        <img src="<?= base_url() ?>assets/images/loading_pink.gif" style="width: 100px;height: 100px"/>
        <h3 class="page-heading-title2" style="color:#FF3366;font-size: 28px;margin-top: 50px;font-weight: 600;font-family: -webkit-body;">Please Wait ...!! We Check Your Pincode Is Valid</h3>
    </center>
</div>
<?php
if ($this->session->userdata('customer_primary_email') != "") {
    $login_status = 1;
    $primary_email = $this->session->userdata('customer_primary_email');
} else {
    $login_status = 0;
    $primary_email = "";
}
?>
<!-- ./page wapper-->
<script type="text/javascript">
    $(document).ready(function () {
        $login_status = "<?= $login_status ?>";
        $primary_email = "<?= $primary_email ?>";
        $balance = 0;
        $bonus_limit_date = "";
        $today_date = Math.floor(new Date().getTime() / 1000);
        $total_amount = 0;
        $total_shipping_charge = 0;
        $total_cod_charge = 0;
        $total_discount = 0;
        $pay_amount = 0;
        $register_flag = 1;


        $('.product_qty').change(function () {
            $product_id = $(this).attr('id');
            $product_qty = $(this).val();
            $.ajax({
                url: "<?= site_url() ?>session/updateProduct",
                type: 'POST',
                data: {'product_id': $product_id, 'qty': $product_qty},
                success: function (data, textStatus, jqXHR) {
                    location.reload(true);
                }
            });
        });

        $('.remove_link').click(function () {
            $product_id = $(this).attr('id');
            $.ajax({
                url: "<?= site_url() ?>session/removeProduct",
                type: 'POST',
                data: {'product_id': $product_id},
                success: function (data, textStatus, jqXHR) {
                    location.reload(true);
                }
            });
        });

        $('.next-btn').click(function () {
            $('html body').animate({
                scrollTop: 100
            }, 800);

            if ($register_flag) {
                $prev_step = $('.current-step').attr('id');
                $('.' + $prev_step).css('display', 'none');
                $('.step > li').removeClass('current-step');

                $('#' + $prev_step).next().addClass('current-step');
                $current_step = $('.current-step').attr('id');
                $('.' + $current_step).css('display', 'block');

                if ($current_step == "signin" && $login_status == '1') {
                    $('.next-btn').trigger('click');
                } else if ($current_step == "billing" && $login_status == '1') {
                    $.ajax({
                        url: '<?= site_url() ?>cart/getCustomer',
                        type: 'POST',
                        data: {'primary_email': $primary_email},
                        success: function (data, textStatus, jqXHR) {
                            $customer = $.parseJSON(data);
                            $balance = $customer['balance'];
                            $bonus_limit_date = $customer['bonus_limit_date'];
                            $('#first_name').val($customer['first_name']);
                            $('#last_name').val($customer['last_name']);
                            $('#primary_mobile').val($customer['primary_mobile']);
                            $('#primary_email').val($customer['primary_email']);
                            $('#address').text($customer['address']);
                            $('#city').val($customer['city']);
                            $('#state').val($customer['state']);
                            $('#landmark').val($customer['landmark']);
                            $('#pincode').val($customer['pincode']);
                            $('.password_block').css('display', 'none');
                            $('#primary_email').prop('disabled', true);
                        }
                    });
                } else if ($current_step == "payment") {
                    $.ajax({
                        url: '<?= site_url() ?>cart/getCartTotalAmount',
                        success: function (data, textStatus, jqXHR) {

                            $amount = data.split("|");
                            $total_amount = parseFloat($amount[0]);
                            $total_cod_charge = parseFloat($amount[2]);
                            $special_discount = parseFloat($amount[3]);
                            $pay_amount = $total_amount;
                            if ($bonus_limit_date != "") {
                                if ($bonus_limit_date > $today_date) {
                                    $pay_amount = $pay_amount - $balance;
                                }
                            }
                            $('#total_amount').text($total_amount);
                            $('#total_cod_charge').text($total_cod_charge);
                            //$('#special_discount').text($special_discount);
                            $('#cod').trigger('click');
                        }
                    });

                    $('.next-btn').addClass('finish');
                } else if ($('.next-btn').hasClass('finish')) {
                    $('.next-btn').attr('disabled');
                    $('#cartloader').css('display', 'block');
                    $('.cartblock').css('display', 'none');
                    $('.blankblock').css('display', 'block');
                    $.ajax({
                        url: '<?= site_url() ?>cart/addOrder',
                        type: 'POST',
                        data: $('#cartform').serialize() + "&login_status=" + $login_status + "&login_email=" + $primary_email,
                        success: function (data, textStatus, jqXHR) {
                            $cart_id = data;
                            $method = $('input[name="pay_method"]:checked').val();
                            if ($cart_id != "" && $method == "cod") {
                                window.location.replace("<?= site_url() ?>cart/finish?id=" + $cart_id);
                            } else {
                                window.location.replace("<?= site_url() ?>cart/payment?id=" + $cart_id);
                            }
                        }
                    });
                }
            }
            if ($current_step == "billing") {
                $register_flag = 0;
                if ($.trim($('#first_name').val()) == "") {
                    alertify.error("Enter First Name");
                } else if ($.trim($('#last_name').val()) == "") {
                    alertify.error("Enter Last Name");
                } else if ($.trim($('#primary_mobile').val()) == "") {
                    alertify.error("Enter Mobile Number");
                } else if ($.trim($('#primary_email').val()) == "") {
                    alertify.error("Enter Email Id");
                } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($.trim($('#primary_email').val()))) {
                    alertify.error("Enter Valid Email Id");
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
                } else if ($('#password').val() == "" && $login_status == '0') {
                    alertify.error("Enter Password");
                } else if ($('#cpassword').val() == "" && $login_status == '0') {
                    alertify.error("Enter Confirm Password");
                } else if ($('#password').val() != $('#cpassword').val() && $login_status == '0') {
                    alertify.error("Password Mismatch");
                } else {
                    $register_flag = 1;
                    $('.next-btn').trigger('click');
                }
            }
        });

        $('#primary_email').focusout(function () {
            $scroll = $(window).scrollTop() + 50;
            $('#emailcheckloader').css('display', 'block');
            $('#emailcheckloader').children().children('img').css('margin-top', $scroll);

            if ($login_status == 0) {
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
            }
        });

        $('#pincode').focusout(function () {
            $scroll = $(window).scrollTop() + 50;
            $('#pincodecheckloader').css('display', 'block');
            $('#pincodecheckloader').children().children('img').css('margin-top', $scroll);
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

        $('#btnlogin').click(function () {
            $email = $('#login_email').val();
            $password = $('#login_password').val();

            $.ajax({
                url: '<?= site_url() ?>buyer/login/checkoutLogin',
                type: 'POST',
                data: {'email': $email, 'password': $password},
                success: function (data, textStatus, jqXHR) {
                    $data = data.split('|');
                    if ($data[0] == '1') {
                        $login_status = '1';
                        $primary_email = $data[1];
                        $('.next-btn').trigger('click');
                    } else {
                        alertify.error("Username Or Password Is Wrong");
                    }
                }
            });
        });

        $('#cod').click(function () {
            $('.cod_block').css('display', 'block');
            $pay_amount = +$total_amount + +$total_cod_charge - $total_discount - $special_discount;
            if ($bonus_limit_date != "") {
                if ($bonus_limit_date > $today_date) {
                    $pay_amount = $pay_amount - $balance;
                }
            }
            $('#pay_amount').text($pay_amount + ".00");
        });

        $('#card').click(function () {
            $('.cod_block').css('display', 'none');
            $pay_amount = +$total_amount - $total_discount - $special_discount;
            if ($bonus_limit_date != "") {
                if ($bonus_limit_date > $today_date) {
                    $pay_amount = $pay_amount - $balance;
                }
            }
            $('#pay_amount').text($pay_amount + ".00");
        });

        $('#apply_code').click(function () {
            $coupon_code = $('#coupon_code').val();
            if ($coupon_code == "") {
                alertify.error("Please Enter Coupon Code");
            } else {
                $.ajax({
                    url: '<?= site_url() ?>cart/applyCoupon',
                    type: 'post',
                    data: {'coupon_code': $coupon_code},
                    success: function (data, textStatus, jqXHR) {
                        $discount = data.split('|');
                        if ($discount[0] == '1') {
                            $total_discount = $discount[1];
                            if ($('input[name="pay_method"]:checked').val() == "cod") {
                                $pay_amount = +$total_amount + +$total_cod_charge - $total_discount - $special_discount;
                            } else {
                                $pay_amount = +$total_amount - $total_discount - $special_discount;
                            }
                            if ($bonus_limit_date != "") {
                                if ($bonus_limit_date > $today_date) {
                                    $pay_amount = $pay_amount - $balance;
                                }
                            }
                            $('#discount_amount').text($total_discount + ".00");
                            $('#pay_amount').text($pay_amount + ".00");
                            $('.discount_block').css('display', 'block');
                            alertify.success("Coupon Code Is Apply");
                        } else {
                            $total_discount = 0;
                            if ($('input[name="pay_method"]:checked').val() == "cod") {
                                $pay_amount = +$total_amount + +$total_cod_charge - $total_discount - $special_discount;
                            } else {
                                $pay_amount = +$total_amount - $total_discount - $special_discount;
                            }
                            if ($bonus_limit_date != "") {
                                if ($bonus_limit_date > $today_date) {
                                    $pay_amount = $pay_amount - $balance;
                                }
                            }
                            $('#discount_amount').text($total_discount + ".00");
                            $('#pay_amount').text($pay_amount + ".00");
                            $('.discount_block').css('display', 'none');
                            alertify.error("Coupon Code Is Wrong");
                        }
                    }
                });
            }
        });
    });
</script>