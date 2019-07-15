<?php
$return_day = $this->common->returnDay()->return_day;
?>
<style type="text/css">
    .labelorderid{
        width: 100px;
        background-color: #0088CC;
        color: #FFFFFF;
        border-radius: 5px;
        padding-top: 5px;
        padding-bottom: 7px;    
        padding-left: 15px;
    }
</style>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Order Management</h2>

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
            <div class="tabs">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#recent" data-toggle="tab">Recent Order</a>
                    </li>
                    <li>
                        <a href="#past" data-toggle="tab">Past Order</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="recent" class="tab-pane active">
                        <div class="row">
                            <div class="col-md-12">  
                                <?php
                                if (isset($rorders) && is_array($rorders)) {
                                    foreach ($rorders as $order) {
                                        ?>            
                                        <section class="panel panel-featured panel-featured-primary">
                                            <header class="panel-heading">
                                                <div class="panel-actions">
                                                    <a href="#" class="fa fa-caret-down"></a>
                                                </div>    
                                                <label class="labelorderid">ORDER ID</label>
                                                <a class="btn btn-success" name="order_id" href="<?= site_url() ?>buyer/track?id=<?= base64_encode($order->order_id) ?>"><?= $order->order_id ?></a> 
                                            </header>
                                            <div class="panel-body">     
                                                <div class="row">
                                                    <div class="col-md-1" style="margin-right: 30px;">
                                                        <img src="<?= $order->image_thumb ?>" width="80" height="100" />
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="text-primary" style="font-weight: bold"><?= $order->product_name ?></label>
                                                            </div>                                            
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="text-dark" style="font-weight: bold">Quantity</label>
                                                            </div> 
                                                            <div class="col-md-3">
                                                                <label class="text-dark" style="font-weight: bold"><?= $order->qty ?></label>
                                                            </div> 
                                                            <div class="col-md-3">
                                                                <label class="text-dark" style="font-weight: bold">Colour</label>
                                                            </div> 
                                                            <div class="col-md-3">
                                                                <label class="text-dark" style="font-weight: bold"><?= $order->colour ?></label>
                                                            </div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="text-dark" style="font-weight: bold">Brand</label>
                                                            </div> 
                                                            <div class="col-md-3">
                                                                <label class="text-dark" style="font-weight: bold"><?= $order->brand ?></label>
                                                            </div> 
                                                            <div class="col-md-3">
                                                                <label class="text-dark" style="font-weight: bold">Size</label>
                                                            </div> 
                                                            <div class="col-md-3">
                                                                <label class="text-dark" style="font-weight: bold"><?= $order->size ?></label>
                                                            </div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="text-dark" style="font-weight: bold">Weight</label>
                                                            </div> 
                                                            <div class="col-md-3">
                                                                <label class="text-dark" style="font-weight: bold"><?= $order->weight ?> (gm)</label>
                                                            </div> 
                                                            <div class="col-md-3">
                                                                <label class="text-dark" style="font-weight: bold">Status</label>
                                                            </div> 
                                                            <div class="col-md-3">
                                                                <?php if ($order->request == 1) { ?>
                                                                    <span class="label label-info">Request For Cancel</span>
                                                                <?php } else if ($order->request == 2) { ?>
                                                                    <span class="label label-info">Request For Replace</span>  
                                                                <?php } else if ($order->request == 3) { ?>
                                                                    <span class="label label-info">Request For Return</span>
                                                                <?php } else if ($order->request == 4) { ?>
                                                                    <span class="label label-info">Request Reject</span>
                                                                <?php } else if ($order->order_status == 1) { ?>
                                                                    <span class="label label-primary">Approve</span>
                                                                <?php } else if ($order->order_status == 2) { ?>
                                                                    <span class="label label-dark">Ready To Ship</span>
                                                                <?php } else if ($order->order_status == 3) { ?>
                                                                    <span class="label label-info">Ready To Ship</span>
                                                                <?php } else if ($order->order_status == 4) { ?>
                                                                    <span class="label label-success">Delivery</span>
                                                                <?php } else if ($order->order_status == 5) { ?>
                                                                    <span class="label label-warning">Refund</span>
                                                                <?php } else if ($order->order_status == 6) { ?>
                                                                    <span class="label label-danger">Cancel</span>
                                                                <?php } else if ($order->order_status == 7) { ?>
                                                                    <span class="label label-default">Replacement</span>
                                                                <?php } else if ($order->order_status == 8) { ?>
                                                                    <span class="label label-danger">Shipped Cancel</span>
                                                                <?php } else if ($order->order_status == 9) { ?>
                                                                    <span class="label label-success">Refund Paid</span>
                                                                <?php } ?>
                                                            </div> 
                                                        </div>
                                                    </div>                                    
                                                    <div class="col-md-2" style="float:right;width: 12%;">
                                                        <div class="row">
                                                            <div class="col-md-12" style="padding: 10px;">
                                                                <a class="btn btn-primary" name="order_id" href="<?= site_url() ?>buyer/track?id=<?= base64_encode($order->order_id) ?>">Track</a> 
                                                            </div>   
                                                            <?php
                                                            if (($order->order_status == 1 || $order->order_status == 2 || $order->order_status == 3) && $order->request == 0) {
                                                                ?>                                         
                                                                <div class="col-md-12" style="padding: 10px;">
                                                                    <a id="<?= $order->order_id . "|" . $order->pay_method ?>" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn-danger cancelorder" href="#modalcancel">Cancel</a> 
                                                                </div> 
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            if ($order->order_status == 4 && $order->request == 0) {
                                                                $delivery_date = $this->common->getMainDeliveryDate($order->order_id);
                                                                $today_date = date('Y-m-d');
                                                                $limitdate = date('Y-m-d', strtotime(date("Y-m-d", strtotime($delivery_date)) . " + " . $return_day . " days"));

                                                                if ($today_date < $limitdate) {
                                                                    ?>                                         
                                                                    <div class="col-md-12" style="padding: 10px;">
                                                                        <a id="<?= $order->order_id . "|" . $order->customer_id ?>" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn-danger returnorder" href="#modalreturn">Return</a> 
                                                                    </div> 
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>   
                                                    </div>
                                                </div>                                                                
                                                <hr>
                                                <div class="row"> 
                                                    <div class="col-md-3">
                                                        <label class="text-dark" style="font-weight: bold">Seller : <?= $order->business_name ?></label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="text-dark" style="font-weight: bold">Order on <?= date('dS M\' Y', strtotime($order->order_date)) ?></label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <?php
                                                        if ($order->order_status == 4) {
                                                            ?>  
                                                            <div class="row">                                                                
                                                                <div class="col-md-6" style="margin-top: -10px;">
                                                                    <a id="<?= $order->order_id . "|" . $order->product_id ?>" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn-success productrate" href="#modalproductreview">Product Rate</a> 
                                                                </div> 
                                                            </div>
                                                        <?php } ?>                                    
                                                    </div>
                                                    <div class="col-md-2" style="text-align: right">
                                                        <label class="text-dark" style="font-weight: bold">Order Total : <?= $order->payment_price ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>  
                    </div>
                    <div id="past" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">  
                                <?php
                                if (isset($porders) && is_array($porders)) {
                                    foreach ($porders as $order) {
                                        ?>            
                                        <section class="panel panel-featured panel-featured-primary">
                                            <header class="panel-heading">
                                                <div class="panel-actions">
                                                    <a href="#" class="fa fa-caret-down"></a>
                                                </div>    
                                                <label class="labelorderid">ORDER ID</label>
                                                <button class="btn btn-success" name="order_id" ><?= $order->order_id ?></button> 
                                            </header>
                                            <div class="panel-body">     
                                                <div class="row">
                                                    <div class="col-md-1" style="margin-right: 30px;">
                                                        <img src="<?= $order->image_thumb ?>" width="80" height="100" />
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="text-primary" style="font-weight: bold"><?= $order->product_name ?></label>
                                                            </div>                                            
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="text-dark" style="font-weight: bold">Quantity</label>
                                                            </div> 
                                                            <div class="col-md-3">
                                                                <label class="text-dark" style="font-weight: bold"><?= $order->qty ?></label>
                                                            </div> 
                                                            <div class="col-md-3">
                                                                <label class="text-dark" style="font-weight: bold">Colour</label>
                                                            </div> 
                                                            <div class="col-md-3">
                                                                <label class="text-dark" style="font-weight: bold"><?= $order->colour ?></label>
                                                            </div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="text-dark" style="font-weight: bold">Brand</label>
                                                            </div> 
                                                            <div class="col-md-3">
                                                                <label class="text-dark" style="font-weight: bold"><?= $order->brand ?></label>
                                                            </div> 
                                                            <div class="col-md-3">
                                                                <label class="text-dark" style="font-weight: bold">Size</label>
                                                            </div> 
                                                            <div class="col-md-3">
                                                                <label class="text-dark" style="font-weight: bold"><?= $order->size ?></label>
                                                            </div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="text-dark" style="font-weight: bold">Weight</label>
                                                            </div> 
                                                            <div class="col-md-3">
                                                                <label class="text-dark" style="font-weight: bold"><?= $order->weight ?> (kg)</label>
                                                            </div> 
                                                            <div class="col-md-3">
                                                                <label class="text-dark" style="font-weight: bold">Status</label>
                                                            </div> 
                                                            <div class="col-md-3">
                                                                <?php if ($order->order_status == 1) { ?>
                                                                    <span class="label label-primary">Approve</span>
                                                                <?php } else if ($order->order_status == 2) { ?>
                                                                    <span class="label label-dark">Ready To Ship</span>
                                                                <?php } else if ($order->order_status == 3) { ?>
                                                                    <span class="label label-info">Shipped</span>
                                                                <?php } else if ($order->order_status == 4) { ?>
                                                                    <span class="label label-success">Delivery</span>
                                                                <?php } else if ($order->order_status == 5) { ?>
                                                                    <span class="label label-warning">Return</span>
                                                                <?php } else if ($order->order_status == 6) { ?>
                                                                    <span class="label label-danger">Cancel</span>
                                                                <?php } else if ($order->order_status == 7) { ?>
                                                                    <span class="label label-default">Replacement</span>
                                                                <?php } ?>
                                                            </div> 
                                                        </div>
                                                    </div>                                   

                                                </div>                                                                
                                                <hr>
                                                <div class="row"> 
                                                    <div class="col-md-3">
                                                        <label class="text-dark" style="font-weight: bold">Seller : <?= $order->business_name ?></label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="text-dark" style="font-weight: bold">Order on <?= date('dS M\' Y', strtotime($order->order_date)) ?></label>
                                                    </div>
                                                    <div class="col-md-4">                                                                                          
                                                    </div>
                                                    <div class="col-md-2" style="text-align: right">
                                                        <label class="text-dark" style="font-weight: bold">Order Total : <?= $order->selling_price ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--product Return Model Start-->
    <div id="modalreturn" class="zoom-anim-dialog modal-block modal-block-sm mfp-hide">
        <form id="modalreturnform" method="POST" action="<?= site_url() ?>buyer/order/returnOrder">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Edit Listing</h2>
                </header>
                <div class="panel-body">
                    <input type="hidden" id="order_id" name="order_id" value=""/>
                    <input type="hidden" id="customer_id" name="customer_id" value=""/>
                    <div class="row">
                        <div class="col-md-12" style="padding: 0px 30px;border-right: 1px solid #eeeeee;">
                            <div class="row">
                                <div class="col-md-12">
                                    <select id="activity" name="activity" class="form-control">
                                        <option value="0">Replacement</option>
                                        <option value="1">Return</option>
                                    </select>
                                </div>
                                <div class="col-md-12" style="margin-top:10px;">                                    
                                    <textarea name="reason" class="form-control" placeholder="Reason"></textarea>
                                </div>
                            </div>
                            <div class="row bankinfo" style="display:none;">
                                <div class="col-md-12" style="margin-top:10px;">                                    
                                    <select id="bank_name" name="bank_name" class="form-control">
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
                                <div class="col-md-12" style="margin-top:10px;">                                    
                                    <input id="ifsc" name="ifsc" class="form-control" placeholder="IFSC Code" value="<?= $customer->ifsc ?>"/>
                                </div>
                                <div class="col-md-12" style="margin-top:10px;">                                    
                                    <input id="accountname" name="account_name" class="form-control" placeholder="Account Holder Name" value="<?= $customer->account_name ?>"/>
                                </div>
                                <div class="col-md-12" style="margin-top:10px;">                                    
                                    <input id="accountno" name="account_no" class="form-control" placeholder="Account Number" value="<?= $customer->account_no ?>"/>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>                           
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button id="returnconfirm" type="button" class="btn btn-primary ">Confirm</button>
                            <button class="btn btn-default modal-dismiss">Cancel</button>
                        </div>
                    </div>
                </footer>
            </section>
        </form>
    </div>
    <!--product Return Model End--> 

    <!--product Review Model Start-->
    <div id="modalproductreview" class="zoom-anim-dialog modal-block modal-block-sm mfp-hide">
        <form id="modalproductreviewform" method="POST" class="form-horizontal" >
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Product Review</h2>
                </header>
                <div class="panel-body">
                    <input type="hidden" id="prate_order_id" name="order_id" value=""/>  
                    <input type="hidden" id="prate_product_id" name="product_id" value=""/>  
                    <div class="form-group">
                        <label class="col-md-3 control-label">Rate</label>
                        <div class="col-md-3">
                            <select id="prate" name="prate" class="form-control">
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Review</label>
                        <div class="col-md-8">
                            <textarea id="preview" name="preview" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>                    
                </div>                           
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button id="previewconfirm" type="button" class="btn btn-primary ">Confirm</button>
                            <button id="previewcancel" class="btn btn-default modal-dismiss">Cancel</button>
                        </div>
                    </div>
                </footer>
            </section>
        </form>
    </div>
    <!--product Review Model End--> 

    <!--Seller Cancel Model Start-->
    <div id="modalcancel" class="zoom-anim-dialog modal-block modal-block-sm mfp-hide">
        <form id="modalcancelform" method="POST" class="form-horizontal" action="<?= site_url() ?>buyer/order/cancelOrder" >
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Product Cancel</h2>
                </header>
                <div class="panel-body">
                    <input type="hidden" id="cancel_order_id" name="order_id" value=""/>  
                    <div class="form-group">
                        <label class="col-md-3 control-label">Reason</label>
                        <div class="col-md-9">
                            <select id="cancel_reason" name="cancel_reason" class="form-control">
                                <option value="0">Select Reason</option>
                                <option value="Not Interested Any More">Not Interested Any More</option>
                                <option value="Order Delivery Delayed">Order Delivery Delayed</option>
                                <option value="Ordered Duplicate Item By Mistake">Ordered Duplicate Item By Mistake</option>
                                <option value="Purchased Wrong Item">Purchased Wrong Item</option>
                                <option value="Other Reason">Other Reason</option>
                            </select>                            
                        </div>
                    </div>
                    <div class="bankinfo" style="display:none;">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Bank Name</label>
                            <div class="col-md-9">                                   
                                <select id="bank_name" name="bank_name" class="form-control">
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
                            <label class="col-md-3 control-label">IFSC Code</label>
                            <div class="col-md-9">                               
                                <input id="ifsc" name="ifsc" class="form-control" placeholder="IFSC Code" value="<?= $customer->ifsc ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">A/C Name</label>
                            <div class="col-md-9">                                     
                                <input id="accountname" name="account_name" class="form-control" placeholder="Account Holder Name" value="<?= $customer->account_name ?>"/>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 10px">
                            <label class="col-md-3 control-label">Account No</label>
                            <div class="col-md-9">                                     
                                <input id="accountno" name="account_no" class="form-control" placeholder="Account Number" value="<?= $customer->account_no ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Comment</label>
                        <div class="col-md-9">
                            <textarea id="cancel_comment" name="cancel_comment" class="form-control" rows="3"></textarea>
                        </div>
                    </div>                    
                </div>                           
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button id="cancelconfirm" type="button" class="btn btn-primary ">Confirm</button>
                            <button id="cancelclose" class="btn btn-default modal-dismiss">Cancel</button>
                        </div>
                    </div>
                </footer>
            </section>
        </form>
    </div>
    <!--product Cancel Model End--> 

    <!-- end: page -->
</section>
<?php $msg = $this->input->get('msg'); ?>
<?php
switch ($msg) {
    case "C":
        $m = "Your Order Is Cancelled ..!";
        $t = "success";
        break;
    case "R":
        $m = "Your Order Is Return ..!";
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
    $(function () {
        $('#bank_name').val("<?= $customer->bank_name ?>");
        // Own Jquery Start  
        $('#activity').change(function () {
            if ($(this).val() == 1) {
                $('.bankinfo').removeAttr('style');
            } else {
                $('.bankinfo').css('display', 'none');
            }
        });

        $('.cancelorder').click(function () {
            $id = $(this).prop('id');
            $splitdata = $id.split("|");
            $('#cancel_order_id').val($splitdata[0]);
            if ($splitdata[1] == "card") {
                $('.bankinfo').removeAttr('style');
            } else {
                $('.bankinfo').css('display', 'none');
            }
        });

        $('#cancelconfirm').click(function () {
            if ($('#cancel_reason').val() != '0')
            {
                $(this).attr('disabled',true);
                $('#modalcancelform').submit();
            } else {
                alertify.error("Please Select Reason");
            }
        });

        $('.returnorder').click(function () {
            $id = $(this).prop('id');
            $splitdata = $id.split("|");
            $('#order_id').val($splitdata[0]);
            $('#customer_id').val($splitdata[1]);
        });

        $('.productrate').click(function () {
            $id = $(this).prop('id');
            $splitdata = $id.split("|");
            $order_id = $splitdata[0];
            $product_id = $splitdata[1];
            $('#prate_order_id').val($order_id);
            $('#prate_product_id').val($product_id);
            $.ajax({
                url: "<?= site_url() ?>buyer/order/getProductRate",
                type: 'POST',
                data: {'order_id': $order_id},
                success: function (data, textStatus, jqXHR) {
                    $productreview = data.split("|");
                    if ($productreview[1] != "") {
                        $('#prate').val($productreview[0]);
                        $('#preview').val($productreview[1]);
                    }
                }
            });
        });

        $('#previewconfirm').click(function () {
            $(this).prop('disabled', true);
            $.ajax({
                url: "<?= site_url() ?>buyer/order/setProductRate",
                type: 'POST',
                data: $('#modalproductreviewform').serialize(),
                success: function (data, textStatus, jqXHR) {
                    if (data == 1) {
                        alertify.success("Thanks For Given Product Review");
                        $('#previewcancel').trigger('click');
                    }
                }
            });

        });

        $('#returnconfirm').click(function () {
            $activity = $('#activity').val();
            if ($activity == 1) {
                if ($('#bankname').val() == "") {
                    alertify.error("Enter Bank Name");
                } else if ($('#ifsc').val() == "") {
                    alertify.error("Enter IFSC Code");
                } else if ($('#accountno').val() == "") {
                    alertify.error("Enter Account Number");
                } else {
                    $(this).attr('disabled', true);
                    $('#modalreturnform').submit();
                }
            } else {
                $(this).attr('disabled', true);
                $('#modalreturnform').submit();
            }
        });
    });
</script>
