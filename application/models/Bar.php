<?php

class Bar extends CI_Model {
    private $_hotel_bar_master = "hotel_bar_master";     
    private $_hotel_master = "tbl_hotel_master";    

    public function getBar($params) {
        $this->db->select("hbm.menu_id,hbm.hotel_id,hm.hotel_name,hbm.menu_cat,hbm.menu_cat,"
                ."hbm.item_name,hbm.item_desc,hbm.item_price,hbm.item_available");
        $this->db->from($this->_hotel_bar_master." as hbm");
        $this->db->join($this->_hotel_master." as hm","hm.hotel_id = hbm.hotel_id","left");
        if (isset($params['where']) && !empty($params['where'])) {
            $this->db->where($params['where']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    public function postBar($bar) {
        $this->db->insert($this->_hotel_bar_master, [
            'hotel_id' => $bar['hotel_id'],
            'menu_cat' => $bar['menu_cat'],
            'item_name' => $bar['item_name'],
            'menu_type' => $bar['menu_type'],
            'item_desc' => $bar['item_desc'],
            'item_price' => $bar['item_price'],
            'item_available' => $bar['item_available']
           ]);
    }
	

    public function putBar($hotelbar) {
        $this->db->insert($this->_hotel_bar_master, [
            'hotel_id' => $bar['hotel_id'],
            'menu_cat' => $bar['menu_cat'],
            'item_name' => $bar['item_name'],
            'menu_type' => $bar['menu_type'],
            'item_desc' => $bar['item_desc'],
            'item_price' => $bar['item_price'],
            'item_available' => $bar['item_available']
           ], ['menu_id' => $hotelbar['menu_id']]);
    }
	

    public function deleteBar($where) {
        $this->db->delete($this->_hotel_bar_master, $where);
    }

}






