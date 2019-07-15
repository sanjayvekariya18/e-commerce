<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $data['otp'] = $this->common->otpSetting();
        $this->load->view('employee/login', $data);
    }

    function checkLogin() {
        $email = $this->input->post('email');
        $password = $this->common->fullEncode($this->input->post('password'));
        $data = $this->common->getLoginInfo($email);

        if (isset($data->email)) {
            if ($email == $data->email && $password == $data->password && $data->role == 2) {
                $employee_data = $this->common->getEmployeeData($data->email);
                $session = array(
                    'username' => $employee_data->first_name . ' ' . $employee_data->last_name,
                    'primary_email' => $employee_data->email,
                    'employee_id' => $employee_data->employee_id,
                    'role' => '2'
                );
                $this->session->set_userdata($session);
                header('location:' . site_url() . 'admin/dashboard');
            } else {
                header('location:' . site_url() . 'employee/login?msg=R');
            }
        } else {
            header('location:' . site_url() . 'employee/login?msg=R');
        }
    }

    function sendOTP() {
        $otpsetting = $this->common->otpSetting();
        $otp = $this->input->post('otp');
        $username = $this->input->post('username');
        $mobile = $otpsetting->mobile;
        $email = $otpsetting->email;

        if (isset($otpsetting->mobile)) {
            $this->sendOtpToMobile($otp, $mobile, $username);
        }
        if (isset($otpsetting->email)) {
            $this->sendOtpToEmail($otp, $email, $username);
        }
    }

    function sendOtpToMobile($otp, $mobile, $username) {
        $message = "Your OTP Code Is " . $otp . " For Login Id " . $username;
        $this->common->SMSSend($mobile, $message, TRUE);
        // UPDATE SMS COUNTER
        $this->common->smsCountUpdate('1');
    }

    function sendOtpToEmail($otp, $email, $username) {

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'vishaltesting7@gmail.com', // change it to yours
            'smtp_pass' => 'vishal789', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        $message = "Your OTP Code Is " . $otp . " For Login Id " . $username;

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('vishaltesting7@gmail.com'); // change it to yours
        $this->email->to($email); // change it to yours
        $this->email->subject('Employee One Time OTP');
        $this->email->message($message);
        if ($this->email->send()) {
            return 1;
        } else {
            return 0;
        }
    }    

}
