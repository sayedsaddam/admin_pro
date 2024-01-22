<?php

use function PHPSTORM_META\map;

defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Users extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('login_model');
        $this->load->helper('paginate');
    }
    public function index($offset = null){
        $limit = 10;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $data['title'] = 'Dashboard | Admin & Procurement';
        $data['body'] = 'user/user_dashboard';
        $data['pending'] = $this->user_model->total_pending();
        $data['approved'] = $this->user_model->total_approved();
        $data['rejected'] = $this->user_model->total_rejected();
        $data['availed_leaves'] = $this->user_model->all_approved_leaves();
        $data['total_travels'] = $this->user_model->total_travel_requests();
        $data['items'] = $this->user_model->get_items();
        $data['requisitions'] = $this->user_model->get_requisitions($limit, $offset);
        $this->load->view('admin/commons/template', $data);
    }
    // Created requisition
    public function create_requisition(){
        $data = array(
            'item_name' => $this->input->post('item_name'),
            'item_desc' => $this->input->post('description'),
            'item_qty' => $this->input->post('quantity'),
            'requested_by' => $this->session->userdata('id')
        );
        if($this->user_model->create_requisition($data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Request submission was successful.');
            redirect('users');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>An error occured in request submission.');
            redirect('users');
        }
    }
    // List all requisitions
    public function requisitions($offset = null){
        $limit = 10;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $url = 'users/requisitions';
        $rowscount = $this->user_model->count_all_requisitions();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Requisitions | Admin & Procurement';
        $data['body'] = 'user/requisitions';
        $data['requisitions'] = $this->user_model->get_requisitions($limit, $offset);
        $this->load->view('admin/commons/template', $data);
    }
    //= ------------------------------------------------- Employee Leaves -------------------------------------------- =//
    public function apply_leave(){
        $data = array(
            'emp_id' => $this->session->userdata('id'),
            'leave_type' => $this->input->post('leave_type'),
            'leave_from' => $this->input->post('from_date'),
            'leave_to' => $this->input->post('to_date'),
            'no_of_days' => $this->input->post('no_of_days'),
            'leave_reason' => $this->input->post('leave_reason')
        );
        if($this->user_model->apply_leave($data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Your application for leave has been submitted successfully.');
            redirect('users');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Your application for leave could not be submitted at the moment, please try again later.');
            redirect('users');
        }
    }
    // Track leaves record.
    public function track_leaves($offset = null){
        $limit = 10;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $url = 'users/track_leaves';
        $rowscount = $this->user_model->total_leaves();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Track Leaves | Admin & Procurement';
        $data['body'] = 'user/track_leaves';
        $data['leaves'] = $this->user_model->track_leaves($limit, $offset);
        $this->load->view('admin/commons/template', $data);
    }
    // Leave detail > Reason for leaving.
    public function leave_detail($id){
        $leave_detail = $this->user_model->leave_detail($id);
        echo json_encode($leave_detail);
    }
    //== ---------------------------------------- Employee Travel Requests ---------------------------------------- ==//
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
        if($this->user_model->apply_travel($data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Your application for travel has been submitted successfully.');
            redirect('users');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect('users');
        }
    }
    // Track travel history.
    public function travel_history($offset = null){
        $limit = 15;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $url = 'users/travel_history';
        $rowscount = $this->user_model->total_travel_requests();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Travel History | Admin & Procurement';
        $data['body'] = 'user/travel_history';
        $data['travels'] = $this->user_model->travel_history($limit, $offset);
        $this->load->view('admin/commons/template', $data);   
    }
	// Request a DSA claim
	public function dsa_claim($id){
		$data = $this->user_model->travel_info($id);
		echo json_encode($data);
	}
	// add dsa claim form's data to the database
	public function add_dsa_claim(){
		$data = array(
			''
		);
	}
    // Profile > user profile
    public function profile(){
        $data['title'] = 'Profile | Admin & Procurement';
        $data['body'] = 'user/profile';
        $data['profile'] = $this->user_model->profile();
        $data['locations'] = $this->login_model->get_locations();
        $this->load->view('admin/commons/template', $data);
    }
    // Update profile.
    public function update_profile(){
        $id = $this->session->userdata('id');
        $data = array(
            'fullname' => $this->input->post('fullname'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'department' => $this->input->post('department'),
            'location' => $this->input->post('location'),
            'designation' => $this->input->post('designation'),
            'province' => $this->input->post('province'),
            'gender' => $this->input->post('gender'),
            'cnic' => $this->input->post('cnic'),
            'personal_contact' => $this->input->post('personal_contact'),
            'official_contact' => $this->input->post('official_contact'),
            'address' => $this->input->post('address'),
            'grader' => $this->input->post('grader'),
            'dob' => $this->input->post('dob'),
            'doj' => $this->input->post('doj')
        );
        if($this->user_model->update_profile($id, $data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Updating profile was successful.');
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again later.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}
