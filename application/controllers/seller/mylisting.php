<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mylisting extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->seller_logged_in()) {
            header('location:' . site_url());
        }
    }

    function index() {
        $data['nonliveproducts'] = $this->common->getSellerProductsNonlive($this->session->userdata('seller_primary_email'));
        $data['liveproducts'] = $this->common->getSellerProductsLive($this->session->userdata('seller_primary_email'));
        $data['stockoutproducts'] = $this->common->getSellerProductsStockOut($this->session->userdata('seller_primary_email'));
        $data['commission'] = $this->common->getSellerGroupData($this->session->userdata('seller_primary_email'));
        $data['competitive'] = $this->common->getCompetitivePrice();
        $data['subcategory'] = $this->common->getSubcategory();
        $this->load->view('seller/header');
        $this->load->view('seller/listing/mylisting', $data);
        $this->load->view('seller/footer');
    }
    
//    function search() {
//        $sub_category_id = $_POST['sub_category_id'];
//        $seller_primary_email = $this->session->userdata('seller_primary_email');
//        $data['nonliveproducts'] = $this->common->getSellerSearchProductsNonlive($seller_primary_email,$sub_category_id);
//        $data['liveproducts'] = $this->common->getSellerSearchProductsLive($seller_primary_email,$sub_category_id);
//        $data['commission'] = $this->common->getSellerGroupData($seller_primary_email);
//        $data['competitive'] = $this->common->getCompetitivePrice();
//        $data['subcategory'] = $this->common->getSubcategory();
//        $this->load->view('seller/header');
//        $this->load->view('seller/listing/mylisting', $data);
//        $this->load->view('seller/footer');
//    }

}
