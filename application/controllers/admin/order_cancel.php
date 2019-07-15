<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order_cancel extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->order_cancel) {
            header('location:' . site_url() . 'admin');
        }
        $this->load->model('admin/m_order', 'oorder');
    }

    function index() {        
        $this->load->view('admin/header');
        $this->load->view('admin/orders/order_cancel_mst');
        $this->load->view('admin/footer');
    }  
    
    function search() { 
        $data['orders'] = $this->oorder->cancel_search();
        $this->load->view('admin/header');
        $this->load->view('admin/orders/order_cancel_mst',$data);
        $this->load->view('admin/footer');
    }  
    
}
