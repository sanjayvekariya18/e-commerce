<?php

class M_chart extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->seller_id = $this->session->userdata('seller_id');
    }

    function getCounts($month) {

        $where = array(
            'seller_id' => $this->seller_id,
            'DATE_FORMAT(order_date,"%Y-%m")' => $month
        );

        $this->db->select('count(*) total ,
                            sum(case WHEN order_status = 6 THEN 1 ELSE 0 END) tcancel ,
                            sum(case WHEN order_status = 5 OR order_status = 8 THEN 1 ELSE 0 END) treturn ,
                            sum(case WHEN order_status = 4 THEN qty ELSE 0 END) tqty', false);
        $query = $this->db->get_where('order_mst', $where);
        return $query->row();
    }

    function getRevenue($month) {
        $where = array(
            'p.seller_id' => $this->seller_id,
            'DATE_FORMAT(order_date,"%Y-%m")' => $month
        );
        $this->db->select('sum(credit) as credit,sum(debit) as debit');
        $this->db->from('payable_mst as p');
        $this->db->join('order_mst as o','p.order_id = o.order_id');
        $this->db->where($where);
        $result = $this->db->get()->row();
        return round($result->credit - $result->debit);
    }

    function getCancelOrder($month) {
        $where = array(
            'seller_id' => $this->seller_id,
            'order_status' => '6',
            'DATE_FORMAT(order_date,"%Y-%m")' => $month
        );
        $this->db->select('DAY(order_date) day , count(*) total');
        $this->db->from('order_mst');
        $this->db->where($where);
        $this->db->group_by('day');
        $query = $this->db->get();
        return $query->result();
    }

    function getReturnOrder($month) {
        $where = array(
            'seller_id' => $this->seller_id,
            'DATE_FORMAT(order_date,"%Y-%m")' => $month
        );
        $this->db->select('DAY(order_date) day , count(*) total');
        $this->db->from('order_mst');
        $this->db->where($where);
        $this->db->where_in('order_status', array('5', '8'));
        $this->db->group_by('day');
        $query = $this->db->get();
        return $query->result();
    }

    function getSalesOty($month) {
        $where = array(
            'seller_id' => $this->seller_id,
            'DATE_FORMAT(order_date,"%Y-%m")' => $month
        );
        $this->db->select('DAY(order_date) day , sum(qty) total');
        $this->db->from('order_mst');
        $this->db->where($where);
        $this->db->where('order_status', 4);
        $this->db->group_by('day');
        $query = $this->db->get();
        return $query->result();
    }

}
