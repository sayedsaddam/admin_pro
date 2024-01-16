<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * undocumented class
 */
class Director extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('director_model');
		$this->load->helper('paginate');
	}
	// get all pending leave requests for director's approval
	public function index($offset = null){
		$limit = 10;
		$data['title'] = 'Leave Applications | HRM';
		$data['body'] = 'director/dashboard';
		$data['leaves'] = $this->director_model->getPendingLeaveRequests($limit, $offset);
		$data['travels'] = $this->director_model->getTravelApplications($limit, $offset);
		$this->load->view('admin/commons/template', $data);
	}
	// approve leave
	public function approve_leave(){
		$id = $this->input->post('id'); // Leave id.
		$data = array(
			 'leave_status' => 2,
			 'sup_remarks' => $this->input->post('remarks')
		);
		if($this->director_model->leaveActions($id, $data)){
			 $this->session->set_flashdata('success', '<strong>Success! </strong>Leave request was approved successfully.');
			 redirect($_SERVER['HTTP_REFERER']);
		}else{
			 $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
			 redirect($_SERVER['HTTP_REFERER']);
		}
  	}
	// reject leave.
	public function reject_leave(){
		$id = $this->input->post('id');
		$data = array(
			 'leave_status' => 3,
			 'sup_remarks' => $this->input->post('remarks')
		);
		if($this->direcotor_model->leaveActions($id, $data)){
			 $this->session->set_flashdata('success', '<strong>Success! </strong>Leave request was rejected successfully.');
			 redirect($_SERVER['HTTP_REFERER']);
		}else{
			 $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
			 redirect($_SERVER['HTTP_REFERER']);
		}
  	}
	// Approve travel request
	public function approve_travel($id){
		if(!$this->session->userdata('username')){
			 redirect('');
		}
		$data = array(
			 'travel_status' => 2,
			 'updated_at' => date('Y-m-d')
		);
		if($this->director_model->travelActions($id, $data)){
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
			 'travel_status' => 3,
			 'updated_at' => date('Y-m-d')
		);
		if($this->director_model->travelActions($id, $data)){
			 $this->session->set_flashdata('success', '<strong>Success! </strong>Request rejection was successful.');
			 redirect($_SERVER['HTTP_REFERER']);
		}else{
			 $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong in request rejection. Please try again.');
			 redirect($_SERVER['HTTP_REFERER']);
		}
 	}
	// get all leave requests pending for director's approval
	public function get_all_leaves($offset = null){
		$limit = 15;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		$url = 'director/get_all_leaves';
		$rowscount = $this->director_model->countPendingLeaveRequests();
		paginate($url, $rowscount, $limit);
		$data['title'] = 'Leave Applications | HRM';
		$data['body'] = 'director/leave_requests';
		$data['leaves'] = $this->director_model->getPendingLeaveRequests($limit, $offset);
		$this->load->view('admin/commons/template', $data);
	}
	// get all travel requests for director's approval
	public function get_all_travels($offset = null){
		$limit = 15;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $url = 'director/get_all_travels';
        echo $rowscount = $this->director_model->countTravelRequests();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Travel Requests | HRM';
        $data['body'] = 'director/travel_requests';
        $data['travels'] = $this->director_model->getTravelApplications($limit, $offset);
        $this->load->view('admin/commons/template', $data);
	}
}
