<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Wcommon {

    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('image_lib');
    }

    function getCustomerId($primary_email) {
        $query = $this->CI->db->get_where('customer_mst', array('primary_email' => $primary_email));
        return $query->row()->customer_id;
    }

    function getSellerName($seller_id) {
        $query = $this->CI->db->get_where('seller_mst', array('seller_id' => $seller_id));
        return $query->row()->business_name;
    }

    function getSellerRate($seller_id) {
        $where = array(
            'seller_id' => $seller_id,
            'order_status' => '4',
            'prate <>' => ""
        );
        $query = $this->CI->db->get_where('order_mst', $where);
        $data = $query->result();
        $count = 0;
        $totalrate = 0;
        $avgrate = 0;
        foreach ($data as $val) {
            $totalrate += $val->prate;
            $count += 1;
        }
        if ($count > 0 && $totalrate > 0) {
            $avgrate = $totalrate / $count;
        }
        return $avgrate;
    }

    function getSubcategory() {
        $query = $this->CI->db->get('subcategory_mst');
        return $query->result();
    }

    function getSubcategoryName($sub_category_id) {
        $query = $this->CI->db->get_where('subcategory_mst', array('subcategory_id' => $sub_category_id));
        return $query->row()->subcategory_name;
    }

    function getVariationName($variation_id) {
        $query = $this->CI->db->get_where('variation_mst', array('variation_id' => $variation_id));
        return (($query->row() != "") ? $query->row()->variation_name : '');
    }

    function getAllProducts($subcategory_id, $variation_id = null) {
        $variation_where = "";
        if ($variation_id != "") {
            $variation_where .= " and FIND_IN_SET(" . $variation_id . ",variation_id)";
        }
        $query = $this->CI->db->query("SELECT * FROM product_mst as t1 
             WHERE approve_status = '1' and live_status = '1' and sub_category_id = ' " . $subcategory_id . "' and selling_price = 
             (SELECT MIN(selling_price)
             FROM product_mst AS t2
             WHERE t2.product_supc = t1.product_supc and t2.qty > 0 and approve_status = '1' and live_status = '1')" . $variation_where . " ORDER BY t1.mod_date DESC ", FALSE);
        return $query->result();
    }

    function getAllProductsFilter($subcategory_id, $min_price, $max_price, $variation_id) {
        if ($variation_id != "") {
            $variation = explode(",", $variation_id);
            $variation_where = "";
            foreach ($variation as $val) {
                $variation_where .= " and FIND_IN_SET(" . $val . ",variation_id)";
            }
            $query = $this->CI->db->query("SELECT * FROM product_mst as t1 
             WHERE               
             selling_price = 
             (SELECT MIN(selling_price)
             FROM product_mst AS t2
             WHERE t2.product_supc = t1.product_supc and t2.qty > 0 and t2.selling_price >= " . $min_price . " and t2.selling_price <= " . $max_price . ") and 
             approve_status = '1' and 
             live_status = '1' and 
             sub_category_id = '" . $subcategory_id . "'" . $variation_where . " ORDER BY t1.mod_date DESC ", FALSE);
        } else {
            $query = $this->CI->db->query("SELECT * FROM product_mst as t1 
             WHERE approve_status = '1' and live_status = '1' and sub_category_id = ' " . $subcategory_id . "' and selling_price = 
             (SELECT MIN(selling_price)
             FROM product_mst AS t2
             WHERE t2.product_supc = t1.product_supc and t2.qty > 0 and approve_status = '1' and live_status = '1' and t2.selling_price >= " . $min_price . " and t2.selling_price <= " . $max_price . ") ORDER BY t1.mod_date DESC ", FALSE);
        }
        return $query->result();
    }

    function getAllJewelleryProducts($subcategory_id, $variation_id = null) {
        $variation_where = "";
        $subcategory = "";
        if ($variation_id != "") {
            $variation_where .= " and FIND_IN_SET(" . $variation_id . ",variation_id)";
        }
        if ($subcategory_id != "") {
            $subcategory = "and sub_category_id = '" . $subcategory_id . "'";
        }
        $query = $this->CI->db->query("SELECT * FROM product_mst as t1 
             WHERE approve_status = '1' and live_status = '1' and main_category_id = '2' " . $subcategory . "and selling_price = 
             (SELECT MIN(selling_price)
             FROM product_mst AS t2
             WHERE t2.product_supc = t1.product_supc and t2.qty > 0 and approve_status = '1' and live_status = '1')" . $variation_where . " ORDER BY t1.mod_date DESC ", FALSE);
        return $query->result();
    }

    function getAllJewelleryProductsFilter($subcategory_id, $min_price, $max_price, $variation_id) {
        $subcategory = "";
        if ($variation_id != "") {
            $variation = explode(",", $variation_id);
            $variation_where = "";            
            if ($subcategory_id != "") {
                $subcategory = "and sub_category_id = '" . $subcategory_id . "'";
            }
            foreach ($variation as $val) {
                $variation_where .= " and FIND_IN_SET(" . $val . ",variation_id)";
            }
            $query = $this->CI->db->query("SELECT * FROM product_mst as t1 
             WHERE               
             selling_price = 
             (SELECT MIN(selling_price)
             FROM product_mst AS t2
             WHERE t2.product_supc = t1.product_supc and t2.qty > 0 and t2.selling_price >= " . $min_price . " and t2.selling_price <= " . $max_price . ") and 
             approve_status = '1' and 
             live_status = '1' and main_category_id = '2' " . $subcategory . " " . $variation_where . " ORDER BY t1.mod_date DESC ", FALSE);
        } else {
            $query = $this->CI->db->query("SELECT * FROM product_mst as t1 
             WHERE approve_status = '1' and live_status = '1' and main_category_id = '2' " . $subcategory . "and selling_price = 
             (SELECT MIN(selling_price)
             FROM product_mst AS t2
             WHERE t2.product_supc = t1.product_supc and t2.qty > 0 and approve_status = '1' and live_status = '1' and t2.selling_price >= " . $min_price . " and t2.selling_price <= " . $max_price . ") ORDER BY t1.mod_date DESC ", FALSE);
        }
        return $query->result();
    }

    function getSearchProducts($subcategory_id, $keyword) {

        $where = "";
        ($subcategory_id != "0") ? $where = " and sub_category_id = " . $subcategory_id : "";
        ($keyword != "") ? $where .= " and ( product_name like '%" . $keyword . "%'" : "";
        ($keyword != "") ? $where .= " or sku like '%" . $keyword . "%'" : "";
        ($keyword != "") ? $where .= " or meta_keyword like '%" . $keyword . "%')" : "";

        $query = $this->CI->db->query("SELECT * FROM product_mst 
             WHERE approve_status = '1' and live_status = '1' " . $where . " order by mod_date DESC", FALSE);
        return $query->result();
    }

    function getSearchProductsFilter($subcategory_id, $keyword, $min_price, $max_price, $variation_id) {
        $where = "";
        if ($variation_id != "") {
            $variation = explode(",", $variation_id);
            foreach ($variation as $val) {
                $where .= " and FIND_IN_SET(" . $val . ",variation_id)";
            }
        }

        ($subcategory_id != "0") ? $where .= " and sub_category_id = " . $subcategory_id : "";
        ($keyword != "") ? $where .= " and ( product_name like '%" . $keyword . "%'" : "";
        ($keyword != "") ? $where .= " or sku like '%" . $keyword . "%'" : "";
        ($keyword != "") ? $where .= " or meta_keyword like '%" . $keyword . "%')" : "";
        
        $query = $this->CI->db->query("SELECT * FROM product_mst 
             WHERE approve_status = '1' and live_status = '1' and selling_price >= " . $min_price ." and selling_price <= ". $max_price . $where . "  order by mod_date DESC", FALSE);
        return $query->result();       
    }

    function getProductData($product_id) {
        $where = array(
            'approve_status' => '1',
            'live_status' => '1',
            'product_id' => $product_id
        );
        $query = $this->CI->db->get_where('product_mst', $where);
        return $query->row();
    }

    function getTopRatedRelatedProduct($sub_category_id, $product_id) {
        $where = array(
            'approve_status' => '1',
            'live_status' => '1',
            'sub_category_id' => $sub_category_id,
            'product_id <> ' => $product_id
        );
        $this->CI->db->from('product_mst');
        $this->CI->db->where($where);
        $this->CI->db->order_by('product_rating', 'DESC');
        $this->CI->db->limit('6');
        $products = $this->CI->db->get();
        return $products->result();
    }

    function getRandomRelatedProduct($sub_category_id, $product_id) {
        $where = array(
            'approve_status' => '1',
            'live_status' => '1',
            'sub_category_id' => $sub_category_id,
            'product_id <> ' => $product_id
        );
        $this->CI->db->from('product_mst');
        $this->CI->db->where($where);
        $this->CI->db->order_by('product_id', 'RANDOM');
        $this->CI->db->limit('6');
        $products = $this->CI->db->get();
        return $products->result();
    }

    function getProductSupc($product_id) {
        $query = $this->CI->db->get_where('product_mst', array('product_id' => $product_id));
        return $query->row()->product_supc;
    }

    function getOtherProductBySupc($product_id) {
        $product_supc = $this->getProductSupc($product_id);
        $where = array(
            'product_supc' => $product_supc,
            'live_status' => '1',
            'approve_status' => '1',
            'qty >=' => '1',
            'product_id <>' => $product_id
        );
        $query = $this->CI->db->get_where('product_mst', $where);
        return $query->result();
    }

    function getProductImages($product_id) {
        $where = array(
            'product_id' => $product_id
        );
        $query = $this->CI->db->get_where('product_images', $where);
        return $query->result();
    }

    function getProductReview($product_id) {
        $where = array(
            'o.product_id' => $product_id,
            'o.prate <> ' => ""
        );
        $this->CI->db->select('first_name,prate,preview,pratedate');
        $this->CI->db->from('order_mst as o');
        $this->CI->db->join('customer_mst as c', 'c.customer_id = o.customer_id');
        $this->CI->db->order_by('o.pratedate');
        $this->CI->db->where($where);
        $query = $this->CI->db->get();
        return $query->result();
    }

    function getProductVariationId($product_id) {
        $query = $this->CI->db->get_where('product_mst', array('product_id' => $product_id));
        return $query->row()->variation_id;
    }

    function getProductVariationById($variation_id) {
        $this->CI->db->from('variation_mst');
        $this->CI->db->where('variation_id in (' . $variation_id . ')');
        $query = $this->CI->db->get();
        return $query->result();
    }

    function getProductVariation($product_id) {
        $variation_id = $this->getProductVariationId($product_id);
        $product_variation = $this->getProductVariationById($variation_id);
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

    function getCartProduct() {
        $product = $this->CI->session->userdata('product');
        if ($product != null) {
            $product_id = array();
            foreach ($product as $key => $val) {
                $product_id [] = $key;
            }
            if ($product_id != null) {
                $this->CI->db->from('product_mst');
                $this->CI->db->where_in('product_id', $product_id);
                $query = $this->CI->db->get();
                return $query->result();
            }
        }
    }

    function getSpecialDiscount($total_amount) {
        $this->CI->db->select('discount');
        $this->CI->db->from('special_discount_mst');
        $this->CI->db->where('min_val <=', $total_amount);
        $this->CI->db->where('max_val >=', $total_amount);
        $query = $this->CI->db->get()->row();
        $discount = isset($query->discount) ? $query->discount : '0';
        return $discount;
    }

    // -------------------------------WEB SERVICES FUNCTIONS -----------------------------

    function existTempCartProduct($product_data) {
        $where = array(
            'temp_cart_id' => $product_data['temp_cart_id'],
            'product_id' => $product_data['product_id'],
            'colour_id' => $product_data['colour_id'],
            'size_id' => $product_data['size_id']
        );
        $query = $this->CI->db->get_where('temp_cart_mst', $where);
        return $query->num_rows();
    }

    function addTempCartProduct($product_data) {
        $this->CI->db->insert('temp_cart_mst', $product_data);
        return 1;
    }

    function getAppCartProducts($temp_cart_id) {
        $this->CI->db->select('p.product_id,p.seller_id,p.product_name,p.image_thumb,p.image_medium,p.brand,p.style_code,p.sku,p.mrp,p.selling_price,p.settlement_price,p.shipping_charge,p.weight,p.shipping_time,p.qty as product_qty,c.colour_id,c.size_id,c.qty,c.coupon_code,p.product_supc,p.sub_category_id');
        $this->CI->db->from('product_mst as p');
        $this->CI->db->join('temp_cart_mst as c', 'c.product_id = p.product_id');
        $this->CI->db->where('c.temp_cart_id', $temp_cart_id);
        $query = $this->CI->db->get();
        return $query->result();
    }

    function updateCartProduct($temp_cart_id, $product_id, $qty) {
        $where = array(
            'temp_cart_id' => $temp_cart_id,
            'product_id' => $product_id
        );
        $this->CI->db->update('temp_cart_mst', array('qty' => $qty), $where);
        return 1;
    }

    function removeCartProduct($temp_cart_id, $product_id) {
        $where = array(
            'temp_cart_id' => $temp_cart_id,
            'product_id' => $product_id
        );
        $this->CI->db->delete('temp_cart_mst', $where);
        return 1;
    }

    function clearCartProduct($temp_cart_id) {
        $where = array(
            'temp_cart_id' => $temp_cart_id
        );
        $this->CI->db->delete('temp_cart_mst', $where);
        return 1;
    }

    function assignCouponToCartProduct($temp_cart_id, $product_id, $coupon_code) {
        $where = array(
            'temp_cart_id' => $temp_cart_id,
            'product_id' => $product_id
        );
        $this->CI->db->update('temp_cart_mst', array('coupon_code' => $coupon_code), $where);
        return 1;
    }

}
