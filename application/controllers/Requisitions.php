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
}