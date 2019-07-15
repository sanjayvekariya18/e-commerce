<?php

class M_order_failed extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAllFailOrdersData() {
        $this->db->select('order_date,order_id,product_name,qty,selling_price,payment_price,first_name,last_name,primary_mobile');
        $this->db->from('order_mst as o');
        $this->db->join('customer_mst as c', 'o.customer_id = c.customer_id');
        $this->db->where('payment_status', '0');
        $query = $this->db->get();
        return $query->result();
    }

    function orderClear() {
        $this->db->delete('order_mst', array('payment_status' => '0'));
        return 1;
    }

}
