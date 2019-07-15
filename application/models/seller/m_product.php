<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_product extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function checkSkuExist($sku) {
        $where = array(
            'sku' => $sku,
            'seller_id' => $this->session->userdata('seller_id')
        );
        $query = $this->db->get_where('product_mst', $where);
        return $query->num_rows();
    }

    function addProductData() {
        $data = $_POST;
        $seller_id = $this->common->getSellerId($this->session->userdata('seller_primary_email'));
        $brand_name = $this->common->getBrandName($this->session->userdata('seller_primary_email'));
        $subcatname = $this->common->getSubcategoryName($data['sub_category_id']);

        $fabric = (isset($data['variations1'][0])) ? $this->common->getVariationName($data['variations1'][0]) : "";
        $occasion = (isset($data['variations9'][0])) ? $this->common->getVariationName($data['variations9'][0]) : "";
        $pattern = (isset($data['variations7'][0])) ? $this->common->getVariationName($data['variations7'][0]) : "";
        $shape = (isset($data['variations17'][0])) ? $this->common->getVariationName($data['variations17'][0]) : "";
        $material = (isset($data['variations15'][0])) ? $this->common->getVariationName($data['variations15'][0]) : "";
        $gem_stone = (isset($data['variations16'][0])) ? $this->common->getVariationName($data['variations16'][0]) : "";
        
        $product_supc = $this->getMaxSupcId();
        if (isset($data['variations'])) {
            $variations = $data['variations'];
        } else {
            $variations = array();
        }

        if ($data['main_category_id'] == 1) {
            for ($i = 1; $i <= 12; $i++) {
                if (isset($data['variations' . $i]) && is_array($data['variations' . $i])) {
                    $variations = array_merge($variations, $data['variations' . $i]);
                }
            }
            $product_name = ucfirst($brand_name) . " " . ucfirst($occasion) . " " . ucfirst($pattern) . " Womens " . ucfirst($fabric) . " " . ucfirst($subcatname);
        } else if ($data['main_category_id'] == 2) {
            if (isset($data['variations9']) && is_array($data['variations9'])) {
                $variations = array_merge($variations, $data['variations9']);
            }
            for ($i = 13; $i <= 17; $i++) {
                if (isset($data['variations' . $i]) && is_array($data['variations' . $i])) {
                    $variations = array_merge($variations, $data['variations' . $i]);
                }
            }
            $product_name = ucfirst($brand_name) . " " . ucfirst($occasion) . " " . ucfirst($shape) . " " . ucfirst($material) . " " . ucfirst($gem_stone) . " " . ucfirst($subcatname);
        } else if ($data['main_category_id'] == 3) {
            if (isset($data['variations1']) && is_array($data['variations1'])) {
                $variations = array_merge($variations, $data['variations1']);
            }
            if (isset($data['variations2']) && is_array($data['variations2'])) {
                $variations = array_merge($variations, $data['variations2']);
            }
            if (isset($data['variations7']) && is_array($data['variations7'])) {
                $variations = array_merge($variations, $data['variations7']);
            }
            if (isset($data['variations9']) && is_array($data['variations9'])) {
                $variations = array_merge($variations, $data['variations9']);
            }
            if (isset($data['variations17']) && is_array($data['variations17'])) {
                $variations = array_merge($variations, $data['variations17']);
            }
            $product_name = ucfirst($data['company']) . " Women's Leggings";
        }

        $variations_id = implode(',', $variations);
        $table_price = explode("|", $this->getSettlementPrice($data['selling_price']));

        $shipping_charge = $this->getShippingCharge($data['weight']);
        $product_data = array(
            'seller_id' => $seller_id,
            'main_category_id' => $data['main_category_id'],
            'sub_category_id' => $data['sub_category_id'],
            'product_name' => $product_name,
            'product_supc' => $product_supc,
            'product_desc' => $data['product_desc'],
            'meta_title' => $data['meta_title'],
            'meta_desc' => $data['meta_desc'],
            'meta_keyword' => $data['meta_keyword'],
            'brand' => $brand_name,
            'style_code' => $data['style_code'],
            'sku' => $data['sku'],
            'mrp' => $data['mrp'],
            'selling_price' => $data['selling_price'],
            'web_price' => $data['selling_price'],
            'settlement_price' => $table_price[7],
            'commission_fee' => $table_price[0],
            'fixed_fee' => $table_price[1],
            'service_fee' => $table_price[2],
            'listing_fee' => $table_price[3],
            'marketing_fee' => $table_price[4],
            'payment_fee' => $table_price[5],
            'other_fee' => $table_price[6],
            'weight' => $data['weight'],
            'shipping_time' => $data['shipping_time'],
            'shipping_charge' => $shipping_charge,
            'qty' => $data['qty'],
            'variation_id' => $variations_id,
            'width' => $data['width'],
            'height' => $data['height'],
            'length' => $data['length'],
            'diameter' => $data['diameter'],
            'company' => $data['company'],
            'approve_status' => '0',
            'live_status' => '0',
            'main_product' => '1',
            'reg_date' => date('Y-m-d H:i:s'),
            'mod_date' => date('Y-m-d H:i:s')
        );

        $this->db->insert('product_mst', $product_data);
        $product_id = $this->db->insert_id();

        if ($_FILES['product_image']['error'] != 4) {
            $imgflag = 0;
            while ($imgflag == 0) {
                $image_thumb = $this->uploadThumb($product_id);
                $image_url = explode(',', $image_thumb);
                // --------------check all file is exist --------------------------
                foreach ($image_url as $val) {
                    $pos = strpos($val, "/upload");
                    $path = FCPATH . substr($val, $pos);
                    if (file_exists($path)) {
                        $imgflag = 1;
                    } else {
                        $imgflag = 0;
                        break;
                    }
                }
            }
            $update_image_url = array(
                'image_thumb' => $image_url[0],
                'image_medium' => $image_url[1],
                'image_large' => $image_url[2],
                'image_big' => $image_url[3],
                'image_zoom' => $image_url[4]
            );

            $this->db->update('product_mst', $update_image_url, array('product_id' => $product_id));
        }
        $this->uploadOtherImage($product_id);
        return 1;
    }

    function bulkupload($products) {
        if (isset($products) && is_array($products)) {
            $seller_id = $this->session->userdata('seller_id');
            $brand_name = $this->common->getBrandName($this->session->userdata('seller_primary_email'));
            foreach ($products as $data) {
                $skuExist = $this->checkSkuExist($data['sku']);
                if ($skuExist == 0) {
                    $subcatname = $this->common->getSubcategoryName($data['sub_category_id']);
                    $pattern = "";
                    $occasion = "";
                    $fabric = "";
                    $shape = "";
                    $material = "";
                    $gem_stone = "";

                    $variation_ids = "";
                    $variation = array();
                    $variation_name = array();

                    if ($data['pattern'] != "") {
                        $countflag = 1;
                        $patterns = explode(",", $data['pattern']);
                        foreach ($patterns as $val) {
                            $result = $this->common->getVariationByName($val, "work");
                            if (isset($result->variation_id)) {
                                $variation[] = $result->variation_id;
                                if ($countflag) {
                                    $pattern = $result->variation_name;
                                    $countflag = 0;
                                }
                            }
                        }
                    }
                    if ($data['ocassion'] != "") {
                        $countflag = 1;
                        $occasions = explode(",", $data['ocassion']);
                        foreach ($occasions as $val) {
                            $result = $this->common->getVariationByName($val, "occasion");
                            if (isset($result->variation_id)) {
                                $variation[] = $result->variation_id;
                                if ($countflag) {
                                    $occasion = $result->variation_name;
                                    $countflag = 0;
                                }
                            }
                        }
                    }

                    if ($data['fabric'] != "") {
                        $countflag = 1;
                        $fabrics = explode(",", $data['fabric']);
                        foreach ($fabrics as $val) {
                            $result = $this->common->getVariationByName($val, "fabric");
                            if (isset($result->variation_id)) {
                                $variation[] = $result->variation_id;
                                if ($countflag) {
                                    $fabric = $result->variation_name;
                                    $countflag = 0;
                                }
                            }
                        }
                    }
                    if ($data['fabric_care'] != "") {
                        $result = $this->common->getVariationByName($data['fabric_care'], "fabric_care");
                        if (isset($result->variation_id)) {
                            $variation[] = $result->variation_id;
                        }
                    }
                    if ($data['blouse_fabric'] != "") {
                        $result = $this->common->getVariationByName($data['blouse_fabric'], "blouse_fabric");
                        if (isset($result->variation_id)) {
                            $variation[] = $result->variation_id;
                        }
                    }
                    if ($data['bottom_fabric'] != "") {
                        $result = $this->common->getVariationByName($data['bottom_fabric'], "bottom_fabric");
                        if (isset($result->variation_id)) {
                            $variation[] = $result->variation_id;
                        }
                    }
                    if ($data['inner_fabric'] != "") {
                        $result = $this->common->getVariationByName($data['inner_fabric'], "inner_fabric");
                        if (isset($result->variation_id)) {
                            $variation[] = $result->variation_id;
                        }
                    }
                    if ($data['dupatta_fabric'] != "") {
                        $result = $this->common->getVariationByName($data['dupatta_fabric'], "dupatta_fabric");
                        if (isset($result->variation_id)) {
                            $variation[] = $result->variation_id;
                        }
                    }
                    if ($data['sleeve'] != "") {
                        $result = $this->common->getVariationByName($data['sleeve'], "sleeve");
                        if (isset($result->variation_id)) {
                            $variation[] = $result->variation_id;
                        }
                    }
                    if ($data['colour'] != "") {
                        $colour = explode(",", $data['colour']);
                        foreach ($colour as $val) {
                            $result = $this->common->getVariationByName($val, "colour");
                            if (isset($result->variation_id)) {
                                $variation[] = $result->variation_id;
                            }
                        }
                    }
                    if ($data['type'] != "") {
                        $type = explode(",", $data['type']);
                        foreach ($type as $val) {
                            $result = $this->common->getVariationByName($val, "type");
                            if (isset($result->variation_id)) {
                                $variation[] = $result->variation_id;
                            }
                        }
                    }
                    if ($data['size'] != "") {
                        $size = explode(",", $data['size']);
                        foreach ($size as $val) {
                            $result = $this->common->getVariationByName($val, "size");
                            if (isset($result->variation_id)) {
                                $variation[] = $result->variation_id;
                            }
                        }
                    }
                    if ($data['celebrity'] != "") {
                        $celebrity = explode(",", $data['celebrity']);
                        foreach ($celebrity as $val) {
                            $result = $this->common->getVariationByName($val, "celebrity");
                            if (isset($result->variation_id)) {
                                $variation[] = $result->variation_id;
                            }
                        }
                    }
                    if ($data['saree_style'] != "") {
                        $saree_style = explode(",", $data['saree_style']);
                        foreach ($saree_style as $val) {
                            $result = $this->common->getVariationByName($val, "saree_style");
                            if (isset($result->variation_id)) {
                                $variation[] = $result->variation_id;
                            }
                        }
                    }
                    if ($data['salwar_kameez_style'] != "") {
                        $salwar_kameez_style = explode(",", $data['salwar_kameez_style'], "salwar_kameez_style");
                        foreach ($salwar_kameez_style as $val) {
                            $result = $this->common->getVariationByName($val);
                            if (isset($result->variation_id)) {
                                $variation[] = $result->variation_id;
                            }
                        }
                    }
                    if ($data['style'] != "") {
                        $style = explode(",", $data['style']);
                        foreach ($style as $val) {
                            $result = $this->common->getVariationByName($val, "style");
                            if (isset($result->variation_id)) {
                                $variation[] = $result->variation_id;
                            }
                        }
                    }
                    if ($data['collection'] != "") {
                        $collection = explode(",", $data['collection']);
                        foreach ($collection as $val) {
                            $result = $this->common->getVariationByName($val, "collection");
                            if (isset($result->variation_id)) {
                                $variation[] = $result->variation_id;
                            }
                        }
                    }
                    if ($data['saree_border'] != "") {
                        $result = $this->common->getVariationByName($data['saree_border'], "saree_border");
                        if (isset($result->variation_id)) {
                            $variation[] = $result->variation_id;
                        }
                    }
                    if ($data['saree_length'] != "") {
                        $result = $this->common->getVariationByName($data['saree_length'], "saree_length");
                        if (isset($result->variation_id)) {
                            $variation[] = $result->variation_id;
                        }
                    }
                    if ($data['bottom_colour'] != "") {
                        $colour = explode(",", $data['bottom_colour']);
                        foreach ($colour as $val) {
                            $result = $this->common->getVariationByName($val, "bottom_colour");
                            if (isset($result->variation_id)) {
                                $variation[] = $result->variation_id;
                            }
                        }
                    }
                    if ($data['dupatta_colour'] != "") {
                        $colour = explode(",", $data['dupatta_colour']);
                        foreach ($colour as $val) {
                            $result = $this->common->getVariationByName($val, "dupatta_colour");
                            if (isset($result->variation_id)) {
                                $variation[] = $result->variation_id;
                            }
                        }
                    }
                    if ($data['bottom_size'] != "") {
                        $colour = explode(",", $data['bottom_size']);
                        foreach ($colour as $val) {
                            $result = $this->common->getVariationByName($val, "bottom_size");
                            if (isset($result->variation_id)) {
                                $variation[] = $result->variation_id;
                            }
                        }
                    }
                    if ($data['top_size'] != "") {
                        $colour = explode(",", $data['top_size']);
                        foreach ($colour as $val) {
                            $result = $this->common->getVariationByName($val, "top_size");
                            if (isset($result->variation_id)) {
                                $variation[] = $result->variation_id;
                            }
                        }
                    }
                    if ($data['dupatta_size'] != "") {
                        $colour = explode(",", $data['dupatta_size']);
                        foreach ($colour as $val) {
                            $result = $this->common->getVariationByName($val, "dupatta_size");
                            if (isset($result->variation_id)) {
                                $variation[] = $result->variation_id;
                            }
                        }
                    }
                    if ($data['stitching'] != "") {
                        $result = $this->common->getVariationByName($data['stitching'], "stitching");
                        if (isset($result->variation_id)) {
                            $variation[] = $result->variation_id;
                        }
                    }
                    if ($data['fine_or_fashion'] != "") {
                        $result = $this->common->getVariationByName($data['fine_or_fashion'], "fine_or_fashion");
                        if (isset($result->variation_id)) {
                            $variation[] = $result->variation_id;
                        }
                    }
                    if ($data['gender'] != "") {
                        $result = $this->common->getVariationByName($data['gender'], "gender");
                        if (isset($result->variation_id)) {
                            $variation[] = $result->variation_id;
                        }
                    }
                    if ($data['material'] != "") {
                        $countflag = 1;
                        $materials = explode(",", $data['material']);
                        foreach ($materials as $val) {
                            $result = $this->common->getVariationByName($val, "material");
                            if (isset($result->variation_id)) {
                                $variation[] = $result->variation_id;
                                if ($countflag) {
                                    $material = $result->variation_name;
                                    $countflag = 0;
                                }
                            }
                        }
                    }                    
                    if ($data['metals_type'] != "") {
                        $metals_type = explode(",", $data['metals_type']);
                        foreach ($metals_type as $val) {
                            $result = $this->common->getVariationByName($val, "metals_type");
                            if (isset($result->variation_id)) {
                                $variation[] = $result->variation_id;
                            }
                        }
                    }
                    if ($data['style'] != "") {
                        $style = explode(",", $data['style']);
                        foreach ($style as $val) {
                            $result = $this->common->getVariationByName($val, "style");
                            if (isset($result->variation_id)) {
                                $variation[] = $result->variation_id;
                            }
                        }
                    }
                    if ($data['gem_stone'] != "") {
                        $result = $this->common->getVariationByName($data['gem_stone'], "gem_stone");
                        if (isset($result->variation_id)) {
                            $variation[] = $result->variation_id;
                            $gem_stone = $result->variation_name;
                        }
                    }
                    if ($data['shape'] != "") {
                        $result = $this->common->getVariationByName($data['shape'], "shape");
                        if (isset($result->variation_id)) {
                            $variation[] = $result->variation_id;
                            $shape = $result->variation_name;
                        }
                    }
                    if ($data['setting_type'] != "") {
                        $setting_type = explode(",", $data['setting_type']);
                        foreach ($setting_type as $val) {
                            $result = $this->common->getVariationByName($val, "setting_type");
                            if (isset($result->variation_id)) {
                                $variation[] = $result->variation_id;
                            }
                        }
                    }
                    if ($data['fit'] != "") {
                        $fit = explode(",", $data['fit']);
                        foreach ($fit as $val) {
                            $result = $this->common->getVariationByName($val, "fit");
                            if (isset($result->variation_id)) {
                                $variation[] = $result->variation_id;
                            }
                        }
                    }
                    if ($data['rise'] != "") {
                        $rise = explode(",", $data['rise']);
                        foreach ($rise as $val) {
                            $result = $this->common->getVariationByName($val, "rise");
                            if (isset($result->variation_id)) {
                                $variation[] = $result->variation_id;
                            }
                        }
                    }
                    $variation_ids = implode(",", $variation);

                    if ($data['main_category_id'] == 1) {
                        $product_name = ucfirst($brand_name) . " " . ucfirst($occasion) . " " . ucfirst($pattern) . " Womens " . ucfirst($fabric) . " " . ucfirst($subcatname);
                    } else if ($data['main_category_id'] == 2) {
                        $product_name = ucfirst($brand_name) . " " . ucfirst($occasion) . " " . ucfirst($shape) . " " . ucfirst($material) . " " . ucfirst($gem_stone) . " " . ucfirst($subcatname);
                    } else if ($data['main_category_id'] == 3) {
                        $product_name = ucfirst($data['company']) . " Women's Leggings";
                    }


                    $product_supc = $this->getMaxSupcId();
                    $table_price = explode("|", $this->getSettlementPrice($data['selling_price']));
                    $shipping_charge = $this->getShippingCharge($data['weight']);
                    $product_data = array(
                        'seller_id' => $seller_id,
                        'main_category_id' => $data['main_category_id'],
                        'sub_category_id' => $data['sub_category_id'],
                        'product_name' => $product_name,
                        'product_supc' => $product_supc,
                        'product_desc' => $data['product_desc'],
                        'meta_title' => $data['meta_title'],
                        'meta_desc' => $data['meta_desc'],
                        'meta_keyword' => $data['meta_keyword'],
                        'brand' => $brand_name,
                        'style_code' => $data['style_code'],
                        'sku' => $data['sku'],
                        'mrp' => $data['mrp'],
                        'selling_price' => $data['selling_price'],
                        'web_price' => $data['selling_price'],
                        'settlement_price' => $table_price[7],
                        'commission_fee' => $table_price[0],
                        'fixed_fee' => $table_price[1],
                        'service_fee' => $table_price[2],
                        'listing_fee' => $table_price[3],
                        'marketing_fee' => $table_price[4],
                        'payment_fee' => $table_price[5],
                        'other_fee' => $table_price[6],
                        'weight' => $data['weight'],
                        'shipping_time' => $data['shipping_time'],
                        'shipping_charge' => $shipping_charge,
                        'qty' => $data['qty'],
                        'variation_id' => $variation_ids,
                        'width' => $data['width'],
                        'height' => $data['height'],
                        'length' => $data['length'],
                        'diameter' => $data['diameter'],
                        'company' => $data['company'],
                        'approve_status' => '0',
                        'live_status' => '0',
                        'main_product' => '1',
                        'reg_date' => date('Y-m-d H:i:s'),
                        'mod_date' => date('Y-m-d H:i:s')
                    );

                    $this->db->insert('product_mst', $product_data);
                    $product_id = $this->db->insert_id();

                    $imgflag = 0;
                    while ($imgflag == 0) {
                        $image_thumb = $this->bulkUploadImageResize($product_id, $data['image_url']);
                        $image_url = explode(',', $image_thumb);
                        // --------------check all file is exist --------------------------
                        foreach ($image_url as $val) {
                            $pos = strpos($val, "/upload");
                            $path = FCPATH . substr($val, $pos);
                            if (file_exists($path)) {
                                $imgflag = 1;
                            } else {
                                $imgflag = 0;
                                break;
                            }
                        }
                    }

                    $update_image_url = array(
                        'image_thumb' => $image_url[0],
                        'image_medium' => $image_url[1],
                        'image_large' => $image_url[2],
                        'image_big' => $image_url[3],
                        'image_zoom' => $image_url[4]
                    );

                    $this->db->update('product_mst', $update_image_url, array('product_id' => $product_id));
                    if ($data['other_image_url'] != "") {
                        $this->bulkUploadOtherImage($data['other_image_url'], $product_id);
                    }
                }
            }
        }
        return 1;
    }

    function bulkUploadImageResize($product_id, $image_url) {
        $pathMain =  FCPATH . "/upload/" . $this->session->userdata('seller_id') . "/product/";
        
        $pos = strpos($image_url, "/upload");
        $sourcepath = FCPATH . substr($image_url, $pos);

        $thumbfile = $product_id;

        $destinationfile1 = $thumbfile . '_100x122.jpg';
        $destinationfile2 = $thumbfile . '_233x284.jpg';
        $destinationfile3 = $thumbfile . '_300x366.jpg';
        $destinationfile4 = $thumbfile . '_420x512.jpg';
        $destinationfile5 = $thumbfile . '_850x1036.jpg';

        $destinationpath1 = $pathMain . $destinationfile1;
        $destinationpath2 = $pathMain . $destinationfile2;
        $destinationpath3 = $pathMain . $destinationfile3;
        $destinationpath4 = $pathMain . $destinationfile4;
        $destinationpath5 = $pathMain . $destinationfile5;


        $this->common->resize_image($sourcepath, $destinationpath1, '100', '122');
        $this->common->resize_image($sourcepath, $destinationpath2, '233', '284');
        $this->common->resize_image($sourcepath, $destinationpath3, '300', '366');
        $this->common->resize_image($sourcepath, $destinationpath4, '420', '512');
        $this->common->resize_image($sourcepath, $destinationpath5, '850', '1036');

        $destinationurl1 = base_url() . "upload/" . $this->session->userdata('seller_id') . "/product/" . $destinationfile1;
        $destinationurl2 = base_url() . "upload/" . $this->session->userdata('seller_id') . "/product/" . $destinationfile2;
        $destinationurl3 = base_url() . "upload/" . $this->session->userdata('seller_id') . "/product/" . $destinationfile3;
        $destinationurl4 = base_url() . "upload/" . $this->session->userdata('seller_id') . "/product/" . $destinationfile4;
        $destinationurl5 = base_url() . "upload/" . $this->session->userdata('seller_id') . "/product/" . $destinationfile5;

        return $destinationurl1 . ',' . $destinationurl2 . ',' . $destinationurl3 . ',' . $destinationurl4 . ',' . $destinationurl5;
    }

    function bulkUploadOtherImage($other_image, $product_id) {
        if ($other_image != "") {
            $pathMain =  FCPATH . "/upload/" . $this->session->userdata('seller_id') . "/product/";
            $images = explode(",", $other_image);

            foreach ($images as $image_url) {

                $pos = strpos($image_url, "/upload");
                $sourcepath = FCPATH . substr($image_url, $pos);
                $thumbfile = $product_id;

                $destinationfile1 = $thumbfile . '_0_other_100x122.jpg';
                $destinationfile2 = $thumbfile . '_1_other_420x512.jpg';
                $destinationfile3 = $thumbfile . '_2_other_850x1036.jpg';

                $destinationpath1 = $pathMain . $destinationfile1;
                $destinationpath2 = $pathMain . $destinationfile2;
                $destinationpath3 = $pathMain . $destinationfile3;

                $this->common->resize_image($sourcepath, $destinationpath1, '100', '122');
                $this->common->resize_image($sourcepath, $destinationpath2, '420', '512');
                $this->common->resize_image($sourcepath, $destinationpath3, '850', '1036');


                $destinationurl1 = base_url() . "upload/" . $this->session->userdata('seller_id') . "/product/" . $destinationfile1;
                $destinationurl2 = base_url() . "upload/" . $this->session->userdata('seller_id') . "/product/" . $destinationfile2;
                $destinationurl3 = base_url() . "upload/" . $this->session->userdata('seller_id') . "/product/" . $destinationfile3;

                $productimages = array(
                    'product_id' => $product_id,
                    'image_thumb' => $destinationurl1,
                    'image_big' => $destinationurl2,
                    'image_zoom' => $destinationurl3
                );
                $this->db->insert('product_images', $productimages);
            }
        }
        return 1;
    }

    function getShippingCharge($weight) {
        $shipping_rate = $this->common->shippingCharge();
        $actual_weight = round($weight);
        $fact = $actual_weight / 500;
        $actual_fact = ceil($fact);
        $shipping_charge = $shipping_rate->shipping_charge * $actual_fact;
        return $shipping_charge;
    }

    function updateProductData() {
        $data = $_POST;
        $product_id = $this->input->post('product_id');
        $brand_name = $this->common->getBrandName($this->session->userdata('seller_primary_email'));
        $subcatname = $this->common->getSubcategoryName($data['sub_category_id']);
        $fabric = (isset($data['variations1'][0])) ? $this->common->getVariationName($data['variations1'][0]) : "";
        $occasion = (isset($data['variations9'][0])) ? $this->common->getVariationName($data['variations9'][0]) : "";
        $pattern = (isset($data['variations7'][0])) ? $this->common->getVariationName($data['variations7'][0]) : "";
        $shape = (isset($data['variations17'][0])) ? $this->common->getVariationName($data['variations17'][0]) : "";
        $material = (isset($data['variations15'][0])) ? $this->common->getVariationName($data['variations15'][0]) : "";
        $gem_stone = (isset($data['variations16'][0])) ? $this->common->getVariationName($data['variations16'][0]) : "";

        if (isset($data['variations'])) {
            $variations = $data['variations'];
        } else {
            $variations = array();
        }

        if ($data['main_category_id'] == 1) {
            for ($i = 1; $i <= 12; $i++) {
                if (isset($data['variations' . $i]) && is_array($data['variations' . $i])) {
                    $variations = array_merge($variations, $data['variations' . $i]);
                }
            }
            $product_name = ucfirst($brand_name) . " " . ucfirst($occasion) . " " . ucfirst($pattern) . " Womens " . ucfirst($fabric) . " " . ucfirst($subcatname);
        } else if ($data['main_category_id'] == 2) {
            if (isset($data['variations9']) && is_array($data['variations9'])) {
                $variations = array_merge($variations, $data['variations9']);
            }
            for ($i = 13; $i <= 17; $i++) {
                if (isset($data['variations' . $i]) && is_array($data['variations' . $i])) {
                    $variations = array_merge($variations, $data['variations' . $i]);
                }
            }
            $product_name = ucfirst($brand_name) . " " . ucfirst($occasion) . " " . ucfirst($shape) . " " . ucfirst($material) . " " . ucfirst($gem_stone) . " " . ucfirst($subcatname);
        } else if ($data['main_category_id'] == 3) {
            if (isset($data['variations1']) && is_array($data['variations1'])) {
                $variations = array_merge($variations, $data['variations1']);
            }
            if (isset($data['variations2']) && is_array($data['variations2'])) {
                $variations = array_merge($variations, $data['variations2']);
            }
            if (isset($data['variations7']) && is_array($data['variations7'])) {
                $variations = array_merge($variations, $data['variations7']);
            }
            if (isset($data['variations9']) && is_array($data['variations9'])) {
                $variations = array_merge($variations, $data['variations9']);
            }
            if (isset($data['variations17']) && is_array($data['variations17'])) {
                $variations = array_merge($variations, $data['variations17']);
            }
            $product_name = ucfirst($data['company']) . " Women's Leggings";
        }

        $variations_id = implode(',', $variations);
        $shipping_charge = $this->getShippingCharge($data['weight']);
        $table_price = explode("|", $this->getSettlementPrice($data['selling_price']));
        $product_data = array(
            'main_category_id' => $data['main_category_id'],
            'sub_category_id' => $data['sub_category_id'],
            'product_name' => $product_name,
            'product_desc' => $data['product_desc'],
            'meta_title' => $data['meta_title'],
            'meta_desc' => $data['meta_desc'],
            'meta_keyword' => $data['meta_keyword'],
            'brand' => $brand_name,
            'style_code' => $data['style_code'],
            'sku' => $data['sku'],
            'mrp' => $data['mrp'],
            'selling_price' => $data['selling_price'],
            'web_price' => $data['selling_price'],
            'settlement_price' => $table_price[7],
            'commission_fee' => $table_price[0],
            'fixed_fee' => $table_price[1],
            'service_fee' => $table_price[2],
            'listing_fee' => $table_price[3],
            'marketing_fee' => $table_price[4],
            'payment_fee' => $table_price[5],
            'other_fee' => $table_price[6],
            'weight' => $data['weight'],
            'shipping_time' => $data['shipping_time'],
            'shipping_charge' => $shipping_charge,
            'qty' => $data['qty'],
            'variation_id' => $variations_id,
            'width' => $data['width'],
            'height' => $data['height'],
            'length' => $data['length'],
            'diameter' => $data['diameter'],
            'company' => $data['company'],
            'approve_status' => '0',
            'live_status' => '0',
            'mod_date' => date('Y-m-d H:i:s')
        );

        $this->db->update('product_mst', $product_data, array('product_id' => $product_id));

        if ($_FILES['product_image']['error'] != 4) {
            $imgflag = 0;
            while ($imgflag == 0) {
                $image_thumb = $this->uploadThumb($product_id);
                $image_url = explode(',', $image_thumb);
                // --------------check all file is exist --------------------------
                foreach ($image_url as $val) {
                    $pos = strpos($val, "/upload");
                    $path = FCPATH . substr($val, $pos);
                    if (file_exists($path)) {
                        $imgflag = 1;
                    } else {
                        $imgflag = 0;
                        break;
                    }
                }
            }

            $update_image_url = array(
                'image_thumb' => $image_url[0],
                'image_medium' => $image_url[1],
                'image_large' => $image_url[2],
                'image_big' => $image_url[3],
                'image_zoom' => $image_url[4]
            );
            $this->db->update('product_mst', $update_image_url, array('product_id' => $product_id));
        }
        $this->uploadOtherImage($product_id);
        return 1;
    }

    function getMaxSupcId() {
        $this->db->select('max(product_supc) as product_supc');
        $this->db->from('product_mst');
        $query = $this->db->get();
        $data = $query->row();

        if ($data->product_supc == "") {
            $this->db->select('product_supc');
            $this->db->from('general_id_mst');
            $query = $this->db->get();
            $data = $query->row();
        }
        return $data->product_supc + 1;
    }

    function getSettlementPrice($sales_price) {
        $commission = $this->common->getSellerGroupData($this->session->userdata('seller_primary_email'));
        $commission_fee = $commission->commission_fee;
        $fixed_fee = $commission->fixed_fee;
        $service_fee = $commission->service_fee;
        $listing_fee = $commission->listing_fee;
        $marketing_fee = $commission->marketing_fee;
        $pay_fee = $commission->pay_fee;
        $other_fee = $commission->other_fee;

        $commission_charge = $sales_price * $commission_fee / 100;
        //$service_charge = ($commission_charge + $fixed_fee + $listing_fee + $other_fee) * $service_fee / 100;
        $service_charge = $commission_charge * $service_fee / 100;
        $marketing_charge = $sales_price * $marketing_fee / 100;
        $pay_charge = $sales_price * $pay_fee / 100;

        $settlement_value = $sales_price - ($commission_charge + $service_charge + $marketing_charge + $pay_charge + $fixed_fee + $listing_fee + $other_fee);
        return round($commission_charge) . "|" . round($fixed_fee) . "|" . round($service_charge) . "|" . round($listing_fee) . "|" . round($marketing_charge) . "|" . round($pay_charge) . "|" . round($other_fee) . "|" . round($settlement_value);
    }

    function uploadThumb($product_id) {

        $pathMain =  FCPATH . "/upload/" . $this->session->userdata('seller_id') . "/product/";
        $thumbfile = $product_id;

        $destinationfile1 = $thumbfile . '_100x122.jpg';
        $destinationfile2 = $thumbfile . '_233x284.jpg';
        $destinationfile3 = $thumbfile . '_300x366.jpg';
        $destinationfile4 = $thumbfile . '_420x512.jpg';
        $destinationfile5 = $thumbfile . '_850x1036.jpg';
        $result = $this->common->do_upload('product_image', $pathMain, $thumbfile, TRUE);

        $sourcepath = $result['upload_data']['full_path'];
        $destinationpath1 = $pathMain . $destinationfile1;
        $destinationpath2 = $pathMain . $destinationfile2;
        $destinationpath3 = $pathMain . $destinationfile3;
        $destinationpath4 = $pathMain . $destinationfile4;
        $destinationpath5 = $pathMain . $destinationfile5;

        $this->common->resize_image($sourcepath, $destinationpath1, '100', '122');
        $this->common->resize_image($sourcepath, $destinationpath2, '233', '284');
        $this->common->resize_image($sourcepath, $destinationpath3, '300', '366');
        $this->common->resize_image($sourcepath, $destinationpath4, '420', '512');
        $this->common->resize_image($sourcepath, $destinationpath5, '850', '1036');

        $destinationurl1 = base_url() . "upload/" . $this->session->userdata('seller_id') . "/product/" . $destinationfile1;
        $destinationurl2 = base_url() . "upload/" . $this->session->userdata('seller_id') . "/product/" . $destinationfile2;
        $destinationurl3 = base_url() . "upload/" . $this->session->userdata('seller_id') . "/product/" . $destinationfile3;
        $destinationurl4 = base_url() . "upload/" . $this->session->userdata('seller_id') . "/product/" . $destinationfile4;
        $destinationurl5 = base_url() . "upload/" . $this->session->userdata('seller_id') . "/product/" . $destinationfile5;

        unlink($sourcepath);
        return $destinationurl1 . ',' . $destinationurl2 . ',' . $destinationurl3 . ',' . $destinationurl4 . ',' . $destinationurl5;
    }

    function uploadOtherImage($product_id) {
        if ($_FILES['product_images']['error'][0] != 4) {

            $pathMain =  FCPATH . "/upload/" . $this->session->userdata('seller_id') . "/product/";
            $thumbfile = $product_id;

            $files = $_FILES['product_images'];
            $cpt = count($_FILES['product_images']['name']);
            for ($i = 0; $i < $cpt; $i++) {

                $destinationfile1 = $thumbfile . '_' . $i . '_other_100x122.jpg';
                $destinationfile2 = $thumbfile . '_' . $i . '_other_420x512.jpg';
                $destinationfile3 = $thumbfile . '_' . $i . '_other_850x1036.jpg';

                $_FILES['files']['name'] = $files['name'][$i];
                $_FILES['files']['type'] = $files['type'][$i];
                $_FILES['files']['tmp_name'] = $files['tmp_name'][$i];
                $_FILES['files']['error'] = $files['error'][$i];
                $_FILES['files']['size'] = floor($files['size'][$i] * 100) / 100;

                $result = $this->common->do_upload('files', $pathMain, $thumbfile, TRUE);
                $sourcepath = $result['upload_data']['full_path'];

                $destinationpath1 = $pathMain . $destinationfile1;
                $destinationpath2 = $pathMain . $destinationfile2;
                $destinationpath3 = $pathMain . $destinationfile3;

                $this->common->resize_image($sourcepath, $destinationpath1, '100', '122');
                $this->common->resize_image($sourcepath, $destinationpath2, '420', '512');
                $this->common->resize_image($sourcepath, $destinationpath3, '850', '1036');

                $destinationurl1 = base_url() . "upload/" . $this->session->userdata('seller_id') . "/product/" . $destinationfile1;
                $destinationurl2 = base_url() . "upload/" . $this->session->userdata('seller_id') . "/product/" . $destinationfile2;
                $destinationurl3 = base_url() . "upload/" . $this->session->userdata('seller_id') . "/product/" . $destinationfile3;

                unlink($sourcepath);

                $productimages = array(
                    'product_id' => $product_id,
                    'image_thumb' => $destinationurl1,
                    'image_big' => $destinationurl2,
                    'image_zoom' => $destinationurl3
                );
                $this->db->insert('product_images', $productimages);
            }
        }
        return 1;
    }

    function modelEditProduct() {
        if (isset($_POST['product_id'])) {
            $selling_price = $this->input->post('selling_price');
            $settlement_price = explode("|", $this->getSettlementPrice($selling_price));
            $product_data = array(
                'live_status' => $this->input->post('live_status'),
                'mrp' => $this->input->post('mrp'),
                'selling_price' => $this->input->post('selling_price'),
                'web_price' => $this->input->post('selling_price'),
                'settlement_price' => $settlement_price[7],
                'qty' => $this->input->post('qty')
            );
            $this->db->update('product_mst', $product_data, array('product_id' => $this->input->post('product_id')));
        }
    }

    function modelViewProduct() {
        if (isset($_POST['product_id'])) {
            $product_data = array(
                'approve_status' => $this->input->post('approve_status'),
                'live_status' => '0',
                'reject_reason' => $this->input->post('reject_reason'),
                'updator_name' => $this->session->userdata('username'),
                'updator_primary_email' => $this->session->userdata('primary_email')
            );
            $this->db->update('product_mst', $product_data, array('product_id' => $this->input->post('product_id')));
        }
    }

    function getProductVariation($product_id) {
        $variation_id = $this->input->post('variation_id');
        $product_variation = $this->common->getProductVariationById($variation_id);
        foreach ($product_variation as $val) {
            $variation[$val->variation_type][] = $val->variation_name;
        }
        echo json_encode($variation);
    }

    function addProductBySupcData() {
        $data = $_POST;
        $product = $this->common->getProductById($data['product_id']);
        $productimages = $this->common->getProductImageById($data['product_id']);

        $seller_id = $this->common->getSellerId($this->session->userdata('seller_primary_email'));
        $table_price = explode("|", $this->getSettlementPrice($data['selling_price']));
        $brand_name = $this->common->getBrandName($this->session->userdata('seller_primary_email'));
        $subcatname = $this->common->getSubcategoryName($product->sub_category_id);

        $productvariation = explode(",", $product->variation_id);

        if ($product->main_category_id == 1) {

            $occasionvariation = $this->occasionVariation();
            $patternvariation = $this->patternVariation();
            $fabricvariation = $this->fabricVariation();

            $occasionidarray = array_intersect($occasionvariation, $productvariation);
            $patternidarray = array_intersect($patternvariation, $productvariation);
            $fabricidarray = array_intersect($fabricvariation, $productvariation);

            if (isset($occasionidarray)) {
                foreach ($occasionidarray as $val) {
                    $occasion = $this->common->getVariationName($val);
                }
            }

            if (isset($patternidarray)) {
                foreach ($patternidarray as $val) {
                    $pattern = $this->common->getVariationName($val);
                }
            }

            if (isset($fabricidarray)) {
                foreach ($fabricidarray as $val) {
                    $fabric = $this->common->getVariationName($val);
                    break;
                }
            }

            $product_name = ucfirst($brand_name) . " " . ucfirst($occasion) . " " . ucfirst($pattern) . " Womens " . ucfirst($fabric) . " " . ucfirst($subcatname);
        } else if ($product->main_category_id == 2) {

            $occasionvariation = $this->occasionVariation();
            $shapevariation = $this->shapeVariation();
            $materialvariation = $this->materialVariation();
            $gemstonevariation = $this->gemStoneVariation();

            $occasionidarray = array_intersect($occasionvariation, $productvariation);
            $shapeidarray = array_intersect($shapevariation, $productvariation);
            $materialidarray = array_intersect($materialvariation, $productvariation);
            $gemstoneidarray = array_intersect($gemstonevariation, $productvariation);

            if (isset($occasionidarray)) {
                foreach ($occasionidarray as $val) {
                    $occasion = $this->common->getVariationName($val);
                }
            }

            if (isset($shapeidarray)) {
                foreach ($shapeidarray as $val) {
                    $shape = $this->common->getVariationName($val);
                }
            }

            if (isset($materialidarray)) {
                foreach ($materialidarray as $val) {
                    $material = $this->common->getVariationName($val);
                }
            }

            if (isset($gemstoneidarray)) {
                foreach ($gemstoneidarray as $val) {
                    $gem_stone = $this->common->getVariationName($val);
                }
            }
            $product_name = ucfirst($brand_name) . " " . ucfirst($occasion) . " " . ucfirst($shape) . " " . ucfirst($material) . " " . ucfirst($gem_stone) . " " . ucfirst($subcatname);
        } else if ($product->main_category_id == 3) {
            $product_name = $product->product_name;
        }

        $product_data = array(
            'seller_id' => $seller_id,
            'main_category_id' => $product->main_category_id,
            'sub_category_id' => $product->sub_category_id,
            'product_name' => $product_name,
            'product_supc' => $product->product_supc,
            'product_desc' => $product->product_desc,
            'meta_title' => $product->meta_title,
            'meta_desc' => $product->meta_desc,
            'meta_keyword' => $product->meta_keyword,
            'brand' => $brand_name,
            'style_code' => $product->style_code,
            'image_thumb' => $product->image_thumb,
            'image_medium' => $product->image_medium,
            'image_large' => $product->image_large,
            'image_big' => $product->image_big,
            'image_zoom' => $product->image_zoom,
            'sku' => $data['sku'],
            'mrp' => $data['mrp'],
            'selling_price' => $data['selling_price'],
            'web_price' => $data['selling_price'],
            'settlement_price' => $table_price[7],
            'commission_fee' => $table_price[0],
            'fixed_fee' => $table_price[1],
            'service_fee' => $table_price[2],
            'listing_fee' => $table_price[3],
            'marketing_fee' => $table_price[4],
            'payment_fee' => $table_price[5],
            'other_fee' => $table_price[6],
            'weight' => $product->weight,
            'shipping_time' => $data['sla'],
            'shipping_charge' => $product->shipping_charge,
            'qty' => $data['qty'],
            'variation_id' => $product->variation_id,
            'width' => $product->width,
            'height' => $product->height,
            'length' => $product->length,
            'diameter' => $product->diameter,
            'company' => $product->company,
            'approve_status' => '1',
            'live_status' => '0',
            'main_product' => '0',
            'reg_date' => date('Y-m-d H:i:s'),
            'mod_date' => date('Y-m-d H:i:s')
        );

        $this->db->insert('product_mst', $product_data);
        $product_id = $this->db->insert_id();

        // OTHERS IMAGES URL COPY

        foreach ($productimages as $image) {

            $productimages = array(
                'product_id' => $product_id,
                'image_thumb' => $image->image_thumb,
                'image_big' => $image->image_big,
                'image_zoom' => $image->image_zoom
            );
            $this->db->insert('product_images', $productimages);
        }
    }

    function occasionVariation() {
        $query = $this->db->get_where('variation_mst', array('variation_type' => 'occasion'));
        $data = $query->result();
        foreach ($data as $val) {
            $occasionvariation[] = $val->variation_id;
        }
        return $occasionvariation;
    }

    function patternVariation() {
        $query = $this->db->get_where('variation_mst', array('variation_type' => 'work'));
        $data = $query->result();
        foreach ($data as $val) {
            $patternvariation[] = $val->variation_id;
        }
        return $patternvariation;
    }

    function fabricVariation() {
        $query = $this->db->get_where('variation_mst', array('variation_type' => 'fabric'));
        $data = $query->result();
        foreach ($data as $val) {
            $fabricvariation[] = $val->variation_id;
        }
        return $fabricvariation;
    }

    function shapeVariation() {
        $query = $this->db->get_where('variation_mst', array('variation_type' => 'shape'));
        $data = $query->result();
        foreach ($data as $val) {
            $shapevariation[] = $val->variation_id;
        }
        return $shapevariation;
    }

    function materialVariation() {
        $query = $this->db->get_where('variation_mst', array('variation_type' => 'material'));
        $data = $query->result();
        foreach ($data as $val) {
            $materialvariation[] = $val->variation_id;
        }
        return $materialvariation;
    }

    function gemStoneVariation() {
        $query = $this->db->get_where('variation_mst', array('variation_type' => 'gem_stone'));
        $data = $query->result();
        foreach ($data as $val) {
            $gemstonevariation[] = $val->variation_id;
        }
        return $gemstonevariation;
    }

    function getProductViewData($product_id) {
        $where = array(
            'product_id' => $product_id
        );
        $query = $this->db->get_where('product_mst', $where);
        return $query->row();
    }

    function getProductViewImages($product_id) {
        $where = array(
            'product_id' => $product_id
        );
        $query = $this->db->get_where('product_images', $where);
        return $query->result();
    }

    function getProductViewVariation($product_id) {
        $variation_id = $this->wcommon->getProductVariationId($product_id);
        $product_variation = $this->wcommon->getProductVariationById($variation_id);
        foreach ($product_variation as $val) {
            if ($val->variation_type == "colour") {
                $colour[$val->variation_type][] = array('id' => $val->variation_id, 'name' => $val->variation_name, 'code' => $val->variation_code);
            } else if ($val->variation_type == "size") {
                $size[$val->variation_type][] = array('id' => $val->variation_id, 'name' => $val->variation_name);
            } else {
                $variation['other'][$val->variation_type][] = $val->variation_name;
            }
        }
        if (!isset($colour)) {
            $colour['colour'][] = array();
        }
        if (!isset($size)) {
            $size['size'][] = array();
        }

        $result = array_merge($colour, $size, $variation);
        return $result;
    }

    function deleteProductPermenent() {
        if (isset($_POST['allProduct'])) {
            $products = $_POST['allProduct'];
            $this->db->where_in('product_id', $products);
            $this->db->update('product_mst', array('approve_status' => 4));
            return 1;
        } else {
            return 0;
        }
    }

}
