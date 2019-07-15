<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bulkemail extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->bulkemail) {
            header('location:' . site_url() . 'admin');
        }
        $this->load->model('admin/m_bulkemail', 'oemail');
    }

    function index() {
        $this->load->view('admin/header');
        $this->load->view('admin/bulkemail/bulkemail');
        $this->load->view('admin/footer');
    }

    function sendEmail() {
        $from = "info@shopking24.com";
        $sendto = $this->input->post('email_to');
        switch ($sendto) {
            case "1":
                $to = $this->oemail->getAllSellerEmailId();
                break;
            case "2":
                $to = $this->oemail->getAllCustomerEmailId();
                break;
            case "3":
                $to = $this->oemail->getAllEmployeeEmailId();
                break;
            default:
                break;
        }        
        
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');
       
        
        if ($to != "") {
            $result = $this->common->sendEmail($from, $to, $subject, $message);            
            echo $result;
        }       
    }

}
