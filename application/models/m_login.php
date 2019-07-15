<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_login extends CI_Model {

    public function __construct() {
        parent::__construct();
    }   
    
    function getLoginInfo($email) {
        $query = $this->db->get_where('login_mst', array('email' => $email));
        return $query->row();
    }   

}
