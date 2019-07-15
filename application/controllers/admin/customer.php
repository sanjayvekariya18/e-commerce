<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->customer) {
            header('location:' . site_url() . 'admin');
        }
        $this->load->model('admin/m_customer', 'ocustomer');
    }

    function index() {
        $data['customers'] = $this->ocustomer->getAllCustomers();
        $this->load->view('admin/header');
        $this->load->view('admin/customer/customer_mst', $data);
        $this->load->view('admin/footer');
    }

    function search() {
        $data['customers'] = $this->ocustomer->getSearchCustomers();
        $this->load->view('admin/header');
        $this->load->view('admin/customer/customer_mst', $data);
        $this->load->view('admin/footer');
    }

    function customer_login() {
        $primary_email = base64_decode($this->input->get('id'));
        $customer_data = $this->common->getCustomerData($primary_email);
        $session = array(
            'customer_username' => $customer_data->first_name,
            'customer_primary_email' => $customer_data->primary_email,
            'customer_id' => $customer_data->customer_id,
            'customer_role' => '3'
        );
        $this->session->set_userdata($session);
        header('location:' . site_url() . 'buyer/dashboard');
    }

}
