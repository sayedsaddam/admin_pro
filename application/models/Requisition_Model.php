<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Requisition_Model extends CI_Model{
    
// trequest list
    public function RequestList($limit, $offset,$user){
        $this->db->select('item_requisitions.id,item_requisitions.item_name,
        item_requisitions.item_desc,
        item_requisitions.item_qty,
        item_requisitions.requested_by,
        item_requisitions.status,
        item_requisitions.created_at as date,
        users.id as userId,
        users.fullname');
    $this->db->from('item_requisitions');
    $this->db->join('users', 'item_requisitions.requested_by = users.id', 'left');
    $this->db->where('item_requisitions.requested_by', $user);
    $this->db->limit($limit, $offset);
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
        users.id as userId,
        users.fullname');
    $this->db->from('item_requisitions');     
    $this->db->join('users', 'item_requisitions.requested_by = users.id', 'left'); 
    
    $this->db->group_start(); //start group 
    $this->db->or_like('item_name', $search);
    $this->db->or_like('item_desc', $search);
    $this->db->or_like('item_qty', $search);
    $this->db->or_like('requested_by', $search);
    $this->db->or_like('fullname', $search); 
    $this->db->group_end(); //close group

    $this->db->order_by('item_requisitions.created_at', 'DESC');
    return $this->db->get()->result();    

}

public function AddRequest($data, $user) {
    $this->db->trans_begin();

    $this->db->query("INSERT INTO item_requisitions (`item_name`, `item_desc`, `item_qty`, `requested_by`, `status`) VALUES ('$data->item_name', '$data->item_desc', $data->item_qty, '$user', NULL)");

    if ($this->db->trans_status() === FALSE)
    {
        $this->db->trans_rollback();
        return false;
    }
    $this->db->trans_commit();
    return true;
}


}
