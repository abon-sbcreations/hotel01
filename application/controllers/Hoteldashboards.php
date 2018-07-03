<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hoteldashboards extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $u1 = $this->session->userdata('hotel_admin_id');
         if(!isset($u1)){
            redirect('/index.php/hoteladmins', 'refresh');
        }
    }
    public function admin_area(){
        $loggedId = $this->session->userdata('logged_id');
        $loggedHotelAdmin = $this->session->all_userdata();
        $this->load->view('hoteldashboard/hotel_dsbrd',['loggedHotelAdmin'=>$loggedHotelAdmin]);
    }
}