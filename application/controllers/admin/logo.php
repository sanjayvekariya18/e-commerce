<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logo extends CI_Controller {

    function __construct() {
        parent::__construct();
        if(!$this->common->logged_in()){
            header('location:' . site_url());
        }else if(!$this->common->getPermission($this->session->userdata('primary_email'))->logo){
            header('location:'.site_url().'admin');
        }        
    }

    function index() {
        $data['popupstatus'] = $this->common->getPopupStatus();
        $this->load->view('admin/header');
        $this->load->view('admin/setting/logo_setting',$data);
        $this->load->view('admin/footer');
    }  
    
    function uploadLogo() {

        $path = FCPATH . '/assets/images/';
        $config['upload_path'] = $path;
        $config['allowed_types'] = '*';
        $config['file_name'] = 'logo.png';
        $config['overwrite'] = 'TRUE';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($_FILES['picture']['error'] != 4) {

            if (!$this->upload->do_upload('picture')) {
                $this->upload->display_errors();
            }
        }
        header("location:" . site_url() . "admin/logo?msg=S");
    }
    
    function uploadPopup() {

        $path = FCPATH . '/assets/images/';
        $config['upload_path'] = $path;
        $config['allowed_types'] = '*';
        $config['file_name'] = 'popup.png';
        $config['overwrite'] = 'TRUE';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($_FILES['popupimage']['error'] != 4) {
            if (!$this->upload->do_upload('popupimage')) {
                $this->upload->display_errors();
            }
        }
        $this->common->updatePopupStatus($_POST['popupstatus']);        
        header("location:" . site_url() . "admin/logo?msg=S");
    }
 
}
