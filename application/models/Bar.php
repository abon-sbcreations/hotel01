<?php

class Hotelbar extends CI_Model {

    private $_hotelbars_master = "hotel_bar_master";

    public function getHotelbar($params) {
        $this->db->select("menu_id,hotel_id,menu_cat,item_name,menu_type,item_img,item_desc,item_price,item_available");
        $this->db->from($this->_hotelbars_master);
        if (isset($params['where']) && !empty($params['where'])) {
            $this->db->where($params['where']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function postHotelbar($hotelbar) {
        $this->db->insert($this->_hotelbars_master, ['hotel_id' => $hotelbar['hotel_id'],
             'menu_cat' => $hotelbar['menu_cat'],
			'item_name' => $hotelbar['item_name'],
                         'menu_type' => $hotelbar['menu_type'],
			'item_img' => $hotelbar['item_img'],
			'item_desc' => $hotelbar['item_desc'],
			'item_price' => $hotelbar['item_price'],
			'item_available' => $hotelbar['item_available'],
			
			
                ], ['menu_id' => $hotelbar['menu_id']]);
    }
	

    public function putHotelbar($hotelbar) {
        $this->db->insert($this->_hotelbars_master, ['hotel_id' => $hotelbar['hotel_id'],
             'menu_cat' => $hotelbar['menu_cat'],
			'item_name' => $hotelbar['item_name'],
                         'menu_type' => $hotelbar['menu_type'],
			'item_img' => $hotelbar['item_img'],
			'item_desc' => $hotelbar['item_desc'],
			'item_price' => $hotelbar['item_price'],
			'item_available' => $hotelbar['item_available'],
			
			
                ], ['menu_id' => $hotelbar['menu_id']]);
    }
	

    public function deleteHotelbar($where) {
        $this->db->delete($this->_hotelbars_master, $where);
    }

}
