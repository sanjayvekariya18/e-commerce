<?php

class M_signup extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('parser');
    }

    function addSignupData() {
        $seller_id = $this->getMaxSellerId();
        $post = $this->input->post();
        $login_data = array(
            'email' => $post['email'],
            'password' => $this->common->fullEncode($post['pwd']),
            'role' => '1',
        );

        $seller_data = array(
            'seller_id' => $seller_id,
            'first_name' => $post['first_name'],
            'last_name' => $post['last_name'],
            'primary_email' => $post['email'],
            'primary_mobile' => $post['primary_mobile'],
            'mobile_status' => 1
        );

        $signup_notify = array(
            'user_id' => $seller_id,
            'first_name' => $post['first_name'],
            'last_name' => $post['last_name'],
            'primary_email' => $post['email'],
            'role' => '1',
            'notify_date' => date('Y-m-d H:i:s')
        );
        $this->db->insert('login_mst', $login_data);
        $this->db->insert('seller_mst', $seller_data);
        $this->db->insert('signup_notify_mst', $signup_notify);
        $this->createDirectory($seller_id);

        $this->sendEmail($post);
        $this->sendSignupSMSToSeller($post);
        return 1;
    }

    function sendEmail($post) {

        $templateInfo = $this->common->getMailTemplate("WELCOME E-MAIL", "Seller");
        $url = site_url() . 'seller/signup/verifyEmail?id=' . base64_encode($post['email']);
        $link = "<table border='0' align='center' cellpadding='0' cellspacing='0' class='mainBtn' style='margin-top: 0;margin-left: auto;margin-right: auto;margin-bottom: 0;padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border-collapse: collapse;border-spacing: 0;'>";
        $link .= "<tr>";
        $link .= "<td align='center' valign='middle' class='btnMain' style='margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 0;padding-top: 12px;padding-bottom: 12px;padding-left: 22px;padding-right: 22px;border-collapse: collapse;border-spacing: 0;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;background-color: {$templateInfo->color};height: 20px;font-size: 18px;line-height: 20px;mso-line-height-rule: exactly;text-align: center;vertical-align: middle;'>
                                            <a href='{$url}' style='padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;display: inline-block;text-decoration: none;-webkit-text-size-adjust: none;font-family: Arial, Helvetica, sans-serif;color: #ffffff;font-weight: bold;'>
                                                <span style='text-decoration: none;color: #ffffff;'>
                                                    Activate Your Account
                                                </span>
                                            </a>
                                        </td>";
        $link .= "</tr></table>";

        $tag = array(
            'FIRST_NAME' => $post['first_name'],
            'LAST_NAME' => $post['last_name'],
            'LINK' => $link
        );
        $subject = $this->parser->parse_string($templateInfo->mail_subject, $tag, TRUE);
        $from = ($templateInfo->from != "") ? $templateInfo->from : NULL;
        $name = ($templateInfo->name != "") ? $templateInfo->name : NULL;
        $to = $post['email'];
        $this->load->view('email_format', $templateInfo, TRUE);
        $body = $this->parser->parse('email_format', $tag, TRUE);

        $this->common->sendEmail($from, $to, $subject, $body, $name);
      
    }

    function sendSignupSMSToSeller($data) {
        $templateInfo = $this->common->getSmsTemplate("WELCOME SMS", "Seller");
        $tag = array(
            'FIRST_NAME' => $data['first_name'],
            'LAST_NAME' => $data['last_name'],
            'USER_ID' => $data['email'],
            'PASSWORD' => $data['pwd']
        );
        $message = $this->parser->parse_string($templateInfo->message, $tag, TRUE);
        $to = $data['primary_mobile'];
        $this->common->SMSSend($to, $message, true);
    }

    function getMaxSellerId() {
        $this->db->select('max(seller_id) as seller_id');
        $this->db->from('seller_mst');
        $query = $this->db->get();
        $data = $query->row();

        if ($data->seller_id == "") {
            $this->db->select('seller_id');
            $this->db->from('general_id_mst');
            $query = $this->db->get();
            $data = $query->row();
        }
        return $data->seller_id + 1;
    }

    function verifyEmail() {
        $mailid = base64_decode($this->input->get('id'));
        $this->confirmEmail($mailid);
        $seller_data = $this->common->getSellerData($mailid);
        $session = array(
            'seller_username' => $seller_data->first_name . ' ' . $seller_data->last_name,
            'seller_primary_email' => $seller_data->primary_email,
            'seller_id' => $seller_data->seller_id
        );
        $this->session->set_userdata($session);
        return 1;
    }

    function confirmEmail($mailid) {
        $this->db->update('seller_mst', array('email_status' => '1'), array('primary_email' => $mailid));
        return 1;
    }
    
    function mobile_valid($primary_mobile) {
        $query = $this->db->get_where('seller_mst', array('primary_mobile' => $primary_mobile));
        return $query->num_rows();
    }

    function createDirectory($seller_id) {
        $path = FCPATH . "/upload/" . $seller_id;
        (!is_dir($path)) ? mkdir($path, 0755) : '';

        $pathproduct = FCPATH . "/upload/" . $seller_id . "/product";
        (!is_dir($pathproduct)) ? mkdir($pathproduct, 0755) : '';

        $pathproof = FCPATH . "/upload/" . $seller_id . "/proof";
        (!is_dir($pathproof)) ? mkdir($pathproof, 0755) : '';
        
        $pathgallery = FCPATH . "/upload/" . $seller_id . "/gallery";
        (!is_dir($pathgallery)) ? mkdir($pathgallery, 0755) : '';
        return 1;
    }

}
