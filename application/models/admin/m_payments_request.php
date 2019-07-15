<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_payments_request extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('parser');
    }

    function getAllInReviewRequest() {
        $this->db->select('p.request_id,p.request_date,p.amount,p.status,s.business_name');
        $this->db->from('payout_request_mst as p');
        $this->db->join('seller_mst as s', 'p.seller_id = s.seller_id');
        $this->db->where('p.status', '0');
        $query = $this->db->get();
        return $query->result();
    }
    
    function getAllRejectRequest() {
        $this->db->select('p.request_id,p.request_date,p.amount,p.status,s.business_name');
        $this->db->from('payout_request_mst as p');
        $this->db->join('seller_mst as s', 'p.seller_id = s.seller_id');
        $this->db->where_in('p.status', array('2','3'));
        $query = $this->db->get();
        return $query->result();
    }

    function getRequestData($request_id) {
        $this->db->select('p.request_id,p.seller_id,p.amount,p.account_name,p.account_no,b.bank_name,p.bank_ifsc,s.business_name');
        $this->db->from('payout_request_mst as p');
        $this->db->join('bank_name_mst as b', 'p.bank_name = b.id');
        $this->db->join('seller_mst as s', 'p.seller_id = s.seller_id');
        $this->db->where('p.request_id',$request_id);
        $query = $this->db->get();
        return $query->row();
    }

    function payment() {
        $seller_id = base64_decode($_POST['seller_id']);
        $seller = $this->common->getSellerDataById($seller_id);
        $amount = $_POST['amount'];
        $data = array(
            'pay_bank_name' => $_POST['bank_name'],
            'reference_id' => $_POST['reference_id'],
            'transaction_id' => $_POST['transaction_id'],
            'payment_date' => date('Y-m-d', strtotime($_POST['payment_date'])),
            'status' => '1'
        );

        $payout_request_notify = array(
            'from_id' => '0',
            'from_name' => "Administrator",
            'to_id' => $seller->seller_id,
            'to_name' => $seller->business_name,
            'message' => "Payment Transfer To You With Amount :" . $amount
        );

        $this->db->update('payout_request_mst', $data, array('request_id' => base64_decode($_POST['request_id'])));
        $this->db->insert('payout_notify_mst', $payout_request_notify);
        $this->sendPaymentMailToSeller($seller, $amount);
        return 1;
    }

    // ------------------------- PAYMENT MAIL + SMS TO SELLER ---------------------------

    function sendPaymentMailToSeller($seller, $amount) {
        $templateInfo = $this->common->getMailTemplate("PAYMENT E-MAIL", "Seller");
        $smstemplateInfo = $this->common->getSmsTemplate("PAYMENT SMS", "Seller");
        $tag = array(
            'BUSINESS_NAME' => $seller->business_name,
            'AMOUNT' => $amount
        );

        //EMAIL CODE

        $subject = $this->parser->parse_string($templateInfo->mail_subject, $tag, TRUE);
        $from = ($templateInfo->from != "") ? $templateInfo->from : NULL;
        $name = ($templateInfo->name != "") ? $templateInfo->name : NULL;
        $to = $seller->primary_email;
        $this->load->view('email_format', $templateInfo, TRUE);
        $body = $this->parser->parse('email_format', $tag, TRUE);
        $this->common->sendEmail($from, $to, $subject, $body, $name);

        // SMS CODE

        $message = $this->parser->parse_string($smstemplateInfo->message, $tag, TRUE);
        $to_mobile = $seller->primary_mobile;
        $this->common->SMSSend($to_mobile, $message, true);
    }

    function payoutRequestSearch($start, $end) {
        ($start != "") ? $where['DATE(p.request_date) >='] = date('Y-m-d', strtotime($start)) : '';
        ($end != "") ? $where['DATE(p.request_date) <= '] = date('Y-m-d', strtotime($end)) : '';
        ($_POST['business_name'] != "") ? $where['s.business_name'] = $_POST['business_name'] : '';
        ($_POST['amount'] != "") ? $where['p.amount'] = $_POST['amount'] : '';


        $this->db->select('p.request_id,p.request_date,p.amount,p.status,s.business_name');
        $this->db->from('payout_request_mst as p');
        $this->db->join('seller_mst as s', 'p.seller_id = s.seller_id');
        $this->db->where('p.status', '0');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }
    
    function payoutRequestRejectSearch($start, $end) {
        ($start != "") ? $where['DATE(p.request_date) >='] = date('Y-m-d', strtotime($start)) : '';
        ($end != "") ? $where['DATE(p.request_date) <= '] = date('Y-m-d', strtotime($end)) : '';
        ($_POST['business_name'] != "") ? $where['s.business_name'] = $_POST['business_name'] : '';
        ($_POST['amount'] != "") ? $where['p.amount'] = $_POST['amount'] : '';


        $this->db->select('p.request_id,p.request_date,p.amount,p.status,s.business_name');
        $this->db->from('payout_request_mst as p');
        $this->db->join('seller_mst as s', 'p.seller_id = s.seller_id');
        $this->db->where_in('p.status', array('2','3'));
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    function payoutStatusUpdate() {
        $status = $this->input->post('status');
        $this->db->where_in('request_id', $this->input->post('allRequest'));
        $this->db->update('payout_request_mst', array('status' => $status));
        return 1;
    }

    function getAllPayoutData() {
        $this->db->select('p.payment_date,p.amount,p.status,p.transaction_id,s.business_name,pay_bank_name');
        $this->db->from('payout_request_mst as p');
        $this->db->join('seller_mst as s', 'p.seller_id = s.seller_id');
        $this->db->where('p.status <> ', '0');
        $query = $this->db->get();
        return $query->result();
    }

    function getAllPayoutSearchData($start, $end) {
        ($start != "") ? $where['DATE(p.payment_date) >='] = date('Y-m-d', strtotime($start)) : '';
        ($end != "") ? $where['DATE(p.payment_date) <= '] = date('Y-m-d', strtotime($end)) : '';
        ($_POST['business_name'] != "") ? $where['s.business_name'] = $_POST['business_name'] : '';
        ($_POST['amount'] != "") ? $where['p.amount'] = $_POST['amount'] : '';
        ($_POST['transaction_id'] != "") ? $where['p.transaction_id'] = $_POST['transaction_id'] : '';

        $this->db->select('p.payment_date,p.amount,p.status,p.transaction_id,s.business_name,pay_bank_name');
        $this->db->from('payout_request_mst as p');
        $this->db->join('seller_mst as s', 'p.seller_id = s.seller_id');
        $this->db->where('p.status <> ', '0');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    function resetNewPayoutNotify() {
        $this->db->update('payout_notify_mst', array('status' => '1'), array('to_id' => '0', 'request_type' => '0'));
    }

}
