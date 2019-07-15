<?php

class M_special_discount extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAllDiscount() {
        $query = $this->db->get('special_discount_mst');
        return $query->result();
    }

    function updateDiscount() {
        foreach ($_POST['discount'] as $key => $val) {
            $this->db->update('special_discount_mst', array('discount' => $val), array('id' => $key + 1));
        }
        return 1;
    }

}
