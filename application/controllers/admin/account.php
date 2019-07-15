<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Account extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->acmanager) {
            header('location:' . site_url() . 'admin');
        }
        $this->load->model('admin/m_account', 'oaccount');
    }

    function index() {
        $data['sellers'] = $this->oaccount->getAllSellers();
        $data['employees'] = $this->oaccount->getAllEmployees();
        $this->load->view('admin/header');
        $this->load->view('admin/account_manager/account_mst', $data);
        $this->load->view('admin/footer');
    }

    function search() {
        $data['sellers'] = $this->oaccount->search();
        $this->load->view('admin/header');
        $this->load->view('admin/account_manager/account_mst', $data);
        $this->load->view('admin/footer');
    }

    function assign() {
        $result = $this->oaccount->assign();
        header("location:" . site_url() . "admin/account?msg=A");
    }
    
    function getAssignEmployee(){
        $seller_id = $this->input->post('seller_id');
        $data['employees'] = $this->oaccount->getAssignEmployee($seller_id);
        $this->load->view('admin/account_manager/assign_employee',$data);
    }
    
    function unassign() {
        $result = $this->oaccount->unassign();
        header("location:" . site_url() . "admin/account?msg=UA");
    }

}
