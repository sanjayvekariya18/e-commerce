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
class Email_notification extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->logged_in()) {
            header('location:' . site_url());           
        }
        $this->load->model('admin/m_email_notification', 'obnotification');
    }

    function index() {
        $data['automail'] = $this->obnotification->getAutomails();
        $this->load->view('admin/header');
        $this->load->view('admin/email_templates/email_template', $data);
        $this->load->view('admin/footer');
    }

    function edit($aid) {
        $data['template'] = $this->obnotification->getAutomail($aid);
        $this->load->view('admin/header');
        $this->load->view('admin/email_templates/edit_email_template', $data);
        $this->load->view('admin/footer');
    }

    function update() {
        $post = $this->input->post();
        $this->obnotification->update($post);
        header('location:' . site_url() . 'admin/email_notification?msg=U');
    }

}
