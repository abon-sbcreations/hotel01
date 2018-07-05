<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('form', 'security');
        $this->load->library('session');
        $this->load->model('Admin');
    }

    public function index() {        
        if ($this->input->post()) {
            $user = $this->Admin->getAdmin("admin_username", $this->input->post('uname'));
           if ($user[0]['admin_type'] == "Hotel") {
                $this->session->set_userdata([
                    'hotel_admin_id' => $user[0]['hotel_admin_id'],
                    'hotel_userid' => $user[0]['admin_username'],
                    'hotel_name' => $user[0]['hotel_name'],
                    'hotel_id' => $user[0]['hotel_id']
                ]);
                redirect('/index.php/hoteldashboards/admin_area', 'refresh');
            } else {
                $this->session->set_userdata([
                    'logged_name' => $user[0]['admin_username'],
                    'logged_id' => $user[0]['admin_id'],
                    'logged_display' => $user[0]['admin_display_name']
                ]);
                redirect('/index.php/dashboards/admin_area', 'refresh');
            }
        } else {
            $this->load->view('admins/loginPage');
        }
    }

    public function logout() {
        $this->session->unset_userdata(['logged_name', 'logged_id', 'logged_display']);
        redirect('index.php/admins/index', 'refresh');
    }

    public function ajaxCheckUnamePass() {
        if ($this->input->post()) {
            // [password] => wdqwdqwd,
            // [uname] => asdadd
            echo $this->Admin->checkAdmin($this->input->post());
        }
    }

}
