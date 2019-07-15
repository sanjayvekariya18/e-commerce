<?php

class M_sellergroup extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAllSellerGroupData() {
        $query = $this->db->get('sellergroup_mst');
        return $query->result();
    }   
    
    function addSellerGroupData() {
        $data = array(
            'group_name' => $this->input->post('group_name'),
            'commission_fee' => $this->input->post('commission_fee'),
            'fixed_fee' => $this->input->post('fixed_fee'),
            'service_fee' => $this->input->post('service_fee'),
            'listing_fee' => $this->input->post('listing_fee'),
            'marketing_fee' => $this->input->post('marketing_fee'),
            'pay_fee' => $this->input->post('pay_fee'),
            'other_fee' => $this->input->post('other_fee')
        );
        $this->db->insert('sellergroup_mst', $data);
        return 1;
    }

    function updateSellerGroupData() {
        $data = array(
            'group_name' => $this->input->post('group_name'),
            'commission_fee' => $this->input->post('commission_fee'),
            'fixed_fee' => $this->input->post('fixed_fee'),
            'service_fee' => $this->input->post('service_fee'),
            'listing_fee' => $this->input->post('listing_fee'),
            'marketing_fee' => $this->input->post('marketing_fee'),
            'pay_fee' => $this->input->post('pay_fee'),
            'other_fee' => $this->input->post('other_fee')
        );
        $this->db->update('sellergroup_mst', $data, array('group_id' => $this->input->post('group_id')));
        return 1;
    }
}
