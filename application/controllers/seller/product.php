<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->common->seller_logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->seller_profile_set($this->session->userdata('seller_primary_email'))) {
            header('location:' . site_url() . 'seller/profile?msg=RQ');
        }

        $this->load->model('seller/m_product', 'oproduct');
        $this->load->library('csvimport');
        $this->load->helper('download');
    }

    function index() {        
        $data['commission'] = $this->common->getSellerGroupData($this->session->userdata('seller_primary_email'));
        $allvariation = $this->common->getVariation();
        $variation = array();
        foreach ($allvariation as $val) {
            $variation[$val->variation_type][] = array('id' => $val->variation_id, 'name' => $val->variation_name);
        }
        $result = array_merge($variation, $data);
        $this->load->view('seller/header');
        $this->load->view('seller/product/add_product', $result);
        $this->load->view('seller/footer');
    }
    
    function getSubCategoryByMain(){
        $main_category_id = $this->input->post('main_category_id');
        $data['subcategory'] = $this->common->getSubCategoryByMain($main_category_id);
        $this->load->view('seller/product/sub_category',$data);
    }
    
    function checkSkuExist(){
        $sku = $this->input->post('sku');
        $result = $this->oproduct->checkSkuExist($sku);
        echo $result;
    }

    function supc() {
        $this->load->view('seller/header');
        $this->load->view('seller/product/add_product_supc');
        $this->load->view('seller/footer');
    }

    function searchBySupc() {
        $seller_id = $this->session->userdata('seller_id');
        $product_supc = $this->input->post('product_supc');
        $result = $this->common->supcProductExist($product_supc, $seller_id);
        
        if ($result) {
            $data['products'] = $this->common->getProductBySupc($product_supc, $seller_id);
        } else {
            $data['products'] = array();
        }
        $this->load->view('seller/header');
        $this->load->view('seller/product/add_product_supc', $data);
        $this->load->view('seller/footer');
    }

    function bulk() {        
        $this->load->view('seller/header');
        $this->load->view('seller/product/add_product_bulk');
        $this->load->view('seller/footer');
    }

    function bulkupload() {

        if ($_FILES['csvfile']['error'] != 4) {
            $pathMain = FCPATH . "/upload/csv/"; 

            $filename = $_FILES['csvfile']['name'];
            $result = $this->common->do_upload('csvfile', $pathMain, $filename);
            $file_path = $result['upload_data']['full_path'];

            $products = array();
            
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                    $set = array(
                        'main_category_id' => $_POST['main_category_id'],
                        'sub_category_id' => $_POST['sub_category_id'],
                        'product_desc' => (isset($row['product_description'])) ? $row['product_description'] : "",
                        'meta_title' => "",
                        'meta_desc' => "",
                        'meta_keyword' => (isset($row['meta_keyword'])) ? $row['meta_keyword'] : "",
                        'style_code' => (isset($row['style_code'])) ? $row['style_code'] : "",
                        'sku' => (isset($row['sku'])) ? $row['sku'] : "",
                        'mrp' => (isset($row['mrp'])) ? $row['mrp'] : "",
                        'selling_price' => (isset($row['selling_price'])) ? $row['selling_price'] : "",
                        'weight' => (isset($row['weight'])) ? $row['weight'] : "",
                        'shipping_time' => (isset($row['shipping_day'])) ? $row['shipping_day'] : "",
                        'qty' => (isset($row['quantity'])) ? $row['quantity'] : "",
                        'pattern' => (isset($row['pattern'])) ? $row['pattern'] : "",
                        'ocassion' => (isset($row['occasion'])) ? $row['occasion'] : "",
                        'colour' => (isset($row['colour'])) ? $row['colour'] : "",
                        'fabric_care' => (isset($row['fabric_care'])) ? $row['fabric_care'] : "",
                        'fabric' => (isset($row['fabric'])) ? $row['fabric'] : "",
                        'blouse_fabric' => (isset($row['blouse_fabric'])) ? $row['blouse_fabric'] : "",
                        'bottom_fabric' => (isset($row['bottom_fabric'])) ? $row['bottom_fabric'] : "",
                        'inner_fabric' => (isset($row['inner_fabric'])) ? $row['inner_fabric'] : "",
                        'dupatta_fabric' => (isset($row['dupatta_fabric'])) ? $row['dupatta_fabric'] : "",
                        'sleeve' => (isset($row['sleeve'])) ? $row['sleeve'] : "",
                        'type' => (isset($row['type'])) ? $row['type'] : "",
                        'size' => (isset($row['size'])) ? $row['size'] : "",
                        'celebrity' => (isset($row['celebrity'])) ? $row['celebrity'] : "",
                        'saree_style' => (isset($row['saree_style'])) ? $row['saree_style'] : "",
                        'salwar_kameez_style' => (isset($row['salwar_kameez_style'])) ? $row['salwar_kameez_style'] : "",
                        'saree_border' => (isset($row['saree_border'])) ? $row['saree_border'] : "",
                        'saree_length' => (isset($row['saree_length'])) ? $row['saree_length'] : "",
                        'bottom_colour' => (isset($row['bottom_colour'])) ? $row['bottom_colour'] : "",
                        'dupatta_colour' => (isset($row['dupatta_colour'])) ? $row['dupatta_colour'] : "",
                        'bottom_size' => (isset($row['bottom_size'])) ? $row['bottom_size'] : "",
                        'top_size' => (isset($row['top_size'])) ? $row['top_size'] : "",
                        'dupatta_size' => (isset($row['dupatta_size'])) ? $row['dupatta_size'] : "",
                        'stitching' => (isset($row['stitching'])) ? $row['stitching'] : "",
                        'style' => (isset($row['style'])) ? $row['style'] : "",
                        'collection' => (isset($row['collection'])) ? $row['collection'] : "",
                        'image_url' => (isset($row['image_url'])) ? $row['image_url'] : "",
                        'other_image_url' => (isset($row['other_image_url'])) ? $row['other_image_url'] : "",
                        'fine_or_fashion' => (isset($row['fine_or_fashion'])) ? $row['fine_or_fashion'] : "",
                        'gender' => (isset($row['gender'])) ? $row['gender'] : "",
                        'material' => (isset($row['material'])) ? $row['material'] : "",
                        'metals_type' => (isset($row['metals_type'])) ? $row['metals_type'] : "",
                        'gem_stone' => (isset($row['gem_stone'])) ? $row['gem_stone'] : "",
                        'shape' => (isset($row['shape'])) ? $row['shape'] : "",
                        'setting_type' => (isset($row['setting_type'])) ? $row['setting_type'] : "",
                        'width' => (isset($row['width'])) ? $row['width'] : "",
                        'height' => (isset($row['height'])) ? $row['height'] : "",
                        'length' => (isset($row['length'])) ? $row['length'] : "",
                        'diameter' => (isset($row['diameter'])) ? $row['diameter'] : "",
                        'fit' => (isset($row['fit'])) ? $row['fit'] : "",
                        'rise' => (isset($row['fit'])) ? $row['rise'] : "",
                        'company' => (isset($row['brand'])) ? $row['brand'] : "",
                    );
                    $products[] = $set;
                }
                
                $this->oproduct->bulkupload($products);
                unlink($file_path);
                header('location:' . site_url() . 'seller/product/bulk?msg=S');
            } else {
                header('location:' . site_url() . 'seller/product/bulk?msg=E');
            }
        }
    }  

    function addProductData() {
        if ($this->input->post('product_id') != "") {
            $this->oproduct->updateProductData();
            echo "update_success";
        } else {
            $this->oproduct->addProductData();
            echo "add_success";            
        }       
    }

    function getProductBySupc() {
        $product_id = base64_decode($this->input->get('id'));
        $data['product'] = $this->common->getProductById($product_id);
        $data['commission'] = $this->common->getSellerGroupData($this->session->userdata('seller_primary_email'));
        $data['competitive_price'] = $this->common->getProductMinPriceBySupc($data['product']->product_supc);
        $data['size'] = $this->common->getSizeVariation();

        $product_variation = $this->common->getProductVariationById($data['product']->variation_id);
        foreach ($product_variation as $val) {
            $variation['variations'][$val->variation_type][] = $val->variation_name;
        }

        $result = array_merge($data, $variation);
        $this->load->view('seller/header');
        $this->load->view('seller/product/view_product_supc', $result);
        $this->load->view('seller/footer');
    }

    function getProduct() {
        $product_id = $this->input->post('product_id');
        $product = $this->common->getProductById($product_id);
        echo json_encode($product);
    }

    function modelEditProduct() {
        $this->oproduct->modelEditProduct();        
    }

    function startSellingProduct() {
        $this->oproduct->modelEditProduct();        
    }

    function editProduct() {
        $product_id = base64_decode($this->input->get('id'));
        $data['product'] = $this->common->getProductById($product_id);
        $data['subcategory'] = $this->common->getSubcategory();
        $data['commission'] = $this->common->getSellerGroupData($this->session->userdata('seller_primary_email'));
        $allvariation = $this->common->getVariation();
        $variation = array();
        foreach ($allvariation as $val) {
            $variation[$val->variation_type][] = array('id' => $val->variation_id, 'name' => $val->variation_name);
        }
        $result = array_merge($variation, $data);
        $this->load->view('seller/header');
        $this->load->view('seller/product/add_product', $result);
        $this->load->view('seller/footer');
    }

    function addProductBySupcData() {
        $this->oproduct->addProductBySupcData();
        header('location:' . site_url() . 'seller/product/supc?msg=S');
    }

    function fileDownload() {
        $id = $this->input->get('id');
        switch ($id) {
            case 1:
                $data = file_get_contents(FCPATH . "/upload/productfile/ethinic_variations_list.csv"); // Read the file's contents
                $name = 'ethinic_variations_list.csv';
                force_download($name, $data);
                break;
            case 2:
                $data = file_get_contents(FCPATH . "/upload/productfile/leggings_variations_list.csv"); // Read the file's contents
                $name = 'leggings_variations_list.csv';
                force_download($name, $data);
                break;
            case 3:
                $data = file_get_contents(FCPATH . "/upload/productfile/jewellery_variations_list.csv"); // Read the file's contents
                $name = 'jewellery_variations_list.csv';
                force_download($name, $data);
                break;
            case 4:
                $data = file_get_contents(FCPATH . "/upload/productfile/leggings.csv"); // Read the file's contents
                $name = 'leggings.csv';
                force_download($name, $data);
                break;
            case 5:
                $data = file_get_contents(FCPATH . "/upload/productfile/jewellery.csv"); // Read the file's contents
                $name = 'jewellery.csv';
                force_download($name, $data);
                break;
            case 6:
                $data = file_get_contents(FCPATH . "/upload/productfile/saree.csv"); // Read the file's contents
                $name = 'saree.csv';
                force_download($name, $data);
                break;
            case 7:
                $data = file_get_contents(FCPATH . "/upload/productfile/salwar_kurta.csv"); // Read the file's contents
                $name = 'salwar_kurta.csv';
                force_download($name, $data);
                break;
            case 8:
                $data = file_get_contents(FCPATH . "/upload/productfile/dress_material.csv"); // Read the file's contents
                $name = 'dress_material.csv';
                force_download($name, $data);
                break;
            case 9:
                $data = file_get_contents(FCPATH . "/upload/productfile/kurti.csv"); // Read the file's contents
                $name = 'kurti.csv';
                force_download($name, $data);
                break;
            case 10:
                $data = file_get_contents(FCPATH . "/upload/productfile/lehenga_choli.csv"); // Read the file's contents
                $name = 'lehenga_choli.csv';
                force_download($name, $data);
                break;
            case 11:
                $data = file_get_contents(FCPATH . "/upload/productfile/blouse.csv"); // Read the file's contents
                $name = 'blouse.csv';
                force_download($name, $data);
                break;
            case 12:
                $data = file_get_contents(FCPATH . "/upload/productfile/dupatta.csv"); // Read the file's contents
                $name = 'dupatta.csv';
                force_download($name, $data);
                break;
            case 13:
                $data = file_get_contents(FCPATH . "/upload/productfile/ethinic_bottom.csv"); // Read the file's contents
                $name = 'ethinic_bottom.csv';
                force_download($name, $data);
                break;
            case 14:
                $data = file_get_contents(FCPATH . "/upload/productfile/ethinic_set.csv"); // Read the file's contents
                $name = 'ethinic_set.csv';
                force_download($name, $data);
                break;
            case 15:
                $data = file_get_contents(FCPATH . "/upload/productfile/gown.csv"); // Read the file's contents
                $name = 'gown.csv';
                force_download($name, $data);
                break;
            case 16:
                $data = file_get_contents(FCPATH . "/upload/productfile/petticoats.csv"); // Read the file's contents
                $name = 'petticoats.csv';
                force_download($name, $data);
                break;
            case 17:
                $data = file_get_contents(FCPATH . "/upload/productfile/abayas.csv"); // Read the file's contents
                $name = 'abayas.csv';
                force_download($name, $data);
                break;
            case 18:
                $data = file_get_contents(FCPATH . "/upload/productfile/bollywood.csv"); // Read the file's contents
                $name = 'bollywood.csv';
                force_download($name, $data);
                break;
            default :
                break;
        }
    }
    
    function view() {
       $product_id = base64_decode($this->input->get('pid')); 
       $data['product'] = $this->oproduct->getProductViewData($product_id);
       $data['pimages'] = $this->oproduct->getProductViewImages($product_id);
       $data['variation'] = $this->oproduct->getProductViewVariation($product_id);
       
       $this->load->view('website/header');
       $this->load->view('seller/product/view_product',$data);
       $this->load->view('website/footer');
    }

}
