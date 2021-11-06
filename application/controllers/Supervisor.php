<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Supervisor extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('supervisor_model');
        $this->load->helper('paginate');
    }
    public function index($offset = null){
        $limit = 10;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $data['title'] = 'Supervisor Dashboard | Admin & Procurement';
        $data['body'] = 'supervisor/dashboard';
        $data['total_leaves'] = $this->supervisor_model->total_leave_applications();
        $data['total_requisitions'] = $this->supervisor_model->total_item_requisitions();
        $data['total_travels'] = $this->supervisor_model->total_travel_requisitions();
        $data['leaves'] = $this->supervisor_model->get_leave_applications($limit, $offset);
        $data['requisitions'] = $this->supervisor_model->get_requisitions($limit, $offset);
        $data['travels'] = $this->supervisor_model->get_travel_applications($limit, $offset);
        $this->load->view('admin/commons/template', $data);
    }
    // list all leaves > on a separate page with pagination.
    public function view_all_leaves($offset = null){
        $limit = 15;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $url = 'supervisor/view_all_leaves';
        $rowscount = $this->supervisor_model->total_leave_applications();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Leave Applications | Admin & Procurement';
        $data['body'] = 'supervisor/leaves_list';
        $data['leaves'] = $this->supervisor_model->get_leave_applications($limit, $offset);
        $this->load->view('admin/commons/template', $data);
    }
    // list all item requisitions > on a separate page with pagination.
    public function view_all_requisitions($offset = null){
        $limit = 15;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $url = 'supervisor/view_item_requisitions';
        $rowscount = $this->supervisor_model->total_item_requisitions();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Item Requisitions | Admin & Procurement';
        $data['body'] = 'supervisor/requisitions_list';
        $data['requisitions'] = $this->supervisor_model->get_requisitions($limit, $offset);
        $this->load->view('admin/commons/template', $data);
    }
    // list all travel history > on a separate page with pagination.
    public function view_travel_history($offset = null){
        $limit = 15;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $url = 'supervisor/view_travel_history';
        $rowscount = $this->supervisor_model->total_travel_requisitions();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Item Requisitions | Admin & Procurement';
        $data['body'] = 'supervisor/travels_list';
        $data['travels'] = $this->supervisor_model->get_travel_applications($limit, $offset);
        $this->load->view('admin/commons/template', $data);
    }
    // Get leave info to pass ID to hidden field in form for approving or rejecting leave.
    public function leave_info($id){
        $leave_info = $this->supervisor_model->get_leave_info($id);
        echo json_encode($leave_info);
    }
    // Approve leave.
    public function approve_leave(){
        $id = $this->input->post('id'); // Leave id.
        $data = array(
            'leave_status' => 1,
            'sup_remarks' => $this->input->post('remarks')
        );
        if($this->supervisor_model->leave_actions($id, $data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Leave request was approved successfully.');
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    // Reject leave.
    public function reject_leave(){
        $id = $this->input->post('id');
        $data = array(
            'leave_status' => 2,
            'sup_remarks' => $this->input->post('remarks')
        );
        if($this->supervisor_model->leave_actions($id, $data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Leave request was rejected successfully.');
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    // Approve item request.
    public function approve_request($id){
        if(!$this->session->userdata('username')){
            redirect('');
        }
        $data = array(
            'status' => 1,
            'updated_at' => date('Y-m-d')
        );
        if($this->supervisor_model->request_actions($id, $data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Request approval was successful.');
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong in request approval. Please try again.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    // Approve item request.
    public function reject_request($id){
        if(!$this->session->userdata('username')){
            redirect('');
        }
        $data = array(
            'status' => 2,
            'updated_at' => date('Y-m-d')
        );
        if($this->supervisor_model->request_actions($id, $data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Request rejection was successful.');
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong in request rejection. Please try again.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    // Approve travel request
    public function approve_travel($id){
        if(!$this->session->userdata('username')){
            redirect('');
        }
        $data = array(
            'travel_status' => 1,
            'updated_at' => date('Y-m-d')
        );
        if($this->supervisor_model->travel_actions($id, $data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Request approval was successful.');
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong in request rejection. Please try again.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    // Reject travel request
    public function reject_travel($id){
        if(!$this->session->userdata('username')){
            redirect('');
        }
        $data = array(
            'travel_status' => 2,
            'updated_at' => date('Y-m-d')
        );
        if($this->supervisor_model->travel_actions($id, $data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Request rejection was successful.');
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong in request rejection. Please try again.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}
