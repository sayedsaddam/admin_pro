<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class User_model extends CI_Model{
    function __construct()
    {
        parent::__construct();
    }
    // Get inventory items to list in the dropdown for user request submission.
    public function get_items(){
        $this->db->select('id, item_name, item_qty');
        $this->db->from('inventory');
        return $this->db->get()->result();
    }
    // Create an item requisition
    public function create_requisition($data){
        $this->db->insert('item_requisitions', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    // Count pending requisitions
    public function total_pending(){
        return $this->db->from('item_requisitions')->where(array('status' => 0, 'requested_by' => $this->session->userdata('id')))->count_all_results();
    }
    // Count approved requisitions
    public function total_approved(){
        return $this->db->from('item_requisitions')->where(array('status' => 1, 'requested_by' => $this->session->userdata('id')))->count_all_results();
    }
    // Count rejected requisitions
    public function total_rejected(){
        return $this->db->from('item_requisitions')->where(array('status' => 2, 'requested_by' => $this->session->userdata('id')))->count_all_results();
    }
    // Count all requisitions
    public function count_all_requisitions(){
        return $this->db->from('item_requisitions')->where('requested_by', $this->session->userdata('id'))->count_all_results();
    }
    // Get all requisition against requester.
    public function get_requisitions($limit, $offset){
        $this->db->select('item_requisitions.id,
                            item_requisitions.item_name,
                            item_requisitions.item_desc,
                            item_requisitions.item_qty,
                            item_requisitions.status,
                            item_requisitions.created_at,
                            item_requisitions.updated_at,
                            inventory.id as inv_id,
                            inventory.item_name as inv_name');
        $this->db->from('item_requisitions');
        $this->db->join('inventory', 'item_requisitions.item_name = inventory.id', 'left');
        $this->db->where('item_requisitions.requested_by', $this->session->userdata('id'));
        $this->db->order_by('item_requisitions.created_at', 'desc');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
    // =----------------------------------------------- Employee Leaves -----------------------------------------------== //
    // Apply leave
    public function apply_leave($data){
        $this->db->insert('employee_leaves', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    // Count number of leaves for currently logged in user.
    public function total_leaves(){
        return $this->db->where('emp_id', $this->session->userdata('id'))->from('employee_leaves')->count_all_results();
    }
    // Count approved leaves.
    public function all_approved_leaves(){
        $this->db->select('id, emp_id, leave_status, no_of_days');
        $this->db->from('employee_leaves');
        $this->db->where(array('emp_id' => $this->session->userdata('id'), 'leave_status' => 1));
        return $this->db->get()->row();
    }
    // Get leaves > Track leaves record.
    public function track_leaves($limit, $offset){
        $this->db->select('id, emp_id, leave_type, leave_from, leave_to, no_of_days, leave_reason, leave_status, created_at');
        $this->db->from('employee_leaves');
        $this->db->where('emp_id', $this->session->userdata('id'));
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
    //== ------------------------------------------ Travel and hotel stay ----------------------------------------------- ==//
    // Apply travel
    public function apply_travel($data){
        $this->db->insert('travel_hotel_stay', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    // Total leaves by currently logged in employee.
    public function total_travel_requests(){
        return $this->db->where('requested_by', $this->session->userdata('id'))->from('travel_hotel_stay')->count_all_results();
    }
    // Travel history
    public function travel_history($limit, $offset){
        return $this->db->where('requested_by', $this->session->userdata('id'))->from('travel_hotel_stay')->limit($limit, $offset)->get()->result();
    }
}