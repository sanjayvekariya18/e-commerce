<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();

        //MY_Output class's nocache() method
        $this->output->nocache();

        $this->load->model('website/m_home', 'ohome');
        if (!$this->common->siteStatus()) {
            header('location:' . site_url() . 'error');
        }
    }

    function index($term = NULL) {

        $flag = TRUE;
        if ($term != NULL) {
            $data['page'] = $this->ohome->getPageContent($term);
            if ($data['page']) {
                $this->load->view('website/header');
                $this->load->view('website/page-content', $data);
                $this->load->view('website/footer');
                $flag = FALSE;
            } else {
                $flag = TRUE;
            }
        }
        if ($flag) {

            $data['return'] = $this->common->returnDay();
            $data['slider1'] = $this->ohome->getSlider1();
            $data['slider2'] = $this->ohome->getSlider2();
            $data['banner'] = $this->ohome->getLinks();

            $this->load->view('website/header');
            $this->load->view('website/newhome', $data);
            $this->load->view('website/footer');
        }
    }

    function subscribe() {
        $email = $this->input->post('email');
        $isExist = $this->ohome->isExistEmail($email);
        if (!$isExist) {
            $this->ohome->addSubscribe($email);
            echo "s";
        } else {
            echo "f";
        }
    }

}
