<?php

class Hotel extends CI_Model {

    private $_hotel_master = "tbl_hotel_master";

    public function getHotels($params) {
        $this->db->select("hm.hotel_id,hm.hotel_name,hm.hotel_type,hm.hotel_address,hm.hotel_reg_number,"
                . "hm.hotel_gst_number,hm.hotel_check_in_time,hm.hotel_check_out_time,"
                . "hm.hotel_has_restaurant,hm.hotel_has_bar,hm.hotel_reg_date");
        $this->db->from($this->_hotel_master . " as hm");
        if (isset($params['where']) && !empty($params['where'])) {
            $this->db->where($params['where']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function postHotel($hotel) {
        $this->db->insert($this->_hotel_master, ['hotel_name' => $hotel['hotel_name'],
            'hotel_type' => $hotel['hotel_type'],
            'hotel_address' => $hotel['hotel_address'],
            'hotel_reg_number' => $hotel['hotel_reg_number'],
            'hotel_gst_number' => $hotel['hotel_gst_number'],
            'hotel_check_in_time' => $hotel['hotel_check_in_time'],
            'hotel_check_out_time' => $hotel['hotel_check_out_time'],
            'hotel_has_restaurant' => $hotel['hotel_has_restaurant'],
            'hotel_has_bar' => $hotel['hotel_has_bar']
            //'hotel_reg_date' => $hotel['hotel_reg_date'],
        ]);
    }

    public function putHotel($hotel) {
        $this->db->update($this->_hotel_master, ['hotel_name' => $hotel['hotel_name'],
            'hotel_type' => $hotel['hotel_type'],
            'hotel_address' => $hotel['hotel_address'],
            'hotel_reg_number' => $hotel['hotel_reg_number'],
            'hotel_gst_number' => $hotel['hotel_gst_number'],
            'hotel_check_in_time' => $hotel['hotel_check_in_time'],
            'hotel_check_out_time' => $hotel['hotel_check_out_time'],
            'hotel_has_restaurant' => $hotel['hotel_has_restaurant'],
            'hotel_has_bar' => $hotel['hotel_has_bar']
            //'hotel_reg_date' => $hotel['hotel_reg_date'],
                ], ['hotel_id' => $hotel['hotel_id']]);
    }

    public function deleteHotel($where) {
        $this->db->delete($this->_hotel_master, $where);
    }
    public function uniqueGstNo($arr){
         $this->db->select('hotel_id,hotel_gst_number');
         $this->db->from($this->_hotel_master);
         if($arr['hotel_id']==0){
             $this->db->where(['hotel_gst_number'=>$arr['hotel_gst_number']]);
         }else{
             $this->db->where(['hotel_gst_number'=>$arr['hotel_gst_number'],
                    'hotel_id'=>$arr['hotel_id']]);
         }
         $query = $this->db->get();
         $result = $query->result();
         if($arr['hotel_id']==0){
            return count($result) > 0 ? 1 : 0; 
         }else{
             return count($result) == 1 ? 0 : 1;
         }
    }
    public function uniqueRegNo($arr){
        $this->db->select('hotel_id,hotel_reg_number');
         $this->db->from($this->_hotel_master);
         if($arr['hotel_id']==0){
             $this->db->where(['hotel_reg_number'=>$arr['hotel_reg_number']]);
         }else{
             $this->db->where(['hotel_reg_number'=>$arr['hotel_reg_number'],
                    'hotel_id'=>$arr['hotel_id']]);
         }
         $query = $this->db->get();
         $result = $query->result();
         if($arr['hotel_id']==0){
            return count($result) > 0 ? 1 : 0; 
         }else{
             return count($result) == 1 ? 0 : 1;
         }
    }

}
