<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Track extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        try {
            $client = new SoapClient("http://instacom.dotzot.in/services/Cust_WS_Ver2.asmx?WSDL");
            $params['userName'] = 'instauser';
            $params['password'] = 'insta2013';
            $params['clientId'] = 'INSTACOM';
            $params['DOCNO'] = 'I30005982276';
            $result = $client->ConsignmentTrackEvents_Details_New($params);

            print_r($result);
        } catch (SoapFault $exception) {
            
        }
    }

}
