<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Oreturn extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->seller_logged_in()) {
            header('location:' . site_url());
        }
    }

    function index() {
        $this->load->view('seller/header');
        $this->load->view('seller/return/return');
        $this->load->view('seller/footer');
    } 
}
