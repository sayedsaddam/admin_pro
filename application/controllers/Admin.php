<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Admin extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('admin_model');
        $this->load->model('user_model');
        $this->load->model('supervisor_model');
        $this->load->helper('paginate');
        if(!$this->session->userdata('username') || $this->session->userdata('user_role') != 'admin'){
            redirect('');
        }
    }
    // Load the dashboard.
    public function index($offset = null){
       
        $limit = 10;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $data['title'] = 'Home | Admin & Procurement';
        $data['body'] = 'admin/dashboard';
        $data['total_isbd'] = $this->admin_model->expenses_isbd();
        $data['ctc_own_isbd'] = $this->admin_model->ctc_own_isbd();
        $data['total_bln'] = $this->admin_model->expenses_bln();
        $data['ctc_own_bln'] = $this->admin_model->ctc_own_bln();
        $data['total_kp'] = $this->admin_model->expenses_kp();
        $data['ctc_own_kp'] = $this->admin_model->ctc_own_kp();
        $data['total_sindh'] = $this->admin_model->expenses_sindh();
        $data['ctc_own_sindh'] = $this->admin_model->ctc_own_sindh();
        $data['total_punjab'] = $this->admin_model->expenses_punjab();
        $data['ctc_own_punjab'] = $this->admin_model->ctc_own_punjab();
        $data['pending'] = $this->admin_model->total_pending();
        $data['approved'] = $this->admin_model->total_approved();
        $data['rejected'] = $this->admin_model->total_rejected();
        $data['pending_requisitions'] = $this->admin_model->pending_requisitions($limit, $offset);
        $data['approved_requisitions'] = $this->admin_model->approved_requisitions($limit, $offset);
        $data['rejected_requisitions'] = $this->admin_model->rejected_requisitions($limit, $offset);
        $data['isbd_stats'] = $this->admin_model->overall_stats_isbd();
        $data['bln_stats'] = $this->admin_model->overall_stats_bln();
        $data['khyber_stats'] = $this->admin_model->overall_stats_khyber();
        $data['sindh_stats'] = $this->admin_model->overall_stats_sindh();
        $data['annual_expense'] = $this->admin_model->annual_expenses();
        $this->load->view('admin/commons/template', $data);
    }
    // Pending requests - listing
    public function pending_requests($offset = null){
        $limit = 10;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $url = 'admin/pending_requests';
        $rowscount = $this->admin_model->total_pending();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Pending Requests | Admin & Procurement';
        $data['body'] = 'admin/pending-requests';
        $data['pending_requisitions'] = $this->admin_model->pending_requisitions($limit, $offset);
        $this->load->view('admin/commons/template', $data);
    }
    // Approved requests - listing
    public function approved_requests($offset = null){
        $limit = 10;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $url = 'admin/approved_requests';
        $rowscount = $this->admin_model->total_approved();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Approved Requests | Admin & Procurement';
        $data['body'] = 'admin/approved-requests';
        $data['approved_requisitions'] = $this->admin_model->approved_requisitions($limit, $offset);
        $this->load->view('admin/commons/template', $data);
    }
    // Rejected requests - listing
    public function rejected_requests($offset = null){
        $limit = 10;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $url = 'admin/rejected_requests';
        $rowscount = $this->admin_model->total_rejected();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Rejected Requests | Admin & Procurement';
        $data['body'] = 'admin/rejected-requests';
        $data['rejected_requisitions'] = $this->admin_model->rejected_requisitions($limit, $offset);
        $this->load->view('admin/commons/template', $data);
    }
    // Request detail - Filter by ID.
    public function request_detail($id){
        if(!$this->session->userdata('username')){
            redirect('');
        }
        $data['title'] = 'Request Detail | Admin & Procurement';
        $data['body'] = 'admin/request_detail';
        $data['request_detail'] = $this->admin_model->request_detail($id);
        $this->load->view('admin/commons/template', $data);
    }
    // Approve request.
    public function approve_request($id){
        if(!$this->session->userdata('username')){
            redirect('');
        }
        $data = array(
            'status' => 1,
            'updated_at' => date('Y-m-d')
        );
        if($this->admin_model->approve_request($id, $data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Request approval was successful.');
            redirect('admin');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong in request approval. Please try again.');
            redirect('admin/request_detail/'.$id);
        }
    }
    // Reject request.
    public function reject_request($id){
        if(!$this->session->userdata('username')){
            redirect('');
        }
        $data = array(
            'status' => 2,
            'updated_at' => date('Y-m-d')
        );
        if($this->admin_model->approve_request($id, $data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Request rejection was successful.');
            redirect('admin');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong in request rejection. Please try again.');
            redirect('admin/request_detail/'.$id);
        }
    }
    // Suppliers - Go to suppliers page.
    public function suppliers($offset = null){
        $limit = 10;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $url = 'admin/suppliers/suppliers';
        $rowscount = $this->admin_model->count_suppliers();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Suppliers | Admin & Procurement';
        $data['body'] = 'admin/suppliers/suppliers';
        $data['suppliers'] = $this->admin_model->get_suppliers($limit, $offset);
        $data['locations'] = $this->admin_model->list_locations_suppliers();
        $this->load->view('admin/commons/template', $data);
    }
    // Suppliers - Add new supplier
    public function add_supplier(){ 
        $data = array(
            'name' => $this->input->post('name'), 
            'category' => implode(", ", $this->input->post('category')),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'location' => $this->input->post('location'),
            'region' => $this->input->post('region'),
            'ntn_number' => $this->input->post('ntn_number'),
            'rating' => $this->input->post('rating'),
            'address' => ucfirst($this->input->post('address'))
        ); 
        if($this->admin_model->add_supplier($data)){
            $this->session->set_flashdata('success', '<strong>Success! /strong>Supplier added successfully.');
            redirect('admin/suppliers');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect('admin/suppliers');
        }
    }
    // Suppliers - Remove supplier
    public function delete_supplier($id){
        if($this->admin_model->delete_supplier($id)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Supplier removal was successful.');
            redirect('admin/suppliers');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect('admin/suppliers');
        }
    }
    // Get single supplier by id
    public function edit_supplier($id){ 
        $supplier = $this->admin_model->edit_supplier($id);
        echo json_encode($supplier);
    }
    // Update supplier
    public function update_supplier(){
        $id = $this->input->post('sup_id');
        $data = array(
            'name' => $this->input->post('name'),
            'category' => implode(", ", $this->input->post('category')),    
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'location' => $this->input->post('location'),
            'ntn_number' => $this->input->post('ntn_number'),
            'rating' => $this->input->post('rating'),
            'region' => $this->input->post('region'),
            'address' => $this->input->post('address')
        );
        if($this->admin_model->update_supplier($id, $data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Supplier update was successful.');
            redirect('admin/suppliers');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect('admin/suppliers');
        }
    }
    // Employ - Go to employ page.
    public function employ($offset = null){
        $limit = 10;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $url = 'admin/employ/employ';
        $rowscount = $this->admin_model->count_employ();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Employ | Admin & Procurement';
        $data['body'] = 'admin/employ/employ';
        $data['employ'] = $this->admin_model->get_employ($limit, $offset);
        $data['locations'] = $this->admin_model->list_locations_suppliers();
        $this->load->view('admin/commons/template', $data);
    } 

    // Suppliers - Add new supplier
    public function add_employ(){ 
        $data = array(
            'name' => $this->input->post('name'), 
            'department' => implode(", ", $this->input->post('department')),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'location' => $this->input->post('location'),
            'region' => $this->input->post('region'), 
            'status' => 1, 
            'address' => ucfirst($this->input->post('address'))
        ); 
        if($this->admin_model->add_employ($data)){
            $this->session->set_flashdata('success', '<strong>Success! /strong>Employ added successfully.');
            redirect('admin/employ');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect('admin/employ');
        }
    }
    // Get single employ by id
    public function edit_employ($id){ 
        $employ = $this->admin_model->edit_employ($id);
        echo json_encode($employ);
    }
    // Update employ
    public function update_employ(){
        $id = $this->input->post('sup_id');
        $data = array(
            'name' => $this->input->post('name'),
            'department' => implode(", ", $this->input->post('department')),    
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'location' => $this->input->post('location'), 
            'region' => $this->input->post('region'),
            'address' => $this->input->post('address')
        );
        if($this->admin_model->update_employ($id, $data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Employ update was successful.');
            redirect('admin/employ');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect('admin/employ');
        }
    }
    // Employ - Remove employ
    public function delete_employ($id){
        if($this->admin_model->delete_employ($id)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Employ removal was successful.');
            redirect('admin/employ');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect('admin/employ');
        }
    }
    // Inventory - Go to inventory page.
    public function inventory($offset = null){
        $limit = 10;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $url = 'admin/inventory';
        $rowscount = $this->admin_model->count_inventory();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Inventory | Admin & Procurement';
        $data['body'] = 'admin/inventory';
        $data['locations'] = $this->login_model->get_locations();
        $data['categories'] = $this->admin_model->get_categories();
        $data['inventory'] = $this->admin_model->get_inventory($limit, $offset);
        $this->load->view('admin/commons/template', $data);
    } 
    // Inventory - Go to assign inventory page.
    public function assign_inventory($offset = null){
        $limit = 10;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $url = 'admin/inventory';
        $rowscount = $this->admin_model->count_inventory();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Inventory | Admin & Procurement';
        $data['body'] = 'admin/assign_inventory';
        $data['locations'] = $this->login_model->get_locations();
        $data['categories'] = $this->admin_model->get_categories();
        $data['assign_inventory'] = $this->admin_model->get_assign_inventory($limit, $offset);
        $this->load->view('admin/commons/template', $data);
    }
    
    // Get all sub categories based on cat_id
    public function get_sub_categories($cat_id){
        $sub_categories = $this->admin_model->get_sub_categories($cat_id);
        echo json_encode($sub_categories);
    }
    // Inventory - Add inventory.
    public function add_inventory(){
        $data = array(
            'location' => $this->input->post('location'),
            'category' => $this->input->post('category'),
            'name' => $this->input->post('item_name'),
            'item_qty' => $this->input->post('item_qty'),
            'unit_price' => $this->input->post('unit_price'),
            'item_desc' => $this->input->post('item_desc')
        );
        if($this->admin_model->add_inventory($data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Inventory was added successfully');
            redirect('admin/inventory');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again.');
            redirect('admin/inventory');
        }
    }
    // Invnetory - Edit inventory
    public function edit_inventory($id){
        $inventory = $this->admin_model->edit_inventory($id);
        echo json_encode($inventory);
    }
    // Inventory - update inventory info
    public function update_inventory(){
        $id = $this->input->post('id');
        $data = array(
            'location' => $this->input->post('location'),
            'category' => $this->input->post('category'),
            'name' => $this->input->post('item_name'),
            'item_qty' => $this->input->post('item_qty'),
            'unit_price' => $this->input->post('unit_price'),
            'item_desc' => $this->input->post('item_desc')
        );
        if($this->admin_model->update_inventory($id, $data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Inventory was updated successfully');
            redirect('admin/inventory');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again.');
            redirect('admin/inventory');
        }
    }
    // Inventory - Remove inventory
    public function delete_inventory($id){
        if($this->admin_model->delete_inventory($id)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Inventory removal was successful.');
            redirect('admin/inventory');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect('admin/inventory');
        }
    }
    // Users - Go to users page where the users will be listed.
    public function users($offset = null){
        $limit = 10;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $url = 'admin/users';
        $rowscount = $this->admin_model->count_users();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Users | Admin & Procurement';
        $data['body'] = 'admin/users';
        $data['users'] = $this->admin_model->get_users($limit, $offset);
        $this->load->view('admin/commons/template', $data);
    }
    // Users - Remove user.
    public function delete_user($id){
        if($this->admin_model->delete_user($id)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>User removal was successful.');
            redirect('admin/users');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect('admin/users');
        }
    }
    // Invoices - Go to the invoices list page.
    public function invoices($offset = null){
        $limit = 10;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $url = 'admin/invoices';
        $rowscount = $this->admin_model->count_invoices();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Invoices | Admin & Procurement';
        $data['body'] = 'admin/invoices';
        $data['suppliers'] = $this->admin_model->get_suppliers_for_invoice();
        $data['invoices'] = $this->admin_model->get_invoices($limit, $offset);
        $data['projects'] = $this->admin_model->get_projects();
        $data['locations'] = $this->login_model->get_locations();
        $this->load->view('admin/commons/template', $data);
    }
    // Invoices - Add invoice into the database.
    public function add_invoice(){
        $data = array(
            'inv_no' => $this->input->post('inv_no'),
            'inv_date' => date('Y-m-d', strtotime($this->input->post('inv_date'))),
            'project' => $this->input->post('project'),
            'vendor' => $this->input->post('vendor_name'),
            'region' => $this->input->post('region'),
            'item' => $this->input->post('item_name'),
            'amount' => $this->input->post('amount'),
            'inv_desc' => $this->input->post('inv_desc')
        );
        if($this->admin_model->add_invoice($data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Adding invoice was successful.');
            redirect('admin/invoices');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again.');
            redirect('admin/invoices');
        }
    }
    // Invoices - print invoice
    public function print_invoice($id){
        $data['title'] = 'Print Invoice | Admin & Procurement';
        $data['body'] = 'admin/print_invoice';
        $data['invoice'] = $this->admin_model->print_invoice($id);
        $this->load->view('admin/commons/template', $data);
    }
    // Invoices - Remove invoices
    public function delete_invoice($id){
        if($this->admin_model->delete_invoice($id)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Invoice removal was successful.');
            redirect('admin/invoices');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect('admin/invoices');
        }
    }
    // Invoices - Changes invoice status to cleared
    public function invoice_status($id){
        $data = array(
            'status' => 1
        );
        if($this->admin_model->update_status($id, $data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Invoice status change was successful.');
            redirect('admin/invoices');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again.');
            redirect('admin/invoices');
        }
    }
    // Projects - Go to projects page.
    public function projects(){
        $data['title'] = 'Projects | Admin & Procurement';
        $data['body'] = 'admin/projects';
        $data['projects'] = $this->admin_model->get_projects();
        $this->load->view('admin/commons/template', $data);
    }
    // Projects - Add new project
    public function add_project(){
        $data = array(
            'project_name' => $this->input->post('project_name'),
            'project_desc' => $this->input->post('project_desc')
        );
        if($this->admin_model->add_project($data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Project was added successfully.');
            redirect('admin/projects');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again.');
            redirect('admin/projects');
        }
    }
    // Projects - edit project
    public function edit_project($id){
        $project = $this->admin_model->edit_project($id);
        echo json_encode($project);
    }
    // Projects - update project
    public function update_project(){
        $id = $this->input->post('project_id');
        $data = array(
            'project_name' => $this->input->post('project_name'),
            'project_desc' => $this->input->post('project_desc')
        );
        if($this->admin_model->update_project($id, $data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Project update was successful.');
            redirect('admin/projects');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect('admin/projects');
        }
    }
    // Projects - Remove project
    public function delete_project($id){
        if($this->admin_model->delete_project()($id)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Project removal was successful.');
            redirect('admin/projects');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect('admin/projects');
        }
    }
    // Maintenance - Office equipments
    public function maintenance($offset = null){
        $limit = 10;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $url = 'admin/maintenance';
        $rowscount = $this->admin_model->count_maint_record();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Maintenance | Admin & Procurement';
        $data['body'] = 'admin/maintenance';
        $data['maintenance_items'] = $this->admin_model->get_maint_record($limit, $offset);
        $data['locations'] = $this->login_model->get_locations();
        $this->load->view('admin/commons/template', $data);
    }
    // Maintenance - Add new record
    public function add_maintenance(){
        $data = array(
            'region' => $this->input->post('maint_region'),
            'maint_date' => $this->input->post('maint_date'),
            'maint_cat' => $this->input->post('maint_cat'),
            'maint_desc' => $this->input->post('maint_desc'),
            'vendor' => $this->input->post('vendor'),
            'qty_size' => $this->input->post('qty_size'),
            'unit_price' => $this->input->post('unit_price'),
            'total_amount' => $this->input->post('total_amount'),
            'maint_remarks' => $this->input->post('remarks')
        );
        if($this->admin_model->add_maint_record($data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Maintenance record was added successfully.');
            redirect('admin/maintenance');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect('admin/maintenance');
        }
    }
    // Maintenance - Delete a record
    public function delete_record($id){
        if($this->admin_model->delete_record($id)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Record removal was successful.');
            redirect('admin/maintenace');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect('admin/maintenance');
        }
    }
    // Asset register
    public function asset_register($offset = null){
        $limit = 15;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $url = 'admin/asset_register';
        $rowscount = $this->admin_model->count_assets();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Asset Register | Admin & Procurement';
        $data['body'] = 'admin/asset-register';
        $data['assets'] = $this->admin_model->get_assets($limit, $offset);
        $this->load->view('admin/commons/template', $data);
    }
    // Asset register - add new item.
    public function add_asset(){
        $data['title'] = 'Asset Detail';
        $data['body'] = 'admin/asset-detail';
        $this->load->view('admin/commons/template', $data);
    }
    // Asset detail
    public function asset_detail($id){  
        $data['title'] = 'Asset Detail';
        $data['body'] = 'admin/asset-detail';
        $data['edit'] = $this->admin_model->asset_detail($id);
        $this->load->view('admin/commons/template', $data);
    }
    // Add new asset into the database
    public function save_item(){
        $data = array(
            'purchase_date' => $this->input->post('purchase_date'), 
            'category' => $this->input->post('category'), 
            'description' => $this->input->post('description'),
            'quantity' => $this->input->post('quantity'),
            'location' => $this->input->post('location'),
            'designation' => $this->input->post('designation'),
            'user' => $this->input->post('user'),
            'remarks' => $this->input->post('remarks'),
            'giveaway' => $this->input->post('giveaway'), 
            'created_at' => date('Y-m-d')
        );
        if($this->admin_model->add_item($data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Item was added successfully.');
            redirect('admin/asset_register');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again later.');
            redirect('admin/asset_register');
        }
    }
    // Update an existing asset record
    public function update_item(){
        $id = $this->input->post('id');
        $data = array(
            'purchase_date' => $this->input->post('purchase_date'), 
            'category' => $this->input->post('category'), 
            'description' => $this->input->post('description'),
            'quantity' => $this->input->post('quantity'),
            'location' => $this->input->post('location'),
            'designation' => $this->input->post('designation'),
            'user' => $this->input->post('user'),
            'remarks' => $this->input->post('remarks'),
            'giveaway' => $this->input->post('giveaway'), 
            'created_at' => date('Y-m-d')
        );
        if($this->admin_model->update_item($id, $data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Item was updated successfully.');
            redirect('admin/asset_register');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again.');
            redirect('admin/asset_register');
        }
    }
    // Delete asset
    public function delete_asset($id){
        if($this->admin_model->delete_asset($id)){
            $this->session->set_flashdata('success', '<strong>Delete! </strong>Item was deleted successfully.');
            redirect('admin/asset_register');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect('admin/asset_register');
        }
    }
    // Contact list - Master contact list
    public function contact_list($offset = null){
        $limit = 15;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $url = 'admin/contact_list';
        $rowscount = $this->admin_model->count_contacts();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Contact List | Admin & Procurement';
        $data['body'] = 'admin/contact_list';
        $data['contacts'] = $this->admin_model->get_contacts($limit, $offset);
        $this->load->view('admin/commons/template', $data);
    }
    // Contact list - Load, view or edit contact.
    public function add_contact(){
        $data['title'] = 'Contact List | Admin & Procurement';
        $data['body'] = 'admin/add_contact';
        $this->load->view('admin/commons/template', $data);
    }
    // Contact list - Save new contact.
    public function save_contact(){
        $data = array(
            'name' => $this->input->post('name'),
            'designation' => $this->input->post('designation'),
            'project' => $this->input->post('project'),
            'district' => $this->input->post('district'),
            'province' => $this->input->post('province'),
            'gender' => $this->input->post('gender'),
            'cnic' => $this->input->post('cnic'),
            'personal_contact' => $this->input->post('personal_contact'),
            'official_contact' => $this->input->post('official_contact'),
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
            'grader' => $this->input->post('grader'),
            'supervisor' => $this->input->post('supervisor'),
            'dob' => $this->input->post('dob'),
            'doj' => $this->input->post('doj')
        );
        if($this->admin_model->add_contact($data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Contact information was added successfully.');
            redirect('admin/contact_list');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again.');
            redirect('admin/contact_list');
        }
    }
    // Contact list - contact detail
    public function contact_detail($id){
        $data['title'] = 'Contact List | Admin & Procurement';
        $data['body'] = 'admin/add_contact';
        $data['edit'] = $this->admin_model->contact_detail($id);
        $this->load->view('admin/commons/template', $data);
    }
    // Contact list - update contact
    public function update_contact(){
        $id = $this->input->post('id');
        $data = array(
            'name' => $this->input->post('name'),
            'designation' => $this->input->post('designation'),
            'project' => $this->input->post('project'),
            'district' => $this->input->post('district'),
            'province' => $this->input->post('province'),
            'gender' => $this->input->post('gender'),
            'cnic' => $this->input->post('cnic'),
            'personal_contact' => $this->input->post('personal_contact'),
            'official_contact' => $this->input->post('official_contact'),
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
            'grader' => $this->input->post('grader'),
            'supervisor' => $this->input->post('supervisor'),
            'dob' => $this->input->post('dob'),
            'doj' => $this->input->post('doj')
        );
        if($this->admin_model->update_contact($id, $data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Contact information was updated successfully.');
            redirect('admin/contact_list');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again.');
            redirect('admin/contact_list');
        }
    }
    // Contact list - delete contact
    public function delete_contact($id){
        if($this->admin_model->delete_contact($id)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Contact information was deleted successfully.');
            redirect('admin/contact_list');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again.');
            redirect('admin/contact_list');
        }
    }
    // Location - Load the page and list existing locations.
    public function locations($offset = null){
        $limit = 15;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $url = 'admin/locations';
        $rowscount = $this->admin_model->count_locations();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Locations | Admin & Procurement';
        $data['body'] = 'admin/locations';
        $data['locations'] = $this->admin_model->get_locations($limit, $offset);
        $this->load->view('admin/commons/template', $data);
    }
    // Locations - Add new location
    public function add_location(){
        $data = array(
            'name' => $this->input->post('location_name'),
            'province' => $this->input->post('province')
        );
        if($this->admin_model->add_location($data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Location information was added successfully.');
            redirect('admin/locations');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again.');
            redirect('admin/locations');
        }
    }
    // Locations - Edit location
    public function edit_location($id){
        $location = $this->admin_model->edit_location($id);
        echo json_encode($location);
    }
    // Locations - update location
    public function update_location(){
        $id = $this->input->post('id');
        $data = array(
            'name' => $this->input->post('location_name'),
            'province' => $this->input->post('province')
        );
        if($this->admin_model->update_location($id, $data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Location information was updated successfully.');
            redirect('admin/locations');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again.');
            redirect('admin/locations');
        }
    }
    // Locations - Delete location by ID.
    public function delete_location($id){
        if($this->admin_model->delete_location($id)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Location information was deleted successfully.');
            redirect('admin/locations');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again.');
            redirect('admin/locations');
        }
    }
    // Travels and hotel stays information.
    public function travels_info($offset = null){
        $limit = 15;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $url = 'admin/travels_info';
        $rowscount = $this->admin_model->total_travel_requests();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Travle & Stay Info | Admin & Procurement';
        $data['body'] = 'admin/travels_info';
        $data['travels'] = $this->admin_model->total_travel_requisitions($limit, $offset);
        $this->load->view('admin/commons/template', $data);
    }
    // View travel detail and print by ID.
    public function print_travel($travel_id){
        $data['title'] = 'Print Travel > Travel History';
        $data['body'] = 'admin/print_travel';
        $data['travel'] = $this->admin_model->print_travel($travel_id);
        // echo json_encode($data['travel']); exit;
        $this->load->view('admin/commons/template', $data);
    }
    // Categories and sub-categories
    public function categories($offset = null){
        $limit = 15;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $url = 'admin/categories';
        $rowscount = $this->admin_model->count_categories();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Categories > Admin & Procurement';
        $data['body'] = 'admin/categories';
        $data['categories'] = $this->admin_model->categories($limit, $offset);
        $data['locations'] = $this->login_model->get_locations();
        $this->load->view('admin/commons/new_template', $data);
    }
    // Adding a category
    public function add_category(){
        $data = array( 
            'cat_name' => $this->input->post('cat_name'),
            'added_by' => $this->session->userdata('id')
        );
        if($this->admin_model->add_category($data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Category was added successfully.');
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    // Edit category > Get category by ID to update it
    public function edit_category($id){
        $category = $this->admin_model->edit_category($id);
        echo json_encode($category);
    }
    // Adding a category
    public function update_category(){
        $id = $this->input->post('id');
        $data = array(
            'cat_location' => $this->input->post('cat_location'),
            'cat_name' => $this->input->post('cat_name')
        );
        if($this->admin_model->update_category($id, $data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Updating a category was successful.');
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    // Delete category by ID
    public function delete_category($id){
        if($this->admin_model->delete_category($id)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Deleting a category was successful.');
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    // Sub categories > Listing and adding sub categories
    public function sub_categories($cat_id,$offset = null){ // $id = category ID
        $limit = 10; 
        if(!empty($offset)){
            $config['uri_segment'] = 4;
        }
        $this->load->library('pagination');
        $url = base_url('admin/sub_categories');
        $rowscount = $this->admin_model->count_subcategory();
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
        $this->pagination->initialize($config);

        $data['title'] = 'Sub Categories | Categories';
        $data['body'] = 'admin/sub_categories';
        $data['sub_categories'] = $this->admin_model->sub_categories($cat_id,$limit, $offset);
        $this->load->view('admin/commons/new_template', $data);
    }
    // Adding a sub category
    public function add_sub_category(){
        $data = array(
            'cat_id' => $this->input->post('parent_category'),
            'name' => $this->input->post('name'),
            'added_by' => $this->session->userdata('id')
        );
        $checkIfExist = $this->db->select('name')->from('sub_categories')->where('name', strtolower($data['name']))->get()->row(); // Get sub_category name.
        if(strtolower($checkIfExist->name) != NULL){
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Record already exists, try adding a different one.');
            redirect($_SERVER['HTTP_REFERER']); 
            exit;
        }
        elseif($this->admin_model->add_sub_category($data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Category was added successfully.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    // Edit sub category > get sub category by ID
    public function edit_sub_category($id){
        $sub_category = $this->admin_model->edit_sub_category($id);
        echo json_encode($sub_category);
    }
    // Update sub category by ID
    public function update_sub_category(){
        $id = $this->input->post('sub_cat_id');
        $data = array(
            'name' => $this->input->post('name'),
            'unit_price' => $this->input->post('unit_price'),
            'quantity' => $this->input->post('quantity')
        );
        if($this->admin_model->update_sub_category($id, $data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Category was updated successfully.');
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    // Delete sub category
    public function delete_sub_category($id){
        if($this->admin_model->delete_sub_category($id)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Deleting a category was successful.');
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    //== ----------------------------------------- Search filters ---------------------------------------- ==\\
    // Search filters - search suppliers
    public function search_suppliers(){
        $search = $this->input->get('search');
        $data['title'] = 'Search Results > Suppliers';
        $data['body'] = 'admin/suppliers/suppliers';
        $data['results'] = $this->admin_model->search_suppliers($search);
        $data['locations'] = $this->admin_model->list_locations_suppliers();
        $this->load->view('admin/commons/template', $data);
    } 
    // Search filters - search inventory
    public function search_inventory(){
        $search = $this->input->get('search');
        $data['title'] = 'Search Results > Inventory';
        $data['body'] = 'admin/inventory';
        $data['locations'] = $this->login_model->get_locations();
        $data['results'] = $this->admin_model->search_inventory($search);
        $this->load->view('admin/commons/template', $data);
    }
    // Search filters - search users
    public function search_users(){
        $search = $this->input->get('search');
        $data['title'] = 'Search Results > Users';
        $data['body'] = 'admin/users';
        $data['results'] = $this->admin_model->search_users($search);
        $this->load->view('admin/commons/template', $data);
    }
    // Search filters - search invoices
    public function search_invoices(){
        $search = $this->input->get('search');
        $data['title'] = 'Search Results > Invoices';
        $data['body'] = 'admin/invoices';
        $data['results'] = $this->admin_model->search_invoices($search);
        $this->load->view('admin/commons/template', $data);
    }
    // Search filters - search asset register
    public function search_asset_register(){
        $search = $this->input->get('search');
        $data['title'] = 'Search Results > Asset Register';
        $data['body'] = 'admin/asset-register';
        $data['results'] = $this->admin_model->search_asset_register($search);
        $this->load->view('admin/commons/template', $data);
    }
    // Search filter - search equipment maintenance
    public function search_equip_maintenance(){
        $search = $this->input->get('search');
        $data['title'] = 'Search Results > Equipment Maintenance';
        $data['body'] = 'admin/maintenance';
        $data['results'] = $this->admin_model->search_equip_maintenance($search);
        $this->load->view('admin/commons/template', $data);
    }
    // Search filters - Search contact list
    public function search_contact_list(){
        $search = $this->input->get('search');
        $data['title'] = 'Search Results > Contact List';
        $data['body'] = 'admin/contact_list';
        $data['results'] = $this->admin_model->search_contact_list($search);
        $this->load->view('admin/commons/template', $data);
    }
    // Search filters - Search locations list
    public function search_locations(){
        $search = $this->input->get('search');
        $data['title'] = 'Search Results > Locations';
        $data['body'] = 'admin/locations';
        $data['results'] = $this->admin_model->search_locations($search);
        $this->load->view('admin/commons/template', $data);
    }
    // Search filters - search categories
    public function search_categories(){
        $search = $this->input->get('search');
        $data['title'] = 'Search Results > Categories';
        $data['body'] = 'admin/categories';
        $data['results'] = $this->admin_model->search_categories($search);
        $this->load->view('admin/commons/new_template', $data);
    }
    // Search filters - search sub categories
    public function search_sub_categories(){
        $search = $this->input->get('search');
        $data['title'] = 'Search Results > Categories';
        $data['body'] = 'admin/sub_categories';
        $data['results'] = $this->admin_model->search_sub_categories($search);
        $this->load->view('admin/commons/new_template', $data);
    }
    //Item register 
    public function item_register($offset = null){ 
        $limit = 10;

        if(!empty($offset)){
            $config['uri_segment'] = 3;
        }
    
        $this->load->library('pagination');
        $url = base_url('admin/item_register');
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
        $this->pagination->initialize($config);
        
        $data['title'] = 'Item Register | Admin & Procurement';
        $data['body'] = 'admin/item_assignment/item-register';
        $data['item_register'] = true;
        $data['items'] = $this->admin_model->get_items($limit, $offset); 
        $this->load->view('admin/commons/new_template', $data);
    }
  //Available Item list
  public function available_item_list($offset = null){ 
    $limit = 10;

    if(!empty($offset)){
        $config['uri_segment'] = 3;
    }

    $this->load->library('pagination');
    $url = base_url('admin/available_item_list');
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
    $this->pagination->initialize($config);

    $data['title'] = 'Item Register | Admin & Procurement';
    $data['body'] = 'admin/item_assignment/item-register';
    $data['available_page'] = true;
    $data['items'] = $this->admin_model->get_available_items($limit, $offset); 
    $this->load->view('admin/commons/new_template', $data);
}
//Assign item list
public function get_assign_item($offset = null){  
    $limit = 10;
    if(!empty($offset)){
        $config['uri_segment'] = 3;
    }

    $this->load->library('pagination');
    $url = 'admin/assign-list';
    $rowscount = $this->admin_model->count_assign_item();

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
    $this->pagination->initialize($config);

    $data['title'] = 'Item Register | Admin & Procurement';
    $data['body'] = 'admin/item_assignment/item-register';
    $data['assign_page'] = true; 
    $data['items'] = $this->admin_model->assign_item_list($limit, $offset); 
    $this->load->view('admin/commons/new_template', $data);
}
    //Assign item 
       public function assign_list($offset = null){ 
            $limit = 15;
            if(!empty($offset)){
            $this->uri->segment(3);
            }
        $url = 'admin/item_register';
        $rowscount = $this->admin_model->count_item();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Item Register | Admin & Procurement';
        $data['body'] = 'admin/item_assignment/assign-list';
        $data['items'] = $this->admin_model->assign_list($limit, $offset); 
        $this->load->view('admin/commons/template', $data);
    }
    // item register - add new item.
    public function add_item(){
        $data['title'] = 'Item Detail';
        $data['add_page'] = true;
        $data['body'] = 'admin/item_assignment/item-detail';  
        $data['categories'] = $this->admin_model->get_item_categories();
        $data['supplier'] = $this->admin_model->get_item_supplier();
        $data['locations'] = $this->admin_model->get_item_location(); 
        $this->load->view('admin/commons/new_template', $data);
    }
    // Add new Item into the database
    public function item_save(){  
        $model = $this->input->post('model');
        $result = $this->input->post('type_name');  
        $data = array(
            'location' => $this->input->post('location'),
            'category' => $this->input->post('category'),
            'sub_category' => $this->input->post('sub_category'),
            'type_name' => $this->input->post('item_type'),
            'status' => $this->input->post('status'),
            'quantity' => 1,
            'model' => $this->input->post('model'),
            'serial_number' => $this->input->post('serial_number'),
            'supplier' => $this->input->post('supplier'),
            'price' => $this->input->post('price'), 
            'purchasedate' => $this->input->post('purchasedate'),
            'depreciation' => $this->input->post('depreciation'), 
            'created_at' => date('Y-m-d')
        );  
        if($this->admin_model->item_save($data, $model, $this->input->post('quantity'))){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Item was added successfully.');
            redirect('admin/item_register');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again later.');
            redirect('admin/item_register');
        }
    }
    // Update an existing asset record
    public function modify_item(){
        $id = $this->input->post('id'); 
        $data = array(
            'location' => $this->input->post('location'),
            'category' => $this->input->post('category'),
            'sub_category' => $this->input->post('sub_category'),
            'type_name' => $this->input->post('item_name'),
            'model' => $this->input->post('model'),
            'serial_number' => $this->input->post('serial_number'),
            'supplier' => $this->input->post('supplier'),
            'price' => $this->input->post('price'),
            'purchasedate' => $this->input->post('purchasedate'),
            'depreciation' => $this->input->post('depreciation'), 
            'created_at' => date('Y-m-d')
        );
        if($this->admin_model->modify_item($id, $data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Item was updated successfully.');
            redirect('admin/item_register');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again.');
            redirect('admin/item_register');
        }
    }
    // Item detail
    public function item_detail($id){   
        $data['title'] = 'Item Detail';
        $data['body'] = 'admin/item_assignment/item-detail';
        $data['edit'] = $this->admin_model->item_detail($id);
        $data['categories'] = $this->admin_model->get_item_categories();
        $data['sub_categories'] = $this->admin_model->get_item_sub_category();    
        $data['supplier'] = $this->admin_model->get_item_supplier();
        $data['locations'] = $this->admin_model->get_item_location();
        $data['depreciation'] = $this->admin_model->get_item_depreciation($id);
        $data['status'] = $this->admin_model->status_items($id); 
        $data['edit_item'] = true;
        $this->load->view('admin/commons/new_template', $data);
    }
    // Search filters - search product date-wise
    public function product_report($offset = null){ 

        $limit = 10;

        if(!empty($offset)){
            $config['uri_segment'] = 3;
        }

        $date_from = $this->input->get('from_date');
        $date_to = $this->input->get('to_date');
    
        $this->load->library('pagination');
        $url = base_url('admin/product_report');
        $rowscount = $this->admin_model->count_item_date($date_from, $date_to);

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
        
        $data['title'] = 'Search Results > Report';
        $data['product_report'] = true;
        $data['body'] = 'admin/item_assignment/item-register';

        $data['items'] =  $this->admin_model->get_items($limit, $offset, $date_from, $date_to);

        $this->load->view('admin/commons/new_template', $data);
    } 
     // Get all sub categories based on cat_id of items
    public function get_item_sub_categories($cat_id){
        $sub_categories = $this->admin_model->get_item_sub_categories($cat_id);
        echo json_encode($sub_categories);
    }
    // Search filters - search asset register
    public function search_item($offset = null){
        $limit = 15;

        if(!empty($offset)){
            $config['uri_segment'] = 3;
        }

        $search = $this->input->get('search'); 

        $this->load->library('pagination');
        $url = base_url('admin/search_item');
        $rowscount = $this->admin_model->count_item_search($search);

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
    
        $data['title'] = 'Search Results > Item List';
        $data['body'] = 'admin/item_assignment/item-register'; 
        $data['assign_flag'] = false; 
        $data['items'] = $this->admin_model->search_items($search, $limit, $offset);
        $this->load->view('admin/commons/new_template', $data);
    }
    // Delete item
    public function delete_item($id){
        if($this->admin_model->delete_item($id)){
            $this->session->set_flashdata('success', '<strong>Delete! </strong>Item was deleted successfully.');
            redirect('admin/asset_register');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect('admin/asset_register');
        }
    }
     // Assignment Item List- 
     public function assign_item_list($offset = null){
        $limit = 15;
        if(!empty($offset)){
            $this->uri->segment(3);
        } 
        $url = 'admin/assign_item_list';
        $rowscount = $this->admin_model->count_item_assign();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Assign Item list';
        $data['body'] = 'admin/item_assignment/assign-item-list'; 
        $data['items'] = $this->admin_model->check_assign_list($limit, $offset); 
        $this->load->view('admin/commons/template', $data);
    }
      // Assignment Item form- To employ
      public function assign_item(){
        $id = $this->uri->segment(3);
        $data['title'] = 'Assign Item';
        $data['body'] = 'admin/item_assignment/assign-item'; 
        $data['assign_to'] = $this->admin_model->assign_to();
        $data['assign_by'] = $this->admin_model->assign_by(); 
        $data['get_item'] = $this->admin_model->get_item();  
        $data['get_model'] = $this->admin_model->get_model(); 
        $data['get_category'] = $this->admin_model->get_category(); 
        $data['locations'] = $this->admin_model->get_item_location(); 
        $data['returning_items'] = $this->admin_model->returning_assignment_list($id); 
        $this->load->view('admin/commons/new_template', $data);
    }
        // assign_item_save into the database
        public function assign_item_save(){  
        $item_id = $this->input->post('item_id');   
        $assign = $this->input->post('employ');   
        if(!empty($assign)){
        $data = array(
            'assignd_to' => $this->input->post('employ'),
            'item_id' => $this->input->post('item_id'),   
            'quantity' => 1,  
            'status' => 1,  
            'created_at' => date('Y-m-d'),
        );
        $invantory = array( 
            'status' => 1,   
        );
        $item = array( 
            'status' => 0,   
        );
        $return_back = array( 
            'return_back_date' => null,   
        );
        } 
        if($this->admin_model->assign_item_save($data,$item,$invantory,$item_id)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Item was assignd successfully.');
            redirect('admin/item_register');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again later.');
            redirect('admin/item_register');
        }
        }
        // assign_item_save into the database
        public function return_item(){ 
        $id = $this->input->post('id'); 
         $model_explode = explode('/', $id); 
        $assign_item_id =  $model_explode[0]; 
        $item_id =  $model_explode[1];
        $remarks = $this->input->post('remarks'); 
        $description = $this->input->post('description');
        $file = $this->input->post('userfile'); 
        $config['upload_path']   = './upload/'; 
        $config['allowed_types'] = 'gif|jpg|png';  
        $this->load->library('upload', $config); 
      
        if ( ! $this->upload->do_upload('userfile')) { 
            echo $this->upload->display_errors(); exit;
           $error = array('error' => $this->upload->display_errors()); 
           redirect('admin/item_register');
        }
        else {   
          
           $datas = $this->upload->data(); 
           $fileUpload = $datas['file_name'];  
            $data = array(   
                'remarks' => $remarks,
                'item_file' => $fileUpload,
                'returning_description' => $description, 
                'status' => 0,  
                'return_back_date' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            );  
            $invantory = array( 
                'status' => 0,   
            );
             $item = array( 
                'status' => 1,   
            ); 
            if($this->admin_model->return_item_save($data,$invantory,$item,$item_id,$assign_item_id)){
                $this->session->set_flashdata('success', '<strong>Success! </strong>Item was return back successfully.');
                redirect('admin/item_register');
            }else{
                $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again later.');
                redirect('admin/item_register');
            } 
        }
        } 
    // Search filters - search asset register
    public function search_assign_items(){
        $search = $this->input->get('search'); 
        $data['title'] = 'Search Results > Assign Item';
        $data['body'] = 'admin/item_assignment/assign-item-list'; 
        $data['results'] = $this->admin_model->search_assign_item($search);
        $this->load->view('admin/commons/template', $data);
    }   
     // Get all suppliers based on city
     public function get_assign_category($loc_id){
        $get_assign_category = $this->admin_model->get_assign_category($loc_id);
        echo json_encode($get_assign_category);
    }  
    // Get all suppliers based on city
    public function get_location_employ($loc_id){
        $get_location_employ = $this->admin_model->get_location_employ($loc_id);
        echo json_encode($get_location_employ);
    }  
    // Get all suppliers based on city
    public function get_location_suplier($loc_id){
       
        $get_location_suplier = $this->admin_model->get_location_suplier($loc_id);
        echo json_encode($get_location_suplier);
    }   
    // Get all suppliers based on city
    public function get_suplier_email($loc_id){
        $get_suplier_email = $this->admin_model->get_suplier_email($loc_id);
        echo json_encode($get_suplier_email);
    }  
    // Get all item type based on item
    public function get_item_type($item_id){ 
        $get_item_type = $this->admin_model->get_item_type($item_id);
        echo json_encode($get_item_type);
    }  
    // Get item model against item type
    public function get_item_model($item_type){ 
        $get_item_model = $this->admin_model->get_item_model($item_type);
        echo json_encode($get_item_model);
    }
     // Get assign item data against employ
     public function get_employ_data($data){   
        $get_employ_data = $this->admin_model->get_employ_data($data);
        echo json_encode($get_employ_data);
    } 
    // Get item model against item type
    public function get_item_serial_umber($id){
        $get_item_serial_umber = $this->admin_model->get_item_serial_umber($id);
        echo json_encode($get_item_serial_umber);
    }    
    //Item card   
    public function item_card($id,$offset = null){
    $employ_id = $this->uri->segment(4);  
     $data['title'] = 'Item Register | Admin & Procurement';
     $data['body'] = 'admin/item_assignment/item-card';
     $data['items'] = $this->admin_model->get_item_card($id,$employ_id); 
     $data['item'] = $this->admin_model->get_item_card_detail($id); 
     $this->load->view('admin/commons/template', $data);
 }
     // 404 page.
    public function page_not_found(){
        echo "We're sorry but the page you're looking for could not be found.";
    }
}
