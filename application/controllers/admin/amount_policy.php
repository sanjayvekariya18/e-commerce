<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Amount_policy extends CI_Controller {

    function __construct() {
        parent::__construct();    
        if(!$this->common->logged_in()){
            header('location:' . site_url());
        }else if(!$this->common->getPermission($this->session->userdata('primary_email'))->amount_policy){
            header('location:'.site_url().'admin');
        }
    }
    
    function index() {
        $data['amount'] = $this->common->amountPolicy();
        $this->load->view('admin/header');
        $this->load->view('admin/setting/amount_policy', $data);
        $this->load->view('admin/footer');
    }
    
    function updateAmountPolicy() {
        $min_balance = $this->input->post('min_balance');
        $min_withdraw_amount = $this->input->post('min_withdraw_amount');
        $result = $this->common->updateAmountPolicy($min_balance,$min_withdraw_amount);
        header('location:' . site_url() . 'admin/amount_policy?msg=U');
    }
}
