<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Session extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $session = $this->session->userdata('product');
        $shipping_charge = $this->common->getProductById($_POST['product_id']);
        $cod_charge = $this->common->codCharge();
//        print_r($session);
//        die();
        if (isset($_POST)) {
            $session_data['product'][$_POST['product_id']] = array(
                'product_id' => $_POST['product_id'],
                'colour_id' => isset($_POST['colour_id'])?$_POST['colour_id']:'',
                'qty' => $_POST['qty'],
                'size' => isset($_POST['size'])?$_POST['size']:'',
                'shipping_charge' => $shipping_charge->shipping_charge,
                'cod_charge' => $cod_charge->cod_charge
            );
            if (!$session) {
                $this->session->set_userdata($session_data);
            } else {
                $product_data = array(
                    'product_id' => $_POST['product_id'],
                    'colour_id' => isset($_POST['colour_id'])?$_POST['colour_id']:'',
                    'qty' => $_POST['qty'],
                    'size' => isset($_POST['size'])?$_POST['size']:'',
                    'shipping_charge' => $shipping_charge->shipping_charge,
                    'cod_charge' => $cod_charge->cod_charge
                );
                $session[$_POST['product_id']] = $product_data;
                $this->session->set_userdata('product', $session);
            }
        }
    }
    
    function removeProduct(){
        $product_id = $_POST['product_id'];      
        $session = $this->session->userdata('product');
        unset($session[$product_id]);
        $this->session->set_userdata('product', $session);
    }
    
    function updateProduct(){
        $product_id = $_POST['product_id'];      
        $qty = $_POST['qty'];      
        $session = $this->session->userdata('product');
        $session[$product_id]['qty'] = $qty;
        $this->session->set_userdata('product', $session);
        
    }

    function getSession() {
        echo "<pre>";
        print_r($this->session->all_userdata());        
    }

    function clearSession() {
        $this->session->sess_destroy();
    }

}
