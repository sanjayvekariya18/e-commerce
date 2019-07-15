<section role="main" class="content-body">
    <header class="page-header">
        <h2>Track Order</h2>       
    </header>
    <!-- start: page -->
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
                                    <label class="text-dark" style="font-weight: bold"><?= isset($order->business_name) ? $order->business_name : '-' ?></label>
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
                                    <label class="text-dark" style="font-weight: bold"><label class="text-dark" style="font-weight: bold"><?= isset($order->first_name) ? $order->first_name . " " . $order->last_name : '-' ?> (<?= isset($order->primary_mobile) ? $order->primary_mobile : '-' ?>)</label></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="text-dark" style="font-weight: bold"><?= isset($order->address) ? $order->address . "," . $order->city . "," . $order->state_name . " - " . $order->pincode : '-' ?></label>
                                </div>
                            </div>
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
                    <h2 class="panel-title">Manage Order</h2>
                </header>
                <div class="panel-body">  
                    <div class="row">  
                        <?php
                        if ($order->order_status == 4) {
                            ?>   
                            <a href="<?= site_url() ?>buyer/track/printInvoice?id=<?= base64_encode($order->order_id) ?>" target="_blank">
                                <div class="col-md-6" style="border-right: 1px solid gray;text-align: center;">                           
                                    <i class="fa fa-print" style="font-size:45px"></i><br/>
                                    <label class="text-dark" style="font-weight: bold">PRINT INVOICE</label>
                                </div>
                            </a>
                        <?php } else {
                            ?>
                            <div class="col-md-6" style="border-right: 1px solid gray;text-align: center;">                           
                                <i class="fa fa-print" style="font-size:45px"></i><br/>
                                <label class="text-dark" style="font-weight: bold">PRINT INVOICE</label>
                            </div>
                        <?php }
                        ?>
                        <div class="col-md-6" style="border-right: 1px solid gray;text-align: center;">                           
                            <i class="fa fa-phone" style="font-size:45px"></i><br/>
                            <label class="text-dark" style="font-weight: bold">CONTACT US</label>
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
    <!-- end: page -->
</section>
