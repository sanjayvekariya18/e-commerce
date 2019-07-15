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
            table p{
                margin-bottom: 0
            }
            table tr td:first-child{
                vertical-align: initial
            }
        </style>
    </head>
    <body>        
        <table style="width: 100%;" align="center">
            <tr>
                <td style="text-align: center">
                    <h1>Retail Invoices/Bill</h1>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <p style="border: 1px dashed;padding: 5px;width: 40%;">
                        <strong>Invoice No :</strong> <?= isset($order->invoice_id) ? $order->invoice_id : '' ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <span style="font-size: 27px;font-weight: bolder">Sold By</span> : 
                    <strong><?= isset($seller->business_name) ? $seller->business_name : '' ?></strong><br/>
                    <p>
                        <i>Warehouse Address : </i> 
                        <?= isset($seller->pickup_address) ? $seller->pickup_address : '' ?>,<?= isset($seller->pickup_city) ? $seller->pickup_city : '' ?>,<?= isset($seller->pickup_state) ? $this->common->getStateName($seller->pickup_state) : '' ?> - <?= isset($seller->pickup_pincode) ? $seller->pickup_pincode : '' ?>
                    </p>
                </td>
            </tr>
        </table>
        <hr />
        <table style="width: 100%;">
            <tr>
                <td>
                    <strong>Order ID: <?= isset($order->order_id) ? $order->order_id : '' ?></strong><br/>
                    <strong>Order Date: </strong><?= isset($order->order_date) ? date('d F, Y h:i A', strtotime($order->order_date)) : '' ?><br/>
                    <strong>Invoice Date: </strong><?= isset($order->order_date) ? date('d F, Y h:i A', strtotime($order->order_date)) : '' ?><br/>
                    <strong>VAT/TIN : </strong><?= isset($seller->tin_id) ? $seller->tin_id : '' ?><br/>
                    <strong>Service tax # : </strong>
                </td>
                <td>
                    <strong>Biliing Address</strong><br/>
                    <i><?= isset($customer->first_name) ? $customer->first_name : '' ?> <?= isset($customer->last_name) ? $customer->last_name : '' ?></i><br/>
                    <?= isset($customer->address) ? $customer->address : '' ?><br/>                    
                    <?= isset($customer->city) ? $customer->city : '' ?> ,<?= isset($customer->state) ? $this->common->getStateName($customer->state) : '' ?> <?= isset($customer->pincode) ? $customer->pincode : '' ?> .<br/>
                    Phone: <?= isset($customer->primary_mobile) ? $customer->primary_mobile : '' ?><br/>
                </td>
                <td>
                    <strong>Shipping Address</strong><br/>
                    <i><?= isset($customer->first_name) ? $customer->first_name : '' ?> <?= isset($customer->last_name) ? $customer->last_name : '' ?></i><br/>
                    <?= isset($customer->address) ? $customer->address : '' ?><br/>                    
                    <?= isset($customer->city) ? $customer->city : '' ?> ,<?= isset($customer->state) ? $this->common->getStateName($customer->state) : '' ?> <?= isset($customer->pincode) ? $customer->pincode : '' ?> .<br/>
                    Phone: <?= isset($customer->primary_mobile) ? $customer->primary_mobile : '' ?><br/>
                </td>
                <td>
                    <p>
                        <i>
                            *Keep this invoice and<br/>
                            manufacturer box for<br/>
                            warranty purposes.
                        </i>
                    </p>
                </td>
            </tr>
        </table>
        <table style="width: 100%;margin-top: 2%">
            <thead>
                <tr style="border-top: 1px solid;border-bottom: 1px solid;">
                    <th style="text-align: left">Product</th>
                    <th style="text-align: right">Qty</th>
                    <th style="text-align: right">Price(Rs.)</th>
                    <th style="text-align: right">Total</th>
                </tr>
            </thead>
            <tr style="border-bottom: 1px solid;">
                <td style="text-align: left"><?= isset($order->product_name) ? $order->product_name : '' ?></td>
                <td style="text-align: right"><?= isset($order->qty) ? $order->qty : '' ?></td>
                <td style="text-align: right"><?= isset($order->selling_price) ? $order->selling_price : '' ?></td>
                <td style="text-align: right"><?= isset($order->selling_price) ? $order->selling_price : '' ?></td>
            </tr>           
            <tr align="right">
                <td>Total</td>
                <td><strong><?= isset($order->qty) ? $order->qty : '' ?></strong></td>
                <td><strong><?= isset($order->total_price) ? $order->total_price : '' ?></strong></td>
                <td><strong><?= isset($order->total_price) ? $order->total_price : '' ?></strong></td>
            </tr>
            <tr align="right" style="border-top: 1px solid;border-bottom: 1px solid;">
                <td colspan="3"><strong>Grand Total</strong></td>
                <td><strong><?= isset($order->total_price) ? $order->total_price : '' ?></strong></td>
            </tr>
        </table>
        <p style="text-align: center;margin: 0">*This is a computer generated invoice.</p>
        <p style="text-align: right;margin-top: -2%;">
            <?= isset($seller->business_name) ? $seller->business_name : '' ?> <br/><br/><br/><br/><br/>(Authorized Signatory)
        </p>        
    </body>
</html>
<script src="<?= base_url() ?>assets/vendor/jquery/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        window.print();
    });
</script>

