<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_import extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('csvimport');
    }

    function importData() {
        if ($_FILES['csvfile']['error'] != 4) {
            $pathMain = FCPATH . "/upload/csv/";

            $filename = $_FILES['csvfile']['name'];
            $result = $this->common->do_upload('csvfile', $pathMain, $filename);
            $file_path = $result['upload_data']['full_path'];

            $rows = array();

            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {

                    $set = array(
                        'pincode' => (isset($row['pincode'])) ? $row['pincode'] : "",
                        'city' => (isset($row['city'])) ? $row['city'] : "",
                        'state' => (isset($row['state'])) ? $row['state'] : "",
                        'region' => (isset($row['region'])) ? $row['region'] : "",
                    );
                    $rows[] = $set;
                }
                $this->db->insert_batch('dotzot_pincode_mst', $rows);
                unlink($file_path);
                header('location:' . site_url() . 'import?msg=S');
            } else {
                header('location:' . site_url() . 'import?msg=F');
            }
        }
    }

}
