<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Item_masters extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('commonmisc_helper');
        $this->load->model('Item_master');
        $u1 = $this->session->userdata('hotel_userid');
         if(!isset($u1)){
            redirect('/index.php/hoteladmins', 'refresh');
        }
    }

    public function master() {
        $loggedHotelAdmin = $this->session->all_userdata();
        $head02Temp = $this->load->view('templates/head02',['loggedHotelAdmin'=>$loggedHotelAdmin],TRUE);
        $leftmenu02Temp = $this->load->view('templates/leftmenu02',['activeMenu'=>'item_masters/master'],TRUE);
        $this->load->view('items_master/master', [
           'head02Temp'=>$head02Temp,
            'leftmenu02Temp'=>$leftmenu02Temp,
            'timeSlotOptions' => timeSlotOptions(),
            'itemCategory'=>roomItemCategories()
        ]);
    }
    public function ajaxAllRoomItemMasterDataTable() {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $roomItems = $this->Item_master->getItemMaster([]);
        $rows = [];
        foreach ($roomItems as $k => $items) {
            $rows[] = [
                "DT_RowId" => "row_" . $items['room_item_id'],
                "room_item_id" => $items['room_item_id'],
                "room_item_cat" => $items['room_item_cat'],
                 "room_item_subcat" => $items['room_item_subcat'],
                'room_item_name' => $items['room_item_name']
            ];
        }
        echo json_encode([
            "draw" => $draw,
            "recordsTotal" => count($roomItems),
            "recordsFiltered" => count($roomItems),
            "data" => $rows
        ]);
    }
    public function ajaxRoomItemMasterDetails(){
        $params = [
            'where'=>['room_item_id' =>$this->input->post('room_item_id') ] 
        ];       
        $itemsMaster = $this->RoomItemMaster->getItemMaster($params);
        echo json_encode($itemsMaster[0]);
    }
    public function ajaxRoomItemMasterDelete(){
        $where = ['room_item_id'=>$this->input->post('room_item_id')];
        $hotel = $this->RoomItemMaster->deleteitemMaster($where);
        return json_encode(['true']);
    }
    public function ajaxRoomItemsMasterSubmit(){
      $post = $this->input->post(); 
      if(isset($post['room_item_id'])&& !empty($post['room_item_id'])){
        $this->RoomItemMaster->putItemMaster($post);
      }else{
        $this->RoomItemMaster->postItemMaster($post);
      }
    }
}
