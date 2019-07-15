<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_admin_login
 *
 * @author Laxmisoft
 */
class M_sms_notification extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAllAutoSms() {
        $query = $this->db->get_where('autosms_template');
        return $query->result();
    }

    function getAutoSms($smsid) {
        $query = $this->db->get_where('autosms_template', array('sms_id' => $smsid));
        return ($query->num_rows() == 1) ? $query->row() : FALSE;
    }

    function update($set) {
        $smsid = $set['smsid'];
        unset($set['smsid']);        
        $this->db->update('autosms_template', $set, array('sms_id' => $smsid));
        return TRUE;
    }

}
