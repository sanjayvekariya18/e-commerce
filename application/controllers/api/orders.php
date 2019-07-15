<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH . 'application/libraries/REST_Controller.php';

class Orders extends REST_Controller {

    function __construct() {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        $this->load->model('buyer/m_order', 'order');
    }

    function index_post() {
        $customer_id = $this->input->post('customer_id');
        $data['customer'] = $this->common->getCustomerDataById($customer_id);
        $data['rorders'] = $this->order->getRecentOrderData($customer_id);
        $data['porders'] = $this->order->getPastOrderData($customer_id);
        $data['bankname'] = $this->common->getAllBank();

        $html = $this->load->view('api/orders',$data,true);
        
        $responce = $this->response($html, 200);
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_output($responce);
    }
    
    function cancelOrder_post() {
        $result = $this->order->cancelOrder();
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
    
    function returnOrder_post() {
        $result = $this->order->returnOrder();
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
    
    function trackOrder_post(){
        $order_id = $this->input->post('order_id');
        $data['order'] = $this->order->getTrackOrderData($order_id);
        $data['orderstatus'] = $this->order->getTrackOrderStatusData($order_id);        
        $html = $this->load->view('api/track',$data,true);
        
        $responce = $this->response($html, 200);
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_output($responce);
    }

}
