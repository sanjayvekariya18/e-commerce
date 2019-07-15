<?php

class M_dashboard extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getTotalLiveProducts() {
        $where = array(
            'seller_id' => $this->session->userdata('seller_id'),
            'live_status' => '1'
        );
        $this->db->select('count(product_id) as total');
        $query = $this->db->get_where('product_mst', $where);
        return $query->row()->total;
    }

    function getTotalReviewProducts() {
        $where = array(
            'seller_id' => $this->session->userdata('seller_id'),
            'approve_status' => '0',
        );
        $this->db->select('count(product_id) as total');
        $query = $this->db->get_where('product_mst', $where);
        return $query->row()->total;
    }

    function getTotalSales() {
        $where = array(
            'seller_id' => $this->session->userdata('seller_id'),
            'order_status' => '4',
        );
        $this->db->select('count(total_price) as total');
        $query = $this->db->get_where('order_mst', $where);
        return $query->row()->total;
    }

    function getRejectedProducts() {
        $where = array(
            'seller_id' => $this->session->userdata('seller_id'),
            'approve_status' => '2',
        );
        $this->db->select('product_name,reject_reason');
        $query = $this->db->get_where('product_mst', $where);
        return $query->result();
    }
    
    function getTotalRejectedProducts() {
        $where = array(
            'seller_id' => $this->session->userdata('seller_id'),
            'approve_status' => '2',
        );
        $this->db->select('count(*) as total');
        $query = $this->db->get_where('product_mst', $where);
        return $query->row()->total;
    }

}
