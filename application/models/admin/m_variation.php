<?php

class M_variation extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAllVariationData() {
        $query = $this->db->get('variation_mst');
        return $query->result();
    }
    
    function getSearchVariationData() {
        $query = $this->db->get_where('variation_mst',array('variation_type'=>$this->input->post('variation_types')));
        return $query->result();
    }

    function addVariationData() {
        $data = array(
            'variation_type' => $this->input->post('variation_type'),
            'variation_name' => $this->input->post('variation_name'),
            'variation_code' => $this->input->post('variation_code')
        );
        $this->db->insert('variation_mst', $data);
        return 1;
    }

    function updateVariationData() {
        $data = array(
            'variation_type' => $this->input->post('variation_type'),
            'variation_name' => $this->input->post('variation_name'),
            'variation_code' => $this->input->post('variation_code')
        );
        $this->db->update('variation_mst', $data, array('variation_id' => $this->input->post('variation_id')));
        return 1;
    }

    function deleteVariationData() {
        $this->db->delete('variation_mst', array('variation_id' => base64_decode($this->input->get('id'))));
        return 1;
    }

}
