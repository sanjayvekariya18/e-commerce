<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SiteSetting extends CI_Controller {

    function __construct() {
        parent::__construct();        
    }

    function siteStart(){
        $this->common->siteStart();
        header('location:' . site_url() . 'admin');
    }
    
     function siteStop(){
        $this->common->siteStop();
        header('location:' . site_url() . 'admin');
    }

}
