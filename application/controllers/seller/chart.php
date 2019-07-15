<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Chart extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->seller_logged_in()) {
            header('location:' . site_url());
        }
        $this->load->model('seller/m_chart', 'ochart');
    }

    function index() {
        $post = $this->input->post();
        $totalday = 0;
        if ($post == NULL) {
            $totalday = date('t', time());
            $month = date('Y-m', time());
        } else {
            $totalday = date('t', strtotime($post['year'] . '-' . $post['month']));
            $month = date('Y-m', strtotime($post['year'] . '-' . $post['month']));
        }

        $cancel = $this->ochart->getCancelOrder($month);
        $return = $this->ochart->getReturnOrder($month);
        $sales = $this->ochart->getSalesOty($month);
        $canceldata = array();
        $returndata = array();
        $salesdata = array();
        $cancelorder = array();
        $returnorder = array();
        $salesorder = array();
        
        

        for ($i = 1; $i <= $totalday; $i++) {
            $canceldata[$i] = 0;
            $returndata[$i] = 0;
            $salesdata[$i] = 0;
        }
        // Cancel Order Details

        foreach ($cancel as $val) {
            $canceldata[$val->day] = $val->total;
        }

        foreach ($canceldata as $key => $val) {
            $data = array($key, $val);
            $cancelorder[] = $data;
        }


        // Return Order Details

        foreach ($return as $val) {
            $returndata[$val->day] = $val->total;
        }

        foreach ($returndata as $key => $val) {
            $data = array($key, $val);
            $returnorder[] = $data;
        }

        // Sales Order Details

        foreach ($sales as $val) {
            $salesdata[$val->day] = $val->total;
        }

        foreach ($salesdata as $key => $val) {
            $data = array($key, $val);
            $salesorder[] = $data;
        }

        $data['revenue'] = $this->ochart->getRevenue($month);
        $data['chart'] = $this->ochart->getCounts($month);
        $data['cancelorder'] = json_encode($cancelorder);
        $data['returnorder'] = json_encode($returnorder);
        $data['salesorder'] = json_encode($salesorder);  
        
        $this->load->view('seller/header');
        $this->load->view('seller/chart/chart', $data);
        $this->load->view('seller/footer');
    }

}
