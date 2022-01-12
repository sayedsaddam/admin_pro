<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Finance_model extends CI_Model{
	// count all cash in hand and other entities
	public function issued_petty_cash_total(){
		$this->db->select('SUM(amount_issued) as total_amount');
		$this->db->from('petty_cash_issuance');
		$this->db->where('location', $this->session->userdata('location'));
		return $this->db->get()->row();
	}
	// insert petty cash
	public function cash_issuance($data){
		$this->db->insert('petty_cash_issuance', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// count petty cash issued records
	public function total_petty_cash_issued(){
		return $this->db->from('petty_cash_issuance')->count_all_results();
	}
	// count petty cash requests
	public function total_petty_cash_requests(){
		return $this->db->from('petty_cash_requests')->count_all_results();
	}
	// edit petty cash issued
	public function edit_petty_cash_issued($id){
		$this->db->select('id, amount_issued, location, remarks');
		$this->db->from('petty_cash_issuance');
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}
	// update petty cash issuance
	public function update_petty_cash_issued($id, $data){
		$this->db->where('id', $id);
		$this->db->or_where('location', $id);
		$this->db->update('petty_cash_issuance', $data);
		return true;
	}
	// get petty cash by location id while issuing new amount
	public function get_older_cash($location_id){
		return $this->db->get_where('petty_cash_issuance', array('location' => $location_id))->row();
	}
	// insert petty cash update logs into another table while issuing more petty cash
	public function add_petty_cash_logs($data){
		$this->db->insert('petty_cash_logs', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// get all petty cash issued
	public function petty_cash_issued($limit, $offset){
		$this->db->select('petty_cash_issuance.id,
							petty_cash_issuance.amount_issued,
							petty_cash_issuance.issued_by,
							petty_cash_issuance.location,
							petty_cash_issuance.remarks,
							petty_cash_issuance.created_at,
							locations.id as locaction_id,
							locations.name as location_name,
							users.id as user_id,
							users.fullname');
		$this->db->from('petty_cash_issuance');
		$this->db->join('locations', 'petty_cash_issuance.location = locations.id', 'left');
		$this->db->join('users', 'petty_cash_issuance.issued_by = users.id', 'left');
		$this->db->limit($limit, $offset);
		$this->db->order_by('petty_cash_issuance.created_at', 'DESC');
		return $this->db->get()->result();
	}
	// get all petty cash issued - when finance admin is logged in, use this query
	public function petty_cash_issued_location($limit, $offset){
		$this->db->select('petty_cash_issuance.id,
							petty_cash_issuance.amount_issued,
							petty_cash_issuance.issued_by,
							petty_cash_issuance.location,
							petty_cash_issuance.remarks,
							petty_cash_issuance.created_at,
							locations.id as locaction_id,
							locations.name as location_name,
							users.id as user_id,
							users.fullname');
		$this->db->from('petty_cash_issuance');
		$this->db->join('locations', 'petty_cash_issuance.location = locations.id', 'left');
		$this->db->join('users', 'petty_cash_issuance.issued_by = users.id', 'left');
		$this->db->where('locations.id', $this->session->userdata('location'));
		$this->db->limit($limit, $offset);
		$this->db->order_by('petty_cash_issuance.created_at', 'DESC');
		return $this->db->get()->result();
	}
	// add petty cash request
	public function add_petty_cash_request($data){
		$this->db->insert('petty_cash_requests', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// petty cash requests list
	public function petty_cash_requests($limit, $offset){
		$this->db->select('petty_cash_requests.id,
							petty_cash_requests.requested_by,
							petty_cash_requests.amount,
							petty_cash_requests.justification,
							petty_cash_requests.remarks,
							petty_cash_requests.status,
							petty_cash_requests.created_at,
							locations.id as location_id,
							locations.name as location_name,
							users.id as user_id,
							users.fullname');
		$this->db->from('petty_cash_requests');
		$this->db->join('locations', 'petty_cash_requests.location = locations.id', 'left');
		$this->db->join('users', 'petty_cash_requests.requested_by = users.id', 'left');
		$this->db->limit($limit, $offset);
		$this->db->order_by('petty_cash_requests.created_at', 'DESC');
		return $this->db->get()->result();
	}
	// petty cash requests list - when finance admin is logged in, use this query.
	public function petty_cash_requests_location($limit, $offset){
		$this->db->select('petty_cash_requests.id,
							petty_cash_requests.requested_by,
							petty_cash_requests.amount,
							petty_cash_requests.justification,
							petty_cash_requests.remarks,
							petty_cash_requests.status,
							petty_cash_requests.created_at,
							locations.id as location_id,
							locations.name as location_name,
							users.id as user_id,
							users.fullname');
		$this->db->from('petty_cash_requests');
		$this->db->join('locations', 'petty_cash_requests.location = locations.id', 'left');
		$this->db->join('users', 'petty_cash_requests.requested_by = users.id', 'left');
		$this->db->where('locations.id', $this->session->userdata('location'));
		$this->db->limit($limit, $offset);
		$this->db->order_by('petty_cash_requests.created_at', 'DESC');
		return $this->db->get()->result();
	}
	// petty cash request detail
	public function petty_cash_request_detail($id){
		$this->db->select('id, justification');
		$this->db->from('petty_cash_requests');
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}
	// update request status >> Accept or Reject
	public function update_request_status($id, $data){
		$this->db->where('id', $id);
		$this->db->update('petty_cash_requests', $data);
		return true;
	}
	// approved petty cash requests amount > subtract from the issued amount
	public function approved_requests_amount($id){ // issued petty cash ID
		$this->db->select('id, SUM(amount) as requested_amount, status');
		$this->db->from('petty_cash_requests');
		$this->db->where(array('id' => $id, 'status' => 1));
		$this->db->group_by('location');
		return $this->db->get()->row();
	}
	// approved petty cash requests amount > subtract from the issued amount
	public function pending_requests_amount(){ // issued petty cash ID
		$this->db->select('id, SUM(amount) as requested_amount, status');
		$this->db->from('petty_cash_requests');
		$this->db->where(array('location' => $this->session->userdata('location'), 'status' => 0));
		$this->db->group_by('location');
		return $this->db->get()->row();
	}
	// remaining amount for dashboard - location based > take location id from session
	public function petty_requested_and_approved(){
		$this->db->select('id, SUM(amount) as requested_amount, status');
		$this->db->from('petty_cash_requests');
		$this->db->where(array('location' => $this->session->userdata('location'), 'status' => 1));
		$this->db->group_by('location');
		return $this->db->get()->row();
	}
}
