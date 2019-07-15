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
class Sms_notification extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->logged_in()) {
            header('location:' . site_url());           
        }
        $this->load->model('admin/m_sms_notification', 'obnotification');
    }

    function index() {
        $data['autosms'] = $this->obnotification->getAllAutoSms();
        $this->load->view('admin/header');
        $this->load->view('admin/sms_templates/sms_template', $data);
        $this->load->view('admin/footer');
    }

    function edit($aid) {
        $data['template'] = $this->obnotification->getAutoSms($aid);
        $this->load->view('admin/header');
        $this->load->view('admin/sms_templates/edit_sms_template', $data);
        $this->load->view('admin/footer');
    }

    function update() {
        $post = $this->input->post();
        $this->obnotification->update($post);
        header('location:' . site_url() . 'admin/sms_notification?msg=U');
    }

}
