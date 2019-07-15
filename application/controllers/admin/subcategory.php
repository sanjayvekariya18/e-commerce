<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subcategory extends CI_Controller {

    function __construct() {
        parent::__construct();        
        if(!$this->common->logged_in()){
            header('location:' . site_url());
        }else if(!$this->common->getPermission($this->session->userdata('primary_email'))->sub_category){
            header('location:'.site_url().'admin');
        }
        $this->load->model('admin/m_subcategory', 'osubcategory');
    }

    function index() {       
        $data['subcategory'] = $this->osubcategory->getAllSubcategoryData();
        $this->load->view('admin/header');
        $this->load->view('admin/subcategory/subcategory',$data);
        $this->load->view('admin/footer');
    }

    function addSubcategoryData() {
        $result = $this->osubcategory->addSubcategoryData();
        if ($result == 1) {
            header('location:' . site_url() . 'admin/subcategory?msg=S');
        }
    }

    function updateSubcategoryData() {
        $result = $this->osubcategory->updateSubcategoryData();
        if ($result == 1) {
            header('location:' . site_url() . 'admin/subcategory?msg=U');
        }
    }

    function deleteSubcategoryData() {
        $result = $this->osubcategory->deleteSubcategoryData();
        if ($result == 1) {
            header('location:' . site_url() . 'admin/subcategory?msg=D');
        }
    }
}
