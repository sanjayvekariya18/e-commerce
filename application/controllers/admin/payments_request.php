<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payments_request extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->payout) {
            header('location:' . site_url() . 'admin');
        }
        $this->load->model('admin/m_payments_request', 'opayment');
    }

    function index() {
        $data['request'] = $this->opayment->getAllInReviewRequest();
        $this->load->view('admin/header');
        $this->load->view('admin/payments/request/request_mst', $data);
        $this->load->view('admin/footer');
    }
    
    function rejectRequest() {
        $data['request'] = $this->opayment->getAllRejectRequest();
        $this->load->view('admin/header');
        $this->load->view('admin/payments/request/reject_mst', $data);
        $this->load->view('admin/footer');
    }

    function requestPaid() {
        $request_id = base64_decode($this->input->get('id'));       
        $data['request'] = $this->opayment->getRequestData($request_id);
        $data['bank'] = $this->common->getBankDetails();
        $this->load->view('admin/header');
        $this->load->view('admin/payments/request/payments_request', $data);
        $this->load->view('admin/footer');
    }

    function payment() {
        $result = $this->opayment->payment();
        header("location:" . site_url() . "admin/payments_request?msg=S");
    }

    function payoutRequestSearch() {
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $data['request'] = $this->opayment->payoutRequestSearch($start, $end);
        $this->load->view('admin/header');
        $this->load->view('admin/payments/request/request_mst', $data);
        $this->load->view('admin/footer');
    }
    
    function payoutRequestRejectSearch() {
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $data['request'] = $this->opayment->payoutRequestRejectSearch($start, $end);
        $this->load->view('admin/header');
        $this->load->view('admin/payments/request/reject_mst', $data);
        $this->load->view('admin/footer');
    }

    function payoutStatusUpdate() {
        $this->opayment->payoutStatusUpdate();
        header("location:" . site_url() . "admin/payments_request?msg=U");
    }
    
    function payoutStatusRejectUpdate() {
        $this->opayment->payoutStatusUpdate();
        header("location:" . site_url() . "admin/payments_request/rejectRequest?msg=U");
    }

    function payout() {
        $data['payout'] = $this->opayment->getAllPayoutData();
        $this->load->view('admin/header');
        $this->load->view('admin/payments/payout/payout_mst', $data);
        $this->load->view('admin/footer');
    }

    function payoutSearch() {
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $data['payout'] = $this->opayment->getAllPayoutSearchData($start,$end);
        $this->load->view('admin/header');
        $this->load->view('admin/payments/payout/payout_mst', $data);
        $this->load->view('admin/footer');
    }
    
    function resetNewPayoutNotify() {
        $this->opayment->resetNewPayoutNotify();
        return 1;
    }

}
