<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Shipping_charge extends CI_Controller {

    function __construct() {
        parent::__construct();    
        if(!$this->common->logged_in()){
            header('location:' . site_url());
        }else if(!$this->common->getPermission($this->session->userdata('primary_email'))->shipping_charge){
            header('location:'.site_url().'admin');
        }
    }
    
    function index() {
        $data['shipping'] = $this->common->shippingCharge();
        $this->load->view('admin/header');
        $this->load->view('admin/setting/shipping_charge', $data);
        $this->load->view('admin/footer');
    }
    
    function updateShippingCharge() {
        $shipping_charge = $this->input->post('shipping_charge');
        $result = $this->common->updateShippingCharge($shipping_charge);
        header('location:' . site_url() . 'admin/shipping_charge?msg=U');
    }

}
