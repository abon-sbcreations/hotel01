<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboards extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $u1 = $this->session->userdata('logged_id');
         if(!isset($u1)){
            redirect('/index.php/admins', 'refresh');
        }
    }
    public function admin_area(){
        $loggedId = $this->session->userdata('logged_id');
        $loggedDisplay = $this->session->userdata('logged_display');
        $this->load->view('dashboard/admn_dsbrd',['loggedDisplay'=>$loggedDisplay]);
    }
}
