<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurants extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('commonmisc_helper');
        $this->load->model('Restaurant');
        $u1 = $this->session->userdata('logged_id');
        if (!isset($u1)) {
            redirect('/index.php/admins', 'refresh');
        }
    }

    public function restaurant_list() {
        $loggedId = $this->session->userdata('logged_id');
        $loggedDisplay = $this->session->userdata('logged_display'); //users full name.
        $this->load->view('restaurants/restaurant_list', [
            'loggedDisplay' => $loggedDisplay,
            'timeSlotOptions' => timeSlotOptions()
        ]);
    }

    public function ajaxAllRestaurantMasterDataTable() {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $restaurants = $this->Restaurant->getRestaurant([]);
        $rows = [];
        foreach ($restaurants as $k => $restaurant) {
            $rows[] = [
                "DT_RowId" => "row_" . $restaurant['menu_id'],
                "menu_id" => $restaurant['menu_id'],
                "menu_session" => $restaurant['menu_session'],
                "menu_type" => $restaurant['menu_type'],
                "item_name" => $restaurant['item_name'],
                "item_img" => $restaurant['item_img'],
                "item_desc" => $restaurant['item_desc'],
                "item_price" => $restaurant['item_price'],
                "item_available" => $restaurant['item_available']
            ];
        }
        echo json_encode([
            "draw" => $draw,
            "recordsTotal" => count($restaurants),
            "recordsFiltered" => count($restaurants),
            "data" => $rows
        ]);
    }

    public function ajaxRestaurantMasterDetails() {
        $params = [
            'where' => ['menu_id' => $this->input->post('menu_id')]
        ];
        $restaurant = $this->Restaurant->getRestaurant($params);
        echo json_encode($restaurant[0]);
    }

    public function ajaxRestaurantMasterDelete() {
        $where = ['menu_id' => $this->input->post('menu_id')];
        $restaurant = $this->Restaurant->deleteRestaurant($where);

        return json_encode(['true']);
    }

    public function ajaxRestaurantMasterSubmit() {
        $post = $this->input->post();
        if (isset($post['menu_id']) && !empty($post['menu_id'])) {
            $this->Restaurant->putRestaurant($post);
        } else {
            $this->Restaurant->postRestaurant($post);
        }
    }

}
