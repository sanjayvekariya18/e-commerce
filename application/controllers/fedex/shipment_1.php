<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH . 'application/libraries/fedex/fedex-common.php';

class Shipment extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $path_to_wsdl = FCPATH . 'application/libraries/fedex/ShipService_v17.wsdl';

        // PDF label files. Change to file-extension .png for creating a PNG label (e.g. shiplabel.png)
        define('SHIP_LABEL', FCPATH . 'application/libraries/fedex/shiplabel.PDF');
        define('COD_LABEL', FCPATH . 'application/libraries/fedex/codlabel.PDF');

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
        $request['TransactionDetail'] = array('CustomerTransactionId' => '*** Intra India Shipping Request using PHP ***');
        $request['Version'] = array(
            'ServiceId' => 'ship',
            'Major' => '17',
            'Intermediate' => '0',
            'Minor' => '0'
        );
        $request['RequestedShipment'] = array(
            'ShipTimestamp' => date('c'),
            'DropoffType' => 'REGULAR_PICKUP', // valid values REGULAR_PICKUP, REQUEST_COURIER, DROP_BOX, BUSINESS_SERVICE_CENTER and STATION
            'ServiceType' => 'STANDARD_OVERNIGHT', // valid values STANDARD_OVERNIGHT, PRIORITY_OVERNIGHT, FEDEX_EXPRESS_SAVER
            'PackagingType' => 'YOUR_PACKAGING', // valid values FEDEX_BOX, FEDEX_PAK, FEDEX_TUBE, YOUR_PACKAGING, ...
            'Shipper' => $this->addShipper(),
            'Recipient' => $this->addRecipient(),
            'ShippingChargesPayment' => $this->addShippingChargesPayment(),
            'SpecialServicesRequested' => $this->addSpecialServices1(), //Used for Intra-India shipping - cannot use with PRIORITY_OVERNIGHT
            'CustomsClearanceDetail' => $this->addCustomClearanceDetail(),
            'LabelSpecification' => $this->addLabelSpecification(),
            'PackageCount' => 1,
            'RequestedPackageLineItems' => array(
                '0' => $this->addPackageLineItem1()
            )
        );

        try {
            if (setEndpoint('changeEndpoint')) {
                $newLocation = $client->__setLocation(setEndpoint('endpoint'));
            }

            $response = $client->processShipment($request); // FedEx web service invocation
            echo "<pre>";
            print_r($response);
            die();
            if ($response->HighestSeverity != 'FAILURE' && $response->HighestSeverity != 'ERROR') {
                printSuccess($client, $response);

                // Create PNG or PDF labels
                // Set LabelSpecification.ImageType to 'PNG' for generating a PNG labels
                $fp = fopen(SHIP_LABEL, 'wb');
                fwrite($fp, ($response->CompletedShipmentDetail->CompletedPackageDetails->Label->Parts->Image));
                fclose($fp);
                echo 'Label <a href="./' . SHIP_LABEL . '">' . SHIP_LABEL . '</a> was generated.';


                $fp = fopen(COD_LABEL, 'wb');
                fwrite($fp, ($response->CompletedShipmentDetail->AssociatedShipments->Label->Parts->Image));
                fclose($fp);
                echo 'Label <a href="./' . COD_LABEL . '">' . COD_LABEL . '</a> was generated.';
                echo "<br/>";
                echo "Notification :" . $response->Notifications->Message;
                echo "TrackingNumber :" . $response->CompletedShipmentDetail->CompletedPackageDetails->TrackingIds->TrackingNumber;
                echo "Barcode Binary value :" . $response->CompletedShipmentDetail->AssociatedShipments->PackageOperationalDetail->Barcodes->BinaryBarcodes->Value;
                echo "Barcode string value :" . $response->CompletedShipmentDetail->AssociatedShipments->PackageOperationalDetail->Barcodes->StringBarcodes->Value;
            } else {
                printError($client, $response);
            }

            writeToLog($client);    // Write to log file
        } catch (SoapFault $exception) {
            printFault($exception, $client);
        }
    }

    function addShipper() {
        $shipper = array(
            'Contact' => array(
                'PersonName' => 'Laxmisoft',
                'CompanyName' => 'SHOPKING24',
                'PhoneNumber' => '7401154349'
            ),
            'Address' => array(
                'StreetLines' => '301,Middle Point,Mota Varachha',
                'City' => 'SURAT',
                'StateOrProvinceCode' => 'GJ',
                'PostalCode' => '395010',
                'CountryCode' => 'IN',
                'CountryName' => 'INDIA'
            )
        );
        return $shipper;
    }

    function addRecipient() {
        $recipient = array(
            'Contact' => array(
                'PersonName' => 'Bhadresh Siddhapara',
                'PhoneNumber' => '8866526225'
            ),
            'Address' => array(
                'StreetLines' => '301,Middle Point,Mota Varachha',
                'City' => 'SURAT',
                'StateOrProvinceCode' => 'GJ',
                'PostalCode' => '395010',
                'CountryCode' => 'IN',
                'CountryName' => 'INDIA'
            )
        );
        return $recipient;
    }

    function addShippingChargesPayment() {
        $shippingChargesPayment = array(
            'PaymentType' => 'SENDER',
            'Payor' => array(
                'ResponsibleParty' => array(
                    'AccountNumber' => getProperty('billaccount'),
                    'Contact' => null,
                    'Address' => array('CountryCode' => 'IN')
                )
            )
        );
        return $shippingChargesPayment;
    }

    function addLabelSpecification() {
        $labelSpecification = array(
            'LabelFormatType' => 'COMMON2D', // valid values COMMON2D, LABEL_DATA_ONLY
            'ImageType' => 'PDF', // valid values DPL, EPL2, PDF, ZPLII and PNG
            'LabelStockType' => 'PAPER_8.5X11_TOP_HALF_LABEL'
        );
        return $labelSpecification;
    }

    function addSpecialServices1() {
        $specialServices = array(
            'SpecialServiceTypes' => 'COD',
            'CodDetail' => array(
                'CodCollectionAmount' => array(
                    'Currency' => 'INR',
                    'Amount' => 500.0
                ),
                'CollectionType' => 'CASH', // ANY, GUARANTEED_FUNDS              
            )
        );
        return $specialServices;
    }

    function addCustomClearanceDetail() {
        $customerClearanceDetail = array(
            'DutiesPayment' => array(
                'PaymentType' => 'SENDER', // valid values RECIPIENT, SENDER and THIRD_PARTY
                'Payor' => array(
                    'ResponsibleParty' => array(
                        'AccountNumber' => getProperty('dutyaccount'),
                        'Contact' => null,
                        'Address' => array(
                            'CountryCode' => 'IN'
                        )
                    )
                )
            ),
            'DocumentContent' => 'NON_DOCUMENTS',
            'CustomsValue' => array(
                'Currency' => 'INR',
                'Amount' => 500.0
            ),
            'CommercialInvoice' => array(
                'Purpose' => 'SOLD',
                'CustomerReferences' => array(
                    'CustomerReferenceType' => 'CUSTOMER_REFERENCE',
                    'Value' => '100001223' //SET INVOICE ID MAY BE
                )
            ),
            'Commodities' => array(
                'NumberOfPieces' => 1,
                'Description' => 'Laxmisoft Georgote Saree',
                'CountryOfManufacture' => 'IN',
                'Weight' => array(
                    'Units' => 'KG',
                    'Value' => '0.500'
                ),
                'Quantity' => 1,
                'QuantityUnits' => 'EA',
                'UnitPrice' => array(
                    'Currency' => 'INR',
                    'Amount' => '500.0'
                ),
                'CustomsValue' => array(
                    'Currency' => 'INR',
                    'Amount' => '500.0'
                )
            )
        );
        return $customerClearanceDetail;
    }

    function addPackageLineItem1() {

        $packageLineItem = array(
            'SequenceNumber' => 1,
            'Weight' => array(
                'Value' => '0.500',
                'Units' => 'KG'
            ),
            'CustomerReferences' => array(
                'CustomerReferenceType' => 'INVOICE_NUMBER', // valid values CUSTOMER_REFERENCE, INVOICE_NUMBER, P_O_NUMBER and SHIPMENT_INTEGRITY
                'Value' => '100001'
            )
        );

        return $packageLineItem;
    }

}
