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
        if(!$this->session->userdata('username')){
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
        $url = 'admin/suppliers';
        $rowscount = $this->admin_model->count_suppliers();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Suppliers | Admin & Procurement';
        $data['body'] = 'admin/suppliers';
        $data['suppliers'] = $this->admin_model->get_suppliers($limit, $offset);
        $data['locations'] = $this->admin_model->list_locations_suppliers();
        $this->load->view('admin/commons/template', $data);
    }
    // Suppliers - Add new supplier
    public function add_supplier(){
        $data = array(
            'name' => $this->input->post('name'),
            'category' => $this->input->post('category'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'location' => $this->input->post('location'),
            'region' => $this->input->post('region'),
            'address' => $this->input->post('address')
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
            'category' => $this->input->post('category'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'location' => $this->input->post('location'),
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
        $data['inventory'] = $this->admin_model->get_inventory($limit, $offset);
        $this->load->view('admin/commons/template', $data);
    }
    // Inventory - Add inventory.
    public function add_inventory(){
        $data = array(
            'item_name' => $this->input->post('item_name'),
            'item_desc' => $this->input->post('item_desc'),
            'unit_price' => $this->input->post('unit_price'),
            'item_qty' => $this->input->post('item_qty'),
            'item_category' => $this->input->post('item_cat'),
            'item_loc' => $this->input->post('item_loc')
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
            'item_name' => $this->input->post('item_name'),
            'item_desc' => $this->input->post('item_desc'),
            'unit_price' => $this->input->post('unit_price'),
            'item_qty' => $this->input->post('item_qty'),
            'item_category' => $this->input->post('item_cat'),
            'item_loc' => $this->input->post('item_loc')
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
		$config['upload_path'] = 'upload/invoices/';
		$config['allowed_types'] = 'jpg|jpeg|png';
        $config['encrypt_name'] = false;
        // $config['max_size'] = '2048000';
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('inv_file')){
            echo $this->upload->display_errors();
        }else{
            $fileData = $this->upload->data();
            $file_name = $fileData['file_name'];
        }
        $data = array(
            'inv_no' => $this->input->post('inv_no'),
            'inv_date' => date('Y-m-d', strtotime($this->input->post('inv_date'))),
            'project' => $this->input->post('project'),
            'vendor' => $this->input->post('vendor_name'),
            'region' => $this->input->post('region'),
            'item' => $this->input->post('item_name'),
            'amount' => $this->input->post('amount'),
            'inv_desc' => $this->input->post('inv_desc'),
			'invoice_file' => $file_name
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
            'year' => $this->input->post('year'),
            'project' => $this->input->post('project'),
            'category' => $this->input->post('category'),
            'item' => $this->input->post('item'),
            'description' => $this->input->post('description'),
            'model' => $this->input->post('model'),
            'asset_code' => $this->input->post('asset_code'),
            'serial_number' => $this->input->post('serial_no'),
            'custodian_location' => $this->input->post('custodian'),
            'designation' => $this->input->post('designation'),
            'department' => $this->input->post('department'),
            'quantity' => $this->input->post('quantity'),
            'district_region' => $this->input->post('district'),
            'status' => $this->input->post('status'),
            'po_no' => $this->input->post('po_no'),
            'contact' => $this->input->post('contact'),
            'purchase_date' => $this->input->post('purchase_date'),
            'receive_date' => $this->input->post('receive_date'),
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
            'year' => $this->input->post('year'),
            'project' => $this->input->post('project'),
            'category' => $this->input->post('category'),
            'item' => $this->input->post('item'),
            'description' => $this->input->post('description'),
            'model' => $this->input->post('model'),
            'asset_code' => $this->input->post('asset_code'),
            'serial_number' => $this->input->post('serial_no'),
            'custodian_location' => $this->input->post('custodian'),
            'designation' => $this->input->post('designation'),
            'department' => $this->input->post('department'),
            'quantity' => $this->input->post('quantity'),
            'district_region' => $this->input->post('district'),
            'status' => $this->input->post('status'),
            'po_no' => $this->input->post('po_no'),
            'contact' => $this->input->post('contact'),
            'purchase_date' => $this->input->post('purchase_date'),
            'receive_date' => $this->input->post('receive_date'),
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
    // Leaves information
    public function leaves_info($offset = null){
        $limit = 15;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $url = 'admin/leaves_info';
        $rowscount = $this->admin_model->count_leaves();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Leaves Info | Admin & Procurement';
        $data['body'] = 'admin/leaves';
        $data['leaves'] = $this->admin_model->get_leave_applications($limit, $offset);
        $data['users'] = $this->admin_model->attendance_employees();
        $data['locations'] = $this->login_model->get_locations();
        $this->load->view('admin/commons/template', $data);
    }
    // Leave detail by ID.
    public function leave_detail($id){
        $data['title'] = 'Leave Detail > Leaves Info';
        $data['body'] = 'admin/leave_detail';
        $data['leave'] = $this->admin_model->get_leave_detail($id);
        $this->load->view('admin/commons/template', $data);
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
    // Search travel requisitions.
    public function search_travel_requisitions(){
        $search = $this->input->get('search');
        $data['title'] = 'Travle & Stay Info | Admin & Procurement';
        $data['body'] = 'admin/travels_info';
        $data['results'] = $this->admin_model->search_travel_requisitions($search);
        $this->load->view('admin/commons/template', $data);
    }
    // Get employees for attendance => filter by region.
    public function filter_by_region($location){
        $employees = $this->admin_model->filter_employee_by_region($location);
        echo json_encode($employees);
    }
    // Add daily attendance.
    public function add_daily_attendance(){
        if (isset($_POST)){
            $time_in = array();
            $time_out = array();
            $remarks = array();
            $approved_timings = array();
            $attendance_date = array();
            foreach ($_POST['time_in'] as $key => $value) { // $value = Time In
                if ($value != '') {
                    array_push($time_in, $value);
                }
            }
            foreach ($_POST['time_out'] as $key1 => $value1) { // $value1 =  Time out
                if ($value1 != '') {
                    array_push($time_out, $value1);
                }
            }
            foreach ($_POST['remarks'] as $key2 => $value2) { // $value2 = Remarks
                if ($value2 != '') {
                    array_push($remarks, $value2);
                }
            }
            foreach ($_POST['approved_time'] as $key3 => $value3) { // $value3 = Approved timings
                if ($value3 != '') {
                    array_push($approved_timings, $value3);
                }
            }
            foreach ($_POST['attendance_date'] as $key4 => $value4) {
                if ($value4 != '') {
                    array_push($attendance_date, $value4);
                }
            }
            for ($i = 0; $i < count($_POST['emp_id']); $i++) {
                $data[$i] = array(
                'emp_id' => $_POST['emp_id'][$i],
                'approved_timings' => $approved_timings[$i],
                'time_in' => $time_in[$i],
                'time_out' => $time_out[$i],
                'attendance_date' => $attendance_date[$i],
                'remarks' => $remarks[$i]
            );
            }
            if ($this->admin_model->add_daily_attendance($data)) {
                $this->session->set_flashdata('success', '<strong>Success! </strong>Daily attendance record was added successfully.');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong.Please try again!');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
    // List daily attendance.
    public function daily_attendance(){
        // $limit = 15;
        // if(!empty($offset)){
        //     $this->uri->segment(3);
        // }
        // $url = 'admin/daily_attendance';
        // $rowscount = $this->admin_model->count_attendace();
        // paginate($url, $rowscount, $limit);
        $data['title'] = 'Daily Attendance | Admin & Procurement';
        $data['body'] = 'admin/daily_attendance';
        $data['attendance'] = $this->admin_model->get_daily_attendance();
        $data['users'] = $this->admin_model->attendance_employees();
        $data['locations'] = $this->login_model->get_locations();
        $this->load->view('admin/commons/template', $data);
    }
    // Attendance report
    public function attendance_report(){
        $date_from = date('Y-m-d', strtotime($this->input->get('date_from')));
        $date_to = date('Y-m-d', strtotime($this->input->get('date_to')));
        $location = $this->input->get('location');
        // $employee = $this->input->get('employee');
        $data['title'] = "Search Results > Attendance Report";
        $data['body'] = 'admin/daily_attendance';
        $data['results'] = $this->admin_model->attendance_report($date_from, $date_to);
        $data['users'] = $this->admin_model->filter_employee_by_region($location);
        $this->load->view('admin/commons/template', $data);
    }
    //== ----------------------------------------- Search filters ---------------------------------------- ==\\
    // Search filters - search suppliers
    public function search_suppliers(){
        $search = $this->input->get('search');
        $data['title'] = 'Search Results > Suppliers';
        $data['body'] = 'admin/suppliers';
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
    // Search filters - Search leaves report between two dates.
    public function leaves_report(){
        $date_from = $this->input->get('date_from');
        $date_to = $this->input->get('date_to');
        $location = $this->input->get('location');
        $data['title'] = 'Leaves Report > Leaves Info';
        $data['body'] = 'admin/leaves';
        $data['locations'] = $this->login_model->get_locations();
        $data['results'] = $this->admin_model->search_leaves($date_from, $date_to, $location);
        $this->load->view('admin/commons/template', $data);
    }
    // 404 page.
    public function page_not_found(){
        echo "We're sorry but the page you're looking for could not be found.";
    }
}
