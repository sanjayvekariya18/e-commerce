<?php

class M_dashboard extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getTotalSeller() {
        $this->db->select('count(id) as total');
        $query = $this->db->get_where('login_mst', array('role' => '1'));
        return $query->row()->total;
    }

    function getTotalEmployee() {
        $this->db->select('count(id) as total');
        $query = $this->db->get_where('login_mst', array('role' => '2'));
        return $query->row()->total;
    }

    function getTotalCustomer() {
        $this->db->select('count(id) as total');
        $query = $this->db->get_where('login_mst', array('role' => '3'));
        return $query->row()->total;
    }

    function getTotalLiveProducts() {
        $this->db->select('count(product_id) as total');
        $query = $this->db->get_where('product_mst', array('live_status' => '1'));
        return $query->row()->total;
    }

    function getTopSeller() {
        $this->db->select('business_name,primary_mobile,pickup_city,sum(total_price) as total');
        $this->db->from('seller_mst as s');
        $this->db->join('order_mst as o', 'o.seller_id = s.seller_id');
        $this->db->group_by('s.seller_id');
        $this->db->order_by('total', 'desc');
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result();
    }
    
    function getTopProducts() {
        $this->db->select('product_id,product_name,sum(total_price) as total');
        $this->db->from('order_mst');
        $this->db->group_by('product_id');
        $this->db->order_by('total', 'desc');
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result();
    }

}
