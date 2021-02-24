<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Admin_model extends CI_Model{
    // Get pending requisitions.
    public function pending_requisitions(){
        $this->db->select('item_requisitions.id,
                            item_requisitions.item_name,
                            item_requisitions.item_qty,
                            item_requisitions.requested_by,
                            item_requisitions.status,
                            item_requisitions.created_at,
                            users.id as user_id,
                            users.fullname,
                            users.location');
        $this->db->from('item_requisitions');
        $this->db->join('users', 'item_requisitions.requested_by = users.id', 'left');
        $this->db->where('item_requisitions.status', 0);
        return $this->db->get()->result();
    }
    // Get approved requisitions.
    public function approved_requisitions(){
        $this->db->select('item_requisitions.id,
                            item_requisitions.item_name,
                            item_requisitions.item_qty,
                            item_requisitions.requested_by,
                            item_requisitions.status,
                            item_requisitions.created_at,
                            users.id as user_id,
                            users.fullname,
                            users.location');
        $this->db->from('item_requisitions');
        $this->db->join('users', 'item_requisitions.requested_by = users.id', 'left');
        $this->db->where('item_requisitions.status', 1);
        return $this->db->get()->result();
    }
    // Get rejected requisitions.
    public function rejected_requisitions(){
        $this->db->select('item_requisitions.id,
                            item_requisitions.item_name,
                            item_requisitions.item_qty,
                            item_requisitions.requested_by,
                            item_requisitions.status,
                            item_requisitions.created_at,
                            users.id as user_id,
                            users.fullname,
                            users.location');
        $this->db->from('item_requisitions');
        $this->db->join('users', 'item_requisitions.requested_by = users.id', 'left');
        $this->db->where('item_requisitions.status', 2);
        return $this->db->get()->result();
    }
    // View requisition detail.
    public function request_detail($id){
        $this->db->select('item_requisitions.id,
                            item_requisitions.item_name,
                            item_requisitions.item_desc,
                            item_requisitions.item_qty,
                            item_requisitions.requested_by,
                            item_requisitions.status,
                            item_requisitions.created_at,
                            users.id as user_id,
                            users.fullname,
                            users.email,
                            users.location,
                            users.user_role');
        $this->db->from('item_requisitions');
        $this->db->join('users', 'item_requisitions.requested_by = users.id', 'left');
        $this->db->where('item_requisitions.id', $id);
        return $this->db->get()->row();
    }
}