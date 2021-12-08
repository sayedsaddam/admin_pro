<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Requisitions extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Requisition_Model');
        $this->load->model('API_Model');

        $this->access['AssetsAccess'] = $this->AccessList()["Assets"];
        $this->access['SuppliersAccess'] = $this->AccessList()["Suppliers"];
        $this->access['EmployeesAccess'] = $this->AccessList()["Employees"];
        $this->access['CategoriesAccess'] = $this->AccessList()["Categories"];
        $this->access['RegisterAccess'] = $this->AccessList()["Register"];
    }

    private function AccessList() {
        $user_role = $this->session->userdata('user_role');
        $userAccess = $this->API_Model->FetchAccessConfigs($user_role);
        return $arrayName = array('Assets' => $userAccess[0], 'Suppliers' => $userAccess[1], 'Employees' => $userAccess[2], 'Categories' => $userAccess[3], 'Register' => $userAccess[4]);
    }

    public function index(){
        redirect('requisitions/dashboard');
    }

    public function dashboard() {
        $data['title'] = 'Home | Requisitions';
        $data['body'] = 'requisitions/dashboard';
        
        $data['breadcrumb'] = array("Dashboard");
        
        $this->load->view('requisitions/commons/new_template', $data);
    }

    
    public function add_request() {
        $url = 'requisitions/add_request';
        
        $data['locations'] = $this->API_Model->FetchLocations();
        $data['departments'] = $this->API_Model->FetchDepartments();
        $data['companies'] = $this->API_Model->FetchCompanies();

        $data['title'] = 'Add Request | Requisitions';
        $data['body'] = 'requisitions/requests/add_request';
        $data['breadcrumb'] = array("Add Request");

        $data['addRequestPage'] = true;

        $this->load->view('admin/commons/new_template', $data);
    }

    public function save_request() {
        $user = $this->session->userdata('id');

        $countParticular = count($this->input->post('particular'));
        $countQuantity = count($this->input->post('quantity'));

        if ($countParticular != $countQuantity) {
            $this->session->set_flashdata('failed', '<strong class="mr-1">Failed.</strong>Particular Count & Item Count do not match!');
            redirect('requisitions/add_request');
            return false;
        }

        for ($i = 0; $i < $countParticular; $i++) {
            if ($this->input->post('particular')[$i] && $this->input->post('quantity')[$i] != NULL) {
                
                $data = new stdClass();
                $data->item_name = $this->input->post('particular')[$i];
                $data->item_desc = $this->input->post('reason');
                $data->item_qty = $this->input->post('quantity')[$i];

                $this->Requisition_Model->AddRequest($data, $this->session->userdata('id'));
            }
        }
        
        $this->session->set_flashdata('success', '<strong class="mr-1">Success.</strong>Items were added successfully!');
        redirect('requisitions/request_list');
    }
}