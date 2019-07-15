<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function checkLogin() {
        $email = $this->input->post('email');
        $password = $this->common->fullEncode($this->input->post('password'));
        $data = $this->common->getLoginInfo($email);

        if (isset($data->email)) {
            if ($email == $data->email && $password == $data->password && $data->role == 1) {
                $seller_data = $this->common->getSellerData($data->email);
                if ($seller_data->email_status == 1) {
                    $session = array(
                        'seller_username' => $seller_data->first_name . ' ' . $seller_data->last_name,
                        'seller_primary_email' => $seller_data->primary_email,
                        'seller_id' => $seller_data->seller_id,
                        'seller_role' => '1'
                    );
                    $this->session->set_userdata($session);
                    header('location:' . site_url() . 'seller/dashboard');
                } else {
                    header('location:' . site_url() . 'seller?msg=E');
                }
            } else {
                header('location:' . site_url() . 'seller?msg=R');
            }
        } else {
            header('location:' . site_url() . 'seller?msg=R');
        }
    }

    function logout() {
        $this->session->unset_userdata('seller_username');
        $this->session->unset_userdata('seller_primary_email');
        $this->session->unset_userdata('seller_id');
        $this->session->unset_userdata('seller_role');
        header('location:' . site_url() . 'seller');
    }

}
