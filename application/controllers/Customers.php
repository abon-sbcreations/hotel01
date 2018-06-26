<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form', 'security');
        $this->load->helper('commonmisc_helper');
        $this->load->library('form_validation', 'session');
        $this->load->model('Customer');
        $u1 = $this->session->userdata('logged_id');
        if (!isset($u1)) {
            redirect('/index.php/admins', 'refresh');
        }
    }
    public function index() {
        $loggedId = $this->session->userdata('logged_id');
        $loggedDisplay = $this->session->userdata('logged_display');
        $this->load->view('customers/customers_list', [
            'loggedDisplay' => $loggedDisplay,
            'hotelOptions' =>hotelOptions(),
            'membershipOptions' => membershipOptions()
        ]);
    }
    public function ajaxAllCustomersMasterDataTable() {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $Customers = $this->Customer->getCustomer([]);
        $rows = [];
        foreach ($Customers as $k => $customer) {
            $rows[] = [
                "DT_RowId" => "row_" . $customer['cust_id'],
                "cust_id" => $customer['cust_id'],
                'cust_name'=>$customer['cust_name'],
                'hotel_name' => $customer['hotel_name'],
                'cust_name' => $customer['cust_name'],
                'cust_status' => $customer['cust_status'],
                'membership_type' => $customer['cust_status'] == 'Member' ? $customer['membership_type'] : "N/A"
            ];
        }
        echo json_encode([
            "draw" => $draw,
            "recordsTotal" => count($Customers),
            "recordsFiltered" => count($Customers),
            "data" => $rows
        ]);
    }

    public function ajaxCustomerMasterDetails() {
        $params = [
            'where' => ['cust_id' => $this->input->post('cust_id')]
        ];
        $customer = $this->Customer->getCustomer($params);
        echo json_encode($customer[0]);
    }

    public function ajaxCustomerMasterDelete() {
        $where = ['cust_id' => $this->input->post('cust_id')];
        $comp = $this->Customer->deleteCustomer($where);
        return json_encode(['true']);
    }

    public function ajaxCompaniesMasterSubmit() {
        $post = $this->input->post();
        if (isset($post['cust_id']) && !empty($post['cust_id'])) {
            $this->Customer->putCustomer($post);
        } else {
            $this->Customer->postCustomer($post);
        }
    }

}
