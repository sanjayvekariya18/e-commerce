<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->view('buyer/login');
    }

    function checkLogin() {
        $email = $this->input->post('email');
        $password = $this->common->fullEncode($this->input->post('password'));
        $data = $this->common->getLoginInfo($email);
        if (isset($data->email)) {
            if ($email == $data->email && $password == $data->password && $data->role == 3) {
                $customer_data = $this->common->getCustomerData($data->email);
                $session = array(
                    'customer_username' => $customer_data->first_name,
                    'customer_primary_email' => $customer_data->primary_email,
                    'customer_id' => $customer_data->customer_id,
                    'customer_role' => '3'
                );
                $this->session->set_userdata($session);
                header('location:' . site_url() . 'buyer/dashboard');
            } else {
                header('location:' . site_url() . '?msg=R');
            }
        } else {
            header('location:' . site_url() . '?msg=R');
        }
    }

    function checkoutLogin() {
        $email = $this->input->post('email');
        $password = $this->common->fullEncode($this->input->post('password'));
        $data = $this->common->getLoginInfo($email);
        $flag = 0;
        if (isset($data->email)) {
            if ($email == $data->email && $password == $data->password) {
                if ($data->role == 3) {
                    $customer_data = $this->common->getCustomerData($data->email);
                    $session = array(
                        'customer_username' => $customer_data->first_name . ' ' . $customer_data->last_name,
                        'customer_primary_email' => $customer_data->primary_email,
                        'customer_id' => $customer_data->customer_id,
                        'customer_role' => '3'
                    );
                    $this->session->set_userdata($session);
                    $flag = '1|' . $customer_data->primary_email;
                }
            }
        }
        echo $flag;
    }    

    function logout() {
        $this->session->unset_userdata('customer_username');
        $this->session->unset_userdata('customer_primary_email');
        $this->session->unset_userdata('customer_id');
        $this->session->unset_userdata('customer_role');
        header('location:' . site_url());
    }

}
