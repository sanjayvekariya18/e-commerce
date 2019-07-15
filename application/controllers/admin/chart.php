<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Chart extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        }
        $this->load->model('admin/m_chart', 'ochart');
        $this->load->model('admin/m_seller', 'oseller');
    }

    function index() {
        
        $data = $this->ochart->getChartData();
        $totalrecord = 0;
        foreach ($data as $val) {
            $totalrecord += $val->total;
        }

        $chart = array();
        foreach ($data as $val) {
            $data = $this->getStatus($val->order_status);
            $chartdata = array(
                'label' => '' . $data['name'] . '<br/> (orders : '.$val->total.')',
                'data' => array(array(1 , round($val->total / $totalrecord * 100))),
                'color' => "#" . $data['color']                
            );
            $chart[] = $chartdata;
        }        
        $data['seller'] = $this->oseller->getAllSellers();
        $data['chartdata'] = json_encode($chart);
        $this->load->view('admin/header');
        $this->load->view('admin/chart/chart', $data);
        $this->load->view('admin/footer');
    }

    function getStatus($id) {
        switch ($id) {            
            case 4:
                $result = array('name' => 'Delivery', 'color' => "2D822D");
                break;
            case 5:
                $result = array('name' => 'Return', 'color' => "C01616");
                break;
            case 6:
                $result = array('name' => 'Cancel', 'color' => "1616C0");
                break;
            case 7:
                $result = array('name' => 'Replace', 'color' => "FF00FF");
                break;
            case 8:
                $result = array('name' => 'Ship Cancel', 'color' => "FF2B00");
                break;            
        }
        return $result;
    }
}
