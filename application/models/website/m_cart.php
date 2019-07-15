<?php

class M_cart extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('parser');
    }

    //------------------------------------ ADD NEW ORDER --------------------------------------

    function addOrder() {
        if (isset($_POST)) {
            $data = $_POST;
            $customer_id = "";
            if ($data['login_status'] == 0) {
                $customer_id = $this->common->addCustomer($data);
                $this->sendSignupMailToBuyer($data);
            } else {
                $this->common->updateCustomer($data);
                $customer_id = $this->wcommon->getCustomerId(str_replace(" ", "+", $data['login_email']));
                $customer = $this->common->getCustomerDataById($customer_id);
            }

            $product = $this->wcommon->getCartProduct();
            $session = $this->session->userdata('product');
            $cart_id = $this->getMaxCartId();
            $txn_id = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
            $mail_product = array();
            if (isset($product) && is_array($product)) {
                foreach ($product as $val) {
                    $order_id = $this->getMaxOrderId();
                    $invoice_id = $this->getMaxInvoiceId();
                    $total_amount = $val->selling_price * $session[$val->product_id]['qty'];
                    $total_settlement_amount = $val->settlement_price * $session[$val->product_id]['qty'];
                    $total_discount = 0;
                    $pay_amount = 0;
                    if (isset($session[$val->product_id]['coupon'])) {
                        if ($session[$val->product_id]['coupon'] != "") {
                            $coupon_code = $session[$val->product_id]['coupon'];
                            $coupondata = $this->getCouponData($coupon_code);
                            if ($coupondata->type == '0') {
                                $total_discount = $coupondata->value * $session[$val->product_id]['qty'];
                                $pay_amount = $total_amount - $total_discount;
                            } else if ($coupondata->type == '1') {
                                $total_discount = ($total_amount * $coupondata->value) / 100;
                                $pay_amount = $total_amount - $total_discount;
                            }
                        } else {
                            $pay_amount = $total_amount;
                        }
                    } else {
                        $pay_amount = $total_amount;
                    }

                    $shipping_charge = $val->shipping_charge * $session[$val->product_id]['qty'];
                    $shipping_extra_charge = $shipping_charge * 14.5 / 100;
                    $shipping_charge += $shipping_extra_charge;
                    $cod_charge = 0;


                    if (isset($customer)) {

                        $today_date = time();
                        $bonus_limit_date = $customer->bonus_limit_date;
                        $balance = $customer->balance;

                        if ($bonus_limit_date > $today_date) {
                            $pay_amount = $pay_amount - $balance;
                            $this->db->update('customer_mst', array('balance' => '0'), array('customer_id' => $customer->customer_id));
                        }
                    }

                    if ($data['pay_method'] == "cod") {
                        $cod_charge = $session[$val->product_id]['cod_charge'];
                        $pay_amount = $pay_amount + $cod_charge;
                    }

                    $order = array(
                        'cart_id' => $cart_id,
                        'order_id' => $order_id,
                        'ref_order_id' => $order_id,
                        'invoice_id' => $invoice_id,
                        'txn_id' => $txn_id,
                        'customer_id' => $customer_id,
                        'seller_id' => $val->seller_id,
                        'product_id' => $val->product_id,
                        'product_name' => $val->product_name,
                        'image_thumb' => $val->image_thumb,
                        'image_medium' => $val->image_medium,
                        'brand' => $val->brand,
                        'style_code' => $val->style_code,
                        'sku' => $val->sku,
                        'mrp' => $val->mrp,
                        'selling_price' => $val->selling_price,
                        'weight' => $val->weight,
                        'shipping_time' => $val->shipping_time,
                        'colour' => ($session[$val->product_id]['colour_id'] != "") ? $this->wcommon->getVariationName($session[$val->product_id]['colour_id']) : "",
                        'qty' => $session[$val->product_id]['qty'],
                        'size' => ($session[$val->product_id]['size'] != "") ? $this->wcommon->getVariationName($session[$val->product_id]['size']) : "",
                        'total_price' => $total_amount,
                        'discount_price' => $total_discount,
                        'shipping_charge' => $shipping_charge,
                        'cod_charge' => $cod_charge,
                        'payment_price' => $pay_amount,
                        'coupon_code' => isset($session[$val->product_id]['coupon']) ? $session[$val->product_id]['coupon'] : '',
                        'pay_method' => $data['pay_method'],
                        'payment_status' => ($data['pay_method'] == "cod") ? "1" : "0",
                        'order_date' => date('Y-m-d H:i:s')
                    );

                    $order_notify = array(
                        'order_id' => $order_id,
                        'seller_id' => $val->seller_id,
                        'total_price' => $pay_amount,
                        'order_status' => '1',
                        'notify_date' => date('Y-m-d H:i:s')
                    );

                    $mail_product[] = array(
                        'order_id' => $order_id,
                        'product_name' => $val->product_name,
                        'selling_price' => $val->selling_price,
                        'qty' => $session[$val->product_id]['qty'],
                        'total_price' => $total_amount
                    );

                    $transaction = array(
                        'order_id' => $order_id,
                        'order_date' => date('Y-m-d H:i:s'),
                        'selling_price' => $total_amount,
                        'settlement_price' => $total_settlement_amount,
                        'shipping_charge' => $shipping_charge,
                        'cod_charge' => $cod_charge
                    );

                    $order_status = array(
                        'order_id' => $order_id,
                        'txn_id' => $txn_id,
                        'track_status' => "Approved",
                        'description' => "Your Order Is Approved",
                        'location' => $this->common->getSellerDataByID($val->seller_id)->pickup_city,
                        'status_date' => date('Y-m-d H:i:s')
                    );

                    $this->db->insert('order_mst', $order);
                    $this->db->insert('order_status_mst', $order_status);

                    if ($data['pay_method'] == "cod") {
                        $this->updateQuantity($val->product_id, $session[$val->product_id]['qty']);
                        $this->db->insert('transaction_mst', $transaction);
                        $this->db->insert('order_notify_mst', $order_notify);
                    }
                }

                // ONLY COD PAYMENT METHOD ORDER NOTIFICATION SEND HEAR.

                if ($data['pay_method'] == "cod") {
                    $this->sendMailToBuyer($customer_id, $mail_product);
                    $this->sendMailToSeller($val->seller_id, $mail_product);
                }
            }
            $this->session->unset_userdata('product');
        }
        return $cart_id;
    }

    //---------------------------------  PAYMENT RESPONCE  ---------------------------------

    function paymentResponce() {
        $payumoney = $this->common->payumoneySetting();
        $status = $_POST["status"];
        $firstname = $_POST["firstname"];
        $amount = $_POST["amount"];
        $txnid = $_POST["txnid"];
        $posted_hash = $_POST["hash"];
        $key = $_POST["key"];
        $productinfo = $_POST["productinfo"];
        $email = $_POST["email"];
        $salt = $payumoney->merchant_salt;

        If (isset($_POST["additionalCharges"])) {
            $additionalCharges = $_POST["additionalCharges"];
            $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        } else {
            $retHashSeq = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        }
        $hash = hash("sha512", $retHashSeq);
        if ($hash == $posted_hash) {
            if ($status == "success") {
                $orders = $this->getOrderDataByTxnId($productinfo, $txnid);
                foreach ($orders as $val) {
                    $product_id = $val->product_id;
                    $product = $this->common->getProductById($product_id);

                    $order_notify = array(
                        'order_id' => $val->order_id,
                        'seller_id' => $val->seller_id,
                        'total_price' => $val->total_price,
                        'order_status' => '1',
                        'notify_date' => date('Y-m-d H:i:s')
                    );

                    $mail_product[] = array(
                        'order_id' => $val->order_id,
                        'product_name' => $val->product_name,
                        'selling_price' => $val->selling_price,
                        'qty' => $val->qty,
                        'total_price' => $val->total_price
                    );

                    $transaction = array(
                        'order_id' => $val->order_id,
                        'order_date' => date('Y-m-d H:i:s'),
                        'selling_price' => $product->selling_price * $val->qty,
                        'settlement_price' => $product->settlement_price * $val->qty,
                        'shipping_charge' => $val->shipping_charge,
                        'cod_charge' => $val->cod_charge
                    );
                    if ($val->payment_status == 0) {
                        $this->db->update('order_mst', array('payment_status' => '1'), array('order_id' => $val->order_id));
                        $this->updateQuantity($val->product_id, $val->qty);
                        $this->db->insert('transaction_mst', $transaction);
                        $this->db->insert('order_notify_mst', $order_notify);
                    }
                }
                $this->sendMailToBuyer($val->customer_id, $mail_product);
                $this->sendMailToSeller($val->seller_id, $mail_product);
                return "1|" . $val->cart_id;
            } else {
                $this->db->delete('order_mst', array('cart_id' => $productinfo, 'txn_id' => $txnid));
                $this->db->delete('order_status_mst', array('txn_id' => $txnid));
                return 0;
            }
        }
    }

    function getOrderDataByTxnId($cart_id, $txn_id) {
        $where = array(
            'cart_id' => $cart_id,
            'txn_id' => $txn_id
        );
        $query = $this->db->get_where('order_mst', $where);
        return $query->result();
    }

    //--------------------------------- REPLACE ORDER DETAIL -------------------------------

    function replaceOrder($order_id) {

        $oldorder = $this->common->getOrderById($order_id);
        $new_cart_id = $this->getMaxCartId();
        $new_order_id = $this->getMaxOrderId();
        $new_invoice_id = $this->getMaxInvoiceId();
        $product = $this->common->getProductById($oldorder->product_id);

        $order = array(
            'cart_id' => $new_cart_id,
            'order_id' => $new_order_id,
            'ref_order_id' => $oldorder->ref_order_id,
            'invoice_id' => $new_invoice_id,
            'txn_id' => $oldorder->txn_id,
            'customer_id' => $oldorder->customer_id,
            'seller_id' => $oldorder->seller_id,
            'product_id' => $oldorder->product_id,
            'product_name' => $oldorder->product_name,
            'image_thumb' => $oldorder->image_thumb,
            'image_medium' => $oldorder->image_medium,
            'brand' => $oldorder->brand,
            'style_code' => $oldorder->style_code,
            'sku' => $oldorder->sku,
            'mrp' => $oldorder->mrp,
            'selling_price' => $oldorder->selling_price,
            'weight' => $oldorder->weight,
            'shipping_time' => $oldorder->shipping_time,
            'colour' => $oldorder->colour,
            'qty' => $oldorder->qty,
            'size' => $oldorder->size,
            'total_price' => $oldorder->total_price,
            'discount_price' => $oldorder->discount_price,
            'shipping_charge' => $oldorder->shipping_charge,
            'cod_charge' => $oldorder->cod_charge,
            'payment_price' => $oldorder->payment_price,
            'coupon_code' => $oldorder->coupon_code,
            'pay_method' => $oldorder->pay_method,
            'payment_status' => $oldorder->payment_status,
            'order_date' => date('Y-m-d H:i:s')
        );

        $replace_order_notify = array(
            'order_id' => $order_id,
            'seller_id' => $oldorder->seller_id,
            'total_price' => $oldorder->payment_price,
            'order_status' => '7',
            'notify_date' => date('Y-m-d H:i:s')
        );

        $order_notify = array(
            'order_id' => $new_order_id,
            'seller_id' => $oldorder->seller_id,
            'total_price' => $oldorder->payment_price,
            'order_status' => '1',
            'notify_date' => date('Y-m-d H:i:s')
        );

        $mail_product[] = array(
            'order_id' => $order_id,
            'product_name' => $oldorder->product_name,
            'selling_price' => $oldorder->selling_price,
            'qty' => $oldorder->qty,
            'total_price' => $oldorder->total_price
        );

        $old_transaction = array(
            'shipping_charge' => $oldorder->shipping_charge * 2,
        );

        $transaction = array(
            'order_id' => $new_order_id,
            'order_date' => date('Y-m-d H:i:s'),
            'selling_price' => $oldorder->selling_price,
            'settlement_price' => $product->settlement_price * $oldorder->qty,
            'shipping_charge' => $oldorder->shipping_charge,
            'cod_charge' => $oldorder->cod_charge
        );

        $order_status = array(
            'order_id' => $new_order_id,
            'txn_id' => $oldorder->txn_id,
            'track_status' => "Approved",
            'description' => "Your Order Is Approved",
            'location' => $this->common->getSellerDataByID($oldorder->seller_id)->pickup_city,
            'status_date' => date('Y-m-d H:i:s')
        );

        $this->db->insert('order_mst', $order);
        $this->db->insert('order_status_mst', $order_status);
        $this->db->insert('transaction_mst', $transaction);
        $this->db->update('transaction_mst', $old_transaction, array('order_id' => $order_id));
        $this->db->insert('order_notify_mst', $order_notify);
        $this->db->insert('order_notify_mst', $replace_order_notify);
        $this->updateQuantity($oldorder->product_id, $oldorder->qty);

        $this->sendMailToBuyer($oldorder->customer_id, $mail_product);
        $this->sendMailToSeller($oldorder->seller_id, $mail_product);

        return 1;
    }

    // ------------------------- SIGN UP MAIL + SMS TO NEW BUYER ---------------------------

    function sendSignupMailToBuyer($data) {
        $templateInfo = $this->common->getMailTemplate("WELCOME E-MAIL", "Buyer");
        $smstemplateInfo = $this->common->getSmsTemplate("WELCOME SMS", "Buyer");
        $tag = array(
            'FIRST_NAME' => $data['first_name'],
            'LAST_NAME' => $data['last_name'],
            'USER_ID' => $data['primary_email'],
            'PASSWORD' => $data['password']
        );

        //EMAIL CODE

        $subject = $this->parser->parse_string($templateInfo->mail_subject, $tag, TRUE);
        $from = ($templateInfo->from != "") ? $templateInfo->from : NULL;
        $name = ($templateInfo->name != "") ? $templateInfo->name : NULL;
        $to = $data['primary_email'];
        $this->load->view('email_format', $templateInfo, TRUE);
        $body = $this->parser->parse('email_format', $tag, TRUE);
        $this->common->sendEmail($from, $to, $subject, $body, $name);

        // SMS CODE

        $message = $this->parser->parse_string($smstemplateInfo->message, $tag, TRUE);
        $to_mobile = $data['primary_mobile'];
        $this->common->SMSSend($to_mobile, $message, true);
    }

    // ----------------------- SEND ORDER INFO MAIL + SMS TO BUYER ---------------------------

    function sendMailToBuyer($customer_id, $mail_product) {
        $customer = $this->common->getCustomerDataById($customer_id);
        $templateInfo = $this->common->getMailTemplate("ORDER PLACED", "Buyer");
        $smstemplateInfo = $this->common->getSmsTemplate("ORDER PLACED", "Buyer");
        $product_name = "";
        $order_id = "";

        $link = "<table border='1' align='center' cellpadding='5' cellspacing='2' width='100%' style='border-collapse: collapse;border-spacing: 0;'>";
        $link .= "<tr>";
        $link .= "<th>Order ID </th>";
        $link .= "<th>Product Name </th>";
        $link .= "<th>Price </th>";
        $link .= "<th>Qty </th>";
        $link .= "<th>Total </th>";
        $link .= "</tr>";

        if (isset($mail_product) && is_array($mail_product)) {
            foreach ($mail_product as $val) {
                $link .= "<tr>";
                $link .= "<td>" . $val['order_id'] . "</td>";
                $link .= "<td>" . $val['product_name'] . "</td>";
                $link .= "<td>" . $val['selling_price'] . "</td>";
                $link .= "<td>" . $val['qty'] . "</td>";
                $link .= "<td>" . $val['total_price'] . "</td>";
                $link .= "</tr>";
                $product_name .= substr($val['product_name'], 0, 30) . "..";
                $order_id = $val['order_id'];
            }
        }
        $link .= "</table>";

        $email_tag = array(
            'FIRST_NAME' => $customer->first_name,
            'LAST_NAME' => $customer->last_name,
            'PRODUCT_DETAILS' => $link
        );

        $sms_tag = array(
            'FIRST_NAME' => $customer->first_name,
            'LAST_NAME' => $customer->last_name,
            'PRODUCT_NAME' => $product_name,
            'ORDER_ID' => $order_id
        );

        //EMAIL CODE

        $subject = $this->parser->parse_string($templateInfo->mail_subject, $email_tag, TRUE);
        $from = ($templateInfo->from != "") ? $templateInfo->from : NULL;
        $name = ($templateInfo->name != "") ? $templateInfo->name : NULL;
        $to = $customer->primary_email;
        $this->load->view('email_format', $templateInfo, TRUE);
        $body = $this->parser->parse('email_format', $email_tag, TRUE);
        $this->common->sendEmail($from, $to, $subject, $body, $name);

        //SMS CODE

        $message = $this->parser->parse_string($smstemplateInfo->message, $sms_tag, TRUE);
        $to_mobile = $customer->primary_mobile;
        $this->common->SMSSend($to_mobile, $message, true);
    }

    // ----------------------- SEND ORDER INFO MAIL + SMS TO SELLER ---------------------------

    function sendMailToSeller($seller_id, $mail_product) {
        $seller = $this->common->getSellerDataById($seller_id);
        $templateInfo = $this->common->getMailTemplate("NEW ORDER", "Seller");
        $smstemplateInfo = $this->common->getSmsTemplate("NEW ORDER", "Seller");
        $product_name = "";
        $order_id = "";

        $link = "<table border='1' align='center' cellpadding='5' cellspacing='2' width='100%' style='border-collapse: collapse;border-spacing: 0;'>";
        $link .= "<tr>";
        $link .= "<th>Order ID </th>";
        $link .= "<th>Product Name </th>";
        $link .= "<th>Price </th>";
        $link .= "<th>Qty </th>";
        $link .= "<th>Total </th>";
        $link .= "</tr>";

        if (isset($mail_product) && is_array($mail_product)) {
            foreach ($mail_product as $val) {
                $link .= "<tr>";
                $link .= "<td>" . $val['order_id'] . "</td>";
                $link .= "<td>" . $val['product_name'] . "</td>";
                $link .= "<td>" . $val['selling_price'] . "</td>";
                $link .= "<td>" . $val['qty'] . "</td>";
                $link .= "<td>" . $val['total_price'] . "</td>";
                $link .= "</tr>";
                $product_name .= substr($val['product_name'], 0, 30) . "..,";
                $order_id = $val['order_id'];
            }
        }
        $link .= "</table>";

        $email_tag = array(
            'BUSINESS_NAME' => $seller->business_name,
            'PRODUCT_DETAILS' => $link
        );

        $sms_tag = array(
            'BUSINESS_NAME' => $seller->business_name,
            'PRODUCT_NAME' => $product_name,
            'ORDER_ID' => $order_id
        );

        // EMAIL CODE

        $subject = $this->parser->parse_string($templateInfo->mail_subject, $email_tag, TRUE);
        $from = ($templateInfo->from != "") ? $templateInfo->from : NULL;
        $name = ($templateInfo->name != "") ? $templateInfo->name : NULL;
        $to = $seller->primary_email;
        $this->load->view('email_format', $templateInfo, TRUE);
        $body = $this->parser->parse('email_format', $email_tag, TRUE);
        $this->common->sendEmail($from, $to, $subject, $body, $name);

        // SMS CODE

        $message = $this->parser->parse_string($smstemplateInfo->message, $sms_tag, TRUE);
        $to_mobile = $seller->primary_mobile;
        $this->common->SMSSend($to_mobile, $message, true);
    }

    function getCartData($cart_id) {
        $this->db->select('o.cart_id,o.txn_id,sum(o.payment_price) as total,c.first_name,c.last_name,c.primary_email,c.primary_mobile');
        $this->db->from('order_mst as o');
        $this->db->join('customer_mst as c', 'c.customer_id = o.customer_id');
        $this->db->where('o.cart_id', $cart_id);
        $query = $this->db->get();
        return $query->row();
    }

    function updateQuantity($product_id, $qty) {
        $this->db->where('product_id', $product_id);
        $this->db->set('qty', 'qty-' . $qty, FALSE);
        $this->db->update('product_mst');
        return 1;
    }

    function getMaxOrderId() {
        $this->db->select('max(order_id) as order_id');
        $this->db->from('order_mst');
        $query = $this->db->get();
        $data = $query->row();

        if ($data->order_id == "") {
            $this->db->select('order_id');
            $this->db->from('general_id_mst');
            $query = $this->db->get();
            $data = $query->row();
        }
        return $data->order_id + 1;
    }

    function getMaxCartId() {
        $this->db->select('max(cart_id) as cart_id');
        $this->db->from('order_mst');
        $query = $this->db->get();
        $data = $query->row();

        if ($data->cart_id == "") {
            return 1;
        } else {
            return $data->cart_id + 1;
        }
    }

    function getMaxInvoiceId() {
        $this->db->select('max(invoice_id) as invoice_id');
        $this->db->from('order_mst');
        $query = $this->db->get();
        $data = $query->row();

        if ($data->invoice_id == "") {
            $this->db->select('invoice_id');
            $this->db->from('general_id_mst');
            $query = $this->db->get();
            $data = $query->row();
        }
        return $data->invoice_id + 1;
    }

    function getCouponData($coupon_code) {
        $query = $this->db->get_where('coupon_mst', array('coupon_code' => $coupon_code, 'status' => 1));
        return $query->row();
    }

    // ----------------------------App Order -----------------------------------

    function addAppOrder($temp_cart_id, $customer_id, $pay_method) {

        $product = $this->wcommon->getAppCartProducts($temp_cart_id);
        $customer = $this->common->getCustomerDataById($customer_id);
        $cart_id = $this->getMaxCartId();
        $txn_id = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        $mail_product = array();
        if (isset($product) && is_array($product)) {
            foreach ($product as $val) {
                $order_id = $this->getMaxOrderId();
                $invoice_id = $this->getMaxInvoiceId();
                $total_amount = $val->selling_price * $val->qty;
                $total_settlement_amount = $val->settlement_price * $val->qty;
                $total_discount = 0;
                $pay_amount = 0;

                if ($val->coupon_code != "") {
                    $coupon_code = $val->coupon_code;
                    $coupondata = $this->getCouponData($coupon_code);
                    if ($coupondata->type == '0') {
                        $total_discount = $coupondata->value * $val->qty;
                        $pay_amount = $total_amount - $total_discount;
                    } else if ($coupondata->type == '1') {
                        $total_discount = ($total_amount * $coupondata->value) / 100;
                        $pay_amount = $total_amount - $total_discount;
                    }
                } else {
                    $pay_amount = $total_amount;
                }

                $shipping_charge = $val->shipping_charge * $val->qty;
                $shipping_extra_charge = $shipping_charge * 14.5 / 100;
                $shipping_charge += $shipping_extra_charge;
                $cod_charge = 0;

                if (isset($customer)) {
                    $today_date = time();
                    $bonus_limit_date = $customer->bonus_limit_date;
                    $balance = $customer->balance;

                    if ($bonus_limit_date > $today_date) {
                        $pay_amount = $pay_amount - $balance;
                        $this->db->update('customer_mst', array('balance' => '0'), array('customer_id' => $customer->customer_id));
                    }
                }

                if ($pay_method == "cod") {

                    $cod_charge = $this->common->codCharge()->cod_charge;
                    $pay_amount = $pay_amount + $cod_charge;
                }

                $order = array(
                    'cart_id' => $cart_id,
                    'order_id' => $order_id,
                    'ref_order_id' => $order_id,
                    'invoice_id' => $invoice_id,
                    'txn_id' => $txn_id,
                    'customer_id' => $customer_id,
                    'seller_id' => $val->seller_id,
                    'product_id' => $val->product_id,
                    'product_name' => $val->product_name,
                    'image_thumb' => $val->image_thumb,
                    'image_medium' => $val->image_medium,
                    'brand' => $val->brand,
                    'style_code' => $val->style_code,
                    'sku' => $val->sku,
                    'mrp' => $val->mrp,
                    'selling_price' => $val->selling_price,
                    'weight' => $val->weight,
                    'shipping_time' => $val->shipping_time,
                    'colour' => ($val->colour_id != "") ? $this->wcommon->getVariationName($val->colour_id) : "",
                    'qty' => $val->qty,
                    'size' => ($val->size_id != "") ? $this->wcommon->getVariationName($val->size_id) : "",
                    'total_price' => $total_amount,
                    'discount_price' => $total_discount,
                    'shipping_charge' => $shipping_charge,
                    'cod_charge' => $cod_charge,
                    'payment_price' => $pay_amount,
                    'coupon_code' => $val->coupon_code,
                    'pay_method' => $pay_method,
                    'payment_status' => ($pay_method == "cod") ? "1" : "0",
                    'order_date' => date('Y-m-d H:i:s')
                );

                $order_notify = array(
                    'order_id' => $order_id,
                    'seller_id' => $val->seller_id,
                    'total_price' => $pay_amount,
                    'order_status' => '1',
                    'notify_date' => date('Y-m-d H:i:s')
                );

                $mail_product[] = array(
                    'order_id' => $order_id,
                    'product_name' => $val->product_name,
                    'selling_price' => $val->selling_price,
                    'qty' => $val->qty,
                    'total_price' => $total_amount
                );

                $transaction = array(
                    'order_id' => $order_id,
                    'order_date' => date('Y-m-d H:i:s'),
                    'selling_price' => $total_amount,
                    'settlement_price' => $total_settlement_amount,
                    'shipping_charge' => $shipping_charge,
                    'cod_charge' => $cod_charge
                );

                $order_status = array(
                    'order_id' => $order_id,
                    'txn_id' => $txn_id,
                    'track_status' => "Approved",
                    'description' => "Your Order Is Approved",
                    'location' => $this->common->getSellerDataByID($val->seller_id)->pickup_city,
                    'status_date' => date('Y-m-d H:i:s')
                );

                $this->db->insert('order_mst', $order);
                $this->db->insert('order_status_mst', $order_status);

                if ($pay_method == "cod") {
                    $this->updateQuantity($val->product_id, $val->qty);
                    $this->db->insert('transaction_mst', $transaction);
                    $this->db->insert('order_notify_mst', $order_notify);
                }
            }

            // ONLY COD PAYMENT METHOD ORDER NOTIFICATION SEND HEAR.

            if ($pay_method == "cod") {
                $this->sendMailToBuyer($customer_id, $mail_product);
                $this->sendMailToSeller($val->seller_id, $mail_product);
            }
        }
        $this->db->delete('temp_cart_mst', array('temp_cart_id' => $temp_cart_id));

        return $cart_id;
    }

    function getCartTotal($cart_id) {
        $this->db->select('cart_id,sum(payment_price) as total');
        $query = $this->db->get_where('order_mst', array('cart_id' => $cart_id));
        return $query->row();
    }

}
