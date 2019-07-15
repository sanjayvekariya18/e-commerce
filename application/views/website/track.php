<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="<?= site_url() ?>" title="Return to Home">Home</a>
            <span class="navigation-pipe">&nbsp;Tracking</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <div class="col-sm-12">
                <form method="POST" action="<?= site_url() ?>track/orderTrack">
                    <div class="form-group form-inline">
                        <input id="order_id" type="text" name="order_id" class="input form-control" placeholder="ENTER ORDER ID"  style="width:300px">
                        <input id="search" type="submit" name="Search" value="Search" class="input form-control" style="width:100px;background: #3c3c3c;color: #FFF">
                    </div>
                </form>
            </div>
        </div>   
        <hr>
        <div class="row">            
            <div class="center_column col-xs-12 col-sm-12" id="center_column">
                <table class="table table-bordered">
                    <tr>
                        <td width="150" style="text-transform: capitalize;">Order Id</td>
                        <td><?= isset($order->order_id) ? $order->order_id : '-' ?></td>
                    </tr>   
                    <tr>
                        <td width="150" style="text-transform: capitalize;">Order Date</td>
                        <td><?= isset($order->order_date) ? date('d F, Y h:i A', strtotime($order->order_date)) : '-' ?></td>
                    </tr>  
                    <tr>
                        <td width="150" style="text-transform: capitalize;">Customer</td>
                        <td><?= isset($order->first_name) ? $order->first_name . " " . $order->last_name : '-' ?> </td>
                    </tr>
                    <tr>
                        <td width="150" style="text-transform: capitalize;">Amount</td>
                        <td><?= isset($order->selling_price) ? $order->selling_price : '-' ?></td>
                    </tr>                    
                </table> 
                <table class="table table-bordered">
                    <thead>
                        <tr>                                    
                            <th>Date/Time</th>
                            <th>Status</th>
                            <th class="hidden-xs hidden-sm">Description</th>
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
                                    <td class="hidden-xs hidden-sm"><?= $val->description ?></td>                                
                                    <td><?= $val->location ?></td>                                
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>    
                </table>
            </div>
        </div>
    </div>
</div>