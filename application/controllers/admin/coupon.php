<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Coupon extends CI_Controller {

    function __construct() {
        parent::__construct();
        if(!$this->common->logged_in()){
            header('location:' . site_url());
        }else if(!$this->common->getPermission($this->session->userdata('primary_email'))->coupon){
            header('location:'.site_url().'admin');
        }
        $this->load->model('admin/m_coupon', 'ocoupon');
    }

    function index() {
        $data['coupons'] = $this->ocoupon->getAllCoupon();
        $this->load->view('admin/header');
        $this->load->view('admin/coupon/coupon_mst',$data);
        $this->load->view('admin/footer');
    }
    
    function searchCoupon() {
        $data['coupons'] = $this->ocoupon->getSearchCoupon();
        $this->load->view('admin/header');
        $this->load->view('admin/coupon/coupon_mst',$data);
        $this->load->view('admin/footer');
    }
    
    function addCoupon() {
        $data['subcategory'] = $this->common->getSubcategory();
        $this->load->view('admin/header');
        $this->load->view('admin/coupon/add_coupon',$data);
        $this->load->view('admin/footer');
    }
    
    function addCouponData(){       
       $result = $this->ocoupon->addCouponData();
       header('location:'.site_url().'admin/coupon?msg=S');
    }
    
    function deleteCouponData(){       
       $result = $this->ocoupon->deleteCouponData();
       header('location:'.site_url().'admin/coupon?msg=D');
    }
    
    function activeCouponData(){       
       $result = $this->ocoupon->activeCouponData();
       header('location:'.site_url().'admin/coupon?msg=A');
    }
    
    function deactiveCouponData(){       
       $result = $this->ocoupon->deactiveCouponData();
       header('location:'.site_url().'admin/coupon?msg=DA');
    }
}
