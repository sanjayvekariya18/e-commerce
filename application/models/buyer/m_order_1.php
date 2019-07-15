<?php

require FCPATH . 'application/libraries/fedex/fedex-common.php';

class M_order extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('parser');
        $this->load->model('website/m_cart', 'ocart');
    }

    function getRecentOrderData($customer_id) {
        $limitDate = date("Y-m-d", strtotime("-3 months"));
        $where = array(
            'customer_id' => $customer_id,
            'payment_status' => '1'
        );
        $this->db->select('o.id,o.order_id,o.invoice_id,o.customer_id,o.seller_id,o.product_id,o.product_name,o.image_thumb,o.brand,o.style_code,o.sku,o.selling_price,o.payment_price,o.weight,o.shipping_time,o.colour,o.size,o.qty,o.order_date,o.delivery_date,o.order_status,o.pay_method,s.business_name');
        $this->db->from('order_mst as o,seller_mst as s');
        $this->db->order_by('order_id', 'ASC');
        $this->db->where($where);
        $this->db->where('o.seller_id = s.seller_id');
        $this->db->where('DATE(o.order_date) >', $limitDate);
        $query = $this->db->get();
        return $query->result();
    }

    function getPastOrderData($customer_id) {
        $limitDate = date("Y-m-d", strtotime("-3 months"));
        $where = array(
            'customer_id' => $customer_id,
            'payment_status' => '1'
        );
        $this->db->select('o.id,o.order_id,o.invoice_id,o.customer_id,o.seller_id,o.product_id,o.product_name,o.image_thumb,o.brand,o.style_code,o.sku,o.selling_price,o.payment_price,o.weight,o.shipping_time,o.colour,o.size,o.qty,o.order_date,o.order_status,o.pay_method,s.business_name');
        $this->db->from('order_mst as o,seller_mst as s');
        $this->db->order_by('order_id', 'ASC');
        $this->db->where($where);
        $this->db->where('o.seller_id = s.seller_id');
        $this->db->where('DATE(o.order_date) <', $limitDate);
        $query = $this->db->get();
        return $query->result();
    }

    function getTrackOrderData($order_id) {
        $this->db->select('o.id,o.order_id,o.invoice_id,o.customer_id,selling_price,o.order_date,o.order_status,s.business_name,c.first_name,c.last_name,c.primary_mobile,c.address,c.city,c.pincode,st.state_name');
        $this->db->from('order_mst as o,seller_mst as s,customer_mst as c,state_mst as st');
        $this->db->where('o.seller_id = s.seller_id');
        $this->db->where('o.customer_id = c.customer_id');
        $this->db->where('c.state = st.id');
        $this->db->where('o.order_id', $order_id);
        $query = $this->db->get();
        return $query->row();
    }

    function getTrackOrderStatusData($order_id) {
        $query = $this->db->get_where('order_status_mst', array('order_id' => $order_id));
        return $query->result();
    }

    function getOrderData($order_id) {
        $query = $this->db->get_where('order_mst', array('order_id' => $order_id));
        return $query->row();
    }

    function getCustomerData($customer_id) {
        $query = $this->db->get_where('customer_mst', array('customer_id' => $customer_id));
        return $query->row();
    }

    function getDeliveryOrders($customer_id) {
        $where = array(
            'o.customer_id' => $customer_id,
            'o.order_status' => '4'
        );
        $this->db->select('o.order_date,o.order_id,product_name,payment_price,c.first_name,c.last_name');
        $this->db->from('order_mst as o');
        $this->db->join('customer_mst as c', 'o.customer_id = c.customer_id');
        $this->db->where($where);                
        $query = $this->db->get();
        return $query->result();
    }

    function getSellerData($seller_id) {
        $query = $this->db->get_where('seller_mst', array('seller_id' => $seller_id));
        return $query->row();
    }

    //---------------------------------- CANCEL ORDER -------------------------------------

    function cancelOrder() {
        $order_id = $this->input->post('order_id');
        $order_data = $this->common->getOrderById($order_id);

        $status = array(
            'order_status' => ($order_data->transite == "0") ? "6" : "8",
            'cancel_date' => date('Y-m-d H:i:s'),
            'cancel_reason' => $this->input->post('cancel_reason'),
            'cancel_comment' => $this->input->post('cancel_comment')
        );

        $order_notify = array(
            'order_id' => $order_id,
            'seller_id' => $order_data->seller_id,
            'total_price' => $order_data->payment_price,
            'order_status' => ($order_data->transite == "0") ? "6" : "8",
            'notify_date' => date('Y-m-d H:i:s')
        );


        if ($order_data->transite == "0") {
            $transaction_update = array(
                'shipping_charge' => 0,
                'cod_charge' => 0
            );
            $order_status = array(
                'order_id' => $order_id,
                'txn_id' => $order_data->txn_id,
                'track_status' => "Cancel",
                'description' => "Your Order Is Cancelled",
                'location' => "-",
                'status_date' => date('Y-m-d H:i:s')
            );
        } else {
            $transaction_update = array(
                'shipping_charge' => $order_data->shipping_charge * 2
            );

            $order_status = array(
                'order_id' => $order_id,
                'txn_id' => $order_data->txn_id,
                'track_status' => "Shipped Cancel",
                'description' => "Your Order Is Shipped Cancelled",
                'location' => "-",
                'status_date' => date('Y-m-d H:i:s')
            );
        }

        $this->db->trans_start();
        $this->db->update('order_mst', $status, array('order_id' => $order_id));
        $this->db->update('transaction_mst', $transaction_update, array('order_id' => $order_id));
        $this->db->insert('order_notify_mst', $order_notify);
        $this->db->insert('order_status_mst', $order_status);

        if ($order_data->pay_method == "card") {

            $refund_request = array(
                'order_id' => $order_data->order_id,
                'amount' => $order_data->payment_price,
                'bank_name' => $this->input->post('bank_name'),
                'ifsc' => $this->input->post('ifsc'),
                'account_no' => $this->input->post('account_no'),
                'account_name' => $this->input->post('account_name'),
                'request_date' => date('Y-m-d H:i:s')
            );

            $refund_request_notify = array(
                'from_id' => $this->session->userdata('customer_id'),
                'from_name' => $this->session->userdata('customer_username'),
                'to_id' => '0',
                'to_name' => 'Administrator',
                'message' => "Refund Request To You With Amount :" . $order_data->payment_price,
                'request_type' => '1'
            );

            $bankdetail = array(
                'bank_name' => $this->input->post('bank_name'),
                'ifsc' => $this->input->post('ifsc'),
                'account_no' => $this->input->post('account_no'),
                'account_name' => $this->input->post('account_name')
            );

            $this->db->insert('refund_mst', $refund_request);
            $this->db->insert('payout_notify_mst', $refund_request_notify);
            $this->db->update('customer_mst', $bankdetail, array('customer_id' => $this->session->userdata('customer_id')));
        }
        $this->db->trans_complete();
        $this->sendMailToSeller($order_data);
        $this->sendMailToBuyer($order_data);

        return True;
    }

    //--------------------------RETURN (REFUND) OR REPLACE ORDER----------------------------

    function returnOrder() {
        $order_id = $this->input->post('order_id');
        $order_data = $this->common->getOrderById($order_id);
        $customer_id = $this->input->post('customer_id');
        $activity = $this->input->post('activity');
        if ($activity == 0) {
            $status = array(
                'order_status' => '7',
                'return_reason' => $this->input->post('reason'),
                'return_date' => date('Y-m-d H:i:s')
            );
            $order_notify = array(
                'order_id' => $order_id,
                'seller_id' => $order_data->seller_id,
                'total_price' => $order_data->payment_price,
                'order_status' => '7',
                'notify_date' => date('Y-m-d H:i:s')
            );

            $order_status = array(
                'order_id' => $order_id,
                'txn_id' => $order_data->txn_id,
                'track_status' => "Replace",
                'description' => "Your Order Is Replace",
                'location' => "-",
                'status_date' => date('Y-m-d H:i:s')
            );

            $this->db->update('order_mst', $status, array('order_id' => $order_id));
            $this->db->insert('order_notify_mst', $order_notify);
            $this->db->insert('order_status_mst', $order_status);
            $this->ocart->replaceOrder($order_id);
        } else {
            $status = array(
                'order_status' => '5',
                'return_reason' => $this->input->post('reason'),
                'return_date' => date('Y-m-d H:i:s')
            );
            $order_notify = array(
                'order_id' => $order_id,
                'seller_id' => $order_data->seller_id,
                'total_price' => $order_data->payment_price,
                'order_status' => '5',
                'notify_date' => date('Y-m-d H:i:s')
            );

            $refund_request = array(
                'order_id' => $order_data->order_id,
                'amount' => $order_data->payment_price,
                'bank_name' => $this->input->post('bank_name'),
                'ifsc' => $this->input->post('ifsc'),
                'account_no' => $this->input->post('account_no'),
                'account_name' => $this->input->post('account_name'),
                'request_date' => date('Y-m-d H:i:s')
            );

            $refund_request_notify = array(
                'from_id' => $this->session->userdata('customer_id'),
                'from_name' => $this->session->userdata('customer_username'),
                'to_id' => '0',
                'to_name' => 'Administrator',
                'message' => "Refund Request To You With Amount :" . $order_data->payment_price,
                'request_type' => '1'
            );

            $transaction_update = array(
                'shipping_charge' => $order_data->shipping_charge * 2,
            );

            $order_status = array(
                'order_id' => $order_id,
                'txn_id' => $order_data->txn_id,
                'track_status' => "Return",
                'description' => "Your Order Is Return",
                'location' => "-",
                'status_date' => date('Y-m-d H:i:s')
            );

            $this->db->update('order_mst', $status, array('order_id' => $order_id));
            $this->db->update('transaction_mst', $transaction_update, array('order_id' => $order_id));
            $this->db->insert('order_notify_mst', $order_notify);
            $this->db->insert('refund_mst', $refund_request);
            $this->db->insert('payout_notify_mst', $refund_request_notify);
            $this->db->insert('order_status_mst', $order_status);

            $bankdetail = array(
                'bank_name' => $this->input->post('bank_name'),
                'ifsc' => $this->input->post('ifsc'),
                'account_no' => $this->input->post('account_no'),
                'account_name' => $this->input->post('account_name')
            );
            $this->db->update('customer_mst', $bankdetail, array('customer_id' => $customer_id));
        }

        $returnOrder = array(
            'order_id' => $order_id,
            'txn_id' => $order_data->txn_id,
            'return_date' => date('Y-m-d H:i:s')
        );
        $this->db->insert('return_order_mst', $returnOrder);
        return True;
    }

    //-------------------------Email Code---------------------------------------------

    function sendMailToSeller($order_data) {
        $seller = $this->common->getSellerDataById($order_data->seller_id);
        $templateInfo = $this->common->getMailTemplate("ORDER CANCELLED", "Seller");
        $smstemplateInfo = $this->common->getSmsTemplate("ORDER CANCELLED", "Seller");

        $link = "<table border='1' align='center' cellpadding='5' cellspacing='2' width='100%' style='border-collapse: collapse;border-spacing: 0;'>";
        $link .= "<tr>";
        $link .= "<th>Order Id </th>";
        $link .= "<th>Product Name </th>";
        $link .= "<th>Price </th>";
        $link .= "<th>Qty </th>";
        $link .= "<th>Total </th>";
        $link .= "</tr>";
        $link .= "<tr>";
        $link .= "<td>" . $order_data->order_id . "</td>";
        $link .= "<td>" . $order_data->product_name . "</td>";
        $link .= "<td>" . $order_data->selling_price . "</td>";
        $link .= "<td>" . $order_data->qty . "</td>";
        $link .= "<td>" . $order_data->total_price . "</td>";
        $link .= "</tr>";
        $link .= "</table>";
        $product_name = substr($order_data->product_name, 0, 15);

        $email_tag = array(
            'BUSINESS_NAME' => $seller->business_name,
            'ORDER_ID' => $order_data->order_id,
            'PRODUCT_DETAILS' => $link
        );

        $sms_tag = array(
            'BUSINESS_NAME' => $seller->business_name,
            'ORDER_ID' => $order_data->order_id,
            'PRODUCT_NAME' => $product_name
        );

        // EMAIL CODE 
        $subject = $this->parser->parse_string($templateInfo->mail_subject, $email_tag, TRUE);
        $from = ($templateInfo->from != "") ? $templateInfo->from : NULL;
        $name = ($templateInfo->name != "") ? $templateInfo->name : NULL;
        $to = $seller->primary_email;
        $this->load->view('email_format', $templateInfo, TRUE);
        $body = $this->parser->parse('email_format', $email_tag, TRUE);
        $this->common->sendEmail($from, $to, $subject, $body, $name);

        //SMS CODE

        $message = $this->parser->parse_string($smstemplateInfo->message, $sms_tag, TRUE);
        $to_mobile = $seller->primary_mobile;
        $this->common->SMSSend($to_mobile, $message, true);
    }

    function sendMailToBuyer($order_data) {
        $customer = $this->common->getCustomerDataById($order_data->customer_id);
        $templateInfo = $this->common->getMailTemplate("YOU CANCELLED ORDER", "Buyer");
        $smstemplateInfo = $this->common->getSmsTemplate("YOU CANCELLED ORDER", "Buyer");

        $link = "<table border='1' align='center' cellpadding='5' cellspacing='2' width='100%' style='border-collapse: collapse;border-spacing: 0;'>";
        $link .= "<tr>";
        $link .= "<th>Order Id </th>";
        $link .= "<th>Product Name </th>";
        $link .= "<th>Price </th>";
        $link .= "<th>Qty </th>";
        $link .= "<th>Total </th>";
        $link .= "</tr>";
        $link .= "<tr>";
        $link .= "<td>" . $order_data->order_id . "</td>";
        $link .= "<td>" . $order_data->product_name . "</td>";
        $link .= "<td>" . $order_data->selling_price . "</td>";
        $link .= "<td>" . $order_data->qty . "</td>";
        $link .= "<td>" . $order_data->total_price . "</td>";
        $link .= "</tr>";
        $link .= "</table>";
        $product_name = substr($order_data->product_name, 0, 15);

        $email_tag = array(
            'FIRST_NAME' => $customer->first_name,
            'LAST_NAME' => $customer->last_name,
            'ORDER_ID' => $order_data->order_id,
            'PRODUCT_DETAILS' => $link
        );

        $sms_tag = array(
            'FIRST_NAME' => $customer->first_name,
            'LAST_NAME' => $customer->last_name,
            'ORDER_ID' => $order_data->order_id,
            'PRODUCT_NAME' => $product_name
        );


        // EMAIL CODE

        $subject = $this->parser->parse_string($templateInfo->mail_subject, $email_tag, TRUE);
        $from = ($templateInfo->from != "") ? $templateInfo->from : NULL;
        $name = ($templateInfo->name != "") ? $templateInfo->name : NULL;
        $to = $customer->primary_email;
        $this->load->view('email_format', $templateInfo, TRUE);
        $body = $this->parser->parse('email_format', $email_tag, TRUE);
        $this->common->sendEmail($from, $to, $subject, $body, $name);

        // SMS CODE

        $message = $this->parser->parse_string($smstemplateInfo->message, $sms_tag, TRUE);
        $to_mobile = $customer->primary_mobile;
        $this->common->SMSSend($to_mobile, $message, true);
    }

    //------------------------- PRODUCT RATING CODE -------------------------------------

    function getProductRate() {
        $order_id = $this->input->post('order_id');
        $this->db->select('prate,preview');
        $query = $this->db->get_where('order_mst', array('order_id' => $order_id));
        return $query->row();
    }

    function setProductRate() {
        $order_id = $this->input->post('order_id');
        $product_id = $this->input->post('product_id');
        $product_review = array(
            'prate' => $this->input->post('prate'),
            'preview' => $this->input->post('preview'),
            'pratedate' => date('Y-m-d H:i:s')
        );
        $this->db->update('order_mst', $product_review, array('order_id' => $order_id));
        $this->updateMainProductRate($product_id);
        return 1;
    }

    function updateMainProductRate($product_id) {
        $this->db->select('sum(prate) as total , count(*) as count');
        $this->db->from('order_mst');
        $this->db->where('product_id', $product_id);
        $this->db->where('order_status', '4');
        $query = $this->db->get()->row();
        if (isset($query->total)) {
            $avr_rate = $query->total / $query->count;
            $this->db->update('product_mst', array('product_rating' => $avr_rate), array('product_id' => $product_id));
        }
    }

    //------------------------ Return Order Management --------------------------------

    function getReturnOrderData($customer_id) {
        $where = array(
            'o.customer_id' => $customer_id,
            'o.payment_status' => '1',
            'r.return_status' => '1'
        );
        $this->db->select('o.order_id,o.invoice_id,o.customer_id,o.seller_id,o.product_id,o.product_name,o.image_thumb,o.brand,o.style_code,o.sku,o.selling_price,o.payment_price,o.weight,o.shipping_time,o.colour,o.size,o.qty,o.order_date,o.delivery_date,o.order_status,o.packing_by,s.business_name');
        $this->db->from('order_mst as o');
        $this->db->join('seller_mst as s', 'o.seller_id = s.seller_id');
        $this->db->join('return_order_mst as r', 'o.order_id = r.order_id');
        $this->db->order_by('o.return_date', 'ASC');
        $this->db->where_in('o.order_status', array('5', '7'));
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    function getReturnPackUpOrderData($customer_id) {
        $where = array(
            'o.customer_id' => $customer_id,
            'o.payment_status' => '1',
            'r.return_status' => '2'
        );
        $this->db->select('o.order_id,o.invoice_id,o.customer_id,o.seller_id,o.product_id,o.product_name,o.image_thumb,o.brand,o.style_code,o.sku,o.selling_price,o.payment_price,o.weight,o.shipping_time,o.colour,o.size,o.qty,o.order_date,o.delivery_date,o.order_status,o.packing_by,s.business_name');
        $this->db->from('order_mst as o');
        $this->db->join('seller_mst as s', 'o.seller_id = s.seller_id');
        $this->db->join('return_order_mst as r', 'o.order_id = r.order_id');
        $this->db->order_by('o.return_date', 'ASC');
        $this->db->where_in('o.order_status', array('5', '7'));
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    function getReturnPickUpOrderData($customer_id) {
        $where = array(
            'o.customer_id' => $customer_id,
            'o.payment_status' => '1',
            'r.return_status' => '3'
        );
        $this->db->select('o.order_id,o.invoice_id,o.customer_id,o.seller_id,o.product_id,o.product_name,o.image_thumb,o.brand,o.style_code,o.sku,o.selling_price,o.payment_price,o.weight,o.shipping_time,o.colour,o.size,o.qty,o.order_date,o.delivery_date,o.order_status,o.packing_by,s.business_name');
        $this->db->from('order_mst as o');
        $this->db->join('seller_mst as s', 'o.seller_id = s.seller_id');
        $this->db->join('return_order_mst as r', 'o.order_id = r.order_id');
        $this->db->order_by('o.return_date', 'ASC');
        $this->db->where_in('o.order_status', array('5', '7'));
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    function getReturnCompleteOrderData($customer_id) {
        $where = array(
            'o.customer_id' => $customer_id,
            'o.payment_status' => '1',
            'r.return_status' => '4'
        );
        $this->db->select('o.order_id,o.invoice_id,o.customer_id,o.seller_id,o.product_id,o.product_name,o.image_thumb,o.brand,o.style_code,o.sku,o.selling_price,o.payment_price,o.weight,o.shipping_time,o.colour,o.size,o.qty,o.order_date,o.delivery_date,o.order_status,o.packing_by,s.business_name');
        $this->db->from('order_mst as o');
        $this->db->join('seller_mst as s', 'o.seller_id = s.seller_id');
        $this->db->join('return_order_mst as r', 'o.order_id = r.order_id');
        $this->db->order_by('o.return_date', 'ASC');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    function getPackSlipData($order_id) {
        $this->db->select('o.order_id,o.product_name,o.selling_price,o.colour,o.size,o.qty,o.shipping_charge,o.cod_charge,o.total_price,o.payment_price,o.order_date,o.pay_method,o.weight,o.txn_id,o.packing_id,o.packing_by,r.awb_no,r.form_id,r.service_type,r.barcode_string,r.destination_id,r.destination_area,r.routing_code,r.ready_date,r.airport_id,c.first_name,c.last_name,c.address,c.city,c.state,c.pincode,c.landmark,c.primary_mobile as "customer_contact",s.first_name as "seller_fname",s.last_name as "seller_lname",s.business_name,s.pickup_address,s.pickup_landmark,s.pickup_city,s.pickup_state,s.pickup_pincode,s.tin_id,s.primary_mobile as "seller_contact"');
        $this->db->from('order_mst as o');
        $this->db->join('customer_mst as c', 'o.customer_id = c.customer_id');
        $this->db->join('seller_mst as s', 'o.seller_id = s.seller_id');
        $this->db->join('return_order_mst as r', 'o.order_id = r.order_id');
        $this->db->where('r.order_id', $order_id);
        $query = $this->db->get();
        return $query->row();
    }

    function packOrder($order_id) {
        $order_data = $this->getOrderById($order_id);
        $order_update = array(
            'return_status' => 2,
            'ready_date' => date('Y-m-d H:i:s'),
        );

        $order_status = array(
            'order_id' => $order_id,
            'txn_id' => $order_data->txn_id,
            'track_status' => "Pack Up",
            'description' => "Your Order Is Pack Up",
            'location' => $this->common->getCustomerDataById($order_data->customer_id)->city,
            'status_date' => date('Y-m-d H:i:s')
        );
        $this->db->update('return_order_mst', $order_update, array('order_id' => $order_id));
        $this->db->insert('return_order_status_mst', $order_status);
        return 1;
    }

    // -------------------FEDEX CREATE RETURN SHIPMENT --------------------------------

    function getFedexSlipData($order) {
        $returnflag = 0;
        $txn_id = $order->txn_id;
        $total_amount = $order->payment_price;
        $total_qty = $order->qty;
        $total_weight = $order->weight / 1000;
        $order_id = $order->order_id;

        $path_to_wsdl = FCPATH . 'application/libraries/fedex/ShipService_v17.wsdl';

        define('SHIP_LABEL', FCPATH . 'upload/fedexreturnslip/' . $order_id . '_SHIP.PDF');

        ini_set("soap.wsdl_cache_enabled", "0");

        $client = new SoapClient($path_to_wsdl, array('trace' => 1)); // Refer to http://us3.php.net/manual/en/ref.soap.php for more information

        $request['WebAuthenticationDetail'] = array(
            'ParentCredential' => array(
                'Key' => getProperty('key'),
                'Password' => getProperty('password')
            ),
            'UserCredential' => array(
                'Key' => getProperty('key'),
                'Password' => getProperty('password')
            )
        );

        $request['ClientDetail'] = array(
            'AccountNumber' => getProperty('shipaccount'),
            'MeterNumber' => getProperty('meter')
        );
        $request['TransactionDetail'] = array('CustomerTransactionId' => '*** Intra India Shipping Request using PHP ***');
        $request['Version'] = array(
            'ServiceId' => 'ship',
            'Major' => '17',
            'Intermediate' => '0',
            'Minor' => '0'
        );
        $request['RequestedShipment'] = array(
            'ShipTimestamp' => date('c'),
            'DropoffType' => 'REGULAR_PICKUP', // valid values REGULAR_PICKUP, REQUEST_COURIER, DROP_BOX, BUSINESS_SERVICE_CENTER and STATION
            'ServiceType' => 'STANDARD_OVERNIGHT', // valid values STANDARD_OVERNIGHT, PRIORITY_OVERNIGHT, FEDEX_EXPRESS_SAVER
            'PackagingType' => 'YOUR_PACKAGING', // valid values FEDEX_BOX, FEDEX_PAK, FEDEX_TUBE, YOUR_PACKAGING, ...
            'Shipper' => $this->addShipper($order),
            'Recipient' => $this->addRecipient($order),
            'ShippingChargesPayment' => $this->addShippingChargesPayment(),
            'CustomsClearanceDetail' => $this->addCustomClearanceDetail($total_amount, $total_qty, $total_weight, $txn_id),
            'LabelSpecification' => $this->addLabelSpecification(),
            'PackageCount' => 1,
            'RequestedPackageLineItems' => array(
                '0' => $this->addPackageLineItem1($total_weight, $txn_id)
            )
        );

        try {
            if (setEndpoint('changeEndpoint')) {
                $newLocation = $client->__setLocation(setEndpoint('endpoint'));
            }

            $response = $client->processShipment($request); // FedEx web service invocation

            if ($response->HighestSeverity != 'FAILURE' && $response->HighestSeverity != 'ERROR') {

                $shipment_data = array(
                    'fedex_status' => $response->Notifications->Message,
                    'awb_no' => $response->CompletedShipmentDetail->CompletedPackageDetails->TrackingIds->TrackingNumber,
                    'form_id' => $response->CompletedShipmentDetail->CompletedPackageDetails->TrackingIds->FormId,
                    'barcode_string' => $response->CompletedShipmentDetail->CompletedPackageDetails->OperationalDetail->Barcodes->StringBarcodes->Value,
                    'service_type' => $response->CompletedShipmentDetail->OperationalDetail->AstraDescription,
                    'destination_id' => $response->CompletedShipmentDetail->OperationalDetail->DestinationLocationId,
                    'destination_area' => $response->CompletedShipmentDetail->OperationalDetail->DestinationServiceArea,
                    'routing_code' => $response->CompletedShipmentDetail->OperationalDetail->UrsaPrefixCode . " " . $response->CompletedShipmentDetail->OperationalDetail->UrsaSuffixCode,
                    'airport_id' => $response->CompletedShipmentDetail->OperationalDetail->AirportId,
                );

                $fp = fopen(SHIP_LABEL, 'wb');
                fwrite($fp, ($response->CompletedShipmentDetail->CompletedPackageDetails->Label->Parts->Image));
                fclose($fp);

                // ---- UPDATE AWD NO + STATUS + BARCODE DATA IN TO ORDER MST                
                $this->db->update('return_order_mst', $shipment_data, array('txn_id' => $txn_id));
                $returnflag = 1;
            } else {
                $returnflag = 0;
            }
        } catch (SoapFault $exception) {
            $returnflag = 0;
        }

        if ($returnflag) {
            $result = $this->getFedexPickupData($order, $total_weight);
            $returnflag = ($result) ? 1 : 0;
            return $returnflag;
        } else {
            return $returnflag;
        }
    }

    function getFedexPickupData($order, $total_weight) {
        $path_to_wsdl = FCPATH . 'application/libraries/fedex/PickupService_v11.wsdl';
        $Fedexpincode = $this->common->getFedexPincode($order->pincode);
        $pickup_time = date('c');
        ini_set("soap.wsdl_cache_enabled", "0");
        $client = new SoapClient($path_to_wsdl, array('trace' => 1)); // Refer to http://us3.php.net/manual/en/ref.soap.php for more information

        $request['WebAuthenticationDetail'] = array(
            'ParentCredential' => array(
                'Key' => getProperty('key'),
                'Password' => getProperty('password')
            ),
            'UserCredential' => array(
                'Key' => getProperty('key'),
                'Password' => getProperty('password')
            )
        );

        $request['ClientDetail'] = array(
            'AccountNumber' => getProperty('shipaccount'),
            'MeterNumber' => getProperty('meter')
        );

        $request['TransactionDetail'] = array('CustomerTransactionId' => '*** Create Pickup Request using PHP ***');
        $request['Version'] = array(
            'ServiceId' => 'disp',
            'Major' => 11,
            'Intermediate' => 0,
            'Minor' => 0
        );
        $request['OriginDetail'] = array(
            'PickupLocation' => array(
                'Contact' => array(
                    'PersonName' => $order->first_name . " " . $order->last_name,
                    'CompanyName' => "",
                    'PhoneNumber' => $order->customer_contact
                ),
                'Address' => array(
                    'StreetLines' => array($order->address, $order->landmark),
                    'City' => $Fedexpincode->city,
                    'StateOrProvinceCode' => $Fedexpincode->state,
                    'PostalCode' => $Fedexpincode->pincode,
                    'CountryCode' => 'IN',
                    'CountryName' => 'INDIA'
                )
            ),
            'PackageLocation' => 'FRONT', // valid values NONE, FRONT, REAR and SIDE
            'BuildingPartCode' => 'SUITE', // valid values APARTMENT, BUILDING, DEPARTMENT, SUITE, FLOOR and ROOM
            'BuildingPartDescription' => '3B',
            'ReadyTimestamp' => $pickup_time, // Replace with your ready date time
            'CompanyCloseTime' => '19:00:00'
        );
        $request['PackageCount'] = '1';
        $request['TotalWeight'] = array(
            'Value' => $total_weight,
            'Units' => 'KG' // valid values LB and KG
        );
        $request['CarrierCode'] = 'FDXE'; // valid values FDXE-Express, FDXG-Ground, FDXC-Cargo, FXCC-Custom Critical and FXFR-Freight
        $request['CourierRemarks'] = '';

        try {
            if (setEndpoint('changeEndpoint')) {
                $newLocation = $client->__setLocation(setEndpoint('endpoint'));
            }
            $response = $client->createPickup($request);


            if ($response->HighestSeverity != 'FAILURE' && $response->HighestSeverity != 'ERROR') {
                $pickup_no = $response->PickupConfirmationNumber;
                $pickup_data = array(
                    'return_status' => 3,
                    'pickup_no' => $pickup_no,
                    'ready_date' => date('Y-m-d H:i:s', strtotime($pickup_time))
                );

                $order_status = array(
                    'order_id' => $order->order_id,
                    'txn_id' => $order->txn_id,
                    'track_status' => "Pick Up",
                    'description' => "Your Order Is Pick Up",
                    'location' => $order->city,
                    'status_date' => date('Y-m-d H:i:s')
                );
                $this->db->update('return_order_mst', $pickup_data, array('order_id' => $order->order_id));
                $this->db->insert('return_order_status_mst', $order_status);

                return 1;
            } else {
                return 0;
            }
        } catch (SoapFault $exception) {
            return 0;
        }
    }

    function addShipper($order) {
        $Fedexpincode = $this->common->getFedexPincode($order->pincode);

        $shipper = array(
            'Contact' => array(
                'PersonName' => $order->first_name . " " . $order->last_name,
                'PhoneNumber' => $order->customer_contact
            ),
            'Address' => array(
                'StreetLines' => array($order->address, $order->landmark),
                'City' => $Fedexpincode->city,
                'StateOrProvinceCode' => $Fedexpincode->state,
                'PostalCode' => $Fedexpincode->pincode,
                'CountryCode' => 'IN',
                'CountryName' => 'INDIA'
            )
        );
        return $shipper;
    }

    function addRecipient($order) {
        $Fedexpincode = $this->common->getFedexPincode($order->pickup_pincode);

        $recipient = array(
            'Contact' => array(
                'PersonName' => $order->seller_fname . " " . $order->seller_lname,
                'PhoneNumber' => $order->seller_contact
            ),
            'Address' => array(
                'StreetLines' => array($order->pickup_address, $order->pickup_landmark),
                'City' => $Fedexpincode->city,
                'StateOrProvinceCode' => $Fedexpincode->state,
                'PostalCode' => $Fedexpincode->pincode,
                'CountryCode' => 'IN',
                'CountryName' => 'INDIA'
            )
        );
        return $recipient;
    }

    function addShippingChargesPayment() {
        $shippingChargesPayment = array(
            'PaymentType' => 'SENDER',
            'Payor' => array(
                'ResponsibleParty' => array(
                    'AccountNumber' => getProperty('billaccount'),
                    'Contact' => null,
                    'Address' => array('CountryCode' => 'IN')
                )
            )
        );
        return $shippingChargesPayment;
    }

    function addLabelSpecification() {
        $labelSpecification = array(
            'LabelFormatType' => 'COMMON2D', // valid values COMMON2D, LABEL_DATA_ONLY
            'ImageType' => 'PDF', // valid values DPL, EPL2, PDF, ZPLII and PNG
            'LabelStockType' => 'PAPER_8.5X11_TOP_HALF_LABEL'
        );
        return $labelSpecification;
    }

    function addCustomClearanceDetail($total_amount, $total_qty, $total_weight, $txn_id) {
        $customerClearanceDetail = array(
            'DutiesPayment' => array(
                'PaymentType' => 'SENDER', // valid values RECIPIENT, SENDER and THIRD_PARTY
                'Payor' => array(
                    'ResponsibleParty' => array(
                        'AccountNumber' => getProperty('dutyaccount'),
                        'Contact' => null,
                        'Address' => array(
                            'CountryCode' => 'IN'
                        )
                    )
                )
            ),
            'DocumentContent' => 'NON_DOCUMENTS',
            'CustomsValue' => array(
                'Currency' => 'INR',
                'Amount' => $total_amount
            ),
            'CommercialInvoice' => array(
                'Purpose' => 'SOLD',
                'CustomerReferences' => array(
                    array(
                        'CustomerReferenceType' => 'P_O_NUMBER', // valid values CUSTOMER_REFERENCE, INVOICE_NUMBER, P_O_NUMBER and SHIPMENT_INTEGRITY
                        'Value' => 'B2C'
                    ),
                    array(
                        'CustomerReferenceType' => 'CUSTOMER_REFERENCE', // valid values CUSTOMER_REFERENCE, INVOICE_NUMBER, P_O_NUMBER and SHIPMENT_INTEGRITY
                        'Value' => 'BILL D/T: SENDER'
                    ),
                    array(
                        'CustomerReferenceType' => 'INVOICE_NUMBER', // valid values CUSTOMER_REFERENCE, INVOICE_NUMBER, P_O_NUMBER and SHIPMENT_INTEGRITY
                        'Value' => $txn_id
                    )
                ),
            ),
            'Commodities' => array(
                'NumberOfPieces' => 1,
                'Description' => 'PRODUCT BY SHOPKING24 (RETURN PACKAGE)',
                'CountryOfManufacture' => 'IN',
                'Weight' => array(
                    'Units' => 'KG',
                    'Value' => $total_weight
                ),
                'Quantity' => $total_qty,
                'QuantityUnits' => 'EA',
                'UnitPrice' => array(
                    'Currency' => 'INR',
                    'Amount' => $total_amount
                ),
                'CustomsValue' => array(
                    'Currency' => 'INR',
                    'Amount' => $total_amount
                )
            )
        );
        return $customerClearanceDetail;
    }

    function addPackageLineItem1($total_weight, $txn_id) {

        $packageLineItem = array(
            'SequenceNumber' => 1,
            'Weight' => array(
                'Value' => $total_weight,
                'Units' => 'KG'
            ),
            'CustomerReferences' => array(
                array(
                    'CustomerReferenceType' => 'P_O_NUMBER', // valid values CUSTOMER_REFERENCE, INVOICE_NUMBER, P_O_NUMBER and SHIPMENT_INTEGRITY
                    'Value' => 'B2C'
                ),
                array(
                    'CustomerReferenceType' => 'CUSTOMER_REFERENCE', // valid values CUSTOMER_REFERENCE, INVOICE_NUMBER, P_O_NUMBER and SHIPMENT_INTEGRITY
                    'Value' => 'BILL D/T: SENDER'
                ),
                array(
                    'CustomerReferenceType' => 'INVOICE_NUMBER', // valid values CUSTOMER_REFERENCE, INVOICE_NUMBER, P_O_NUMBER and SHIPMENT_INTEGRITY
                    'Value' => $txn_id
                )
            ),
        );
        return $packageLineItem;
    }

    function getOrderById($order_id) {
        $query = $this->db->get_where('order_mst', array('order_id' => $order_id));
        return $query->row();
    }

    //-----------------------------  INDIA POST SLIP DATA ------------------------------------

    function getIndiaPostSlipData($order, $tracking_id) {
        $pickup_data = array(
            'return_status' => 3,
            'awb_no' => $tracking_id,
            'ready_date' => date('Y-m-d H:i:s')
        );

        $order_status = array(
            'order_id' => $order->order_id,
            'txn_id' => $order->txn_id,
            'track_status' => "Pick Up",
            'description' => "Your Order Is Pick Up",
            'location' => $order->city,
            'status_date' => date('Y-m-d H:i:s')
        );
        $this->db->update('return_order_mst', $pickup_data, array('order_id' => $order->order_id));
        $this->db->insert('return_order_status_mst', $order_status);
        return 1;
    }

}
