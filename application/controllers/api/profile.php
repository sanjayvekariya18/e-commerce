<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH . 'application/libraries/REST_Controller.php';

class Profile extends REST_Controller {

    function __construct() {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
    }

    function index_post() {
        $customer_id = $this->input->post('customer_id');
        $customer = $this->common->getCustomerDataById($customer_id);

        if (isset($customer->customer_id)) {
            $customer_data = array(
                'first_name' => $customer->first_name,
                'last_name' => $customer->last_name,
                'address' => $customer->address,
                'city' => $customer->city,
                'state' => $customer->state,
                'pincode' => $customer->pincode,
                'landmark' => $customer->landmark,
                'primary_email' => $customer->primary_email,
                'primary_mobile' => $customer->primary_mobile,
                'gender' => $customer->gender,
                'msg' => "S"
            );
        } else {
            $customer_data = array(
                'msg' => "F"
            );
        }

        $responce = $this->response($customer_data, 200);
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_output($responce);
    }

    function update_post() {
        $customer_id = $this->input->post('customer_id');
        $customer_data = array(
            'first_name' => $this->input->post('fname'),
            'last_name' => $this->input->post('lname'),
            'primary_mobile' => $this->input->post('mobile'),           
            'address' => $this->input->post('address'),
            'landmark' => $this->input->post('landmark'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'pincode' => $this->input->post('pincode'),
        );

        $result = $this->common-> updateCustomerById($customer_data,$customer_id);
        if ($result == 1) {
            $responce = $this->response(array('msg' => 'S'), 200);
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
