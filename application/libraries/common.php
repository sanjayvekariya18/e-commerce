<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Common {

    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('image_lib');
    }

    function siteStatus() {
        $query = $this->CI->db->get_where('general_id_mst', array('id' => '1'));
        return $query->row()->site_status;
    }

    function siteStart() {
        $this->CI->db->update('general_id_mst', array('site_status' => '1'), array('id' => '1'));
        return 1;
    }

    function siteStop() {
        $this->CI->db->update('general_id_mst', array('site_status' => '0'), array('id' => '1'));
        return 1;
    }

    function getPopupStatus() {
        $query = $this->CI->db->get_where('general_id_mst', array('id' => '1'));
        return $query->row()->popup_status;
    }

    function updatePopupStatus($status) {
        $this->CI->db->update('general_id_mst', array('popup_status' => $status), array('id' => '1'));
        return 1;
    }

    function getLoginInfo($email) {
        $query = $this->CI->db->get_where('login_mst', array('email' => $email));
        return $query->row();
    }

    function logged_in() {
        return ($this->CI->session->userdata("primary_email")) ? true : false;
    }

    function seller_logged_in() {

        return ($this->CI->session->userdata("seller_primary_email")) ? true : false;
    }

    function customer_logged_in() {

        return ($this->CI->session->userdata("customer_primary_email")) ? true : false;
    }

    function fullEncode($password) {
        return hash('sha256', $password);
    }

    function getAllBank() {
        $query = $this->CI->db->get_where('bank_name_mst');
        return $query->result();
    }

    function getBankName($bank_id) {
        $query = $this->CI->db->get_where('bank_name_mst', array('id' => $bank_id))->row();
        return $query->bank_name;
    }

    function getBankDetails() {
        $query = $this->CI->db->get('bank_details_mst');
        return $query->result();
    }

    function getEmployeeName($primary_email) {
        $query = $this->CI->db->get_where('employee_mst', array('email' => $primary_email));
        return $query->row()->first_name . " " . $query->row()->last_name;
    }

    function getSellerName($primary_email) {
        $query = $this->CI->db->get_where('seller_mst', array('primary_email' => $primary_email));
        return $query->row()->first_name . " " . $query->row()->last_name;
    }

    function getCustomerName($primary_email) {
        $query = $this->CI->db->get_where('customer_mst', array('primary_email' => $primary_email));
        return $query->row()->first_name . " " . $query->row()->last_name;
    }

    function getBrandName($primary_email) {
        $query = $this->CI->db->get_where('seller_mst', array('primary_email' => $primary_email));
        return $query->row()->brand_name;
    }

    function getSellerId($primary_email) {
        $query = $this->CI->db->get_where('seller_mst', array('primary_email' => $primary_email));
        return $query->row()->seller_id;
    }

    function getSellerDataById($seller_id) {
        $query = $this->CI->db->get_where('seller_mst', array('seller_id' => $seller_id));
        return $query->row();
    }

    function email_valid($email) {
        $query = $this->CI->db->get_where('login_mst', array('email' => $email));
        return $query->num_rows();
    }

    function getStates() {
        $this->CI->db->order_by('state_name');
        $query = $this->CI->db->get_where('state_mst');
        return $query->result();
    }

    function getStateName($state_id) {
        $query = $this->CI->db->get_where('state_mst', array('id' => $state_id));
        return $query->row()->state_name;
    }

    function getSubcategory() {
        $query = $this->CI->db->get('subcategory_mst');
        return $query->result();
    }

    function getSubCategoryByMain($main_category_id) {
        $query = $this->CI->db->get_where('subcategory_mst', array('main_category_id' => $main_category_id));
        return $query->result();
    }

    function getSubcategoryName($subcatid) {
        $query = $this->CI->db->get_where('subcategory_mst', array('subcategory_id' => $subcatid));
        return $query->row()->subcategory_name;
    }

    function getVariation() {
        $query = $this->CI->db->get('variation_mst');
        return $query->result();
    }

    function getVariationName($variation_id) {
        $query = $this->CI->db->get_where('variation_mst', array('variation_id' => $variation_id));
        return $query->row()->variation_name;
    }

    function getVariationByName($variation_name, $variation_type) {
        $query = $this->CI->db->get_where('variation_mst', array('variation_name' => $variation_name, 'variation_type' => $variation_type));
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return 0;
    }

    function getSizeVariation() {
        $query = $this->CI->db->get_where('variation_mst', array('variation_type' => 'size'));
        return $query->result();
    }

    function getDepartments() {
        $query = $this->CI->db->get_where('edepartment_mst', array('department_id <>' => '1'));
        return $query->result();
    }

    function getEmployeeData($primary_email) {
        $query = $this->CI->db->get_where('employee_mst', array('email' => $primary_email));
        return $query->row();
    }

    function getCustomerData($primary_email) {
        $query = $this->CI->db->get_where('customer_mst', array('primary_email' => $primary_email));
        return $query->row();
    }

    function getCustomerDataById($customer_id) {
        $query = $this->CI->db->get_where('customer_mst', array('customer_id' => $customer_id));
        return $query->row();
    }

    function isSellerAssignToEmployee($seller_id) {
        $query = $this->CI->db->get_where('account_mst', array('seller_id' => $seller_id));
        return $query->num_rows();
    }

    function getPermission($primary_email) {
        $employee = $this->getEmployeeData($primary_email);
        $query = $this->CI->db->get_where('edepartment_mst', array('department_id' => $employee->department_id));
        return $query->row();
    }

    function getProductVariationById($variation_id) {
        $this->CI->db->select('variation_type,variation_name');
        $this->CI->db->from('variation_mst');
        $this->CI->db->where('variation_id in (' . $variation_id . ')');
        $query = $this->CI->db->get();
        return $query->result();
    }

    function getSellerData($primary_email) {
        if ($primary_email == "") {
            $primary_email = '0';
        }
        $query = $this->CI->db->get_where('seller_mst', array('primary_email' => $primary_email));
        return $query->row();
    }

    function getAllSellerGroup() {
        $query = $this->CI->db->get('sellergroup_mst');
        return $query->result();
    }

    function getSellerGroupData($primary_email) {
        $group_id = $this->getSellerGroupId($primary_email);
        $query = $this->CI->db->get_where('sellergroup_mst', array('group_id' => $group_id));
        return $query->row();
    }

    function getSellerGroupDataById($group_id) {
        $query = $this->CI->db->get_where('sellergroup_mst', array('group_id' => $group_id));
        return $query->row();
    }

    function getSellerGroupId($primary_email) {
        $query = $this->CI->db->get_where('seller_mst', array('primary_email' => $primary_email));
        return $query->row()->group_id;
    }

    function getSellerProductsRequest($primary_email) {
        $seller_id = $this->getSellerId($primary_email);
        $where = array(
            'seller_id' => $seller_id,
            'approve_status' => '0'
        );
        $query = $this->CI->db->get_where('product_mst', $where);
        return $query->result();
    }

    function getSellerSearchProductsRequest($primary_email, $sub_category_id) {
        $seller_id = $this->getSellerId($primary_email);
        $where = array(
            'seller_id' => $seller_id,
            'approve_status' => '0',
            'sub_category_id' => $sub_category_id
        );
        $query = $this->CI->db->get_where('product_mst', $where);
        return $query->result();
    }

    function getSellerProductsNonlive($primary_email) {
        $seller_id = $this->getSellerId($primary_email);
        $where = array(
            'seller_id' => $seller_id,
            'approve_status' => '1',
            'live_status' => '0'
        );
        $query = $this->CI->db->get_where('product_mst', $where);
        return $query->result();
    }

    function getSellerSearchProductsNonlive($primary_email, $sub_category_id) {
        $seller_id = $this->getSellerId($primary_email);
        $where = array(
            'seller_id' => $seller_id,
            'approve_status' => '1',
            'live_status' => '0',
            'sub_category_id' => $sub_category_id
        );
        $query = $this->CI->db->get_where('product_mst', $where);
        return $query->result();
    }

    function getSellerProductsLive($primary_email) {
        $seller_id = $this->getSellerId($primary_email);
        $where = array(
            'seller_id' => $seller_id,
            'approve_status' => '1',
            'live_status' => '1',
            'qty <>' => '0'
        );
        $query = $this->CI->db->get_where('product_mst', $where);
        return $query->result();
    }

    function getSellerProductsStockOut($primary_email) {
        $seller_id = $this->getSellerId($primary_email);
        $where = array(
            'seller_id' => $seller_id,
            'approve_status' => '1',
            'live_status' => '1',
            'qty' => '0'
        );
        $query = $this->CI->db->get_where('product_mst', $where);
        return $query->result();
    }

    function getSellerSearchProductsLive($primary_email, $sub_category_id) {
        $seller_id = $this->getSellerId($primary_email);
        $where = array(
            'seller_id' => $seller_id,
            'approve_status' => '1',
            'live_status' => '1',
            'sub_category_id' => $sub_category_id
        );
        $query = $this->CI->db->get_where('product_mst', $where);
        return $query->result();
    }

    function getSellerProductsRejected($primary_email) {
        $seller_id = $this->getSellerId($primary_email);
        $where = array(
            'seller_id' => $seller_id,
            'approve_status' => '2',
            'live_status' => '0'
        );
        $query = $this->CI->db->get_where('product_mst', $where);
        return $query->result();
    }

    function getSellerSearchProductsRejected($primary_email, $sub_category_id) {
        $seller_id = $this->getSellerId($primary_email);
        $where = array(
            'seller_id' => $seller_id,
            'approve_status' => '2',
            'live_status' => '0',
            'sub_category_id' => $sub_category_id
        );
        $query = $this->CI->db->get_where('product_mst', $where);
        return $query->result();
    }

    function getAllSellerProductsRequest() {
        $where = array(
            'approve_status' => '0'
        );
        $query = $this->CI->db->get_where('product_mst', $where);
        return $query->result();
    }

    function getAllSellerSearchProductsRequest($sub_category_id) {
        $where = array(
            'approve_status' => '0',
            'sub_category_id' => $sub_category_id
        );
        $query = $this->CI->db->get_where('product_mst', $where);
        return $query->result();
    }

    function getAllSellerProductsApprove() {
        $where = array(
            'approve_status' => '1',
            'live_status' => '0'
        );
        $query = $this->CI->db->get_where('product_mst', $where);
        return $query->result();
    }

    function getAllSellerSearchProductsApprove($sub_category_id) {
        $where = array(
            'approve_status' => '1',
            'live_status' => '0',
            'sub_category_id' => $sub_category_id
        );
        $query = $this->CI->db->get_where('product_mst', $where);
        return $query->result();
    }

    function getAllSellerProductsLive() {
        $where = array(
            'approve_status' => '1',
            'live_status' => '1'
        );
        $query = $this->CI->db->get_where('product_mst', $where);
        return $query->result();
    }

    function getAllSellerSearchProductsLive($sub_category_id) {
        $where = array(
            'approve_status' => '1',
            'live_status' => '1',
            'sub_category_id' => $sub_category_id
        );
        $query = $this->CI->db->get_where('product_mst', $where);
        return $query->result();
    }

    function getAllSellerProductsRejected() {
        $where = array(
            'approve_status' => '2',
        );
        $query = $this->CI->db->get_where('product_mst', $where);
        return $query->result();
    }

    function getAllSellerSearchProductsRejected($sub_category_id) {
        $where = array(
            'approve_status' => '2',
            'sub_category_id' => $sub_category_id
        );
        $query = $this->CI->db->get_where('product_mst', $where);
        return $query->result();
    }

    function getAllSellerProductsDeleted() {
        $where = array(
            'approve_status' => '3',
        );
        $query = $this->CI->db->get_where('product_mst', $where);
        return $query->result();
    }

    function getAllSellerSearchProductsDeleted($sub_category_id) {
        $where = array(
            'approve_status' => '3',
            'sub_category_id' => $sub_category_id
        );
        $query = $this->CI->db->get_where('product_mst', $where);
        return $query->result();
    }

    function getCompetitivePrice() {
        $where = array(
            'approve_status' => '1',
            'live_status' => '1'
        );
        $this->CI->db->select('product_supc,min(selling_price) as competitive_price');
        $this->CI->db->group_by('product_supc');
        $query = $this->CI->db->get_where('product_mst', $where);
        return $query->result();
    }

    function getProductById($product_id) {
        $query = $this->CI->db->get_where('product_mst', array('product_id' => $product_id));
        return $query->row();
    }

    function getProductImageById($product_id) {
        $query = $this->CI->db->get_where('product_images', array('product_id' => $product_id));
        return $query->result();
    }

    function supcProductExist($product_supc, $seller_id) {
        $where = array(
            'product_supc' => $product_supc,
            'seller_id' => $seller_id
        );
        $query = $this->CI->db->get_where('product_mst', $where);
        return ($query->num_rows() == 0) ? true : false;
    }

    function getProductBySupc($product_supc, $seller_id) {
        $where = array(
            'product_supc' => $product_supc,
            'main_product' => '1',
            'seller_id <>' => $seller_id,
            'approve_status' => '1',
            'live_status' => '1'
        );
        $query = $this->CI->db->get_where('product_mst', $where);
        return $query->result();
    }

    function getProductMinPriceBySupc($product_supc) {
        $where = array(
            'approve_status' => '1',
            'live_status' => '1',
            'product_supc' => $product_supc
        );
        $this->CI->db->select('min(selling_price) as competitive_price');
        $query = $this->CI->db->get_where('product_mst', $where);
        return $query->row()->competitive_price;
    }

    function getOrderById($order_id) {
        $query = $this->CI->db->get_where('order_mst', array('order_id' => $order_id));
        return $query->row();
    }

    function getOrderByAWB($awb_no) {
        $query = $this->CI->db->get_where('order_mst', array('awb_no' => $awb_no));
        return $query->row();
    }

    function getNewOrderNotification($seller_id) {
        $where = array(
            'seller_id' => $seller_id,
            'order_status' => 1
        );
        $this->CI->db->select('order_id,total_price,order_status,status');
        $this->CI->db->order_by('notify_date', 'DESC');
        $this->CI->db->limit(5);
        $query = $this->CI->db->get_where('order_notify_mst', $where);

        return $query->result();
    }

    function getCancelOrderNotification($seller_id) {
        $where = array(
            'seller_id' => $seller_id,
            'order_status' => 6
        );
        $this->CI->db->select('order_id,total_price,order_status,status');
        $this->CI->db->order_by('notify_date', 'DESC');
        $this->CI->db->limit(5);
        $query = $this->CI->db->get_where('order_notify_mst', $where);
        return $query->result();
    }

    function getReturnOrderNotification($seller_id) {
        $where = array(
            'seller_id' => $seller_id,
            'order_status' => 5
        );
        $this->CI->db->select('order_id,total_price,order_status,status');
        $this->CI->db->order_by('notify_date', 'DESC');
        $this->CI->db->limit(5);
        $query = $this->CI->db->get_where('order_notify_mst', $where);
        return $query->result();
    }

    function getReplaceOrderNotification($seller_id) {
        $where = array(
            'seller_id' => $seller_id,
            'order_status' => 7
        );
        $this->CI->db->select('order_id,total_price,order_status,status');
        $this->CI->db->order_by('notify_date', 'DESC');
        $this->CI->db->limit(5);
        $query = $this->CI->db->get_where('order_notify_mst', $where);
        return $query->result();
    }

    function getSellerSignupNotification() {
        $this->CI->db->select('first_name,last_name,primary_email,status');
        $this->CI->db->order_by('notify_date', 'desc');
        $query = $this->CI->db->get_where('signup_notify_mst', array('role' => '1'));
        return $query->result();
    }

    function getAdminPayoutNotification() {
        $this->CI->db->select('from_id,from_name,message,status');
        $this->CI->db->order_by('notify_date', 'desc');
        $query = $this->CI->db->get_where('payout_notify_mst', array('to_id' => '0', 'request_type' => '0'));
        return $query->result();
    }

    function getSellerPayoutNotification($seller_id) {
        $this->CI->db->select('from_id,from_name,message,status');
        $this->CI->db->order_by('notify_date');
        $query = $this->CI->db->get_where('payout_notify_mst', array('to_id' => $seller_id));
        return $query->result();
    }

    function getAdminRefundNotification() {
        $this->CI->db->select('from_id,from_name,message,status');
        $this->CI->db->order_by('notify_date', 'desc');
        $query = $this->CI->db->get_where('payout_notify_mst', array('to_id' => '0', 'request_type' => '1'));
        return $query->result();
    }

    function getCustomerRefundNotification($customer_id) {
        $this->CI->db->select('from_id,from_name,message,status');
        $this->CI->db->order_by('notify_date');
        $query = $this->CI->db->get_where('payout_notify_mst', array('to_id' => $customer_id, 'request_type' => '1'));
        return $query->result();
    }

    function getSellerBalance($seller_id) {

        $payable_data = $this->getPayableData($seller_id);
        $payout_data = $this->getPayoutData($seller_id);

        $totalCredit = $payable_data->credit;
        $totalDebit = $payable_data->debit;
        $totalPayout = $payout_data->total;

        $balance = $totalCredit - ($totalDebit + $totalPayout);
        return $balance;
    }

    function getPayableData($seller_id) {
        $this->CI->db->select('sum(credit) as credit,sum(debit) as debit');
        $payable_data = $this->CI->db->get_where('payable_mst', array('seller_id' => $seller_id))->row();
        return $payable_data;
    }

    function getPayoutData($seller_id) {
        $this->CI->db->select('sum(amount) as total');
        $payout_data = $this->CI->db->get_where('payout_request_mst', array('seller_id' => $seller_id, 'status' => 1))->row();
        return $payout_data;
    }

    function getMailTemplate($mail_type, $type) {
        $query = $this->CI->db->get_where('automail_template', array('mail_type' => $mail_type, 'type' => $type));
        return $query->row();
    }

    function getSmsTemplate($sms_type, $type) {
        $query = $this->CI->db->get_where('autosms_template', array('sms_type' => $sms_type, 'type' => $type));
        return $query->row();
    }

    function smsSetting() {
        $query = $this->CI->db->get_where('sms_mst', array('id' => '1'));
        return $query->row();
    }

    function updateSmsSetting($user, $pass, $sender) {
        $data = array(
            'username' => $user,
            'password' => $pass,
            'sender' => $sender
        );
        $this->CI->db->update('sms_mst', $data, array('id' => '1'));
        return 1;
    }

    function payumoneySetting() {
        $query = $this->CI->db->get_where('payumoney_mst', array('id' => '1'));
        return $query->row();
    }

    function updatePayumoneySetting($merchant_key, $merchant_salt) {
        $data = array(
            'merchant_key' => $merchant_key,
            'merchant_salt' => $merchant_salt
        );
        $this->CI->db->update('payumoney_mst', $data, array('id' => '1'));
        return 1;
    }

    function shippingCharge() {
        $query = $this->CI->db->get_where('general_id_mst', array('id' => '1'));
        return $query->row();
    }

    function updateShippingCharge($shipping_charge) {
        $data = array(
            'shipping_charge' => $shipping_charge
        );
        $this->CI->db->update('general_id_mst', $data, array('id' => '1'));
        return 1;
    }

    function codCharge() {
        $query = $this->CI->db->get_where('general_id_mst', array('id' => '1'));
        return $query->row();
    }

    function updateCodCharge($cod_charge) {
        $data = array(
            'cod_charge' => $cod_charge
        );
        $this->CI->db->update('general_id_mst', $data, array('id' => '1'));
        return 1;
    }

    function sliderProducts() {
        $this->CI->db->select('slider1,slider2');
        $query = $this->CI->db->get_where('general_id_mst', array('id' => '1'));
        return $query->row();
    }

    function updateSliderProduct($slider1, $slider2) {
        $data = array(
            'slider1' => $slider1,
            'slider2' => $slider2,
        );
        $this->CI->db->update('general_id_mst', $data, array('id' => '1'));
        return 1;
    }

    function getMainDeliveryDate($order_id) {
        $ref_order_id = $this->getRefOrderId($order_id);
        $query = $this->CI->db->get_where('order_mst', array('order_id' => $ref_order_id));
        return $query->row()->delivery_date;
    }

    function getRefOrderId($order_id) {
        $query = $this->CI->db->get_where('order_mst', array('order_id' => $order_id));
        return $query->row()->ref_order_id;
    }

    function isNotPayable($order_id) {
        $query = $this->CI->db->get_where('payable_mst', array('order_id' => $order_id));
        $rows = $query->num_rows();
        return ($rows == 0) ? true : false;
    }

    function returnDay() {
        $this->CI->db->select('return_day,cr_transfer_day,dr_transfer_day');
        $query = $this->CI->db->get_where('general_id_mst', array('id' => '1'));
        return $query->row();
    }

    function updateReturnDay($return_day, $cr_transfer_day, $dr_transfer_day) {
        $data = array(
            'return_day' => $return_day,
            'cr_transfer_day' => $cr_transfer_day,
            'dr_transfer_day' => $dr_transfer_day
        );
        $this->CI->db->update('general_id_mst', $data, array('id' => '1'));
        return 1;
    }

    function amountPolicy() {
        $this->CI->db->select('min_balance,min_withdraw_amount');
        $query = $this->CI->db->get_where('general_id_mst', array('id' => '1'));
        return $query->row();
    }

    function updateAmountPolicy($min_balance, $min_withdraw_amount) {
        $data = array(
            'min_balance' => $min_balance,
            'min_withdraw_amount' => $min_withdraw_amount
        );
        $this->CI->db->update('general_id_mst', $data, array('id' => '1'));
        return 1;
    }

    function bonusPolicy() {
        $this->CI->db->select('bonus_amount,bonus_day');
        $query = $this->CI->db->get_where('general_id_mst', array('id' => '1'));
        return $query->row();
    }

    function updateBonus($bonus_amount, $bonus_day) {
        $data = array(
            'bonus_amount' => $bonus_amount,
            'bonus_day' => $bonus_day
        );
        $this->CI->db->update('general_id_mst', $data, array('id' => '1'));
        return 1;
    }

    function otpSetting() {
        $query = $this->CI->db->get_where('otp_mst', array('id' => '1'));
        return $query->row();
    }

    function updateOtpSetting($mobile, $email, $status) {
        $data = array(
            'mobile' => $mobile,
            'email' => $email,
            'status' => $status
        );
        $this->CI->db->update('otp_mst', $data, array('id' => '1'));
        return 1;
    }

    function smsCountUpdate($total) {
        $this->CI->db->where('id', '1');
        $this->CI->db->set('smscount', 'smscount+' . $total, FALSE);
        $this->CI->db->update('sms_mst');
        return 1;
    }

    function updatePassword($primary_email, $password, $newpassword) {
        $this->CI->db->select('password');
        $query = $this->CI->db->get_where('login_mst', array('email' => $primary_email));
        $data = $query->row();
        $oldpassword = $data->password;

        if ($oldpassword == $password) {
            $this->CI->db->update('login_mst', array('password' => $newpassword), array('email' => $primary_email));
            return 1;
        } else {
            return 2;
        }
    }

//    function checkPincodeAll($pincode) {
//        $dtdc = $this->CI->db->get_where('dtdc_pincode_mst', array('pincode' => $pincode));
//        if ($dtdc->num_rows()) {
//            return 1;
//        } else {
//            $indiapost = $this->CI->db->get_where('indiapost_pincode_mst', array('pincode' => $pincode));
//            if ($indiapost->num_rows()) {
//                return 1;
//            } else {
//                return 0;
//            }
//        }
//    }

    function checkPincodeAll($pincode) {
        $dtdc = $this->CI->db->get_where('dtdc_pincode_mst', array('pincode' => $pincode));
        if ($dtdc->num_rows()) {
            return 1;
        } else {
            return 0;
        }
    }

    function checkPincodeCourior($pincode) {
        $dtdc = $this->CI->db->get_where('dtdc_pincode_mst', array('pincode' => $pincode));
        if ($dtdc->num_rows()) {
            return 3;
        } else {
            $indiapost = $this->CI->db->get_where('indiapost_pincode_mst', array('pincode' => $pincode));
            if ($indiapost->num_rows()) {
                return 2;
            } else {
                return 1;
            }
        }
    }    

    function getFedexPincode($pincode) {
        $query = $this->CI->db->get_where('pincode_mst', array('pincode' => $pincode));
        return $query->row();
    }

    function getDtdcPincode($pincode) {
        $query = $this->CI->db->get_where('dtdc_pincode_mst', array('pincode' => $pincode));
        return $query->row();
    }

    function getFedExStateId($pincode) {
        $query = $this->CI->db->get_where('pincode_mst', array('pincode' => $pincode));
        return isset($query->row()->state) ? $query->row()->state : '';
    }

    function addCustomer($data) {
        $bonus = $this->bonusPolicy();
        $customer = array(
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'pincode' => $data['pincode'],
            'landmark' => $data['landmark'],
            'primary_mobile' => $data['primary_mobile'],
            'primary_email' => $data['primary_email'],
            'balance' => $bonus->bonus_amount,
            'bonus_limit_date' => strtotime(date("Y-m-d") . " + " . $bonus->bonus_day . " days"),
            'join_via' => isset($data['join_via']) ? $data['join_via'] : '1'
        );

        $this->CI->db->insert('customer_mst', $customer);
        $customer_id = $this->CI->db->insert_id();

        $login_data = array(
            'email' => $data['primary_email'],
            'password' => $this->fullEncode($data['password']),
            'role' => '3',
            'status' => '1'
        );

        $this->CI->db->insert('login_mst', $login_data);
        return $customer_id;
    }

    function updateCustomer($data) {
        $customer = array(
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'pincode' => $data['pincode'],
            'landmark' => $data['landmark'],
            'primary_mobile' => $data['primary_mobile'],
        );

        $this->CI->db->update('customer_mst', $customer, array('primary_email' => $data['login_email']));
    }

    function updateCustomerById($data, $customer_id) {
        $customer = array(
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'pincode' => $data['pincode'],
            'landmark' => $data['landmark'],
            'primary_mobile' => $data['primary_mobile'],
        );

        $this->CI->db->update('customer_mst', $customer, array('customer_id' => $customer_id));
        return 1;
    }

    function getSellerHomeBlock() {
        $query = $this->CI->db->get_where('seller_homepage_mst', array('block' => '1'));
        return $query->row()->content;
    }

    function getFedexTrackStatus($code) {
        $query = $this->CI->db->get_where('fedex_tracking_status', array('code' => $code));
        return $query->row()->track_status;
    }

    function getOrderCurrentStatus($order_id) {
        $this->CI->db->select('track_status');
        $this->CI->db->from('order_status_mst');
        $this->CI->db->where('order_id', $order_id);
        $this->CI->db->order_by('id', 'DESC');
        $this->CI->db->limit(1);
        $query = $this->CI->db->get();
        return isset($query->row()->track_status) ? $query->row()->track_status : '-';
    }

    function do_upload($htmlFieldName, $path, $filename, $isoverwrite = FALSE) {
        $config['file_name'] = $filename;
        $config['upload_path'] = $path;
        $config['allowed_types'] = '*';
        // $config['max_size'] = '2000';
        // $config['max_width'] = '2000';
        // $config['max_height'] = '2000';
        $config['overwrite'] = $isoverwrite;
        $this->CI->load->library('upload', $config);
        $this->CI->upload->initialize($config);
        unset($config);
        if (!$this->CI->upload->do_upload($htmlFieldName)) {
            return array('error' => $this->CI->upload->display_errors(), 'status' => 0);
        } else {
            return array('status' => 1, 'upload_data' => $this->CI->upload->data());
        }
    }

    function resize_image($sourcePath, $desPath, $width = '100', $height = '100') {
        $this->CI->image_lib->clear();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $sourcePath;
        $config['new_image'] = $desPath;
        $config['quality'] = '100%';
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = FALSE;
        $config['thumb_marker'] = '';
        $config['width'] = $width;
        $config['height'] = $height;
        $this->CI->image_lib->initialize($config);

        if ($this->CI->image_lib->resize()) {
            return true;
        } else {
            return false;
        }
    }

    function sendEmail($from, $to, $subject, $message, $name = NULL) {
        $config = Array(
//            'protocol' => 'smtp',
//            'smtp_host' => 'ssl://smtp.googlemail.com',
//            'smtp_port' => 465,
//            'smtp_user' => 'vishaltesting7@gmail.com', // change it to yours
//            'smtp_pass' => 'vishal789', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->CI->load->library('email', $config);
        $this->CI->email->set_newline("\r\n");
        $this->CI->email->from($from, $name);
        $this->CI->email->to($to);
        $this->CI->email->subject($subject);
        $this->CI->email->message($message);
        if ($this->CI->email->send()) {
            return 1;
        } else {
            return 0;
        }
    }

    function httpRequest($url) {
        try {
            $pattern = "/http...([0-9a-zA-Z-.]*).([0-9]*).(.*)/";
            preg_match($pattern, $url, $args);
            $in = "";
            $fp = fsockopen($args[1], 80, $errno, $errstr, 30);
            if (!$fp) {
                return("$errstr ($errno)");
            } else {
                $args[3] = "C" . $args[3];
                $out = "GET /$args[3] HTTP/1.1\r\n";
                $out .= "Host: $args[1]:$args[2]\r\n";
                $out .= "User-agent: PARSHWA WEB SOLUTIONS\r\n";
                $out .= "Accept: */*\r\n";
                $out .= "Connection: Close\r\n\r\n";

                fwrite($fp, $out);
                while (!feof($fp)) {
                    $in.=fgets($fp, 128);
                }
            }
            fclose($fp);
            return($in);
        } catch (Exception $exc) {
            
        }
    }

    function getSMSBalance() {

        $query = $this->CI->db->get_where('sms_mst', array('id' => '1'));
        $data = $query->row();
        $balanceurl = file_get_contents("http://www.kit19.com/BalanceCheck.aspx?username=" . $data->username . "&password=" . $data->password);
        if ($balanceurl != "") {
            $data = explode("V", $balanceurl);
            return $data[0];
        } else {
            return "SMS Balance: Error";
        }
    }

    function SMSSend($phone, $msg, $debug = false) {

        try {
            $smsurl = "http://www.kit19.com/ComposeSMS.aspx?";
            $query = $this->CI->db->get_where('sms_mst', array('id' => '1'));
            $data = $query->row();

            $url = 'username=' . $data->username;
            $url.= '&password=' . $data->password;
            $url.= '&sender=' . $data->sender;
            $url.= '&to=' . urlencode($phone);
            $url.= '&message=' . urlencode($msg);
            $url.= '&priority=1';
            $url.= '&dnd=1';
            $url.= '&unicode=0';

            $urltouse = $smsurl . $url;
            //Open the URL to send the message
            $response = $this->httpRequest($urltouse);
            return $response;
        } catch (Exception $exc) {
            
        }
    }

    function getMetadata($p, $m) {
        $where = array();
        ($p == "" || $p == "home") ? $where['page'] = "home" : '';
        ($p == "about-us") ? $where['page'] = "about_us" : '';
        ($p == "contact-us") ? $where['page'] = "contact_us" : '';
        ($p == "shipping") ? $where['page'] = "shipping" : '';
        ($p == "cancellation-and-return") ? $where['page'] = "cancel_and_return" : '';
        ($p == "payment-method") ? $where['page'] = "payments" : '';
        ($p == "terms-of-use") ? $where['page'] = "term_and_condition" : '';
        ($p == "privacy-policy") ? $where['page'] = "privacy_policy" : '';
        ($p == "our-team") ? $where['page'] = "our_team" : '';
        ($p == "warrantee") ? $where['page'] = "waraantee" : '';
        ($p == "buyer-faq") ? $where['page'] = "faq" : '';
        ($p == "services") ? $where['page'] = "services" : '';
        ($p == "support") ? $where['page'] = "support" : '';

        ($p == "seller" && $m == "") ? $where['page'] = "seller_home" : '';
        ($p == "seller" && $m == "seller-faq") ? $where['page'] = "seller_faq" : '';
        ($p == "seller" && $m == "seller-policy-and-rule") ? $where['page'] = "seller_policy_rule" : '';
        ($p == "seller" && $m == "seller-privacy-policy") ? $where['page'] = "seller_privacy_policy" : '';
        ($p == "seller" && $m == "seller-agreement") ? $where['page'] = "seller_user_agreement" : '';
        ($p == "seller" && $m == "seller-benefits") ? $where['page'] = "seller_benefits" : '';
        ($p == "seller" && $m == "seller-contact") ? $where['page'] = "seller_contactus" : '';

        ($p == "womens" && $m == "sarees") ? $where['page'] = "sarees" : '';
        ($p == "womens" && $m == "kurtis") ? $where['page'] = "kurta_and_kurtis" : '';
        ($p == "womens" && $m == "dressMaterial") ? $where['page'] = "dress_materials" : '';
        ($p == "womens" && $m == "salwarKurta") ? $where['page'] = "salwar_kurta_dupattas" : '';
        ($p == "womens" && $m == "lehengaCholis") ? $where['page'] = "lehenga_choli" : '';
        ($p == "womens" && $m == "ethnicBottoms") ? $where['page'] = "ethnic_bottoms" : '';
        ($p == "womens" && $m == "ethnicSets") ? $where['page'] = "ethnic_sets" : '';
        ($p == "womens" && $m == "dupattas") ? $where['page'] = "dupattas" : '';
        ($p == "womens" && $m == "blouses") ? $where['page'] = "blouses" : '';
        ($p == "womens" && $m == "abayas") ? $where['page'] = "abayas_and_burqas" : '';
        ($p == "womens" && $m == "petticoats") ? $where['page'] = "petticoats" : '';
        ($p == "womens" && $m == "gowns") ? $where['page'] = "gown" : '';

        $query = $this->CI->db->get_where('admin_seo', $where);
        return $query->row();
    }

    function seller_profile_set($primary_email) {
        $flag = true;
        $seller = $this->getSellerData($primary_email);
        if (trim($seller->first_name) == "") {
            $flag = false;
        } else if (trim($seller->last_name) == "") {
            $flag = false;
        } else if (trim($seller->display_name) == "") {
            $flag = false;
        } else if (trim($seller->brand_name) == "") {
            $flag = false;
        } else if (trim($seller->pickup_address) == "") {
            $flag = false;
        } else if (trim($seller->pickup_city) == "") {
            $flag = false;
        } else if (trim($seller->pickup_state) == "") {
            $flag = false;
        } else if (trim($seller->pickup_pincode) == "") {
            $flag = false;
        } else if (trim($seller->primary_email) == "") {
            $flag = false;
        } else if (trim($seller->primary_mobile) == "") {
            $flag = false;
        } else if (trim($seller->business_name) == "") {
            $flag = false;
        } else if (trim($seller->business_desc) == "") {
            $flag = false;
        } else if (trim($seller->pan_id) == "") {
            $flag = false;
        } else if (trim($seller->pan_url) == "") {
            $flag = false;
        } else if (trim($seller->account_name) == "") {
            $flag = false;
        } else if (trim($seller->account_no) == "") {
            $flag = false;
        } else if (trim($seller->bank_name) == "") {
            $flag = false;
        } else if (trim($seller->bank_branch) == "") {
            $flag = false;
        } else if (trim($seller->bank_ifsc) == "") {
            $flag = false;
        } else if (trim($seller->bank_state) == "") {
            $flag = false;
        } else if (trim($seller->bank_city) == "") {
            $flag = false;
        } else if (trim($seller->address_proof) == "") {
            $flag = false;
        } else if (trim($seller->id_proof) == "") {
            $flag = false;
        } else if (trim($seller->cheque_proof) == "") {
            $flag = false;
        } else {
            $flag = true;
        }
        return $flag;
    }

    function changeEmail($role, $old_email, $new_email) {
        $returnFlag = 0;
        $old_exist = $this->CI->db->get_where('login_mst', array('email' => $old_email, 'role' => $role));
        if ($old_exist->num_rows() == 1) {
            $new_exist = $this->CI->db->get_where('login_mst', array('email' => $new_email));
            if ($new_exist->num_rows() == 0) {
                switch ($role) {
                    case 1:
                        $this->CI->db->update('login_mst', array('email' => $new_email), array('email' => $old_email));
                        $this->CI->db->update('seller_mst', array('primary_email' => $new_email), array('primary_email' => $old_email));
                        break;
                    case 2:
                        $this->CI->db->update('login_mst', array('email' => $new_email), array('email' => $old_email));
                        $this->CI->db->update('employee_mst', array('email' => $new_email), array('email' => $old_email));
                        break;
                    case 3:
                        $this->CI->db->update('login_mst', array('email' => $new_email), array('email' => $old_email));
                        $this->CI->db->update('customer_mst', array('primary_email' => $new_email), array('primary_email' => $old_email));
                        break;
                    default :
                        break;
                }
                $returnFlag = 1;
            }
        }
        return $returnFlag;
    }

    function changeMobile($role, $old_mobile, $new_mobile) {
        $returnFlag = 0;
        switch ($role) {
            case 1:
                $old_exist = $this->CI->db->get_where('seller_mst', array('primary_mobile' => $old_mobile));
                if ($old_exist->num_rows() == 1) {
                    $new_exist = $this->CI->db->get_where('seller_mst', array('primary_mobile' => $new_mobile));
                    if ($new_exist->num_rows() == 0) {
                        $this->CI->db->update('seller_mst', array('primary_mobile' => $new_mobile), array('primary_mobile' => $old_mobile));
                        $returnFlag = 1;
                    }
                }
                break;
            case 2:
                $old_exist = $this->CI->db->get_where('employee_mst', array('personal_phone' => $old_mobile));
                if ($old_exist->num_rows() == 1) {
                    $new_exist = $this->CI->db->get_where('employee_mst', array('personal_phone' => $new_mobile));
                    if ($new_exist->num_rows() == 0) {
                        $this->CI->db->update('employee_mst', array('personal_phone' => $new_mobile), array('personal_phone' => $old_mobile));
                        $returnFlag = 1;
                    }
                }
                break;
            case 3:
                $old_exist = $this->CI->db->get_where('customer_mst', array('primary_mobile' => $old_mobile));
                if ($old_exist->num_rows() >= 1) {
                    $new_exist = $this->CI->db->get_where('customer_mst', array('primary_mobile' => $new_mobile));
                    if ($new_exist->num_rows() == 0) {
                        $this->CI->db->update('customer_mst', array('primary_mobile' => $new_mobile), array('primary_mobile' => $old_mobile));
                        $returnFlag = 1;
                    }
                }
                break;
            default :
                break;
        }
        return $returnFlag;
    }

    function convert_digit_to_words($no) {

        //creating array  of word for each digit
        $words = array('0' => 'Zero', '1' => 'one', '2' => 'two', '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six', '7' => 'seven', '8' => 'eight', '9' => 'nine', '10' => 'ten', '11' => 'eleven', '12' => 'twelve', '13' => 'thirteen', '14' => 'fourteen', '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen', '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty', '30' => 'thirty', '40' => 'forty', '50' => 'fifty', '60' => 'sixty', '70' => 'seventy', '80' => 'eighty', '90' => 'ninty', '100' => 'hundred', '1000' => 'thousand', '100000' => 'lac', '10000000' => 'crore');
        //$words = array('0'=> '0' ,'1'=> '1' ,'2'=> '2' ,'3' => '3','4' => '4','5' => '5','6' => '6','7' => '7','8' => '8','9' => '9','10' => '10','11' => '11','12' => '12','13' => '13','14' => '14','15' => '15','16' => '16','17' => '17','18' => '18','19' => '19','20' => '20','30' => '30','40' => '40','50' => '50','60' => '60','70' => '70','80' => '80','90' => '90','100' => '100','1000' => '1000','100000' => '100000','10000000' => '10000000');
        //for decimal number taking decimal part

        $cash = (int) $no;  //take number wihout decimal
        $decpart = $no - $cash; //get decimal part of number

        $decpart = sprintf("%01.2f", $decpart); //take only two digit after decimal

        $decpart1 = substr($decpart, 2, 1); //take first digit after decimal
        $decpart2 = substr($decpart, 3, 1);   //take second digit after decimal  

        $decimalstr = '';

        //if given no. is decimal than  preparing string for decimal digit's word

        if ($decpart > 0) {
            $decimalstr.="point " . $numbers[$decpart1] . " " . $numbers[$decpart2];
        }

        if ($no == 0)
            return ' ';
        else {
            $novalue = '';
            $highno = $no;
            $remainno = 0;
            $value = 100;
            $value1 = 1000;
            while ($no >= 100) {
                if (($value <= $no) && ($no < $value1)) {
                    $novalue = $words["$value"];
                    $highno = (int) ($no / $value);
                    $remainno = $no % $value;
                    break;
                }
                $value = $value1;
                $value1 = $value * 100;
            }
            if (array_key_exists("$highno", $words))  //check if $high value is in $words array
                return $words["$highno"] . " " . $novalue . " " . $this->convert_digit_to_words($remainno) . $decimalstr;  //recursion
            else {
                $unit = $highno % 10;
                $ten = (int) ($highno / 10) * 10;
                return $words["$ten"] . " " . $words["$unit"] . " " . $novalue . " " . $this->convert_digit_to_words($remainno
                        ) . $decimalstr; //recursion
            }
        }
    }

    function isPayableRecordExist($order_id) {
        $query = $this->CI->db->get_where('payable_mst', array('order_id' => $order_id));
        $rows = $query->num_rows();
        return ($rows == 0) ? true : false;
    }

}
