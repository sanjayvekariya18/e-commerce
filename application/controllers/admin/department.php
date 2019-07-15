<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Department extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->department) {
            header('location:' . site_url() . 'admin');
        }
        $this->load->model('admin/m_department', 'odepartment');
    }

    function index() {
        $data['department'] = $this->odepartment->getAllDepartmentData();
        $this->load->view('admin/header');
        $this->load->view('admin/edepartment/department', $data);
        $this->load->view('admin/footer');
    }

    function addDepartmentData() {
        $result = $this->odepartment->addDepartmentData();
        if ($result == 1) {
            header('location:' . site_url() . 'admin/department?msg=S');
        }
    }

    function updateDepartmentData() {
        $result = $this->odepartment->updateDepartmentData();
        if ($result == 1) {
            header('location:' . site_url() . 'admin/department?msg=U');
        }
    }

    function deleteDepartmentData() {
        $result = $this->odepartment->deleteDepartmentData();
        if ($result == 1) {
            header('location:' . site_url() . 'admin/department?msg=D');
        }
    }

}
