<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Advertisement extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->advertisement) {
            header('location:' . site_url() . 'admin');
        }
        $this->load->model('admin/m_advertisement', 'oadvertisement');
    }

    function index() {
        $this->load->view('admin/header');
        $this->load->view('admin/advertisement/advertisement');
        $this->load->view('admin/footer');
    }

    function uploadImage() {
        if (isset($_POST)) {
            $result = $this->oadvertisement->uploadImage();
            header('location:' . site_url() . 'admin/advertisement?msg=U');
        }
    }

    function getUrl() {
        $this->oadvertisement->getUrl();
    }
    
    function advertisementPricing() {
        $data['pricing'] = $this->oadvertisement->getPlanPricing();
        $this->load->view('admin/header');
        $this->load->view('admin/advertisement/advertisement-pricing', $data);
        $this->load->view('admin/footer');
    }

    function addPlan() {
        $this->load->view('admin/header');
        $this->load->view('admin/advertisement/add-plan');
        $this->load->view('admin/footer');
    }

    function editPlan() {
        $planid = base64_decode($this->input->get('id'));
        $data['plan'] = $this->oadvertisement->getPlan($planid);
        $this->load->view('admin/header');
        $this->load->view('admin/advertisement/add-plan', $data);
        $this->load->view('admin/footer');
    }

    function insertPlan() {
        $post = $this->input->post();
        $this->oadvertisement->insertPlan($post);
        header('location:' . site_url() . 'admin/advertisement/advertisementPricing?msg=I');
    }

    function updatePlan() {
        $post = $this->input->post();
        $this->oadvertisement->updatePlan($post);
        header('location:' . site_url() . 'admin/advertisement/advertisementPricing?msg=U');
    }

    function deletePlan() {
        $planid = base64_decode($this->input->get('id'));
        $this->oadvertisement->deletePlan($planid);
        header('location:' . site_url() . 'admin/advertisement/advertisementPricing?msg=D');
    }

    function advertisementRequest() {
        $data['request'] = $this->oadvertisement->getRequests();
        $this->load->view('admin/header');
        $this->load->view('admin/advertisement/advertisement-request', $data);
        $this->load->view('admin/footer');
    }

    function search() {
        $data['request'] = $this->oadvertisement->search();
        $this->load->view('admin/header');
        $this->load->view('admin/advertisement/advertisement-request', $data);
        $this->load->view('admin/footer');
    }

    function requestStatusUpdate() {
        $this->oadvertisement->requestStatusUpdate();
        header("location:" . site_url() . "admin/advertisement/advertisementRequest?msg=S");
    }

    function deleteRequest() {
        $requestid = base64_decode($this->input->get('id'));
        $this->oadvertisement->deleteRequest($requestid);
        header('location:' . site_url() . 'admin/advertisement/advertisementRequest?msg=D');
    }
    
    //-----------------------------Mobile Banner -------------------------------
    
    function mobile() {
        $this->load->view('admin/header');
        $this->load->view('admin/advertisement/mobile_banner');
        $this->load->view('admin/footer');
    }
    
    function uploadImageForMobile() {
        if (isset($_POST)) {
            $result = $this->oadvertisement->uploadImageForMobile();
            header('location:' . site_url() . 'admin/advertisement/mobile?msg=U');
        }
    }

}
