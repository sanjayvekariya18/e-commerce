<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH . 'application/libraries/REST_Controller.php';

class Password extends REST_Controller {

    function __construct() {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
    }

    function index_post() {
        $primary_email = $this->input->post('primary_email');
        $oldpass = $this->common->fullEncode($this->input->post('oldpass'));
        $newpass = $this->common->fullEncode($this->input->post('newpass'));

        $result = $this->common->updatePassword($primary_email, $oldpass, $newpass);
        if ($result == 1) {
            $responce = $this->response(array('msg'=>"S"), 200);
        } else {
            $responce = $this->response(array('msg'=>"F"), 200);
        }
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_output($responce);
    }    
}
