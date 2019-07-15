<?php

class M_others extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('csvimport');

        $this->pathMain = FCPATH . "/upload/expense/";
    }

    function getAllDelivered() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.cod_charge,o.qty,pay_method,commission_fee,payment_fee,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('order_status' => '4', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getAllReturn() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.cod_charge,o.qty,pay_method,order_status,commission_fee,payment_fee,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where('payment_status', '1');
        $this->db->where_in('order_status', array('5', '7'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getAllShippedCancel() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.cod_charge,o.qty,pay_method,order_status,commission_fee,payment_fee,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('order_status' => '8', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getAllCancel() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.cod_charge,o.qty,pay_method,order_status,commission_fee,payment_fee,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('order_status' => '6', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getAllShipped() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.cod_charge,o.qty,pay_method,order_status,commission_fee,payment_fee,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('order_status' => '3', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getAllRefund() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.cod_charge,o.qty,pay_method,order_status,commission_fee,payment_fee,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('order_status' => '9', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    // ----------------------------Fedex Orders --------------------------------

    function getAllFedex() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,o.order_status,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('packing_by' => '1', 'payment_status' => '1'));
        $this->db->where_in('order_status', array('4', '5', '7', '8', '9'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getFedexShipped() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('order_status' => '3', 'packing_by' => '1', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getFedexCancel() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('order_status' => '6', 'packing_by' => '1', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getFedexShippedCancel() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('order_status' => '8', 'packing_by' => '1', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getFedexDelivered() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('order_status' => '4', 'packing_by' => '1', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getFedexReturn() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('packing_by' => '1', 'payment_status' => '1'));
        $this->db->where_in('order_status', array('5', '7'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getFedexRefund() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('order_status' => '9', 'packing_by' => '1', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getFedexCod() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,o.order_status,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('pay_method' => 'cod', 'packing_by' => '1', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getFedexCard() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('pay_method' => 'card', 'packing_by' => '1', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    //-------------------------------India Post Orders ------------------------------------

    function getAllIndiaPost() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,o.order_status,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('packing_by' => '2', 'payment_status' => '1'));
        $this->db->where_in('order_status', array('4', '5', '7', '8', '9'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getIndiaPostShipped() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('order_status' => '3', 'packing_by' => '2', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getIndiaPostCancel() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('order_status' => '6', 'packing_by' => '2', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getIndiaPostShippedCancel() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('order_status' => '8', 'packing_by' => '2', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getIndiaPostDelivered() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('order_status' => '4', 'packing_by' => '2', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getIndiaPostReturn() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('packing_by' => '2', 'payment_status' => '1'));
        $this->db->where_in('order_status', array('5', '7'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getIndiaPostRefund() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('order_status' => '9', 'packing_by' => '2', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getIndiaPostCod() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,o.order_status,o.order_status,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('pay_method' => 'cod', 'packing_by' => '2', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getIndiaPostCard() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('pay_method' => 'card', 'packing_by' => '2', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }
    
    //-------------------------------Dtdc Orders ------------------------------------

    function getAllDtdc() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,o.order_status,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('packing_by' => '3', 'payment_status' => '1'));
        $this->db->where_in('order_status', array('4', '5', '7', '8', '9'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getDtdcShipped() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('order_status' => '3', 'packing_by' => '3', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getDtdcCancel() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('order_status' => '6', 'packing_by' => '3', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getDtdcShippedCancel() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('order_status' => '8', 'packing_by' => '3', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getDtdcDelivered() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('order_status' => '4', 'packing_by' => '3', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getDtdcReturn() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('packing_by' => '3', 'payment_status' => '1'));
        $this->db->where_in('order_status', array('5', '7'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getDtdcRefund() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('order_status' => '9', 'packing_by' => '3', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getDtdcCod() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,o.order_status,o.order_status,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('pay_method' => 'cod', 'packing_by' => '3', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getDtdcCard() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->where(array('pay_method' => 'card', 'packing_by' => '3', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }
    
    // ---------------------------------payumoney orders------------------------------------

    function getpayumoneyOrders() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        $this->db->select('order_date,order_id,payment_price,payumoney_payment');
        $this->db->from('order_mst');
        $this->db->where(array('pay_method' => 'card', 'payment_status' => '1'));
        isset($where) ? $this->db->where($where) : "";
        $query = $this->db->get();
        return $query->result();
    }

    function getCAReport() {
        $this->db->select('o.order_date,o.order_id,o.order_status,s.business_name,c.first_name,c.last_name,total_price,payment_price,o.cod_charge,o.qty,o.selling_price,pay_method,commission_fee,payment_fee,service_fee,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->join('customer_mst as c', 'o.customer_id = c.customer_id');
        $this->db->join('seller_mst as s', 'o.seller_id = s.seller_id');
        $this->db->where('payment_status', '1');
        $this->db->where_in('order_status', array('4', '5', '7', '8', '9'));
        $query = $this->db->get();
        return $query->result();
    }

    function getCAReportSearch() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(o.order_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(o.order_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
            ($_POST['status'] != "-1") ? $where['o.order_status'] = $_POST['status'] : '';
        }

        $this->db->select('o.order_date,o.order_id,o.order_status,s.business_name,c.first_name,c.last_name,total_price,payment_price,o.cod_charge,o.qty,o.selling_price,pay_method,commission_fee,payment_fee,service_fee,t.shipping_charge');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'p.product_id = o.product_id');
        $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
        $this->db->join('customer_mst as c', 'o.customer_id = c.customer_id');
        $this->db->join('seller_mst as s', 'o.seller_id = s.seller_id');
        $this->db->where('payment_status', '1');
        isset($where) ? $this->db->where($where) : $this->db->where_in('order_status', array('4', '5', '7', '8', '9'));
        $query = $this->db->get();
        return $query->result();
    }

    //--------------------------------Payment Received--------------------------------
    // Payment By :  1 - Fedex ; 2 - India Post ; 3 - Payumoney ; 4 - Dtdc

    function receivePayment($payment_by) {
        if (isset($_POST['allOrders'])) {
            $orders = $_POST['allOrders'];
            $orderid = implode(",", $orders);
            $payment_date = $_POST['payment_date'];
            $payment_amount = $_POST['payment_amount'];
            $payment_method = $_POST['payment_method'];
            $payment_details = $_POST['payment_details'];

            foreach ($orders as $val) {
                if ($payment_by == "3") {
                    $this->updatePayumoneyPayment($val);
                } else {
                    $this->updateReceivePayment($val);
                }
            }

            $paymentData = array(
                'payment_date' => date('Y-m-d', strtotime($payment_date)),
                'payment_amount' => $payment_amount,
                'payment_method' => $payment_method,
                'payment_details' => $payment_details,
                'orders_id' => $orderid,
                'payment_by' => $payment_by
            );
            $this->db->insert('payment_mst', $paymentData);
            return 1;
        } else {
            return 0;
        }
    }

    function updateReceivePayment($order_id) {
        $this->db->update('order_mst', array('cod_payment' => '1'), array('order_id' => $order_id));
        return 1;
    }

    function updatePayumoneyPayment($order_id) {
        $this->db->update('order_mst', array('payumoney_payment' => '1'), array('order_id' => $order_id));
        return 1;
    }

    //---------------------------------Pay Expense----------------------------------

    function payExpense($payment_by) {
        if (isset($_POST['allOrders'])) {
            $orders = $_POST['allOrders'];
            $orderid = implode(",", $orders);

            $invoice_date = $_POST['invoice_date'];
            $invoice_no = $_POST['invoice_no'];
            $payment_date = $_POST['payment_date'];
            $payment_amount = $_POST['payment_amount'];
            $payment_method = $_POST['payment_method'];
            $payment_details = $_POST['payment_details'];

            foreach ($orders as $val) {
                $this->updatePayExpense($val);
            }

            $expenseData = array(
                'invoice_date' => date('Y-m-d', strtotime($invoice_date)),
                'invoice_no' => date('Y-m-d', strtotime($invoice_no)),
                'payment_date' => date('Y-m-d', strtotime($payment_date)),
                'payment_amount' => $payment_amount,
                'payment_method' => $payment_method,
                'payment_details' => $payment_details,
                'orders_id' => $orderid,
                'payment_by' => $payment_by
            );
            $this->db->insert('expense_mst', $expenseData);
            return 1;
        } else {
            return 0;
        }
    }

    function updatePayExpense($order_id) {
        $this->db->update('order_mst', array('expense_payment' => '1'), array('order_id' => $order_id));
        return 1;
    }

    //--------------------------------Payment Master--------------------------------

    function fedexPayments() {
        $query = $this->db->get_where('payment_mst', array('payment_by' => '1'));
        return $query->result();
    }

    function fedexPaymentDelete($id) {
        $query = $this->db->get_where('payment_mst', array('id' => $id));
        $data = $query->row();
        $this->db->trans_start();
        if (isset($data->id)) {
            $orders = explode(",", $data->orders_id);
            foreach ($orders as $order_id) {
                $this->db->update('order_mst', array('cod_payment' => '0'), array('order_id' => $order_id));
            }
            $this->db->delete('payment_mst', array('id' => $id));
        }
        $this->db->trans_complete();
    }

    function indiapostPayments() {
        $query = $this->db->get_where('payment_mst', array('payment_by' => '2'));
        return $query->result();
    }

    function indiapostPaymentDelete($id) {
        $query = $this->db->get_where('payment_mst', array('id' => $id));
        $data = $query->row();
        $this->db->trans_start();
        if (isset($data->id)) {
            $orders = explode(",", $data->orders_id);
            foreach ($orders as $order_id) {
                $this->db->update('order_mst', array('cod_payment' => '0'), array('order_id' => $order_id));
            }
            $this->db->delete('payment_mst', array('id' => $id));
        }
        $this->db->trans_complete();
    }
    
    function dtdcPayments() {
        $query = $this->db->get_where('payment_mst', array('payment_by' => '4'));
        return $query->result();
    }

    function dtdcPaymentDelete($id) {
        $query = $this->db->get_where('payment_mst', array('id' => $id));
        $data = $query->row();
        $this->db->trans_start();
        if (isset($data->id)) {
            $orders = explode(",", $data->orders_id);
            foreach ($orders as $order_id) {
                $this->db->update('order_mst', array('cod_payment' => '0'), array('order_id' => $order_id));
            }
            $this->db->delete('payment_mst', array('id' => $id));
        }
        $this->db->trans_complete();
    }

    function payumoneyPayments() {
        $query = $this->db->get_where('payment_mst', array('payment_by' => '3'));
        return $query->result();
    }

    function payumoneyPaymentDelete($id) {
        $query = $this->db->get_where('payment_mst', array('id' => $id));
        $data = $query->row();
        $this->db->trans_start();
        if (isset($data->id)) {
            $orders = explode(",", $data->orders_id);
            foreach ($orders as $order_id) {
                $this->db->update('order_mst', array('payumoney_payment' => '0'), array('order_id' => $order_id));
            }
            $this->db->delete('payment_mst', array('id' => $id));
        }
        $this->db->trans_complete();
    }

    function paymentOrdersView($id) {
        $query = $this->db->get_where('payment_mst', array('id' => $id));
        $data = $query->row();
        if (isset($data->id)) {
            $orders = explode(",", $data->orders_id);
            $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
            $this->db->from('order_mst as o');
            $this->db->join('product_mst as p', 'p.product_id = o.product_id');
            $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
            $this->db->where(array('payment_status' => '1'));
            $this->db->where_in('o.order_id', $orders);
            $query = $this->db->get();
            return $query->result();
        }
    }

    //-----------------------Expense Payment Master----------------------------    

    function fedexExpenses() {
        $query = $this->db->get_where('expense_mst', array('payment_by' => '1'));
        return $query->result();
    }

    function fedexExpenseDelete($id) {
        $query = $this->db->get_where('expense_mst', array('id' => $id));
        $data = $query->row();
        $this->db->trans_start();
        if (isset($data->id)) {
            $orders = explode(",", $data->orders_id);
            foreach ($orders as $order_id) {
                $this->db->update('order_mst', array('expense_payment' => '0'), array('order_id' => $order_id));
            }
            $this->db->delete('expense_mst', array('id' => $id));
        }
        $this->db->trans_complete();
    }

    function indiapostExpenses() {
        $query = $this->db->get_where('expense_mst', array('payment_by' => '2'));
        return $query->result();
    }

    function indiapostExpenseDelete($id) {
        $query = $this->db->get_where('expense_mst', array('id' => $id));
        $data = $query->row();
        $this->db->trans_start();
        if (isset($data->id)) {
            $orders = explode(",", $data->orders_id);
            foreach ($orders as $order_id) {
                $this->db->update('order_mst', array('expense_payment' => '0'), array('order_id' => $order_id));
            }
            $this->db->delete('expense_mst', array('id' => $id));
        }
        $this->db->trans_complete();
    }
    
    function dtdcExpenses() {
        $query = $this->db->get_where('expense_mst', array('payment_by' => '3'));
        return $query->result();
    }

    function dtdcExpenseDelete($id) {
        $query = $this->db->get_where('expense_mst', array('id' => $id));
        $data = $query->row();
        $this->db->trans_start();
        if (isset($data->id)) {
            $orders = explode(",", $data->orders_id);
            foreach ($orders as $order_id) {
                $this->db->update('order_mst', array('expense_payment' => '0'), array('order_id' => $order_id));
            }
            $this->db->delete('expense_mst', array('id' => $id));
        }
        $this->db->trans_complete();
    }

    function expensesOrdersView($id) {
        $query = $this->db->get_where('expense_mst', array('id' => $id));
        $data = $query->row();
        if (isset($data->id)) {
            $orders = explode(",", $data->orders_id);
            $this->db->select('o.order_date,o.order_id,total_price,payment_price,o.awb_no,o.cod_charge,pay_method,cod_payment,expense_payment,t.shipping_charge');
            $this->db->from('order_mst as o');
            $this->db->join('product_mst as p', 'p.product_id = o.product_id');
            $this->db->join('transaction_mst as t', 't.order_id = o.order_id');
            $this->db->where(array('payment_status' => '1'));
            $this->db->where_in('o.order_id', $orders);
            $query = $this->db->get();
            return $query->result();
        }
    }

    //--------------------------------Seller Balance Master -----------------------------

    function getAllSellers() {
        $this->db->select('seller_id,first_name,last_name,business_name,primary_email,primary_mobile,pickup_city,group_name,status,reg_date');
        $this->db->from('seller_mst as s');
        $this->db->join('sellergroup_mst as sg', 's.group_id = sg.group_id');
        $this->db->join('login_mst as l', 's.primary_email = l.email');
        $query = $this->db->get();
        return $query->result();
    }

    function sellerSearch() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(reg_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(reg_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
            ($_POST['first_name'] != "") ? $where['first_name'] = $_POST['first_name'] : '';
            ($_POST['last_name'] != "") ? $where['last_name'] = $_POST['last_name'] : '';
            ($_POST['primary_mobile'] != "") ? $where['primary_mobile'] = $_POST['primary_mobile'] : '';
            ($_POST['primary_email'] != "") ? $where['primary_email'] = $_POST['primary_email'] : '';
            ($_POST['pickup_city'] != "") ? $where['pickup_city'] = $_POST['pickup_city'] : '';
            ($_POST['status'] != "-1") ? $where['status'] = $_POST['status'] : '';
        }
        if (isset($where)) {
            $this->db->select('seller_id,first_name,last_name,business_name,primary_email,primary_mobile,pickup_city,group_name,status,reg_date');
            $this->db->from('seller_mst as s');
            $this->db->join('sellergroup_mst as sg', 's.group_id = sg.group_id');
            $this->db->join('login_mst as l', 's.primary_email = l.email');
            $this->db->where($where);
            $query = $this->db->get();
            return $query->result();
        } else {
            $this->db->select('seller_id,first_name,last_name,business_name,primary_email,primary_mobile,pickup_city,group_name,status,reg_date');
            $this->db->from('seller_mst as s');
            $this->db->join('sellergroup_mst as sg', 's.group_id = sg.group_id');
            $this->db->join('login_mst as l', 's.primary_email = l.email');
            $query = $this->db->get();
            return $query->result();
        }
    }

    //--------------------------------Admin Expense Master----------------------------

    function getAllExpenseData() {
        $query = $this->db->get('admin_expense_mst');
        return $query->result();
    }

    function getSearchExpenseData() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(expense_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(expense_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
            ($_POST['name'] != "") ? $where['name'] = $_POST['name'] : '';
            ($_POST['shopname'] != "") ? $where['shopname'] = $_POST['shopname'] : '';
            ($_POST['amount'] != "") ? $where['amount'] = $_POST['amount'] : '';
        }
        if (isset($where)) {
            $query = $this->db->get_where('admin_expense_mst', $where);
        } else {
            $query = $this->db->get('admin_expense_mst');
        }
        return $query->result();
    }

    function getExpenseData() {
        $expense_id = base64_decode($this->input->get('id'));
        $query = $this->db->get_where('admin_expense_mst', array('expense_id' => $expense_id));
        return $query->row();
    }

    function addExpenseData() {

        $data = array(
            'expense_date' => date('Y-m-d', strtotime($this->input->post('expense_date'))),
            'name' => $this->input->post('name'),
            'shopname' => $this->input->post('shopname'),
            'amount' => $this->input->post('amount'),
        );

        $this->db->insert('admin_expense_mst', $data);
        $expense_id = $this->db->insert_id();

        if (($_FILES['expense_proof']['error'] != '4')) {
            $expensefile = $expense_id . '_expense.jpg';
            $this->common->do_upload('expense_proof', $this->pathMain, $expensefile, TRUE);
            $data = array(
                'expense_proof' => base_url() . "upload/expense/" . $expensefile,
            );
            $this->db->update('admin_expense_mst', $data, array('expense_id' => $expense_id));
        }
        return 1;
    }

    function updateExpenseData() {

        $expense_id = $this->input->post('expense_id');
        $data = array(
            'expense_date' => date('Y-m-d', strtotime($this->input->post('expense_date'))),
            'name' => $this->input->post('name'),
            'shopname' => $this->input->post('shopname'),
            'amount' => $this->input->post('amount'),
        );
        $this->db->update('admin_expense_mst', $data, array('expense_id' => $expense_id));

        if (($_FILES['expense_proof']['error'] != '4')) {
            $expensefile = $expense_id . '_expense.jpg';
            $this->common->do_upload('expense_proof', $this->pathMain, $expensefile, TRUE);
            $data = array(
                'expense_proof' => base_url() . "upload/expense/" . $expensefile,
            );
            $this->db->update('admin_expense_mst', $data, array('expense_id' => $expense_id));
        }
        return 1;
    }

    function deleteExpenseData() {

        if ($this->input->post('allExpense') != "") {
            $expense_ids = implode(",", $this->input->post('allExpense'));

            $this->db->from('admin_expense_mst');
            $this->db->where_in('expense_id', $expense_ids);
            $data = $this->db->get()->result();

            foreach ($data as $val) {

                $endproof = end((explode('/', $val->expense_proof)));

                if (file_exists($this->pathMain . $endproof)) {
                    unlink($this->pathMain . $endproof);
                }

                $this->db->delete('admin_expense_mst', array('expense_id' => $val->expense_id));
            }
        }
        return 1;
    }

    //--------------------------------Profit / Loss  Master----------------------------

    function getAllRevenueData() {
        $query = $this->db->get('revenue_mst');
        return $query->result();
    }

    function getSearchRevenueData() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(reg_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(reg_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
            ($_POST['order_id'] != "") ? $where['order_id'] = $_POST['order_id'] : '';
        }
        (isset($where)) ? $this->db->where($where) : "";
        $query = $this->db->get('revenue_mst');
        return $query->result();
    }

    function getRevenueData() {
        $revenue_id = base64_decode($this->input->get('id'));
        $query = $this->db->get_where('revenue_mst', array('revenue_id' => $revenue_id));
        return $query->row();
    }

    function addRevenueData() {
        $post = $this->input->post();
        $orderexist = $this->isOrderExist($post['order_id']);
        if ($orderexist) {
            $revenueexist = $this->isRevenueExist($post['order_id']);
            if ($revenueexist == 0) {
                $data = array(
                    'reg_date' => date('Y-m-d', strtotime($post['reg_date'])),
                    'order_id' => $post['order_id'],
                    'profit' => $post['profit'],
                    'loss' => $post['loss']
                );
                $this->db->insert('revenue_mst', $data);
                return "RI";
            } else {
                return "RE";
            }
        } else {
            return "NE";
        }
    }

    function updateRevenueData() {
        $post = $this->input->post();
        $revenue_id = $post['revenue_id'];
        $data = array(
            'reg_date' => date('Y-m-d', strtotime($post['reg_date'])),
            'order_id' => $post['order_id'],
            'profit' => $post['profit'],
            'loss' => $post['loss']
        );
        $this->db->update('revenue_mst', $data, array('revenue_id' => $revenue_id));
        return 1;
    }

    function deleteRevenueData() {
        if ($this->input->post('allRevenue') != "") {
            $revenue_ids = $this->input->post('allRevenue');
            $this->db->where_in('revenue_id', $revenue_ids);
            $this->db->delete('revenue_mst');
        }
        return 1;
    }

    function isOrderExist($order_id) {
        $query = $this->db->get_where('order_mst', array('order_id' => $order_id));
        return $query->num_rows();
    }

    function isRevenueExist($order_id) {
        $query = $this->db->get_where('revenue_mst', array('order_id' => $order_id));
        return $query->num_rows();
    }

    function totalExpense() {
        $this->db->select('sum(amount) as total');
        $query = $this->db->get('admin_expense_mst');
        return isset($query->row()->total) ? $query->row()->total : '0';
    }
    
    //--------------------------------Courier Profit / Loss  Master----------------------------

    function getAllCourierData() {
        $query = $this->db->get('courier_revenue_mst');
        return $query->result();
    }

    function getSearchCourierData() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(reg_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(reg_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
        }
        (isset($where)) ? $this->db->where($where) : "";
        $query = $this->db->get('courier_revenue_mst');
        return $query->result();
    }

    function getCourierData() {
        $id = base64_decode($this->input->get('id'));
        $query = $this->db->get_where('courier_revenue_mst', array('id' => $id));
        return $query->row();
    }

    function addCourierData() {
        $post = $this->input->post();
        $data = array(
            'reg_date' => date('Y-m-d', strtotime($post['reg_date'])),
            'orders' => $post['orders'],
            'amount' => $post['amount'],
            'type' => $post['type']
        );
         $this->db->insert('courier_revenue_mst', $data);
    }

    function updateCourierData() {
        $post = $this->input->post();
        $id = $post['id'];
        $data = array(
            'reg_date' => date('Y-m-d', strtotime($post['reg_date'])),
            'orders' => $post['orders'],
            'amount' => $post['amount'],
            'type' => $post['type']
        );
        $this->db->update('courier_revenue_mst', $data, array('id' => $id));
        return 1;
    }

    function deleteCourierData() {
        if ($this->input->post('allCourier') != "") {
            $revenue_ids = $this->input->post('allCourier');
            $this->db->where_in('id', $revenue_ids);
            $this->db->delete('courier_revenue_mst');
        }
        return 1;
    }

    
    //----------------------------------Bulk Sms Master----------------------------

    function smsContactImport() {
        if ($_FILES['csvfile']['error'] != 4) {
            $pathMain = FCPATH . "/upload/csv/";

            $filename = $_FILES['csvfile']['name'];
            $result = $this->common->do_upload('csvfile', $pathMain, $filename);
            $file_path = $result['upload_data']['full_path'];

            $rows = array();

            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                    if (isset($row['mobile_no'])) {
                        if (strlen($row['mobile_no']) == 10) {
                            if ($this->isContactExist($row['mobile_no']) == 0) {
                                $set = array(
                                    'name' => ($row['name'] != "") ? $row['name'] : "-",
                                    'mobile_no' => ($row['mobile_no'] != "") ? $row['mobile_no'] : "-",
                                    'city' => ($row['city'] != "") ? $row['city'] : "-",
                                    'group' => ($row['group'] != "") ? $row['group'] : "-",
                                    'position' => ($row['position'] != "") ? $row['position'] : "-",
                                );
                                if (!in_array("-", $set)) {
                                    $rows[] = $set;
                                }
                            }
                        }
                    }
                }
                if (count($rows) > 0) {
                    $this->db->insert_batch('bulksms_mst', $rows);
                }
                unlink($file_path);
                header('location:' . site_url() . 'admin/others/bulkSms?msg=S');
            } else {
                header('location:' . site_url() . 'admin/others/bulkSms?msg=F');
            }
        }
    }

    function isContactExist($mobileno) {
        $query = $this->db->get_where('bulksms_mst', array('mobile_no' => $mobileno));
        return $query->num_rows();
    }

    function getBulkSmsContact() {
        $query = $this->db->get('bulksms_mst');
        return $query->result();
    }

    function getPosition() {
        $this->db->distinct();
        $this->db->select('position');
        $query = $this->db->get('bulksms_mst');
        return $query->result();
    }

    function getGroup() {
        $this->db->distinct();
        $this->db->select('group');
        $query = $this->db->get('bulksms_mst');
        return $query->result();
    }

    function getContactMobile() {
        $this->db->select('mobile_no');
        $query = $this->db->get_where('bulksms_mst', array('position' => $_POST['position'], 'group' => $_POST['group']));
        $data = $query->result();
        $mobile = array();
        foreach ($data as $val) {
            $mobile[] = $val->mobile_no;
        }
        return implode(",", $mobile);
    }

}
