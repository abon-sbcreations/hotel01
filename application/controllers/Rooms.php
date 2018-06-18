<?php

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
         $loggedId = $this->session->userdata('logged_id');
        $loggedDisplay = $this->session->userdata('logged_display'); //users full name.
        $this->load->view('rooms/master',[
            'loggedDisplay' => $loggedDisplay,
            'timeSlotOptions' => timeSlotOptions(),
            'hotelTypeSlotOptions' => hotelTypeSlotOptions()
            ]);
    }

    public function ajaxAllRoomMasterDataTable() {
        // Datatables Variables
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
    public function ajaxHotelDelete(){
        $where = ['hotel_id'=>$this->input->post('hotel_id')];
        $hotel = $this->hotel->deleteHotel($where);
        return json_encode(['true']);
    }
    public function ajaxRoomSubmit(){
      $post = $this->input->post(); 
      if(isset($post['hotel_id'])&& !empty($post['hotel_id'])){
        $this->hotel->putHotel($post);
      }else{
        $this->hotel->postHotel($post);
      }
    }
    public function ajaxNoUnique(){
        //hotel_id hotel_reg_number  hotel_gst_number
        $gstStatus = -1;        $regStatus = -1;
        $unqGst = $this->hotel->uniqueGstNo([
            'hotel_id'=>$this->input->post('hotel_id'),
            'hotel_gst_number'=>$this->input->post('hotel_gst_number')]);
        $unqReg = $this->hotel->uniqueRegNo([
            'hotel_id'=>$this->input->post('hotel_id'),
            'hotel_reg_number'=>$this->input->post('hotel_reg_number')]);
        if($unqGst == 1){
            $unqGst = "GST No is taken";
            $gstStatus = 0;
        }else{
            $unqGst = "GST No is unique";
            $gstStatus = 1;
        }
        if($unqReg ==1){
            $unqReg = "Registration no is taken";
            $regStatus = 0;
        }else{
           $unqReg = "Registration No is unique";
            $regStatus = 1; 
        }
        echo json_encode(['regStatus'=>$regStatus,'gstStatus'=>$gstStatus,
            'unqGst'=>$unqGst,'unqReg'=>$unqReg]);
    }
}
