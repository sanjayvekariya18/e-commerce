<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Seller extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->seller) {
            header('location:' . site_url() . 'admin');
        }
        $this->load->model('admin/m_seller', 'oseller');
        $this->load->model('admin/m_seller_profile', 'oprofile');
    }

    function index() {
        $data['sellers'] = $this->oseller->getAllSellers();
        $this->load->view('admin/header');
        $this->load->view('admin/seller/seller_mst', $data);
        $this->load->view('admin/footer');
    }

    function profile() {
        if ($this->input->get('id') != "") {
            $primary_email = base64_decode($this->input->get('id'));
            $session_data = array(
                'seller_update_email' => $primary_email
            );
            $this->session->set_userdata($session_data);
        }
        $data['seller'] = $this->common->getSellerData($this->session->userdata('seller_update_email'));
        $data['sellergroup'] = $this->common->getAllSellerGroup();
        $data['bankname'] = $this->common->getAllBank();
        $data['states'] = $this->common->getStates();
        $this->load->view('admin/header');
        $this->load->view('admin/seller/profile', $data);
        $this->load->view('admin/footer');
    }

    function updateGroupInfo() {
        $this->oprofile->updateGroupInfo();
        header('location:' . site_url() . 'admin/seller/profile?msg=U');
    }

    function updateDisplayInfo() {
        $this->oprofile->updateDisplayInfo();
        header('location:' . site_url() . 'admin/seller/profile?msg=U');
    }

    function updatePickupInfo() {
        $this->oprofile->updatePickupInfo();
        header('location:' . site_url() . 'admin/seller/profile?msg=U');
    }

    function updatePrimaryInfo() {
        $this->oprofile->updatePrimaryInfo();
        header('location:' . site_url() . 'admin/seller/profile?msg=U');
    }

    function updateBusinessInfo() {
        $this->oprofile->updateBusinessInfo();
        header('location:' . site_url() . 'admin/seller/profile?msg=U');
    }

    function updateBankInfo() {
        $this->oprofile->updateBankInfo();
        header('location:' . site_url() . 'admin/seller/profile?msg=U');
    }

    function updateDocumentInfo() {
        $this->oprofile->updateDocumentInfo();
        header('location:' . site_url() . 'admin/seller/profile?msg=U');
    }

    function sendOTP() {
        $to = $this->input->post('mobile');
        $otp = $this->input->post('otp');
        $message = "Your Verification Code Is " . $otp;
        $this->common->SMSSend($to, $message, TRUE);
        // UPDATE SMS COUNTER
        $this->common->smsCountUpdate('1');
    }

    function search() {
        $data['sellers'] = $this->oseller->search();
        $this->load->view('admin/header');
        $this->load->view('admin/seller/seller_mst', $data);
        $this->load->view('admin/footer');
    }

    function resetNewSellerNotify() {
        $this->oseller->resetNewSellerNotify();
        return 1;
    }

    function activeSeller() {
        $result = $this->oseller->activeSeller();
        header('location:' . site_url() . 'admin/seller?msg=A');
    }

    function suspendSeller() {
        $result = $this->oseller->suspendSeller();
        header('location:' . site_url() . 'admin/seller?msg=S');
    }

    function fullSuspendSeller() {
        $result = $this->oseller->fullSuspendSeller();
        header('location:' . site_url() . 'admin/seller?msg=FS');
    }

    function checkPincode() {
        $pincode = $this->input->post('pincode');
        $result = $this->common->checkPincodeAll($pincode);
        echo $result;
    }

    function seller_login() {
        $primary_email = base64_decode($this->input->get('id'));
        $seller_data = $this->common->getSellerData($primary_email);
        $session = array(
            'seller_username' => $seller_data->first_name . ' ' . $seller_data->last_name,
            'seller_primary_email' => $seller_data->primary_email,
            'seller_id' => $seller_data->seller_id,
            'seller_role' => '1'
        );
        $this->session->set_userdata($session);
        header('location:' . site_url() . 'seller/dashboard');
    }

}
