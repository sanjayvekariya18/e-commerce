<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->seller_logged_in()) {
            header('location:' . site_url());
        }
        $this->load->library('parser');
        $this->load->model('seller/m_profile', 'oprofile');
    }

    function index() {       
        $data['seller'] = $this->common->getSellerData($this->session->userdata('seller_primary_email'));        
        $data['bankname'] = $this->common->getAllBank();
        $data['states'] = $this->common->getStates();
        $this->load->view('seller/header');
        $this->load->view('seller/profile/profile', $data);
        $this->load->view('seller/footer');
    }

    function updateDisplayInfo() {
        $this->oprofile->updateDisplayInfo();
        header('location:' . site_url() . 'seller/profile');
    }

    function updatePickupInfo() {
        $this->oprofile->updatePickupInfo();
        header('location:' . site_url() . 'seller/profile');
    }

    function updatePrimaryInfo() {
        $this->oprofile->updatePrimaryInfo();
        header('location:' . site_url() . 'seller/profile');
    }

    function updateBusinessInfo() {        
        $this->oprofile->updateBusinessInfo();
        header('location:' . site_url() . 'seller/profile');
    }

    function updateBankInfo() {
        $this->oprofile->updateBankInfo();
        header('location:' . site_url() . 'seller/profile');
    }

    function updateDocumentInfo() {
        $this->oprofile->updateDocumentInfo();
        header('location:' . site_url() . 'seller/profile');
    }

    function sendOTP() {
        $to = $this->input->post('mobile');
        $otp = $this->input->post('otp');
        $templateInfo = $this->common->getSmsTemplate("OTP", "Seller");
        $tag = array(
            'OTP' => $otp           
        );
        $message = $this->parser->parse_string($templateInfo->message, $tag, TRUE);       
        $this->common->SMSSend($to, $message, TRUE);
        // UPDATE SMS COUNTER
        $this->common->smsCountUpdate('1');
        echo "sucess";
    }
    
    function checkPincode(){
        $pincode  = $this->input->post('pincode');
        $result = $this->common->checkPincodeAll($pincode);
        echo $result;
    }

}
