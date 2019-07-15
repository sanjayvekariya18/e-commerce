<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dtdc_details extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->dtdc_details) {
            header('location:' . site_url() . 'admin');
        }
        $this->load->model('admin/m_dtdc_details', 'odtdc');
    }

    function index() {       
        $data['trackingIdList'] = $this->odtdc->getAllTrackingIdData();
        $this->load->view('admin/header');
        $this->load->view('admin/setting/dtdc_details',$data);
        $this->load->view('admin/footer');
    }

    function addTrackingData() {
        $result = $this->odtdc->addTrackingData();
        if ($result == 1) {
            header('location:' . site_url() . 'admin/dtdc_details?msg=S');
        }
    }

    function updateTrackingData() {
        $result = $this->odtdc->updateTrackingData();
        if ($result == 1) {
            header('location:' . site_url() . 'admin/dtdc_details?msg=U');
        }
    }

    function deleteTrackingData() {
        $result = $this->odtdc->deleteTrackingData();
        if ($result == 1) {
            header('location:' . site_url() . 'admin/dtdc_details?msg=D');
        }
    }

}
