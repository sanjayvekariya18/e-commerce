<?php

class M_advertisement extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getPlanPricing() {
        $query = $this->db->get("advertisement_plan");
        return $query->result();
    }

    function getRequest($requestid) {
        $this->db->select('*');
        $this->db->from('advertisement_request as AR');
        $this->db->join('advertisement_plan as AP', 'AR.plan_id = AP.plan_id');
        $query = $this->db->get_where("advertisement_request", array('AR.request_id' => $requestid));
        return $query->row();
    }

    function insertRequest($post) {
        $post['seller_id'] = $this->session->userdata('seller_id');
        $post['from'] = date('Y-m-d', strtotime($post['from']));
        $post['to'] = date('Y-m-d', strtotime($post['to']));
        return ($this->db->insert("advertisement_request", $post)) ? TRUE : FALSE;
    }

    function updateRequest($post) {
        $requestid = $post['requestid'];
        unset($post['requestid']);
        $post['from'] = date('Y-m-d', strtotime($post['from']));
        $post['to'] = date('Y-m-d', strtotime($post['to']));
        return ($this->db->update("advertisement_request", $post, array('request_id' => $requestid))) ? TRUE : FALSE;
    }

    function deleteRequest($requestid) {
        $this->db->delete('advertisement_request', array('request_id' => $requestid));
        return TRUE;
    }

    function getRequests() {
        $this->db->select('request_id,request_date,price,box,category,AR.status,S.business_name,size,from,to');
        $this->db->from('advertisement_request as AR');
        $this->db->join('advertisement_plan as AP', 'AR.plan_id = AP.plan_id');
        $this->db->join('seller_mst as S', 'AR.seller_id = S.seller_id');
//        $this->db->where('AR.status', '0');
        $this->db->where('AR.seller_id', $this->session->userdata('seller_id'));
        $query = $this->db->get();
        return $query->result();
    }

//    function search() {
//        if ($this->input->post() != "") {
//            ($_POST['start'] != "") ? $where['DATE(request_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
//            ($_POST['end'] != "") ? $where['DATE(request_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
//            ($_POST['business_name'] != "") ? $this->db->like('S.business_name', $_POST['business_name']) : '';
//            ($_POST['price'] != "") ? $where['price'] = $_POST['price'] : '';
//            ($_POST['size'] != "" && $_POST['size'] != "-1" ) ? $where['size'] = $_POST['size'] : '';
//            ($_POST['status'] != "" && $_POST['status'] != "-1") ? $where['AR.status'] = $_POST['status'] : '';
//        }
//        if (isset($where)) {
//            $this->db->select('request_id,request_date,price,box,category,AR.status,S.business_name,size,from,to');
//            $this->db->from('advertisement_request as AR');
//            $this->db->join('advertisement_plan as AP', 'AR.plan_id = AP.plan_id');
//            $this->db->join('seller_mst as S', 'AR.seller_id = S.seller_id');
//            $this->db->where($where);
//            $query = $this->db->get();
//            return $query->result();
//        } else {
//            $this->db->select('request_id,request_date,price,box,category,AR.status,S.business_name,size,from,to');
//            $this->db->from('advertisement_request as AR');
//            $this->db->join('advertisement_plan as AP', 'AR.plan_id = AP.plan_id');
//            $this->db->join('seller_mst as S', 'AR.seller_id = S.seller_id');
//            $query = $this->db->get();
//            return $query->result();
//        }
//    }
}
