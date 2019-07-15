<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends CI_Controller {

    function __construct() {
        parent::__construct();
        if(!$this->common->logged_in()){
            header('location:' . site_url());
        }
        $this->load->model('seller/m_product', 'oproduct');
    }

    function request() {
        $data['products'] = $this->common->getAllSellerProductsRequest();
        $data['competitive'] = $this->common->getCompetitivePrice();
        $this->load->view('admin/header');
        $this->load->view('admin/product/request', $data);
        $this->load->view('admin/footer');
    }

    function approved() {
        $data['products'] = $this->common->getAllSellerProductsApprove();
        $data['competitive'] = $this->common->getCompetitivePrice();
        $this->load->view('admin/header');
        $this->load->view('admin/product/approved',$data);
        $this->load->view('admin/footer');
    }

    function live() {
        $data['products'] = $this->common->getAllSellerProductsLive();
        $data['competitive'] = $this->common->getCompetitivePrice();
        $this->load->view('admin/header');
        $this->load->view('admin/product/live',$data);
        $this->load->view('admin/footer');
    }

    function rejected() {
        $data['products'] = $this->common->getAllSellerProductsRejected();
        $data['competitive'] = $this->common->getCompetitivePrice();
        $this->load->view('admin/header');
        $this->load->view('admin/product/rejected',$data);
        $this->load->view('admin/footer');
    }

    function getProduct() {
        $product_id = $this->input->post('product_id');
        $product = $this->common->getProductById($product_id);
        echo json_encode($product);
    }

    function getProductVariation() {
        $variation_id = $this->input->post('variation_id');        
        $product_variation = $this->common->getProductVariationById($variation_id);
        foreach ($product_variation as $val) {
            $variation[$val->variation_type][] = $val->variation_name;
        }
        echo json_encode($variation);
    }
    
    function deleteProductPermenent(){
        $result = $this->oproduct->deleteProductPermenent();
        echo $result;
    }

    function modelViewProductRequest() {
        $this->oproduct->modelViewProduct();        
    }
    
    function modelViewProductApprove() {
        $this->oproduct->modelViewProduct();        
    }
    
    function modelViewProductLive() {
        $this->oproduct->modelViewProduct();        
    }
    
    function modelViewProductReject() {
        $this->oproduct->modelViewProduct();        
    }
    
    function modelViewProductDeleted() {
        $this->oproduct->modelViewProduct();        
    }

}
