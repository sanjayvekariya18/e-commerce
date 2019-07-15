<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employee_seller extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->eseller) {
            header('location:' . site_url() . 'admin');
        }
        $this->load->model('employee/m_seller', 'oseller');
    }

    function index() {
        $data['sellers'] = $this->oseller->getAllSellers();
        $this->load->view('admin/header');
        $this->load->view('employee/seller_mst', $data);
        $this->load->view('admin/footer');
    }

    function search() {
        $data['sellers'] = $this->oseller->search();
        $this->load->view('admin/header');
        $this->load->view('employee/seller_mst', $data);
        $this->load->view('admin/footer');
    }

    function seller_login() {
        $primary_email = base64_decode($this->input->get('id'));
        $seller_data = $this->common->getSellerData($primary_email);
        if ($seller_data->email_status == 1) {
            $session = array(
                'seller_username' => $seller_data->first_name . ' ' . $seller_data->last_name,
                'seller_primary_email' => $seller_data->primary_email,
                'seller_id' => $seller_data->seller_id,
                'seller_role' => '1'
            );
            $this->session->set_userdata($session);
            header('location:' . site_url() . 'seller/dashboard');
        } else {
            header('location:' . site_url() . 'seller?msg=E');
        }
    }

}
