<?php

class Customer extends CI_Model {
    private $_customer_master = "customer_master";
    private $_tbl_hotel_master = "tbl_hotel_master";
    
    public function getCustomer($params) {
        $this->db->select("cm.cust_id,cm.hotel_id,thm.hotel_name,cm.cust_name,cm.cust_phone,cm.cust_email,"
                ."cm.cust_status,cm.membership_type,cm.membership_num,cm.membership_issue_date");
        $this->db->from($this->_customer_master." as cm");
        $this->db->join($this->_tbl_hotel_master." as thm","thm.hotel_id = cm.hotel_id","left");
    
        if (isset($params['where']) && !empty($params['where'])) {
            $this->db->where($params['where']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function postCustomer($customer) {
        $this->db->insert($this->_customer_master, [
            'cust_id'=>$customer['cust_id'],'hotel_id'=>$customer['hotel_id'],
            'cust_name'=>$customer['cust_name'],'cust_phone'=>$customer['cust_phone'],
            'cust_email'=>$customer['cust_email'],'cust_status'=>$customer['cust_status'],
            'membership_type'=>$customer['membership_type'],'membership_num'=>$customer['membership_num'],
            'membership_issue_date'=>$customer['membership_issue_date']         
                ]);
    }
    public function putCustomer($customer) {
        $this->db->update($this->_customer_master, ['hotel_id'=>$customer['hotel_id'],
            'cust_name'=>$customer['cust_name'],'cust_phone'=>$customer['cust_phone'],
            'cust_email'=>$customer['cust_email'],'cust_status'=>$customer['cust_status'],
            'membership_type'=>$customer['membership_type'],'membership_num'=>$customer['membership_num'],
            'membership_issue_date'=>$customer['membership_issue_date']], 
                ['cust_id'=>$customer['cust_id']]);
    }

    public function deleteCustomer($where) {
        $this->db->delete($this->_customer_master, $where);
    }

}
