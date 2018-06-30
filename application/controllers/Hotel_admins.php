<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hotel_admins extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form', 'security');
        $this->load->helper('commonmisc_helper');
        $this->load->library('form_validation', 'session');
        $this->load->model('Hotel_admin');
        $u1 = $this->session->userdata('logged_id');
        if (!isset($u1)) {
            redirect('/index.php/admins', 'refresh');
        }
    }
    public function admins() {
        $loggedId = $this->session->userdata('logged_id');
        $loggedDisplay = $this->session->userdata('logged_display');
        $this->load->view('hotel_admins/listing', [
            'loggedDisplay' => $loggedDisplay,
            'hotelOptions' =>hotelOptions(),
            'moduleOptions' =>getModuleOptions(),
            'isActive' => getStatus(),
            'yesNo' => getItemAvailable()
            
        ]);
    }
    public function ajaxAllHotelAdminDataTable() {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $hotelAdmins = $this->Hotel_admin->getHotelAdmin([]);        
        $rows = [];
        foreach ($hotelAdmins as $k => $room){
            $rows[] = [
                "DT_RowId" => "row_" . $room['hotel_admin_id'],
                "hotel_admin_id" => $room['hotel_admin_id'],
                'hotel_name' => $room['hotel_name'],
                'hotel_userid' => $room['hotel_userid'],
                'hotel_access_activation' => $room['hotel_access_activation'],
                'hotel_access_duration' => $room['hotel_access_duration']
            ];
        }
        echo json_encode([
            "draw" => $draw,
            "recordsTotal" => count($hotelAdmins),
            "recordsFiltered" => count($hotelAdmins),
            "data" => $rows
        ]);
    }
    public function ajaxHotelAdminDetails() {
        $params = [
            'where' => ['hotel_admin_id' => $this->input->post('hotel_admin_id')]
        ];
        $admin = $this->Hotel_admin->getHotelAdmin($params);
        echo json_encode($admin[0]);
    }
    public function ajaxHotelAdminDelete() {
        $where = ['hotel_admin_id' => $this->input->post('hotel_admin_id')];
        $comp = $this->Hotel_admin->deleteHotelAdmin($where);
        return json_encode(['true']);
    }
    public function ajaxHotelAdminSubmit() {
        $post = $this->input->post();
        if (isset($post['hotel_admin_id']) && !empty($post['hotel_admin_id'])) {
            $this->Hotel_admin->putHotelAdmin($post);
        } else {
            $this->Hotel_admin->postHotelAdmin($post);
        }
    }
    public function ajaxHotelAdminPasswordsSubmit(){
        $post = $this->input->post();
        if (isset($post['hotel_admin_id']) && !empty($post['hotel_admin_id'])) {
           echo $this->Hotel_admin->putHotelAdminPassword($post);
        }else{
            echo json_encode(['status'=>-1,'message'=>"invalid form submission"]);
        }
    }
}
