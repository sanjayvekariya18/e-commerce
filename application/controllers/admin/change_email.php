<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Change_email extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->change_email) {
            header('location:' . site_url() . 'admin');
        }
    }

    function index() {
        $this->load->view('admin/header');
        $this->load->view('admin/change_email/change_email');
        $this->load->view('admin/footer');
    }

    function updateEmail() {
        $role = $this->input->post('role');
        $old_email = $this->input->post('old_email');
        $new_email = $this->input->post('new_email');
        $result = $this->common->changeEmail($role, $old_email, $new_email);
        if ($result) {
            header('location:' . site_url() . 'admin/change_email?msg=U');
        } else {
            header('location:' . site_url() . 'admin/change_email?msg=F');
        }
    }

}
