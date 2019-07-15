<?php

class M_subcategory extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function getAllSubcategoryData(){
        $query = $this->db->get('subcategory_mst');
        return $query->result();
    }
        
    function addSubcategoryData(){
        $data = array(
            'main_category_id' => $this->input->post('main_category_id'),
            'subcategory_name' => $this->input->post('subcategory_name')
        );
        $this->db->insert('subcategory_mst',$data);
        return 1;
    }
    
    function updateSubcategoryData(){
        $data = array(
            'main_category_id' => $this->input->post('main_category_id'),
            'subcategory_name' => $this->input->post('subcategory_name'),
        );
        $this->db->update('subcategory_mst',$data,array('subcategory_id' => $this->input->post('subcategory_id')));
        return 1;
    }
    
    function deleteSubcategoryData(){
        $this->db->delete('subcategory_mst',array('subcategory_id' => base64_decode($this->input->get('id'))));
        return 1;
    }
}
