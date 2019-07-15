<?php

class Seo extends CI_Controller {

//put your code here
    function __construct() {
        parent::__construct();
        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->seo) {
            header('location:' . site_url() . 'admin');
        }
        $this->load->model('admin/m_seo', 'oseo');
    }

    function index() {
        $data['seo'] = $this->oseo->getMetadata();
        $this->load->view('admin/header');
        $this->load->view('admin/setting/seo', $data);
        $this->load->view('admin/footer');
    }

    function addMetadata() {
        $post = $this->input->post();
        $insertid = $this->oseo->addMetadata($post);
        echo $insertid;
    }

    function updateMetadata() {
        $post = $this->input->post();
        echo ($this->oseo->updateMetadata($post)) ? 1 : 0;
    }

    function deleteMetadata() {
        $id = $this->input->post('seoid');
        echo ($this->oseo->deleteMetadata($id)) ? 1 : 0;
    }

}
