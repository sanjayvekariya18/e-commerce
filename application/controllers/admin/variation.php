<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Variation extends CI_Controller {

    function __construct() {
        parent::__construct();    
        if(!$this->common->logged_in()){
           header('location:' . site_url());
        }else if(!$this->common->getPermission($this->session->userdata('primary_email'))->variation){
            header('location:'.site_url().'admin');
        }
        $this->load->model('admin/m_variation', 'ovariation');
    }

    
    function index() {
        $this->load->view('admin/header');
        $this->load->view('admin/variation/variation');
        $this->load->view('admin/footer');
    }
    
    function search() {
        $data['variation'] = $this->ovariation->getSearchVariationData();
        $this->load->view('admin/header');
        $this->load->view('admin/variation/variation',$data);
        $this->load->view('admin/footer');
    }

    function addVariationData() {
        $result = $this->ovariation->addVariationData();
        if ($result == 1) {
            header('location:' . site_url() . 'admin/variation?msg=S');
        }
    }

    function updateVariationData() {
        $result = $this->ovariation->updateVariationData();
        if ($result == 1) {
            header('location:' . site_url() . 'admin/variation?msg=U');
        }
    }

    function deleteVariationData() {
        $result = $this->ovariation->deleteVariationData();
        if ($result == 1) {
            header('location:' . site_url() . 'admin/variation?msg=D');
        }
    }
    
    function uploadEthinicFile() {

        $path = FCPATH . '/upload/productfile/';
        $config['upload_path'] = $path;
        $config['allowed_types'] = '*';
        $config['file_name'] = 'ethinic_variations_list.csv';
        $config['overwrite'] = 'TRUE';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($_FILES['ethinic']['error'] != 4) {

            if (!$this->upload->do_upload('ethinic')) {
                $this->upload->display_errors();
            }
        }
        header("location:" . site_url() . "admin/variation?msg=US");
    }
    
    function uploadLeggingsFile() {

        $path = FCPATH . '/upload/productfile/';
        $config['upload_path'] = $path;
        $config['allowed_types'] = '*';
        $config['file_name'] = 'leggings_variations_list.csv';
        $config['overwrite'] = 'TRUE';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($_FILES['leggings']['error'] != 4) {

            if (!$this->upload->do_upload('leggings')) {
                $this->upload->display_errors();
            }
        }
        header("location:" . site_url() . "admin/variation?msg=US");
    }
    
    function uploadJewelleryFile() {

        $path = FCPATH . '/upload/productfile/';
        $config['upload_path'] = $path;
        $config['allowed_types'] = '*';
        $config['file_name'] = 'jewellery_variations_list.csv';
        $config['overwrite'] = 'TRUE';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($_FILES['jewellery']['error'] != 4) {

            if (!$this->upload->do_upload('jewellery')) {
                $this->upload->display_errors();
            }
        }
        header("location:" . site_url() . "admin/variation?msg=US");
    }
}
