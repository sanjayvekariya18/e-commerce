<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Slider_product extends CI_Controller {

    function __construct() {
        parent::__construct();    
        if(!$this->common->logged_in()){
            header('location:' . site_url());
        }else if(!$this->common->getPermission($this->session->userdata('primary_email'))->others){
            header('location:'.site_url().'admin');
        }
    }
    
    function index() {
        $data['slider'] = $this->common->sliderProducts();
        $this->load->view('admin/header');
        $this->load->view('admin/setting/slider_product', $data);
        $this->load->view('admin/footer');
    }
    
    function updateSliderProduct() {
        $slider1 = $this->input->post('slider1');
        $slider2 = $this->input->post('slider2');
        $result = $this->common->updateSliderProduct($slider1,$slider2);
        header('location:' . site_url() . 'admin/slider_product?msg=U');
    }

}
