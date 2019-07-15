<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sellergroup extends CI_Controller {

    function __construct() {
        parent::__construct();
        if(!$this->common->logged_in()){
            header('location:' . site_url());
        }else if(!$this->common->getPermission($this->session->userdata('primary_email'))->seller_group){
            header('location:'.site_url().'admin');
        }
        $this->load->model('admin/m_sellergroup', 'osellergroup');
    }

    function index() {
        $data['sellergroup'] = $this->osellergroup->getAllSellerGroupData();
        $this->load->view('admin/header');
        $this->load->view('admin/sellergroup/sellergroup_mst', $data);
        $this->load->view('admin/footer');
    }

    function getSellerGroupData() {
        $group_id = base64_decode($this->input->get('id'));       
        $data['sellergroup'] = $this->common->getSellerGroupDataById($group_id);      
       
        if (isset($data['sellergroup']->group_id)) {
            $this->load->view('admin/header');
            $this->load->view('admin/sellergroup/add_sellergroup', $data);
            $this->load->view('admin/footer');
        } else {
            header('location:' . site_url() . 'admin/sellergroup');
        }
    }

    function addSellerGroup() {
        $this->load->view('admin/header');
        $this->load->view('admin/sellergroup/add_sellergroup');
        $this->load->view('admin/footer');
    }

    function addSellerGroupData() {
        
        if ($_POST['saveBtn'] == 'save') {
            $this->osellergroup->addSellerGroupData();
            header('location:' . site_url() . 'admin/sellergroup?msg=S');
        } else if ($_POST['saveBtn'] == 'update') {
            $this->osellergroup->updateSellerGroupData();
            header('location:' . site_url() . 'admin/sellergroup?msg=U');
        }
    }

}
