<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employee extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->employee) {
            header('location:' . site_url() . 'admin');
        }
        $this->load->model('admin/m_employee', 'oemployee');
    }

    function index() {
        $data['employees'] = $this->oemployee->getAllEmployeeData();
        $data['department'] = $this->common->getDepartments();
        $this->load->view('admin/header');
        $this->load->view('admin/employee/employee_mst', $data);
        $this->load->view('admin/footer');
    }
    
    function searchEmployee(){
        $data['employees'] = $this->oemployee->getSearchEmployeeData();
        $data['department'] = $this->common->getDepartments();
        $this->load->view('admin/header');
        $this->load->view('admin/employee/employee_mst', $data);
        $this->load->view('admin/footer');
    }

    function addEmployee() {
        $data['department'] = $this->common->getDepartments();
        $this->load->view('admin/header');
        $this->load->view('admin/employee/add_employee', $data);
        $this->load->view('admin/footer');
    }

    function addEmployeeData() {
        if (isset($_POST['employee_id'])) {
            if ($_POST['employee_id'] == "") {
                $this->oemployee->addEmployeeData();
                header('location:' . site_url() . 'admin/employee');
            } else {
                $this->oemployee->updateEmployeeData();
                header('location:' . site_url() . 'admin/employee');
            }
        }
    }

    function getEmployeeData() {
        $data['department'] = $this->common->getDepartments();
        $data['employee'] = $this->oemployee->getEmployeeData();
        $this->load->view('admin/header');
        $this->load->view('admin/employee/add_employee', $data);
        $this->load->view('admin/footer');
    }

    function deleteEmployeeData() {
        $this->oemployee->deleteEmployeeData();
        header('location:' . site_url() . 'admin/employee');
    }

    function email_valid() {
        $result = $this->common->email_valid($this->input->post('email'));
        echo $result;
    }
    
    function activeEmployee() {
        $result = $this->oemployee->activeEmployee();
        header('location:' . site_url() . 'admin/employee');
    }

    function suspendEmployee() {
        $result = $this->oemployee->suspendEmployee();
        header('location:' . site_url() . 'admin/employee');
    }
    
    function employee_login() {
        $primary_email = base64_decode($this->input->get('id'));
        $employee_data = $this->common->getEmployeeData($primary_email);
        $session = array(
            'username' => $employee_data->first_name." ".$employee_data->last_name,
            'primary_email' => $employee_data->email,
            'employee_id' => $employee_data->employee_id,
            'role' => '2'
        );
        $this->session->set_userdata($session);
        header('location:' . site_url() . 'admin/dashboard');
    }

}
