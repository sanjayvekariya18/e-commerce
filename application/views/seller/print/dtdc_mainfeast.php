<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
$seller = $this->common->getSellerDataById($this->session->userdata('seller_id'));
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            table{
                width: 100%;
                border-collapse: collapse;
            }
            table tr th{
                border: 1px solid
            }
            table p{
                margin-bottom: 0;
                font-size: 16px;
            }
            table tr td:first-child{
                vertical-align: initial
            }
            .consignor tr,.consignor td{
                border: 1px solid;
            }
            p.box{
                padding: 1px;
                border: 1px solid;
            }
            p.signature{
                padding: 15px;
                border: 1px solid;
            }

            p{margin-bottom: 0;
              margin-top: 0px;
              padding: 5px;}

            h3{
                margin-top: 5px;
                padding: 5px;
                margin-bottom: 0px;
            }

        </style>
    </head>    
    <body>
        <table style="width: 100%;line-height: 15px;">  
            <tr style="border:1px solid">
                <td colspan="2">
                    <h3>SHOPKING24.COM</h3>
                    <p>104-Shyamdham Society, Near Shyamdham Mandir, Sarthana Jakatnaka, Surat-395006<br>Phone:0261-6452111  Email:info@shopking24.com</p>
                </td>
            </tr>
            <tr>
                <td style="border:1px solid">Vendor Name : <?= $seller->business_name ?></td>
                <td style="border:1px solid">Date Printed : <?= date('d-m-Y') ?></td>
            </tr>
            <tr>
                <td style="border:1px solid">Courier Name : DTDC</td>
                <td style="border:1px solid">Total Packages : <?= count($orders) ?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table style="width: 100%;margin-top: 1%" class="consignor">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Item Name</th>
                                <th>AWB No</th>
                                <th>Customer Name</th>                                
                                <th>Customer Mobile</th>
                                <th>Shipping State & Zip</th>
                                <th>Payment Method</th>
                                <th>Collectable Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($orders)) {
                                foreach ($orders as $order) {
                                    ?>   
                                    <tr>
                                        <td><?= $order->order_id ?></td>
                                        <td><?= $order->product_name ?></td>                                    
                                        <td><?= $order->awb_no ?></td>
                                        <td><?= $order->first_name . " " . $order->last_name ?></td>
                                        <td><?= $order->primary_mobile ?></td>                                        
                                        <td><?= $order->state . " " . $order->pincode ?></td>
                                        <td><?= $order->pay_method ?></td>
                                        <td><?= ($order->pay_method == 'cod') ? $order->payment_price : '0' ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>       
                        </tbody>
                    </table>
                </td>
            </tr>           
        </table>
    </body>
</html>
