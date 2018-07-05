<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bars extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('commonmisc_helper');
        $this->load->model('Bar');
        $u1 = $this->session->userdata('hotel_userid');
         if(!isset($u1)){
            redirect('/index.php/hoteladmins', 'refresh');
        }
    }

    public function bar_list() {
        $loggedHotelAdmin = $this->session->all_userdata();
        $head02Temp = $this->load->view('templates/head02',['loggedHotelAdmin'=>$loggedHotelAdmin],TRUE);
        $leftmenu02Temp = $this->load->view('templates/leftmenu02',['activeMenu'=>'bars/bar_list'],TRUE);
        $this->load->view('bars/bar_list', [
            'head02Temp'=>$head02Temp,
            'leftmenu02Temp'=>$leftmenu02Temp,
            'hotelOptions' =>hotelOptions(),
            'timeSlotOptions' => timeSlotOptions(),
            'menuTypeOption' => getMenuType(),
            'availableOption' => getItemAvailable()            
        ]);
    }

    public function ajaxAllBarMasterDataTable() {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $bars = $this->Bar->getBar([]);
        $rows = [];
        foreach ($bars as $k => $bar) {
            $rows[] = [
                "DT_RowId" => "row_" . $bar['menu_id'],
                "menu_id" => $bar['menu_id'],
                "hotel_id" => $bar['hotel_id'],
                "menu_cat" => $bar['menu_cat'],
                "item_name" => $bar['item_name'],
                "menu_type" => $bar['item_name'],
                "item_img" => $bar['item_img'],
                "item_desc" => $bar['item_desc'],
                "item_price" => $bar['item_price'],
                "item_available" => $bar['item_available']
            ];
        }
        echo json_encode([
            "draw" => $draw,
            "recordsTotal" => count($bars),
            "recordsFiltered" => count($bars),
            "data" => $rows
        ]);
    }

    public function ajaxBarMasterDetails() {
        $params = [
            'where' => ['menu_id' => $this->input->post('menu_id')]
        ];
        $bars = $this->Bar->getBar($params);
        echo json_encode($bars[0]);
    }

    public function ajaxBarMasterDelete() {
        $where = ['menu_id' => $this->input->post('menu_id')];
        $this->Bar->deleteBar($where);
        return json_encode(['true']);
    }

    public function ajaxBarMasterSubmit() {
        $post = $this->input->post();
        if (isset($post['menu_id']) && !empty($post['menu_id'])) {
            $this->Hotelbar->putBar($post);
        } else {
            $this->Hotelbar->postBar($post);
        }
    }

}




/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

