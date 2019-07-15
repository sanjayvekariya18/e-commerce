<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->customer_logged_in()) {
            header('location:' . site_url());
        }
        $this->load->model('buyer/m_profile','oprofile');
    }

    function index() {
        $data['bankname'] = $this->common->getAllBank();
        $data['customer'] = $this->oprofile->getCustomerData($this->session->userdata('customer_primary_email'));
        $this->load->view('buyer/header');
        $this->load->view('buyer/profile/profile',$data);
        $this->load->view('buyer/footer');
    }
    
    function updateCustomerData(){
        if(isset($_POST)){
            $data = $_POST;
            $this->oprofile->updateCustomerData($data,$this->session->userdata('customer_primary_email'));
            header('location:'.site_url().'buyer/profile?msg=U');
        }        
    }
    
    function changePassword() {
        $this->load->view('buyer/header');
        $this->load->view('buyer/profile/change_password');
        $this->load->view('buyer/footer');
    }
    
    function updatePassword() {
        $primary_email = $this->session->userdata('customer_primary_email');
        $password = $this->common->fullEncode($this->input->post('oldpass'));
        $newpassword = $this->common->fullEncode($this->input->post('newpass'));
        $result = $this->common->updatePassword($primary_email, $password, $newpassword);
        header('location:' . site_url() . 'buyer/profile/changePassword?msg='.$result);
    }

}
