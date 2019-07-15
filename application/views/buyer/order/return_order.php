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
        <h2>Return Order Management</h2>

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
                        <a href="#pack_order" data-toggle="tab">Pack Order</a>
                    </li>
                    <li>
                        <a href="#pickup_order" data-toggle="tab">Pickup Order</a>
                    </li>
                    <li>
                        <a href="#download_slip" data-toggle="tab">Download Slip</a>
                    </li>
                    <li>
                        <a href="#completed" data-toggle="tab">Completed</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="pack_order" class="tab-pane active">
                        <div class="row">
                            <div class="col-md-12">  
                                <?php
                                if (isset($orders) && is_array($orders)) {
                                    foreach ($orders as $order) {
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
                                                                <span class="label label-danger">Return</span>
                                                            </div> 
                                                        </div>
                                                    </div>                                    
                                                    <div class="col-md-2" style="float:right;width: 14%;">
                                                        <div class="row">                                                             
                                                            <?php
                                                            if ($order->packing_by == 1) {
                                                                ?>
                                                                <div class="col-md-12" style="padding: 10px;">
                                                                    <button type="button" class="btn btn-primary pack_slip" style="margin-bottom: 15px;" value="<?= $order->order_id ?>">Pack Slip</button>
                                                                </div>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <div class="col-md-12" style="padding: 10px;">
                                                                    <a id="<?= $order->order_id ?>" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn-danger indiapost" href="#indiapost">Tracking Id</a>
                                                                </div>
                                                                <?php
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
                    <div id="pickup_order" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">  
                                <?php
                                if (isset($packuporders) && is_array($packuporders)) {
                                    foreach ($packuporders as $order) {
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
                                                                <span class="label label-danger">Return</span>
                                                            </div> 
                                                        </div>
                                                    </div>                                    
                                                    <div class="col-md-2" style="float:right;width: 14%;">
                                                        <div class="row">                                                             
                                                            <?php
                                                            if ($order->packing_by == 1) {
                                                                ?>
                                                                <div class="col-md-12" style="padding: 10px;">
                                                                    <button type="button" class="btn btn-primary pickup_slip" style="margin-bottom: 15px;" value="<?= $order->order_id ?>">Pick Up</button>
                                                                </div>                                                                
                                                                <?php
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
                    <div id="download_slip" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">  
                                <?php
                                if (isset($pickuporders) && is_array($pickuporders)) {
                                    foreach ($pickuporders as $order) {
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
                                                                <span class="label label-danger">Return</span>
                                                            </div> 
                                                        </div>
                                                    </div>                                    
                                                    <div class="col-md-2" style="float:right;width: 14%;">
                                                        <?php
                                                        if ($order->packing_by == '1') {
                                                            ?>
                                                            <div class="row">                                                             
                                                                <div class="col-md-12" style="padding: 10px;">
                                                                    <a target="_blank" href="<?= site_url() ?>buyer/order/downloadSlip?id=<?= base64_encode($order->order_id) ?>" class="btn btn-primary " style="margin-bottom: 15px;">Download Slip</a>
                                                                </div>  
                                                            </div>   
                                                            <?php
                                                        } else if ($order->packing_by == '3') {
                                                            ?>
                                                            <div class="row">                                                             
                                                                <div class="col-md-12" style="padding: 10px;">
                                                                    <a target="_blank" href="<?= site_url() ?>buyer/order/downloadDTDCSlip?id=<?= base64_encode($order->order_id) ?>" class="btn btn-primary " style="margin-bottom: 15px;">Download Slip</a>
                                                                </div>  
                                                            </div>   
                                                            <?php
                                                        }
                                                        ?>
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
                    <div id="completed" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">  
                                <?php
                                if (isset($completeorders) && is_array($completeorders)) {
                                    foreach ($completeorders as $order) {
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
                                                                <span class="label label-success">Return Complete</span>
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
                </div>
            </div>
        </div>
    </div>

    <!--India Post Model Start-->
    <div id="indiapost" class="zoom-anim-dialog modal-block modal-block-sm mfp-hide">
        <form id="modelindiapostform" method="POST" class="form-horizontal" >
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">India Post Tracking Id</h2>
                </header>
                <div class="panel-body">
                    <input type="hidden" id="indiapost_order_id" name="order_id" value=""/>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tracking Id</label>
                        <div class="col-md-9">
                            <input type="text" id="tracking_id" name="tracking_id" class="form-control"/>
                        </div>
                    </div>                    
                </div>                           
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button id="indiapostconfirm" type="button" class="btn btn-primary ">Confirm</button>
                            <button id="indiapostclose" class="btn btn-default modal-dismiss">Cancel</button>
                        </div>
                    </div>
                </footer>
            </section>
        </form>
    </div>
    <!--India Post Model End--> 
    <!-- end: page -->
    <div id="packloader" class="screenhide" style="display:none">
        <center>
            <img src="<?= base_url() ?>assets/images/loading_blue.gif" style="margin-top: 200px;width: 150px;height: 150px"/>
            <h3 class="page-heading-title2" style="color:#0088CC;font-size: 28px;margin-top: 50px;">Please Wait ..!!! We Are Generate Product Pack Slip...</h3>
        </center>
    </div>
</section>

<?php $msg = $this->input->get('msg'); ?>
<?php
switch ($msg) {
    case "R":
        $m = "Your Order Information Updated ..!";
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

        $('.pack_slip').click(function () {
            $('#packloader').css('display', 'block');
            $order_id = $(this).val();
            $.ajax({
                url: '<?= site_url() ?>buyer/order/packSlip',
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
                url: '<?= site_url() ?>buyer/order/pickupSlip',
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

        $('.indiapost').click(function () {
            $id = $(this).prop('id');
            $('#indiapost_order_id').val($id);
        });

        $('#indiapostconfirm').click(function () {
            if ($('#tracking_id').val() != "")
            {
                $.ajax({
                    url: "<?= site_url() ?>buyer/order/packSlipIndiaPost",
                    type: 'POST',
                    data: $('#modelindiapostform').serialize(),
                    success: function (data, textStatus, jqXHR) {
                        alertify.success("Your Order Is Packed");
                        setTimeout(function () {
                            location.reload(true);
                        }, 500);
                    }
                });
            } else {
                alertify.error("Please Enter Tracking Id");
            }
        });
    });
</script>
