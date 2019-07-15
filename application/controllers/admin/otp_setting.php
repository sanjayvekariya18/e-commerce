<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Otp_setting extends CI_Controller {

    function __construct() {
        parent::__construct();    
        if(!$this->common->logged_in()){
            header('location:' . site_url());
        }else if(!$this->common->getPermission($this->session->userdata('primary_email'))->otp){
            header('location:'.site_url().'admin');
        }
    }
    
    function index() {
        $data['otp'] = $this->common->otpSetting();
        $this->load->view('admin/header');
        $this->load->view('admin/setting/otp_setting',$data);
        $this->load->view('admin/footer');
    }
    
    function updateOtpSetting() {
        $mobile = $this->input->post('mobile');
        $email = $this->input->post('email');
        $status = ($this->input->post('status')!="")?1:0;
        $result = $this->common->updateOtpSetting($mobile,$email,$status);
        header('location:' . site_url() . 'admin/otp_setting?msg=U');
    }

}
