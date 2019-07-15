<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_rating extends CI_Controller {

    function __construct() {
        parent::__construct();
        if(!$this->common->logged_in()){
            header('location:' . site_url());
        }
        $this->load->model('admin/m_rating', 'orating');
    }

    function index() {        
        $this->load->view('admin/header');
        $this->load->view('admin/rating/product_rating');
        $this->load->view('admin/footer');
    }  
    
    function search() {  
        $start = date('Y-m-d',  strtotime($this->input->post('start')));
        $end = date('Y-m-d',  strtotime($this->input->post('end')));
        $data['productrate'] = $this->orating->getAllPurchaseProduct($start,$end);
        $this->load->view('admin/header');
        $this->load->view('admin/rating/product_rating',$data);
        $this->load->view('admin/footer');
    }
    
    function getProductRate() {
        $data = $this->orating->getProductRate();
        echo $data->prate . "|" . $data->preview;
    }

    function setProductRate() {
        $result = $this->orating->setProductRate();
        echo $result;
    }

}
