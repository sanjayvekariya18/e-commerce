<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reset extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->siteStatus()) {
            header('location:' . site_url() . 'error');
        }
        $this->load->model('m_reset', 'oreset');
    }

    function admin() {
        $email_id = $this->input->post('email_id');
        $role = "0";
        if ($email_id != "") {
            $result = $this->oreset->admin_exist($email_id);
            if ($result) {
                $status = $this->oreset->reset_password($email_id, $role);
                echo $status;
            } else {
                echo '0';
            }
        }
    }

    function employee() {
        $email_id = $this->input->post('email_id');
        $role = "2";
        if ($email_id != "") {
            $result = $this->oreset->employee_exist($email_id);
            if ($result) {
                $status = $this->oreset->reset_password($email_id, $role);
                echo $status;
            } else {
                echo '0';
            }
        }
    }

    function seller() {
        $email_id = $this->input->post('email_id');
        $role = "1";
        if ($email_id != "") {
            $result = $this->oreset->seller_exist($email_id);
            if ($result) {
                $status = $this->oreset->reset_password($email_id, $role);
                echo $status;
            } else {
                echo '0';
            }
        }
    }

    function customer() {
        $email_id = $this->input->post('email_id');
        $role = "3";
        if ($email_id != "") {
            $result = $this->oreset->customer_exist($email_id);
            if ($result) {
                $status = $this->oreset->reset_password($email_id, $role);
                echo $status;
            } else {
                echo '0';
            }
        }
    }

}
