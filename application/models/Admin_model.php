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
                            item_requisitions.updated_at,
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
                            item_requisitions.updated_at,
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
                            item_requisitions.updated_at,
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
                            item_requisitions.updated_at,
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
    // Approve request.
    public function approve_request($id, $data){
        $this->db->where('id', $id);
        $this->db->update('item_requisitions', $data);
        return true;
    }
    // Reject request.
    public function reject_request($id, $data){
        $this->db->where('id', $id);
        $this->db->update('item_requisitions', $data);
        return true;
    }
    // Suppliers - Add new supplier
    public function add_supplier($data){
        $this->db->insert('suppliers', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    // Get suppliers
    public function get_suppliers(){
        $this->db->select('id, name, email, phone, address, status, created_at');
        $this->db->from('suppliers');
        $this->db->where('status', 1);
        return $this->db->get()->result();
    }
    // Remove supplier
    public function delete_supplier($id){
        $this->db->where('id', $id);
        $this->db->delete('suppliers');
        return true;
    }
    // Inventory - Add inventory.
    public function add_inventory($data){
        $this->db->insert('inventory', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    // Inventory - Get inventory.
    public function get_inventory(){
        $this->db->select('id, item_name, item_desc, unit_price, item_qty, item_category, created_at');
        $this->db->from('inventory');
        return $this->db->get()->result();
    }
    // Remove inventory.
    public function delete_inventory($id){
        $this->db->where('id', $id);
        $this->db->delete('inventory');
        return true;
    }
}