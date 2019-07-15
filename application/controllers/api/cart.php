<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH . 'application/libraries/REST_Controller.php';

class Cart extends REST_Controller {

    function __construct() {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        $this->load->model('website/m_cart', 'ocart');
    }

    function add_post() {

        $product_data = array(
            'temp_cart_id' => $this->input->post('temp_cart_id'),
            'product_id' => $this->input->post('product_id'),
            'colour_id' => $this->input->post('colour_id'),
            'size_id' => $this->input->post('size'),
            'qty' => $this->input->post('qty')
        );

        $status = $this->wcommon->existTempCartProduct($product_data);
        if ($status == 0) {
            $result = $this->wcommon->addTempCartProduct($product_data);
            if ($result == 1) {
                $responce = $this->response(array('msg' => 'S'), 200);
            } else {
                $responce = $this->response(array('msg' => 'R'), 200);
            }
        } else {
            $responce = $this->response(array('msg' => 'R'), 200);
        }
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_output($responce);
    }

    function view_post() {

        $temp_cart_id = $this->input->post('temp_cart_id');
        $data['products'] = $this->wcommon->getAppCartProducts($temp_cart_id);
        $html = $this->load->view('api/cartProduct', $data, TRUE);

        $responce = $this->response($html, 200);
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_output($responce);
    }
    
    function headercart_post() {

        $temp_cart_id = $this->input->post('temp_cart_id');
        $data['products'] = $this->wcommon->getAppCartProducts($temp_cart_id);
        $html = $this->load->view('api/headercart', $data, TRUE);

        $responce = $this->response($html, 200);
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_output($responce);
    }

    function orderView_post() {

        $temp_cart_id = $this->input->post('temp_cart_id');
        $data['products'] = $this->wcommon->getAppCartProducts($temp_cart_id);
        $html = $this->load->view('api/cartOrder', $data, TRUE);

        $responce = $this->response($html, 200);
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_output($responce);
    }

    function updateQty_post() {
        $temp_cart_id = $this->input->post('temp_cart_id');
        $product_id = $this->input->post('product_id');
        $qty = $this->input->post('qty');

        $result = $this->wcommon->updateCartProduct($temp_cart_id, $product_id, $qty);
        if ($result == 1) {
            $responce = $this->response(array('msg' => 'S'), 200);
        } else {
            $responce = $this->response(array('msg' => 'R'), 200);
        }
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_output($responce);
    }

    function removeProduct_post() {
        $temp_cart_id = $this->input->post('temp_cart_id');
        $product_id = $this->input->post('product_id');

        $result = $this->wcommon->removeCartProduct($temp_cart_id, $product_id);
        if ($result == 1) {
            $responce = $this->response(array('msg' => 'S'), 200);
        } else {
            $responce = $this->response(array('msg' => 'R'), 200);
        }
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_output($responce);
    }

    function clearCart_post() {
        $temp_cart_id = $this->input->post('temp_cart_id');

        $result = $this->wcommon->clearCartProduct($temp_cart_id);
        if ($result == 1) {
            $responce = $this->response(array('msg' => 'S'), 200);
        } else {
            $responce = $this->response(array('msg' => 'R'), 200);
        }
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_output($responce);
    }

    function coupon_post() {

        $temp_cart_id = $this->input->post('temp_cart_id');
        $coupon_code = $this->input->post('coupon_code');

        $coupon = $this->ocart->getCouponData($coupon_code);
        $products = $this->wcommon->getAppCartProducts($temp_cart_id);

        $flag = array();
        $total_amount = 0;
        $total_discount = 0;
        $total_qty = 0;
        $status = 0;

        if (isset($coupon->apply_type)) {
            if ($coupon->apply_type == 0) {
                $total_amount = 0;
                foreach ($products as $product) {
                    $total_amount += $product->selling_price * $product->qty;
                    if ($product->product_supc == $coupon->apply_value) {
                        $flag[] = 1;
                    } else {
                        $flag[] = 0;
                    }
                }
            } else if ($coupon->apply_type == 1) {
                $total_amount = 0;
                foreach ($products as $product) {
                    $total_amount += $product->selling_price * $product->qty;
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
            foreach ($products as $product) {
                $product_id = $product->product_id;
                $total_qty += $product->qty;
                $this->wcommon->assignCouponToCartProduct($temp_cart_id, $product_id, $coupon_code);
            }
        } else {
            foreach ($products as $product) {
                $product_id = $product->product_id;
                $coupon_code = "";
                $this->wcommon->assignCouponToCartProduct($temp_cart_id, $product_id, $coupon_code);
            }
        }

        if ($status == 1) {
            if ($coupon->type == '0') {
                $total_discount = $coupon->value * $total_qty;
            } else if ($coupon->type == '1') {
                $total_discount = ($total_amount * $coupon->value) / 100;
            }
            $responce = $this->response(array('msg' => 'S', 'discount' => round($total_discount)), 200);
        } else if ($status == 0) {
            $responce = $this->response(array('msg' => 'F', 'discount' => round($total_discount)), 200);
        }

        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_output($responce);
    }

    function addOrder_post() {
        $temp_cart_id = $this->input->post('temp_cart_id');
        $customer_id  = $this->input->post('customer_id');
        $pay_method  = $this->input->post('pay_method');
        
        $cart_id = $this->ocart->addAppOrder($temp_cart_id,$customer_id,$pay_method);
        if ($cart_id != "") {
            $responce = $this->response(array('msg' => 'S','cart_id' => $cart_id), 200);
        } else {
            $responce = $this->response(array('msg' => 'R'), 200);
        }
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_output($responce);
    }
    
    function paymentdata_post(){
        $cart_id = $this->input->post('cart_id');
        $data['order'] = $this->ocart->getCartData($cart_id);        
        $html = $this->load->view('api/payment', $data, TRUE);
        
        $responce = $this->response($html, 200);
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_output($responce);
    }

}
