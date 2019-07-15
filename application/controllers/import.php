<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Import extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_import','import');
    }

    function index() {
        $this->load->view('import');
    }

    function importData(){
        $this->import->importData();
    }
}
