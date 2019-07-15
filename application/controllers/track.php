<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Track extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_track','otrack');
    }

    function index() {
        $this->otrack->trackOrders();
    }
    
    function dtdc() {
        $this->otrack->dtdcTrackOrder();
    }
    
    function order(){
        $this->load->view('website/header');
        $this->load->view('website/track');
        $this->load->view('website/footer');
    }
    
    function orderTrack(){
        $order_id = $this->input->post('order_id');
        $data['order'] = $this->otrack->getTrackOrderData($order_id);
        $data['orderstatus'] = $this->otrack->getTrackOrderStatusData($order_id);     
        $this->load->view('website/header');
        $this->load->view('website/track',$data);
        $this->load->view('website/footer');
    }

}
