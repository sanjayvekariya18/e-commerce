<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bulksms extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->bulksms) {
            header('location:' . site_url() . 'admin');
        }
        $this->load->model('admin/m_bulksms', 'osms');
    }

    function index() {
        $this->load->view('admin/header');
        $this->load->view('admin/bulksms/bulksms');
        $this->load->view('admin/footer');
    }

    function sendMessage() {
        $sendto = $this->input->post('message_to');
        switch ($sendto) {
            case "1":
                $to = $this->osms->getAllSellerMobile();
                break;
            case "2":
                $to = $this->osms->getAllCustomerMobile();
                break;
            case "3":
                $to = $this->osms->getAllEmployeeMobile();
                break;
            default:
                break;
        }
        
        $message = $this->input->post('message');

        if ($to != "") {
            $result = $this->common->SMSSend($to, $message, true);
            echo 1;
        }
    }

}
