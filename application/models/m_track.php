<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require FCPATH . 'application/libraries/fedex/fedex-common.php';

class M_track extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // FEDEX TRACK ORDER DETAIL

    function trackOrders() {

        $orders = $this->getTrackOrder();

        $path_to_wsdl = FCPATH . 'application/libraries/fedex/TrackService_v10.wsdl';
        ini_set("soap.wsdl_cache_enabled", "0");

        $client = new SoapClient($path_to_wsdl, array('trace' => 1));

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

        echo "<pre>";
        foreach ($orders as $val) {

            if ($val->awb_no != "") {
                $request['SelectionDetails'] = array(
                    'PackageIdentifier' => array(
                        'Type' => 'TRACKING_NUMBER_OR_DOORTAG',
                        'Value' => $val->awb_no
                    )
                );

                try {
                    if (setEndpoint('changeEndpoint')) {
                        $newLocation = $client->__setLocation(setEndpoint('endpoint'));
                    }
                    $response = $client->track($request);

                    if ($response->HighestSeverity == 'SUCCESS') {
                        if (isset($response->CompletedTrackDetails->TrackDetails->TrackingNumber)) {
                            $tracking_no = $response->CompletedTrackDetails->TrackDetails->TrackingNumber;
                            $order = $this->common->getOrderByAWB($tracking_no);
                            if (isset($order->order_id)) {
                                $order_id = $order->order_id;
                                $txn_id = $order->txn_id;
                                if (isset($response->CompletedTrackDetails->TrackDetails->Events->EventType)) {
                                    $track_status = $this->common->getFedexTrackStatus($response->CompletedTrackDetails->TrackDetails->Events->EventType);
                                    $description = $response->CompletedTrackDetails->TrackDetails->Events->EventDescription;
                                    if (isset($response->CompletedTrackDetails->TrackDetails->Events->Address->City)) {
                                        $location = $response->CompletedTrackDetails->TrackDetails->Events->Address->City;
                                    } else {
                                        $location = "-";
                                    }
                                    $status_date = date('Y-m-d H:i:s', strtotime($response->CompletedTrackDetails->TrackDetails->Events->Timestamp));

                                    $result = $this->checkStatusExist($order_id, $track_status, $location);

                                    if ($result == 0) {
                                        $data = array(
                                            'order_id' => $order_id,
                                            'txn_id' => $txn_id,
                                            'track_status' => $track_status,
                                            'description' => $description,
                                            'location' => $location,
                                            'status_date' => $status_date
                                        );
                                        $this->db->insert('order_status_mst', $data);
                                    }
                                    if ($track_status == "Delivered") {
                                        $updateorder = array(
                                            'order_status' => '4',
                                            'delivery_date' => $status_date
                                        );
                                        $this->db->update('order_mst', $updateorder, array('order_id' => $order_id));
                                    } else if ($track_status == "Shipment Cancelled" || $track_status == "Return to Shipper") {
                                        $updateorder = array(
                                            'order_status' => '8',
                                            'cancel_date' => $status_date
                                        );

                                        $transaction_update = array(
                                            'shipping_charge' => $order->shipping_charge * 2
                                        );

                                        $order_status = array(
                                            'order_id' => $order_id,
                                            'txn_id' => $order->txn_id,
                                            'track_status' => "Shipped Cancel",
                                            'description' => "Your Order Is Shipped Cancelled (Return To Seller)",
                                            'location' => $location,
                                            'status_date' => date('Y-m-d H:i:s')
                                        );

                                        $order_notify = array(
                                            'order_id' => $order_id,
                                            'seller_id' => $order->seller_id,
                                            'total_price' => $order->payment_price,
                                            'order_status' => "8",
                                            'notify_date' => date('Y-m-d H:i:s')
                                        );
                                        $this->db->trans_start();

                                        if ($order->pay_method == "card") {
                                            $customer = $this->common->getCustomerDataById($order->customer_id);
                                            $refund_request = array(
                                                'order_id' => $order->order_id,
                                                'amount' => $order->payment_price,
                                                'bank_name' => $customer->bank_name,
                                                'ifsc' => $customer->ifsc,
                                                'account_no' => $customer->account_no,
                                                'account_name' => $customer->account_name,
                                                'request_date' => date('Y-m-d H:i:s')
                                            );

                                            $refund_request_notify = array(
                                                'from_id' => $customer->customer_id,
                                                'from_name' => $customer->first_name . " " . $customer->last_name,
                                                'to_id' => '0',
                                                'to_name' => 'Administrator',
                                                'message' => "Refund Request To You With Amount :" . $order->payment_price,
                                                'request_type' => '1'
                                            );
                                            $this->db->insert('refund_mst', $refund_request);
                                            $this->db->insert('payout_notify_mst', $refund_request_notify);
                                        }

                                        $this->db->update('order_mst', $updateorder, array('order_id' => $order_id));
                                        $this->db->update('transaction_mst', $transaction_update, array('order_id' => $order_id));
                                        $this->db->insert('order_status_mst', $order_status);
                                        $this->db->insert('order_notify_mst', $order_notify);
                                        $this->db->trans_complete();
                                    }
                                }
                            }
                        }
                    }
                } catch (SoapFault $exception) {
                    
                }
            }
        }
        echo "order sucessfully tracked";
    }

    function checkStatusExist($order_id, $track_status, $location) {
        $where = array(
            'order_id' => $order_id,
            'track_status' => $track_status,
            'location' => $location
        );

        $query = $this->db->get_where('order_status_mst', $where);
        return $query->num_rows();
    }

    function getTrackOrder() {
        $this->db->where_in('order_status', array('1', '2', '3', '4'));
        $this->db->where('packing_by <>', '2');
        $query = $this->db->get('order_mst');
        return $query->result();
    }

    // DTDC TRACK ORDER DETAILS

    function getDtdcTrackOrder() {
        $this->db->where_in('order_status', array('1', '2', '3', '4'));
        $this->db->where('packing_by', '3');
        $query = $this->db->get('order_mst');
        return $query->result();
    }

    function dtdcTrackOrder() {
        $order = $this->getDtdcTrackOrder();
        foreach ($order as $val) {
            if ($val->awb_no != "") {
                $client = new SoapClient("http://instacom.dotzot.in/services/Cust_WS_Ver2.asmx?WSDL");
                $params['userName'] = 'instauser';
                $params['password'] = 'insta2013';
                $params['clientId'] = 'INSTACOM';
                $params['DOCNO'] = $val->awb_no;
                $result = $client->ConsignmentTrackEvents_Details_New($params);

                if (isset($result->ConsignmentTrackEvents_Details_NewResult->ConsignmentTrack[0])) {
                    $responce = $result->ConsignmentTrackEvents_Details_NewResult->ConsignmentTrack[0];

                    $awb_no = $responce->DOCKNO;
                    $location = $responce->TRANSIT_LOCATION;
                    $eventdate = $responce->EVENTDATE;
                    $track_code = $responce->TRACKING_CODE;
                }

                if (isset($awb_no) && $awb_no != "" && $track_code !="") {
                      echo "Awb No : ".$awb_no." Track Code ".$track_code ."<br>";
//                    $track_status = $this->getDtdcTrackStatus($track_code);
//                    $result = $this->checkStatusExist($val->order_id, $track_status, $location);
//
//                    if ($result == 0) {
//                        $data = array(
//                            'order_id' => $val->order_id,
//                            'txn_id' => $val->txn_id,
//                            'track_status' => $track_status,
//                            'description' => $track_status,
//                            'location' => $location,
//                            'status_date' => date('Y-m-d H:i:s', strtotime($eventdate))
//                        );
//                        $this->db->insert('order_status_mst', $data);
//                    }
//                    if ($track_code == "T") {
//                        $updateorder = array(
//                            'order_status' => '3',
//                            'transite' => '1'
//                        );
//                        $this->db->update('order_mst', $updateorder, array('order_id' => $val->order_id));
//                    } else if ($track_code == "D") {
//                        $updateorder = array(
//                            'order_status' => '4',
//                            'delivery_date' => date('Y-m-d H:i:s', strtotime($eventdate))
//                        );
//                        $this->db->update('order_mst', $updateorder, array('order_id' => $val->order_id));
//                    } else if ($track_code == "RT") {
//                        $updateorder = array(
//                            'order_status' => '8',
//                            'cancel_date' => date('Y-m-d H:i:s', strtotime($eventdate))
//                        );
//
//                        $transaction_update = array(
//                            'shipping_charge' => $val->order->shipping_charge * 2
//                        );
//
//                        $order_status = array(
//                            'order_id' => $val->order_id,
//                            'txn_id' => $val->txn_id,
//                            'track_status' => "Shipped Cancel",
//                            'description' => "Your Order Is Shipped Cancelled (Return To Seller)",
//                            'location' => $location,
//                            'status_date' => date('Y-m-d H:i:s')
//                        );
//
//                        $order_notify = array(
//                            'order_id' => $val->order_id,
//                            'seller_id' => $val->seller_id,
//                            'total_price' => $val->payment_price,
//                            'order_status' => "8",
//                            'notify_date' => date('Y-m-d H:i:s')
//                        );
//                        $this->db->trans_start();
//
//                        if ($val->pay_method == "card") {
//                            $customer = $this->common->getCustomerDataById($val->customer_id);
//                            $refund_request = array(
//                                'order_id' => $val->order_id,
//                                'amount' => $val->payment_price,
//                                'bank_name' => $customer->bank_name,
//                                'ifsc' => $customer->ifsc,
//                                'account_no' => $customer->account_no,
//                                'account_name' => $customer->account_name,
//                                'request_date' => date('Y-m-d H:i:s')
//                            );
//
//                            $refund_request_notify = array(
//                                'from_id' => $customer->customer_id,
//                                'from_name' => $customer->first_name . " " . $customer->last_name,
//                                'to_id' => '0',
//                                'to_name' => 'Administrator',
//                                'message' => "Refund Request To You With Amount :" . $val->payment_price,
//                                'request_type' => '1'
//                            );
//                            $this->db->insert('refund_mst', $refund_request);
//                            $this->db->insert('payout_notify_mst', $refund_request_notify);
//                        }
//
//                        $this->db->update('order_mst', $updateorder, array('order_id' => $val->order_id));
//                        $this->db->update('transaction_mst', $transaction_update, array('order_id' => $val->order_id));
//                        $this->db->insert('order_status_mst', $order_status);
//                        $this->db->insert('order_notify_mst', $order_notify);
//                        $this->db->trans_complete();
//                    }
                }
            }
        }
        echo "order sucessfully tracked";
    }

    function getDtdcTrackStatus($track_code) {
        switch ($track_code) {
            case 'T' :
                $status = "In-transit";
                break;
            case 'O' :
                $status = "Out for Delivery";
                break;
            case 'D' :
                $status = "Delivered";
                break;
            case 'N' :
                $status = "Undelivered";
                break;
            case 'RT' :
                $status = "RTO In-transit";
                break;
            case 'RO' :
                $status = "RTO Out for delivery";
                break;
            case 'R' :
                $status = "RTO Delivered";
                break;
            case 'H' :
                $status = "Heldup";
                break;
        }
        return $status;
    }

    // TRACK ORDER DETAILS

    function getTrackOrderData($order_id) {
        $this->db->select('o.id,o.order_id,o.invoice_id,o.customer_id,selling_price,o.order_date,o.order_status,s.business_name,c.first_name,c.last_name,c.primary_mobile,c.address,c.city,c.pincode,st.state_name');
        $this->db->from('order_mst as o,seller_mst as s,customer_mst as c,state_mst as st');
        $this->db->where('o.seller_id = s.seller_id');
        $this->db->where('o.customer_id = c.customer_id');
        $this->db->where('c.state = st.id');
        $this->db->where('o.order_id', $order_id);
        $query = $this->db->get();
        return $query->row();
    }

    function getTrackOrderStatusData($order_id) {
        $query = $this->db->get_where('order_status_mst', array('order_id' => $order_id));
        return $query->result();
    }

}
