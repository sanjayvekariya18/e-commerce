<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rejected extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->seller_logged_in()) {
            header('location:' . site_url());
        }
    }

    function index() {     
        $seller_primary_email = $this->session->userdata('seller_primary_email');
        $data['products'] = $this->common->getSellerProductsRejected($seller_primary_email);
        $data['commission'] = $this->common->getSellerGroupData($seller_primary_email);
        $data['competitive'] = $this->common->getCompetitivePrice();
        $data['subcategory'] = $this->common->getSubcategory();
        $this->load->view('seller/header');
        $this->load->view('seller/rejected/rejected',$data);
        $this->load->view('seller/footer');
    }
    
//    function search() {     
//        $seller_primary_email = $this->session->userdata('seller_primary_email');
//        $sub_category_id = $_POST['sub_category_id'];
//        $data['products'] = $this->common->getSellerSearchProductsRejected($seller_primary_email,$sub_category_id);
//        $data['commission'] = $this->common->getSellerGroupData($seller_primary_email);
//        $data['competitive'] = $this->common->getCompetitivePrice();
//        $data['subcategory'] = $this->common->getSubcategory();
//        $this->load->view('seller/header');
//        $this->load->view('seller/rejected/rejected',$data);
//        $this->load->view('seller/footer');
//    }

}
