<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author Laxmisoft
 */
class Pages extends CI_Controller {

    function __construct() {
        parent::__construct();


        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->pages) {
            header('location:' . site_url() . 'admin');
        }
        $this->load->model('admin/m_pages', 'objpage');
    }

    function index() {
        $data['pages'] = $this->objpage->getPages();
        $this->load->view('admin/header');
        $this->load->view('admin/webpage/pages', $data);
        $this->load->view('admin/footer');
    }

    function getContent() {
        $pageid = $this->input->post('pageid');
        $res = $this->objpage->getContent($pageid);
        if ($res) {
            echo json_encode($res, JSON_HEX_QUOT | JSON_HEX_TAG);
        } else {
            echo 0;
        }
    }

    function update() {
        $post = $this->input->post();
        $this->objpage->update($post);
        header('location:' . site_url() . 'admin/pages?msg=U');
    }

    //----------------------seller Home Page -----------------------------------

    function sellerHome() {
        $data['block1'] = $this->objpage->getSellerHomeBlock1();
        $this->load->view('admin/header');
        $this->load->view('admin/sellerwebpage/home',$data);
        $this->load->view('admin/footer');
    }
    
    function updateSellerHomeBlock1(){
        $this->objpage->updateSellerHomeBlock1();
        header("location:".site_url()."admin/pages/sellerHome?msg=U");
    }

}
