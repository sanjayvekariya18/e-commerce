<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Signup extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('seller/m_signup', 'osignup');
    }

    function index() {
        $this->load->view('seller/signup/signup');
    }

    function addSignupData() {
        if ($this->email_valid_1() != '0') {
            header('location:' . site_url() . 'seller?msg=EX');
        } else if ($this->mobile_valid_1() != '0') {
            header('location:' . site_url() . 'seller?msg=MX');
        } else {
            $this->osignup->addSignupData();
            header('location:' . site_url() . 'seller?msg=V');
        }
    }

    function verifyEmail() {
        $this->osignup->verifyEmail();
        header('location:' . site_url() . 'seller/profile');
    }

    function email_valid() {
        $result = $this->common->email_valid($this->input->post('email'));
        echo $result;
    }

    function mobile_valid() {
        $result = $this->osignup->mobile_valid($this->input->post('primary_mobile'));
        echo $result;
    }
    
    function email_valid_1() {
        $result = $this->common->email_valid($this->input->post('email'));
        return $result;
    }

    function mobile_valid_1() {
        $result = $this->osignup->mobile_valid($this->input->post('primary_mobile'));
        return $result;
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
        echo "success";
    }

}
