<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_deleted extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->deleted_product) {
            header('location:' . site_url() . 'admin');
        }
    }

    function index() {
        //$data['products'] = $this->common->getAllSellerProductsDeleted();
        //$data['competitive'] = $this->common->getCompetitivePrice();
        $data['subcategory'] = $this->common->getSubcategory();
        $this->load->view('admin/header');
        $this->load->view('admin/product/deleted', $data);
        $this->load->view('admin/footer');
    }

    function search() {
        $sub_category_id = $_POST['sub_category_id'];
        $data['products'] = $this->common->getAllSellerSearchProductsDeleted($sub_category_id);
        $data['competitive'] = $this->common->getCompetitivePrice();
        $data['subcategory'] = $this->common->getSubcategory();
        $this->load->view('admin/header');
        $this->load->view('admin/product/deleted', $data);
        $this->load->view('admin/footer');
    }    

}
