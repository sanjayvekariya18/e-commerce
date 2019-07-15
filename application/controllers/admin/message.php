<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Message extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        if(!$this->common->logged_in()){
            header('location:' . site_url());
        }else if(!$this->common->getPermission($this->session->userdata('primary_email'))->message){
            header('location:'.site_url().'admin');
        }
    }

    function index() {
        $this->load->view('admin/header');
        $this->load->view('admin/message/message_mst');
        $this->load->view('admin/footer');
    }
    
    function chat() {
        $this->load->view('admin/header');
        $this->load->view('admin/message/message_view');
        $this->load->view('admin/footer');
    }

}
