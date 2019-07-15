<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        }
        $this->load->model('admin/m_dashboard','odashboard');
        $this->load->helper('download');
        $this->load->library('dompdf_gen');
    }

    function index() {       
        
        $data['Sellers'] = $this->odashboard->getTotalSeller();
        $data['Customers'] = $this->odashboard->getTotalCustomer();
        $data['Employees'] = $this->odashboard->getTotalEmployee();
        $data['Products'] = $this->odashboard->getTotalLiveProducts();
        $data['TopSeller'] = $this->odashboard->getTopSeller();        
        $data['TopProduct'] = $this->odashboard->getTopProducts();        
        $this->load->view('admin/header');
        $this->load->view('admin/dashboard/dashboard',$data);
        $this->load->view('admin/footer');
    }

}
