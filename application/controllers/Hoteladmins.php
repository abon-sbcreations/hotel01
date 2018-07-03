<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hoteladmins extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form', 'security');
        $this->load->library('form_validation', 'session');
        $this->load->model('HotelAdmin');
        $validationRules = [
            [
                'field' => 'hotel_userid', 'label' => 'User Name',
                'rules' => 'required',
                'errors' => [
                    'required' => '%s is required'
                ]
            ],
            [
                'field' => 'hotel_passwd', 'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '%s is required.'
                ]
            ]
        ];
        $this->form_validation->set_error_delimiters('<label class="error" >', '</label>');
        $this->form_validation->set_rules($validationRules);
    }

    public function index() {
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('hotelAdmins/loginPage');
        } else {
            if ($this->input->post()) {
              $hotelAdmin = $this->HotelAdmin->getHotelAdmin("hotel_userid", $this->input->post('hotel_userid'));
               $this->session->set_userdata([
                    'hotel_admin_id' => $hotelAdmin[0]['hotel_admin_id'],
                    'hotel_userid' => $hotelAdmin[0]['hotel_userid'],
                    'hotel_name' => $hotelAdmin[0]['hotel_name']
                ]);
                redirect('/index.php/hoteldashboards/admin_area', 'refresh');
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('index.php/hoteladmins', 'refresh');
    }

    public function ajaxCheckUnamePass() {
        if ($this->input->post()) {
            // [password] => wdqwdqwd,
            // [uname] => asdadd
            echo $this->HotelAdmin->checkHotelAdmin($this->input->post());
        }
    }

}
