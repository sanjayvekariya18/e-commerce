<?php

class M_seller extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAllSellers() {
        $this->db->select('seller_id,first_name,last_name,business_name,primary_email,primary_mobile,pickup_city,group_name,status,reg_date');
        $this->db->from('seller_mst as s');
        $this->db->join('sellergroup_mst as sg', 's.group_id = sg.group_id');
        $this->db->join('login_mst as l', 's.primary_email = l.email');
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
        }
        if (isset($where)) {
            $this->db->select('seller_id,first_name,last_name,business_name,primary_email,primary_mobile,pickup_city,group_name,status,reg_date');
            $this->db->from('seller_mst as s');
            $this->db->join('sellergroup_mst as sg', 's.group_id = sg.group_id');
            $this->db->join('login_mst as l', 's.primary_email = l.email');
            $this->db->where($where);
            $query = $this->db->get();
            return $query->result();
        } else {
            $this->db->select('seller_id,first_name,last_name,business_name,primary_email,primary_mobile,pickup_city,group_name,status,reg_date');
            $this->db->from('seller_mst as s');
            $this->db->join('sellergroup_mst as sg', 's.group_id = sg.group_id');
            $this->db->join('login_mst as l', 's.primary_email = l.email');
            $query = $this->db->get();
            return $query->result();
        }
    }

    function resetNewSellerNotify() {
        $this->db->update('signup_notify_mst', array('status' => '1'), array('role' => '1'));
    }

    function activeSeller() {
        if (isset($_POST['allSeller'])) {
            $emails = $_POST['allSeller'];
            $this->db->where_in('email', $emails);
            $this->db->update('login_mst', array('status' => 1));
        }
    }

    function suspendSeller() {
        if (isset($_POST['allSeller'])) {
            $emails = $_POST['allSeller'];
            $this->db->where_in('email', $emails);
            $this->db->update('login_mst', array('status' => 0));
        }
    }

    function fullSuspendSeller() {
        if (isset($_POST['allSeller'])) {
            $emails = $_POST['allSeller'];
            $seller_id = array();
            
            $this->db->select('seller_id');
            $this->db->from('seller_mst');
            $this->db->where_in('primary_email',$emails);
            $query = $this->db->get();
            $data = $query->result();
            foreach($data as $val){
                $seller_id[] = $val->seller_id;
            }
                       
            $this->db->where_in('email', $emails);
            $this->db->update('login_mst', array('status' => 0));
           
            $this->db->where_in('seller_id', $seller_id);
            $this->db->update('product_mst', array('live_status' => 0));
        }
    }

}
