<?php
if (isset($order->cart_id)) {
    $payumoney = $this->common->payumoneySetting();
    $cart_id = $order->cart_id;
    $customer_name = $order->first_name . " " . $order->last_name;
    $primary_email = $order->primary_email;
    $primary_mobile = $order->primary_mobile;
    $total_payment = $order->total;

    $MERCHANT_KEY = $payumoney->merchant_key; // Merchant key here as provided by Payu
    $SALT = $payumoney->merchant_salt;
    $txnid = $order->txn_id;
    $hashSequence = $MERCHANT_KEY . "|" . $txnid . "|" . $total_payment . "|" . $cart_id . "|" . $customer_name . "|" . $primary_email . "|||||||||||" . $SALT;
    $hash = strtolower(hash('sha512', $hashSequence));
    ?>
    <form action="https://test.payu.in/_payment" method="post" name="payuForm" id="payuForm">
        <input type="hidden" name="key" value="<?= $MERCHANT_KEY ?>" />
        <input type="hidden" name="hash" value="<?= $hash ?>"/>
        <input type="hidden" name="txnid" value="<?= $txnid ?>" />
        <input type="hidden" name="amount" value="<?= $total_payment ?>" />
        <input type="hidden" name="firstname" id="firstname" value="<?= $customer_name ?>" />
        <input type="hidden" name="email" id="email" value="<?= $primary_email ?>" />
        <input type="hidden" name="phone" value="<?= $primary_mobile ?>" />
        <input type="hidden" name="productinfo" value="<?= $cart_id ?>"/>	  
        <input type="hidden" name="surl" value="<?= site_url() ?>cart/appPaymentResponce" size="64" />
        <input type="hidden" name="furl" value="<?= site_url() ?>cart/appPaymentResponce" size="64" />
        <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
    </form>
<?php } ?>
<div class='row c-cart-table-row'>
    <h2 style='text-align:center'>Please Wait For Payment ...!!</h2>
</div>      
