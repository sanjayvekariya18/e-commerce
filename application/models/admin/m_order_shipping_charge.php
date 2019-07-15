<?php

class M_order_shipping_charge extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAllTransaction($start, $end) {
        ($start != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($start)) : '';
        ($end != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($end)) : '';
        ($_POST['order_id'] != "") ? $where['o.order_id'] = $_POST['order_id'] : '';
        ($_POST['selling_price'] != "") ? $where['t.selling_price'] = $_POST['selling_price'] : '';

        $this->db->select('o.order_id,o.order_date,o.order_status,o.awb_no,o.shipping_update,t.selling_price,t.shipping_charge,t.cod_charge,s.business_name,c.first_name,c.last_name,ro.awb_no as return_awb_no');
        $this->db->from('order_mst as o');
        $this->db->join('transaction_mst as t', 'o.order_id = t.order_id');
        $this->db->join('seller_mst as s', 'o.seller_id = s.seller_id');
        $this->db->join('customer_mst as c', 'o.customer_id = c.customer_id');
        $this->db->join('return_order_mst as ro', 'o.order_id = ro.order_id', 'left outer');
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->result();
        foreach ($result as $val) {
            $val->payable = ($this->isPayableRecordExist($val->order_id) ? 1 : 0);
        }
        return $result;
    }

    function updateShippingCharge($order_id, $shipping_charge, $shipping_charge_reason) {
        $set = array(
            'shipping_charge' => $shipping_charge,
            'shipping_charge_reason' => $shipping_charge_reason
        );
        $this->db->update('transaction_mst', $set, array('order_id' => $order_id));
        $this->db->update('order_mst', array('shipping_update' => '1'), array('order_id' => $order_id));

        // IF ALREADY PAYMENT RECEIVED THEN CREDIT / EXPENCE PAID THEN DEBIT
        $order = $this->common->getOrderById($order_id);

        if ($order->order_status == "4") {
            if ($order->pay_method == "cod" && $order->cod_payment) {
                $this->orderPayment($order_id);
            } else if ($order->pay_method == "card" && $order->payumoney_payment) {
                $this->orderPayment($order_id);
            }
        } else if ($order->order_status == "5" || $order->order_status == "8") {
            $this->orderPayment($order_id);
        }
        return 1;
    }

    function orderPayment($order_id) {
        $this->db->select('o.order_id,o.seller_id,o.order_date,o.delivery_date,o.return_date,o.cancel_date,o.order_status,t.selling_price,t.settlement_price,t.shipping_charge,t.cod_charge');
        $this->db->from('order_mst as o');
        $this->db->join('transaction_mst as t', 'o.order_id = t.order_id');
        $this->db->where('o.order_id NOT IN (select order_id from payable_mst)');
        $this->db->where('o.payment_status', '1');
        $this->db->where('o.order_id', $order_id);
        $order = $this->db->get()->row();

        switch ($order->order_status) {
            case "1":
            case "2":
            case "3":
            case "4":
                $credit = $order->settlement_price - ($order->shipping_charge + $order->cod_charge);
                $debit = 0;
                break;
            case "5":
            case "9":
                $credit = 0;
                $debit = ($order->selling_price - $order->settlement_price) + $order->shipping_charge + $order->cod_charge;
                break;
            case "7":
            case "8":
                $credit = 0;
                $debit = $order->shipping_charge + $order->cod_charge;
                break;
            default :
                break;
        }

        $data = array(
            'seller_id' => $order->seller_id,
            'order_id' => $order->order_id,
            'credit' => $credit,
            'debit' => $debit
        );

        $result = $this->isPayableRecordExist($order->order_id);
        if ($result) {
            $this->db->insert('payable_mst', $data);
            return 1;
        } else {
            return 0;
        }
    }

    function isPayableRecordExist($order_id) {
        $query = $this->db->get_where('payable_mst', array('order_id' => $order_id));
        $rows = $query->num_rows();
        return ($rows == 0) ? true : false;
    }

}
