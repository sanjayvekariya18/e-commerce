<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->customer_logged_in()) {
            header('location:' . site_url());
        }
    }

    function index() {
        $this->load->view('buyer/header');
        $this->load->view('buyer/footer');
    }

}
