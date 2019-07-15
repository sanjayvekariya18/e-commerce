<?php

class M_order extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('parser');
    }

    function getAllOrder() {
        $where = array(
            'o.payment_status' => "1",
            'DATE_FORMAT(o.order_date,"%Y-%m")' => date('Y-m')
        );

        $this->db->select('o.order_id,o.txn_id,o.product_id,o.product_name,o.qty,o.selling_price,o.total_price,o.payment_price,o.order_date,o.packing_by,o.pay_method,s.business_name,s.primary_mobile as business_mobile, c.first_name,c.primary_mobile as buyer_mobile');
        $this->db->from('order_mst as o');
        $this->db->join('seller_mst as s', 'o.seller_id = s.seller_id');
        $this->db->join('customer_mst as c', 'o.customer_id = c.customer_id');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    function search() {
        ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
        ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        ($_POST['order_id'] != "") ? $where['o.order_id'] = $_POST['order_id'] : '';
        ($_POST['selling_price'] != "") ? $where['t.selling_price'] = $_POST['selling_price'] : '';
        ($_POST['primary_email'] != "") ? $where['c.primary_email'] = $_POST['primary_email'] : '';
        ($_POST['primary_mobile'] != "") ? $where['c.primary_mobile'] = $_POST['primary_mobile'] : '';
        $where['o.payment_status'] = "1";

        $this->db->select('o.order_id,o.txn_id,o.product_id,o.product_name,o.qty,o.selling_price,o.total_price,o.payment_price,o.order_date,o.packing_by,o.pay_method,s.business_name,s.primary_mobile as business_mobile, c.first_name,c.primary_mobile as buyer_mobile');
        $this->db->from('order_mst as o');
        $this->db->join('seller_mst as s', 'o.seller_id = s.seller_id');
        $this->db->join('customer_mst as c', 'o.customer_id = c.customer_id');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    function getAllRequestOrder() {
        $where = array(
            'o.payment_status' => "1",
            'DATE_FORMAT(o.order_date,"%Y-%m")' => date('Y-m')
        );

        $this->db->select('o.order_id,o.txn_id,o.product_id,o.product_name,o.qty,o.selling_price,o.total_price,o.payment_price,o.order_date,o.packing_by,o.pay_method,o.request, c.first_name,c.primary_mobile as buyer_mobile');
        $this->db->from('order_mst as o');
        $this->db->join('customer_mst as c', 'o.customer_id = c.customer_id');
        $this->db->where($where);
        $this->db->where_in('o.request', array('1', '2', '3'));
        $query = $this->db->get();
        return $query->result();
    }

    function requestSearch() {
        ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
        ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        ($_POST['order_id'] != "") ? $where['o.order_id'] = $_POST['order_id'] : '';
        ($_POST['primary_email'] != "") ? $where['c.primary_email'] = $_POST['primary_email'] : '';
        ($_POST['primary_mobile'] != "") ? $where['c.primary_mobile'] = $_POST['primary_mobile'] : '';
        $where['o.payment_status'] = "1";

        $this->db->select('o.order_id,o.txn_id,o.product_id,o.product_name,o.qty,o.selling_price,o.total_price,o.payment_price,o.order_date,o.packing_by,o.pay_method,o.request, c.first_name,c.primary_mobile as buyer_mobile');
        $this->db->from('order_mst as o');
        $this->db->join('customer_mst as c', 'o.customer_id = c.customer_id');
        $this->db->where($where);
        $this->db->where_in('o.request', array('1', '2', '3'));
        $query = $this->db->get();
        return $query->result();
    }

    function cancel_search() {
        ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
        ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        ($_POST['order_id'] != "") ? $where['o.order_id'] = $_POST['order_id'] : '';
        ($_POST['selling_price'] != "") ? $where['t.selling_price'] = $_POST['selling_price'] : '';
        ($_POST['primary_email'] != "") ? $where['c.primary_email'] = $_POST['primary_email'] : '';
        ($_POST['primary_mobile'] != "") ? $where['c.primary_mobile'] = $_POST['primary_mobile'] : '';
        $where['o.payment_status'] = "1";

        $this->db->select('o.order_id,o.txn_id,o.product_name,o.qty,o.selling_price,o.total_price,o.payment_price,o.order_date,s.business_name,s.primary_mobile as business_mobile, c.first_name,c.primary_mobile as buyer_mobile');
        $this->db->from('order_mst as o');
        $this->db->join('seller_mst as s', 'o.seller_id = s.seller_id');
        $this->db->join('customer_mst as c', 'o.customer_id = c.customer_id');
        $this->db->where($where);
        $this->db->where_in('order_status', array('6', '8'));
        $query = $this->db->get();
        return $query->result();
    }

    function getTrackOrderData($order_id) {
        $this->db->select('o.id,o.order_id,o.invoice_id,o.customer_id,o.txn_id,o.awb_no,o.product_name,o.mrp,o.selling_price,o.weight,o.qty,o.total_price,o.payment_price,o.discount_price,o.cod_charge,o.pay_method,o.order_date,o.order_status,s.business_name,s.primary_mobile as seller_mobile,c.first_name,c.last_name,c.primary_mobile as customer_mobile,c.address,c.city,c.pincode,st.state_name,ro.awb_no as return_awb_no');
        $this->db->from('order_mst as o');
        $this->db->join('seller_mst as s', 'o.seller_id = s.seller_id');
        $this->db->join('customer_mst as c', 'o.customer_id = c.customer_id');
        $this->db->join('state_mst as st', 'c.state = st.id', 'left outer');
        $this->db->join('return_order_mst as ro', 'o.order_id = ro.order_id', 'left outer');
        $this->db->where('o.order_id', $order_id);
        $query = $this->db->get();
        return $query->row();
    }

    function getPackSlipData($order_id) {
        $this->db->select('o.order_id,o.product_id,o.customer_id,o.product_name,o.selling_price,o.colour,o.size,o.qty,o.shipping_charge,o.cod_charge,o.total_price,o.payment_price,o.order_date,o.pay_method,o.weight,o.txn_id,o.packing_id,o.packing_by,o.awb_no,o.form_id,o.service_type,o.barcode_string,o.awb_no_cod,o.form_id_cod,o.service_type_cod,o.barcode_string_cod,o.destination_id,o.destination_area,o.routing_code,o.shipped_date,o.airport_id,c.first_name,c.last_name,c.address,c.city,c.state,c.pincode,c.landmark,c.primary_mobile as "customer_contact",c.primary_email as "customer_email",s.first_name as "seller_fname",s.last_name as "seller_lname",s.business_name,s.pickup_address,s.pickup_landmark,s.pickup_city,s.pickup_state,s.pickup_pincode,s.tin_id,s.primary_mobile as "seller_contact",s.primary_email as "seller_email"');
        $this->db->from('order_mst as o,customer_mst as c,seller_mst as s');
        $this->db->where('o.customer_id = c.customer_id');
        $this->db->where('o.seller_id = s.seller_id');
        $this->db->where('o.order_id', $order_id);
        $query = $this->db->get();
        return $query->row();
    }

    function resetRequest($order_id) {
        $this->db->update('order_mst', array('request' => 0), array('order_id' => $order_id));
        return TRUE;
    }

    function rejectRequest($order_id) {
        $this->db->update('order_mst', array('request' => 4), array('order_id' => $order_id));
        return TRUE;
    }

    function getTrackOrderStatusData($order_id) {
        $query = $this->db->get_where('order_status_mst', array('order_id' => $order_id));
        return $query->result();
    }

    function updateAWB($order_id, $awb_no) {
        $query = $this->db->update('order_mst', array('awb_no' => $awb_no), array('order_id' => $order_id));
        return $this->db->affected_rows();
    }

    function getApprovedOrder() {
        $query = $this->db->get_where('order_mst', array('order_status' => 1, 'transite' => 0));
        return $query->result();
    }

    function getPickupOrder() {
        $query = $this->db->get_where('order_mst', array('order_status' => 2, 'transite' => 0));
        return $query->result();
    }

    function getReadyToShipOrder() {
        $query = $this->db->get_where('order_mst', array('order_status' => 3, 'transite' => 0));
        return $query->result();
    }

    function getTransiteOrder() {
        $this->db->where('transite', '1');
        $this->db->where_in('order_status', array('1', '2', '3'));
        $query = $this->db->get('order_mst');
        return $query->result();
    }

    function getDeliveredOrder() {
        $query = $this->db->get_where('order_mst', array('order_status' => 4));
        return $query->result();
    }

    function getReturnOrder() {
        $query = $this->db->get_where('order_mst', array('order_status' => 5));
        return $query->result();
    }

    function getCancelOrder() {
        $query = $this->db->get_where('order_mst', array('order_status' => 6));
        return $query->result();
    }

    function getReplaceOrder() {
        $query = $this->db->get_where('order_mst', array('order_status' => 7));
        return $query->result();
    }

    function getShipCancelOrder() {
        $query = $this->db->get_where('order_mst', array('order_status' => 8));
        return $query->result();
    }

    function updateOrder($order_id, $status) {
        $order = $this->common->getOrderById($order_id);
        if ($status == '0') {
            $order_data = array(
                'order_status' => 3,
                'transite' => '1',
                'ready_date' => date('Y-m-d H:i:s'),
                'shipped_date' => date('Y-m-d H:i:s')
            );
            $order_status = array(
                'order_id' => $order_id,
                'txn_id' => $order->txn_id,
                'track_status' => "Ready To Ship",
                'description' => "Your Order Is Ready To Ship",
                'location' => $this->common->getSellerDataByID($order->seller_id)->pickup_city,
                'status_date' => date('Y-m-d H:i:s')
            );

            $this->db->update('order_mst', $order_data, array('order_id' => $order_id));
            $this->db->insert('order_status_mst', $order_status);
        } else if ($status == '4') {
            $data = array(
                'order_id' => $order_id,
                'txn_id' => $order->txn_id,
                'track_status' => "Delivered",
                'description' => "Your Order Is Delivered",
                'location' => "-",
                'status_date' => date('Y-m-d H:i:s')
            );
            $updateorder = array(
                'order_status' => '4',
                'delivery_date' => date('Y-m-d H:i:s')
            );
            $this->db->insert('order_status_mst', $data);
            $this->db->update('order_mst', $updateorder, array('order_id' => $order_id));
        } else if ($status == '8') {

            $transaction_update = array(
                'shipping_charge' => $order->shipping_charge * 2
            );
            $data = array(
                'order_id' => $order_id,
                'txn_id' => $order->txn_id,
                'track_status' => "Shipment Cancelled",
                'description' => "Your Order Is Shipment Cancelled",
                'location' => "-",
                'status_date' => date('Y-m-d H:i:s')
            );
            $updateorder = array(
                'order_status' => '8',
                'cancel_date' => date('Y-m-d H:i:s')
            );
            $this->db->trans_start();

            if ($order->pay_method == "card") {

                $refund_request = array(
                    'order_id' => $order->order_id,
                    'amount' => $order->payment_price,
                    'bank_name' => $customer->bank_name,
                    'ifsc' => $customer->ifsc,
                    'account_no' => $customer->account_no,
                    'account_name' => $customer->account_name,
                    'request_date' => date('Y-m-d H:i:s')
                );

                $refund_request_notify = array(
                    'from_id' => $customer->customer_id,
                    'from_name' => $customer->first_name . " " . $customer->last_name,
                    'to_id' => '0',
                    'to_name' => 'Administrator',
                    'message' => "Refund Request To You With Amount :" . $order->payment_price,
                    'request_type' => '1'
                );
                $this->db->insert('refund_mst', $refund_request);
                $this->db->insert('payout_notify_mst', $refund_request_notify);
            }

            $this->db->insert('order_status_mst', $data);
            $this->db->update('order_mst', $updateorder, array('order_id' => $order_id));
            $this->db->update('transaction_mst', $transaction_update, array('order_id' => $order_id));
            $this->db->trans_complete();
            $this->sendMailToSeller($order);
            $this->sendMailToBuyer($order);
        }
        return 1;
    }

    function approveRequest($order_id) {
        $order = $this->common->getOrderById($order_id);
        if ($order->request == "1") {
            //Cancel order         
            $result = $this->cancelOrder($order);
        } else if ($order->request == "2") {
            //Replace order 
            $result = $this->replaceOrder($order);
        } else if ($order->request == "3") {
            //Return order
            $result = $this->returnOrder($order);
        }
        return $result;
    }

    function cancelOrder($order_data) {
        $customer = $this->common->getCustomerDataById($order_data->customer_id);
        $status = array(
            'order_status' => ($order_data->transite == "0") ? "6" : "8",
            'request' => "5"
        );

        $order_notify = array(
            'order_id' => $order_data->order_id,
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
                'order_id' => $order_data->order_id,
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
                'order_id' => $order_data->order_id,
                'txn_id' => $order_data->txn_id,
                'track_status' => "Shipped Cancel",
                'description' => "Your Order Is Shipped Cancelled",
                'location' => "-",
                'status_date' => date('Y-m-d H:i:s')
            );
        }

        $this->db->trans_start();
        $this->db->update('order_mst', $status, array('order_id' => $order_data->order_id));
        $this->db->update('transaction_mst', $transaction_update, array('order_id' => $order_data->order_id));
        $this->db->insert('order_notify_mst', $order_notify);
        $this->db->insert('order_status_mst', $order_status);

        if ($order_data->pay_method == "card") {

            $refund_request = array(
                'order_id' => $order_data->order_id,
                'amount' => $order_data->payment_price,
                'bank_name' => $customer->bank_name,
                'ifsc' => $customer->ifsc,
                'account_no' => $customer->account_no,
                'account_name' => $customer->account_name,
                'request_date' => date('Y-m-d H:i:s')
            );

            $refund_request_notify = array(
                'from_id' => $customer->customer_id,
                'from_name' => $customer->first_name . " " . $customer->first_name,
                'to_id' => '0',
                'to_name' => 'Administrator',
                'message' => "Refund Request To You With Amount :" . $order_data->payment_price,
                'request_type' => '1'
            );

            $this->db->insert('refund_mst', $refund_request);
            $this->db->insert('payout_notify_mst', $refund_request_notify);
        }
        $this->db->trans_complete();
        $this->sendMailToSeller($order_data);
        $this->sendMailToBuyer($order_data);
        return "Order Successfully Cancelled";
    }

    function replaceOrder($order_data) {

        $status = array(
            'order_status' => '7',
            'request' => '5'
        );
        $order_notify = array(
            'order_id' => $order_data->order_id,
            'seller_id' => $order_data->seller_id,
            'total_price' => $order_data->payment_price,
            'order_status' => '7',
            'notify_date' => date('Y-m-d H:i:s')
        );

        $order_status = array(
            'order_id' => $order_data->order_id,
            'txn_id' => $order_data->txn_id,
            'track_status' => "Replace",
            'description' => "Your Order Is Replace",
            'location' => "-",
            'status_date' => date('Y-m-d H:i:s')
        );

        //IF DTDC THEN REQUEST FOR UPLOAD ORDER
        if ($order_data->packing_by == 3) {
            $returnOrder = array(
                'order_id' => $order_data->order_id,
                'txn_id' => $order_data->txn_id,
                'return_status' => "3",
                'return_date' => date('Y-m-d H:i:s'),
                'ready_date' => date('Y-m-d H:i:s')
            );
            $result = explode("|", $this->getDtdcSlipData($order_data->order_id));
            if ($result[0] == '1') {
                $this->db->trans_start();
                $this->db->update('order_mst', $status, array('order_id' => $order_data->order_id));
                $this->db->insert('order_notify_mst', $order_notify);
                $this->db->insert('order_status_mst', $order_status);
                $this->db->insert('return_order_mst', $returnOrder);
                $this->ocart->replaceOrder($order_data->order_id);
                $this->db->trans_complete();
                return $result[1];
            } else {
                return $result[1];
            }
        } else {
            $returnOrder = array(
                'order_id' => $order_data->order_id,
                'txn_id' => $order_data->txn_id,
                'return_date' => date('Y-m-d H:i:s')
            );
            $this->db->trans_start();
            $this->db->update('order_mst', $status, array('order_id' => $order_data->order_id));
            $this->db->insert('order_notify_mst', $order_notify);
            $this->db->insert('order_status_mst', $order_status);
            $this->db->insert('return_order_mst', $returnOrder);
            $this->ocart->replaceOrder($order_data->order_id);
            $this->db->trans_complete();
            return "Order No Uploaded Successfully";
        }
    }

    function returnOrder($order_data) {
        $customer = $this->common->getCustomerDataById($order_data->customer_id);
        $status = array(
            'order_status' => '5',
            'request' => '5'
        );
        $order_notify = array(
            'order_id' => $order_data->order_id,
            'seller_id' => $order_data->seller_id,
            'total_price' => $order_data->payment_price,
            'order_status' => '5',
            'notify_date' => date('Y-m-d H:i:s')
        );

        $refund_request = array(
            'order_id' => $order_data->order_id,
            'amount' => $order_data->payment_price,
            'bank_name' => $customer->bank_name,
            'ifsc' => $customer->ifsc,
            'account_no' => $customer->account_no,
            'account_name' => $customer->account_name,
            'request_date' => date('Y-m-d H:i:s')
        );

        $refund_request_notify = array(
            'from_id' => $customer->customer_id,
            'from_name' => $customer->first_name . " " . $customer->first_name,
            'to_id' => '0',
            'to_name' => 'Administrator',
            'message' => "Refund Request To You With Amount :" . $order_data->payment_price,
            'request_type' => '1'
        );

        $transaction_update = array(
            'shipping_charge' => $order_data->shipping_charge * 2,
        );

        $order_status = array(
            'order_id' => $order_data->order_id,
            'txn_id' => $order_data->txn_id,
            'track_status' => "Return",
            'description' => "Your Order Is Return",
            'location' => "-",
            'status_date' => date('Y-m-d H:i:s')
        );

        if ($order_data->packing_by == 3) {
            $returnOrder = array(
                'order_id' => $order_data->order_id,
                'txn_id' => $order_data->txn_id,
                'return_status' => "3",
                'return_date' => date('Y-m-d H:i:s'),
                'ready_date' => date('Y-m-d H:i:s')
            );
            $result = explode("|", $this->getDtdcSlipData($order_data->order_id));
            if ($result[0] == '1') {
                $this->db->trans_start();
                $this->db->update('order_mst', $status, array('order_id' => $order_data->order_id));
                $this->db->update('transaction_mst', $transaction_update, array('order_id' => $order_data->order_id));
                $this->db->insert('order_notify_mst', $order_notify);
                $this->db->insert('refund_mst', $refund_request);
                $this->db->insert('payout_notify_mst', $refund_request_notify);
                $this->db->insert('order_status_mst', $order_status);
                $this->db->insert('return_order_mst', $returnOrder);
                $this->db->trans_complete();
                return $result[1];
            } else {
                return $result[1];
            }
        } else {
            $returnOrder = array(
                'order_id' => $order_data->order_id,
                'txn_id' => $order_data->txn_id,
                'return_date' => date('Y-m-d H:i:s')
            );
            $this->db->trans_start();
            $this->db->update('order_mst', $status, array('order_id' => $order_data->order_id));
            $this->db->update('transaction_mst', $transaction_update, array('order_id' => $order_data->order_id));
            $this->db->insert('order_notify_mst', $order_notify);
            $this->db->insert('refund_mst', $refund_request);
            $this->db->insert('payout_notify_mst', $refund_request_notify);
            $this->db->insert('order_status_mst', $order_status);
            $this->db->insert('return_order_mst', $returnOrder);
            $this->db->trans_complete();
            return "Order No Uploaded Successfully";
        }
    }

    function getTrackingId($packing_by) {
        if ($packing_by == 3) {
            $query = $this->db->get_where('dtdc_details_mst', array('status' => '0', 'tracking_id like' => "7%"));
            return isset($query->row()->tracking_id) ? $query->row()->tracking_id : '';
        } else if ($packing_by == 2) {
            $query = $this->db->get_where('indiapost_details_mst', array('status' => '0'));
            return isset($query->row()->tracking_id) ? $query->row()->tracking_id : '';
        }
    }

    function getDtdcSlipData($order_id) {
        $order = $this->getPackSlipData($order_id);
        $cdtdc = $this->common->getDtdcPincode($order->pincode);
        $sdtdc = $this->common->getDtdcPincode($order->pickup_pincode);
        $tracking_id = $this->getTrackingId('3');
        $mode = "P";
        $collect = 0;


        try {
            $clientId = 'INSTACOM';
            $userName = 'instauser';
            $password = 'insta2013';
            $xml_batch = '<NewDataSet>
            <Customer>
            <CUSTCD>CC000100945</CUSTCD>
            </Customer>
            <Docket>
            <Order_No>' . $order->order_id . '</Order_No>
            <AGENT_ID></AGENT_ID>
            <Product_Code>' . $order->product_id . '</Product_Code>
            <Item_Name>' . preg_replace('/[^A-Za-z0-9, \-]/', '', $order->product_name) . '</Item_Name>
            <AWB_No>' . $tracking_id . '</AWB_No>
            <N0_of_Pieces>' . $order->qty . '</N0_of_Pieces>
            <Customer_Name>' . preg_replace('/[^A-Za-z0-9, \-]/', '', $order->business_name) . '</Customer_Name>
            <Shipping_Add1>' . preg_replace('/[^A-Za-z0-9, \-]/', '', $order->pickup_address) . '</Shipping_Add1>
            <Shipping_Add2>' . preg_replace('/[^A-Za-z0-9, \-]/', '', $order->pickup_landmark) . '</Shipping_Add2>
            <Shipping_City>' . $sdtdc->city . '</Shipping_City>
            <Shipping_State>' . $sdtdc->state . '</Shipping_State>
            <Shipping_Zip>' . $sdtdc->pincode . '</Shipping_Zip>
            <Shipping_TeleNo>' . $order->seller_contact . '</Shipping_TeleNo>
            <Shipping_MobileNo>' . $order->seller_contact . '</Shipping_MobileNo>
            <Shipping_EmailId>' . $order->seller_email . '</Shipping_EmailId>
            <Total_Amt>' . $order->payment_price . '</Total_Amt>
            <Mode>' . $mode . '</Mode>                
            <Collectable_amount>' . $collect . '</Collectable_amount>
            <Weight>' . ($order->weight * $order->qty / 1000) . '</Weight>
            <UOM>Per KG</UOM>
            <Type_of_Service>Express</Type_of_Service>
            <VendorName>' . $order->first_name . " " . $order->last_name . '</VendorName>
            <VendorAddress1>' . preg_replace('/[^A-Za-z0-9, \-]/', '', $order->address) . '</VendorAddress1>
            <VendorAddress2>' . preg_replace('/[^A-Za-z0-9, \-]/', '', $order->landmark) . '</VendorAddress2>
            <VendorPincode>' . $cdtdc->pincode . '</VendorPincode>
            <VendorTeleNo>' . $order->customer_contact . '</VendorTeleNo>
            <IsPUDO>N</IsPUDO>
            <TypeOfDelivery>HOME DELIVERY</TypeOfDelivery>
            <PUDO_Id></PUDO_Id>
            </Docket>
            </NewDataSet>';


            $url = "http://instacom.dotzot.in/services/InstacomCustomerServices.asmx/PushOrderData_PUDO";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "ClientId=" . $clientId . "&UserName=" . $userName . "&Password=" . $password . "&xmlBatch=" . $xml_batch);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('application/x-www-form-urlencoded'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $data = simplexml_load_string(curl_exec($ch));
            curl_close($ch);

            $p = xml_parser_create();
            xml_parse_into_struct($p, $data, $vals);
            xml_parser_free($p);

            $responce = array();

            foreach ($vals as $val) {
                if (isset($val['value'])) {
                    $responce[$val['tag']] = $val['value'];
                }
            }
            if ($responce['SUCCEED'] == "Yes") {
                $this->db->update('return_order_mst', array('awb_no' => $tracking_id), array('order_id' => $order->order_id));
                return "1|" . $responce['REASON'];
            } else {
                return "0|" . $responce['REASON'];
            }
        } catch (SoapFault $exception) {
            
        }
    }

    function sendMailToSeller($order_data) {
        $seller = $this->common->getSellerDataById($order_data->seller_id);
        $templateInfo = $this->common->getMailTemplate("ORDER CANCELLED", "Seller");
        $smstemplateInfo = $this->common->getSmsTemplate("ORDER CANCELLED", "Seller");

        $link = "<table border='1' align='center' cellpadding='5' cellspacing='2' width='100%' style='border-collapse: collapse;border-spacing: 0;'>";
        $link .= "<tr>";
        $link .= "<th>Product Name </th>";
        $link .= "<th>Price </th>";
        $link .= "<th>Qty </th>";
        $link .= "<th>Total </th>";
        $link .= "</tr>";
        $link .= "<tr>";
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
        $link .= "<th>Product Name </th>";
        $link .= "<th>Price </th>";
        $link .= "<th>Qty </th>";
        $link .= "<th>Total </th>";
        $link .= "</tr>";
        $link .= "<tr>";
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

    function getInTransiteReturnOrder() {
        $where = array(
            'o.payment_status' => '1',
            'r.return_status' => '3'
        );
        $this->db->select('o.order_id,o.invoice_id,o.customer_id,o.seller_id,o.product_id,o.product_name,o.image_thumb,o.brand,o.style_code,o.sku,o.selling_price,o.payment_price,o.weight,o.shipping_time,o.colour,o.size,o.qty,o.order_date,o.delivery_date,o.order_status,o.packing_by,s.business_name,r.awb_no');
        $this->db->from('order_mst as o');
        $this->db->join('seller_mst as s', 'o.seller_id = s.seller_id');
        $this->db->join('return_order_mst as r', 'o.order_id = r.order_id');
        $this->db->order_by('o.return_date', 'ASC');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    function getCompleteReturnOrder() {
        $where = array(
            'o.payment_status' => '1',
            'r.return_status' => '4'
        );
        $this->db->select('o.order_id,o.invoice_id,o.customer_id,o.seller_id,o.product_id,o.product_name,o.image_thumb,o.brand,o.style_code,o.sku,o.selling_price,o.payment_price,o.weight,o.shipping_time,o.colour,o.size,o.qty,o.order_date,o.delivery_date,o.order_status,o.packing_by,s.business_name,r.awb_no');
        $this->db->from('order_mst as o');
        $this->db->join('seller_mst as s', 'o.seller_id = s.seller_id');
        $this->db->join('return_order_mst as r', 'o.order_id = r.order_id');
        $this->db->order_by('o.return_date', 'ASC');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    function updateReturnOrder($order_id) {
        $this->db->update('return_order_mst', array('return_status' => '4'), array('order_id' => $order_id));
        return 1;
    }

}
