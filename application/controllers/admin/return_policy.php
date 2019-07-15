<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Return_policy extends CI_Controller {

    function __construct() {
        parent::__construct();    
        if(!$this->common->logged_in()){
            header('location:' . site_url());
        }else if(!$this->common->getPermission($this->session->userdata('primary_email'))->return_policy){
            header('location:'.site_url().'admin');
        }
    }
    
    function index() {
        $data['days'] = $this->common->returnDay();
        $this->load->view('admin/header');
        $this->load->view('admin/setting/return_policy', $data);
        $this->load->view('admin/footer');
    }
    
    function updateReturnDay() {
        $return_day = $this->input->post('return_day');
        $cr_transfer_day = $this->input->post('cr_transfer_day');
        $dr_transfer_day = $this->input->post('dr_transfer_day');
        $result = $this->common->updateReturnDay($return_day,$cr_transfer_day,$dr_transfer_day);
        header('location:' . site_url() . 'admin/return_policy?msg=U');
    }
}
