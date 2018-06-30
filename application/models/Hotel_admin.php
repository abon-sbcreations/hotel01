<?php

class Hotel_admin extends CI_Model {

    private $_admin_master = "hotel_admin_master";
    private $_hotel_master = "tbl_hotel_master";

    public function getHotelAdmin($params) {
        $this->db->select("am.hotel_admin_id,am.hotel_id,hm.hotel_name,am.hotel_userid,am.hotel_passwd,"
                . "am.hotel_module_permission,am.hotel_access_activation,am.hotel_access_duration,am.hotel_access_rent,"
                . "am.is_rent_paid,am.hotel_admin_status");
        $this->db->from($this->_admin_master . " as am");
        $this->db->join($this->_hotel_master . " as hm","am.hotel_id = hm.hotel_id","left");
        if (isset($params['where']) && !empty($params['where'])) {
            $this->db->where($params['where']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    private function moduleToJson($moduleArr){
        $legends = [0=>'view',1=>'add',2=>'edit',3=>'delete'];
        $jsonStr = "{";
        foreach ($moduleArr as $module_id=>$permissions){
            $perString = "";
            foreach ($permissions as $legend=>$val){
                $perString .="\"".$legends[$legend]."\",";
            }
            $jsonStr .= "\"{$module_id}\":[".rtrim($perString,",")."],";            
        }
        return rtrim($jsonStr,",")."}";
        
    }
    public function postHotelAdmin($master) {
        $this->db->insert($this->_admin_master, [
            'hotel_id' => $master['hotel_id'],
            'hotel_userid' => $master['hotel_userid'],
            'hotel_passwd' => md5($this->config->item('encryption_key').$master['hotel_userid']),
            'hotel_module_permission' => $this->moduleToJson($master['module']),
            'hotel_access_activation' => $master['hotel_access_activation'],
            'hotel_access_duration' => $master['hotel_access_duration'],
            'hotel_access_rent' => $master['hotel_access_rent'],
            'is_rent_paid' => 'Y',//$master['is_rent_paid'],
            'hotel_admin_status' => $master['hotel_admin_status']
        ]);
    }

    public function putHotelAdmin($master) {
         echo $this->moduleToJson($master['module']);
        $this->db->update($this->_admin_master, [
             'hotel_id' => $master['hotel_id'],
            'hotel_userid' => $master['hotel_userid'],
            'hotel_module_permission' => $this->moduleToJson($master['module']),
            'hotel_access_activation' => $master['hotel_access_activation'],
            'hotel_access_duration' => $master['hotel_access_duration'],
            'hotel_access_rent' => $master['hotel_access_rent'],
            'is_rent_paid' => $master['is_rent_paid'],
            'hotel_admin_status' => $master['hotel_admin_status']
                ], ['hotel_admin_id' => $master['hotel_admin_id']]);
    }
    public function putHotelAdminPassword($post){
        /*
         * Array(
    [oldHotel_passwd] => asfafwqwf
    [hotel_admin_id] => 8
    [hotel_passwd] => qwfqwfwqf
    [rehotel_passwd] => wqfqwfqwf)
         */
        $status = 0;
        $message = "";
        if($post['rehotel_passwd'] == $post['hotel_passwd']){
            $qry = $this->db->from($this->_admin_master)->where([
                'hotel_admin_id'=>$post['hotel_admin_id'],
                'hotel_passwd'=> md5($this->config->item('encryption_key').$post['oldHotel_passwd'])
                ])->get();
            $res = $qry->result();
            if(!empty($res)){
                $this->db->update($this->_admin_master
                        ,['hotel_passwd'=> md5($this->config->item('encryption_key').$post['hotel_passwd'])]
                        ,['hotel_admin_id' => $post['hotel_admin_id']]);
                $status = 1;
                $message = "Password Changed SuccessFully";
            }else{
                $status = -1;
                $message = "wrong Old password entered";
            }
        }else{
            $status = -1;
            $message = "confirm password not matching with new password";
        }
        return json_encode(['status'=>$status,'message'=>$message]);
    }
    public function deleteHotelAdmin($where) {
        $this->db->delete($this->_admin_master, $where);
    }

}
