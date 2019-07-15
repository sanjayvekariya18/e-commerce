<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bonus_policy extends CI_Controller {

    function __construct() {
        parent::__construct();    
        if(!$this->common->logged_in()){
            header('location:' . site_url());
        }else if(!$this->common->getPermission($this->session->userdata('primary_email'))->bonus_policy){
            header('location:'.site_url().'admin');
        }
    }
    
    function index() {
        $data['bonus'] = $this->common->bonusPolicy();
        $this->load->view('admin/header');
        $this->load->view('admin/setting/bonus_policy', $data);
        $this->load->view('admin/footer');
    }
    
    function updateBonus() {
        $bonus_amount = $this->input->post('bonus_amount');
        $bonus_day = $this->input->post('bonus_day');
       
        $result = $this->common->updateBonus($bonus_amount,$bonus_day);
        header('location:' . site_url() . 'admin/bonus_policy?msg=U');
    }
}
