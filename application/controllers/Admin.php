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
        if(!$this->session->userdata('username')){
            redirect('');
        }
    }
    // Load the dashboard.
    public function index(){
        if(!$this->session->userdata('username')){
            redirect('');
        }
        $data['title'] = 'Home | Admin & Procurement';
        $data['body'] = 'admin/dashboard';
        $data['pending'] = $this->user_model->total_pending();
        $data['approved'] = $this->user_model->total_approved();
        $data['rejected'] = $this->user_model->total_rejected();
        $data['pending_requisitions'] = $this->admin_model->pending_requisitions();
        $data['approved_requisitions'] = $this->admin_model->approved_requisitions();
        $data['rejected_requisitions'] = $this->admin_model->rejected_requisitions();
        $this->load->view('admin/commons/template', $data);
    }
    // Pending requests - listing
    public function pending_requests(){
        $data['title'] = 'Pending Requests | Admin & Procurement';
        $data['body'] = 'admin/pending-requests';
        $data['pending_requisitions'] = $this->admin_model->pending_requisitions();
        $this->load->view('admin/commons/template', $data);
    }
    // Approved requests - listing
    public function approved_requests(){
        $data['title'] = 'Approved Requests | Admin & Procurement';
        $data['body'] = 'admin/approved-requests';
        $data['approved_requisitions'] = $this->admin_model->approved_requisitions();
        $this->load->view('admin/commons/template', $data);
    }
    // Rejected requests - listing
    public function rejected_requests(){
        $data['title'] = 'Rejected Requests | Admin & Procurement';
        $data['body'] = 'admin/rejected-requests';
        $data['rejected_requisitions'] = $this->admin_model->rejected_requisitions();
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
    public function suppliers(){
        $data['title'] = 'Suppliers | Admin & Procurement';
        $data['body'] = 'admin/suppliers';
        $data['suppliers'] = $this->admin_model->get_suppliers();
        $this->load->view('admin/commons/template', $data);
    }
    // Suppliers - Add new supplier
    public function add_supplier(){
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
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
    // Inventory - Go to inventory page.
    public function inventory(){
        $data['title'] = 'Inventory | Admin & Procurement';
        $data['body'] = 'admin/inventory';
        $data['inventory'] = $this->admin_model->get_inventory();
        $this->load->view('admin/commons/template', $data);
    }
    // Inventory - Add inventory.
    public function add_inventory(){
        $data = array(
            'item_name' => $this->input->post('item_name'),
            'item_desc' => $this->input->post('item_desc'),
            'unit_price' => $this->input->post('unit_price'),
            'item_qty' => $this->input->post('item_qty'),
            'item_category' => $this->input->post('item_cat')
        );
        if($this->admin_model->add_inventory($data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Inventory was added successfully');
            redirect('admin/inventory');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again.');
            redirect('admin/inventory');
        }
    }
    // Inventory - Remove inventory
    public function delete_inventory($id){
        if($this->admin_model->delete_inventory()($id)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Inventory removal was successful.');
            redirect('admin/inventory');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect('admin/inventory');
        }
    }
    // Users - Go to users page where the users will be listed.
    public function users(){
        $data['title'] = 'Users | Admin & Procurement';
        $data['body'] = 'admin/users';
        $data['users'] = $this->admin_model->get_users();
        $this->load->view('admin/commons/template', $data);
    }
    // Users - Remove user.
    public function delete_user($id){
        if($this->admin_model->delete_user()($id)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>User removal was successful.');
            redirect('admin/users');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect('admin/users');
        }
    }
    // Invoices - Go to the invoices list page.
    public function invoices(){
        $data['title'] = 'Invoices | Admin & Procurement';
        $data['body'] = 'admin/invoices';
        $data['invoices'] = $this->admin_model->get_invoices();
        $this->load->view('admin/commons/template', $data);
    }
    // Invoices - Add invoice into the database.
    public function add_invoice(){
        $data = array(
            'inv_no' => $this->input->post('inv_no'),
            'vendor' => $this->input->post('vendor_name'),
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
    // 404 page.
    public function page_not_found(){
        echo "We're sorry but the page you're looking for could not be found.";
    }
}
