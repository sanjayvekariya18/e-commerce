<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Refund_paid extends CI_Controller {

    function __construct() {
        parent::__construct();
        if(!$this->common->logged_in()){
            header('location:' . site_url());
        }else if(!$this->common->getPermission($this->session->userdata('primary_email'))->refund_paid){
            header('location:'.site_url().'admin');
        }
        $this->load->model('admin/m_customer', 'ocustomer');
    }

    function index() {
        $data['refund'] = $this->ocustomer->getRefundPaidData();
        $this->load->view('admin/header');
        $this->load->view('admin/customer/refund_paid_mst', $data);
        $this->load->view('admin/footer');
    }

    function getRefundPaidSearchData() {
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $data['refund'] = $this->ocustomer->getRefundPaidSearchData($start, $end);
        $this->load->view('admin/header');
        $this->load->view('admin/customer/refund_paid_mst', $data);
        $this->load->view('admin/footer');
    }

    function getRefundDetail() {
        $id = $this->input->post('id');
        $data = $this->ocustomer->getRefundDetail($id);
        echo json_encode($data);
    }   
    

}
