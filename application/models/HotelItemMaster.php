<?php

class RoomItemMaster extends CI_Model{
    private $_hotel_item_master = "hotel_item_master";
    private $_hotel_master = "tbl_hotel_master";
    public function getItemMaster($params) {
        $this->db->select("him.item_id,him.hotel_id,hm.hotel_name,him.item_cat,him.item_subcat,him.item_img,"
                          ."him.item_name,him.item_attr,him.item_desc");
        $this->db->from($this->_hotel_item_master." as him");
        $this->db->from($this->_hotel_master." as hm","hm.hotel_id = him.hotel_id","left");
        if (isset($params['where']) && !empty($params['where'])) {
            $this->db->where($params['where']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    public function postItemMaster($master) {
        $this->db->insert($this->_hotel_item_master, ['hotel_id' => $master['hotel_id'],
            'item_cat' => $master['item_cat'],'item_subcat' => $master['item_subcat'],
             'item_img' => $master['item_img'],'item_name' => $master['item_name'],    
            'item_attr' => $master['item_attr'],'item_desc' => $master['item_desc']
        ]);
    }
    public function putitemMaster($master) {
        $this->db->update($this->_hotel_item_master, ['hotel_id' => $master['hotel_id'],
            'item_cat' => $master['item_cat'],'item_subcat' => $master['item_subcat'],
             'item_img' => $master['item_img'],'item_name' => $master['item_name'],    
            'item_attr' => $master['item_attr'],'item_desc' => $master['item_desc']
                ], ['item_id' => $master['item_id']]);
    }
    public function deleteitemMaster($where) {
        $this->db->delete($this->_hotel_item_master, $where);
    }
}