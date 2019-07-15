<?php

class M_dtdc_details extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function getAllTrackingIdData(){
        $query = $this->db->get('dtdc_details_mst');
        return $query->result();
    }
        
    function addTrackingData(){
        $data = array(
            'tracking_id' => $this->input->post('tracking_id'),
            'status' => 0
        );
        $this->db->insert('dtdc_details_mst',$data);
        return 1;
    }
    
    function updateTrackingData(){
        $data = array(
            'tracking_id' => $this->input->post('tracking_id')
        );
        $this->db->update('dtdc_details_mst',$data,array('id' => $this->input->post('id')));
        return 1;
    }
    
    function deleteTrackingData(){
        $this->db->delete('dtdc_details_mst',array('id' => base64_decode($this->input->get('id'))));
        return 1;
    }    
    
}
