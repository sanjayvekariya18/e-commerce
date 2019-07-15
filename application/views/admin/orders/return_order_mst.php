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
                    <a href="<?= site_url() ?>admin">
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
                        <a href="#intransite" data-toggle="tab">In Transite</a>
                    </li>                   
                    <li>
                        <a href="#completed" data-toggle="tab">Completed</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="intransite" class="tab-pane active">
                        <div class="row">
                            <div class="col-md-12">  
                                <?php
                                if (isset($intransite) && is_array($intransite)) {
                                    foreach ($intransite as $order) {
                                        ?>            
                                        <section class="panel panel-featured panel-featured-primary">
                                            <header class="panel-heading">
                                                <div class="panel-actions">
                                                    <a href="#" class="fa fa-caret-down"></a>
                                                </div>    
                                                <label class="labelorderid">ORDER ID</label>
                                                <a class="btn btn-success" name="order_id" href="#"><?= $order->order_id ?></a> 
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
                                                            <div class="col-md-12" style="padding: 10px;">
                                                                <?php
                                                                if ($order->packing_by == '1') {
                                                                    ?>
                                                                <a target="_blank" href="https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=<?= $order->awb_no ?>&cntry_code=in"><span class="btn btn-primary" style="width: 85px;">Track</span></a>
                                                                <?php
                                                                } else if ($order->packing_by == '2') {
                                                                    ?>
                                                                <a target="_blank" href="http://www.indiapost.gov.in/parcelnettracking.aspx"><span class="btn btn-primary" style="width: 85px;">Track</span></a>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>   
                                                    </div>
                                                    <div class="col-md-2" style="float:right;width: 14%;">
                                                        <div class="row">                                                             
                                                            <div class="col-md-12" style="padding: 10px;">
                                                                <a id="<?= $order->order_id ?>" class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn-danger completeorder" href="#completeorder">Complete</a>
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
                    <div id="completed" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">  
                                <?php
                                if (isset($completed) && is_array($completed)) {
                                    foreach ($completed as $order) {
                                        ?>            
                                        <section class="panel panel-featured panel-featured-primary">
                                            <header class="panel-heading">
                                                <div class="panel-actions">
                                                    <a href="#" class="fa fa-caret-down"></a>
                                                </div>    
                                                <label class="labelorderid">ORDER ID</label>
                                                <a class="btn btn-success" name="order_id" href="#"><?= $order->order_id ?></a> 
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

    <!--Complete Return Model Start-->
    <div id="completeorder" class="zoom-anim-dialog modal-block modal-block-sm mfp-hide">
        <form id="completeorderform" method="POST" class="form-horizontal" >
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Return Order Complete</h2>
                </header>
                <div class="panel-body">
                    <input type="hidden" id="return_order_id" name="order_id" value=""/>
                    <h5>Are You Sure To Complete This Order ? </h5>
                </div>                           
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button id="completeorderconfirm" type="button" class="btn btn-primary ">Confirm</button>
                            <button id="completeorderclose" class="btn btn-default modal-dismiss">Cancel</button>
                        </div>
                    </div>
                </footer>
            </section>
        </form>
    </div>
    <!--Complete Return Model End--> 
    <!-- end: page -->    
</section>

<script type="text/javascript">
    $(function() {

        $('.completeorder').click(function() {
            $id = $(this).prop('id');
            $('#return_order_id').val($id);
        });

        $('#completeorderconfirm').click(function() {
            $.ajax({
                url: "<?= site_url() ?>admin/order_return/updateReturnOrder",
                type: 'POST',
                data: $('#completeorderform').serialize(),
                success: function(data, textStatus, jqXHR) {
                    alertify.success("Your Order Is Completed..!");
                    setTimeout(function() {
                        location.reload(true);
                    }, 500);
                }
            });
        });
    });
</script>
