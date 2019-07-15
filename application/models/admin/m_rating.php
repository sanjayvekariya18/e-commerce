<?php

class M_rating extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAllPurchaseProduct($start, $end) {
        ($start != "") ? $where['DATE(pratedate) >='] = date('Y-m-d', strtotime($start)) : '';
        ($end != "") ? $where['DATE(pratedate) <= '] = date('Y-m-d', strtotime($end)) : '';
        $this->db->select('product_name,prate,pratedate,business_name,order_id,product_id,c.first_name,c.last_name');
        $this->db->from('order_mst as o');
        $this->db->join('seller_mst as s', 'o.seller_id = s.seller_id');
        $this->db->join('customer_mst as c', 'c.customer_id = o.customer_id');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    function getProductRate() {
        $order_id = $this->input->post('order_id');
        $this->db->select('prate,preview');
        $query = $this->db->get_where('order_mst', array('order_id' => $order_id));
        return $query->row();
    }

    function setProductRate() {
        $order_id = $this->input->post('order_id');
        $product_id = $this->input->post('product_id');
        $product_review = array(
            'prate' => $this->input->post('prate'),
            'preview' => $this->input->post('preview'),
            'pratedate' => date('Y-m-d H:i:s')
        );
        $this->db->update('order_mst', $product_review, array('order_id' => $order_id));
        $this->updateMainProductRate($product_id);
        return 1;
    }

    function updateMainProductRate($product_id) {
        $this->db->select('sum(prate) as total , count(*) as count');
        $this->db->from('order_mst');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get()->row();
        if (isset($query->total)) {
            $avr_rate = $query->total / $query->count;
            $this->db->update('product_mst', array('product_rating' => $avr_rate), array('product_id' => $product_id));
        }
    }

}
