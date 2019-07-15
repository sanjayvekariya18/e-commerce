<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH . 'application/libraries/REST_Controller.php';

class Products extends REST_Controller {

    function __construct() {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
    }

    function index_post() {
        $subcategory_id = $this->input->post('sub_category_id');
        $start = $this->input->post('start');
        $layout = $this->input->post('layout');
        $productLimit = '20';  // set product limit to display each scroll        
        $data['products'] = $this->wcommon->getAllProducts($subcategory_id);
        $data['start'] = $start;
        $data['productLimit'] = $productLimit;
        $data['layout'] = $layout;
        $html = $this->load->view('api/product', $data, TRUE);

        $responce = $this->response($html, 200);
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_output($responce);
    }

    function filter_post() {

        $subcategory_id = $this->input->post('sub_category_id');
        $start = $this->input->post('start');
        $min_price = $this->input->post('min_price');
        $max_price = $this->input->post('max_price');
        $variation_id = $this->input->post('variation_id');
        
        $productLimit = '20';  // set product limit to display each scroll        
        $data['products'] = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        $data['start'] = $start;
        $data['productLimit'] = $productLimit;
        $html = $this->load->view('api/product', $data, TRUE);

        $responce = $this->response($html, 200);
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_output($responce);
    }
    
    function search_post() {
        $subcategory_id = 0;
        $keyword = $this->input->post('keyword');
        $start = $this->input->post('start');
        $layout = $this->input->post('layout');
        $productLimit = '20';  // set product limit to display each scroll        
        $data['products'] = $this->wcommon->getSearchProducts($subcategory_id, $keyword);
        $data['start'] = $start;
        $data['productLimit'] = $productLimit;
        $data['layout'] = $layout;
        $html = $this->load->view('api/product', $data, TRUE);

        $responce = $this->response($html, 200);
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_output($responce);
    }
    
    function searchFilter_post() {
        
        $subcategory_id = 0;
        $start = $this->input->post('start');
        $keyword = $this->input->post('keyword');
        $min_price = $this->input->post('min_price');
        $max_price = $this->input->post('max_price');
        $variation_id = $this->input->post('variation_id');
        
        $productLimit = '20';  // set product limit to display each scroll        
        $data['products'] = $this->wcommon->getSearchProductsFilter($subcategory_id, $keyword, $min_price, $max_price, $variation_id);
        $data['start'] = $start;
        $data['productLimit'] = $productLimit;
        $html = $this->load->view('api/product', $data, TRUE);

        $responce = $this->response($html, 200);
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_output($responce);
    }

    function variation_post() {

        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }

        $responce = $this->response($data, 200);
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_output($responce);
    }

}
