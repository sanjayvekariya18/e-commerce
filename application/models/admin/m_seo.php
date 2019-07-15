<?php

class M_seo extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getMetadata() {
        $query = $this->db->get('admin_seo');
        return $query->result();
    }

    function addMetadata($post) {
        $this->db->insert('admin_seo', $post);
        return $this->db->insert_id();
    }

    function updateMetadata($post) {
        $where['seo_id'] = $post['seoid'];
        unset($post['seoid']);
        return ($this->db->update('admin_seo', $post, $where)) ? TRUE : FALSE;
    }

    function deleteMetadata($id) {
        return ($this->db->delete('admin_seo', array('seo_id' => $id))) ? TRUE : FALSE;
    }

}
