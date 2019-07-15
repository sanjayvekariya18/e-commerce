<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Womens extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->siteStatus()) {
            header('location:' . site_url() . 'error');
        }
    }

    function bollywood() {
        $subcategory_id = 1;
        $start = "0";
        $productLimit = '24';  // set product limit to display each scroll
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }

        $products = $this->wcommon->getAllProducts($subcategory_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/header');
        $this->load->view('website/womens/bollywood', $data);
        $this->load->view('website/footer');
    }

    function pingBollywood() {
        $subcategory_id = 1;
        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }

        $products = $this->wcommon->getAllProducts($subcategory_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function bollywoodFilter() {
        $subcategory_id = 1;
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
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function PingFilterBollywood() {
        $subcategory_id = 1;
        $min_price = $this->input->post('min_price');
        $max_price = $this->input->post('max_price');
        $variation_id = $this->input->post('variation_id');

        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;

        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function sarees() {
        $subcategory_id = 4;
        $variation_id = "";
        $start = "0";
        $productLimit = '24';  // set product limit to display each scroll
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        if ($this->input->get('id') != "") {
            $variation_id = $this->input->get('id');
        }
        $products = $this->wcommon->getAllProducts($subcategory_id, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/header');
        $this->load->view('website/womens/sarees', $data);
        $this->load->view('website/footer');
    }

    function pingSarees() {
        $subcategory_id = 4;
        $variation_id = "";
        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        if ($this->input->get('id') != "") {
            $variation_id = $this->input->get('id');
        }
        $products = $this->wcommon->getAllProducts($subcategory_id, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function sareesFilter() {
        $subcategory_id = 4;
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
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function PingFilterSarees() {
        $subcategory_id = 4;
        $min_price = $this->input->post('min_price');
        $max_price = $this->input->post('max_price');
        $variation_id = $this->input->post('variation_id');

        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;

        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function kurtis() {
        $subcategory_id = 7;
        $variation_id = "";
        $start = "0";
        $productLimit = '24';  // set product limit to display each scroll
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        if ($this->input->get('id') != "") {
            $variation_id = $this->input->get('id');
        }
        $products = $this->wcommon->getAllProducts($subcategory_id, $variation_id);

        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/header');
        $this->load->view('website/womens/kurtis', $data);
        $this->load->view('website/footer');
    }

    function pingKurtis() {
        $subcategory_id = 7;
        $variation_id = "";
        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        if ($this->input->get('id') != "") {
            $variation_id = $this->input->get('id');
        }
        $products = $this->wcommon->getAllProducts($subcategory_id, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function kurtisFilter() {
        $subcategory_id = 7;
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
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function pingFilterKurtis() {
        $subcategory_id = 7;
        $min_price = $this->input->post('min_price');
        $max_price = $this->input->post('max_price');
        $variation_id = $this->input->post('variation_id');

        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;

        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function dressMaterial() {
        $subcategory_id = 2;
        $variation_id = "";
        $start = "0";
        $productLimit = '24';  // set product limit to display each scroll
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        if ($this->input->get('id') != "") {
            $variation_id = $this->input->get('id');
        }
        $products = $this->wcommon->getAllProducts($subcategory_id, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/header');
        $this->load->view('website/womens/dress_material', $data);
        $this->load->view('website/footer');
    }

    function pingDressMaterial() {
        $subcategory_id = 2;
        $variation_id = "";
        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        if ($this->input->get('id') != "") {
            $variation_id = $this->input->get('id');
        }
        $products = $this->wcommon->getAllProducts($subcategory_id, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function dressMaterialFilter() {
        $subcategory_id = 2;
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
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function pingFilterDressMaterial() {
        $subcategory_id = 2;
        $min_price = $this->input->post('min_price');
        $max_price = $this->input->post('max_price');
        $variation_id = $this->input->post('variation_id');

        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;

        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function salwarKurta() {
        $subcategory_id = 5;
        $variation_id = "";
        $start = "0";
        $productLimit = '24';  // set product limit to display each scroll
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        if ($this->input->get('id') != "") {
            $variation_id = $this->input->get('id');
        }
        $products = $this->wcommon->getAllProducts($subcategory_id, $variation_id);

        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/header');
        $this->load->view('website/womens/salwar_kurta', $data);
        $this->load->view('website/footer');
    }

    function pingSalwarKurta() {
        $subcategory_id = 5;
        $variation_id = "";
        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        if ($this->input->get('id') != "") {
            $variation_id = $this->input->get('id');
        }
        $products = $this->wcommon->getAllProducts($subcategory_id, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function salwarKurtaFilter() {
        $subcategory_id = 5;
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
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function pingFilterSalwarKurta() {
        $subcategory_id = 5;
        $min_price = $this->input->post('min_price');
        $max_price = $this->input->post('max_price');
        $variation_id = $this->input->post('variation_id');

        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;

        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function lehengaCholis() {
        $subcategory_id = 6;
        $variation_id = "";
        $start = "0";
        $productLimit = '24';  // set product limit to display each scroll
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        if ($this->input->get('id') != "") {
            $variation_id = $this->input->get('id');
        }
        $products = $this->wcommon->getAllProducts($subcategory_id, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/header');
        $this->load->view('website/womens/lehenga_cholis', $data);
        $this->load->view('website/footer');
    }

    function pingLehengaCholis() {
        $subcategory_id = 6;
        $variation_id = "";
        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        if ($this->input->get('id') != "") {
            $variation_id = $this->input->get('id');
        }
        $products = $this->wcommon->getAllProducts($subcategory_id, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function lehengaCholisFilter() {
        $subcategory_id = 6;
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
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function PingFilterLehengaCholis() {
        $subcategory_id = 6;
        $min_price = $this->input->post('min_price');
        $max_price = $this->input->post('max_price');
        $variation_id = $this->input->post('variation_id');

        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;

        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function ethnicBottoms() {
        $subcategory_id = 8;
        $start = "0";
        $productLimit = '24';  // set product limit to display each scroll
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllProducts($subcategory_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/header');
        $this->load->view('website/womens/ethnic_bottoms', $data);
        $this->load->view('website/footer');
    }

    function pingEthnicBottoms() {
        $subcategory_id = 8;
        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllProducts($subcategory_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function ethnicBottomsFilter() {
        $subcategory_id = 8;
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
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function PingFilterEthnicBottoms() {
        $subcategory_id = 8;
        $min_price = $this->input->post('min_price');
        $max_price = $this->input->post('max_price');
        $variation_id = $this->input->post('variation_id');

        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;

        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function ethnicSets() {
        $subcategory_id = 9;
        $start = "0";
        $productLimit = '24';  // set product limit to display each scroll
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllProducts($subcategory_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/header');
        $this->load->view('website/womens/ethnic_sets', $data);
        $this->load->view('website/footer');
    }

    function pingEthnicSets() {
        $subcategory_id = 9;
        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllProducts($subcategory_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function ethnicSetsFilter() {
        $subcategory_id = 9;
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
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function PingFilterEthnicSets() {
        $subcategory_id = 9;
        $min_price = $this->input->post('min_price');
        $max_price = $this->input->post('max_price');
        $variation_id = $this->input->post('variation_id');

        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;

        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function dupattas() {
        $subcategory_id = 10;
        $start = "0";
        $productLimit = '24';  // set product limit to display each scroll
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllProducts($subcategory_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/header');
        $this->load->view('website/womens/dupattas', $data);
        $this->load->view('website/footer');
    }

    function pingDupattas() {
        $subcategory_id = 10;
        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllProducts($subcategory_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function dupattasFilter() {
        $subcategory_id = 10;
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
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function PingFilterDupattas() {
        $subcategory_id = 10;
        $min_price = $this->input->post('min_price');
        $max_price = $this->input->post('max_price');
        $variation_id = $this->input->post('variation_id');

        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;

        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function blouses() {
        $subcategory_id = 11;
        $start = "0";
        $productLimit = '24';  // set product limit to display each scroll
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllProducts($subcategory_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/header');
        $this->load->view('website/womens/blouses', $data);
        $this->load->view('website/footer');
    }

    function pingBlouses() {
        $subcategory_id = 11;
        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllProducts($subcategory_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function blousesFilter() {
        $subcategory_id = 11;
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
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function PingFilterBlouses() {
        $subcategory_id = 11;
        $min_price = $this->input->post('min_price');
        $max_price = $this->input->post('max_price');
        $variation_id = $this->input->post('variation_id');

        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;

        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function abayas() {
        $subcategory_id = 12;
        $start = "0";
        $productLimit = '24';  // set product limit to display each scroll
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllProducts($subcategory_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/header');
        $this->load->view('website/womens/abayas', $data);
        $this->load->view('website/footer');
    }

    function pingAbayas() {
        $subcategory_id = 12;
        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllProducts($subcategory_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function abayasFilter() {
        $subcategory_id = 12;
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
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function PingFilterAbayas() {
        $subcategory_id = 12;
        $min_price = $this->input->post('min_price');
        $max_price = $this->input->post('max_price');
        $variation_id = $this->input->post('variation_id');

        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;

        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function petticoats() {
        $subcategory_id = 13;
        $start = "0";
        $productLimit = '24';  // set product limit to display each scroll
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllProducts($subcategory_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/header');
        $this->load->view('website/womens/petticoats', $data);
        $this->load->view('website/footer');
    }

    function pingPetticoats() {
        $subcategory_id = 13;
        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllProducts($subcategory_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function petticoatsFilter() {
        $subcategory_id = 13;
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
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function PingFilterPetticoats() {
        $subcategory_id = 13;
        $min_price = $this->input->post('min_price');
        $max_price = $this->input->post('max_price');
        $variation_id = $this->input->post('variation_id');

        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;

        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function gowns() {
        $subcategory_id = 3;        
        $variation_id = "";
        $start = "0";
        $productLimit = '24';  // set product limit to display each scroll
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        if ($this->input->get('id') != "") {
            $variation_id = $this->input->get('id');
        }
        $products = $this->wcommon->getAllProducts($subcategory_id, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/header');
        $this->load->view('website/womens/gowns', $data);
        $this->load->view('website/footer');
    }

    function pingGowns() {
        $subcategory_id = 3;
        $variation_id = "";
        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        if ($this->input->get('id') != "") {
            $variation_id = $this->input->get('id');
        }
        $products = $this->wcommon->getAllProducts($subcategory_id, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function gownsFilter() {
        $subcategory_id = 3;
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
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function PingFilterGowns() {
        $subcategory_id = 3;
        $min_price = $this->input->post('min_price');
        $max_price = $this->input->post('max_price');
        $variation_id = $this->input->post('variation_id');

        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;

        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function jewellery() {
        $subcategory_id = ($this->input->get('cid')!="")?$this->input->get('cid'):"";
        $variation_id = "";
        $start = "0";
        $productLimit = '24';  // set product limit to display each scroll
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        if ($this->input->get('id') != "") {
            $variation_id = $this->input->get('id');
        }
        $products = $this->wcommon->getAllJewelleryProducts($subcategory_id, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/header');
        $this->load->view('website/jewellery/jewellery', $data);
        $this->load->view('website/footer');
    }

    function pingJewellery() {
        $subcategory_id = ($this->input->get('cid')!="")?$this->input->get('cid'):"";
        $variation_id = "";
        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        if ($this->input->get('id') != "") {
            $variation_id = $this->input->get('id');
        }
        $products = $this->wcommon->getAllJewelleryProducts($subcategory_id, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function jewelleryFilter() {
        $subcategory_id = ($this->input->get('cid')!="")?$this->input->get('cid'):"";
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
        $products = $this->wcommon->getAllJewelleryProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function PingFilterJewellery() {
        $subcategory_id = ($this->input->get('cid')!="")?$this->input->get('cid'):"";
        $min_price = $this->input->post('min_price');
        $max_price = $this->input->post('max_price');
        $variation_id = $this->input->post('variation_id');

        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;

        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllJewelleryProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }
    
    function leggings() {
        $subcategory_id = 59;
        $variation_id = "";
        $start = "0";
        $productLimit = '24';  // set product limit to display each scroll
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        if ($this->input->get('id') != "") {
            $variation_id = $this->input->get('id');
        }
        $products = $this->wcommon->getAllProducts($subcategory_id, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/header');
        $this->load->view('website/western_wear/leggings', $data);
        $this->load->view('website/footer');
    }

    function pingLeggings() {
        $subcategory_id = 59;
        $variation_id = "";
        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;
        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        if ($this->input->get('id') != "") {
            $variation_id = $this->input->get('id');
        }
        $products = $this->wcommon->getAllProducts($subcategory_id, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function leggingsFilter() {
        $subcategory_id = 59;
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
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

    function PingFilterLeggings() {
        $subcategory_id = 59;
        $min_price = $this->input->post('min_price');
        $max_price = $this->input->post('max_price');
        $variation_id = $this->input->post('variation_id');

        $start = (isset($_POST['start'])) ? $_POST['start'] : "0";
        $productLimit = '24';
        $count = 0;

        $product_variation = $this->common->getVariation();
        foreach ($product_variation as $val) {
            $data[$val->variation_type][] = array('variation_id' => $val->variation_id, 'variation_name' => $val->variation_name, 'variation_code' => $val->variation_code);
        }
        $products = $this->wcommon->getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id);
        foreach ($products as $key => $val) {
            if ($key >= $start && $productLimit > $count) {
                $data['products'][] = $val;
                $count = $count + 1;
            }
        }
        $this->load->view('website/womens/ping', $data);
    }

}
