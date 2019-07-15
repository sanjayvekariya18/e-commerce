<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Refund extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->customer_logged_in()) {
            header('location:' . site_url());
        }
        $this->load->model('buyer/m_refund', 'orefund');
    }

    function index() {        
        $customer_id = $this->session->userdata('customer_id');                
        $data['refund'] = $this->orefund->getRefundRequestData($customer_id);
        $this->load->view('buyer/header');
        $this->load->view('buyer/refund_request/refund_request_mst',$data);
        $this->load->view('buyer/footer');
    }
    
    function refundRequestSearch() {
        $customer_id = $this->session->userdata('customer_id');
        $data['refund'] = $this->orefund->getRefundRequestSearchData($customer_id);
        $this->load->view('buyer/header');
        $this->load->view('buyer/refund_request/refund_request_mst',$data);
        $this->load->view('buyer/footer');
    }
    
    function resetNewRefundNotify() {
        $this->orefund->resetNewRefundNotify();
        return 1;
    }
}
