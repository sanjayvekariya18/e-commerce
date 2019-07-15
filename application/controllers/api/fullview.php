<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH . 'application/libraries/REST_Controller.php';

class Fullview extends REST_Controller {

    function __construct() {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
    }

    function index_post() {
        $product_id = $this->input->post('id');
        $data['return'] = $this->common->returnDay();
        $data['product'] = $this->wcommon->getProductData($product_id);
        $data['pimages'] = $this->wcommon->getProductImages($product_id);
        $data['variation'] = $this->wcommon->getProductVariation($product_id);
        $data['sproduct'] = $this->wcommon->getOtherProductBySupc($product_id);
        $data['review'] = $this->wcommon->getProductReview($product_id);
        $data['rproduct'] = $this->wcommon->getTopRatedRelatedProduct($data['product']->sub_category_id, $data['product']->product_id);
        $html = $this->load->view('api/fullview', $data, TRUE);

        $responce = $this->response($html, 200);
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_output($responce);
    }

}
