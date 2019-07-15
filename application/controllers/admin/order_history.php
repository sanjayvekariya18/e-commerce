<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order_history extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->order) {
            header('location:' . site_url() . 'admin');
        }
        $this->load->model('admin/m_order', 'oorder');
    }

    function index() {    
        $data['orders'] = $this->oorder->getAllOrder();
        $this->load->view('admin/header');
        $this->load->view('admin/orders/order_mst',$data);
        $this->load->view('admin/footer');
    }  
    
    function search() { 
        $data['orders'] = $this->oorder->search();
        $this->load->view('admin/header');
        $this->load->view('admin/orders/order_mst',$data);
        $this->load->view('admin/footer');
    } 
    
    function request() {    
        $data['orders'] = $this->oorder->getAllRequestOrder();        
        $this->load->view('admin/header');
        $this->load->view('admin/orders/request_mst',$data);
        $this->load->view('admin/footer');
    }  
    
    function requestSearch() {    
        $data['orders'] = $this->oorder->requestSearch();        
        $this->load->view('admin/header');
        $this->load->view('admin/orders/request_mst',$data);
        $this->load->view('admin/footer');
    }  
    
    function resetRequest(){
        $order_id = $this->input->post('order_id');
        $this->oorder->resetRequest($order_id);
        echo "Success";
    }
    
    function rejectRequest(){
        $order_id = $this->input->post('order_id');
        $this->oorder->rejectRequest($order_id);
        echo "Success";
    }
    
    function approveRequest(){
        $order_id = $this->input->post('order_id');
        $result = $this->oorder->approveRequest($order_id);
        echo $result;
    }   

}
