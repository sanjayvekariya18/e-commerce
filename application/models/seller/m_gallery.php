<?php

class M_gallery extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getGalleryData() {
        $seller_id = $this->session->userdata('seller_id');
        $this->db->from('image_gallery');
        $this->db->order_by('upload_date','desc');
        $this->db->where('seller_id', $seller_id);
        $this->db->where('DATE(upload_date)', date('Y-m-d'));
        $query = $this->db->get();
        return $query->result();
    }
    
    function search(){     
        ($_POST['start'] != "-1") ? $where['DATE(upload_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
        ($_POST['end'] != "-1") ? $where['DATE(upload_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        
        $seller_id = $this->session->userdata('seller_id');
        $this->db->from('image_gallery');
        $this->db->order_by('upload_date','desc');
        $this->db->where('seller_id', $seller_id);
        isset($where)?$this->db->where($where):$this->db->where('DATE(upload_date)', date('Y-m-d'));
        $query = $this->db->get();
        return $query->result();   
    }

    function upload() {
        if ($_FILES['image']['error'] != 4) {

            $seller_id = $this->session->userdata('seller_id');
            $filename = $_FILES['image']['name'];

            $pathMain = FCPATH . "/upload/" . $seller_id . "/gallery/";            

            $result = $this->common->do_upload('image', $pathMain, $filename);
            if ($result != "") {
                $imagename = $result['upload_data']['file_name'];
                $sourcepath = base_url() . "upload/" . $seller_id . "/gallery/" . $imagename;

                $data = array(
                    'seller_id' => $seller_id,
                    'image_name' => $imagename,
                    'image_url' => $sourcepath,
                    'upload_date' => date('Y-m-d H:i:s')
                );

                $this->db->insert('image_gallery', $data);
            }
            return 1;
        }
    }

}
