<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            body{
                font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;    
                font-size: 10px;
            }
            table{       
                width:100%;
                border:1px solid;
                border-collapse: collapse;
                text-align: center;
            }
            td,th{
                border: 1px solid;
            }
        </style>
    </head>
    <body>   
        <h3 style="text-align: center;font-size: 20px;margin: 0">SHOPKING24</h3>
        <h3 style="text-align: center;font-size: 16px;margin: 10px;">CA REPORT</h3>
        <table>
            <thead>
                <tr>                                    
                    <th>Date</th>
                    <th>Order Id</th>
                    <th>Status</th>
                    <th>Seller Name</th>
                    <th>Buyer Name</th>
                    <th>Selling Price</th>
                    <th>Income</th>
                    <th>Expense</th>
                    <th>Service Tax</th>
                </tr>
            </thead>
            <tbody> 
                <?php
                if (isset($orders)) {
                    foreach ($orders as $order) {
                        $income = ($order->commission_fee + $order->payment_fee) * $order->qty;
                        $tdiscount = $order->total_price - $order->payment_price + $order->cod_charge;
                        ?>
                        <tr>
                            <td style="width:80px;"><?= date("d-m-Y", strtotime($order->order_date)) ?></td>
                            <td><?= $order->order_id ?></td>
                            <td>                                                
                                <?php if ($order->order_status == 4) { ?>
                                    <span class="label label-success">Delivery</span>
                                <?php } else if ($order->order_status == 5) { ?>
                                    <span class="label label-warning">Refund</span>                                                
                                <?php } else if ($order->order_status == 7) { ?>
                                    <span class="label label-default">Replacement</span>
                                <?php } else if ($order->order_status == 8) { ?>
                                    <span class="label label-danger">Shipped Cancel</span>
                                <?php } else if ($order->order_status == 9) { ?>
                                    <span class="label label-success">Refund Paid</span>
                                <?php } ?>
                            </td>
                            <td><?= $order->business_name ?></td>
                            <td><?= $order->first_name . " " . $order->last_name ?></td>
                            <td><?= $order->selling_price ?></td>
                            <td><i class="fa fa-rupee"></i> <?= $income ?></td>
                            <td><i class="fa fa-rupee"></i> <?php
                                if ($order->order_status == '5' || $order->order_status == '7' || $order->order_status == '8' || $order->order_status == '9') {
                                    echo $tdiscount + $order->cod_charge + ($order->cod_charge * 14.5 / 100 );
                                } else {
                                    echo $tdiscount;
                                }
                                ?>
                            </td>                                            
                            <td><i class="fa fa-rupee"></i> <?= $income * 14.5 / 100 ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </body>
</html>
<script src="<?= base_url() ?>assets/vendor/jquery/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        window.print();
    });
</script>

