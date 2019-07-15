<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Indiapost_details extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->indiapost_details) {
            header('location:' . site_url() . 'admin');
        }
        $this->load->model('admin/m_indiapost_details', 'oindiapost');
    }

    function index() {       
        $data['trackingIdList'] = $this->oindiapost->getAllTrackingIdData();
        $this->load->view('admin/header');
        $this->load->view('admin/setting/indiapost_details',$data);
        $this->load->view('admin/footer');
    }

    function addTrackingData() {
        $result = $this->oindiapost->addTrackingData();
        if ($result == 1) {
            header('location:' . site_url() . 'admin/indiapost_details?msg=S');
        }
    }

    function updateTrackingData() {
        $result = $this->oindiapost->updateTrackingData();
        if ($result == 1) {
            header('location:' . site_url() . 'admin/indiapost_details?msg=U');
        }
    }

    function deleteTrackingData() {
        $result = $this->oindiapost->deleteTrackingData();
        if ($result == 1) {
            header('location:' . site_url() . 'admin/indiapost_details?msg=D');
        }
    }

}
