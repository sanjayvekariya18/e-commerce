<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order_status extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->order_status) {
            header('location:' . site_url() . 'admin');
        }
        $this->load->model('admin/m_order', 'order');
    }

    function index() {
        
        $data['approved'] = $this->order->getApprovedOrder();
        $data['pickup'] = $this->order->getPickupOrder();
        $data['shipped'] = $this->order->getReadyToShipOrder();
        $data['transite'] = $this->order->getTransiteOrder();
        $data['delivered'] = $this->order->getDeliveredOrder();
        $data['shipcancel'] = $this->order->getShipCancelOrder();
        $data['cancel'] = $this->order->getCancelOrder();
        $data['return'] = $this->order->getReturnOrder();
        $data['replace'] = $this->order->getReplaceOrder();
        $this->load->view('admin/header');
        $this->load->view('admin/orders/order_status_mst',$data);
        $this->load->view('admin/footer');
    }
    
    function updateOrder(){
        $order_id = $this->input->post('order_id');
        $status = $this->input->post('status');
        $result = $this->order->updateOrder($order_id,$status);
        echo $result;        
    }
} 