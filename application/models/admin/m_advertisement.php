<?php

class M_advertisement extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function uploadImage() {
        if ($_FILES['banner']['error'] != 4) {
            $pathMain =  FCPATH . "/upload/banner/";

            $filename = "upload.jpg";
            $destfilename = $_POST['box'] . ".jpg";

            $result = $this->common->do_upload('banner', $pathMain, $filename, TRUE);

            $sourcepath = $result['upload_data']['full_path'];
            $destinationpath = $pathMain . $destfilename;

            switch ($_POST['box']) {
                case 1:
                case 2:
                case 3:
                    $this->common->resize_image($sourcepath, $destinationpath, '1185', '450');
                    break;
                case 4:
                case 5:
                case 6:
                case 7:
                case 8:
                case 9:
                    $this->common->resize_image($sourcepath, $destinationpath, '610', '400');
                    break;
                case 10:
                case 11:
                case 12:
                case 13:
                case 14:
                case 15:
                    $this->common->resize_image($sourcepath, $destinationpath, '160', '100');    
                    break;                
            }
            unlink($sourcepath);
        }

        if ($_POST['link'] != "") {
            $set = array(
                'block' . $_POST['box'] => $_POST['link']
            );
            $where = array(
                'id' => '1'
            );

            $this->db->update('banner_mst', $set, $where);
        }
        return 1;
    }

    function uploadImageForMobile() {
        if ($_FILES['banner']['error'] != 4) {
            $pathMain =  FCPATH . "/upload/mobilebanner/";

            $filename = "upload.jpg";
            $destfilename = $_POST['box'] . ".jpg";

            $result = $this->common->do_upload('banner', $pathMain, $filename, TRUE);

            $sourcepath = $result['upload_data']['full_path'];
            $destinationpath = $pathMain . $destfilename;

            switch ($_POST['box']) {
                case 1:
                case 2:
                case 3:
                    $this->common->resize_image($sourcepath, $destinationpath, '300', '150');
                    break;
                case 4:
                case 5:
                case 6:
                case 7:
                    $this->common->resize_image($sourcepath, $destinationpath, '150', '100');
                    break;
                case 8:
                case 9:
                case 10:
                case 11:
                    $this->common->resize_image($sourcepath, $destinationpath, '300', '100');
                    break;
                default :
                    break;
            }
            unlink($sourcepath);
        }
        return 1;
    }

    function getUrl() {       
        $block = "block" . $_POST['block'];
        $this->db->select($block);
        $this->db->from('banner_mst');
        $this->db->where('id', '1');
        $query = $this->db->get()->row();
        echo $query->$block;
    }

    function getPlanPricing() {
        $query = $this->db->get("advertisement_plan");
        return $query->result();
    }

    function getPlan($planid) {
        $query = $this->db->get_where("advertisement_plan", array('plan_id' => $planid));
        return $query->row();
    }

    function insertPlan($post) {
        return ($this->db->insert("advertisement_plan", $post)) ? TRUE : FALSE;
    }

    function updatePlan($post) {
        $planid = $post['planid'];
        unset($post['planid']);
        return ($this->db->update("advertisement_plan", $post, array('plan_id' => $planid))) ? TRUE : FALSE;
    }

    function deletePlan($planid) {
        return ($this->db->delete("advertisement_plan", array('plan_id' => $planid))) ? TRUE : FALSE;
    }

    function getRequests() {
        $this->db->select('request_id,request_date,price,box,category,AR.status,S.business_name,size,from,to');
        $this->db->from('advertisement_request as AR');
        $this->db->join('advertisement_plan as AP', 'AR.plan_id = AP.plan_id');
        $this->db->join('seller_mst as S', 'AR.seller_id = S.seller_id');
        $this->db->where('AR.status', '0');
        $query = $this->db->get();
        return $query->result();
    }

    function search() {
        if ($this->input->post() != "") {
            ($_POST['start'] != "") ? $where['DATE(request_date) >='] = date('Y-m-d', strtotime($_POST['start'])) : '';
            ($_POST['end'] != "") ? $where['DATE(request_date) <= '] = date('Y-m-d', strtotime($_POST['end'])) : '';
            ($_POST['business_name'] != "") ? $this->db->like('S.business_name', $_POST['business_name']) : '';
            ($_POST['price'] != "") ? $where['price'] = $_POST['price'] : '';
            ($_POST['size'] != "" && $_POST['size'] != "-1" ) ? $where['size'] = $_POST['size'] : '';
            ($_POST['status'] != "" && $_POST['status'] != "-1") ? $where['AR.status'] = $_POST['status'] : '';
        }
        if (isset($where)) {
            $this->db->select('request_id,request_date,price,box,category,AR.status,S.business_name,size,from,to');
            $this->db->from('advertisement_request as AR');
            $this->db->join('advertisement_plan as AP', 'AR.plan_id = AP.plan_id');
            $this->db->join('seller_mst as S', 'AR.seller_id = S.seller_id');
            $this->db->where($where);
            $query = $this->db->get();
            return $query->result();
        } else {
            $this->db->select('request_id,request_date,price,box,category,AR.status,S.business_name,size,from,to');
            $this->db->from('advertisement_request as AR');
            $this->db->join('advertisement_plan as AP', 'AR.plan_id = AP.plan_id');
            $this->db->join('seller_mst as S', 'AR.seller_id = S.seller_id');
            $query = $this->db->get();
            return $query->result();
        }
    }

    function requestStatusUpdate() {
        $status = $this->input->post('status');
        $this->db->where_in('request_id', $this->input->post('allRequest'));
        $this->db->update('advertisement_request', array('status' => $status));
        return 1;
    }

    function deleteRequest($requestid) {
        $this->db->delete('advertisement_request', array('request_id' => $requestid));
        return TRUE;
    }

}
