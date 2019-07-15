<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->customer_logged_in()) {
            header('location:' . site_url());
        } else {
            $this->customer_id = $this->session->userdata('customer_id');
            $this->load->model('buyer/m_order', 'order');
            $this->load->helper('download');
            $this->load->library('zip');
            $this->load->library('dompdf_gen');
        }
    }

    function index() {
        $data['rorders'] = $this->order->getRecentOrderData($this->customer_id);
        $data['porders'] = $this->order->getPastOrderData($this->customer_id);
        $data['customer'] = $this->common->getCustomerDataById($this->customer_id);
        $data['bankname'] = $this->common->getAllBank();
        $this->load->view('buyer/header');
        $this->load->view('buyer/order/myorder', $data);
        $this->load->view('buyer/footer');
    }

    function cancelOrder() {
        $this->order->cancelOrder();
        header("location:" . site_url() . "buyer/order?msg=C");
    }

    function returnOrder() {
        $this->order->returnOrder();
        header('location:' . site_url() . 'buyer/order?msg=R');
    }

    function getProductRate() {
        $data = $this->order->getProductRate();
        echo $data->prate . "|" . $data->preview;
    }

    function setProductRate() {
        $result = $this->order->setProductRate();
        echo $result;
    }

    function returnOrderList() {
        $data['orders'] = $this->order->getReturnOrderData($this->customer_id);
        $data['packuporders'] = $this->order->getReturnPackUpOrderData($this->customer_id);
        $data['pickuporders'] = $this->order->getReturnPickUpOrderData($this->customer_id);
        $data['completeorders'] = $this->order->getReturnCompleteOrderData($this->customer_id);
        $this->load->view('buyer/header');
        $this->load->view('buyer/order/return_order', $data);
        $this->load->view('buyer/footer');
    }

    function packSlip() {
        $order_id = $_POST['order_id'];
        $this->order->packOrder($order_id);
        $order = $this->order->getPackSlipData($order_id);
        $result = $this->order->getFedexSlipData($order);
        echo ($result) ? "Success" : "Fail";
    }

    function packSlipIndiaPost() {
        $order_id = $_POST['order_id'];
        $tracking_id = $_POST['tracking_id'];
        $packing_id = $this->order->packOrder($order_id);
        $order = $this->order->getPackSlipData($order_id);
        $result = $this->order->getIndiaPostSlipData($order, $tracking_id);
        echo ($result) ? "Success" : "Fail";
    }

    function pickupSlip() {
        $order_id = $_POST['order_id'];
        $order = $this->order->getPackSlipData($order_id);
        $total_weight = $order->weight / 1000;
        $result = $this->order->getFedexPickupData($order, $total_weight);
        echo ($result) ? "Success" : "Fail";
    }

//    function downloadSlip() {
//        $order_id = base64_decode($this->input->get('id'));
//        $data['order'] = $this->order->getPackSlipData($order_id);
//        if ($data['order']->packing_by == 1) {
//            $filename = $data['order']->packing_id . "_return.pdf";
//            $printout = $this->load->view('buyer/print/pack_slip_fedex', $data, true);
//        }
//        //echo $printout;
//        $this->dompdf->load_html($printout);
//        $this->dompdf->render();
//        $pdf = $this->dompdf->output();
//        force_download($filename, $pdf, true);
//    }

    function downloadSlip() {
        $order_id = base64_decode($this->input->get('id'));
        $file_ship = FCPATH . 'upload/fedexreturnslip/' . $order_id . '_SHIP.PDF';
        $this->zip->read_file($file_ship);
        $this->zip->download('Packup.zip');
    }

    function downloadDTDCSlip() {
        $order_id = base64_decode($this->input->get('id'));
        $data['order'] = $this->order->getPackSlipData($order_id);
        $filename = $data['order']->order_id . "_return.pdf";
        $printout = $this->load->view('buyer/print/pack_slip_dtdc', $data, true);
        //echo $printout;
        $this->dompdf->load_html($printout);
        $this->dompdf->render();
        $pdf = $this->dompdf->output();
        force_download($filename, $pdf, true);
    }

    function Invoices() {
        $data['invoices'] = $this->order->getDeliveryOrders($this->customer_id);
        $this->load->view('buyer/header');
        $this->load->view('buyer/order/invoices', $data);
        $this->load->view('buyer/footer');
    }

}
