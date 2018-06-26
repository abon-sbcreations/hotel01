<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hotelbars extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('commonmisc_helper');
        $this->load->model('Hotelbar');
        $u1 = $this->session->userdata('logged_id');
        if (!isset($u1)) {
            redirect('/index.php/admins', 'refresh');
        }
    }

    public function hotelbar_list() {
        $loggedId = $this->session->userdata('logged_id');
        $loggedDisplay = $this->session->userdata('logged_display'); //users full name.
        $this->load->view('hotelbars/hotelbar_list', [
            'loggedDisplay' => $loggedDisplay,
            'timeSlotOptions' => timeSlotOptions()
        ]);
    }

    public function ajaxAllHotelbarMasterDataTable() {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $hotelbars = $this->Hotelbar->getHotelbar([]);
        $rows = [];
        foreach ($hotelbars as $k => $hotelbar) {
            $rows[] = [
                "DT_RowId" => "row_" . $hotelbar['menu_id'],
                "menu_id" => $hotelbar['menu_id'],
                "hotel_id" => $hotelbar['hotel_id'],
                "menu_cart" => $hotelbar['menu_cart'],
                "item_name" => $hotelbar['item_name'],
                "menu_type" => $hotelbar['item_name'],
                "item_img" => $hotelbar['item_img'],
                "item_desc" => $hotelbar['item_desc'],
                "item_price" => $hotelbar['item_price'],
                "item_available" => $hotelbar['item_available']
            ];
        }
        echo json_encode([
            "draw" => $draw,
            "recordsTotal" => count($hotelbars),
            "recordsFiltered" => count($hotelbars),
            "data" => $rows
        ]);
    }

    public function ajaxHotelbarMasterDetails() {
        $params = [
            'where' => ['menu_id' => $this->input->post('menu_id')]
        ];
        $hotelbars = $this->Hotelbar->getHotelbar($params);
        echo json_encode($hotelbar[0]);
    }

    public function ajaxHotelbarMasterDelete() {
        $where = ['menu_id' => $this->input->post('menu_id')];
        $hotelbar = $this->Hotelbar->deleteHotelbar($where);

        return json_encode(['true']);
    }

    public function ajaxHotelbarMasterSubmit() {
        $post = $this->input->post();
        if (isset($post['menu_id']) && !empty($post['menu_id'])) {
            $this->Hotelbar->putHotelbar($post);
        } else {
            $this->Hotelbar->postHotelbar($post);
        }
    }

}




/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

