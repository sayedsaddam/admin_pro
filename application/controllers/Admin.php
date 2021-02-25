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
    // 404 page.
    public function page_not_found(){
        echo "We're sorry but the page you're looking for could not be found.";
    }
}
