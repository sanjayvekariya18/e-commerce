<style type="text/css">
    .order{
        background: white;
        padding: 10px;
        border: 2px solid #ff3366;
    }

    li{
        display: block !important;
        font-size: 13px;
        padding: 5px;
        border-bottom: 1px dashed #32c5d2;
    }

    h6{
        color:#ff3366;
    }

    h5{
        text-align: center;
        background: #ff3366;
        padding: 5px;
        margin: 5px;
        font-size: 14px;
        color: white;
    }
    table, thead, tbody, th, td, tr { 
        display: block; 
    }

    /* Hide table headers (but not display: none;, for accessibility) */
    thead tr { 
        position: absolute;
        top: -9999px;
        left: -9999px;
    }

    tr { border: 1px solid #ccc; }

    td { 
        /* Behave  like a "row" */
        border: none;
        border-bottom: 1px solid #eee; 
        position: relative;
        padding-left: 50%; 
    }

    td:before { 
        /* Now like a table header */
        position: absolute;
        /* Top/left values mimic padding */
        top: 6px;
        left: 6px;
        width: 45%; 
        padding-right: 10px; 
        white-space: nowrap;
    }
    td:nth-of-type(1):before { content: "Date/Time"; }
    td:nth-of-type(2):before { content: "Status"; }
    td:nth-of-type(3):before { content: "Description"; }
    td:nth-of-type(4):before { content: "Location"; }
</style>
<?php
if (isset($order)) {
    ?>
    <div class="order">        
        <div class="row c-margin-b-10">            
            <h5 style="margin: 5px 20px;">Order Details</h5>
            <div class="col-md-12">
                <div class="c-order-summary">
                    <ul class="c-list-inline list-inline">
                        <li>
                            <h6>Order Number</h6>
                            <p><?= isset($order->order_id) ? $order->order_id : '-' ?></p>
                        </li>  
                        <li>
                            <h6>Order Date</h6>
                            <p><?= isset($order->order_date) ? date('d F, Y h:i A', strtotime($order->order_date)) : '-' ?></p>
                        </li>  
                        <li>
                            <h6>Seller</h6>
                            <p><?= isset($order->business_name) ? $order->business_name : '-' ?></p>
                        </li>  
                        <li>
                            <h6>Amount</h6>
                            <p><?= isset($order->selling_price) ? $order->selling_price : '-' ?></p>
                        </li>  
                        <li>
                            <h6>Customer Name</h6>
                            <p><?= isset($order->first_name) ? $order->first_name . " " . $order->last_name : '-' ?> (<?= isset($order->primary_mobile) ? $order->primary_mobile : '-' ?>)</p>
                        </li>  
                        <li>
                            <h6>Address</h6>
                            <p><?= isset($order->address) ? $order->address . "," . $order->city . "," . $order->state_name . " - " . $order->pincode : '-' ?></p>
                        </li>  
                    </ul>
                </div>
                <div class="c-info-list">
                    <h5>Tracking Details</h5>
                    <table style="font-size: 12px;padding: 1px;">                            
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
                </div>
            </div>           
        </div>        
    <?php } ?> 
</div>