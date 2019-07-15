<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH . 'application/libraries/REST_Controller.php';

class Register extends REST_Controller {

    function __construct() {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
    }

    function index_post() {
        $customer_data = array(           
            'first_name' => $this->input->post('fname'),
            'last_name' => $this->input->post('lname'),
            'primary_mobile' => $this->input->post('mobile'),
            'primary_email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
            'landmark' => $this->input->post('landmark'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'pincode' => $this->input->post('pincode'),
            'password' => $this->input->post('password'),
            'join_via' => '2',
        );

        $valid = $this->common->email_valid($this->input->post('email'));                  
        if ($valid == 0) {
            $customer_id = $this->common->addCustomer($customer_data);
            if ($customer_id != "") {
                $responce = $this->response(array('msg' => 'S'), 200);
            } else {
                $responce = $this->response(array('msg' => 'R'), 200);
            }
        } else {
            $responce = $this->response(array('msg' => 'R'), 200);            
        }        
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_output($responce);
    }

}
