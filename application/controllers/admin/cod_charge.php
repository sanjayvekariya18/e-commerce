<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cod_charge extends CI_Controller {

    function __construct() {
        parent::__construct();    
        if(!$this->common->logged_in()){
            header('location:' . site_url());
        }else if(!$this->common->getPermission($this->session->userdata('primary_email'))->cod_charge){
            header('location:'.site_url().'admin');
        }
    }
    
    function index() {
        $data['cod'] = $this->common->codCharge();
        $this->load->view('admin/header');
        $this->load->view('admin/setting/cod_charge', $data);
        $this->load->view('admin/footer');
    }
    
    function updateCodCharge() {
        $cod_charge = $this->input->post('cod_charge');
        $result = $this->common->updateCodCharge($cod_charge);
        header('location:' . site_url() . 'admin/cod_charge?msg=U');
    }

}
