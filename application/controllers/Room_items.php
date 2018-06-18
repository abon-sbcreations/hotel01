<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Room_items extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('commonmisc_helper');
        $this->load->model('Room_item_master');
        $u1 = $this->session->userdata('logged_id');
        if (!isset($u1)) {
            redirect('/index.php/admins', 'refresh');
        }
    }

    public function master() {
        $loggedId = $this->session->userdata('logged_id');
        $loggedDisplay = $this->session->userdata('logged_display'); //users full name.
        $this->load->view('room_items/master', [
            'loggedDisplay' => $loggedDisplay,
            'timeSlotOptions' => timeSlotOptions()
        ]);
    }

}
