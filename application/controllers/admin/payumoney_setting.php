<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class payumoney_setting extends CI_Controller {

    function __construct() {
        parent::__construct();        
        if(!$this->common->logged_in()){
             header('location:' . site_url());
        }else if(!$this->common->getPermission($this->session->userdata('primary_email'))->payumoney_setting){
            header('location:'.site_url().'admin');
        }
    }

    
    function index() {
        $data['payumoney'] = $this->common->payumoneySetting();
        $this->load->view('admin/header');
        $this->load->view('admin/setting/payumoney_setting', $data);
        $this->load->view('admin/footer');
    }

    function updatePayumoneySetting() {
        $merchant_key = $this->input->post('merchant_key');
        $merchant_salt = $this->input->post('merchant_salt');        
        $result = $this->common->updatePayumoneySetting($merchant_key, $merchant_salt);
        header('location:' . site_url() . 'admin/payumoney_setting?msg=U');
    }
    
    

}
