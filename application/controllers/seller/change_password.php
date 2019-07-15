<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Change_password extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->seller_logged_in()) {
            header('location:' . site_url());
        }
    }

    function index() {
        $this->load->view('seller/header');
        $this->load->view('seller/change_password/change_password');
        $this->load->view('seller/footer');
    }

    function updatePassword() {
        $primary_email = $this->session->userdata('seller_primary_email');
        $password = $this->common->fullEncode($this->input->post('oldpass'));
        $newpassword = $this->common->fullEncode($this->input->post('newpass'));
        $result = $this->common->updatePassword($primary_email, $password, $newpassword);
        header('location:' . site_url() . 'seller/change_password?msg=' . $result);
    }

}
