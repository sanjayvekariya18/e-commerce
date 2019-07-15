<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order_shipping_charge extends CI_Controller {

    function __construct() {
        parent::__construct();    
        if(!$this->common->logged_in()){
            header('location:' . site_url());
        }else if(!$this->common->getPermission($this->session->userdata('primary_email'))->order_shipping_charge){
            header('location:'.site_url().'admin');
        }
        $this->load->model('admin/m_order_shipping_charge','oshipping');
    }
    
    function index() {       
        $this->load->view('admin/header');
        $this->load->view('admin/shipping_charge/order_shipping_charge');
        $this->load->view('admin/footer');
    }
    
    function search() {  
        $start = date('Y-m-d',  strtotime($this->input->post('start')));
        $end = date('Y-m-d',  strtotime($this->input->post('end')));
        $data['transaction'] = $this->oshipping->getAllTransaction($start, $end);
        $this->load->view('admin/header');
        $this->load->view('admin/shipping_charge/order_shipping_charge',$data);
        $this->load->view('admin/footer');
    }
    
    function updateShippingCharge() {
        $order_id = $this->input->post('order_id');
        $shipping_charge = $this->input->post('shipping_charge');
        $shipping_charge_reason = $this->input->post('shipping_charge_reason');
        $result = $this->oshipping->updateShippingCharge($order_id,$shipping_charge,$shipping_charge_reason);        
        echo $result;
    }
    
    function orderPayment() {        
        $order_id = $this->input->post('order_id');
        $result = $this->oshipping->orderPayment($order_id);
        echo $result;
    }

}
