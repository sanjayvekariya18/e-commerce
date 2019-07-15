<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shipment extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        try {
            $clientId = 'INSTACOM';
            $userName = 'instauser';
            $password = 'insta2013';
            $xml_batch = '<NewDataSet>
            <Customer>
            <CUSTCD>CC000100945</CUSTCD>
            </Customer>
            <Docket>
            <Order_No>ORD5001</Order_No>
            <AGENT_ID></AGENT_ID><Product_Code>279035593</Product_Code>
            <Item_Name>Stickers</Item_Name>
            <AWB_No>I30005982276</AWB_No>
            <N0_of_Pieces>1</N0_of_Pieces>
            <Customer_Name>Amol Zele</Customer_Name>
            <Shipping_Add1> Corporate Annex, No. 12, Campbell Road</Shipping_Add1>
            <Shipping_Add2>Mother Teresa Junction, Austin Town</Shipping_Add2>
            <Shipping_City>Bangalore</Shipping_City>
            <Shipping_State>Karnataka</Shipping_State>
            <Shipping_Zip>560047</Shipping_Zip>
            <Shipping_TeleNo>8451907484</Shipping_TeleNo>
            <Shipping_MobileNo>8451907484</Shipping_MobileNo>
            <Shipping_EmailId>z.amol@gmail.com</Shipping_EmailId>
            <Total_Amt>20</Total_Amt>
            <Mode>C</Mode>
            <Collectable_amount>20</Collectable_amount>
            <Weight>0.15</Weight>
            <UOM>Per KG</UOM>
            <Type_of_Service>Express</Type_of_Service>
            <VendorName>DTDC Pickup</VendorName>
            <VendorAddress1>Corporate Annex, 12, CB Road</VendorAddress1>
            <VendorAddress2>Mother Teresa Jn, Austin Town</VendorAddress2>
            <VendorPincode>560047</VendorPincode>
            <VendorTeleNo>7718867013</VendorTeleNo>
            <IsPUDO>N</IsPUDO>
            <TypeOfDelivery>HOME DELIVERY</TypeOfDelivery>
            <PUDO_Id></PUDO_Id>
            </Docket>
            </NewDataSet>';
            $url = "http://instacom.dotzot.in/services/InstacomCustomerServices.asmx/PushOrderData_PUDO";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "ClientId=" . $clientId . "&UserName=" . $userName . "&Password=" . $password . "&xmlBatch=" . $xml_batch);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('application/x-www-form-urlencoded'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $data = simplexml_load_string(curl_exec($ch));
            curl_close($ch);
            print_r($data);

//            $p = xml_parser_create();
//            xml_parse_into_struct($p, $data, $vals);
//            xml_parser_free($p);
//
//            $responce = array();
//
//            foreach ($vals as $val) {
//                if (isset($val['value'])) {
//                    $responce[$val['tag']] = $val['value'];
//                }
//            }
//
//            if ($responce['SUCCEED'] == "Yes") {                
//                echo $responce['REASON'];
//            } else {
//                echo $responce['REASON'];
//            }

            print_r($data);
        } catch (SoapFault $exception) {
            
        }
    }

}
