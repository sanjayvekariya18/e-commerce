<?php

class M_bulksms extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAllSellerMobile() {
        $this->db->select('primary_mobile');
        $query = $this->db->get('seller_mst');
        $data = $query->result();
        $mobile = array();
        foreach ($data as $val) {
            $mobile[] = $val->primary_mobile;
        }
        return implode(",", $mobile);
    }

    function getAllCustomerMobile() {
        $this->db->select('primary_mobile');
        $query = $this->db->get('customer_mst');
        $data = $query->result();
        $mobile = array();
        foreach ($data as $val) {
            $mobile[] = $val->primary_mobile;
        }
        return implode(",", $mobile);
    }
    
    function getAllEmployeeMobile() {
        $this->db->select('personal_phone');
        $this->db->from('employee_mst');
        $this->db->where('department_id <>','1');
        $query = $this->db->get();
        $data = $query->result();
        $mobile = array();
        foreach ($data as $val) {
            $mobile[] = $val->personal_phone;
        }
        return implode(",", $mobile);
    }

}
