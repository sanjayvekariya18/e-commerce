<?php

class M_department extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function getAllDepartmentData(){
        $query = $this->db->get_where('edepartment_mst',array('department_id <>'=>'1'));
        return $query->result();
    }
        
    function addDepartmentData(){
        $data = array(
            'department_name' => $this->input->post('department_name'),
        );
        $this->db->insert('edepartment_mst',$data);
        return 1;
    }
    
    function updateDepartmentData(){
        $data = array(
            'department_name' => $this->input->post('department_name'),
        );
        $this->db->update('edepartment_mst',$data,array('department_id' => $this->input->post('department_id')));
        return 1;
    }
    
    function deleteDepartmentData(){
        $this->db->delete('edepartment_mst',array('department_id' => base64_decode($this->input->get('id'))));
        return 1;
    }
    
    function getPermission($department_id){
        $query = $this->db->get_where('edepartment_mst',array('department_id'=>$department_id));
        return $query->row();
    }
    
    function setPermission(){
        $data = $_POST;   
        $department_id = $data['department_id'];
        $permission = array(
            'approved_product' => isset($data['approved_product'])?1:0,
            'live_product' => isset($data['live_product'])?1:0,
            'rejected_product' => isset($data['rejected_product'])?1:0,
            'deleted_product' => isset($data['deleted_product'])?1:0,
            'request_product' => isset($data['request_product'])?1:0,
            'seller' => isset($data['seller'])?1:0,
            'customer' => isset($data['customer'])?1:0,
            'seller_group' => isset($data['seller_group'])?1:0,
            'advertisement' => isset($data['advertisement'])?1:0,
            'bulksms' => isset($data['bulksms'])?1:0,
            'directsms' => isset($data['directsms'])?1:0,
            'bulkemail' => isset($data['bulkemail'])?1:0,
            'acmanager' => isset($data['acmanager'])?1:0,
            'payout' => isset($data['payout'])?1:0,
            'bank_details' => isset($data['bank_details'])?1:0,
            'product_rate' => isset($data['product_rate'])?1:0,
            'seller_rate' => isset($data['seller_rate'])?1:0,
            'messages' => isset($data['messages'])?1:0,
            'refund_request' => isset($data['refund_request'])?1:0,
            'refund_paid' => isset($data['refund_paid'])?1:0,
            'sub_category' => isset($data['sub_category'])?1:0,
            'variation' => isset($data['variation'])?1:0,            
            'sms_setting' => isset($data['sms_setting'])?1:0,
            'shipping_charge' => isset($data['shipping_charge'])?1:0,
            'order_shipping_charge' => isset($data['order_shipping_charge'])?1:0,
            'order' => isset($data['order'])?1:0,
            'order_track' => isset($data['order_track'])?1:0,
            'order_fail' => isset($data['order_fail'])?1:0,
            'cod_charge' => isset($data['cod_charge'])?1:0,
            'return_policy' => isset($data['return_policy'])?1:0,
            'department' => isset($data['department'])?1:0,
            'permission' => isset($data['permission'])?1:0,
            'employee' => isset($data['employee'])?1:0,
            'coupon' => isset($data['coupon'])?1:0,
            'otp' => isset($data['otp'])?1:0,
            'seo' => isset($data['seo'])?1:0,
            'pages' => isset($data['pages'])?1:0,
            'etemplate' => isset($data['etemplate'])?1:0,
            'stemplate' => isset($data['stemplate'])?1:0,
            'change_email' => isset($data['change_email'])?1:0,
            'change_mobile' => isset($data['change_mobile'])?1:0,
        );
        $this->db->update('edepartment_mst',$permission,array('department_id'=>$department_id));
        return 1;
    }
}
