<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_request extends CI_Controller {

    function __construct() {
        parent::__construct();
        if(!$this->common->logged_in()){
            header('location:' . site_url());
        }else if(!$this->common->getPermission($this->session->userdata('primary_email'))->request_product){
            header('location:'.site_url().'admin');
        }
        $this->load->model('seller/m_product', 'oproduct');
    }

    function index() {
        //$data['products'] = $this->common->getAllSellerProductsRequest();
        //$data['competitive'] = $this->common->getCompetitivePrice();
        $data['subcategory'] = $this->common->getSubcategory();       
        $this->load->view('admin/header');
        $this->load->view('admin/product/request', $data);
        $this->load->view('admin/footer');
    }
    
    function search(){
        $sub_category_id = $_POST['sub_category_id'];
        $data['products'] = $this->common->getAllSellerSearchProductsRequest($sub_category_id);
        $data['subcategory'] = $this->common->getSubcategory();
        $data['competitive'] = $this->common->getCompetitivePrice();
        $this->load->view('admin/header');
        $this->load->view('admin/product/request', $data);
        $this->load->view('admin/footer');
    }
    
    function view() {
       $product_id = base64_decode($this->input->get('pid')); 
       $data['product'] = $this->oproduct->getProductViewData($product_id);
       $data['pimages'] = $this->oproduct->getProductViewImages($product_id);
       $data['variation'] = $this->oproduct->getProductViewVariation($product_id);
       
       $this->load->view('website/header');
       $this->load->view('seller/product/view_product',$data);
       $this->load->view('website/footer');
    }
}
