<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Report_model extends CI_Model{
    public function UserRoles() {
        $this->db->from('users_roles');
        return $this->db->get()->result();
    }

// ************************ all report start below *********************** 
 // Search filters - Asset search 
 public function filter_asset($data){
    $this->db->select('assets.id,
    assets.category,
    assets.quantity, 
    assets.purchase_date, 
    assets.location, 
    assets.sub_categories, 
    assets.price,  
    assets.user,  
    assets.created_at,
    categories.id as cat_id,
    categories.cat_name,
    locations.id as loc_id,
    locations.name as loc_name');
    $this->db->from('assets');
    $this->db->join('categories', 'assets.category = categories.id', 'left'); 
    $this->db->join('locations', 'assets.location = locations.id', 'left'); 
    if ($this->session->userdata('user_role') != '1') {
        $this->db->where('assets.location', $this->session->userdata('location'));
    } 
    if($data['category'] != null){
    $this->db->where('category', $data['category']); 
}
if($data['sub_categories'] != null) {
    $this->db->where('sub_categories', $data['sub_categories']); 
}
if($data['price'] != null) {
    $this->db->where('price', $data['price']); 
}
if($data['purchase_date'] != null) {
    $this->db->where('purchase_date', $data['purchase_date']);
}
if($data['location'] != null) {
    $this->db->where('location', $data['location']); 
}
if($data['quantity'] != null) {
    $this->db->where('quantity', $data['quantity']); 
} 
return $this->db->get()->result();

}
// filter supplier 
  public function filter_supplier($data){ 
    $this->db->select('suppliers.id, suppliers.name,suppliers.email, suppliers.phone, suppliers.location,suppliers.ntn_number,suppliers.category,suppliers.rating, suppliers.region, suppliers.created_at,locations.id as loc_id,locations.name as loc_name');
    $this->db->from('suppliers');
    $this->db->join('locations', 'suppliers.location = locations.id', 'left'); 
    
    if($data['name'] != null){
        $this->db->where('suppliers.name', $data['name']);
    }

    if($data['category'] != null){
        $this->db->where('category', $data['category']);
    }

    if($data['email'] != null){
        $this->db->where('email', $data['email']);
    }

    if($data['phone'] != null){
        $this->db->where('phone', $data['phone']);
    }

    if($data['location'] != null){
        $this->db->where('location', $data['location']);
    }

    if($data['ntn_number'] != null){
        $this->db->where('ntn_number', $data['ntn_number']);
    }

    if($data['rating'] != null){
        $this->db->where('rating', $data['rating']);
    }

    return $this->db->get()->result();
}
    
}
