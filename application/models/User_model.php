<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class User_model extends CI_Model{
    function __construct()
    {
        parent::__construct();
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
        return $this->db->from('item_requisitions')->where('status', 0)->count_all_results();
    }
    // Count approved requisitions
    public function total_approved(){
        return $this->db->from('item_requisitions')->where('status', 1)->count_all_results();
    }
    // Count rejected requisitions
    public function total_rejected(){
        return $this->db->from('item_requisitions')->where('status', 2)->count_all_results();
    }
    // Get all requisition against requester.
    public function get_requisitions(){
        $this->db->select('id, item_name, item_desc, item_qty, status, created_at');
        $this->db->from('item_requisitions');
        $this->db->where('requested_by', $this->session->userdata('id'));
        return $this->db->get()->result();
    }
}