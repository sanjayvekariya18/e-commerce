<?php

class M_coupon extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAllCoupon() {
        $query = $this->db->get('coupon_mst');
        return $query->result();
    }

    function getSearchCoupon() {
        if ($this->input->post() != "") {
            ($_POST['coupon_code'] != "") ? $where['coupon_code'] = $_POST['coupon_code'] : '';
            ($_POST['value'] != "") ? $where['value'] = $_POST['value'] : '';
            ($_POST['type'] != "-1") ? $where['type'] = $_POST['type'] : '';
        }
        if (isset($where)) {
            $query = $this->db->get_where('coupon_mst', $where);
            return $query->result();
        } else {
            $query = $this->db->get('coupon_mst');
            return $query->result();
        }
    }

    function addCouponData() {
        $data = array(
            'coupon_code' => $this->input->post('coupon_code'),
            'type' => $this->input->post('type'),
            'value' => $this->input->post('coupon_value'),
            'apply_type' => $this->input->post('apply_type'),
            'apply_value' => ($this->input->post('apply_type') == 0) ? $this->input->post('supc') : $this->input->post('sub_category_id'),
        );
        $this->db->insert('coupon_mst', $data);
    }

    function deleteCouponData() {
        if (isset($_POST['allCoupon'])) {
            $coupons_id = $_POST['allCoupon'];
            $this->db->where_in('id', $coupons_id);
            $this->db->delete('coupon_mst');
        }
    }

    function activeCouponData() {
        if (isset($_POST['allCoupon'])) {
            $coupons_id = $_POST['allCoupon'];
            $this->db->where_in('id', $coupons_id);
            $this->db->update('coupon_mst', array('status' => 1));
        }
    }

    function deactiveCouponData() {
        if (isset($_POST['allCoupon'])) {
            $coupons_id = $_POST['allCoupon'];
            $this->db->where_in('id', $coupons_id);
            $this->db->update('coupon_mst', array('status' => 0));
        }
    }

}
