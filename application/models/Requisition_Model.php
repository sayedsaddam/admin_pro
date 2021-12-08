<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Requisition_Model extends CI_Model{
    
// trequest list
    public function RequestList(){
        $this->db->select('item_requisitions.id,item_requisitions.item_name,
        item_requisitions.item_desc,
        item_requisitions.item_qty,
        item_requisitions.requested_by,
        item_requisitions.status,
        item_requisitions.created_at as date,
        items.id as itemId,
        items.type_name,
        users.id as userId,
        users.fullname');
    $this->db->from('item_requisitions');   
    $this->db->join('items', 'item_requisitions.item_name = items.id', 'left');  
    $this->db->join('users', 'item_requisitions.requested_by = users.id', 'left');  
    return $this->db->get()->result();
    } 
// search request list --> record    
public function SearchRequest($search){
        $this->db->select('item_requisitions.id,
        item_requisitions.item_name,
        item_requisitions.item_desc,
        item_requisitions.item_qty,
        item_requisitions.requested_by,
        item_requisitions.status,
        item_requisitions.created_at as date,
        items.id as itemId,
        items.type_name,
        users.id as userId,
        users.fullname');
    $this->db->from('item_requisitions');   
    $this->db->join('items', 'item_requisitions.item_name = items.id', 'left');  
    $this->db->join('users', 'item_requisitions.requested_by = users.id', 'left'); 
    
    $this->db->group_start(); //start group
    $this->db->like('category', $search);
    $this->db->or_like('item_name', $search);
    $this->db->or_like('item_desc', $search);
    $this->db->or_like('item_qty', $search);
    $this->db->or_like('requested_by', $search);
    $this->db->or_like('type_name', $search);
    $this->db->or_like('fullname', $search); 
    $this->db->group_end(); //close group

    $this->db->order_by('item_requisitions.created_at', 'DESC');
    return $this->db->get()->result();    

}

}
