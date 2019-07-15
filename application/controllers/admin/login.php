<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->view('admin/login');
    }

    function checkLogin() {
        $email = $this->input->post('email');
        $password = $this->common->fullEncode($this->input->post('password'));
        $data = $this->common->getLoginInfo($email);

        if (isset($data->email)) {
            if ($email == $data->email && $password == $data->password && $data->role == 0) {
                $session = array(
                    'username' => 'Administrator',
                    'primary_email' => $data->email,
                    'role' => '0'
                );
                $this->session->set_userdata($session);
                header('location:' . site_url() . 'admin/dashboard');
            } else {
                header('location:' . site_url() . 'admin/login?msg=R');
            }
        } else {
            header('location:' . site_url() . 'admin/login?msg=R');
        }
    }

    function logout() {
        $role = $this->session->userdata('role');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('primary_email');
        $this->session->unset_userdata('employee_id');
        $this->session->unset_userdata('role');
        if ($role == '0') {
            header('location:' . site_url() . 'admin/login');
        } else {
            header('location:' . site_url() . 'employee/login');
        }
    }

}
