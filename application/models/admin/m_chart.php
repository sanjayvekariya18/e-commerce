<?php

class M_chart extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getChartData() {
        $data = $this->input->post();
        if ($data != "") {
            ($data['start'] != "") ? $where['DATE(order_date) >='] = date('Y-m-d', strtotime($data['start'])) : '';
            ($data['end'] != "") ? $where['DATE(order_date) <= '] = date('Y-m-d', strtotime($data['end'])) : '';
            ($data['seller_id'] != "-1") ? $where['seller_id'] = $data['seller_id'] : '';
        }
        $this->db->select('order_status,count(*) as total');
        $this->db->where_in('order_status', array('4', '5', '6', '7', '8'));
        (isset($where)) ? $this->db->where($where) : '';
        $this->db->group_by('order_status');
        $query = $this->db->get('order_mst');
        return $query->result();
    }

}
