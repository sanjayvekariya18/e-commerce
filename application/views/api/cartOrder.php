<?php
if (isset($products) && is_array($products)) {
    $count = 0;
    $total = 0;
    $codcharge = $this->common->codCharge()->cod_charge;    
    ?>

<?php } ?>
<div class="c-content-bar-1 c-align-left c-bordered c-theme-border c-shadow">
    <h1 class="c-font-bold c-font-uppercase c-font-18">Your Order</h1>
    <ul class="c-order list-unstyled">       
        <li class="row c-border-bottom"></li>
        <?php
        foreach ($products as $product) {
            $count += 1;
            $total += $product->selling_price * $product->qty;
            ?>
            <li class="row c-margin-b-15 c-margin-t-15">
                <div class="col-md-6 c-font-14">
                    <?= $product->product_name ?> ( <?= $product->qty ?> )
                </div>
                <div class="col-md-6 c-font-14">
                    <p class=""><i class="fa fa-rupee"></i> <?= $product->selling_price ?></p>
                </div>
            </li>
        <?php } ?>
        <li class="row c-margin-b-5 c-margin-t-5">
            <div class="col-md-6 c-font-16" style="float:left;display: inline-block;">Total :- </div>
            <div class="col-md-6 c-font-16" style="float: right;display: inline-block;color: #32e5d2;">
                <p class=""><i class="fa fa-rupee"></i>
                    <span class="c-subtotal"><?= $total ?></span>
                </p>
            </div>
        </li>        
        <div class ="discountblock" style="display:none">
            <li class="row c-margin-b-5 c-margin-t-5">
                <div class="col-md-6 c-font-16" style="float:left;display: inline-block;">Discount :- </div>
                <div class="col-md-6 c-font-16" style="float: right;display: inline-block;color: #32e5d2;">
                    <p class=""><i class="fa fa-rupee"></i>
                        <span class="discountamt"></span>
                    </p>
                </div>
            </li>            
        </div>
        <div class ="codblock" style="display:none">
            <li class="row c-margin-b-5 c-margin-t-5">
                <div class="col-md-6 c-font-16" style="float:left;display: inline-block;">Cod Charge :- </div>
                <div class="col-md-6 c-font-16" style="float: right;display: inline-block;color: #32e5d2;">
                    <p class=""><i class="fa fa-rupee"></i>
                        <span class="codamt"><?php
                            $totalcod = $count * $codcharge;
                            echo $totalcod;
                            ?></span>
                    </p>
                </div>
            </li>            
        </div>
        <li class="row c-margin-b-5 c-margin-t-5">
            <div class="col-md-6 c-font-16" style="float:left;display: inline-block;">Pay Amount :- </div>
            <div class="col-md-6 c-font-16" style="float: right;display: inline-block;color: #32e5d2;">
                <p class=""><i class="fa fa-rupee"></i>
                    <span class="payamt"><?= $total ?></span>
                </p>
            </div>
        </li>
        <li class="row c-margin-b-5 c-margin-t-5">            
            <div class="col-md-12" style="float:left;width: 100%">
                <div class="form-group" style="margin-bottom: 5px;">
                    <label class="control-label">You Have A Coupon Code ?</label>
                    <input id="coupon" type="text" class="form-control c-square c-theme" placeholder="COUPON CODE" style="width:100%">
                </div>
                <div class="form-group">
                    <button id="couponbtn" type="button" class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold" style="width:100%;font-size: 14px;">Apply</button>
                </div>
            </div>
        </li>
        <li class="row">
            <div class="col-md-12">
                <div class="c-radio-list">
                    <div class="c-radio">
                        <input type="radio" id="codbtn" class="c-radio" name="pay_method" value="cod">
                        <label for="codbtn" class="c-font-16" style="line-height: 25px">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Cash On Delivery
                        </label>
                    </div>
                    <div class="c-radio">
                        <input type="radio" id="cardbtn" class="c-radio" name="pay_method" value="card" checked>
                        <label for="cardbtn" class="c-font-16" style="line-height: 25px">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> Credit Card/ Debit Card / Net Banking 
                        </label>
                    </div>
                </div>
            </div>
        </li>                                        
        <li class="row">
            <div class="form-group col-md-12" role="group" style="width:100%">                
                <button id="cancelorder" type="button" class="btn btn-default c-btn-square c-btn-uppercase c-btn-bold" style="width:48%;float: left">Cancel</button>
                <button id="submitorder" type="button" class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold" style="width:48%;float:right">Order Now</button>
                <a href="cart.html" class="btn c-btn btn-lg c-btn-red c-btn-square c-font-white c-font-bold c-font-uppercase" style="clear: both;margin-top: 10px;width: 100%;margin-left: 0px;">Back To Cart</a>
            </div>
        </li>
    </ul>
</div>
