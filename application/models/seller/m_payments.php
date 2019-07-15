<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_payments extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getAllTransaction($seller_id, $start, $end) {
        ($start != "-1") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($start)) : '';
        ($end != "-1") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($end)) : '';
        if (isset($_POST['status'])) {
            ($_POST['status'] != "-1") ? $where['o.order_status'] = $_POST['status'] : '';
        }

        if (isset($where)) {
            $this->db->select('o.order_id,o.order_date,o.order_status,o.sku,o.qty,o.product_name,o.weight,t.selling_price,t.settlement_price,t.shipping_charge,t.cod_charge,t.shipping_charge_reason,p.commission_fee,p.service_fee,p.payment_fee');
            $this->db->from('order_mst as o');
            $this->db->join('transaction_mst as t', 'o.order_id = t.order_id');
            $this->db->join('product_mst as p', 'o.product_id = p.product_id');
            $this->db->where('o.seller_id', $seller_id);
            $this->db->where('o.payment_status', '1');
            $this->db->where($where);
            $query = $this->db->get();
            return $query->result();
        } else {
            $fromDate = date("Y-m-d", strtotime("-1 months"));
            $this->db->select('o.order_id,o.order_date,o.order_status,o.sku,o.qty,o.product_name,o.weight,t.selling_price,t.settlement_price,t.shipping_charge,t.cod_charge,t.shipping_charge_reason,p.commission_fee,p.service_fee,p.payment_fee');
            $this->db->from('order_mst as o');
            $this->db->join('transaction_mst as t', 'o.order_id = t.order_id');
            $this->db->join('product_mst as p', 'o.product_id = p.product_id');
            $this->db->where('o.seller_id', $seller_id);
            $this->db->where('o.payment_status', '1');
            $this->db->where('o.order_date >=', $fromDate);
            $query = $this->db->get();
            return $query->result();
        }
    }

    function getAllPayableData($seller_id) {

        $this->db->select('o.order_id,o.seller_id,o.order_date,o.delivery_date,o.return_date,o.cancel_date,o.order_status,t.selling_price,t.settlement_price,t.shipping_charge,t.cod_charge');
        $this->db->from('order_mst as o');
        $this->db->join('transaction_mst as t', 'o.order_id = t.order_id');
        $this->db->where('o.order_id NOT IN (select order_id from payable_mst)');
        $this->db->where('o.seller_id', $seller_id);
        $this->db->where('o.payment_status', '1');
        $this->db->where_in('o.order_status', array("4", "5", "7", "8", "9"));
        $orders = $this->db->get()->result();

        $total_order = count($orders);
        if ($total_order > 0) {
            $cr_transfer_day = $this->common->returnDay()->cr_transfer_day;
            $dr_transfer_day = $this->common->returnDay()->dr_transfer_day;
            $today_date = date('Y-m-d');
            foreach ($orders as $val) {
                switch ($val->order_status) {
                    case "4":
                        $limitdate = date('Y-m-d', strtotime(date("Y-m-d", strtotime($val->delivery_date)) . " + " . $cr_transfer_day . " days"));
                        $credit = $val->settlement_price - ($val->shipping_charge);
                        $debit = 0;
                        // echo "order_id ".$val->order_id."  "." status ".$val->order_status."  "." delivery date ".$val->delivery_date."  "." limit date ".$limitdate."  "." credit ".$credit."  "." debit ".$debit."<br/>";
                        break;
                    case "5":
                    case "9":
                        $limitdate = date('Y-m-d', strtotime(date("Y-m-d", strtotime($val->return_date)) . " + " . $dr_transfer_day . " days"));
                        $credit = 0;
                        $debit = ($val->selling_price - $val->settlement_price) + $val->shipping_charge;
                        // echo "order_id ".$val->order_id."  "." status ".$val->order_status."  "." return date ".$val->return_date."  "." limit date ".$limitdate."  "." credit ".$credit."  "." debit ".$debit."<br/>";
                        break;
                    case "7":
                        $limitdate = date('Y-m-d', strtotime(date("Y-m-d", strtotime($val->return_date)) . " + " . $dr_transfer_day . " days"));
                        $credit = 0;
                        $debit = $val->shipping_charge;
                        //  echo "order_id ".$val->order_id."  "." status ".$val->order_status."  "." return date ".$val->return_date."  "." limit date ".$limitdate."  "." credit ".$credit."  "." debit ".$debit."<br/>";
                        break;
                    case "8":
                        $limitdate = date('Y-m-d', strtotime(date("Y-m-d", strtotime($val->cancel_date)) . " + " . $dr_transfer_day . " days"));
                        $credit = 0;
                        $debit = $val->shipping_charge;
                        // echo "order_id ".$val->order_id."  "." status ".$val->order_status."  "." cancel date ".$val->cancel_date."  "." limit date ".$limitdate."  "." credit ".$credit."  "." debit ".$debit."<br/>";
                        break;
                    default :
                        break;
                }

                if ($today_date > $limitdate) {
                    $data = array(
                        'seller_id' => $val->seller_id,
                        'order_id' => $val->order_id,
                        'credit' => $credit,
                        'debit' => $debit
                    );


                    $result = $this->isPayableRecordExist($val->order_id);
                    if ($result) {
                        $this->db->insert('payable_mst', $data);
                    } else {
                        $this->db->update('payable_mst', array('credit' => $credit, 'debit' => $debit), array('order_id' => $val->order_id, 'seller_id' => $val->seller_id));
                    }
                }
            }
        }
    }

    function isPayableRecordExist($order_id) {
        $query = $this->db->get_where('payable_mst', array('order_id' => $order_id));
        $rows = $query->num_rows();
        return ($rows == 0) ? true : false;
    }

    function addPayoutRequest() {
        $sellerdata = $this->common->getSellerDataById($this->session->userdata('seller_id'));
        $data = array(
            'seller_id' => $sellerdata->seller_id,
            'account_name' => $sellerdata->account_name,
            'account_no' => $sellerdata->account_no,
            'bank_name' => $sellerdata->bank_name,
            'bank_ifsc' => $sellerdata->bank_ifsc,
            'amount' => $_POST['request'],
            'status' => 0,
            'request_date' => date('Y-m-d')
        );

        $payout_request_notify = array(
            'from_id' => $sellerdata->seller_id,
            'from_name' => $sellerdata->business_name,
            'to_id' => '0',
            'to_name' => "Administrator",
            'message' => "Payment Requested Amount :" . $_POST['request']
        );
        $this->db->insert('payout_request_mst', $data);
        $this->db->insert('payout_notify_mst', $payout_request_notify);
        return 1;
    }

    function getSellerPayoutRequest() {
        $this->db->select('p.request_id,p.request_date,p.account_name,p.account_no,b.bank_name,p.bank_ifsc,p.amount,p.status');
        $this->db->from('payout_request_mst as p');
        $this->db->join('bank_name_mst as b', 'p.bank_name = b.id');
        $this->db->where('p.seller_id', $this->session->userdata("seller_id"));
        $query = $this->db->get();
        return $query->result();
    }

    function payoutRequestDelete($request_id) {
        $this->db->delete('payout_request_mst', array('request_id' => $request_id));
        return 1;
    }

    function payoutRequestSearch($start, $end) {
        ($start != "-1") ? $where['DATE(p.request_date) >='] = date('Y-m-d', strtotime($start)) : '';
        ($end != "-1") ? $where['DATE(p.request_date) <= '] = date('Y-m-d', strtotime($end)) : '';
        ($_POST['amount'] != "") ? $where['p.amount'] = $_POST['amount'] : '';

        $this->db->select('p.request_id,p.request_date,p.account_name,p.account_no,b.bank_name,p.bank_ifsc,p.amount,p.status');
        $this->db->from('payout_request_mst as p');
        $this->db->join('bank_name_mst as b', 'p.bank_name = b.id');
        $this->db->where('p.seller_id', $this->session->userdata("seller_id"));
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    function resetNewPayoutNotify() {
        $this->db->update('payout_notify_mst', array('status' => '1'), array('to_id' => $this->session->userdata('seller_id')));
    }

}
