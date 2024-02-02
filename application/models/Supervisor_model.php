<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Supervisor_model extends CI_Model{
    function __construct()
    {
        parent::__construct();
    }
    // Count all leave applications for logged in supervisor.
    public function total_leave_applications(){
        $this->db->select('employee_leaves.id,
                            employee_leaves.emp_id,
                            users.supervisor');
        $this->db->from('employee_leaves');
        $this->db->join('users', 'employee_leaves.emp_id = users.id', 'left');
        $this->db->where('users.supervisor', $this->session->userdata('id'));
        return $this->db->count_all_results();
    }
    // Count all items requisitions for logged in supervisor.
    public function total_item_requisitions(){
        $this->db->select('item_requisitions.id,
                            item_requisitions.requested_by,
                            users.supervisor');
        $this->db->from('item_requisitions');
        $this->db->join('users', 'item_requisitions.requested_by = users.id', 'left');
        $this->db->where('users.supervisor', $this->session->userdata('id'));
        return $this->db->count_all_results();
    }
    // Count all travel requisitions for logged in supervisor.
    public function total_travel_requisitions(){
        $this->db->select('travel_hotel_stay.id,
                            travel_hotel_stay.requested_by,
                            users.supervisor');
        $this->db->from('travel_hotel_stay');
        $this->db->join('users', 'travel_hotel_stay.requested_by = users.id', 'left');
        $this->db->where('users.supervisor', $this->session->userdata('id'));
        return $this->db->count_all_results();
    }
	// Count all DSA claims for logged in supervisor
	public function total_dsa_claims(){
		$this->db->select('dsa_claim.id,
                            dsa_claim.user_id,
                            users.supervisor');
        $this->db->from('dsa_claims');
        $this->db->join('users', 'dsa_claims.user_id = users.id', 'left');
        $this->db->where('users.supervisor', $this->session->userdata('id'));
        return $this->db->count_all_results();
	}
    // Get leave applications by employees.
    public function get_leave_applications($limit, $offset){
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
        $this->db->where('users.supervisor', $this->session->userdata('id'));
        return $this->db->get()->result();
    }
    // Get pending requisitions. > Only pending requisitions to be displayed on supervisor's dashboard.
    public function get_requisitions($limit, $offset){
        $this->db->select('item_requisitions.id,
                            item_requisitions.item_name,
                            item_requisitions.item_desc,
                            item_requisitions.item_qty,
                            item_requisitions.requested_by,
                            item_requisitions.status,
                            item_requisitions.created_at,
                            item_requisitions.updated_at,
                            users.id as user_id,
                            users.fullname,
                            users.location,
                            users.supervisor,
                            inventory.id as inv_id,
                            inventory.item_name as inv_name');
        $this->db->from('item_requisitions');
        $this->db->join('users', 'item_requisitions.requested_by = users.id', 'left');
        $this->db->join('inventory', 'item_requisitions.item_name = inventory.id', 'left');
        $this->db->where('users.supervisor', $this->session->userdata('id'));
        $this->db->order_by('item_requisitions.id', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
    // Get leave info
    public function get_leave_info($id){
        $this->db->select('id, emp_id, leave_reason, sup_remarks');
        $this->db->from('employee_leaves');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }
    // Approve / disapprove leave request.
    public function leave_actions($id, $data){
        $this->db->where('id', $id);
        $this->db->update('employee_leaves', $data);
        return true;
    }
    // Approve request > Approve or reject items requisition.
    public function request_actions($id, $data){
        $this->db->where('id', $id);
        $this->db->update('item_requisitions', $data);
        return true;
    }
    // Get leave applications by employees.
    public function get_travel_applications(){
        $this->db->select('travel_hotel_stay.*,
                            users.id as user_id,
                            users.fullname,
                            users.department,
                            users.supervisor');
        $this->db->from('travel_hotel_stay');
        $this->db->join('users', 'travel_hotel_stay.requested_by = users.id', 'left');
        $this->db->where('users.supervisor', $this->session->userdata('id'));
        $this->db->order_by('travel_hotel_stay.created_at', 'DESC');
        return $this->db->get()->result();
    }
    // Travel actions > Approve or reject travel requisition
    public function travel_actions($id, $data){
        $this->db->where('id', $id);
        $this->db->update('travel_hotel_stay', $data);
        return true;
    }
	// get dsa claims for requested by a user
	public function get_dsa_claims(){
		$this->db->select('dsa_claims.*,
                            users.id as user_id,
                            users.fullname,
                            users.department,
                            users.supervisor');
        $this->db->from('dsa_claims');
        $this->db->join('users', 'dsa_claims.user_id = users.id', 'left');
        $this->db->where('users.supervisor', $this->session->userdata('id'));
        $this->db->order_by('dsa_claims.created_at', 'DESC');
        return $this->db->get()->result();
	}
}
