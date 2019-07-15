<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Track extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->customer_logged_in()) {
            header('location:' . site_url());
        } 
        $this->load->model('buyer/m_order', 'order');
    }

    function index() {
        $order_id = base64_decode($this->input->get('id'));
        $data['order'] = $this->order->getTrackOrderData($order_id);
        $data['orderstatus'] = $this->order->getTrackOrderStatusData($order_id);        
        $this->load->view('buyer/header');
        $this->load->view('buyer/track/track', $data);
        $this->load->view('buyer/footer');
    }
    
    function returnOrder() {
        $order_id = base64_decode($this->input->get('id'));
        $data['order'] = $this->order->getTrackReturnOrderData($order_id);
        $data['orderstatus'] = $this->order->getTrackReturnOrderStatusData($order_id);        
        $this->load->view('buyer/header');
        $this->load->view('buyer/track/track', $data);
        $this->load->view('buyer/footer');
    }

    function printInvoice() {
        $order_id = base64_decode($this->input->get('id'));
        $data['order'] = $this->order->getOrderData($order_id);
        if (isset($data['order']->order_id)) {
            $customer_id = $data['order']->customer_id;
            $seller_id = $data['order']->seller_id;
            $data['customer'] = $this->order->getCustomerData($customer_id);
            $data['seller'] = $this->order->getSellerData($seller_id);
        }
        $this->load->view('buyer/print/invoice', $data);       
    }

}
