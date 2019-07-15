<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payments extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->seller_logged_in()) {
            header('location:' . site_url());
        }
        $this->load->model('seller/m_payments', 'opayment');
    }

    function Payout() {
        $data['request'] = $this->opayment->getSellerPayoutRequest();
        $data['balance'] = $this->common->getSellerBalance($this->session->userdata('seller_id'));
        $this->load->view('seller/header');
        $this->load->view('seller/payments/payout_mst', $data);
        $this->load->view('seller/footer');
    }

    function addPayout() {
        $data['balance'] = $this->common->getSellerBalance($this->session->userdata('seller_id'));
        $data['amountpolicy'] = $this->common->amountPolicy();
        $this->load->view('seller/header');
        $this->load->view('seller/payments/add_payout', $data);
        $this->load->view('seller/footer');
    }

    function addPayoutRequest() {

        $balance = $this->common->getSellerBalance($this->session->userdata('seller_id'));
        $amountpolicy = $this->common->amountPolicy();

        $request_amount = $_POST['request'];
        $min_balance = $amountpolicy->min_balance;
        $min_withdraw_amount = $amountpolicy->min_withdraw_amount;
        $remain = $balance - $request_amount;

        if ($request_amount < $min_withdraw_amount && $remain < $min_balance) {
            header("location:" . site_url() . "seller/payments/payout?msg=W");
        } else {
            $result = $this->opayment->addPayoutRequest();
            header("location:" . site_url() . "seller/payments/payout?msg=S");
        }
    }

    function payoutRequestDelete() {
        $request_id = base64_decode($this->input->get('id'));
        $this->opayment->payoutRequestDelete($request_id);
        header("location:" . site_url() . "seller/payments/payout?msg=S");
    }
    
    function payoutRequestSearch() {        
        $start = date('Y-m-d', strtotime($this->input->post('start')));
        $end = date('Y-m-d', strtotime($this->input->post('end')));
        $data['request'] = $this->opayment->payoutRequestSearch($start, $end);
        $this->load->view('seller/header');
        $this->load->view('seller/payments/payout_mst', $data);
        $this->load->view('seller/footer');
    }

    function transaction() {
        $seller_id = $this->session->userdata('seller_id');
        $payable_data = $this->opayment->getAllPayableData($seller_id);
        $data['transaction'] = $this->opayment->getAllTransaction($seller_id, "-1", "-1");        
        $data['balance'] = $this->common->getSellerBalance($this->session->userdata('seller_id'));
        $this->load->view('seller/header');
        $this->load->view('seller/payments/transaction', $data);
        $this->load->view('seller/footer');
    }

    function transactionSearch() {
        $seller_id = $this->session->userdata('seller_id');
        $start = date('Y-m-d', strtotime($this->input->post('start')));
        $end = date('Y-m-d', strtotime($this->input->post('end')));
        $data['transaction'] = $this->opayment->getAllTransaction($seller_id, $start, $end);
        $data['balance'] = $this->common->getSellerBalance($this->session->userdata('seller_id'));
        $this->load->view('seller/header');
        $this->load->view('seller/payments/transaction', $data);
        $this->load->view('seller/footer');
    }

    function resetNewPayoutNotify() {
        $this->opayment->resetNewPayoutNotify();
        return 1;
    }
}
