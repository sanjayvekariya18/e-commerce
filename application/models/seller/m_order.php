<?php

require FCPATH . 'application/libraries/fedex/fedex-common.php';

class M_order extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getToPackOrderData($seller_id) {
        $this->db->select('o.order_id,o.customer_id,o.product_id,o.product_name,o.image_thumb,o.image_medium,o.brand,o.sku,o.selling_price,o.shipping_time,o.colour,o.size,o.qty,o.total_price,o.shipping_charge,o.order_status,o.order_date,o.pay_method,c.address,c.city,st.state_name,c.pincode,c.landmark');
        $this->db->from('order_mst as o,customer_mst as c,state_mst as st');
        $this->db->where('o.customer_id = c.customer_id');
        $this->db->where('c.state = st.id');
        $this->db->where('o.order_status', '1');
        $this->db->where('o.payment_status', '1');
        $this->db->where('o.seller_id', $seller_id);
        $query = $this->db->get();
        return $query->result();
    }

    function getToPickUpOrderData($seller_id) {
        $this->db->select('o.order_id,o.customer_id,o.product_id,o.product_name,o.image_thumb,o.image_medium,o.brand,o.sku,o.selling_price,o.shipping_time,o.colour,o.size,o.qty,o.total_price,o.shipping_charge,o.order_status,o.order_date,o.pay_method,c.address,c.city,st.state_name,c.pincode,c.landmark');
        $this->db->from('order_mst as o,customer_mst as c,state_mst as st');
        $this->db->where('o.customer_id = c.customer_id');
        $this->db->where('c.state = st.id');
        $this->db->where('o.order_status', '2');
        $this->db->where('o.payment_status', '1');
        $this->db->where('o.seller_id', $seller_id);
        $query = $this->db->get();
        return $query->result();
    }

    function getToDispatchOrderData($seller_id) {
        $this->db->select('o.order_id,o.customer_id,o.product_id,o.product_name,o.image_thumb,o.image_medium,o.brand,o.sku,o.selling_price,o.shipping_time,o.colour,o.size,o.qty,o.total_price,o.shipping_charge,o.order_status,o.order_date,o.pay_method,o.awb_no,o.packing_by,c.address,c.city,st.state_name,c.pincode,c.landmark');
        $this->db->from('order_mst as o,customer_mst as c,state_mst as st');
        $this->db->where('o.customer_id = c.customer_id');
        $this->db->where('c.state = st.id');
        $this->db->where('o.order_status', '3');
        $this->db->where('o.transite', '0');
        $this->db->where('o.payment_status', '1');
        $this->db->where('o.seller_id', $seller_id);
        $query = $this->db->get();
        return $query->result();
    }

    function getToHandoverOrderData($seller_id) {
        $this->db->select('o.order_id,o.customer_id,o.product_id,o.product_name,o.image_thumb,o.image_medium,o.brand,o.sku,o.selling_price,o.shipping_time,o.colour,o.size,o.qty,o.total_price,o.shipping_charge,o.order_status,o.order_date,o.pay_method,o.awb_no,o.packing_by,c.address,c.city,st.state_name,c.pincode,c.landmark');
        $this->db->from('order_mst as o,customer_mst as c,state_mst as st');
        $this->db->where('o.customer_id = c.customer_id');
        $this->db->where('c.state = st.id');
        $this->db->where('o.order_status', '3');
        $this->db->where('o.transite', '1');
        $this->db->where('o.payment_status', '1');
        $this->db->where('o.seller_id', $seller_id);
        $query = $this->db->get();
        return $query->result();
    }

    function getCancelOrderData($seller_id) {
        $status = array('6', '8');
        $this->db->select('o.order_id,o.customer_id,o.product_id,o.product_name,o.image_thumb,o.image_medium,o.brand,o.sku,o.selling_price,o.shipping_time,o.colour,o.size,o.qty,o.total_price,o.shipping_charge,o.order_status,o.order_date,o.cancel_date,o.cancel_reason,o.pay_method,c.address,c.city,st.state_name,c.pincode,c.landmark');
        $this->db->from('order_mst as o,customer_mst as c,state_mst as st');
        $this->db->where('o.customer_id = c.customer_id');
        $this->db->where('c.state = st.id');
        $this->db->where_in('o.order_status', $status);
        $this->db->where('o.seller_id', $seller_id);
        $query = $this->db->get();
        return $query->result();
    }

    function getReturnOrderData($seller_id) {
        $status = array('5');
        $this->db->select('o.order_id,o.customer_id,o.product_id,o.product_name,o.image_thumb,o.image_medium,o.brand,o.sku,o.selling_price,o.shipping_time,o.colour,o.size,o.qty,o.total_price,o.shipping_charge,o.order_status,o.order_date,o.return_date,o.return_reason,o.pay_method,o.awb_no,c.address,c.city,st.state_name,c.pincode,c.landmark');
        $this->db->from('order_mst as o,customer_mst as c,state_mst as st');
        $this->db->where('o.customer_id = c.customer_id');
        $this->db->where('c.state = st.id');
        $this->db->where_in('o.order_status', $status);
        $this->db->where('o.seller_id', $seller_id);
        $query = $this->db->get();
        return $query->result();
    }

    function getReplaceOrderData($seller_id) {
        $status = array('7');
        $this->db->select('o.order_id,o.customer_id,o.product_id,o.product_name,o.image_thumb,o.image_medium,o.brand,o.sku,o.selling_price,o.shipping_time,o.colour,o.size,o.qty,o.total_price,o.shipping_charge,o.order_status,o.order_date,o.return_date,o.return_reason,o.pay_method,o.awb_no,c.address,c.city,st.state_name,c.pincode,c.landmark');
        $this->db->from('order_mst as o,customer_mst as c,state_mst as st');
        $this->db->where('o.customer_id = c.customer_id');
        $this->db->where('c.state = st.id');
        $this->db->where_in('o.order_status', $status);
        $this->db->where('o.seller_id', $seller_id);
        $query = $this->db->get();
        return $query->result();
    }

    function getRefundOrderData($seller_id) {
        $status = array('9');
        $this->db->select('o.order_id,o.customer_id,o.product_id,o.product_name,o.image_thumb,o.image_medium,o.brand,o.sku,o.selling_price,o.shipping_time,o.colour,o.size,o.qty,o.total_price,o.shipping_charge,o.order_status,o.order_date,o.return_date,o.return_reason,o.pay_method,o.awb_no,c.address,c.city,st.state_name,c.pincode,c.landmark');
        $this->db->from('order_mst as o,customer_mst as c,state_mst as st');
        $this->db->where('o.customer_id = c.customer_id');
        $this->db->where('c.state = st.id');
        $this->db->where_in('o.order_status', $status);
        $this->db->where('o.seller_id', $seller_id);
        $query = $this->db->get();
        return $query->result();
    }

    function getShippedOrderData($seller_id) {
        $this->db->select('o.order_id,o.customer_id,o.product_id,o.product_name,o.image_thumb,o.image_medium,o.brand,o.sku,o.selling_price,o.shipping_time,o.colour,o.size,o.qty,o.total_price,o.shipping_charge,o.order_status,o.order_date,o.shipped_date,o.awb_no,o.pay_method,c.address,c.city,st.state_name,c.pincode,c.landmark');
        $this->db->from('order_mst as o,customer_mst as c,state_mst as st');
        $this->db->where('o.customer_id = c.customer_id');
        $this->db->where('c.state = st.id');
        $this->db->where('o.order_status', '3');
        $this->db->where('o.transite', '1');
        $this->db->where('o.seller_id', $seller_id);
        $query = $this->db->get();
        return $query->result();
    }

    function getDeliveredOrderData($seller_id) {
        $this->db->select('o.order_id,o.customer_id,o.product_id,o.product_name,o.image_thumb,o.image_medium,o.brand,o.sku,o.selling_price,o.shipping_time,o.colour,o.size,o.qty,o.total_price,o.shipping_charge,o.order_status,o.order_date,o.delivery_date,o.awb_no,o.pay_method,c.address,c.city,st.state_name,c.pincode,c.landmark');
        $this->db->from('order_mst as o,customer_mst as c,state_mst as st');
        $this->db->where('o.customer_id = c.customer_id');
        $this->db->where('c.state = st.id');
        $this->db->where('o.order_status', '4');
        $this->db->where('o.seller_id', $seller_id);
        $query = $this->db->get();
        return $query->result();
    }

    function getPackSlipData($order_id) {
        $this->db->select('o.order_id,o.product_id,o.customer_id,o.product_name,o.selling_price,o.colour,o.size,o.qty,o.shipping_charge,o.cod_charge,o.total_price,o.payment_price,o.order_date,o.pay_method,o.weight,o.txn_id,o.packing_id,o.packing_by,o.awb_no,o.form_id,o.service_type,o.barcode_string,o.awb_no_cod,o.form_id_cod,o.service_type_cod,o.barcode_string_cod,o.destination_id,o.destination_area,o.routing_code,o.shipped_date,o.airport_id,c.first_name,c.last_name,c.address,c.city,c.state,c.pincode,c.landmark,c.primary_mobile as "customer_contact",c.primary_email as "customer_email",s.first_name as "seller_fname",s.last_name as "seller_lname",s.business_name,s.pickup_address,s.pickup_landmark,s.pickup_city,s.pickup_state,s.pickup_pincode,s.tin_id,s.primary_mobile as "seller_contact",s.primary_email as "seller_email"');
        $this->db->from('order_mst as o,customer_mst as c,seller_mst as s');
        $this->db->where('o.customer_id = c.customer_id');
        $this->db->where('o.seller_id = s.seller_id');
        $this->db->where('o.order_id', $order_id);
        $query = $this->db->get();
        return $query->row();
    }

    function getTrackingId($data) {
        if ($data['courior'] == 3) {
            if ($data['pay_method'] == "cod") {
                $query = $this->db->get_where('dtdc_details_mst', array('status' => '0', 'tracking_id like' => "I%"));
            } else {
                $query = $this->db->get_where('dtdc_details_mst', array('status' => '0', 'tracking_id like' => "7%"));
            }
            return isset($query->row()->tracking_id) ? $query->row()->tracking_id : '';
        } else if ($data['courior'] == 2) {
            $query = $this->db->get_where('indiapost_details_mst', array('status' => '0'));
            return isset($query->row()->tracking_id) ? $query->row()->tracking_id : '';
        }
    }

    function dtdcSheetOrder($post) {
        $this->db->select('o.order_id,o.product_name,payment_price,o.pay_method,o.awb_no,d.state,d.pincode,c.first_name,c.last_name,c.primary_mobile');
        $this->db->from('order_mst as o');
        $this->db->join('customer_mst as c','o.customer_id = c.customer_id');
        $this->db->join('dtdc_pincode_mst as d','c.pincode = d.pincode');
        $this->db->where('o.packing_by','3');
        $this->db->where_in('o.order_id',$post['allOrder']);
        $query = $this->db->get();
        return $query->result();
    }

// PACK ORDER FOR COURIOR FEDEX (ONLY SET STATUS 2 FOR ORDER AND GENERATE PACKING ID)

    function packOrder($order_id) {
        $order_data = $this->getOrderById($order_id);
        $packing_id = $this->getMaxPackingId();

        $order_update = array(
            'order_status' => 2,
            'ready_date' => date('Y-m-d H:i:s'),
            'packing_id' => $packing_id
        );

        $order_status = array(
            'order_id' => $order_id,
            'txn_id' => $order_data->txn_id,
            'track_status' => "Ready To Ship",
            'description' => "Your Order Is Ready To Ship",
            'location' => $this->common->getSellerDataByID($order_data->seller_id)->pickup_city,
            'status_date' => date('Y-m-d H:i:s')
        );
        $this->db->update('order_mst', $order_update, array('order_id' => $order_id));
        $this->db->insert('order_status_mst', $order_status);
        return $packing_id;
    }

    function getMaxPackingId() {
        $this->db->select('max(packing_id) as packing_id');
        $this->db->from('order_mst');
        $query = $this->db->get();
        $data = $query->row();

        if ($data->packing_id == "") {
            $this->db->select('packing_id');
            $this->db->from('general_id_mst');
            $query = $this->db->get();
            $data = $query->row();
        }
        return $data->packing_id + 1;
    }

    function getOrderById($order_id) {
        $query = $this->db->get_where('order_mst', array('order_id' => $order_id));
        return $query->row();
    }

    function setInTransite($order_id) {
        $this->db->update('order_mst', array('transite' => '1'), array('order_id' => $order_id));
        return 1;
    }

// RESET SELLER HEADER NOTIFICATIONS 

    function resetNewOrderNotify() {
        $where = array(
            'seller_id' => $this->session->userdata('seller_id'),
            'order_status' => '1'
        );
        $this->db->update('order_notify_mst', array('status' => '1'), $where);
    }

    function resetCancelOrderNotify() {
        $where = array(
            'seller_id' => $this->session->userdata('seller_id'),
            'order_status' => '6'
        );
        $this->db->update('order_notify_mst', array('status' => '1'), $where);
    }

    function resetReturnOrderNotify() {
        $where = array(
            'seller_id' => $this->session->userdata('seller_id'),
            'order_status' => '5'
        );
        $this->db->update('order_notify_mst', array('status' => '1'), $where);
    }

    function resetReplaceOrderNotify() {
        $where = array(
            'seller_id' => $this->session->userdata('seller_id'),
            'order_status' => '7'
        );
        $this->db->update('order_notify_mst', array('status' => '1'), $where);
    }

// -------------------FEDEX CREATE SHIPMENT --------------------------------

    function getFedexSlipData($order) {
        $cod_amount = 0;
        $paid_amount = 0;
        $total_amount = 0;
        $total_qty = 0;
        $total_weight = 0;
        $txn_id = $order->txn_id;
        $order_id = $order->order_id;
        $returnflag = 0;

        if ($order->pay_method == 'cod') {
            $cod_amount += $order->payment_price;
        } else {
            $paid_amount += $order->payment_price;
        }

        $total_amount = $order->payment_price;
        $total_qty = $order->qty;
        $total_weight += $order->weight * $order->qty;
        $total_weight = $total_weight / 1000;

        $path_to_wsdl = FCPATH . 'application/libraries/fedex/ShipService_v17.wsdl';

        define('SHIP_LABEL', FCPATH . 'upload/fedexslip/' . $order_id . '_SHIP.PDF');
        define('COD_LABEL', FCPATH . 'upload/fedexslip/' . $order_id . '_COD.PDF');

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
            'Shipper' => $this->addShipper($order),
            'Recipient' => $this->addRecipient($order),
            'ShippingChargesPayment' => $this->addShippingChargesPayment(),
            'CustomsClearanceDetail' => $this->addCustomClearanceDetail($total_amount, $total_qty, $total_weight, $txn_id),
            'LabelSpecification' => $this->addLabelSpecification(),
            'PackageCount' => 1,
            'RequestedPackageLineItems' => array(
                '0' => $this->addPackageLineItem1($total_weight, $txn_id)
            )
        );

        if ($order->pay_method == 'cod') {
            $request['RequestedShipment']['SpecialServicesRequested'] = $this->addSpecialServices1($cod_amount);
        }

        try {
            if (setEndpoint('changeEndpoint')) {
                $newLocation = $client->__setLocation(setEndpoint('endpoint'));
            }

            $response = $client->processShipment($request); // FedEx web service invocation


            if ($response->HighestSeverity != 'FAILURE' && $response->HighestSeverity != 'ERROR') {
                if ($order->pay_method == 'cod') {
                    $shipment_data = array(
                        'fedex_status' => $response->Notifications->Message,
                        'awb_no' => $response->CompletedShipmentDetail->CompletedPackageDetails->TrackingIds->TrackingNumber,
                        'form_id' => $response->CompletedShipmentDetail->CompletedPackageDetails->TrackingIds->FormId,
                        'barcode_string' => $response->CompletedShipmentDetail->CompletedPackageDetails->OperationalDetail->Barcodes->StringBarcodes->Value,
                        'barcode_binary' => $response->CompletedShipmentDetail->CompletedPackageDetails->OperationalDetail->Barcodes->BinaryBarcodes->Value,
                        'awb_no_cod' => $response->CompletedShipmentDetail->AssociatedShipments->TrackingId->TrackingNumber,
                        'form_id_cod' => $response->CompletedShipmentDetail->AssociatedShipments->TrackingId->FormId,
                        'barcode_string_cod' => $response->CompletedShipmentDetail->AssociatedShipments->PackageOperationalDetail->Barcodes->StringBarcodes->Value,
                        'barcode_binary_cod' => $response->CompletedShipmentDetail->AssociatedShipments->PackageOperationalDetail->Barcodes->BinaryBarcodes->Value,
                        'service_type' => $response->CompletedShipmentDetail->OperationalDetail->AstraDescription,
                        'service_type_cod' => $response->CompletedShipmentDetail->AssociatedShipments->ServiceType,
                        'destination_id' => $response->CompletedShipmentDetail->OperationalDetail->DestinationLocationId,
                        'destination_area' => $response->CompletedShipmentDetail->OperationalDetail->DestinationServiceArea,
                        'routing_code' => $response->CompletedShipmentDetail->OperationalDetail->UrsaPrefixCode . " " . $response->CompletedShipmentDetail->OperationalDetail->UrsaSuffixCode,
                        'airport_id' => $response->CompletedShipmentDetail->OperationalDetail->AirportId,
                        'packing_by' => 1
                    );
                    $fp = fopen(SHIP_LABEL, 'wb');
                    fwrite($fp, ($response->CompletedShipmentDetail->CompletedPackageDetails->Label->Parts->Image));
                    fclose($fp);

                    $fp = fopen(COD_LABEL, 'wb');
                    fwrite($fp, ($response->CompletedShipmentDetail->AssociatedShipments->Label->Parts->Image));
                    fclose($fp);
                } else {
                    $shipment_data = array(
                        'fedex_status' => $response->Notifications->Message,
                        'awb_no' => $response->CompletedShipmentDetail->CompletedPackageDetails->TrackingIds->TrackingNumber,
                        'form_id' => $response->CompletedShipmentDetail->CompletedPackageDetails->TrackingIds->FormId,
                        'barcode_string' => $response->CompletedShipmentDetail->CompletedPackageDetails->OperationalDetail->Barcodes->StringBarcodes->Value,
                        'barcode_binary' => $response->CompletedShipmentDetail->CompletedPackageDetails->OperationalDetail->Barcodes->BinaryBarcodes->Value,
                        'service_type' => $response->CompletedShipmentDetail->OperationalDetail->AstraDescription,
                        'destination_id' => $response->CompletedShipmentDetail->OperationalDetail->DestinationLocationId,
                        'destination_area' => $response->CompletedShipmentDetail->OperationalDetail->DestinationServiceArea,
                        'routing_code' => $response->CompletedShipmentDetail->OperationalDetail->UrsaPrefixCode . " " . $response->CompletedShipmentDetail->OperationalDetail->UrsaSuffixCode,
                        'airport_id' => $response->CompletedShipmentDetail->OperationalDetail->AirportId,
                        'packing_by' => 1
                    );
                    $fp = fopen(SHIP_LABEL, 'wb');
                    fwrite($fp, ($response->CompletedShipmentDetail->CompletedPackageDetails->Label->Parts->Image));
                    fclose($fp);
                }
// ---- UPDATE AWD NO + STATUS + BARCODE DATA IN TO ORDER MST                
                $this->db->update('order_mst', $shipment_data, array('txn_id' => $txn_id));
                $returnflag = 1;
            } else {
                $returnflag = 0;
            }
        } catch (SoapFault $exception) {
            $returnflag = 0;
        }

        if ($returnflag) {
            $result = $this->getFedexPickupData($order, $total_weight);
            $returnflag = ($result) ? 1 : 0;
            return $returnflag;
        } else {
            return $returnflag;
        }
    }

    function getFedexPickupData($order, $total_weight) {
        $path_to_wsdl = FCPATH . 'application/libraries/fedex/PickupService_v11.wsdl';
        $Fedexpincode = $this->common->getFedexPincode($order->pickup_pincode);
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
                    'PersonName' => $order->seller_fname . " " . $order->seller_lname,
                    'CompanyName' => $order->business_name,
                    'PhoneNumber' => $order->seller_contact
                ),
                'Address' => array(
                    'StreetLines' => array($order->pickup_address, $order->pickup_landmark),
                    'City' => $Fedexpincode->city,
                    'StateOrProvinceCode' => $Fedexpincode->state,
                    'PostalCode' => $Fedexpincode->pincode,
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
            'Value' => $total_weight,
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
                $pickup_no = $response->PickupConfirmationNumber;
                $pickup_data = array(
                    'order_status' => 3,
                    'pickup_no' => $pickup_no,
                    'shipped_date' => date('Y-m-d H:i:s', strtotime($pickup_time))
                );

                $order_status = array(
                    'order_id' => $order->order_id,
                    'txn_id' => $order->txn_id,
                    'track_status' => "Ready To Ship",
                    'description' => "Your Order Is Ready To Ship",
                    'location' => $order->pickup_city,
                    'status_date' => date('Y-m-d H:i:s')
                );
                $this->db->update('order_mst', $pickup_data, array('order_id' => $order->order_id));
                $this->db->insert('order_status_mst', $order_status);

                return 1;
            } else {
                return 0;
            }
        } catch (SoapFault $exception) {
            return 0;
        }
    }

    function addShipper($order) {
        $Fedexpincode = $this->common->getFedexPincode($order->pickup_pincode);

        $shipper = array(
            'Contact' => array(
                'PersonName' => $order->seller_fname . " " . $order->seller_lname,
                'CompanyName' => $order->business_name,
                'PhoneNumber' => $order->seller_contact
            ),
            'Address' => array(
                'StreetLines' => array($order->pickup_address, $order->pickup_landmark),
                'City' => $Fedexpincode->city,
                'StateOrProvinceCode' => $Fedexpincode->state,
                'PostalCode' => $Fedexpincode->pincode,
                'CountryCode' => 'IN',
                'CountryName' => 'INDIA'
            )
        );
        return $shipper;
    }

    function addRecipient($order) {
        $Fedexpincode = $this->common->getFedexPincode($order->pincode);

        $recipient = array(
            'Contact' => array(
                'PersonName' => $order->first_name . " " . $order->last_name,
                'PhoneNumber' => $order->customer_contact
            ),
            'Address' => array(
                'StreetLines' => array($order->address, $order->landmark),
                'City' => $Fedexpincode->city,
                'StateOrProvinceCode' => $Fedexpincode->state,
                'PostalCode' => $Fedexpincode->pincode,
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

    function addSpecialServices1($cod_amount) {

        $specialServices = array(
            'SpecialServiceTypes' => 'COD',
            'CodDetail' => array(
                'CodCollectionAmount' => array(
                    'Currency' => 'INR',
                    'Amount' => $cod_amount
                ),
                'CollectionType' => 'CASH', // ANY, GUARANTEED_FUNDS              
            )
        );
        return $specialServices;
    }

    function addCustomClearanceDetail($total_amount, $total_qty, $total_weight, $txn_id) {
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
                'Amount' => $total_amount
            ),
            'CommercialInvoice' => array(
                'Purpose' => 'SOLD',
                'CustomerReferences' => array(
                    array(
                        'CustomerReferenceType' => 'P_O_NUMBER', // valid values CUSTOMER_REFERENCE, INVOICE_NUMBER, P_O_NUMBER and SHIPMENT_INTEGRITY
                        'Value' => 'B2C'
                    ),
                    array(
                        'CustomerReferenceType' => 'CUSTOMER_REFERENCE', // valid values CUSTOMER_REFERENCE, INVOICE_NUMBER, P_O_NUMBER and SHIPMENT_INTEGRITY
                        'Value' => 'BILL D/T: SENDER'
                    ),
                    array(
                        'CustomerReferenceType' => 'INVOICE_NUMBER', // valid values CUSTOMER_REFERENCE, INVOICE_NUMBER, P_O_NUMBER and SHIPMENT_INTEGRITY
                        'Value' => $txn_id
                    )
                ),
            ),
            'Commodities' => array(
                'NumberOfPieces' => 1,
                'Description' => 'PRODUCT BY SHOPKING24',
                'CountryOfManufacture' => 'IN',
                'Weight' => array(
                    'Units' => 'KG',
                    'Value' => $total_weight
                ),
                'Quantity' => $total_qty,
                'QuantityUnits' => 'EA',
                'UnitPrice' => array(
                    'Currency' => 'INR',
                    'Amount' => $total_amount
                ),
                'CustomsValue' => array(
                    'Currency' => 'INR',
                    'Amount' => $total_amount
                )
            )
        );
        return $customerClearanceDetail;
    }

    function addPackageLineItem1($total_weight, $txn_id) {

        $packageLineItem = array(
            'SequenceNumber' => 1,
            'Weight' => array(
                'Value' => $total_weight,
                'Units' => 'KG'
            ),
            'CustomerReferences' => array(
                array(
                    'CustomerReferenceType' => 'P_O_NUMBER', // valid values CUSTOMER_REFERENCE, INVOICE_NUMBER, P_O_NUMBER and SHIPMENT_INTEGRITY
                    'Value' => 'B2C'
                ),
                array(
                    'CustomerReferenceType' => 'CUSTOMER_REFERENCE', // valid values CUSTOMER_REFERENCE, INVOICE_NUMBER, P_O_NUMBER and SHIPMENT_INTEGRITY
                    'Value' => 'BILL D/T: SENDER'
                ),
                array(
                    'CustomerReferenceType' => 'INVOICE_NUMBER', // valid values CUSTOMER_REFERENCE, INVOICE_NUMBER, P_O_NUMBER and SHIPMENT_INTEGRITY
                    'Value' => $txn_id
                )
            ),
        );
        return $packageLineItem;
    }

//----------------------------- DTDC AND INDIA POST ORDER DATA ------------------------------------

    function getPackOrderData($data) {

        $order = $this->getPackSlipData($data['order_id']);

        if ($data['courior'] == 3) {
            // COURIOR IS DTDC SO REQUEST FOR PUSH ORDER DETAILS AT DTDC
            $responce = $this->getDtdcSlipData($order, $data);
            $result = explode("|", $responce);
            $flag = $result[0];
            $message = $result[1];
        } else if ($data['courior'] == 2) {
            $flag = 1;
            $message = "Order No Uploaded Successfully";
        }

        if ($flag) {
            $packing_id = $this->getMaxPackingId();

            $pickup_data = array(
                'order_status' => 3,
                'packing_by' => $data['courior'],
                'awb_no' => $data['tracking_id'],
                'packing_id' => $packing_id,
                'shipped_date' => date('Y-m-d H:i:s')
            );

            $order_status = array(
                'order_id' => $order->order_id,
                'txn_id' => $order->txn_id,
                'track_status' => "Ready To Ship",
                'description' => "Your Order Is Ready To Ship",
                'location' => $order->pickup_city,
                'status_date' => date('Y-m-d H:i:s')
            );
            $this->db->trans_start();
            $this->db->update('order_mst', $pickup_data, array('order_id' => $order->order_id));
            $this->db->insert('order_status_mst', $order_status);

            if ($data['courior'] == "3") {
                $this->db->update('dtdc_details_mst', array('status' => '1'), array('tracking_id' => $data['tracking_id']));
            } else if ($data['courior'] == "2") {
                $this->db->update('indiapost_details_mst', array('status' => '1'), array('tracking_id' => $data['tracking_id']));
            }
            $this->db->trans_complete();
        }
        return $message;
    }

    function getDtdcSlipData($order, $data) {

        $cdtdc = $this->common->getDtdcPincode($order->pincode);
        $sdtdc = $this->common->getDtdcPincode($order->pickup_pincode);
        $mode = ($order->pay_method == "cod") ? "C" : "P";
        $collect = ($order->pay_method == "cod") ? $order->payment_price : 0;


        try {
            $clientId = 'INSTACOM';
            $userName = 'instauser';
            $password = 'insta2013';
            $xml_batch = '<NewDataSet>
            <Customer>
            <CUSTCD>CC000100945</CUSTCD>
            </Customer>
            <Docket>
            <Order_No>' . $order->order_id . '</Order_No>
            <AGENT_ID></AGENT_ID>
            <Product_Code>' . $order->product_id . '</Product_Code>
            <Item_Name>' . preg_replace('/[^A-Za-z0-9, \-]/', '', $order->product_name). '</Item_Name>
            <AWB_No>' . $data["tracking_id"] . '</AWB_No>
            <N0_of_Pieces>' . $order->qty . '</N0_of_Pieces>
            <Customer_Name>' . $order->first_name . '</Customer_Name>
            <Shipping_Add1>' . preg_replace('/[^A-Za-z0-9, \-]/', '', $order->address) . '</Shipping_Add1>
            <Shipping_Add2>' . preg_replace('/[^A-Za-z0-9, \-]/', '', $order->landmark) . '</Shipping_Add2>
            <Shipping_City>' . $cdtdc->city . '</Shipping_City>
            <Shipping_State>' . $cdtdc->state . '</Shipping_State>
            <Shipping_Zip>' . $cdtdc->pincode . '</Shipping_Zip>
            <Shipping_TeleNo>' . $order->customer_contact . '</Shipping_TeleNo>
            <Shipping_MobileNo>' . $order->customer_contact . '</Shipping_MobileNo>
            <Shipping_EmailId>' . $order->customer_email . '</Shipping_EmailId>
            <Total_Amt>' . $order->payment_price . '</Total_Amt>
            <Mode>' . $mode . '</Mode>                
            <Collectable_amount>' . $collect . '</Collectable_amount>
            <Weight>' . ($order->weight * $order->qty / 1000) . '</Weight>
            <UOM>Per KG</UOM>
            <Type_of_Service>Express</Type_of_Service>
            <VendorName>' . preg_replace('/[^A-Za-z0-9, \-]/', '', $order->business_name) . '</VendorName>
            <VendorAddress1>' . preg_replace('/[^A-Za-z0-9, \-]/', '', $order->pickup_address) . '</VendorAddress1>
            <VendorAddress2>' . preg_replace('/[^A-Za-z0-9, \-]/', '', $order->pickup_landmark) . '</VendorAddress2>
            <VendorPincode>' . $sdtdc->pincode . '</VendorPincode>
            <VendorTeleNo>' . $order->seller_contact . '</VendorTeleNo>
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

            $p = xml_parser_create();
            xml_parse_into_struct($p, $data, $vals);
            xml_parser_free($p);

            $responce = array();

            foreach ($vals as $val) {
                if (isset($val['value'])) {
                    $responce[$val['tag']] = $val['value'];
                }
            }
            if ($responce['SUCCEED'] == "Yes") {
                return "1|" . $responce['REASON'];
            } else {
                return "0|" . $responce['REASON'];
            }
        } catch (SoapFault $exception) {
            
        }
    }

}
