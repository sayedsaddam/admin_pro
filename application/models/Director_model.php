<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * undocumented class
 */
class Director_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	// count all leave requests pending for director's approval
	public function countPendingLeaveRequests(){
		return $this->db->from('employee_leaves')->where('leave_status', 1)->count_all_results();
	}
	// get all leave requests pending for director's approval
	public function getPendingLeaveRequests($limit, $offset){
		$this->db->select('employee_leaves.id,
                            employee_leaves.emp_id,
                            employee_leaves.leave_type,
                            employee_leaves.leave_from,
                            employee_leaves.leave_to,
                            employee_leaves.no_of_days,
                            employee_leaves.leave_reason,
                            employee_leaves.leave_status,
                            employee_leaves.created_at,
                            users.id as user_id,
                            users.fullname,
                            users.department,
                            users.supervisor');
        $this->db->from('employee_leaves');
        $this->db->join('users', 'employee_leaves.emp_id = users.id', 'left');
        $this->db->limit($limit, $offset);
        $this->db->order_by('employee_leaves.created_at', 'DESC');
        $this->db->where('employee_leaves.leave_status', 1);
        return $this->db->get()->result();
	}
	// Approve / disapprove leave request.
	public function leaveActions($id, $data){
		$this->db->where('id', $id);
		$this->db->update('employee_leaves', $data);
		return true;
  	}
	// count travel requests
	public function countTravelRequests(){
		return $this->db->from('travel_hotel_stay')->where('travel_status', 1)->count_all_results();
	}
	// Get leave applications by employees.
	public function getTravelApplications($limit, $offset){
		$this->db->select('travel_hotel_stay.*,
								  users.id as user_id,
								  users.fullname,
								  users.department,
								  users.supervisor');
		$this->db->from('travel_hotel_stay');
		$this->db->join('users', 'travel_hotel_stay.requested_by = users.id', 'left');
		$this->db->where('travel_hotel_stay.travel_status', 1);
		$this->db->limit($limit, $offset);
		$this->db->order_by('travel_hotel_stay.created_at', 'DESC');
		return $this->db->get()->result();
  	}
	// Travel actions > Approve or reject travel requisition
	public function travelActions($id, $data){
		$this->db->where('id', $id);
		$this->db->update('travel_hotel_stay', $data);
		return true;
  }
}
