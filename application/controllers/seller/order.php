<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->seller_logged_in()) {
            header('location:' . site_url());
        }
        $this->load->model('seller/m_order', 'order');
        $this->load->helper('download');
        $this->load->library('zip');
        $this->load->library('dompdf_gen');
    }

    function active() {
        $seller_id = $this->common->getSellerId($this->session->userdata('seller_primary_email'));
        $data['pack'] = $this->order->getToPackOrderData($seller_id);
        $data['pickup'] = $this->order->getToPickUpOrderData($seller_id);
        $data['dispatch'] = $this->order->getToDispatchOrderData($seller_id);
        $data['handover'] = $this->order->getToHandoverOrderData($seller_id);
        $this->load->view('seller/header');
        $this->load->view('seller/order/active', $data);
        $this->load->view('seller/footer');
    }

    function cancel() {
        $seller_id = $this->common->getSellerId($this->session->userdata('seller_primary_email'));
        $data['cancel'] = $this->order->getCancelOrderData($seller_id);
        $this->load->view('seller/header');
        $this->load->view('seller/order/cancel', $data);
        $this->load->view('seller/footer');
    }

    function track() {
        $seller_id = $this->common->getSellerId($this->session->userdata('seller_primary_email'));
        $data['shipped'] = $this->order->getShippedOrderData($seller_id);
        $data['delivered'] = $this->order->getDeliveredOrderData($seller_id);
        $this->load->view('seller/header');
        $this->load->view('seller/order/track', $data);
        $this->load->view('seller/footer');
    }

    function returns() {
        $seller_id = $this->common->getSellerId($this->session->userdata('seller_primary_email'));
        $data['return'] = $this->order->getReturnOrderData($seller_id);
        $this->load->view('seller/header');
        $this->load->view('seller/return/return', $data);
        $this->load->view('seller/footer');
    }

    function replace() {
        $seller_id = $this->common->getSellerId($this->session->userdata('seller_primary_email'));
        $data['replace'] = $this->order->getReplaceOrderData($seller_id);
        $this->load->view('seller/header');
        $this->load->view('seller/return/replace', $data);
        $this->load->view('seller/footer');
    }

    function refund() {
        $seller_id = $this->common->getSellerId($this->session->userdata('seller_primary_email'));
        $data['refund'] = $this->order->getRefundOrderData($seller_id);
        $this->load->view('seller/header');
        $this->load->view('seller/return/refund', $data);
        $this->load->view('seller/footer');
    }

    function getTrackingId() {
        $post = $this->input->post();
        $trackingid = $this->order->getTrackingId($post);
        echo $trackingid;
    }

    function slip() {
        $data['order'] = $this->order->getPackSlipData("1000000022");
        $this->load->view('seller/print/pack_slip_dtdc', $data);
    }

    // PACK ORDER FOR COURIOR DTDC AND INDIA POST

    function packOrder() {
        $post = $this->input->post();
        $result = $this->order->getPackOrderData($post);
        echo $result;
    }

    // PACK ORDER FOR COURIOR FEDEX AND ALSO PICKUP

    function packSlip() {
        $order_id = $this->input->post('order_id');
        $this->order->packOrder($order_id);
        $order = $this->order->getPackSlipData($order_id);
        $result = $this->order->getFedexSlipData($order);
        echo ($result) ? "Success" : "Fail";
    }

    function pickupSlip() {
        $order_id = $_POST['order_id'];
        $total_weight += 0;
        $orders = $this->order->getPackSlipData($order_id);
        foreach ($orders as $order) {
            $total_weight += $order->weight;
            $total_weight = $total_weight / 1000;
        }
        $result = $this->order->getFedexPickupData($orders, $total_weight);
        echo ($result) ? "Success" : "Fail";
    }

    // DOWNLOAD ALL COURIOR PACK SLIP 

    function downloadSlip() {
        $order_id = base64_decode($this->input->get('id'));
        $data['order'] = $this->order->getPackSlipData($order_id);
        if ($data['order']->packing_by == 1) {
            if ($data['order']->pay_method == "cod") {
                $file_ship = FCPATH . 'upload/fedexslip/' . $order_id . '_SHIP.PDF';
                $file_cod = FCPATH . 'upload/fedexslip/' . $order_id . '_COD.PDF';
                $this->zip->read_file($file_ship);
                $this->zip->read_file($file_cod);
                $this->zip->download('Packup.zip');
            } else {
                $file_ship = FCPATH . 'upload/fedexslip/' . $order_id . '_SHIP.PDF';
                $this->zip->read_file($file_ship);
                $this->zip->download('Packup.zip');
            }
        } else if ($data['order']->packing_by == 2) {
            $filename = $data['order']->packing_id . ".pdf";
            $printout = $this->load->view('seller/print/pack_slip_indiapost', $data, true);
            $this->dompdf->load_html($printout);
            $this->dompdf->render();
            $pdf = $this->dompdf->output();
            force_download($filename, $pdf, true);
        } else if ($data['order']->packing_by == 3) {
            $filename = $data['order']->packing_id . ".pdf";
            $printout = $this->load->view('seller/print/pack_slip_dtdc', $data, true);
            $this->dompdf->load_html($printout);
            $this->dompdf->render();
            $pdf = $this->dompdf->output();
            force_download($filename, $pdf, true);
        }
    }

    // SET ORDER IN IN-TRANSITE

    function setInTransite() {
        $order_id = base64_decode($this->input->get('id'));
        $this->order->setInTransite($order_id);
        header("location:" . site_url() . "seller/order/active?msg=S");
    }

    // RESET SELLER HEADER NOTIFICATION 

    function resetNewOrderNotify() {
        $this->order->resetNewOrderNotify();
        return 1;
    }

    function resetCancelOrderNotify() {
        $this->order->resetCancelOrderNotify();
        return 1;
    }

    function resetReturnOrderNotify() {
        $this->order->resetReturnOrderNotify();
        return 1;
    }

    function resetReplaceOrderNotify() {
        $this->order->resetReplaceOrderNotify();
        return 1;
    }

    function dtdcsheet() {
        $post = $this->input->post();
        $data['orders'] = $this->order->dtdcSheetOrder($post);        
        $printout = $this->load->view('seller/print/dtdc_mainfeast', $data, true);        
        $this->dompdf->load_html($printout);
        $this->dompdf->render();
        $pdf = $this->dompdf->output();
        force_download("manifest.pdf", $pdf, true);
    }

}
