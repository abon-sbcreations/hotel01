<?php
class Admin extends CI_Model{
    private $_super_admin = "tbl_super_admin";
    public function checkAdmin($arr){
        $this->db->from($this->_super_admin." as sa");
        $this->db->select("sa.*");
        $this->db->where([
            'sa.admin_username'=>$arr['uname'],
            'sa.admin_password'=>md5($this->config->item('encryption_key').
                    $arr['password'])
                ]);
       $query = $this->db->get();
       $res = $query->result_array();
       return !empty($res) ? "true": "false";
    }
    public function getAdmin($key='',$value=''){
        if(!empty($key) && !empty($value)){
            $this->db->from($this->_super_admin." as sa");
            $this->db->select("sa.admin_username,sa.admin_id,sa.admin_display_name");
            $this->db->where([
                $key => $value
            ]);
            $query = $this->db->get();
            return $query->result_array();
        }
    }
}