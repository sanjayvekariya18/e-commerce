<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order_failed extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->order_fail) {
            header('location:' . site_url() . 'admin');
        }
        $this->load->model('admin/m_order_failed', 'oorderfail');
    }

    function index() {
        $data['orders'] = $this->oorderfail->getAllFailOrdersData();
        $this->load->view('admin/header');
        $this->load->view('admin/orders/order_fail_mst', $data);
        $this->load->view('admin/footer');
    }

    function orderClear() {
        $this->oorderfail->orderClear();
        header("location:".site_url()."admin/order_failed");
    }

}
