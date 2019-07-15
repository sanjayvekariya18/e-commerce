<?php

class M_indiapost_details extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function getAllTrackingIdData(){
        $query = $this->db->get('indiapost_details_mst');
        return $query->result();
    }
        
    function addTrackingData(){
        $data = array(
            'tracking_id' => $this->input->post('tracking_id'),
            'status' => 0
        );
        $this->db->insert('indiapost_details_mst',$data);
        return 1;
    }
    
    function updateTrackingData(){
        $data = array(
            'tracking_id' => $this->input->post('tracking_id')
        );
        $this->db->update('indiapost_details_mst',$data,array('id' => $this->input->post('id')));
        return 1;
    }
    
    function deleteTrackingData(){
        $this->db->delete('indiapost_details_mst',array('id' => base64_decode($this->input->get('id'))));
        return 1;
    }    
    
}
