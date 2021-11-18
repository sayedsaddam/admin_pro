<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Report extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('admin_model');
        $this->load->model('report_model');
        $this->load->model('user_model');
        $this->load->model('supervisor_model');
        $this->load->helper('paginate');
        if(!$this->session->userdata('username')){
            redirect('');
        }
        $this->access['AssetsAccess'] = $this->AccessList()["Assets"];
        $this->access['SuppliersAccess'] = $this->AccessList()["Suppliers"];
        $this->access['EmployeesAccess'] = $this->AccessList()["Employees"];
        $this->access['CategoriesAccess'] = $this->AccessList()["Categories"];
        $this->access['RegisterAccess'] = $this->AccessList()["Register"];
    }
    public function AccessList() {
        $user_role = $this->session->userdata('user_role');
        $userAccess = $this->admin_model->request_db_configs($user_role);
        return $arrayName = array('Assets' => $userAccess[0], 'Suppliers' => $userAccess[1], 'Employees' => $userAccess[2], 'Categories' => $userAccess[3], 'Register' => $userAccess[4]);
    } 

// all reports code below
public function asset_report(){ 
    $data['title'] = 'Reports > Reports';
    $data['body'] = 'admin/report/asset-report';
    $data['locations'] = $this->admin_model->get_item_location();
    $data['categories'] = $this->admin_model->get_item_categories();
    $data['breadcrumb'] = array("admin/report/asset-report" => "Assets Reports");
    $this->load->view('admin/commons/new_template', $data);
} 
// Search filters - search Asset
public function filter_asset(){
if ($this->AccessList()["Assets"]->read == 0) {
    redirect('admin/dashboard');
}
$data = array(
    'category' => $this->input->get('category'),
    'sub_categories' => $this->input->get('sub_categories'),
    'quantity' => $this->input->get('quantity'),
    'price' => $this->input->get('price'),
    'purchase_date' => $this->input->get('purchase_date'),
    'location' => $this->input->get('location')
); 
//  print_r($data['category']);exit;
$data['title'] = 'Search Results > Assets';
$data['body'] = 'admin/report/filter-asset';
$data['results'] = $this->report_model->filter_asset($data); 
$data['filter_asset'] = true;
$data['breadcrumb'] = array("admin/report/report-list" => "Asets Reports List");
$this->load->view('admin/commons/new_template', $data);
}  
//Suppliers Report- report.
public function supplier_report(){
if ($this->AccessList()["Suppliers"]->write == 0) {
    redirect('admin/dashboard');
}
$data['title'] = 'Supplier Report| Admin & Procurement';
$data['body'] = 'admin/report/supplier-report';
$data['locations'] = $this->admin_model->list_locations_suppliers();
$data['categories'] = $this->admin_model->suppliers_category();
$data['add_supplier_page'] = true;
$data['breadcrumb'] = array("admin/report/supplier-report" => "Supplier Reports");
$this->load->view('admin/commons/new_template', $data);
} 
// filters - search suppliers
public function filter_supplier(){
if ($this->AccessList()["Suppliers"]->read == 0) {
    redirect('admin/dashboard');
}
$data = array(
    'name' => $this->input->get('name'),
    'category' => $this->input->get('category'),
    'email' => $this->input->get('email'),
    'phone' => $this->input->get('phone'),
    'location' => $this->input->get('location'), 
    'ntn_number' => $this->input->get('ntn_number'),
    'rating' => $this->input->get('rating')
);
$data['title'] = 'Search Results > Filter Suppliers';
$data['body'] = 'admin/report/filter-supplier';
$data['results'] = $this->report_model->filter_supplier($data);
$data['locations'] = $this->admin_model->list_locations_suppliers();
$data['suppliers_page'] = true;
$data['breadcrumb'] = array("admin/report/filter-suppliers" => "Filter Suppliers", "Search: ");
$this->load->view('admin/commons/new_template', $data);
}
     // 404 page.
    public function page_not_found(){
        echo "We're sorry but the page you're looking for could not be found.";
    }
}
