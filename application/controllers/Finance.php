<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Finance extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model(array('admin_model', 'finance_model'));
		$this->load->helper('paginate');
	}
	// finance dashboard
	public function index(){
		$data['title'] = 'Dashboard > Finance';
        $data['body'] = 'finance/dashboard';
		$data['locations'] = $this->admin_model->list_locations_suppliers();
		$data['cash_issued'] = $this->finance_model->issued_petty_cash_total();
		$data['petty_cash_requested'] = $this->finance_model->petty_requested_and_approved();
		$data['pending_cash_requests'] = $this->finance_model->pending_requests_amount();
		$data['cash_logs'] = $this->finance_model->sum_of_petty_cash();
        $this->load->view('admin/commons/template', $data);
	}
	// petty cash issuance
	public function cash_issuance(){
		$cash_issued = $this->input->post('amount_issued'); // new cash issuance
		$existing_cash = $this->finance_model->get_older_cash($_POST['location']);
		if(!empty($existing_cash)){
			$total_cash = $existing_cash->amount_issued + $cash_issued;
		}
		$data = array(
			'amount_issued' => $this->input->post('amount_issued'),
			'issued_by' => $this->session->userdata('id'),
			'location' => $this->input->post('location'),
			'remarks' => $this->input->post('remarks')
		);
		if(empty($existing_cash)){
			$this->finance_model->cash_issuance($data);
			$this->session->set_flashdata('success', '<strong>Success! </strong>Petty cash issued successfully!');
			redirect($_SERVER['HTTP_REFERER']);
		}elseif(!empty($existing_cash)){
			$data2 = array(
				'amount_issued' => $total_cash,
				'issued_by' => $this->session->userdata('id'),
				'remarks' => $this->input->post('remarks')
			);
			$this->finance_model->update_petty_cash_issued($_POST['location'], $data2);
			$data3 = array(
				'amount' => $this->input->post('amount_issued'),
				'issued_by' => $this->session->userdata('id'),
				'location' => $this->input->post('location')
			);
			$this->finance_model->add_petty_cash_logs($data3);
			$this->session->set_flashdata('success', '<strong>Success! </strong>Petty cash was updated successfully.');
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$this->session->set_flashdata('failed', '<strong>Failed! </strong>Petty cash issuance was not successful.');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	// petty cash issued
	public function petty_cash_issued($offset = null){
		$limit = 15;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		$url = 'finance/petty_cash_issued';
        $rowscount = $this->finance_model->total_petty_cash_issued();
        paginate($url, $rowscount, $limit);
		$data['title'] = 'Petty Cash Issued | HRIM';
		$data['body'] = 'finance/petty_cash_issued';
		$data['locations'] = $this->admin_model->list_locations_suppliers();
		if($this->session->userdata('user_role') == 'admin'){
			$data['cash_issued'] = $this->finance_model->petty_cash_issued($limit, $offset);
		}else{
			$data['cash_issued'] = $this->finance_model->petty_cash_issued_location($limit, $offset);
		}
		$this->load->view('admin/commons/template', $data);
	}
	// edit petty cash issued
	public function edit_petty_cash_issued($id){
		$result = $this->finance_model->edit_petty_cash_issued($id);
		echo json_encode($result);
	}
	// update petty cash
	public function update_petty_cash_issued(){
		$id = $this->input->post('id');
		$data = array(
			'amount_issued' => $this->input->post('amount_issued'),
			'issued_by' => $this->session->userdata('id'),
			'location' => $this->input->post('location'),
			'remarks' => $this->input->post('remarks')
		);
		if($this->finance_model->update_petty_cash_issued($id, $data)){
			$this->session->set_flashdata('success', '<strong>Success! </strong>Petty cash was updated successfully!');
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$this->session->set_flashdata('failed', '<strong>Failed! </strong>Updating petty cash was not successful.');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	// add petty cash request
	public function add_petty_cash_request(){
		$data = array(
			'requested_by' => $this->session->userdata('id'),
			'amount' => $this->input->post('amount'),
			'req_date' => $this->input->post('request_date'),
			'justification' => $this->input->post('reason'),
			'location' => $this->session->userdata('location')
		);
		if($this->finance_model->add_petty_cash_request($data)){
			$this->session->set_flashdata('success', '<strong>Success! </strong>Petty cash issued successfully!');
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$this->session->set_flashdata('failed', '<strong>Failed! </strong>Petty cash requested was not successful.');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	// list petty cash requests
	public function petty_cash_requests($offset = null){
		$limit = 15;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		$url = 'finance/petty_cash_requests';
        $rowscount = $this->finance_model->total_petty_cash_requests();
        paginate($url, $rowscount, $limit);
		$data['title'] = 'Petty Cash Requests | HRIM';
		$data['body'] = 'finance/petty_cash_requests';
		if($this->session->userdata('user_role') == 'admin'){
			$data['cash_requests'] = $this->finance_model->petty_cash_requests($limit, $offset);
		}else{
			$data['cash_requests'] = $this->finance_model->petty_cash_requests_location($limit, $offset);
		}
		$this->load->view('admin/commons/template', $data);
	}
	// petty cash request detail
	public function petty_cash_request_detail($id){
		$detail = $this->finance_model->petty_cash_request_detail($id);
		echo json_encode($detail);
	}
	// update petty cash request by id with status of accept or reject
	public function update_request_status(){
		$id = $this->input->post('id');
		$location = $this->input->post('location');
		$amount_requested = $this->input->post('amount_requested');
		$cash_in_hand = $this->finance_model->get_older_cash($location);
		$data = array(
			'status' => $this->input->post('status'),
			'remarks' => $this->input->post('remarks'),
			'reviewed_by' => $this->session->userdata('id')
		);
		if($_POST['status'] == 1){
			$udpate_cash = $cash_in_hand->amount_issued - $amount_requested;
		}
		if($this->finance_model->update_request_status($id, $data)){
			$data2 = array(
				'amount_issued' => $udpate_cash
			);
			$this->finance_model->update_petty_cash_issued($_POST['location'], $data2);
			$this->session->set_flashdata('success', '<strong>Success! </strong>Request status was updated successfully!');
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$this->session->set_flashdata('failed', '<strong>Failed! </strong>Updating request status was not successful.');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	// petty cash logs >> issued so far
	public function petty_cash_logs($offset = null){
		$limit = 15;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		$url = 'finance/petty_cash_logs';
		$rowscount = $this->finance_model->total_logs();
		paginate($url, $rowscount, $limit);
		$data['title'] = 'Petty Cash Logs | HRIM';
		$data['body'] = 'finance/petty_cash_logs';
		$data['cash_logs'] = $this->finance_model->get_petty_cash_logs($limit, $offset);
		$this->load->view('admin/commons/template', $data);
	}
	// get petty cash logs by location id.
	public function logs_by_location($location, $offset = null){
		$limit = 15;
		$url = 'finance/petty_cash_logs';
		$rowscount = $this->finance_model->total_logs();
		paginate($url, $rowscount, $limit);
		$data['title'] = 'Petty Cash Logs | HRIM';
		$data['body'] = 'finance/petty_cash_logs';
		$data['cash_logs'] = $this->finance_model->get_location_cash_logs($location, $limit, $offset);
		$this->load->view('admin/commons/template', $data);
	}
}
