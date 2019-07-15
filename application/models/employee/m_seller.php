<?php

class M_seller extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAllSellers() {
        $this->db->select('s.seller_id,first_name,last_name,business_name,primary_email,primary_mobile,pickup_city,group_name,status');
        $this->db->from('seller_mst as s');
        $this->db->join('sellergroup_mst as sg', 's.group_id = sg.group_id');
        $this->db->join('account_mst as a', 'a.seller_id = s.seller_id');
        $this->db->join('login_mst as l', 's.primary_email = l.email');
        $this->db->where('a.employee_id', $this->session->userdata('employee_id'));
        $query = $this->db->get();
        return $query->result();
    }

    function search() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(reg_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(reg_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
            ($_POST['first_name'] != "") ? $where['first_name'] = $_POST['first_name'] : '';
            ($_POST['last_name'] != "") ? $where['last_name'] = $_POST['last_name'] : '';
            ($_POST['primary_mobile'] != "") ? $where['primary_mobile'] = $_POST['primary_mobile'] : '';
            ($_POST['primary_email'] != "") ? $where['primary_email'] = $_POST['primary_email'] : '';
            ($_POST['pickup_city'] != "") ? $where['pickup_city'] = $_POST['pickup_city'] : '';
            ($_POST['status'] != "-1") ? $where['status'] = $_POST['status'] : '';
            ($_POST['gender'] != "-1") ? $where['gender'] = $_POST['gender'] : '';
        }
        if (isset($where)) {
            $this->db->select('s.seller_id,first_name,last_name,business_name,primary_email,primary_mobile,pickup_city,group_name,status');
            $this->db->from('seller_mst as s');
            $this->db->join('sellergroup_mst as sg', 's.group_id = sg.group_id');
            $this->db->join('account_mst as a', 'a.seller_id = s.seller_id');
            $this->db->join('login_mst as l', 's.primary_email = l.email');
            $this->db->where('a.employee_id', $this->session->userdata('employee_id'));
            $this->db->where($where);
            $query = $this->db->get();
            return $query->result();
        } else {
            $this->db->select('s.seller_id,first_name,last_name,business_name,primary_email,primary_mobile,pickup_city,group_name,status');
            $this->db->from('seller_mst as s');
            $this->db->join('sellergroup_mst as sg', 's.group_id = sg.group_id');
            $this->db->join('account_mst as a', 'a.seller_id = s.seller_id');
            $this->db->join('login_mst as l', 's.primary_email = l.email');
            $this->db->where('a.employee_id', $this->session->userdata('employee_id'));
            $query = $this->db->get();
            return $query->result();
        }
    }

}
