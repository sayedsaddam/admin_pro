<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Supervisor_model extends CI_Model{
    function __construct()
    {
        parent::__construct();
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
                            inventory.name as inv_name,
                            sub_categories.id as sub_cat_id,
                            sub_categories.name as sub_cat_name,
                            categories.id as cat_id,
                            categories.cat_name');
        $this->db->from('item_requisitions');
        $this->db->join('users', 'item_requisitions.requested_by = users.id', 'left');
        $this->db->join('inventory', 'item_requisitions.item_name = inventory.id', 'left');
        $this->db->join('sub_categories', 'inventory.name = sub_categories.id', 'left');
        $this->db->join('categories', 'sub_categories.cat_id = categories.id', 'left');
        $this->db->where('users.supervisor', $this->session->userdata('id'));
        $this->db->order_by('item_requisitions.id', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
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
}
