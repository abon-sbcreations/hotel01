<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rooms extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('commonmisc_helper');
        $this->load->model('RoomMaster');
        $u1 = $this->session->userdata('logged_id');
        if (!isset($u1)) {
            redirect('/index.php/admins', 'refresh');
        }
    }
    public function master() {
        $loggedDisplay = $this->session->userdata('logged_display');
        $head01Temp = $this->load->view('templates/head01',['loggedDisplay'=>$loggedDisplay],TRUE);
        $leftmenu01Temp = $this->load->view('templates/leftmenu01',['activeMenu'=>'rooms/master'],TRUE);
        $this->load->view('rooms/master',[
            'head01Temp'=>$head01Temp,
            'leftmenu01Temp'=>$leftmenu01Temp,
            'timeSlotOptions' => timeSlotOptions()
            ]);
    }
    public function ajaxAllRoomMasterDataTable() {
          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));
        $roomMasters = $this->RoomMaster->getRoomsMaster([]);
        $rows = [];
        foreach ($roomMasters as $k => $rooms) {
            $rows[] = [
                "DT_RowId" => "row_".$rooms['room_master_id'],
                "room_master_id" => $rooms['room_master_id'],
                'room_type' => $rooms['room_type']                
            ];
        }
        echo json_encode([
            "draw" => $draw,
            "recordsTotal" => count($roomMasters),
            "recordsFiltered" => count($roomMasters),
            "data" => $rows
        ]);
    }
    public function ajaxRoomMasterDetails(){
        $params = [
            'where'=>['room_master_id'=>$this->input->post('room_master_id')]
        ];       
        $roommaster = $this->RoomMaster->getRoomsMaster($params);
        echo json_encode($roommaster[0]);
    }
    public function ajaxRoomMasterDelete(){
        $where = ['room_master_id'=>$this->input->post('room_master_id')];
        $hotel = $this->RoomMaster->deleteRoomMaster($where);
        return json_encode(['true']);
    }
    public function ajaxRoomMasterSubmit(){
      $post = $this->input->post(); 
      if(isset($post['room_master_id'])&& !empty($post['room_master_id'])){
        $this->RoomMaster->putRoomMaster($post);
      }else{
        $this->RoomMaster->postRoomMaster($post);
      }
    }    
}
