<style type="text/css">
    .screenhide{
        position: absolute;
        width: 100%;        
        z-index: 99999;
        opacity: 1;
        background-color: transparent;
        top: 0;
    }
</style> 
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
}
?>
<html>  
    <body>        
        <form action="https://test.payu.in/_payment" method="post" name="payuForm" id="payuForm">
            <input type="hidden" name="key" value="<?= $MERCHANT_KEY ?>" />
            <input type="hidden" name="hash" value="<?= $hash ?>"/>
            <input type="hidden" name="txnid" value="<?= $txnid ?>" />
            <input type="hidden" name="amount" value="<?= $total_payment ?>" />
            <input type="hidden" name="firstname" id="firstname" value="<?= $customer_name ?>" />
            <input type="hidden" name="email" id="email" value="<?= $primary_email ?>" />
            <input type="hidden" name="phone" value="<?= $primary_mobile ?>" />
            <input type="hidden" name="productinfo" value="<?= $cart_id ?>"/>	  
            <input type="hidden" name="surl" value="<?= site_url() ?>cart/paymentResponce" size="64" />
            <input type="hidden" name="furl" value="<?= site_url() ?>cart/paymentResponce" size="64" />
            <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
        </form>
        <div style="height:500px;">    
        </div>
        <div id="paymentloader" class="screenhide" style="display:none">
            <center>
                <img src="<?= base_url() ?>assets/images/loading_pink.gif" style="margin-top: 250px;width: 100px;height: 100px"/>
                <h3 class="page-heading-title2" style="color:#FF3366;font-size: 28px;margin-top: 50px">Please Do not press "Reload", "Refresh", "Back" buttons until we redirect to PayUMoney.</h3>
            </center>
        </div>
    </body>
</html>
<script type="text/javascript" src="<?= base_url() ?>webassets/lib/jquery/jquery-1.11.2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $status = "<?= isset($order->cart_id) ? '1' : '0' ?>";
        if ($status == 1) {
            $('#paymentloader').css('display', 'block');
            $('#payuForm').submit();
        }
    });
</script>