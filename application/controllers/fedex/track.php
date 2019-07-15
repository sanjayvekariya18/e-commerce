<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH . 'application/libraries/fedex/fedex-common.php';

class Track extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $path_to_wsdl = FCPATH . 'application/libraries/fedex/TrackService_v10.wsdl';
        ini_set("soap.wsdl_cache_enabled", "0");

        $client = new SoapClient($path_to_wsdl, array('trace' => 1)); // Refer to http://us3.php.net/manual/en/ref.soap.php for more information

        $request['WebAuthenticationDetail'] = array(
            'ParentCredential' => array(
                'Key' => getProperty('key'),
                'Password' => getProperty('password')
            ),
            'UserCredential' => array(
                'Key' => getProperty('key'),
                'Password' => getProperty('password')
            )
        );

        $request['ClientDetail'] = array(
            'AccountNumber' => getProperty('shipaccount'),
            'MeterNumber' => getProperty('meter')
        );
        $request['TransactionDetail'] = array('CustomerTransactionId' => '*** Track Request using PHP ***');
        $request['Version'] = array(
            'ServiceId' => 'trck',
            'Major' => '10',
            'Intermediate' => '0',
            'Minor' => '0'
        );
        $request['SelectionDetails'] = array(
            'PackageIdentifier' => array(
                'Type' => 'TRACKING_NUMBER_OR_DOORTAG',
                'Value' => '775046275551' // Replace 'XXX' with a valid tracking identifier
            )
        );
        
        try {
            if (setEndpoint('changeEndpoint')) {
                $newLocation = $client->__setLocation(setEndpoint('endpoint'));
            }

            $response = $client->track($request);
            
            echo "<pre>";
            print_r($response);
            die();
            
            if ($response->HighestSeverity != 'FAILURE' && $response->HighestSeverity != 'ERROR') {
                if ($response->HighestSeverity != 'SUCCESS') {
                    echo '<table border="1">';
                    echo '<tr><th>Track Reply</th><th>&nbsp;</th></tr>';
                    trackDetails($response->Notifications, '');
                    echo '</table>';
                } else {
                    if ($response->CompletedTrackDetails->HighestSeverity != 'SUCCESS') {
                        echo '<table border="1">';
                        echo '<tr><th>Shipment Level Tracking Details</th><th>&nbsp;</th></tr>';
                        trackDetails($response->CompletedTrackDetails, '');
                        echo '</table>';
                    } else {
                        echo '<table border="1">';
                        echo '<tr><th>Package Level Tracking Details</th><th>&nbsp;</th></tr>';
                        trackDetails($response->CompletedTrackDetails->TrackDetails, '');
                        echo '</table>';
                    }
                }
                printSuccess($client, $response);
            } else {
                printError($client, $response);
            }

            writeToLog($client);    // Write to log file   
        } catch (SoapFault $exception) {
            printFault($exception, $client);
        }
    }

}
