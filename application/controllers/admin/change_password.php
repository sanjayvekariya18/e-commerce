<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Change_password extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        }
    }

    function index() {
        $this->load->view('admin/header');
        $this->load->view('admin/change_password/change_password');
        $this->load->view('admin/footer');
    }

    function updatePassword() {
        $primary_email = $this->session->userdata('primary_email');
        $password = $this->common->fullEncode($this->input->post('oldpass'));
        $newpassword = $this->common->fullEncode($this->input->post('newpass'));
        $result = $this->common->updatePassword($primary_email, $password, $newpassword);
        header('location:' . site_url() . 'admin/change_password?msg=' . $result);
    }

}
