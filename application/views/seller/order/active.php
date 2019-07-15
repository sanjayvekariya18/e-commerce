<style type="text/css">
    .th1{
        width: 105px !important;
    }
    .th2{
        width: 460px !important;
    }
    .th3{
        width: 80px !important;
    }
    .th4{
        width: 200px !important;
    }
    .th5{
        width: 200px !important;
    }
    .th6{
        width: 150px !important;
    }    
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
        <h2>Active Order Management</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?= site_url() ?>seller">
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
                <div class="panel-body">
                    <div class="tabs">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#topack" data-toggle="tab">To Pack</a>
                            </li>
                            <li>
                                <a href="#topickup" data-toggle="tab">To Pick Up </a>
                            </li>  
                            <li>
                                <a href="#todispatch" data-toggle="tab">To Dispatch</a>
                            </li> 
                            <li>
                                <a href="#tohandover" data-toggle="tab">To Handover</a>
                            </li> 
                        </ul>
                        <div class="tab-content">
                            <div id="topack" class="tab-pane active">
                                <section class="panel">
                                    <header class="panel-heading">                                        
                                        <h2 class="panel-title">To Pack Order Details</h2>
                                    </header>
                                    <div class="panel-body">
                                        <form id="packorderform" name="packorderform" method="post" action="#">
                                            <button id="btnExport1" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                                            <table class="table table-striped mb-none" id="datatable-default1" style="width:100%">
                                                <thead>
                                                    <tr>                                                        
                                                        <th class="th2">Order Summery</th>
                                                        <th class="th3">Status</th>
                                                        <th class="th4">Quantity and Price</th>
                                                        <th class="th5">Buyer details</th>
                                                        <th class="th6">Dispatch By</th>
                                                        <th class="th1"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (isset($pack) && is_array($pack)) {
                                                        foreach ($pack as $val) {
                                                            ?>
                                                            <tr>
                                                                <td>                                                                    
                                                                    <img src="<?= $val->image_medium ?>" width="80" height="100" style="border:1px;float: left;margin-right: 10px;"/>
                                                                    <table>
                                                                        <tr>
                                                                            <td colspan="2"><label class="text-dark" style="font-weight: bold">SKU:  <?= $val->sku ?></label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="2"><label class="text-primary" style="font-weight: bold"><?= $val->product_name ?></label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><label class="text-dark" style="font-weight: bold">Colour</label></td>
                                                                            <td><label class="text-dark"><?= $val->colour ?></label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><label class="text-dark" style="font-weight: bold">Size</label></td>
                                                                            <td><label class="text-dark"><?= $val->size ?></label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><label class="text-dark" style="font-weight: bold">Order Date</label></td>
                                                                            <td><label class="text-dark"><?= date('dS M\' Y', strtotime($val->order_date)) ?></label></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><label class="text-dark" style="font-weight: bold">Order ID</label></td>
                                                                            <td><label class="text-dark"><?= $val->order_id ?></label></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td style="text-align: center">
                                                                    <?php if ($val->order_status == 1) { ?>
                                                                        <span class="label label-primary">Approve</span>
                                                                    <?php } else if ($val->order_status == 2) { ?>
                                                                        <span class="label label-dark">Ready To Ship</span>
                                                                    <?php } else if ($val->order_status == 3) { ?>
                                                                        <span class="label label-info">Ready To Ship</span>
                                                                    <?php } else if ($val->order_status == 4) { ?>
                                                                        <span class="label label-success">Delivery</span>
                                                                    <?php } else if ($val->order_status == 5) { ?>
                                                                        <span class="label label-warning">Return</span>
                                                                    <?php } else if ($val->order_status == 6) { ?>
                                                                        <span class="label label-danger">Cancel</span>
                                                                    <?php } else if ($val->order_status == 7) { ?>
                                                                        <span class="label label-default">Replacement</span>
                                                                    <?php } ?>    
                                                                </td>
                                                                <td>
                                                                    <table>
                                                                        <tr>
                                                                            <td style="padding-right: 3px;"><label class="text-dark" style="font-weight: bold">Qty</label></td>
                                                                            <td><label class="text-dark"><?= $val->qty ?></label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding-right: 3px;"><label class="text-dark" style="font-weight: bold">Value</label></td>
                                                                            <td><label class="text-dark"><?= $val->selling_price ?> (each)</label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding-right: 3px;"><label class="text-dark" style="font-weight: bold">Shipping</label></td>
                                                                            <td><label class="text-dark"><?= $val->shipping_charge ?></label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding-right: 3px;"><label class="text-dark" style="font-weight: bold">Total</label></td>
                                                                            <td><label class="text-dark"><?= $val->total_price ?></label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding-right: 3px;"><label class="text-dark" style="font-weight: bold">Payment Type</label></td>
                                                                            <td><label class="text-dark"><?= ($val->pay_method == "cod") ? 'Cash On Delivery' : 'Credit Card/ Debit Card / Net Banking' ?></label></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td>
                                                                    <label class="text-dark" style="font-weight: bold"><?= $val->address ?></label>
                                                                    <label class="text-dark" style="font-weight: bold"><?= $val->city ?></label>
                                                                    <label class="text-dark" style="font-weight: bold"><?= $val->state_name ?> - </label>
                                                                    <label class="text-dark" style="font-weight: bold"><?= $val->pincode ?></label>
                                                                </td>
                                                                <td>
                                                                    <label class="text-dark" style="font-weight: bold">in <?= $val->shipping_time ?> days,</label>
                                                                    <label class="text-dark" style="font-weight: bold"><?= date('M d, Y', strtotime(date("Y-m-d", strtotime($val->order_date)) . " + " . $val->shipping_time . " days")); ?></label>
                                                                    <label class="text-dark" style="font-weight: bold">Procurement</label>
                                                                </td>
                                                                <?php
                                                                $courior = $this->common->checkPincodeCourior($val->pincode);
                                                                if ($courior != 1) {
                                                                    ?>
                                                                    <td style="text-align: center">
                                                                        <!--<button type="button" class="btn btn-primary pack_slip" style="margin-bottom: 15px;" value="<?= $val->order_id ?>">Pack Slip</button>-->
                                                                        <a id="<?= $val->order_id . "|" . $courior . "|" . $val->pay_method ?>" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn-danger packing" href="#trackingidmodel"><?= ($courior == 3) ? "DTDC PACK" : "INDIA POST ID" ?></a>
                                                                        <a class="mb-xs mt-xs mr-xs btn btn-default" href="<?= site_url() ?>seller/product/view?pid=<?= base64_encode($val->product_id) ?>"target="_blank">Preview</a>
                                                                    </td>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>                                    
                                </section>
                            </div>
                            <div id="topickup" class="tab-pane">
                                <section class="panel">
                                    <header class="panel-heading">                                        
                                        <h2 class="panel-title">To Pick Up Details</h2>
                                    </header>
                                    <div class="panel-body">
                                        <form id="packorderform" name="packorderform" method="post" action="#">
                                            <button id="btnExport2" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                                            <table class="table table-striped mb-none" id="datatable-default2" style="width:100%">
                                                <thead>
                                                    <tr>                                                        
                                                        <th class="th2">Order Summery</th>
                                                        <th class="th3">Status</th>
                                                        <th class="th4">Quantity and Price</th>
                                                        <th class="th5">Buyer details</th>
                                                        <th class="th6">Dispatch By</th>
                                                        <th class="th1"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (isset($pickup) && is_array($pickup)) {
                                                        foreach ($pickup as $val) {
                                                            ?>
                                                            <tr>
                                                                <td>                                                                    
                                                                    <img src="<?= $val->image_medium ?>" width="80" height="100" style="border:1px;float: left;margin-right: 10px;"/>
                                                                    <table>
                                                                        <tr>
                                                                            <td colspan="2"><label class="text-dark" style="font-weight: bold">SKU:  <?= $val->sku ?></label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="2"><label class="text-primary" style="font-weight: bold"><?= $val->product_name ?></label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><label class="text-dark" style="font-weight: bold">Colour</label></td>
                                                                            <td><label class="text-dark"><?= $val->colour ?></label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><label class="text-dark" style="font-weight: bold">Size</label></td>
                                                                            <td><label class="text-dark"><?= $val->size ?></label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><label class="text-dark" style="font-weight: bold">Order Date</label></td>
                                                                            <td><label class="text-dark"><?= date('dS M\' Y', strtotime($val->order_date)) ?></label></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><label class="text-dark" style="font-weight: bold">Order ID</label></td>
                                                                            <td><label class="text-dark"><?= $val->order_id ?></label></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td style="text-align: center">
                                                                    <?php if ($val->order_status == 1) { ?>
                                                                        <span class="label label-primary">Approve</span>
                                                                    <?php } else if ($val->order_status == 2) { ?>
                                                                        <span class="label label-dark">Ready To Ship</span>
                                                                    <?php } else if ($val->order_status == 3) { ?>
                                                                        <span class="label label-info">Ready To Ship</span>
                                                                    <?php } else if ($val->order_status == 4) { ?>
                                                                        <span class="label label-success">Delivery</span>
                                                                    <?php } else if ($val->order_status == 5) { ?>
                                                                        <span class="label label-warning">Return</span>
                                                                    <?php } else if ($val->order_status == 6) { ?>
                                                                        <span class="label label-danger">Cancel</span>
                                                                    <?php } else if ($val->order_status == 7) { ?>
                                                                        <span class="label label-default">Replacement</span>
                                                                    <?php } ?>    
                                                                </td>
                                                                <td>
                                                                    <table>
                                                                        <tr>
                                                                            <td style="padding-right: 3px;"><label class="text-dark" style="font-weight: bold">Qty</label></td>
                                                                            <td><label class="text-dark"><?= $val->qty ?></label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding-right: 3px;"><label class="text-dark" style="font-weight: bold">Value</label></td>
                                                                            <td><label class="text-dark"><?= $val->selling_price ?> (each)</label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding-right: 3px;"><label class="text-dark" style="font-weight: bold">Shipping</label></td>
                                                                            <td><label class="text-dark"><?= $val->shipping_charge ?></label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding-right: 3px;"><label class="text-dark" style="font-weight: bold">Total</label></td>
                                                                            <td><label class="text-dark"><?= $val->total_price ?></label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding-right: 3px;"><label class="text-dark" style="font-weight: bold">Payment Type</label></td>
                                                                            <td><label class="text-dark"><?= ($val->pay_method == "cod") ? 'Cash On Delivery' : 'Credit Card/ Debit Card / Net Banking' ?></label></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td>
                                                                    <label class="text-dark" style="font-weight: bold"><?= $val->address ?></label>
                                                                    <label class="text-dark" style="font-weight: bold"><?= $val->city ?></label>
                                                                    <label class="text-dark" style="font-weight: bold"><?= $val->state_name ?> - </label>
                                                                    <label class="text-dark" style="font-weight: bold"><?= $val->pincode ?></label>
                                                                </td>
                                                                <td>
                                                                    <label class="text-dark" style="font-weight: bold">in <?= $val->shipping_time ?> days,</label>
                                                                    <label class="text-dark" style="font-weight: bold"><?= date('M d, Y', strtotime(date("Y-m-d", strtotime($val->order_date)) . " + " . $val->shipping_time . " days")); ?></label>
                                                                    <label class="text-dark" style="font-weight: bold">Procurement</label>
                                                                </td>
                                                                <td style="text-align: center"><button type="button" class="btn btn-primary pickup_slip" style="margin-bottom: 15px;" value="<?= $val->order_id ?>">Pickup Order</button></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>                                    
                                </section>
                            </div>
                            <div id="todispatch" class="tab-pane">
                                <section class="panel">
                                    <header class="panel-heading">                                        
                                        <h2 class="panel-title">To Packed Order Details</h2>
                                    </header>
                                    <div class="panel-body">
                                        <form id="dispatchform" action="<?= site_url() ?>seller/order/dtdcsheet" target="_blank" method="post">
                                            <button id="btnExport3" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                                            <button class="btn btn-primary btn-sm" type="submit" style="width:150px;margin-bottom: 15px">Dtdc Manifest</button>
                                            <table class="table table-striped mb-none" id="datatable-default3" style="width:100%">
                                                <thead>
                                                    <tr>  
                                                        <th class=""><input type="checkbox"/></th>
                                                        <th class="th2">Order Summery</th>
                                                        <th class="th3">Status</th>
                                                        <th class="th4">Quantity and Price</th>
                                                        <th class="th5">Buyer details</th>
                                                        <th class="th6">Dispatch By</th>  
                                                        <th class="th1"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (isset($dispatch) && is_array($dispatch)) {
                                                        foreach ($dispatch as $val) {
                                                            ?>
                                                            <tr>  
                                                                <td><input type="checkbox" name="allOrder[]" value="<?= $val->order_id ?>"/></td>
                                                                <td>                                                               
                                                                    <img src="<?= $val->image_medium ?>" width="80" height="100" style="border:1px;float: left;margin-right: 10px;"/>
                                                                    <table>
                                                                        <tr>
                                                                            <td colspan="2"><label class="text-dark" style="font-weight: bold">SKU:  <?= $val->sku ?></label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="2"><label class="text-primary" style="font-weight: bold"><?= $val->product_name ?></label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><label class="text-dark" style="font-weight: bold">Colour</label></td>
                                                                            <td><label class="text-dark"><?= $val->colour ?></label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><label class="text-dark" style="font-weight: bold">Size</label></td>
                                                                            <td><label class="text-dark"><?= $val->size ?></label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><label class="text-dark" style="font-weight: bold">Order Date</label></td>
                                                                            <td><label class="text-dark"><?= date('dS M\' Y', strtotime($val->order_date)) ?></label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><label class="text-dark" style="font-weight: bold">Order ID</label></td>
                                                                            <td><label class="text-dark"><?= $val->order_id ?></label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><label class="text-dark" style="font-weight: bold">Tracking No</label></td>
                                                                            <td><label class="text-dark"><?= $val->awb_no ?></label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><label class="text-dark" style="font-weight: bold">Ship By</label></td>
                                                                            <td>
                                                                                <label class="text-dark">
                                                                                    <?php
                                                                                    if ($val->packing_by == 1) {
                                                                                        echo "Fedex";
                                                                                    } else if ($val->packing_by == 2) {
                                                                                        echo "India Post";
                                                                                    } else if ($val->packing_by == 3) {
                                                                                        echo "DTDC";
                                                                                    } else {
                                                                                        echo "-";
                                                                                    }
                                                                                    ?>
                                                                                </label>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td style="text-align: center">
                                                                    <?php if ($val->order_status == 1) { ?>
                                                                        <span class="label label-primary">Approve</span>
                                                                    <?php } else if ($val->order_status == 2) { ?>
                                                                        <span class="label label-dark">Ready To Ship</span>
                                                                    <?php } else if ($val->order_status == 3) { ?>
                                                                        <span class="label label-info">Ready To Ship</span>
                                                                    <?php } else if ($val->order_status == 4) { ?>
                                                                        <span class="label label-success">Delivery</span>
                                                                    <?php } else if ($val->order_status == 5) { ?>
                                                                        <span class="label label-warning">Return</span>
                                                                    <?php } else if ($val->order_status == 6) { ?>
                                                                        <span class="label label-danger">Cancel</span>
                                                                    <?php } else if ($val->order_status == 7) { ?>
                                                                        <span class="label label-default">Replacement</span>
                                                                    <?php } ?>    
                                                                </td>
                                                                <td>
                                                                    <table>
                                                                        <tr>
                                                                            <td style="padding-right: 3px;"><label class="text-dark" style="font-weight: bold">Qty</label></td>
                                                                            <td><label class="text-dark"><?= $val->qty ?></label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding-right: 3px;"><label class="text-dark" style="font-weight: bold">Value</label></td>
                                                                            <td><label class="text-dark"><?= $val->selling_price ?> (each)</label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding-right: 3px;"><label class="text-dark" style="font-weight: bold">Shipping</label></td>
                                                                            <td><label class="text-dark"><?= $val->shipping_charge ?></label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding-right: 3px;"><label class="text-dark" style="font-weight: bold">Total</label></td>
                                                                            <td><label class="text-dark"><?= $val->total_price ?></label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding-right: 3px;"><label class="text-dark" style="font-weight: bold">Payment Type</label></td>
                                                                            <td><label class="text-dark"><?= ($val->pay_method == "cod") ? 'Cash On Delivery' : 'Credit Card/ Debit Card / Net Banking' ?></label></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td>
                                                                    <label class="text-dark" style="font-weight: bold"><?= $val->address ?></label>
                                                                    <label class="text-dark" style="font-weight: bold"><?= $val->city ?></label>
                                                                    <label class="text-dark" style="font-weight: bold"><?= $val->state_name ?> - </label>
                                                                    <label class="text-dark" style="font-weight: bold"><?= $val->pincode ?></label>
                                                                </td>
                                                                <td>
                                                                    <label class="text-dark" style="font-weight: bold">in <?= $val->shipping_time ?> days,</label>
                                                                    <label class="text-dark" style="font-weight: bold"><?= date('M d, Y', strtotime(date("Y-m-d", strtotime($val->order_date)) . " + " . $val->shipping_time . " days")); ?></label>
                                                                    <label class="text-dark" style="font-weight: bold">Procurement</label>
                                                                </td>
                                                                <td style="text-align: center">
                                                                    <a target="_blank" href="<?= site_url() ?>seller/order/downloadSlip?id=<?= base64_encode($val->order_id) ?>" class="btn btn-primary " style="margin-bottom: 15px;">Download Slip</a><br/>
                                                                    <a href="<?= site_url() ?>seller/order/setInTransite?id=<?= base64_encode($val->order_id) ?>" class="btn btn-danger " style="margin-bottom: 15px;">Order Dispatch</a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>                                    
                                </section>
                            </div> 
                            <div id="tohandover" class="tab-pane">
                                <section class="panel">
                                    <header class="panel-heading">                                        
                                        <h2 class="panel-title">To Handover Order Details</h2>
                                    </header>
                                    <div class="panel-body">
                                        <button id="btnExport4" class="btn btn-warning btn-sm" type="button" style="width:80px;margin-bottom: 15px">Export</button>
                                        <table class="table table-striped mb-none" id="datatable-default4" style="width:100%">
                                            <thead>
                                                <tr>                                                        
                                                    <th class="th2">Order Summery</th>
                                                    <th class="th3">Status</th>
                                                    <th class="th4">Quantity and Price</th>
                                                    <th class="th5">Buyer details</th>
                                                    <th class="th6">Dispatch By</th>                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($handover) && is_array($handover)) {
                                                    foreach ($handover as $val) {
                                                        ?>
                                                        <tr>
                                                            <td>                                                                    
                                                                <img src="<?= $val->image_medium ?>" width="80" height="100" style="border:1px;float: left;margin-right: 10px;"/>
                                                                <table>
                                                                    <tr>
                                                                        <td colspan="2"><label class="text-dark" style="font-weight: bold">SKU:  <?= $val->sku ?></label></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="2"><label class="text-primary" style="font-weight: bold"><?= $val->product_name ?></label></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><label class="text-dark" style="font-weight: bold">Colour</label></td>
                                                                        <td><label class="text-dark"><?= $val->colour ?></label></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><label class="text-dark" style="font-weight: bold">Size</label></td>
                                                                        <td><label class="text-dark"><?= $val->size ?></label></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><label class="text-dark" style="font-weight: bold">Order Date</label></td>
                                                                        <td><label class="text-dark"><?= date('dS M\' Y', strtotime($val->order_date)) ?></label></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><label class="text-dark" style="font-weight: bold">Order ID</label></td>
                                                                        <td><label class="text-dark"><?= $val->order_id ?></label></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><label class="text-dark" style="font-weight: bold">Tracking No</label></td>
                                                                        <td><label class="text-dark"><?= $val->awb_no ?></label></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><label class="text-dark" style="font-weight: bold">Ship By</label></td>
                                                                        <td>
                                                                            <label class="text-dark">
                                                                                <?php
                                                                                if ($val->packing_by == 1) {
                                                                                    echo "Fedex";
                                                                                } else if ($val->packing_by == 2) {
                                                                                    echo "India Post";
                                                                                } else if ($val->packing_by == 3) {
                                                                                    echo "DTDC";
                                                                                } else {
                                                                                    echo "-";
                                                                                }
                                                                                ?>
                                                                            </label>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td style="text-align: center">
                                                                <?php if ($val->order_status == 1) { ?>
                                                                    <span class="label label-primary">Approve</span>
                                                                <?php } else if ($val->order_status == 2) { ?>
                                                                    <span class="label label-dark">Ready To Ship</span>
                                                                <?php } else if ($val->order_status == 3) { ?>
                                                                    <span class="label label-info">Ready To Ship</span>
                                                                <?php } else if ($val->order_status == 4) { ?>
                                                                    <span class="label label-success">Delivery</span>
                                                                <?php } else if ($val->order_status == 5) { ?>
                                                                    <span class="label label-warning">Return</span>
                                                                <?php } else if ($val->order_status == 6) { ?>
                                                                    <span class="label label-danger">Cancel</span>
                                                                <?php } else if ($val->order_status == 7) { ?>
                                                                    <span class="label label-default">Replacement</span>
                                                                <?php } ?>    
                                                            </td>
                                                            <td>
                                                                <table>
                                                                    <tr>
                                                                        <td style="padding-right: 3px;"><label class="text-dark" style="font-weight: bold">Qty</label></td>
                                                                        <td><label class="text-dark"><?= $val->qty ?></label></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-right: 3px;"><label class="text-dark" style="font-weight: bold">Value</label></td>
                                                                        <td><label class="text-dark"><?= $val->selling_price ?> (each)</label></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-right: 3px;"><label class="text-dark" style="font-weight: bold">Shipping</label></td>
                                                                        <td><label class="text-dark"><?= $val->shipping_charge ?></label></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-right: 3px;"><label class="text-dark" style="font-weight: bold">Total</label></td>
                                                                        <td><label class="text-dark"><?= $val->total_price ?></label></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-right: 3px;"><label class="text-dark" style="font-weight: bold">Payment Type</label></td>
                                                                        <td><label class="text-dark"><?= ($val->pay_method == "cod") ? 'Cash On Delivery' : 'Credit Card/ Debit Card / Net Banking' ?></label></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td>
                                                                <label class="text-dark" style="font-weight: bold"><?= $val->address ?></label>
                                                                <label class="text-dark" style="font-weight: bold"><?= $val->city ?></label>
                                                                <label class="text-dark" style="font-weight: bold"><?= $val->state_name ?> - </label>
                                                                <label class="text-dark" style="font-weight: bold"><?= $val->pincode ?></label>
                                                            </td>
                                                            <td>
                                                                <label class="text-dark" style="font-weight: bold">in <?= $val->shipping_time ?> days,</label>
                                                                <label class="text-dark" style="font-weight: bold"><?= date('M d, Y', strtotime(date("Y-m-d", strtotime($val->order_date)) . " + " . $val->shipping_time . " days")); ?></label>
                                                                <label class="text-dark" style="font-weight: bold">Procurement</label>
                                                            </td>                                                            
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>                                    
                                </section>
                            </div> 
                        </div>
                    </div>                   
                </div>
            </section>
        </div>
    </div>
    <!--India Post Model Start-->
    <div id="trackingidmodel" class="zoom-anim-dialog modal-block modal-block-sm mfp-hide">
        <form id="trackingidform" method="POST" class="form-horizontal" >
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Tracking Id</h2>
                </header>
                <div class="panel-body">
                    <input type="hidden" id="pack_order_id" name="order_id" value=""/>
                    <input type="hidden" id="courior" name="courior" value=""/>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Tracking Id</label>
                        <div class="col-md-9 track_box">
                            <input type="text" id="tracking_id" name="tracking_id" class="form-control"/>
                        </div>                        
                    </div>                    
                </div>                           
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button id="trackingconfirm" type="button" class="btn btn-primary modal-dismiss">Confirm</button>
                            <button id="trackingidclose" class="btn btn-default modal-dismiss">Cancel</button>
                        </div>
                    </div>
                </footer>
            </section>
        </form>
    </div>
    <!--India Post Model End--> 
    <div id="packloader" class="screenhide" style="display:none">
        <center>
            <img src="<?= base_url() ?>assets/images/loading_blue.gif" style="margin-top: 200px;width: 150px;height: 150px"/>
            <h3 class="page-heading-title2" style="color:#0088CC;font-size: 28px;margin-top: 50px;">Please Wait ..!!! We Are Generate Product Pack Slip...</h3>
        </center>
    </div>
    <!-- end: page -->
</section>
<?php $msg = $this->input->get('msg'); ?>
<?php
switch ($msg) {
    case "S":
        $m = "Order Information Updated ..!";
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

        $('#datatable-default1').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4, 5]
                }], iDisplayLength: -1
        });
        $('#datatable-default2').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4, 5]
                }], iDisplayLength: -1
        });
        $('#datatable-default3').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4, 5]
                }], iDisplayLength: -1
        });
        $('#datatable-default4').dataTable({
            order: [],
            aLengthMenu: [[10, 15, 20, 25, -1], [10, 15, 20, 25, 'All']],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0, 1, 2, 3, 4]
                }], iDisplayLength: -1
        });
        $("#btnExport1").click(function () {
            $("#datatable-default1").btechco_excelexport({
                containerid: "datatable-default1",
                datatype: $datatype.Table
            });
            
        });
        $("#btnExport2").click(function () {
            $("#datatable-default2").btechco_excelexport({
                containerid: "datatable-default2",
                datatype: $datatype.Table
            });
        });
        $("#btnExport3").click(function () {
            $("#datatable-default3").btechco_excelexport({
                containerid: "datatable-default3",
                datatype: $datatype.Table
            });
        });
        $("#btnExport4").click(function () {
            $("#datatable-default4").btechco_excelexport({
                containerid: "datatable-default4",
                datatype: $datatype.Table
            });
        });

        $('.pack_slip').click(function () {
            $('#packloader').css('display', 'block');
            $order_id = $(this).val();
            $.ajax({
                url: '<?= site_url() ?>seller/order/packSlip',
                type: 'post',
                data: {'order_id': $order_id},
                success: function (data, textStatus, jqXHR) {
                    alertify.success("Your Order Is packed");
                    setTimeout(function () {
                        location.reload(true);
                    }, 500);
                }
            });
        });

        $('.pickup_slip').click(function () {
            $('#packloader').css('display', 'block');
            $order_id = $(this).val();
            $.ajax({
                url: '<?= site_url() ?>seller/order/pickupSlip',
                type: 'post',
                data: {'order_id': $order_id},
                success: function (data, textStatus, jqXHR) {
                    alertify.success("Your Order Pickup Created");
                    setTimeout(function () {
                        location.reload(true);
                    }, 500);
                }
            });
        });

        $('.packing').click(function () {
            $id = $(this).prop('id').split("|");
            $order_id = $id[0];
            $courior = $id[1];
            $pay_method = $id[2];
            $('#pack_order_id').val($order_id);
            $("#courior").val($courior);
            $("#tracking_id").val("");
            if ($courior == '3') {
                // DTDC COURIOR 
                $.ajax({
                    url: "<?= site_url() ?>seller/order/getTrackingId",
                    type: "POST",
                    data: {courior: $courior, pay_method: $pay_method},
                    success: function (data, textStatus, jqXHR) {
                        $("#tracking_id").val(data);
                        $('#tracking_id').attr('readonly', 'true');
                    }
                });
            } else if ($courior == '2') {
                // INDIA POST COURIOR
                if ($pay_method == "cod") {
                    $.ajax({
                        url: "<?= site_url() ?>seller/order/getTrackingId",
                        type: "POST",
                        data: {courior: $courior, pay_method: $pay_method},
                        success: function (data, textStatus, jqXHR) {
                            $("#tracking_id").val(data);
                            $('#tracking_id').attr('readonly', 'true');
                        }
                    });
                } else {
                    $('#tracking_id').removeAttr('readonly');
                }
            }
        });

        $('#trackingconfirm').click(function () {
            if ($('#tracking_id').val() != "")
            {
                $('#packloader').show();
                $.ajax({
                    url: "<?= site_url() ?>seller/order/packOrder",
                    type: 'POST',
                    data: $('#trackingidform').serialize(),
                    success: function (data, textStatus, jqXHR) {
                        $('#packloader').hide();
                        alertify.success(data);
                        setTimeout(function () {
                            location.reload(true);
                        }, 1000);
                    }
                });
            } else {
                alertify.error("Please Enter Tracking Id");
            }
        });
    });
</script>
