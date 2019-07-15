<?php

class M_bank_details extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function getAllBankData(){
        $query = $this->db->get('bank_details_mst');
        return $query->result();
    }
        
    function addBankData(){
        $data = array(
            'bank_name' => $this->input->post('bank_name'),
        );
        $this->db->insert('bank_details_mst',$data);
        return 1;
    }
    
    function updateBankData(){
        $data = array(
            'bank_name' => $this->input->post('bank_name'),
        );
        $this->db->update('bank_details_mst',$data,array('id' => $this->input->post('bank_id')));
        return 1;
    }
    
    function deleteBankData(){
        $this->db->delete('bank_details_mst',array('id' => base64_decode($this->input->get('id'))));
        return 1;
    }
    
    
}
