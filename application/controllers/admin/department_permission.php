<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Department_permission extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->permission) {
            header('location:' . site_url() . 'admin');
        }
        $this->load->model('admin/m_department', 'odepartment');
    }

    function index() {
        $data['department'] = $this->odepartment->getAllDepartmentData();
        $this->load->view('admin/header');
        $this->load->view('admin/edepartment/permission', $data);
        $this->load->view('admin/footer');
    }

    function getPermission() {
        $department_id = $this->input->post('department_id');
        $data['department'] = $this->odepartment->getAllDepartmentData();
        $data['permission'] = $this->odepartment->getPermission($department_id);
        $this->load->view('admin/header');
        $this->load->view('admin/edepartment/permission', $data);
        $this->load->view('admin/footer');
    }

    function setPermission() {
        $this->odepartment->setPermission();
        header('location:' . site_url() . 'admin/department_permission?msg=U');
    }

}
