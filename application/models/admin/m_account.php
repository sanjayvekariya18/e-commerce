<?php

class M_account extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAllSellers() {
        $this->db->select('seller_id,first_name,last_name,business_name,primary_email,primary_mobile,pickup_city,group_name,status');
        $this->db->from('seller_mst as s');
        $this->db->join('sellergroup_mst as sg', 's.group_id = sg.group_id');
        $this->db->join('login_mst as l', 's.primary_email = l.email');
        $query = $this->db->get();
        return $query->result();
    }

    function getAllEmployees() {
        $this->db->select('employee_id,first_name,last_name');
        $query = $this->db->get_where('employee_mst', array('department_id <>' => '1'));
        return $query->result();
    }

    function getAssignEmployee($seller_id) {
        $this->db->select('e.employee_id,e.first_name,e.last_name');
        $this->db->from('employee_mst as e');
        $this->db->join('account_mst as a', 'a.employee_id = e.employee_id');
        $this->db->where('a.seller_id', $seller_id);
        $query = $this->db->get();
        return $query->result();
    }

    function assign() {
        if (isset($_POST) && is_array($_POST)) {
            $data = $_POST;
            foreach ($data['allSeller'] as $val) {
                $insert_data = array(
                    'employee_id' => $data['employee_id'],
                    'seller_id' => $val,
                );
                $result = $this->isRecordExist($insert_data);
                if ($result == 0) {
                    $this->db->insert('account_mst', $insert_data);
                }
            }
            return 1;
        }
    }

    function unassign() {
        if (isset($_POST) && is_array($_POST)) {
            $data = $_POST;
            $where = array(
                'employee_id' => $data['employee_id'],
                'seller_id' => $data['seller_id']
            );
            $this->db->delete('account_mst', $where);
            return 1;
        }
    }

    function isRecordExist($where) {
        $query = $this->db->get_where('account_mst', $where);
        return $query->num_rows();
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
            $this->db->select('seller_id,first_name,last_name,business_name,primary_email,primary_mobile,pickup_city,group_name,status');
            $this->db->from('seller_mst as s');
            $this->db->join('sellergroup_mst as sg', 's.group_id = sg.group_id');
            $this->db->join('login_mst as l', 's.primary_email = l.email');
            $this->db->where($where);
            $query = $this->db->get();
            return $query->result();
        } else {
            $this->db->select('seller_id,first_name,last_name,business_name,primary_email,primary_mobile,pickup_city,group_name,status');
            $this->db->from('seller_mst as s');
            $this->db->join('sellergroup_mst as sg', 's.group_id = sg.group_id');
            $this->db->join('login_mst as l', 's.primary_email = l.email');
            $query = $this->db->get();
            return $query->result();
        }
    }

}
