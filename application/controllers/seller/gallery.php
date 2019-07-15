<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gallery extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->seller_logged_in()) {
            header('location:' . site_url());
        }
        $this->load->library('image_lib');
        $this->load->model('seller/m_gallery', 'ogallery');
    }

    function index() {
        $data['gallery'] = $this->ogallery->getGalleryData();
        $this->load->view('seller/header');
        $this->load->view('seller/gallery/upload',$data);
        $this->load->view('seller/footer');
    }
    
    function search(){
        $data['gallery'] = $this->ogallery->search();
        $this->load->view('seller/header');
        $this->load->view('seller/gallery/upload',$data);
        $this->load->view('seller/footer');
    }

    function upload() {
        $this->ogallery->upload();
        header("location:".site_url()."seller/gallery?msg=S");
    }

}
