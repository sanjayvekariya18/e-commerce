<?php

class M_home extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getPageContent($pname) {
        $query = $this->db->get_where('pages', array('name' => $pname));
        if ($query->num_rows()) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    function getLinks() {
        $query = $this->db->get('banner_mst');
        return $query->row();
    }

    function getSlider1() {
        $where = array(
            'approve_status' => '1',
            'live_status' => '1',
            'main_product' => '1'
        );

        $slider_product = $this->common->sliderProducts()->slider1;

        $product_supc = explode(',', $slider_product);
        $this->db->from('product_mst');
        $this->db->where($where);
        $this->db->where_in('product_supc', $product_supc);
        $this->db->limit(6);
        $products = $this->db->get();
        return $products->result();
    }

    function getSlider2() {
        $where = array(
            'approve_status' => '1',
            'live_status' => '1',
            'main_product' => '1'
        );

        $slider_product = $this->common->sliderProducts()->slider2;

        $product_supc = explode(',', $slider_product);
        $this->db->from('product_mst');
        $this->db->where($where);
        $this->db->where_in('product_supc', $product_supc);
        $this->db->limit(6);
        $products = $this->db->get();
        return $products->result();
    }

    function getTopSellingSaree() {
        $this->db->select('count(*) total , o.product_id');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'o.product_id = p.product_id');
        $this->db->where('p.sub_category_id', '4');
        $this->db->where('p.approve_status', '1');
        $this->db->where('p.live_status', '1');
        $this->db->group_by('product_id');
        $this->db->order_by('total', 'DESC');
        $this->db->limit('8');
        $query = $this->db->get();
        $data = $query->result();
        $product_id_array = array();
        if ($query->num_rows() > 0) {
            foreach ($data as $val) {
                $product_id_array[] = $val->product_id;
            }
            $this->db->from('product_mst');
            $this->db->where_in('product_id', $product_id_array);
            $products = $this->db->get();
        } else {
            $where = array(
                'sub_category_id' => '4',
                'approve_status' => '1',
                'live_status' => '1'
            );
            $this->db->from('product_mst');
            $this->db->where($where);
            $this->db->limit('8');
            $products = $this->db->get();
        }
        return $products->result();
    }

    function getTopRatedSaree() {
        $where = array(
            'approve_status' => '1',
            'live_status' => '1',
            'sub_category_id' => '4'
        );
        $this->db->from('product_mst');
        $this->db->where($where);
        $this->db->order_by('product_rating', 'DESC');
        $this->db->limit('8');
        $products = $this->db->get();
        return $products->result();
    }

    function getRecentAddedSaree() {
        $where = array(
            'approve_status' => '1',
            'live_status' => '1',
            'sub_category_id' => '4'
        );
        $this->db->from('product_mst');
        $this->db->where($where);
        $this->db->order_by('reg_date', 'DESC');
        $this->db->limit('8');
        $products = $this->db->get();
        return $products->result();
    }

    function getRandomSaree() {
        $where = array(
            'approve_status' => '1',
            'live_status' => '1',
            'sub_category_id' => '4'
        );
        $this->db->from('product_mst');
        $this->db->where($where);
        $this->db->order_by('product_id', 'RANDOM');
        $this->db->limit('6');
        $products = $this->db->get();
        return $products->result();
    }

    function getTopSellingKurti() {
        $this->db->select('count(*) total , o.product_id');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'o.product_id = p.product_id');
        $this->db->where('p.sub_category_id', '7');
        $this->db->where('p.approve_status', '1');
        $this->db->where('p.live_status', '1');
        $this->db->group_by('product_id');
        $this->db->order_by('total', 'DESC');
        $this->db->limit('8');
        $query = $this->db->get();
        $data = $query->result();
        $product_id_array = array();
        if ($query->num_rows() > 0) {
            foreach ($data as $val) {
                $product_id_array[] = $val->product_id;
            }
            $this->db->from('product_mst');
            $this->db->where_in('product_id', $product_id_array);
            $products = $this->db->get();
        } else {

            $where = array(
                'sub_category_id' => '7',
                'approve_status' => '1',
                'live_status' => '1'
            );
            $this->db->from('product_mst');
            $this->db->where($where);
            $this->db->limit('8');
            $products = $this->db->get();
        }
        return $products->result();
    }

    function getTopRatedKurti() {
        $where = array(
            'approve_status' => '1',
            'live_status' => '1',
            'sub_category_id' => '7'
        );

        $this->db->from('product_mst');
        $this->db->where($where);
        $this->db->order_by('product_rating', 'DESC');
        $this->db->limit('8');
        $products = $this->db->get();
        return $products->result();
    }

    function getRecentAddedKurti() {
        $where = array(
            'approve_status' => '1',
            'live_status' => '1',
            'sub_category_id' => '7'
        );

        $this->db->from('product_mst');
        $this->db->where($where);
        $this->db->order_by('reg_date', 'DESC');
        $this->db->limit('8');
        $products = $this->db->get();
        return $products->result();
    }

    function getRandomKurti() {
        $where = array(
            'approve_status' => '1',
            'live_status' => '1',
            'sub_category_id' => '7'
        );
        $this->db->from('product_mst');
        $this->db->where($where);
        $this->db->order_by('product_id', 'RANDOM');
        $this->db->limit('6');
        $products = $this->db->get();
        return $products->result();
    }

    function getTopSellingDress() {
        $this->db->select('count(*) total , o.product_id');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'o.product_id = p.product_id');
        $this->db->where('p.sub_category_id', '2');
        $this->db->where('p.approve_status', '1');
        $this->db->where('p.live_status', '1');
        $this->db->group_by('product_id');
        $this->db->order_by('total', 'DESC');
        $this->db->limit('8');
        $query = $this->db->get();
        $data = $query->result();
        $product_id_array = array();
        if ($query->num_rows() > 0) {
            foreach ($data as $val) {
                $product_id_array[] = $val->product_id;
            }
            $this->db->from('product_mst');
            $this->db->where_in('product_id', $product_id_array);
            $products = $this->db->get();
        } else {
            $where = array(
                'sub_category_id' => '2',
                'approve_status' => '1',
                'live_status' => '1'
            );

            $this->db->from('product_mst');
            $this->db->where($where);
            $this->db->limit('8');
            $products = $this->db->get();
        }
        return $products->result();
    }

    function getTopRatedDress() {
        $where = array(
            'approve_status' => '1',
            'live_status' => '1',
            'sub_category_id' => '2'
        );

        $this->db->from('product_mst');
        $this->db->where($where);
        $this->db->order_by('product_rating', 'DESC');
        $this->db->limit('8');
        $products = $this->db->get();
        return $products->result();
    }

    function getRecentAddedDress() {
        $where = array(
            'approve_status' => '1',
            'live_status' => '1',
            'sub_category_id' => '2'
        );

        $this->db->from('product_mst');
        $this->db->where($where);
        $this->db->order_by('reg_date', 'DESC');
        $this->db->limit('8');
        $products = $this->db->get();
        return $products->result();
    }

    function getRandomDress() {
        $where = array(
            'approve_status' => '1',
            'live_status' => '1',
            'sub_category_id' => '2'
        );
        $this->db->from('product_mst');
        $this->db->where($where);
        $this->db->order_by('product_id', 'RANDOM');
        $this->db->limit('6');
        $products = $this->db->get();
        return $products->result();
    }

    function getTopSellingSalwar() {
        $this->db->select('count(*) total , o.product_id');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'o.product_id = p.product_id');
        $this->db->where('p.sub_category_id', '5');
        $this->db->where('p.approve_status', '1');
        $this->db->where('p.live_status', '1');
        $this->db->group_by('product_id');
        $this->db->order_by('total', 'DESC');
        $this->db->limit('8');
        $query = $this->db->get();
        $data = $query->result();
        $product_id_array = array();
        if ($query->num_rows() > 0) {
            foreach ($data as $val) {
                $product_id_array[] = $val->product_id;
            }
            $this->db->from('product_mst');
            $this->db->where_in('product_id', $product_id_array);
            $products = $this->db->get();
        } else {
            $where = array(
                'sub_category_id' => '5',
                'approve_status' => '1',
                'live_status' => '1'
            );
            $this->db->from('product_mst');
            $this->db->where($where);
            $this->db->limit('8');
            $products = $this->db->get();
        }
        return $products->result();
    }

    function getTopRatedSalwar() {
        $where = array(
            'approve_status' => '1',
            'live_status' => '1',
            'sub_category_id' => '5'
        );

        $this->db->from('product_mst');
        $this->db->where($where);
        $this->db->order_by('product_rating', 'DESC');
        $this->db->limit('8');
        $products = $this->db->get();
        return $products->result();
    }

    function getRecentAddedSalwar() {
        $where = array(
            'approve_status' => '1',
            'live_status' => '1',
            'sub_category_id' => '5'
        );

        $this->db->from('product_mst');
        $this->db->where($where);
        $this->db->order_by('reg_date', 'DESC');
        $this->db->limit('8');
        $products = $this->db->get();
        return $products->result();
    }

    function getRandomSalwar() {
        $where = array(
            'approve_status' => '1',
            'live_status' => '1',
            'sub_category_id' => '5'
        );
        $this->db->from('product_mst');
        $this->db->where($where);
        $this->db->order_by('product_id', 'RANDOM');
        $this->db->limit('6');
        $products = $this->db->get();
        return $products->result();
    }

    function getTopSellingCholi() {
        $this->db->select('count(*) total , o.product_id');
        $this->db->from('order_mst as o');
        $this->db->join('product_mst as p', 'o.product_id = p.product_id');
        $this->db->where('p.sub_category_id', '6');
        $this->db->where('p.approve_status', '1');
        $this->db->where('p.live_status', '1');
        $this->db->group_by('product_id');
        $this->db->order_by('total', 'DESC');
        $this->db->limit('8');
        $query = $this->db->get();
        $data = $query->result();
        $product_id_array = array();
        if ($query->num_rows() > 0) {
            foreach ($data as $val) {
                $product_id_array[] = $val->product_id;
            }
            $this->db->from('product_mst');
            $this->db->where_in('product_id', $product_id_array);
            $products = $this->db->get();
        } else {
            $where = array(
                'sub_category_id' => '6',
                'approve_status' => '1',
                'live_status' => '1'
            );

            $this->db->from('product_mst');
            $this->db->where($where);
            $this->db->limit('8');
            $products = $this->db->get();
        }
        return $products->result();
    }

    function getTopRatedCholi() {
        $where = array(
            'approve_status' => '1',
            'live_status' => '1',
            'sub_category_id' => '6'
        );

        $this->db->from('product_mst');
        $this->db->where($where);
        $this->db->order_by('product_rating', 'DESC');
        $this->db->limit('8');
        $products = $this->db->get();
        return $products->result();
    }

    function getRecentAddedCholi() {

        $where = array(
            'approve_status' => '1',
            'live_status' => '1',
            'sub_category_id' => '6'
        );

        $this->db->from('product_mst');
        $this->db->where($where);
        $this->db->order_by('reg_date', 'DESC');
        $this->db->limit('8');
        $products = $this->db->get();
        return $products->result();
    }

    function getRandomLehenga() {
        $where = array(
            'approve_status' => '1',
            'live_status' => '1',
            'sub_category_id' => '6'
        );
        $this->db->from('product_mst');
        $this->db->where($where);
        $this->db->order_by('product_id', 'RANDOM');
        $this->db->limit('6');
        $products = $this->db->get();
        return $products->result();
    }

    function addSubscribe($email) {
        $this->db->insert('subscriber', array('email' => $email));
        return TRUE;
    }

    function isExistEmail($email) {
        $query = $this->db->get_where('subscriber', array('email' => $email));
        return ($query->num_rows()) ? TRUE : FALSE;
    }

}
