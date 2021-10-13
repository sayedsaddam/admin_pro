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
        if(!$this->session->userdata('username') || $this->session->userdata('user_role') != 'supervisor'){
            redirect('');
        }
    }
    public function index($offset = null){
        $limit = 10;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $data['title'] = 'Supervisor Dashboard | Admin & Procurement';
        $data['body'] = 'supervisor/dashboard';
        $data['total_requisitions'] = $this->supervisor_model->total_item_requisitions();
        $data['total_travels'] = $this->supervisor_model->total_travel_requisitions();
        $data['employees'] = $this->supervisor_model->get_employees($this->session->userdata('id'));
        $data['items'] = $this->supervisor_model->get_items();
        $data['requisitions'] = $this->supervisor_model->get_requisitions($limit, $offset);
        $data['travels'] = $this->supervisor_model->get_travel_applications($limit, $offset);
        $this->load->view('admin/commons/template', $data);
    }
    // list all item requisitions > on a separate page with pagination.
    public function view_all_requisitions($offset = null){
        if($this->input->post('filter')) {
            $date_from = $this->input->post('date_from');
            $date_to = $this->input->post('date_to');
        }

        $limit = 15;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $url = 'supervisor/view_item_requisitions';
        $rowscount = $this->supervisor_model->total_item_requisitions();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Item Requisitions | Admin & Procurement';
        $data['body'] = 'supervisor/requisitions_list';
        $data['requisitions'] = NULL;
        if($this->input->post('filter')) {
            $date_from = $this->input->post('date_from');
            $date_to = $this->input->post('date_to');
            $data['requisitions'] = $this->supervisor_model->get_requisitions($limit, $offset, $date_from, $date_to);
        } else {
            $data['requisitions'] = $this->supervisor_model->get_requisitions($limit, $offset);
        }
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
        if($this->input->post('filter')) {
            $date_from = $this->input->post('date_from');
            $date_to = $this->input->post('date_to');
            $data['travels'] = $this->supervisor_model->get_travel_applications($date_from, $date_to);
        } else {
            $data['travels'] = $this->supervisor_model->get_travel_applications();
        }
        $this->load->view('admin/commons/template', $data);
    }
    // Get leave info to pass ID to hidden field in form for approving or rejecting leave.
    public function leave_info($id){
        $leave_info = $this->supervisor_model->get_leave_info($id);
        echo json_encode($leave_info);
    }

    // Exports all travel records assigned to supervisor.
    // Takes date range (from) and date range (to) as input
    public function export_travels() {
        if(empty($this->input->post('date_from')) || empty($this->input->post('date_to'))) {
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>You did not provide the correct inputs!');
            redirect('supervisor');
        }

        $date_from = $this->input->post('date_from');
        $date_to = $this->input->post('date_to');

        if(!empty($offset)){
            $this->uri->segment(3);
        }

        $url = 'supervisor/export';

        $data['title'] = 'Exporting Data | Admin & Procurement';
        $data['body'] = 'supervisor/export';
        $data['travels'] = $this->supervisor_model->export_travels($date_from, $date_to);
        
        $this->load->view('admin/commons/template', $data);
    }

    // Created requisition
    public function create_requisition(){
		if(empty($this->input->post('category')) || empty($this->input->post('sub_category')) || empty($this->input->post('quantity'))) {
			$this->session->set_flashdata('failed', '<strong>Failed! </strong>You did not provide the correct inputs!');
            redirect('supervisor');
		}
        $data = array(
            'item_name' => $this->input->post('sub_category'), // Name of sub category > item name
            'item_desc' => $this->input->post('description'),
            'item_qty' => $this->input->post('quantity'),
            'requested_by' => $this->input->post('employees')
        );
        if($this->supervisor_model->create_requisition($data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Request submission was successful.');
            redirect('supervisor');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>An error occured in request submission.');
            redirect('supervisor');
        }
    }
    //== ---------------------------------------------- Employee Travel Requests --------------------------------------------- ==//
    // Place a travel request.
    public function apply_travel(){
        $stay_request = $this->input->post('stay_request');
        $stay_request_one = $this->input->post('stay_request_one');
        $data = array(
            'visit_of' => $this->input->post('visit_of'),
            'requested_by' => $this->input->post('requested_by'),
            'assignment' => $this->input->post('assignment'),
            'place_of_visit' => $this->input->post('place_of_visit'),
            'visit_date_start' => $this->input->post('visit_start'),
            'visit_date_end' => $this->input->post('visit_end'),
            'charge_to' => $this->input->post('charge_to'),
            'request_type' => $this->input->post('request_type'),
            'stay_request_type' => $stay_request.', '.$stay_request_one,
            'staying_at' => $this->input->post('staying_at'),
            'check_in' => $this->input->post('check_in'),
            'check_out' => $this->input->post('check_out'),
            'payment_mode' => $this->input->post('payment_mode'),
            'approx_cash' => $this->input->post('approx_cash')
        );
        if($this->supervisor_model->apply_travel($data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Your application for travel has been submitted successfully.');
            redirect('supervisor');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect('supervisor');
        }
    }
    // Get sub categories based on category ID.
    public function get_sub_categories($cat_id){
        $sub_categories = $this->supervisor_model->get_sub_categories($cat_id);
        echo json_encode($sub_categories);
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
