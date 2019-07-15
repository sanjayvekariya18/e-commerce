<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bank_details extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->customer) {
            header('location:' . site_url() . 'admin');
        }
        $this->load->model('admin/m_bank_details', 'obank');
    }

    function index() {       
        $data['bank'] = $this->obank->getAllBankData();
        $this->load->view('admin/header');
        $this->load->view('admin/setting/bank_details',$data);
        $this->load->view('admin/footer');
    }

    function addBankData() {
        $result = $this->obank->addBankData();
        if ($result == 1) {
            header('location:' . site_url() . 'admin/bank_details?msg=S');
        }
    }

    function updateBankData() {
        $result = $this->obank->updateBankData();
        if ($result == 1) {
            header('location:' . site_url() . 'admin/bank_details?msg=U');
        }
    }

    function deleteBankData() {
        $result = $this->obank->deleteBankData();
        if ($result == 1) {
            header('location:' . site_url() . 'admin/bank_details?msg=D');
        }
    }

}
