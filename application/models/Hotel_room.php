<?php

class Hotel_room extends CI_Model {

    private $_hotel_room_detail = "tbl_hotel_room_detail";
    private $_room_master = "tbl_room_master";
    //private $_amenities_master = "tbl_amenities_master";
    private $_hotel_master = "tbl_hotel_master";

    public function getHotelRooms($params) {
        $this->db->from($this->_hotel_room_detail." as hrd");
        $this->db->join($this->_hotel_master." as hm","hm.hotel_id = hrd.hotel_id","left");
        //$this->db->join($this->_amenities_master." as am","am.amenity_id = hrd.hotel_room_type","left");
        $this->db->join($this->_room_master." as rm","rm.room_master_id = hrd.hotel_room_type","left");
       $this->db->select("hrd.hotel_room_master_id,hrd.hotel_id,hm.hotel_name,hrd.hotel_room_type,rm.room_type_Desc,"
               ."hrd.hotel_room_rent,hrd.hotel_room_desc,hrd.hotel_room_amenities");
       //$this->db->select("hrd.hotel_room_master_id,hrd.hotel_id,hrd.hotel_room_type,hrd.hotel_room_rent,hrd.hotel_room_desc,hrd.hotel_room_amenities"); 
        if (isset($params['where']) && !empty($params['where'])) {
            $this->db->where($params['where']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function postHotelRoom($hotel) {
            $this->db->insert($this->_hotel_room_detail, [
            'hotel_id' => $hotel['hotel_id'],
            'hotel_room_type' => $hotel['hotel_room_type'],
            'hotel_room_rent' => $hotel['hotel_room_rent'],
            'hotel_room_desc' => $hotel['hotel_room_desc'],
            'hotel_room_amenities' => $this->amenitiesList($hotel['amenity']),
        ]);
    }

    public function putHotelRoom($hotel) {
        echo $this->amenitiesList($hotel['amenity']);
        $this->db->update($this->_hotel_room_detail, [
            'hotel_id' => $hotel['hotel_id'],
            'hotel_room_type' => $hotel['hotel_room_type'],
            'hotel_room_rent' => $hotel['hotel_room_rent'],
            'hotel_room_desc' => $hotel['hotel_room_desc'],
            'hotel_room_amenities' => $this->amenitiesList($hotel['amenity']),
        ], ['hotel_room_master_id' => $hotel['hotel_room_master_id']]);
    }
    public function deleteHotelRoom($where) {
        $this->db->delete($this->_hotel_room_detail, $where);
    }
    private function amenitiesList($arr){
        $list = "";
        if(!empty($arr)){
            foreach ($arr as $key=>$val){
                $list .= "{$key},";
            }
        }        
        return rtrim($list,',');
    }
}
