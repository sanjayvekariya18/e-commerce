<?php
if (isset($rorders) && is_array($rorders)) {
    $return_day = $this->common->returnDay()->return_day;
    ?>
    <div class="orders">
        <div id="recentorder" style="text-align: center;background-color: #ff3366;margin-bottom: 10px;">
            <h6 style="padding: 5px;color:#ffffff">Recent Order </h6>                                     
        </div>
        <div class="orderslist recentorder">
            <?php
            foreach ($rorders as $val) {
                $order_status = "";
                switch ($val->order_status) {
                    case '1':
                        $order_status = "Approve";
                        break;
                    case '2':
                        $order_status = "Ready To Ship";
                        break;
                    case '3':
                        $order_status = "Shipped";
                        break;
                    case '4':
                        $order_status = "Delivered";
                        break;
                    case '5':
                        $order_status = "Refund Request";
                        break;
                    case '6':
                        $order_status = "Cancel";
                        break;
                    case '7':
                        $order_status = "Replace";
                        break;
                    case '8':
                        $order_status = "Shipped Cancel";
                        break;
                    case '9':
                        $order_status = "Refund Paid";
                        break;
                }
                ?>

                <div class="row c-margin-b-10">
                    <div class="c-content-product-2 c-bg-white">
                        <div class="col-md-4" style="display: inline-block;float: left;">
                            <div class="c-content-overlay">
                                <div class="c-bg-img-center c-overlay-object" data-height="height" style="width:90px; height: 125px; background-size: 100%; background-image: url(<?= $val->image_thumb ?>);"></div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="c-info-list">
                                <h3 class="c-title c-font-bold c-font-14 c-font-dark c-margin-b-5">                            
                                    <?= $val->product_name ?>
                                </h3>
                                <p class="c-order-date c-font-12 c-font-thin c-theme-font c-font-bold">ORDER DATE - <?= date('dS M\' Y', strtotime($val->order_date)) ?></p>
                                <p class="c-font-12 c-font-thin c-theme-font c-font-bold">ORDER ID - <?= $val->order_id ?></p>
                                <p class="c-font-12 c-font-thin c-theme-font c-font-bold">STATUS - <?= $order_status ?></p>
                                <?php
                                if ($val->order_status == 1 || $val->order_status == 2 || $val->order_status == 3) {
                                    ?>  
                                    <button id="<?= $val->order_id ?>" type="button" class="btn btn-default c-btn-square c-btn-uppercase c-btn-bold cancelorder" style="width:48%;float: left;clear: both">Cancel</button>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($val->order_status == 4) {
                                    $delivery_date = $this->common->getMainDeliveryDate($val->order_id);
                                    $today_date = date('Y-m-d');
                                    $limitdate = date('Y-m-d', strtotime(date("Y-m-d", strtotime($delivery_date)) . " + " . $return_day . " days"));

                                    if ($today_date < $limitdate) {
                                        ?>
                                        <button id="<?= $val->order_id . "|" . $val->customer_id ?>" type="button" class="btn btn-default c-btn-square c-btn-uppercase c-btn-bold returnorder" style="width:48%;float: left;clear: both">Return</button>
                                        <?php
                                    }
                                }
                                ?>
                                <?php
                                if ($val->order_status == 3 || $val->order_status == 4) {
                                    ?>  
                                    <a href="track.html?id=<?= $val->order_id ?>" class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold trackorder" style="width:48%;float:left">Track Order</a>
                                    <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            <?php } ?> 
        </div>
        <div id="pastorder" style="text-align: center;background-color: #ff3366;">
            <h6 style="padding: 5px;color:#ffffff">Past Order </h6> 
        </div>
        <div class="orderslist pastorder">
            <?php
            foreach ($porders as $val) {
                $order_status = "";
                switch ($val->order_status) {
                    case '1':
                        $order_status = "Approve";
                        break;
                    case '2':
                        $order_status = "Ready To Ship";
                        break;
                    case '3':
                        $order_status = "Shipped";
                        break;
                    case '4':
                        $order_status = "Delivered";
                        break;
                    case '5':
                        $order_status = "Refund Request";
                        break;
                    case '6':
                        $order_status = "Cancel";
                        break;
                    case '7':
                        $order_status = "Replace";
                        break;
                    case '8':
                        $order_status = "Shipped Cancel";
                        break;
                    case '9':
                        $order_status = "Refund Paid";
                        break;
                }
                ?>

                <div class="row c-margin-b-40">
                    <div class="c-content-product-2 c-bg-white">
                        <div class="col-md-4" style="display: inline-block;float: left;">
                            <div class="c-content-overlay">
                                <div class="c-bg-img-center c-overlay-object" data-height="height" style="width:90px; height: 125px; background-size: 100%; background-image: url(<?= $val->image_thumb ?>);"></div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="c-info-list">
                                <h3 class="c-title c-font-bold c-font-14 c-font-dark c-margin-b-5">                            
                                    <?= $val->product_name ?>
                                </h3>
                                <p class="c-order-date c-font-12 c-font-thin c-theme-font c-font-bold">ORDER DATE - <?= date('dS M\' Y', strtotime($val->order_date)) ?></p>
                                <p class="c-font-12 c-font-thin c-theme-font c-font-bold">ORDER ID - <?= $val->order_id ?></p>
                                <p class="c-font-12 c-font-thin c-theme-font c-font-bold">STATUS - <?= $order_status ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            <?php } ?> 
        </div>


        <div class='cancelBlock' style="border: 1px solid #32c5d2;padding: 10px;display:none">
            <form id="cancelform" class="c-form-register">
                <input type="hidden" id="cancel_order_id" name="order_id" value=""/>
                <div class="form-group">
                    <select id='cancel_reason' name="cancel_reason" class="form-control c-square c-theme">
                        <option value='0'>Select Reason</option>
                        <option value='Not Interested Any More'>Not Interested Any More</option>
                        <option value='Order Delivery Delayed'>Order Delivery Delayed</option>
                        <option value='Ordered Duplicate Item By Mistake'>Ordered Duplicate Item By Mistake</option>
                        <option value='Purchased Wrong Item'>Purchased Wrong Item</option>
                        <option value='Other Reason'>Other Reason</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea id='comment' name="cancel_comment" type="text" class="form-control c-square c-theme" placeholder="Comment"></textarea>
                </div>
                <div class="form-group" style="clear:both">
                    <button  type="button" class="btn btn-default c-btn-square c-btn-uppercase c-btn-bold cancelconfirm" style="width:48%;clear: both">Cancel Order</button>
                    <button  type="button" class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold backcancel" style="width:47%;float:right">Back</button>
                </div>
            </form>
        </div>
        <div class='returnBlock' style="border: 1px solid #32c5d2;padding: 10px;display:none">
            <form id="returnform" class="c-form-register ">
                <input type="hidden" id="return_order_id" name="order_id" value=""/>
                <input type="hidden" id="customer_id" name="customer_id" value=""/>
                <div class="form-group">
                    <select id="activity" name="activity" class="form-control c-square c-theme">
                        <option value="0">Replacement</option>
                        <option value="1">Return</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea name="reason" type="text" class="form-control c-square c-theme" placeholder="Comment"></textarea>
                </div>
                <div class="bankinfo" style="display:none;">
                    <div class="form-group">                                  
                        <select id="bank_name" name="bank_name" class="form-control">
                            <?php
                            if (isset($bankname) && is_array($bankname)) {
                                foreach ($bankname as $val) {
                                    ?>
                                    <option value="<?= $val->id ?>"<?php
                                    if ($customer->bank_name != "") {
                                        if ($val->id == $customer->bank_name) {
                                            echo "selected";
                                        }
                                    }
                                    ?>><?= $val->bank_name ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                        </select>   
                    </div>
                    <div class="form-group">                                  
                        <input id="ifsc" name="ifsc" class="form-control" placeholder="IFSC Code" value="<?= $customer->ifsc ?>"/>
                    </div>
                    <div class="form-group">                             
                        <input id="accountname" name="account_name" class="form-control" placeholder="Account Holder Name" value="<?= $customer->account_name ?>"/>
                    </div>
                    <div class="form-group">                                   
                        <input id="accountno" name="account_no" class="form-control" placeholder="Account Number" value="<?= $customer->account_no ?>"/>
                    </div>
                </div>
                <div class="form-group" style="clear:both">
                    <button  type="button" class="btn btn-default c-btn-square c-btn-uppercase c-btn-bold returnconfirm" style="width:48%;clear: both">Return</button>
                    <button  type="button" class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold backreturn" style="width:47%;float:right">Back</button>
                </div>
            </form>
        </div>
    </div>

<?php } ?>