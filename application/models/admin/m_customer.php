<?php

class M_customer extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('parser');
    }

    function getAllCustomers() {
        $this->db->select('c.customer_id,c.first_name,c.last_name,c.city,st.state_name,c.primary_email,c.primary_mobile,c.reg_date,c.join_via,l.status');
        $this->db->from('customer_mst as c');
        $this->db->join('state_mst as st', 'c.state = st.id');
        $this->db->join('login_mst as l', 'c.primary_email = l.email');
        $query = $this->db->get();
        return $query->result();
    }

    function getSearchCustomers() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(reg_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(reg_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
            ($_POST['primary_mobile'] != "") ? $where['primary_mobile'] = $_POST['primary_mobile'] : '';
            ($_POST['primary_email'] != "") ? $where['primary_email'] = $_POST['primary_email'] : '';
        }
        if (isset($where)) {
            $this->db->select('c.customer_id,c.first_name,c.last_name,c.city,st.state_name,c.primary_email,c.primary_mobile,c.reg_date,c.join_via,l.status');
            $this->db->from('customer_mst as c');
            $this->db->join('state_mst as st', 'c.state = st.id');
            $this->db->join('login_mst as l', 'c.primary_email = l.email');
            $this->db->where($where);
            $query = $this->db->get();
            return $query->result();
        } else {
            $this->db->select('c.customer_id,c.first_name,c.last_name,c.city,st.state_name,c.primary_email,c.primary_mobile,c.reg_date,c.join_via,l.status');
            $this->db->from('customer_mst as c');
            $this->db->join('state_mst as st', 'c.state = st.id');
            $this->db->join('login_mst as l', 'c.primary_email = l.email');
            $query = $this->db->get();
            return $query->result();
        }
    }

    function getRefundRequest() {
        $this->db->select('r.id,o.order_id,r.request_date,c.first_name,c.last_name,s.business_name,r.amount,r.status,ro.awb_no');
        $this->db->from('refund_mst as r');
        $this->db->join('order_mst as o', 'r.order_id = o.order_id');
        $this->db->join('seller_mst as s', 'o.seller_id = s.seller_id');
        $this->db->join('customer_mst as c', 'o.customer_id = c.customer_id');
        $this->db->join('return_order_mst as ro', 'r.order_id = ro.order_id','left outer');
        $this->db->where('r.status', '0');
        $this->db->order_by('r.request_date');
        $query = $this->db->get();        
        return $query->result();
    }

    function refundRequestSearch($start, $end) {
        ($start != "") ? $where['DATE(r.request_date) >='] = date('Y-m-d', strtotime($start)) : '';
        ($end != "") ? $where['DATE(r.request_date) <= '] = date('Y-m-d', strtotime($end)) : '';
        ($_POST['first_name'] != "") ? $where['c.first_name'] = $_POST['first_name'] : '';
        ($_POST['last_name'] != "") ? $where['c.last_name'] = $_POST['last_name'] : '';
        ($_POST['business_name'] != "") ? $where['s.business_name'] = $_POST['business_name'] : '';
        ($_POST['amount'] != "") ? $where['r.amount'] = $_POST['amount'] : '';

        $this->db->select('r.id,o.order_id,r.request_date,c.first_name,c.last_name,s.business_name,r.amount,r.status,ro.awb_no');
        $this->db->from('refund_mst as r');
        $this->db->join('order_mst as o', 'r.order_id = o.order_id');
        $this->db->join('seller_mst as s', 'o.seller_id = s.seller_id');
        $this->db->join('customer_mst as c', 'o.customer_id = c.customer_id');
        $this->db->join('return_order_mst as ro', 'r.order_id = ro.order_id','left outer');
        $this->db->where('r.status', '0');
        $this->db->where($where);
        $this->db->order_by('r.request_date');
        $query = $this->db->get();
        return $query->result();
    }

    function getRequestData($request_id) {
        $this->db->select('r.id,r.order_id,c.customer_id,c.first_name,c.last_name,r.amount,r.account_name,r.account_no,b.bank_name,r.ifsc');
        $this->db->from('refund_mst as r');
        $this->db->join('order_mst as o', 'r.order_id = o.order_id');
        $this->db->join('customer_mst as c', 'o.customer_id = c.customer_id');
        $this->db->join('bank_name_mst as b', 'r.bank_name = b.id');
        $this->db->where('r.id', $request_id);
        $query = $this->db->get();
        return $query->row();
    }
    
    function refundRejected() {
        $this->db->where_in('id', $this->input->post('allRequest'));
        $this->db->update('refund_mst', array('status' => "2")); // 2 - Rejected
        return 1;
    }

    function payment() {

        $request_id = base64_decode($this->input->post('request_id'));
        $order_id = base64_decode($this->input->post('order_id'));
        $customer_id = base64_decode($this->input->post('customer_id'));
        $customer = $this->common->getCustomerDataById($customer_id);

        $amount = $_POST['amount_paid'];
        $data = array(
            'payment' => $amount,
            'pay_bank_name' => $_POST['bank_name'],
            'transaction_id' => $_POST['transaction_id'],
            'payment_date' => date('Y-m-d', strtotime($_POST['payment_date'])),
            'status' => '1'
        );

        $refund_notify = array(
            'from_id' => '0',
            'from_name' => "Administrator",
            'to_id' => $customer->customer_id,
            'to_name' => $customer->first_name . " " . $customer->last_name,
            'message' => "Refund Credited With Amount :" . $amount,
            'request_type' => '1'
        );

        $this->db->update('refund_mst', $data, array('id' => $request_id));
        $this->db->update('order_mst', array('order_status' => '9'), array('order_id' => $order_id));
        $this->db->insert('payout_notify_mst', $refund_notify);
        $this->sendPaymentMailToBuyer($customer, $amount);
        return 1;
    }

    // ------------------------- REFUND MAIL + SMS TO BUYER ---------------------------

    function sendPaymentMailToBuyer($customer, $amount) {
        $templateInfo = $this->common->getMailTemplate("REFUND E-MAIL", "Buyer");
        $smstemplateInfo = $this->common->getSmsTemplate("REFUND SMS", "Buyer");
        $tag = array(
            'FIRST_NAME' => $customer->first_name,
            'LAST_NAME' => $customer->last_name,
            'AMOUNT' => $amount
        );

        //EMAIL CODE

        $subject = $this->parser->parse_string($templateInfo->mail_subject, $tag, TRUE);
        $from = ($templateInfo->from != "") ? $templateInfo->from : NULL;
        $name = ($templateInfo->name != "") ? $templateInfo->name : NULL;
        $to = $customer->primary_email;
        $this->load->view('email_format', $templateInfo, TRUE);
        $body = $this->parser->parse('email_format', $tag, TRUE);
        $this->common->sendEmail($from, $to, $subject, $body, $name);

        // SMS CODE

        $message = $this->parser->parse_string($smstemplateInfo->message, $tag, TRUE);
        $to_mobile = $customer->primary_mobile;
        $this->common->SMSSend($to_mobile, $message, true);
    }

    function resetNewRefundNotify() {
        $this->db->update('payout_notify_mst', array('status' => '1'), array('to_id' => '0', 'request_type' => '1'));
    }

    function getRefundPaidData() {
        $this->db->select('r.id,r.order_id,r.payment_date,r.pay_bank_name,o.product_name,s.business_name,r.transaction_id,r.amount,c.first_name,c.last_name');
        $this->db->from('refund_mst as r');
        $this->db->join('order_mst as o', 'r.order_id = o.order_id');
        $this->db->join('seller_mst as s', 'o.seller_id = s.seller_id');
        $this->db->join('customer_mst as c', 'o.customer_id = c.customer_id');
        $this->db->where('r.status', '1');
        $this->db->order_by('r.request_date');
        $query = $this->db->get();
        return $query->result();
    }

    function getRefundPaidSearchData($start, $end) {

        ($start != "") ? $where['DATE(r.payment_date) >='] = date('Y-m-d', strtotime($start)) : '';
        ($end != "") ? $where['DATE(r.payment_date) <= '] = date('Y-m-d', strtotime($end)) : '';
        ($_POST['business_name'] != "") ? $where['s.business_name'] = $_POST['business_name'] : '';
        ($_POST['amount'] != "") ? $where['r.amount'] = $_POST['amount'] : '';
        ($_POST['transaction_id'] != "") ? $where['r.transaction_id'] = $_POST['transaction_id'] : '';
        
        $this->db->select('r.id,r.order_id,r.payment_date,r.pay_bank_name,o.product_name,s.business_name,r.transaction_id,r.amount,c.first_name,c.last_name');
        $this->db->from('refund_mst as r');
        $this->db->join('order_mst as o', 'r.order_id = o.order_id');
        $this->db->join('seller_mst as s', 'o.seller_id = s.seller_id');
        $this->db->join('customer_mst as c', 'o.customer_id = c.customer_id');
        $this->db->where('r.status', '1');
        $this->db->where($where);
        $this->db->order_by('r.request_date');
        $query = $this->db->get();
        return $query->result();
    }

    function getRefundDetail($id) {
        $this->db->select('r.request_date,r.payment_date,r.payment,r.transaction_id,r.pay_bank_name,b.bank_name,r.ifsc,r.account_name,r.account_no,o.product_name');
        $this->db->from('refund_mst as r');
        $this->db->join('order_mst as o', 'r.order_id = o.order_id');
        $this->db->join('bank_name_mst as b', 'r.bank_name = b.id');
        $this->db->where('r.id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
    function getRefundRejectData() {
        $this->db->select('r.id,o.order_id,r.request_date,c.first_name,c.last_name,s.business_name,r.amount,r.status');
        $this->db->from('refund_mst as r');
        $this->db->join('order_mst as o', 'r.order_id = o.order_id');
        $this->db->join('seller_mst as s', 'o.seller_id = s.seller_id');
        $this->db->join('customer_mst as c', 'o.customer_id = c.customer_id');
        $this->db->where('r.status', '2');
        $this->db->order_by('r.request_date');
        $query = $this->db->get();
        return $query->result();
    }

    function getRefundRejectSearchData() {
        ($_POST['start'] != "") ? $where['DATE(r.request_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
        ($_POST['end'] != "") ? $where['DATE(r.request_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        ($_POST['first_name'] != "") ? $where['c.first_name'] = $_POST['first_name'] : '';
        ($_POST['last_name'] != "") ? $where['c.last_name'] = $_POST['last_name'] : '';
        ($_POST['business_name'] != "") ? $where['s.business_name'] = $_POST['business_name'] : '';
        ($_POST['amount'] != "") ? $where['r.amount'] = $_POST['amount'] : '';

        $this->db->select('r.id,o.order_id,r.request_date,c.first_name,c.last_name,s.business_name,r.amount,r.status');
        $this->db->from('refund_mst as r');
        $this->db->join('order_mst as o', 'r.order_id = o.order_id');
        $this->db->join('seller_mst as s', 'o.seller_id = s.seller_id');
        $this->db->join('customer_mst as c', 'o.customer_id = c.customer_id');
        $this->db->where('r.status', '2');
        isset($where)?$this->db->where($where):"";
        $this->db->order_by('r.request_date');
        $query = $this->db->get();
        return $query->result();
    }
    
    

}
