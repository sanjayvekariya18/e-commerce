<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('website/m_home', 'ohome');
    }

    function index($term = NULL) {
        $flag = TRUE;
        if ($term != NULL) {
            $data['page'] = $this->ohome->getPageContent($term);
            if ($data['page']) {
                $this->load->view('seller/website/header');
                $this->load->view('seller/website/page-content', $data);
                $this->load->view('seller/website/footer');
                $flag = FALSE;
            } else {
                $flag = TRUE;
            }
        }
        if ($flag) {            
            $this->load->view('seller/website/header');
            $this->load->view('seller/website/home');
            $this->load->view('seller/website/footer');
        }
    }

}
