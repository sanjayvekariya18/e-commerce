<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cart extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->siteStatus()) {
            header('location:' . site_url() . 'error');
        }
        $this->load->model('website/m_cart', 'ocart');
    }

    function index() {
        $this->load->view('website/header');
        $this->load->view('website/cart');
        $this->load->view('website/footer');
    }

    function email_valid() {
        $result = $this->common->email_valid($this->input->post('email'));
        echo $result;
    }

    function checkPincode() {
        $pincode = $this->input->post('pincode');
        $result = $this->common->checkPincodeAll($pincode);
        echo $result;
    }

    function getCustomer() {
        $primary_email = $this->input->post('primary_email');
        $customer_data = $this->common->getCustomerData($primary_email);
        echo json_encode($customer_data);
    }

    function addOrder() {
        $result = $this->ocart->addOrder();
        echo base64_encode($result);
    }

    function payment() {
        $cart_id = base64_decode($this->input->get('id'));
        $data['order'] = $this->ocart->getCartData($cart_id);
        $this->load->view('website/header');
        $this->load->view('website/payment', $data);
        $this->load->view('website/footer');
    }

    function paymentResponce() {
        $result = explode("|", $this->ocart->paymentResponce());
        if ($result[0]) {
            header("location:" . site_url() . "cart/finish?id=" . base64_encode($result[1]));
        } else {
            header("location:" . site_url() . "cart/fail");
        }
    }

    function appPaymentResponce() {
        $result = $this->ocart->paymentResponce();
        if ($result) {
            echo "S";
        } else {
            echo "F";
        }
    }

    function finish() {
        if ($this->input->get('id') != "") {
            $cart_id = base64_decode($this->input->get('id'));
            $data['orderdata'] = $this->ocart->getCartTotal($cart_id);
            $this->load->view('website/header');
            $this->load->view('website/thanks', $data);
            $this->load->view('website/footer');
        } else {
            $this->load->view('website/header');
            $this->load->view('website/thanks');
            $this->load->view('website/footer');
        }
    }

    function fail() {
        $this->load->view('website/header');
        $this->load->view('website/fail');
        $this->load->view('website/footer');
    }

    function getCartTotalAmount() {
        $products = $this->wcommon->getCartProduct();
        $session_product = $this->session->userdata('product');
        if (isset($products) && is_array($products)) {
            $total_amount = 0;
            $total_shipping_charge = 0;
            $total_cod_charge = 0;
            foreach ($products as $product) {
                $total_amount = (float) ($total_amount + ($product->selling_price * $session_product[$product->product_id]['qty']));
                $total_shipping_charge = (float) ($total_shipping_charge + ($product->shipping_charge * $session_product[$product->product_id]['qty']));
                $total_cod_charge = (float) ($total_cod_charge + $session_product[$product->product_id]['cod_charge']);
            }
            $special_discount = $this->wcommon->getSpecialDiscount($total_amount);

            echo $total_amount . "|" . $total_shipping_charge . "|" . $total_cod_charge . "|" . $special_discount;
        }
    }

    function applyCoupon() {
        $coupon_code = $this->input->post('coupon_code');
        $coupon = $this->ocart->getCouponData($coupon_code);
        $products = $this->wcommon->getCartProduct();
        $session_product = $this->session->userdata('product');
        $flag = array();
        $total_amount = 0;
        $total_discount = 0;
        $total_qty = 0;
        $status = 0;
        if (isset($coupon->apply_type)) {
            if ($coupon->apply_type == 0) {
                $total_amount = 0;
                foreach ($products as $product) {
                    $total_amount += $product->selling_price * $session_product[$product->product_id]['qty'];
                    if ($product->product_supc == $coupon->apply_value) {
                        $flag[] = 1;
                    } else {
                        $flag[] = 0;
                    }
                }
            } else if ($coupon->apply_type == 1) {
                $total_amount = 0;
                foreach ($products as $product) {
                    $total_amount += $product->selling_price * $session_product[$product->product_id]['qty'];
                    if ($product->sub_category_id == $coupon->apply_value) {
                        $flag[] = 1;
                    } else {
                        $flag[] = 0;
                    }
                }
            }
        }

        foreach ($flag as $val) {
            if ($val == 0) {
                $status = 0;
                break;
            } else if ($val == 1) {
                $status = 1;
            }
        }

        if ($status == 1) {
            $total_qty = 0;
            foreach ($session_product as $product) {
                $product_id = $product['product_id'];
                $session = $this->session->userdata('product');
                $session[$product_id]['coupon'] = $coupon->coupon_code;
                $total_qty += $session[$product_id]['qty'];
                $this->session->set_userdata('product', $session);
            }
        } else {
            foreach ($session_product as $product) {
                $product_id = $product['product_id'];
                $session = $this->session->userdata('product');
                $session[$product_id]['coupon'] = "";
                $this->session->set_userdata('product', $session);
            }
        }

        if ($status == 1) {
            if ($coupon->type == '0') {
                $total_discount = $coupon->value * $total_qty;
            } else if ($coupon->type == '1') {
                $total_discount = ($total_amount * $coupon->value) / 100;
            }
            echo "1|" . round($total_discount);
        } else if ($status == 0) {
            echo "0|" . round($total_discount);
        }
    }

}
