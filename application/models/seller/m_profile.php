<?php

class M_profile extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function updateDisplayInfo() {
        if ($this->session->userdata('seller_primary_email') != "") {
            $data = array(
                'display_name' => $this->input->post('display_name'),
                'brand_name' => $this->input->post('brand_name'),
                'business_desc' => $this->input->post('business_desc'),
            );
            $this->db->update('seller_mst', $data, array('primary_email' => $this->session->userdata('seller_primary_email')));
        }
    }

    function updatePickupInfo() {
        if ($this->session->userdata('seller_primary_email') != "") {
            $data = array(
                'pickup_address' => $this->input->post('pickup_address'),
                'pickup_landmark' => $this->input->post('pickup_landmark'),
                'pickup_pincode' => $this->input->post('pickup_pincode'),
                'pickup_city' => $this->input->post('pickup_city'),
                'pickup_state' => $this->input->post('pickup_state'),
            );
            $this->db->update('seller_mst', $data, array('primary_email' => $this->session->userdata('seller_primary_email')));
        }
    }

    function updatePrimaryInfo() {
        if ($this->session->userdata('seller_primary_email') != "") {
            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'primary_mobile' => $this->input->post('primary_mobile'),
                'mobile_status' => '1'
            );
            $this->db->update('seller_mst', $data, array('primary_email' => $this->session->userdata('seller_primary_email')));
        }
    }

    function updateBusinessInfo() {
        if ($this->session->userdata('seller_primary_email') != "") {
             $pathMain =  FCPATH . "/upload/" . $this->session->userdata('seller_id') . "/proof/";

            $panfile = 'pan.jpg';
            $tinfile = 'tin.jpg';
            $tanfile = 'tan.jpg';
            $this->common->do_upload('pan_doc', $pathMain, $panfile, TRUE);
            $this->common->do_upload('tin_doc', $pathMain, $tinfile, TRUE);
            $this->common->do_upload('tan_doc', $pathMain, $tanfile, TRUE);
            $data = array(
                'business_name' => $this->input->post('business_name'),
                'pan_id' => $this->input->post('pan_id'),
                'tin_id' => $this->input->post('tin_id'),
                'tan_id' => $this->input->post('tan_id'),
                'pan_url' => base_url() . "upload/" . $this->session->userdata('seller_id') . "/proof/" . $panfile,
                'tin_url' => ($_FILES['tin_doc']['error'] != '4') ? base_url() . "upload/" . $this->session->userdata('seller_id') . "/proof/" . $tinfile : null,
                'tan_url' => ($_FILES['tan_doc']['error'] != '4') ? base_url() . "upload/" . $this->session->userdata('seller_id') . "/proof/" . $tanfile : null
            );

            $this->db->update('seller_mst', $data, array('primary_email' => $this->session->userdata('seller_primary_email')));
        }
    }

    function updateBankInfo() {
        if ($this->session->userdata('seller_primary_email') != "") {
            $data = array(
                'account_name' => $this->input->post('account_name'),
                'account_no' => $this->input->post('account_no'),
                'bank_name' => $this->input->post('bank_name'),
                'bank_state' => $this->input->post('bank_state'),
                'bank_city' => $this->input->post('bank_city'),
                'bank_branch' => $this->input->post('bank_branch'),
                'bank_ifsc' => $this->input->post('bank_ifsc')
            );
            $this->db->update('seller_mst', $data, array('primary_email' => $this->session->userdata('seller_primary_email')));
        }
    }

    function updateDocumentInfo() {
        if ($this->session->userdata('seller_primary_email') != "") {
            $pathMain = FCPATH . "/upload/" . $this->session->userdata('seller_id') . "/proof/";
            $addressfile = 'address.jpg';
            $idfile = 'id.jpg';
            $chequefile = 'cheque.jpg';

            $this->common->do_upload('address_doc', $pathMain, $addressfile, TRUE);
            $this->common->do_upload('id_doc', $pathMain, $idfile, TRUE);
            $this->common->do_upload('cheque_doc', $pathMain, $chequefile, TRUE);

            $data = array(
                'address_proof' => base_url() . "upload/" . $this->session->userdata('seller_id') . "/proof/" . $addressfile,
                'id_proof' => base_url() . "upload/" . $this->session->userdata('seller_id') . "/proof/" . $idfile,
                'cheque_proof' => base_url() . "upload/" . $this->session->userdata('seller_id') . "/proof/" . $chequefile
            );
            $this->db->update('seller_mst', $data, array('primary_email' => $this->session->userdata('seller_primary_email')));
        }
    }

}
