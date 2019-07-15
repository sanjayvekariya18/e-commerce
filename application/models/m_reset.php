<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_reset extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('parser');
    }

    function admin_exist($email_id) {
        $query = $this->db->get_where('login_mst', array('email' => $email_id, 'role' => '0', 'status' => '1'));
        $record = $query->num_rows();
        if ($record == 1) {
            return 1;
        } else {
            return 0;
        }
    }

    function employee_exist($email_id) {
        $query = $this->db->get_where('login_mst', array('email' => $email_id, 'role' => '2', 'status' => '1'));
        $record = $query->num_rows();
        if ($record == 1) {
            return 1;
        } else {
            return 0;
        }
    }

    function seller_exist($email_id) {
        $query = $this->db->get_where('login_mst', array('email' => $email_id, 'role' => '1', 'status' => '1'));
        $record = $query->num_rows();
        if ($record == 1) {
            return 1;
        } else {
            return 0;
        }
    }

    function customer_exist($email_id) {
        $query = $this->db->get_where('login_mst', array('email' => $email_id, 'role' => '3', 'status' => '1'));
        $record = $query->num_rows();
        if ($record == 1) {
            return 1;
        } else {
            return 0;
        }
    }

    function reset_password($email_id, $role) {
        $newpassword = random_string('alnum', 8);
        switch ($role) {
            case 0 :
                $templateInfo = $this->common->getMailTemplate("FORGOT PASSWORD", "Employee");
                $smstemplateInfo = $this->common->getSmsTemplate("FORGOT PASSWORD", "Employee");
                $employeeInfo = $this->common->getEmployeeData($email_id);
                $mobile_no = $employeeInfo->personal_phone;
                $tag = array(
                    'FIRST_NAME' => $employeeInfo->first_name,
                    'LAST_NAME' => $employeeInfo->last_name,
                    'USER_ID' => $email_id,
                    'PASSWORD' => $newpassword
                );
                break;
            case 1 :
                $templateInfo = $this->common->getMailTemplate("FORGOT PASSWORD", "Seller");
                $smstemplateInfo = $this->common->getSmsTemplate("FORGOT PASSWORD", "Seller");
                $sellerInfo = $this->common->getSellerData($email_id);
                $mobile_no = $sellerInfo->primary_mobile;
                $tag = array(
                    'BUSINESS_NAME' => $sellerInfo->business_name,
                    'USER_ID' => $email_id,
                    'PASSWORD' => $newpassword
                );                
                break;
            case 2 :
                $templateInfo = $this->common->getMailTemplate("FORGOT PASSWORD", "Employee");
                $smstemplateInfo = $this->common->getSmsTemplate("FORGOT PASSWORD", "Employee");
                $employeeInfo = $this->common->getEmployeeData($email_id);
                $mobile_no = $employeeInfo->personal_phone;
                $tag = array(
                    'FIRST_NAME' => $employeeInfo->first_name,
                    'LAST_NAME' => $employeeInfo->last_name,
                    'USER_ID' => $email_id,
                    'PASSWORD' => $newpassword
                );
                break;
            case 3 :
                $templateInfo = $this->common->getMailTemplate("FORGOT PASSWORD", "Buyer");
                $smstemplateInfo = $this->common->getSmsTemplate("FORGOT PASSWORD", "Buyer");
                $customerInfo = $this->common->getCustomerData($email_id);
                $mobile_no = $customerInfo->primary_mobile;
                $tag = array(
                    'FIRST_NAME' => $customerInfo->first_name,
                    'LAST_NAME' => $customerInfo->last_name,
                    'USER_ID' => $email_id,
                    'PASSWORD' => $newpassword
                );
                break;
        }

        // FORGOT EMAIL CODE
        $subject = $this->parser->parse_string($templateInfo->mail_subject, $tag, TRUE);
        $from = ($templateInfo->from != "") ? $templateInfo->from : NULL;
        $name = ($templateInfo->name != "") ? $templateInfo->name : NULL;
        $to = $email_id;
        $this->load->view('email_format', $templateInfo, TRUE);
        $body = $this->parser->parse('email_format', $tag, TRUE);
        $this->common->sendEmail($from, $to, $subject, $body, $name);

        // FORGOT SMS CODE
        $message = $this->parser->parse_string($smstemplateInfo->message, $tag, TRUE);
        $to_mobile = $mobile_no;
        $responce = $this->common->SMSSend($to_mobile, $message, true);        
        $Password = $this->common->fullEncode($newpassword);
        $this->db->update('login_mst', array('password' => $Password), array('email' => $email_id));
        
        return 1;
    }
    
    

}
