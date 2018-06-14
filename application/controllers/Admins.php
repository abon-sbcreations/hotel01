<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form', 'security');
        $this->load->library('form_validation','session');
        $this->load->model('Admin');
        $validationRules = [[
            'field' => 'uname',            'label' => 'User Name',
            'rules' => 'required',
            'errors' => [
                'required' => '%s is required'
                ]
            ],
            [
                'field' => 'password',                'label' => 'Password',
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
        if ($this->form_validation->run() == FALSE){
            $this->load->view('admins/loginPage');
        }else{
            if($this->input->post()){
                $user = $this->Admin->getAdmin("admin_username",$this->input->post('uname'));
                $this->session->set_userdata([
                    'logged_name' => $user[0]['admin_username'],
                    'logged_id' =>$user[0]['admin_id'],
                    'logged_display'=>$user[0]['admin_display_name']
                ]);
                redirect('/index.php/dashboards/admin_area', 'refresh');
            }
        }
    }
    public function logout(){
        $this->session->unset_userdata(['logged_name','logged_id','logged_display']);
        redirect('index.php/admins/index', 'refresh');
    }

    public function ajaxCheckUnamePass(){
        if($this->input->post()){
           
            //[password] => wdqwdqwd
    //[uname] => asdadd
            echo $this->Admin->checkAdmin($this->input->post());
        }
    }
}
