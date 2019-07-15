<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Signup extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->siteStatus()) {
            header('location:' . site_url() . 'error');
        }
        $this->load->library('parser');
    }

    function index() {
        $this->load->view('website/header');
        $this->load->view('website/signup');
        $this->load->view('website/footer');
    }

    function register() {
        $data = $this->input->post();
        if ($this->email_valid() != '0') {
            header('location:' . site_url() . '?msg=ARG');
        } else {
            $this->common->addCustomer($data);
            $this->sendSignupMailToBuyer($data);
            $this->sendSignupSMSToBuyer($data);
            header('location:' . site_url() . '?msg=RG');
        }
    }
    
    function email_valid() {
        $result = $this->common->email_valid($this->input->post('primary_email'));
        return $result;
    }

    function sendSignupMailToBuyer($data) {
        $templateInfo = $this->common->getMailTemplate("WELCOME E-MAIL", "Buyer");
        $tag = array(
            'FIRST_NAME' => $data['first_name'],
            'LAST_NAME' => $data['last_name'],
            'USER_ID' => $data['primary_email'],
            'PASSWORD' => $data['password']
        );
        $subject = $this->parser->parse_string($templateInfo->mail_subject, $tag, TRUE);
        $from = ($templateInfo->from != "") ? $templateInfo->from : NULL;
        $name = ($templateInfo->name != "") ? $templateInfo->name : NULL;
        $to = $data['primary_email'];
        $this->load->view('email_format', $templateInfo, TRUE);
        $body = $this->parser->parse('email_format', $tag, TRUE);
        $this->common->sendEmail($from, $to, $subject, $body, $name);
    }

    function sendSignupSMSToBuyer($data) {
        $templateInfo = $this->common->getSmsTemplate("WELCOME SMS", "Buyer");
        $tag = array(
            'FIRST_NAME' => $data['first_name'],
            'LAST_NAME' => $data['last_name'],
            'USER_ID' => $data['primary_email'],
            'PASSWORD' => $data['password']
        );
        $message = $this->parser->parse_string($templateInfo->message, $tag, TRUE);
        $to = $data['primary_mobile'];
        $this->common->SMSSend($to, $message, true);
    }

}
