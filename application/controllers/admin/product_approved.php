<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_approved extends CI_Controller {

    function __construct() {
        parent::__construct();
        if(!$this->common->logged_in()){
            header('location:' . site_url());
        }else if(!$this->common->getPermission($this->session->userdata('primary_email'))->approved_product){
            header('location:'.site_url().'admin');
        }
        $this->load->model('seller/m_product', 'oproduct');
    }

    function index() {
        //$data['products'] = $this->common->getAllSellerProductsApprove();
        //$data['competitive'] = $this->common->getCompetitivePrice();
        $data['subcategory'] = $this->common->getSubcategory();
        $this->load->view('admin/header');
        $this->load->view('admin/product/approved',$data);
        $this->load->view('admin/footer');
    }
    
    function search() {
        $sub_category_id = $_POST['sub_category_id'];
        $data['products'] = $this->common->getAllSellerSearchProductsApprove($sub_category_id);
        $data['competitive'] = $this->common->getCompetitivePrice();
        $data['subcategory'] = $this->common->getSubcategory();
        $this->load->view('admin/header');
        $this->load->view('admin/product/approved',$data);
        $this->load->view('admin/footer');
    }

}
