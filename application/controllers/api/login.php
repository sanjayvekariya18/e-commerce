<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH . 'application/libraries/REST_Controller.php';

class Login extends REST_Controller {

    function __construct() {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
    }

    function index_post() {
        $login_data = array(
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );

        $result = $this->apiLogin($login_data);        
        $responce = $this->response($result, 200);
        
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_output($responce);
    }

    function apiLogin($login_data) {
        $email = $login_data['email'];
        $password = $this->common->fullEncode($login_data['password']);
        $data = $this->common->getLoginInfo($email);
        if (isset($data->email)) {
            if ($email == $data->email && $password == $data->password && $data->role == 3) {
                $customer_data = $this->common->getCustomerData($data->email);
                $result = array(
                    'customer_username' => $customer_data->first_name . ' ' . $customer_data->last_name,
                    'customer_primary_email' => $customer_data->primary_email,
                    'customer_id' => $customer_data->customer_id,
                    'customer_role' => '3',
                    'msg' => 'S'
                );
            } else {
                $result = array(
                    'msg' => 'W'
                );
            }
        } else {
            $result = array(
                'msg' => 'NR'
            );
        }
        return $result;
    }

}
