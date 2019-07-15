<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH . 'application/libraries/REST_Controller.php';

class Home extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('website/m_home', 'ohome');
        header('Access-Control-Allow-Origin: *');
    }

    function sliderProduct_post() {
        
        $data['slider1'] = $this->ohome->getSlider1();
        $data['slider2'] = $this->ohome->getSlider2();        
        
        $responce = $this->response($data, 200);
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_output($responce);
    }

}
