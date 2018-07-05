<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Module_masters extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('commonmisc_helper');
        $this->load->model('Module_master');
        $u1 = $this->session->userdata('logged_id');
        if (!isset($u1)) {
            redirect('/index.php/admins','refresh');
        }
    }
    public function index() {
        $loggedDisplay = $this->session->userdata('logged_display');
        $head01Temp = $this->load->view('templates/head01',['loggedDisplay'=>$loggedDisplay],TRUE);
        $leftmenu01Temp = $this->load->view('templates/leftmenu01',['activeMenu'=>'module_masters'],TRUE);          
        $this->load->view('module_masters/module_list', [
            'head01Temp'=>$head01Temp,
            'leftmenu01Temp'=>$leftmenu01Temp,
            'statusOption' => getStatus(),
        ]);
    }
    public function ajaxAllModulesMasterDataTable() {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $modules = $this->Module_master->getModuleMaster([]);
        $rows = [];
        foreach ($modules as $k => $module) {
            $rows[] = [
                "DT_RowId" => "row_" . $module['module_id'],
                "module_id" => $module['module_id'],
                'module_name' => $module['module_name'],
                'module_desc' => $module['module_desc'],
                'module_status' =>$module['module_status']
            ];
        }
        echo json_encode([
            "draw" => $draw,
            "recordsTotal" => count($modules),
            "recordsFiltered" => count($modules),
            "data" => $rows
        ]);
    }
    public function ajaxModulesMasterDetails() {
        $params = [
            'where' => ['module_id' => $this->input->post('module_id')]
        ];       
        $module = $this->Module_master->getModuleMaster($params);
        echo json_encode($module[0]);
    }
    public function ajaxAModulesMasterSubmit(){
        $post = $this->input->post();
        if (isset($post['module_id']) && !empty($post['module_id'])) {
            $this->Module_master->putAModuleMaster($post);
        } else {
            $this->Module_master->postModuleMaster($post);
        }
    }
    public function ajaxModulesMasterDelete() {
        $where = ['module_id' => $this->input->post('module_id')];
        $aminity = $this->Module_master->deleteModuleMaster($where);
        
        return json_encode(['true']);
    }
}
