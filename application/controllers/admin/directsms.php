<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Directsms extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->directsms) {
            header('location:' . site_url() . 'admin');
        }      
    }

    function index() {       
        $this->load->view('admin/header');
        $this->load->view('admin/direct_sms/directsms');
        $this->load->view('admin/footer');
    }    

    function sendSms() {        
        $to = $this->input->post('mobile');
        $message = $this->input->post('message');
        $this->common->SMSSend($to, $message, TRUE);        
        header('location:'.  site_url().'admin/directsms?msg=S');
    }
}
