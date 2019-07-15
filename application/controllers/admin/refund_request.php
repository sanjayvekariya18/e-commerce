<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Refund_request extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->customer) {
            header('location:' . site_url() . 'admin');
        }
        $this->load->model('admin/m_customer', 'ocustomer');
    }

    function index() {
        $data['request'] = $this->ocustomer->getRefundRequest();
        $this->load->view('admin/header');
        $this->load->view('admin/customer/refund_request_mst', $data);
        $this->load->view('admin/footer');
    }

    function refundRequestSearch() {
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $data['request'] = $this->ocustomer->refundRequestSearch($start, $end);
        $this->load->view('admin/header');
        $this->load->view('admin/customer/refund_request_mst', $data);
        $this->load->view('admin/footer');
    }
    
    function requestPaid() {
        $request_id = base64_decode($this->input->get('id'));
        $data['request'] = $this->ocustomer->getRequestData($request_id);
        $data['bank'] = $this->common->getBankDetails();
        $this->load->view('admin/header');
        $this->load->view('admin/customer/payments_request', $data);
        $this->load->view('admin/footer');
    }
    
    function refundRejected() {
        $this->ocustomer->refundRejected();
        header("location:" . site_url() . "admin/refund_request?msg=RS");
    }

    function payment() {
        $result = $this->ocustomer->payment();
        header("location:" . site_url() . "admin/refund_request?msg=S");
    }
    
    function resetNewRefundNotify() {
        $this->ocustomer->resetNewRefundNotify();
        return 1;
    }
    
    function reject() {
        $data['request'] = $this->ocustomer->getRefundRejectData();
        $this->load->view('admin/header');
        $this->load->view('admin/customer/refund_rejected_mst', $data);
        $this->load->view('admin/footer');
    }
    
    function refundRejectSearch() {
        $data['request'] = $this->ocustomer->getRefundRejectSearchData();
        $this->load->view('admin/header');
        $this->load->view('admin/customer/refund_rejected_mst', $data);
        $this->load->view('admin/footer');
    }
}
