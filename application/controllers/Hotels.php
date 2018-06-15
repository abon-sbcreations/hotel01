<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hotels extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('commonmisc_helper');
        $this->load->model('hotel');
        $u1 = $this->session->userdata('logged_id');
        if (!isset($u1)) {
            redirect('/index.php/admins', 'refresh');
        }
    }

    public function index() {
    
    }

    public function hotels() {
        
         $loggedId = $this->session->userdata('logged_id');
        $loggedDisplay = $this->session->userdata('logged_display');
        $this->load->view('hotels/hotels',[
            'loggedDisplay' => $loggedDisplay,
            'timeSlotOptions' => timeSlotOptions(),
            'hotelTypeSlotOptions' => hotelTypeSlotOptions()
            ]);
    }

    public function ajaxAllHotelsDataTable() {
        // Datatables Variables
          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));
        $hotels = $this->hotel->getHotels([]);
        $rows = [];
        foreach ($hotels as $k => $hotel) {
            $rows[] = [
                "DT_RowId" => "row_".$hotel['hotel_id'],
                "hotel_id" => $hotel['hotel_id'],
                'hotel_name' => $hotel['hotel_name'],
                'hotel_type' => $hotel['hotel_name'],
                'hotel_address' => $hotel['hotel_address'],
                'hotel_reg_number' => $hotel['hotel_reg_number'],
                'hotel_has_restaurant' => $hotel['hotel_has_restaurant'] == 'Y' ? "Yes" : "No",
                'hotel_has_bar' => $hotel['hotel_has_bar'] == 'Y' ? "Yes" : "No",
            ];
        }
        echo json_encode([
            "draw" => $draw,
            "recordsTotal" => count($hotels),
            "recordsFiltered" => count($hotels),
            "data" => $rows
        ]);
    }
    public function ajaxHotelDetails(){
        $params = [
            'where'=>['hotel_id'=>$this->input->post('hotel_id')]
        ];
        $hotel = $this->hotel->getHotels($params);
        echo json_encode($hotel[0]);
    }
    public function ajaxHotelDelete(){
        $where = ['hotel_id'=>$this->input->post('hotel_id')];
        $hotel = $this->hotel->deleteHotel($where);
        return json_encode(['true']);
    }
    public function ajaxHotelSubmit(){
      $post = $this->input->post(); 
      if(isset($post['hotel_id'])&& !empty($post['hotel_id'])){
        $this->hotel->putHotel($post);
      }
    }
}
