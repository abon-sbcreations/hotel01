<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Amenities extends CI_Controller {

    public function __construct($param) {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('commonmisc_helper');
        $this->load->model('Amenity');
        $u1 = $this->session->userdata('logged_id');
        if (!isset($u1)) {
            redirect('/index.php/admins', 'refresh');
        }
    }
    public function amenity_list() {
        $loggedId = $this->session->userdata('logged_id');
        $loggedDisplay = $this->session->userdata('logged_display'); //users full name.
        $this->load->view('amenities/amenity_list', [
            'loggedDisplay' => $loggedDisplay,
            'timeSlotOptions' => timeSlotOptions()
        ]);
    }
    public function ajaxAllAmenityDataTable() {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $amenities = $this->Amenity->getAminity([]);
        $rows = [];
        foreach ($amenities as $k => $amenity) {
            $rows[] = [
                "DT_RowId" => "row_" . $amenity['amenity_id'],
                "amenity_id" => $amenity['amenity_id'],
                'amenity_type' => $amenity['amenity_type']
            ];
        }
        echo json_encode([
            "draw" => $draw,
            "recordsTotal" => count($amenities),
            "recordsFiltered" => count($amenities),
            "data" => $rows
        ]);
    }
    public function ajaxAmenityDetails() {
        $params = [
            'where' => ['amenity_id' => $this->input->post('amenity_id')]
        ];
        $aminity = $this->Amenity->getAmenities($params);
        echo json_encode($aminity[0]);
    }
    public function ajaxAmenityDelete() {
        $where = ['amenity_id' => $this->input->post('amenity_id')];
        $aminity = $this->Amenity->deleteAmenity($where);
        return json_encode(['true']);
    }
    public function ajaxAmenitySubmit() {
        $post = $this->input->post();
        if (isset($post['amenity_id']) && !empty($post['amenity_id'])) {
            $this->Amenity->putAmenity($post);
        } else {
            $this->Amenity->postAmenity($post);
        }
    }
}
