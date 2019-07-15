<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->siteStatus()) {
            header('location:' . site_url() . 'error');
        }
    }

    function index() {
        $product_id = base64_decode($this->input->get('pid'));
        $data['return'] = $this->common->returnDay();
        $data['product'] = $this->wcommon->getProductData($product_id);
        if (isset($data['product']->product_id)) {
            $data['pimages'] = $this->wcommon->getProductImages($product_id);
            $data['variation'] = $this->wcommon->getProductVariation($product_id);
            $data['sproduct'] = $this->wcommon->getOtherProductBySupc($product_id);
            $data['review'] = $this->wcommon->getProductReview($product_id);
            $data['rproduct'] = $this->wcommon->getTopRatedRelatedProduct($data['product']->sub_category_id, $data['product']->product_id);
            $data['rrproduct'] = $this->wcommon->getRandomRelatedProduct($data['product']->sub_category_id, $data['product']->product_id);
            $this->load->view('website/header', $data);
            $this->load->view('website/fullview', $data);
            $this->load->view('website/footer');
        } else {
            header('location:'.site_url());
        }       

        // rproduct = related bottom product ; rrproduct = random related right side product
    }

}
