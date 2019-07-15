<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order_track extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->order_track) {
            header('location:' . site_url() . 'admin');
        }
        $this->load->model('admin/m_order', 'order');
    }

    function index() {
        $this->load->view('admin/header');
        $this->load->view('admin/orders/order_track');
        $this->load->view('admin/footer');
    }
    
    function awb(){
        $this->load->view('admin/header');
        $this->load->view('admin/orders/order_track_no');
        $this->load->view('admin/footer');
    }
    
    function updateAWB(){
        $order_id = $this->input->post('order_id');
        $awb_no = $this->input->post('awb_no');
        $result = $this->order->updateAWB($order_id,$awb_no);
        if($result == '1'){
            header('location:'.site_url().'admin/order_track/awb?msg=U');
        }else{
            header('location:'.site_url().'admin/order_track/awb?msg=F');
        }
    }

    function search() {        
        $order_id = $this->input->post('order_id');
        $data['order'] = $this->order->getTrackOrderData($order_id);
        $data['orderstatus'] = $this->order->getTrackOrderStatusData($order_id);        
        $this->load->view('admin/header');
        $this->load->view('admin/orders/order_track', $data);
        $this->load->view('admin/footer');
    }

}
