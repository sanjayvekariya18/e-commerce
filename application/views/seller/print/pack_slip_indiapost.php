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
    <?php
    if (isset($order)) {
        $cod_amount = 0;
        $paid_amount = 0;
        $weight = 0;

        $sold_by = $order->business_name;
        $customer_name = $order->first_name . " " . $order->last_name;
        $vat_no = $order->tin_id;
        $weight = $order->weight / 1000;
        if ($order->pay_method == 'cod') {
            $cod_amount += $order->payment_price;
        } else {
            $paid_amount += $order->payment_price;
        }
    }
    ?>
    <body>
        <table style="width: 100%;line-height: 15px;"   align="center">  
            <tr>
                <td colspan="2">
                    <table style="width: 100%;margin-top: 1%" class="consignor">                        
                        <tr>
                            <td style="text-align:center;width:80%">
                                <?php
                                if ($order->pay_method == 'cod') {
                                    ?>
                                    <h3 style="margin-top: 20px;">SPEED POST / COD (Cash On Delivery)</h3>
                                <?php } else { ?> 
                                    <h3 style="margin-top: 20px;">SPEED POST / PRE-PAID</h3>
                                <?php } ?>                                    
                            </td> 
                            <td><img src="<?= base_url() ?>assets/images/indiapost_logo.jpg" style="width:125px;height:65px;"/></td>
                        </tr>
                    </table>
                </td>
            </tr> 
            <?php
            if ($order->pay_method == 'cod') {
                ?>
                <tr>
                    <td colspan="2">
                        <table style="width: 100%;" class="consignor">                        
                            <tr>
                                <td style="text-align:center;padding-bottom: 5px;">
                                    <h3>For Rs.<?= $cod_amount ?> - Please Collect Rupees <?= $this->common->convert_digit_to_words($cod_amount) ?></h3>
                                </td> 
                            </tr>
                        </table>
                    </td>
                </tr> 
            <?php } ?>
            <tr>
                <td colspan="2">
                    <table style="width: 100%;margin-top: 1%" class="consignor">                        
                        <tr>
                            <td style="text-align:center;width:80%">
                                <table style="width:100%" >
                                    <tr>
                                        <td><h3 style="margin-top: 20px;">Barcode : </h3></td>
                                        <td style="text-align:center"><img src="http://barcodes4.me/barcode/c39/<?= isset($order->awb_no) ? $order->awb_no : '' ?>.png?width=500&height=100&&istextdrawn=1"/></td>
                                    </tr>
                                </table>
                            </td> 
                            <td style="text-align: center;font-weight: bold">Weight : <?= $weight ?> Kg</td>
                        </tr>
                    </table>
                </td>
            </tr> 
            <?php
            if ($order->pay_method == 'cod') {
                ?>
                <tr>
                    <td colspan="2">
                        <table style="width: 100%;" class="consignor">                        
                            <tr>
                                <td style="text-align:center;padding-bottom: 5px;">
                                    <h3>e Payment Biller Id : 6081, Payment Office : Surat Head Post Office.</h3>
                                </td> 
                            </tr>
                        </table>
                    </td>
                </tr> 
            <?php } ?>
            <tr>
                <td colspan="2">
                    <table style="width: 100%;border: 1px solid;">
                        <tr>
                            <td style="width:20%;padding-left: 20px;">                                
                                <h3>To,</h3>                                
                            </td>    
                            <td style="padding-left: 20px;">
                                <h4 style="margin-bottom: 0px;margin-left: 5px;margin-top: 10px"><?= isset($customer_name) ? $customer_name : '-' ?></h4>
                                <p><?= isset($order->address) ? $order->address . ", " . $order->landmark : '-' ?><br/>
                                    <?= isset($order->city) ? $order->city : '-' ?><br/>
                                    <?= isset($order->state) ? $this->common->getStateName($order->state) : '-' ?> - <?= isset($order->pincode) ? $order->pincode : '-' ?>
                                </p>
                                <p>Contact - <?= isset($order->customer_contact) ? $order->customer_contact : '-' ?></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table style="width: 100%;border: 1px solid;">
                        <tr>
                            <td style="width:20%;padding-left: 20px;">                                
                                <h3>From,</h3>                                
                            </td>    
                            <!-- <td style="padding-left: 20px;">                                
                                <h4 style="margin-bottom: 0px;margin-left: 5px;margin-top: 10px"><?= isset($sold_by) ? $sold_by : '-' ?></h4>                               
                                <p><?= isset($order->pickup_address) ? $order->pickup_address : '-' ?><br/>
                                    <?= isset($order->pickup_city) ? $order->pickup_city : '-' ?><br/>
                                    <?= isset($order->pickup_state) ? $this->common->getStateName($order->pickup_state) : '-' ?> - <?= isset($order->pickup_pincode) ? $order->pickup_pincode : '-' ?></p>
                                <p>Contact No : <?= isset($order->seller_contact) ? $order->seller_contact : '-' ?></p>
                            </td>-->
                            <td style="padding-left: 20px;">                                
                                <h4 style="margin-bottom: 0px;margin-left: 5px;margin-top: 10px">Shopking24</h4>                               
                                <p>104-Shyamdham Society, Near Shyamdham Mandir,<br/>
                                    Sarthana Jakatnaka,<br/>
                                    Surat-395006</p>
                                <p>Contact - 0261-6452111</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table style="width: 100%;margin-top: 1%" class="consignor">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Order ID</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total Price</th>                                
                                <th>COD</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($order)) {
                                $total_amount = 0;
                                $total_amount += $order->payment_price;
                                ?>   
                                <tr>
                                    <td style="padding: 5px;"><?= $order->product_name ?></td>
                                    <td style="padding: 5px;"><?= $order->order_id ?></td>
                                    <td style="padding: 5px;"><?= $order->qty ?></td>
                                    <td style="padding: 5px;">Rs. <?= $order->selling_price ?></td>
                                    <td style="padding: 5px;">Rs. <?= $order->total_price ?></td>                                        
                                    <td style="padding: 5px;">Rs. <?= $order->cod_charge ?></td>
                                    <td style="padding: 5px;">Rs. <?= $order->payment_price ?></td>
                                </tr>
                                <?php
                            }
                            ?>         
                            <tr>
                                <td colspan="7" style="text-align: right">
                                    <strong>Total Price : Rs. <?= isset($total_amount) ? $total_amount : '' ?></strong>
                                    <p>All value are in INR</p>
                                </td>
                            </tr>                            
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table style="width: 100%;border: 1px solid;">
                        <tr>                            
                            <td style="width:50%;padding-left: 20px;">                                
                                <h5 style="margin: 5px;">BDO/BNPL/SP/CC No : SRT-269.</h5>                                
                            </td>  
                        </tr>
                    </table>
                </td>
            </tr>
            <tr style="border-bottom: 2px dashed">
                <td colspan="2">
                    <h3>SHOPKING24.COM</h3>
                    <p>104-Shyamdham Society, Near Shyamdham Mandir, Sarthana Jakatnaka, Surat-395006<br>Phone:0261-6452111  Email:info@shopking24.com</p>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center">
                    "I hereby certify that this article do not contain any dangerous or prohibited goods according to Indian Post Office Act / Indian Post Rules"
                </td>
            </tr>
        </table>
    </body>
</html>
