<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order_return extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->order_return) {
            header('location:' . site_url() . 'admin');
        }
        $this->load->model('admin/m_order', 'order');
    }

    function index() {
        $data['intransite'] = $this->order->getInTransiteReturnOrder();
        $data['completed'] = $this->order->getCompleteReturnOrder();       
        $this->load->view('admin/header');
        $this->load->view('admin/orders/return_order_mst',$data);
        $this->load->view('admin/footer');
    }
    
    function updateReturnOrder(){
        $order_id = $this->input->post('order_id');        
        $result = $this->order->updateReturnOrder($order_id);
        echo "Success";        
    }
} 