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
        $this->load->helper('paginate'); 
        if(!$this->session->userdata('username') || $this->session->userdata('user_role') != 'supervisor' && $this->session->userdata('user_role') != 'user'){
            redirect('');
        }
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
        $data['total_travels'] = $this->user_model->total_travel_requests();
        $data['items'] = $this->user_model->get_items();
        $data['requisitions'] = $this->user_model->get_requisitions($limit, $offset);
        $this->load->view('admin/commons/template', $data);
    }
    // Get sub categories based on category ID.
    public function get_sub_categories($cat_id){
        $sub_categories = $this->user_model->get_sub_categories($cat_id);
        echo json_encode($sub_categories);
    }
    // Created requisition
    public function create_requisition(){
		if(empty($this->input->post('category')) || empty($this->input->post('sub_category')) || empty($this->input->post('quantity'))) {
			$this->session->set_flashdata('failed', '<strong>Failed! </strong>You did not provide the correct inputs!');
            redirect('users');
		}
        $data = array(
            'item_name' => $this->input->post('sub_category'), // Name of sub category > item name
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
        $data['items'] = $this->user_model->get_items();
        $data['requisitions'] = $this->user_model->get_requisitions($limit, $offset);
        $this->load->view('admin/commons/template', $data);
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
    //== ----------------------------------------------- Profile --------------------------------------------------- ==//
    // User profile > employee profile
    public function profile(){
        $data['title'] = 'Profile | Admin & Procurement';
        $data['body'] = 'user/profile';
        $data['profile'] = $this->user_model->profile();
        $this->load->view('admin/commons/template', $data);
    }
    // Update profile.
    public function update_profile(){
        $id = $this->input->post('user_id');
        $data = array(
            'fullname' => $this->input->post('fullname'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => sha1($this->input->post('password'))
        );
        if($this->user_model->update_profile($id, $data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Profile update was successful.');
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong. Please try again!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}
