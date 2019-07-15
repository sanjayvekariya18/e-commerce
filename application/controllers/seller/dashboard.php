<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->seller_logged_in()) {
            header('location:' . site_url());
        }
        $this->load->model('seller/m_dashboard','odashboard');
    }

    function index() {       
        $data['LiveProducts'] = $this->odashboard->getTotalLiveProducts();
        $data['ReviewProducts'] = $this->odashboard->getTotalReviewProducts();
        $data['Sales'] = $this->odashboard->getTotalSales();
        $data['RejectProducts'] = $this->odashboard->getTotalRejectedProducts();
        //$data['rproducts'] = $this->odashboard->getRejectedProducts();        
        $this->load->view('seller/header');
        $this->load->view('seller/dashboard/dashboard',$data);
        $this->load->view('seller/footer');
    }

}
