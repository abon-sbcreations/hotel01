<?php

class Module_master extends CI_Model {

    private $_module_master = "tbl_module_master";

    public function getModuleMaster($params) {
        $this->db->select("module_id,module_name,module_desc,module_status");
        $this->db->from($this->_module_master);
        if (isset($params['where']) && !empty($params['where'])) {
            $this->db->where($params['where']);
        }
        if (isset($params['where_in']) && !empty($params['where_in'])) {
            $this->db->where_in($params['where_in']['attr'],$params['where_in']['list']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    public function postModuleMaster($amenity) {
        $this->db->insert($this->_module_master, [
            'module_name' => $amenity['module_name'],
            'module_desc' => $amenity['module_desc'],
            'module_status' => $amenity['module_status']
                ]);
    }

    public function putAModuleMaster($amenity) {
        $this->db->update($this->_module_master, [
           'module_name' => $amenity['module_name'],
           'module_desc' => $amenity['module_desc'],
           'module_status' => $amenity['module_status']
          ], ['module_id' => $amenity['module_id']]);
    }

    public function deleteModuleMaster($where) {
        $this->db->delete($this->_module_master, $where);
    }

}