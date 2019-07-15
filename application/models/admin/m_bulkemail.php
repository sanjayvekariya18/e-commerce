<?php

class M_bulkemail extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAllSellerEmailId() {
        $this->db->select('primary_email');
        $query = $this->db->get('seller_mst');
        $data = $query->result();
        $email_id = array();
        foreach ($data as $val) {
            $email_id[] = $val->primary_email;
        }
        return implode(",", $email_id);
    }

    function getAllCustomerEmailId() {
        $this->db->select('primary_email');
        $query = $this->db->get('customer_mst');
        $data = $query->result();
        $email_id = array();
        foreach ($data as $val) {
            $email_id[] = $val->primary_email;
        }
        return implode(",", $email_id);
    }
    
    function getAllEmployeeEmailId() {
        $this->db->select('email');
        $this->db->from('employee_mst');
        $this->db->where('department_id <>','1');
        $query = $this->db->get();
        $data = $query->result();
        $email_id = array();
        foreach ($data as $val) {
            $email_id[] = $val->personal_phone;
        }
        return implode(",", $email_id);
    }

}
