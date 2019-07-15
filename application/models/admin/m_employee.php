<?php

class M_employee extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->pathMain = FCPATH . "/upload/employee/proof/";
    }

    function getAllEmployeeData() {
        $this->db->select('employee_id,first_name,middle_name,last_name,personal_phone,e.email,city,status');
        $this->db->from('employee_mst as e');
        $this->db->join('login_mst as l','l.email = e.email');
        $this->db->where('e.department_id <>', '1');
        $query = $this->db->get();
        return $query->result();
    }

    function getSearchEmployeeData() {
        if ($this->input->post() != "") {            
            ($_POST['start'] != "") ? $where['DATE(reg_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(reg_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
            ($_POST['first_name'] != "") ? $where['first_name'] = $_POST['first_name'] : '';
            ($_POST['last_name'] != "") ? $where['last_name'] = $_POST['last_name'] : '';
            ($_POST['personal_phone'] != "") ? $where['personal_phone'] = $_POST['personal_phone'] : '';
            ($_POST['email'] != "") ? $where['email'] = $_POST['email'] : '';
            ($_POST['department_id'] != "-1") ? $where['department_id'] = $_POST['department_id'] : $where['department_id <>'] = '1';
        }
        
        $this->db->select('employee_id,first_name,middle_name,last_name,personal_phone,e.email,city,status');
        $this->db->from('employee_mst as e');
        $this->db->join('login_mst as l','l.email = e.email');
        $this->db->where('e.department_id <>', '1');
        $this->db->where($where);
        $query = $this->db->get();       
        return $query->result();
    }

    function getEmployeeData() {
        $employee_id = base64_decode($this->input->get('id'));
        $query = $this->db->get_where('employee_mst', array('employee_id' => $employee_id));
        return $query->row();
    }

    function addEmployeeData() {

        $data = array(
            'first_name' => $this->input->post('first_name'),
            'middle_name' => $this->input->post('middle_name'),
            'last_name' => $this->input->post('last_name'),
            'gender' => $this->input->post('gender'),
            'dob' => date('Y-m-d', strtotime($this->input->post('dob'))),
            'address' => $this->input->post('address'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'pincode' => $this->input->post('pincode'),
            'personal_phone' => $this->input->post('personal_phone'),
            'home_phone' => $this->input->post('home_phone'),
            'email' => $this->input->post('email'),
            'department_id' => $this->input->post('department_id'),
        );

        $logindata = array(
            'email' => $this->input->post('email'),
            'password' => $this->common->fullEncode($this->input->post('password')),
            'role' => '2',
            'status' => '1'
        );
        $this->db->insert('employee_mst', $data);
        $employee_id = $this->db->insert_id();


        $this->db->insert('login_mst', $logindata);

        if (($_FILES['address_proof']['error'] != '4')) {
            $addressfile = $employee_id . '_address.jpg';
            $this->common->do_upload('address_proof', $this->pathMain, $addressfile, TRUE);
            $data = array(
                'address_proof' => base_url() . "upload/employee/proof/" . $addressfile,
            );
            $this->db->update('employee_mst', $data, array('employee_id' => $employee_id));
        }

        if (($_FILES['id_proof']['error'] != '4')) {
            $idfile = $employee_id . '_id.jpg';
            $this->common->do_upload('id_proof', $this->pathMain, $idfile, TRUE);
            $data = array(
                'id_proof' => base_url() . "upload/employee/proof/" . $idfile,
            );
            $this->db->update('employee_mst', $data, array('employee_id' => $employee_id));
        }
        return 1;
    }

    function updateEmployeeData() {

        $employee_id = $this->input->post('employee_id');
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'middle_name' => $this->input->post('middle_name'),
            'last_name' => $this->input->post('last_name'),
            'gender' => $this->input->post('gender'),
            'dob' => $this->input->post('dob'),
            'address' => $this->input->post('address'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'pincode' => $this->input->post('pincode'),
            'personal_phone' => $this->input->post('personal_phone'),
            'home_phone' => $this->input->post('home_phone'),
            'department_id' => $this->input->post('department_id')
        );
        $this->db->update('employee_mst', $data, array('employee_id' => $employee_id));

        if (($_FILES['address_proof']['error'] != '4')) {
            $addressfile = $employee_id . '_address.jpg';
            $this->common->do_upload('address_proof', $this->pathMain, $addressfile, TRUE);
            $data = array(
                'address_proof' => base_url() . "upload/employee/proof/" . $addressfile,
            );
            $this->db->update('employee_mst', $data, array('employee_id' => $employee_id));
        }

        if (($_FILES['id_proof']['error'] != '4')) {
            $idfile = $employee_id . '_id.jpg';
            $this->common->do_upload('id_proof', $this->pathMain, $idfile, TRUE);
            $data = array(
                'id_proof' => base_url() . "upload/employee/proof/" . $idfile,
            );
            $this->db->update('employee_mst', $data, array('employee_id' => $employee_id));
        }
        return 1;
    }

    function deleteEmployeeData() {

        if ($this->input->post('allEmployee') != "") {
            $employee_ids = implode(",", $this->input->post('allEmployee'));

            $this->db->select('employee_id,address_proof,id_proof');
            $this->db->from('employee_mst');
            $this->db->where_in('employee_id', $employee_ids);
            $data = $this->db->get()->result();

            foreach ($data as $val) {

                $endaddress = end((explode('/', $val->address_proof)));
                $endid = end((explode('/', $val->id_proof)));

                if (file_exists($this->pathMain . $endaddress)) {
                    unlink($this->pathMain . $endaddress);
                }
                if (file_exists($this->pathMain . $endid)) {
                    unlink($this->pathMain . $endid);
                }
                $this->db->delete('employee_mst', array('employee_id' => $val->employee_id));
            }
        }
        return 1;
    }
    
    function activeEmployee() {
        if (isset($_POST['allEmployee'])) {
            $employee_ids = $_POST['allEmployee'];
            
            $emails = array();
            
            $this->db->select('email');
            $this->db->from('employee_mst');
            $this->db->where_in('employee_id',$employee_ids);
            $query = $this->db->get();
            $data = $query->result();
            foreach($data as $val){
                $emails[] = $val->email;
            }
            $this->db->where_in('email', $emails);
            $this->db->update('login_mst', array('status' => 1));
        }
    }

    function suspendEmployee() {
        
        if (isset($_POST['allEmployee'])) {
            $employee_ids = $_POST['allEmployee'];
            
            $emails = array();
            
            $this->db->select('email');
            $this->db->from('employee_mst');
            $this->db->where_in('employee_id',$employee_ids);
            $query = $this->db->get();
            $data = $query->result();
            foreach($data as $val){
                $emails[] = $val->email;
            }
            $this->db->where_in('email', $emails);
            $this->db->update('login_mst', array('status' => 0));
        }
    }

}
