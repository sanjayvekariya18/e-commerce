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
class M_pages extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getPages() {
        $this->db->order_by('title', 'asc');
        $query = $this->db->get('pages');
        return $query->result();
    }

    function getContent($pageid) {
        $query = $this->db->get_where('pages', array('page_id' => $pageid));
        if ($query->num_rows()) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    function update($post) {
        $this->db->update('pages', array('content' => $post['content']), array('page_id' => $post['pageid']));
    }
    
    // ----------------------------seller home page ------------------------------

    function getSellerHomeBlock1() {
        $query = $this->db->get_where('seller_homepage_mst', array('block' => '1'));
        return $query->row();
    }

    function updateSellerHomeBlock1() {        
        $this->background_image_upload();
        $this->front_image_upload();
        
        $content = $this->input->post('content');
        $this->db->update('seller_homepage_mst',array('content'=>$content),array('block'=>'1'));
        return 1;
    }
    
    function background_image_upload(){
        $path = FCPATH . '/sellerassets/images/';
        $config['upload_path'] = $path;
        $config['allowed_types'] = '*';
        $config['file_name'] = 'background.jpg';
        $config['overwrite'] = 'TRUE';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($_FILES['background']['error'] != 4) {

            if (!$this->upload->do_upload('background')) {
                $this->upload->display_errors();
            }
        }
    }
    
    function front_image_upload(){
        $path = FCPATH . '/sellerassets/images/';
        $config['upload_path'] = $path;
        $config['allowed_types'] = '*';
        $config['file_name'] = 'front.png';
        $config['overwrite'] = 'TRUE';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($_FILES['front']['error'] != 4) {

            if (!$this->upload->do_upload('front')) {
                $this->upload->display_errors();
            }
        }
    }

}
