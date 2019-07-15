<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Search extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->siteStatus()) {
            header('location:' . site_url() . 'error');
        }
    }

    function index() {
        if (isset($_POST['sub_category_id'])) {
            $subcategory_id = $this->input->post('sub_category_id');
            $keyword = $this->input->post('keyword');
            $start = "0";
            $productLimit = '24';  // set product limit to display each scroll
            $count = 0;
            $product_variation = $this->common->getVariation();
            foreach ($product_variation as $val) {
                $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
            }
            $products = $this->wcommon->getSearchProducts($subcategory_id, $keyword);
            foreach ($products as $key => $val) {
                if ($key >= $start && $productLimit > $count) {
                    $data['products'][] = $val;
                    $count = $count + 1;
                }
            }
            $this->load->view('website/header');
            $this->load->view('website/search', $data);
            $this->load->view('website/footer');
        } else if (isset($_GET['keyword'])) {
            $subcategory_id = 0;
            $keyword = str_replace("_", " ", $this->input->get('keyword'));
            $start = "0";
            $productLimit = '24';  // set product limit to display each scroll
            $count = 0;
            $product_variation = $this->common->getVariation();
            foreach ($product_variation as $val) {
                $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
            }
            $products = $this->wcommon->getSearchProducts($subcategory_id, $keyword);
            foreach ($products as $key => $val) {
                if ($key >= $start && $productLimit > $count) {
                    $data['products'][] = $val;
                    $count = $count + 1;
                }
            }
            $this->load->view('website/header');
            $this->load->view('website/search', $data);
            $this->load->view('website/footer');
        } else {
            $this->load->view('website/header');
            $this->load->view('website/search');
            $this->load->view('website/footer');
        }
    }

    function pingSearch() {
        if (isset($_POST['sub_category_id'])) {
            $subcategory_id = $this->input->post('sub_category_id');
            $keyword = $this->input->post('keyword');
            $start = ($this->input->post('start') != "") ? $this->input->post('start') : "0";
            $productLimit = '24';  // set product limit to display each scroll
            $count = 0;
            $product_variation = $this->common->getVariation();
            foreach ($product_variation as $val) {
                $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
            }
            $products = $this->wcommon->getSearchProducts($subcategory_id, $keyword);
            foreach ($products as $key => $val) {
                if ($key >= $start && $productLimit > $count) {
                    $data['products'][] = $val;
                    $count = $count + 1;
                }
            }
            $this->load->view('website/ping', $data);
        } else if (isset($_GET['keyword'])) {
            $subcategory_id = 0;
            $keyword = $this->input->get('keyword');
            $start = ($this->input->post('start') != "") ? $this->input->post('start') : "0";
            $productLimit = '24';  // set product limit to display each scroll
            $count = 0;
            $product_variation = $this->common->getVariation();
            foreach ($product_variation as $val) {
                $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
            }
            $products = $this->wcommon->getSearchProducts($subcategory_id, $keyword);
            foreach ($products as $key => $val) {
                if ($key >= $start && $productLimit > $count) {
                    $data['products'][] = $val;
                    $count = $count + 1;
                }
            }
            $this->load->view('website/ping', $data);
        }
    }

    function searchFilter() {
        if (isset($_POST['sub_category_id'])) {
            $subcategory_id = $this->input->post('sub_category_id');
            $keyword = $this->input->post('keyword');
            $min_price = $this->input->post('min_price');
            $max_price = $this->input->post('max_price');
            $variation_id = $this->input->post('variation_id');

            $start = "0";
            $productLimit = '24';  // set product limit to display each scroll
            $count = 0;

            $product_variation = $this->common->getVariation();
            foreach ($product_variation as $val) {
                $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
            }
            $products = $this->wcommon->getSearchProductsFilter($subcategory_id, $keyword, $min_price, $max_price, $variation_id);
            foreach ($products as $key => $val) {
                if ($key >= $start && $productLimit > $count) {
                    $data['products'][] = $val;
                    $count = $count + 1;
                }
            }
            $this->load->view('website/ping', $data);
        } else if (isset($_GET['keyword'])) {
            $subcategory_id = 0;
            $keyword = $this->input->get('keyword');
            $min_price = $this->input->post('min_price');
            $max_price = $this->input->post('max_price');
            $variation_id = $this->input->post('variation_id');

            $start = "0";
            $productLimit = '24';  // set product limit to display each scroll
            $count = 0;

            $product_variation = $this->common->getVariation();
            foreach ($product_variation as $val) {
                $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
            }
            $products = $this->wcommon->getSearchProductsFilter($subcategory_id, $keyword, $min_price, $max_price, $variation_id);
            foreach ($products as $key => $val) {
                if ($key >= $start && $productLimit > $count) {
                    $data['products'][] = $val;
                    $count = $count + 1;
                }
            }
            $this->load->view('website/ping', $data);
        }
    }

    function pingSearchFilter() {
        if (isset($_POST['sub_category_id'])) {
            $subcategory_id = $this->input->post('sub_category_id');
            $keyword = $this->input->post('keyword');
            $min_price = $this->input->post('min_price');
            $max_price = $this->input->post('max_price');
            $variation_id = $this->input->post('variation_id');

            $start = ($this->input->post('start') != "") ? $this->input->post('start') : "0";
            $productLimit = '24';  // set product limit to display each scroll
            $count = 0;

            $product_variation = $this->common->getVariation();
            foreach ($product_variation as $val) {
                $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
            }
            $products = $this->wcommon->getSearchProductsFilter($subcategory_id, $keyword, $min_price, $max_price, $variation_id);
            foreach ($products as $key => $val) {
                if ($key >= $start && $productLimit > $count) {
                    $data['products'][] = $val;
                    $count = $count + 1;
                }
            }
            $this->load->view('website/ping', $data);
        } else if (isset($_GET['keyword'])) {
            $subcategory_id = 0;
            $keyword = $this->input->get('keyword');
            $min_price = $this->input->post('min_price');
            $max_price = $this->input->post('max_price');
            $variation_id = $this->input->post('variation_id');

            $start = ($this->input->post('start') != "") ? $this->input->post('start') : "0";
            $productLimit = '12';  // set product limit to display each scroll
            $count = 0;

            $product_variation = $this->common->getVariation();
            foreach ($product_variation as $val) {
                $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
            }
            $products = $this->wcommon->getSearchProductsFilter($subcategory_id, $keyword, $min_price, $max_price, $variation_id);
            foreach ($products as $key => $val) {
                if ($key >= $start && $productLimit > $count) {
                    $data['products'][] = $val;
                    $count = $count + 1;
                }
            }
            $this->load->view('website/ping', $data);
        }
    }

}
