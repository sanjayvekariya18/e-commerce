<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Change_mobile extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->change_mobile) {
            header('location:' . site_url() . 'admin');
        }
    }

    function index() {
        $this->load->view('admin/header');
        $this->load->view('admin/change_mobile/change_mobile');
        $this->load->view('admin/footer');
    }

    function updateMobile() {
        $role = $this->input->post('role');
        $old_mobile = $this->input->post('old_mobile');
        $new_mobile = $this->input->post('new_mobile');
        $result = $this->common->changeMobile($role, $old_mobile, $new_mobile);
        if ($result) {
            header('location:' . site_url() . 'admin/change_mobile?msg=U');
        } else {
            header('location:' . site_url() . 'admin/change_mobile?msg=F');
        }
    }

}
