<?php

class Restaurant extends CI_Model {

    private $_hotel_restaurant = "hotel_restaurant_master";
    private $_hotel_master = "tbl_hotel_master";

    public function getRestaurant($params) {
        $this->db->select("hr.menu_id,hr.hotel_id,hm.hotel_name,hr.menu_session,hr.menu_type,hr.item_name,hr.item_desc,"
                ."hr.item_price,hr.item_available");
        $this->db->from($this->_hotel_restaurant." as hr");
        $this->db->join($this->_hotel_master." as hm","hm.hotel_id = hr.hotel_id","left");
        if (isset($params['where']) && !empty($params['where'])) {
            $this->db->where($params['where']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function postRestaurant($restaurant) {
        $this->db->insert($this->_hotel_restaurant, ['hotel_id' => $restaurant['hotel_id'],
            'menu_session' => $restaurant['menu_session'],
            'menu_type' => $restaurant['menu_type'],
            'item_name' => $restaurant['item_name'],
            'item_desc' => $restaurant['item_desc'],
            'item_price' => $restaurant['item_price'],
            'item_available' => $restaurant['item_available'],
                ], ['menu_id' => $restaurant['menu_id']]);
    }

    public function putRestaurant($restaurant) {
        $this->db->update($this->_hotel_restaurant, ['hotel_id' => $restaurant['hotel_id'],
            'menu_session' => $restaurant['menu_session'],
            'menu_type' => $restaurant['menu_type'],
            'item_name' => $restaurant['item_name'],
            'item_desc' => $restaurant['item_desc'],
            'item_price' => $restaurant['item_price'],
            'item_available' => $restaurant['item_available']
                ], ['menu_id' => $restaurant['menu_id']]);
    }

    public function deleteRestaurant($where) {
        $this->db->delete($this->_hotel_restaurant, $where);
    }

}
