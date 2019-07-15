<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Advertisement extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->common->seller_logged_in()) {
            header('location:' . site_url());
        }
        $this->load->model('seller/m_advertisement', 'oadvertisement');
    }

    function index() {
        $data['request'] = $this->oadvertisement->getRequests();
        $this->load->view('seller/header');
        $this->load->view('seller/advertisement/advertisement-request', $data);
        $this->load->view('seller/footer');
    }

//    function search() {
//        $data['request'] = $this->oadvertisement->search();
//        $this->load->view('seller/header');
//        $this->load->view('seller/advertisement/advertisement-request', $data);
//        $this->load->view('seller/footer');
//    }

    function addRequest() {
        $data['plan'] = $this->oadvertisement->getPlanPricing();
        $this->load->view('seller/header');
        $this->load->view('seller/advertisement/add-request', $data);
        $this->load->view('seller/footer');
    }

    function editRequest() {
        $requestid = base64_decode($this->input->get('id'));
        $data['plan'] = $this->oadvertisement->getPlanPricing();
        $data['request'] = $this->oadvertisement->getRequest($requestid);
        $this->load->view('seller/header');
        $this->load->view('seller/advertisement/add-request', $data);
        $this->load->view('seller/footer');
    }

    function insertRequest() {
        $post = $this->input->post();
        $this->oadvertisement->insertRequest($post);
        header('location:' . site_url() . 'seller/advertisement?msg=I');
    }

    function updateRequest() {
        $post = $this->input->post();
        $this->oadvertisement->updateRequest($post);
        header('location:' . site_url() . 'seller/advertisement?msg=U');
    }

    function deleteRequest() {
        $planid = base64_decode($this->input->get('id'));
        $this->oadvertisement->deleteRequest($planid);
        header('location:' . site_url() . 'seller/advertisement?msg=D');
    }

}
