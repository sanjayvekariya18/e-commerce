<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sms_setting extends CI_Controller {

    function __construct() {
        parent::__construct();        
        if(!$this->common->logged_in()){
             header('location:' . site_url());
        }else if(!$this->common->getPermission($this->session->userdata('primary_email'))->sms_setting){
            header('location:'.site_url().'admin');
        }
    }

    
    function index() {
        $data['sms'] = $this->common->smsSetting();
        $this->load->view('admin/header');
        $this->load->view('admin/setting/sms_setting', $data);
        $this->load->view('admin/footer');
    }

    function updateSmsSetting() {
        $user = $this->input->post('user');
        $pass = $this->input->post('pass');
        $sender = $this->input->post('sender');
        $result = $this->common->updateSmsSetting($user, $pass, $sender);
        header('location:' . site_url() . 'admin/sms_setting?msg=U');
    }
    
    

}
