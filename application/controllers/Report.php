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
// asset report
public function asset_report(){ 
    $data['title'] = 'Reports > Reports';
    $data['body'] = 'admin/report/asset-report';
    $data['locations'] = $this->admin_model->get_item_location();
    $data['categories'] = $this->admin_model->get_item_categories();
    $data['breadcrumb'] = array("admin/report/asset-report" => "Assets Reports");
    $this->load->view('admin/commons/new_template', $data);
} 
// Search filters - search Asset
public function filter_asset($offset = null){
if ($this->AccessList()["Assets"]->read == 0) {
    redirect('admin/dashboard');
}

$limit = 25;
if($this->input->get('limit')) {
    $limit = $this->input->get('limit');
}

if(!empty($offset)){
    $config['uri_segment'] = 3;
}

$this->load->library('pagination');
$url = base_url('report/filter_asset');
$rowscount = $this->admin_model->count_assets();

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
$data['results'] = $this->report_model->filter_asset($limit, $offset,$data); 
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
public function filter_supplier($offset = null){
if ($this->AccessList()["Suppliers"]->read == 0) {
    redirect('admin/dashboard');
}

$limit = 25;
if($this->input->get('limit')) {
    $limit = $this->input->get('limit');
}
if(!empty($offset)){
    $config['uri_segment'] = 3;
}

$this->load->library('pagination');
$url = base_url('report/filter_supplier');
$rowscount = $this->admin_model->count_suppliers();

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
$data['results'] = $this->report_model->filter_supplier($limit, $offset,$data);
$data['locations'] = $this->admin_model->list_locations_suppliers();
$data['suppliers_page'] = true;
$data['breadcrumb'] = array("admin/report/filter-suppliers" => "Filter Suppliers", "Search: ");
$this->load->view('admin/commons/new_template', $data);
}

// employee report 
public function employee_report(){
    if ($this->AccessList()["Employees"]->write == 0) {
        redirect('admin/dashboard');
    }
    $data['title'] = 'Employee Report';
    $data['add_page'] = true;
    $data['body'] = 'admin/report/employee-report';   
    $data['locations'] = $this->admin_model->get_item_location();
    $data['departments'] = $this->admin_model->department();
    $data['breadcrumb'] = array("report/employee-report" => "Employee Report");
    $this->load->view('admin/commons/new_template', $data);
}
public function filter_employee($offset = null){

    $limit = 25;
    if($this->input->get('limit')) {
        $limit = $this->input->get('limit');
    }
    if(!empty($offset)){
        $config['uri_segment'] = 3;
    }
    
    $this->load->library('pagination');
    $url = base_url('report/filter_employee');
    $rowscount = $this->admin_model->count_employ();
    
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

    $data = array(
        'user_name' => ucfirst($this->input->get('user_name')),
        'fullname' => ucfirst($this->input->get('full_name')),
        'email' => $this->input->get('email'),
        'phone' => $this->input->get('phone'), 
        'department' =>ucfirst($this->input->get('department')),
        'location' => $this->input->get('location'), 
        'region' => ucfirst($this->input->get('region')), 
        'dob' => $this->input->get('dob'),
        'doj' => $this->input->get('doj')
    );  
    $data['title'] = 'Employ | Admin & Procurement';
    $data['body'] = 'admin/report/filter-employee';
    $data['results'] = $this->report_model->filter_employee($limit, $offset,$data);
    $data['locations'] = $this->admin_model->list_locations_suppliers();
    $data['employees_filter'] = true; 
    $data['breadcrumb'] = array("report/employee-filter" => "Employee Report filter");
    $this->load->view('admin/commons/new_template', $data);
    
} 
// item report
public function item_report(){ 
    if ($this->AccessList()["Register"]->write == 0) {
        redirect('admin/dashboard');
    }
    $data['title'] = 'Item Report';
    $data['item_report'] = true;
    $data['body'] = 'admin/report/item-report';  
    $data['categories'] = $this->admin_model->get_item_categories();
    $data['supplier'] = $this->admin_model->get_item_supplier();
    $data['locations'] = $this->admin_model->get_item_location(); 
    $data['departments'] = $this->admin_model->department(); 
    $data['projects'] = $this->admin_model->project(); 
    $data['status_list'] = $this->admin_model->status_list();  
    $data['breadcrumb'] = array("report/item-report" => "Employee Report filter");
    $this->load->view('admin/commons/new_template', $data);
}
public function filter_item($offset = null){
    if ($this->AccessList()["Register"]->read == 0) {
        redirect('admin/dashboard');
    }
    $limit = 25;
    if($this->input->get('limit')) {
        $limit = $this->input->get('limit');
    }

    if(!empty($offset)){
        $config['uri_segment'] = 3;
    }

    $this->load->library('pagination');
    $url = base_url('report/filter_item');
    $rowscount = $this->admin_model->count_item();
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

$data = array(
    'location' => $this->input->get('location'),
    'department' => $this->input->get('department'),
    'category' => $this->input->get('category'),
    'sub_category' => $this->input->get('sub_category'),
    'project' => $this->input->get('project'),
    'type_name' => $this->input->get('item_name'),
    'status' => $this->input->get('status'),
    'quantity' => $this->input->get('quantity'),
    'model' => $this->input->get('model'),
    'serial_number' => $this->input->get('serial_number'),
    'supplier' => $this->input->get('supplier'),
    'price' => $this->input->get('price'), 
    'purchasedate' => $this->input->get('purchasedate'),
    'depreciation' => $this->input->get('depreciation'),  
); 
$data['title'] = 'Item Report | Admin & Procurement';
$data['body'] = 'admin/report/filter-item';
$data['filter-item'] = true; 
$data['items'] = $this->report_model->filter_item($limit, $offset,$data);
$data['breadcrumb'] = array("Filter Item");
$this->load->view('admin/commons/new_template', $data);
} 
// project_report 
   public function project_report(){
    $data['title'] = 'Project Report';
    $data['body'] = 'admin/report/project-report';
    $data['breadcrumb'] = array("admin/report/project-report" => "Project Report");
    $data['project_report'] = true; 
    $this->load->view('admin/commons/new_template', $data);
} 
// Search filters - search asset register
public function filter_project($offset = null){

    $limit = 25;
    if($this->input->get('limit')) {
        $limit = $this->input->get('limit');
    }

    if(!empty($offset)){
        $config['uri_segment'] = 3;
    }

    $this->load->library('pagination');
    $url = base_url('report/filter_project');
    $rowscount = $this->admin_model->count_projects();

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

    $data = array(
        'project_name' => $this->input->get('project_name'),
        'created_at' => $this->input->get('date'),
    ); 
    $data['title'] = 'Project Report > Project Report';
    $data['body'] = 'admin/report/filter-project';
    $data['breadcrumb'] = array("admin/report/filter_project" => "Filter Project");
    $data['filter_project'] = true; 
    $data['results'] = $this->report_model->filter_project($limit, $offset,$data);
    $this->load->view('admin/commons/new_template', $data);
}
// invoice_report  
       public function invoice_report(){
        $data['title'] = 'Invoice Report';
        $data['body'] = 'admin/report/invoice-report';
        $data['breadcrumb'] = array("admin/report/invoice-report" => "Invoice Report");
        $data['add_invoice'] = true; 
        $data['projects'] = $this->admin_model->inoice_project();
        $data['suppliers'] = $this->admin_model->suppliers();
        $data['locations'] = $this->login_model->get_locations();
        $this->load->view('admin/commons/new_template', $data);
    }
    
    // Invoices - Add invoice into the database.
    public function filter_invoice($offset = null){ 
        
        $limit = 25;
        if($this->input->get('limit')) {
            $limit = $this->input->get('limit');
        }
        if(!empty($offset)){
            $config['uri_segment'] = 3;
        }
        $this->load->library('pagination');
        $url = base_url('report/filter_invoice');
        $rowscount = $this->admin_model->count_invoices();

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

        $data = array(
            'inv_no' => $this->input->get('inv_no'),
            'inv_date' => $this->input->get('inv_date'),
            'project' => $this->input->get('project'),
            'supplier' => $this->input->get('supplier'),
            'region' => $this->input->get('region'),
            'item' => $this->input->get('item_name'),
            'amount' => $this->input->get('amount'), 
        );
    $data['title'] = 'Invoice Report > Invoice Report';
    $data['body'] = 'admin/report/filter-invoice';
    $data['breadcrumb'] = array("admin/report/filter-invoice" => "Filter Invoice");
    $data['filter_invoice'] = true; 
    $data['results'] = $this->report_model->filter_invoice($limit, $offset,$data);
    $this->load->view('admin/commons/new_template', $data);        
    }
     // 404 page.
    public function page_not_found(){
        echo "We're sorry but the page you're looking for could not be found.";
    }
}
