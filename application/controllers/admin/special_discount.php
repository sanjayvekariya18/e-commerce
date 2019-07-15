<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Special_discount extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->special_discount) {
            header('location:' . site_url() . 'admin');
        }
        $this->load->model('admin/m_special_discount', 'odiscount');
    }

    function index() {
        $data['discount'] = $this->odiscount->getAllDiscount();
        $this->load->view('admin/header');
        $this->load->view('admin/setting/special_discount', $data);
        $this->load->view('admin/footer');
    }

    function updateDiscount() {
        $this->odiscount->updateDiscount();
        header('location:' . site_url() . 'admin/special_discount?msg=U');
    }

}
