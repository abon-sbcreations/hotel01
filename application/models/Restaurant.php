<?php

class Restaurant extends CI_Model {

    private $_hotel_restaurant_master = "hotel_restaurant_master";
	
	
	 public function getRestaurant($params) {
        $this->db->select("menu_id,menu_session,menu_type,item_name,item_desc,item_price,item_available");
        $this->db->from($this->_hotel_restaurant_master);
        if (isset($params['where']) && !empty($params['where'])) {
            $this->db->where($params['where']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

	
	
	 public function postRestaurant($restaurant) {
        $this->db->insert($this->_restaurants_master, ['hotel_id' => $restaurant['hotel_id'],
            'menu_session' => $amenity['menu_session'],
			'menu_type' => $amenity['menu_type'],
			'item_name' => $amenity['item_name'],
			'item_img' => $amenity['item_img'],
			'item_desc' => $amenity['item_desc'],
			'item_price' => $amenity['item_price'],
			'item_available' => $amenity['item_available'],
			
			
                ], ['menu_id' => $amenity['menu_id']]);
    }
	
	
	
	 
	
	
	  public function deleteRestaurant($where) {
        $this->db->delete($this->restaurants_master, $where);
    }

}

	
	