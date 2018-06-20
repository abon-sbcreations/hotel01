<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Companies extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('form', 'security');
        $this->load->helper('commonmisc_helper');
        $this->load->library('form_validation','session');
        $this->load->model('Company');
        $u1 = $this->session->userdata('logged_id');
        if (!isset($u1)) {
            redirect('/index.php/admins', 'refresh');
        }
    }
    public function index() {
        $loggedId = $this->session->userdata('logged_id');
        $loggedDisplay = $this->session->userdata('logged_display'); 
        $this->load->view('companies/company_list', [
            'loggedDisplay' => $loggedDisplay,
            'timeSlotOptions' => timeSlotOptions()
        ]);
    }
    public function ajaxAllCompaniesMasterDataTable(){
         // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $companies = $this->Company->getCompany([]);
        $rows = [];
        foreach ($companies as $k => $company) {
            $rows[] = [
                "DT_RowId" => "row_" . $company['comp_id'],
                "comp_id" => $company['comp_id'],
                'comp_name' => $company['comp_name'],
                'comp_reg_no' => $company['comp_reg_no']
            ];
        }
        echo json_encode([
            "draw" => $draw,
            "recordsTotal" => count($companies),
            "recordsFiltered" => count($companies),
            "data" => $rows
        ]);
    }
    public function ajaxCompanyMasterDetails(){
         $params = [
            'where' => ['comp_id' => $this->input->post('comp_id')]
        ];       
        $company = $this->Company->getCompany($params);
        echo json_encode($company[0]);
    }
    public function ajaxCompanyMasterDelete(){
        $where = ['comp_id' => $this->input->post('comp_id')];
        $comp = $this->Company->deleteCompany($where);        
        return json_encode(['true']);
    }
    public function ajaxCompaniesMasterSubmit(){
        $post = $this->input->post();
        if (isset($post['comp_id']) && !empty($post['comp_id'])) {
            $this->Company->putCompany($post);
        } else {
            $this->Company->postCompany($post);
        }
    }
}
