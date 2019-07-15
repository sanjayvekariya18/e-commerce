<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH . 'application/libraries/fedex/fedex-common.php';

class Pickup extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        
        $path_to_wsdl = FCPATH . 'application/libraries/fedex/PickupService_v11.wsdl';
        //$Fedexpincode = $this->common->getFedexPincode($order->pickup_pincode);
        $pickup_time = date('c');
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

        $request['TransactionDetail'] = array('CustomerTransactionId' => '*** Create Pickup Request using PHP ***');
        $request['Version'] = array(
            'ServiceId' => 'disp',
            'Major' => 11,
            'Intermediate' => 0,
            'Minor' => 0
        );
        $request['OriginDetail'] = array(
            'PickupLocation' => array(
                'Contact' => array(
                    'PersonName' => "Bhadresh",
                    'CompanyName' => "Laxmisoft",
                    'PhoneNumber' => "7405411349"
                ),
                'Address' => array(
                    'StreetLines' => "Middle Point",
                    'City' => "Surat",
                    'StateOrProvinceCode' => "GJ",
                    'PostalCode' => "395010",
                    'CountryCode' => 'IN')
            ),
            'PackageLocation' => 'FRONT', // valid values NONE, FRONT, REAR and SIDE
            'BuildingPartCode' => 'SUITE', // valid values APARTMENT, BUILDING, DEPARTMENT, SUITE, FLOOR and ROOM
            'BuildingPartDescription' => '3B',
            'ReadyTimestamp' => $pickup_time, // Replace with your ready date time
            'CompanyCloseTime' => '19:00:00'
        );
        $request['PackageCount'] = '1';
        $request['TotalWeight'] = array(
            'Value' => "1",
            'Units' => 'KG' // valid values LB and KG
        );
        $request['CarrierCode'] = 'FDXE'; // valid values FDXE-Express, FDXG-Ground, FDXC-Cargo, FXCC-Custom Critical and FXFR-Freight
        $request['CourierRemarks'] = '';

        try {
            if (setEndpoint('changeEndpoint')) {
                $newLocation = $client->__setLocation(setEndpoint('endpoint'));
            }

            $response = $client->createPickup($request);

            if ($response->HighestSeverity != 'FAILURE' && $response->HighestSeverity != 'ERROR') {
                echo 'Pickup confirmation number is: ' . $response->PickupConfirmationNumber . Newline;
                echo 'Location: ' . $response->Location . Newline;
                echo "<pre>";
                echo "time" . $pickup_time;
                print_r($response);
                die();
            } else {
                printError($client, $response);
            }

            writeToLog($client);    // Write to log file   
        } catch (SoapFault $exception) {
            printFault($exception, $client);
            printSuccess($client, $response);
        }
    }   

}
