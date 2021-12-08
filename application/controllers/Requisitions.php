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
        $data['breadcrumb'] = array("requisitions/request_list" => "Request List", "Add Request");

        $data['addRequestPage'] = true;

        $this->load->view('requisitions/commons/new_template', $data);
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

    // Reuest list 
    public function request_list($offset = null){ 
        $limit = 25;
        if($this->input->get('limit')) {
            $limit = $this->input->get('limit');
        }

        if(!empty($offset)){
            $config['uri_segment'] = 3;
        }
    
        $this->load->library('pagination');
        $url = base_url('requisitions/request_list');
        $rowscount = $this->API_Model->CountRequest();

        $config['base_url'] = $url;
        $config['total_rows'] = $rowscount;
        $config['per_page'] = $limit;
        $config['cur_tag_open'] = '<a class="pagination-link has-background-success has-text-white" aria-current="page">';
        $config['cur_tag_close'] = '</a>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_open'] = '</li>';
        $config['first_link'] = 'First';
        $config['prev_link'] = 'Previous';
        $config['next_link'] = 'Next';
        $config['last_link'] = 'Last';
        $config['attributes'] = array('class' => 'pagination-link');
        $config['reuse_query_string'] = true;
        $this->pagination->initialize($config);
               
        $data['title'] = 'Request List | Admin & Procurement';
        $data['body'] = 'requisitions/requests/request_list';
        $data['requests'] = $this->Requisition_Model->RequestList($limit, $offset);
        $data['request_list'] = true;
        $data['breadcrumb'] = array("Request List");
        $this->load->view('requisitions/commons/new_template', $data);

    } 
  // Search filters - search asset register
  public function search_request(){ 

    $search = $this->input->get('search'); 
    $data['title'] = 'Search Results > Request List';
    $data['body'] = 'requisitions/requests/request_list';
    $data['breadcrumb'] = array("requests/request_list" => "Request List", "Search: " . $search);
    $data['request_list'] = true;
    $data['results'] = $this->Requisition_Model->SearchRequest($search);
    $this->load->view('requisitions/commons/new_template', $data);
}


}