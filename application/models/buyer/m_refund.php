<?php

class M_refund extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getRefundRequestData($customer_id) {
        $this->db->select('o.order_id,r.request_date,r.payment_date,r.pay_bank_name,o.product_name,s.business_name,r.transaction_id,r.amount,r.status');
        $this->db->from('refund_mst as r');
        $this->db->join('order_mst as o', 'r.order_id = o.order_id');
        $this->db->join('seller_mst as s', 'o.seller_id = s.seller_id');
        $this->db->join('customer_mst as c', 'o.customer_id = c.customer_id');
        $this->db->where('c.customer_id', $customer_id);
        $this->db->order_by('r.request_date');
        $query = $this->db->get();
        return $query->result();
    }

    function getRefundRequestSearchData($customer_id) {

        ($_POST['start'] != "") ? $where['DATE(r.request_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
        ($_POST['end'] != "") ? $where['DATE(r.request_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        ($_POST['pstart'] != "") ? $where['DATE(r.payment_date) >='] = date('Y-m-d', strtotime($_POST['pstart'])) : '';
        ($_POST['pend'] != "") ? $where['DATE(r.payment_date) <= '] = date('Y-m-d', strtotime($_POST['pend'])) : '';
        ($_POST['amount'] != "") ? $where['r.amount'] = $_POST['amount'] : '';
        ($_POST['transaction_id'] != "") ? $where['r.transaction_id'] = $_POST['transaction_id'] : '';

        if (isset($where)) {
            $this->db->select('o.order_id,r.request_date,r.payment_date,r.pay_bank_name,o.product_name,s.business_name,r.transaction_id,r.amount,r.status');
            $this->db->from('refund_mst as r');
            $this->db->join('order_mst as o', 'r.order_id = o.order_id');
            $this->db->join('seller_mst as s', 'o.seller_id = s.seller_id');
            $this->db->join('customer_mst as c', 'o.customer_id = c.customer_id');
            $this->db->where('c.customer_id', $customer_id);
            $this->db->where($where);
            $this->db->order_by('r.request_date');
            $query = $this->db->get();
            return $query->result();
        } else {
            $this->db->select('o.order_id,r.request_date,r.payment_date,r.pay_bank_name,o.product_name,s.business_name,r.transaction_id,r.amount,r.status');
            $this->db->from('refund_mst as r');
            $this->db->join('order_mst as o', 'r.order_id = o.order_id');
            $this->db->join('seller_mst as s', 'o.seller_id = s.seller_id');
            $this->db->join('customer_mst as c', 'o.customer_id = c.customer_id');
            $this->db->where('c.customer_id', $customer_id);
            $this->db->order_by('r.request_date');
            $query = $this->db->get();
            return $query->result();
        }
    }

    function resetNewRefundNotify() {
        $this->db->update('payout_notify_mst', array('status' => '1'), array('to_id' => $this->session->userdata('customer_id'), 'request_type' => '1'));
    }

}
