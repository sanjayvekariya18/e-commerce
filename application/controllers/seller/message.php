<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Message extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->seller_logged_in()) {
            header('location:' . site_url());
        }
    }

    function index() {
        $this->load->view('seller/header');
        $this->load->view('seller/message/message_mst');
        $this->load->view('seller/footer');
    }
    
    function chat() {
        $this->load->view('seller/header');
        $this->load->view('seller/message/message_view');
        $this->load->view('seller/footer');
    }

}
