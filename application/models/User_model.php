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
        $this->db->select('id, item_name, item_desc, item_qty, status, created_at, updated_at');
        $this->db->from('item_requisitions');
        $this->db->where('requested_by', $this->session->userdata('id'));
        $this->db->order_by('created_at', 'desc');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
}