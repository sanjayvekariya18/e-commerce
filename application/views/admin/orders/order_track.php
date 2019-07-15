<section role="main" class="content-body">
    <header class="page-header">
        <h2>Track Order</h2>       
    </header>
    <!-- start: page -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Order Tracking Detail</h2>
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?= site_url() ?>admin/order_track/search">                       
                        <div class="form-group">
                            <label class="col-md-2 control-label">Order Number :- </label>
                            <div class="col-md-4">
                                <input id="order_id" name="order_id" type="text" class="form-control" required>
                            </div>
                            <div class="col-md-4" style="padding: 0px;margin-top: -5px;">
                                <button id="saveBtn" name="saveBtn" type="submit" class="mb-xs mt-xs mr-xs btn btn-success" style="width:100px" value="save">Save</button>
                            </div>
                        </div>                                                                       

                    </form>
                </div>
            </section>
        </div>
    </div>   
    <?php
    if (isset($order)) {
        if (isset($order->order_id)) {
            ?>
            <div class="row">
                <div class="col-md-12">             
                    <section class="panel panel-featured panel-featured-primary">
                        <header class="panel-heading">
                            <h2 class="panel-title">Order Detail</h2>
                        </header>
                        <div class="panel-body">  
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="text-dark" style="font-weight: bold">Order ID :- </label>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="text-dark" style="font-weight: bold"><?= isset($order->order_id) ? $order->order_id : '-' ?></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="text-dark" style="font-weight: bold">Seller :- </label>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="text-dark" style="font-weight: bold"><?= isset($order->business_name) ? $order->business_name : '-' ?> (<?= isset($order->seller_mobile) ? $order->seller_mobile : '-' ?>) </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="text-dark" style="font-weight: bold">Order Date :- </label>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="text-dark" style="font-weight: bold"><?= isset($order->order_date) ? date('d F, Y h:i A', strtotime($order->order_date)) : '-' ?></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="text-dark" style="font-weight: bold">Amount :- </label>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="text-dark" style="font-weight: bold"><?= isset($order->selling_price) ? $order->selling_price : '-' ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="text-dark" style="font-weight: bold"><label class="text-dark" style="font-weight: bold"><?= isset($order->first_name) ? $order->first_name . " " . $order->last_name : '-' ?> (<?= isset($order->customer_mobile) ? $order->customer_mobile : '-' ?>)</label></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="text-dark" style="font-weight: bold"><?= isset($order->address) ? $order->address . "," . $order->city . "," . $order->state_name . " - " . $order->pincode : '-' ?></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="text-dark" style="font-weight: bold">AWB No :- </label>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="text-dark" style="font-weight: bold"><?= isset($order->awb_no) ? $order->awb_no : '-' ?></label>
                                        </div>
                                    </div>  
                                    <?php if($order->return_awb_no !=""){ ?>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="text-dark" style="font-weight: bold">Return AWB No :- </label>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="text-dark" style="font-weight: bold"><?= $order->return_awb_no?></label>
                                        </div>
                                    </div> 
                                    <?php } ?>
                                </div>
                            </div>                      
                        </div>
                    </section>
                </div>
            </div>  
            <div class="row">
                <div class="col-md-12">             
                    <section class="panel panel-featured panel-featured-primary">
                        <header class="panel-heading">
                            <h2 class="panel-title">Product Details</h2>
                        </header>
                        <div class="panel-body">                   
                            <!--Dynamic Table-->
                            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                                <thead>
                                    <tr>                                    
                                        <th>Product Name</th>
                                        <th>Selling Price</th>
                                        <th>Weight</th>                               
                                        <th>Qty</th>                               
                                        <th>Total Price</th>                               
                                        <th>Discount</th>                               
                                        <th>Cod Charge</th>                               
                                        <th>Payment</th>                               
                                        <th>Payment Type</th>                               
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $order->product_name ?></td>
                                        <td><?= $order->selling_price ?></td>
                                        <td><?= $order->weight/1000 ?>(KG)</td>
                                        <td><?= $order->qty?></td>
                                        <td><?= $order->total_price?></td>
                                        <td><?= $order->discount_price?></td>
                                        <td><?= $order->cod_charge?></td>
                                        <td><?= $order->payment_price?></td>
                                        <td><?= $order->pay_method?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <!--Dynamic End-->   
                        </div>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">             
                    <section class="panel panel-featured panel-featured-primary">
                        <header class="panel-heading">
                            <h2 class="panel-title">Shipment History</h2>
                        </header>
                        <div class="panel-body">                   
                            <!--Dynamic Table-->
                            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                                <thead>
                                    <tr>                                    
                                        <th>Date/Time</th>
                                        <th>Status</th>
                                        <th>Description</th>
                                        <th>Location</th>                               
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($orderstatus)) {
                                        foreach ($orderstatus as $val) {
                                            ?>
                                            <tr>
                                                <td><?= date('d/m/Y h:i A', strtotime($val->status_date)) ?></td>
                                                <td><?= $val->track_status ?></td>
                                                <td><?= $val->description ?></td>                                
                                                <td><?= $val->location ?></td>                                
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <!--Dynamic End-->   
                        </div>
                    </section>
                </div>
            </div>
        <?php } else { ?>
            <div class="row">
                <div class="col-md-12">             
                    <section class="panel panel-featured panel-featured-primary" style="border: 2px solid #0088cc;">
                        <header class="panel-heading">
                            <h2 class="panel-title" style="text-align: center;">No Order Found</h2>
                        </header>                    
                    </section>
                </div>
            </div>  
        <?php }
    }
    ?>
    <!-- end: page -->
</section>