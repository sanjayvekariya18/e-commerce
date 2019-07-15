<?php

class M_profile extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function getCustomerData($primary_email){
        $query = $this->db->get_where('customer_mst',array('primary_email'=>$primary_email));
        return $query->row();
    }

    function updateCustomerData($data,$primary_email) {
        $customer = array(
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'pincode' => $data['pincode'],
            'landmark' => $data['landmark'],
            'primary_mobile' => $data['primary_mobile'],
            'gender' => $data['gender'],
            'bank_name' => $data['bank_name'],
            'ifsc' => $data['ifsc'],
            'account_no' => $data['account_no'],
            'account_name' => $data['account_name']
        );
        $this->db->update('customer_mst', $customer,array('primary_email'=>$primary_email));         
    }  

}
