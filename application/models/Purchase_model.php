<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Purchase_model extends CI_Model{
    // Get pending requisitions.    
    // Item register - Delete an Item
    public function delete_item($id){
        $this->db->where('id', $id);
        $this->db->delete('items_detail');
        return true;
    }
    // ---------------------------------- purchase code below -----------------------------------
   // purchase order list
 public function purchase_order_list($limit, $offset, $date_from = null, $date_to = null){
    $this->db->select('purchase_orders.id as purchase_id, 
                       purchase_orders.location_id, 
                       purchase_orders.quantity, 
                       purchase_orders.sub_category_id as sub_name,  
                       purchase_orders.supplier_id, 
                       purchase_orders.status, 
                       purchase_orders.review, 
                       purchase_orders.created_at,
                       sub_categories.id as sub_ids,
                       sub_categories.name as names,  
                       locations.id as loc_id,
                       locations.name as loc_name, 
                       suppliers.id as sup_id, 
                       suppliers.name as sup_name, 
                       suppliers.email,
                       items.id,
                       items.category,
                       items.sub_category
                       ');
    $this->db->from('purchase_orders'); 
    $this->db->join('sub_categories', 'purchase_orders.sub_category_id = sub_categories.id', 'left');  
    $this->db->join('locations', 'purchase_orders.location_id = locations.id', 'left');  
    $this->db->join('suppliers', 'purchase_orders.supplier_id = suppliers.id', 'left');  
    $this->db->join('items', 'items.sub_category = purchase_orders.sub_category_id', 'left');  
    if (!empty($date_from) && !empty($date_to)) {  
        $this->db->where('purchase_orders.created_at BETWEEN \'' . $date_from . '\' AND \'' . $date_to . '\'');
    }
    $this->db->group_by('purchase_orders.id', 'ASC');
    $this->db->order_by('purchase_orders.id', 'ASC');
    $this->db->limit($limit, $offset);
    return $this->db->get()->result(); 
}
   
// getting purchase order number 
public function purchase_order_number(){
    $this->db->select('id');
$this->db->from('purchase_orders');  
$this->db->order_by('id', 'DESC');
return $this->db->get()->row();
}
    // List locations for supplier form
    public function list_locations_suppliers(){
        $this->db->select('id, name');
        $this->db->from('locations');
        return $this->db->get()->result();
    }
    
 // purchase order list
 public function pos(){
    $this->db->select('po_suppliers.id,
                       po_suppliers.purchase_id,
                       po_suppliers.supplier_id,
                       po_suppliers.location,
                       po_suppliers.product,
                       po_suppliers.status,
                       po_suppliers.quantity,
                       po_suppliers.description,
                       po_suppliers.requested_by,
                       po_suppliers.created_at,
                       purchase_orders.id as purchase_id, 
                       suppliers.id as sup_id, 
                       suppliers.name as sup_name, 
                       locations.id as loc_id, 
                       locations.name, 
                       qutations.id as qut_id, 
                       qutations.po_id, 
                       qutations.price, 
                       qutations.status as qut_status,
                       ');
    $this->db->from('po_suppliers'); 
    $this->db->join('purchase_orders', 'po_suppliers.purchase_id = purchase_orders.id', 'left');
    $this->db->join('suppliers', 'po_suppliers.supplier_id = suppliers.id', 'left');
    $this->db->join('locations', 'po_suppliers.location = locations.id', 'left');
    $this->db->join('qutations', 'po_suppliers.id = qutations.id', 'left');
    $this->db->group_by('po_suppliers.id');
    $this->db->where(array('po_suppliers.purchase_id' => $this->uri->segment(3)));
    // $this->db->where('po_suppliers.purchase_id',$this->uri->segment(3));
    return $this->db->get()->result(); 
}  
// purchase order save 
public function purchase_order_save($data){  
    $this->db->insert_batch('purchase_orders', $data); 
    if($this->db->affected_rows() > 0){
    return true;
    }else{
    return false;
    }
}

 // Search purchase order - suppliers order
 public function search_purchase_item($search){
    $this->db->select('
                purchase_orders.id as purchase_id, 
                purchase_orders.location_id,
                purchase_orders.category_id,  
                purchase_orders.sub_category_id as sub_name, 
                purchase_orders.order_number, 
                purchase_orders.supplier_id,
                purchase_orders.order_date,
                purchase_orders.purchasedate,
                purchase_orders.status, 
                purchase_orders.created_at,
                sub_categories.id as sub_ids,
                sub_categories.name as names, 
                categories.id,
                categories.cat_name, 
                locations.id as loc_id, 
                locations.name as loc_name, 
                suppliers.id as sup_id, 
                suppliers.name as sup_name, 
    ');
    $this->db->from('purchase_orders');
    $this->db->join('categories', 'purchase_orders.category_id = categories.id', 'left');
    $this->db->join('sub_categories', 'purchase_orders.sub_category_id = sub_categories.id', 'left');
    $this->db->join('locations', 'purchase_orders.location_id = locations.id', 'left');  
    $this->db->join('suppliers', 'purchase_orders.supplier_id = suppliers.id', 'left'); 
    $this->db->like('suppliers.name', $search);
    $this->db->or_like('locations.name', $search);
    $this->db->or_like('purchase_orders.order_number', $search); 
    $this->db->order_by('created_at', 'DESC');
    return $this->db->get()->result();
}
  // purchase order forwarded to supplier
  public function po_supplier($id){
    $this->db->select('id, sub_category_id, quantity, description');
    $this->db->from('purchase_orders');
    $this->db->where('id', $id);
    return $this->db->get()->row();
}
  // get supplier email
  public function supplier_email($supplier){
    $this->db->select('id, email');
    $this->db->from('suppliers');
    $this->db->where('id', $supplier);
    return $this->db->get()->row();
}
     // order forwded to supplier
     public function po_forwarded($data){
        $this->db->insert('po_suppliers', $data);
        return true;
    }
    // qutation - Add new qutation
    public function add_qutation($po_id,$data,$pos_status){
        $this->db->where('id', $po_id);
        $this->db->update('purchase_orders', $pos_status);
        $this->db->insert('qutations', $data);
        if($this->db->affected_rows() > 0){
        return true;
        }else{
        return false;
        }
    }
     // purchase order - view and edit.
 public function order_edit($id){
    $this->db->select('
                       purchase_orders.id as purchase_id, 
                       purchase_orders.location_id,
                       purchase_orders.category_id,  
                       purchase_orders.sub_category_id, 
                       purchase_orders.order_number,  , 
                       purchase_orders.supplier_id,
                       purchase_orders.order_date,
                       purchase_orders.purchasedate,
                       purchase_orders.status, 
                       purchase_orders.created_at, 
                        ');
    $this->db->from('purchase_orders'); 
    $this->db->where('purchase_orders.id', $id);
    return $this->db->get()->row();
}
    // get inventory for adding an inventory
    public function get_item_categories(){
        return $this->db->from('categories')->get()->result();
    }
     // get Supplier for adding an item
     public function get_item_supplier(){
        $this->db->select('id, name');
        $this->db->from('suppliers'); 
        return $this->db->get()->result();
    }
    // Locations - Get item locations
    public function get_item_location(){
        return $this->db->from('locations')->get()->result(); 
    }   
  // update purchase - Update existing purchase record
  public function modify_purchase_record($id, $data){
    $this->db->where('id', $id);
    $this->db->update('purchase_orders', $data); 
    return true;
}    

// order detail card.
public function order_detail_card($id){ 
    $this->db->select(' 
                qutations.id as qut_id, 
                qutations.po_id, 
                qutations.requested_by, 
                qutations.supplier_id, 
                qutations.price, 
                qutations.remarks, 
                qutations.qutation,
                qutations.created_at,  
                qutations.status as qut_status,
                purchase_orders.id as purchase_id, 
                po_suppliers.id,  
                po_suppliers.purchase_id, 
                po_suppliers.supplier_id as sup_id, 
                po_suppliers.location, 
                po_suppliers.product, 
                po_suppliers.quantity,
                po_suppliers.requested_by as req_by,
                po_suppliers.description,
                po_suppliers.created_at as po_date,  
                locations.id as loc_id, 
                locations.name as loc_name, 
                suppliers.id as sup_id, 
                suppliers.name as sup_name, 
                users.id as users_id, 
                users.fullname as fname, 
            ');
        $this->db->from('qutations');  
        $this->db->join('purchase_orders', 'qutations.po_id = purchase_orders.id', 'left');
        $this->db->join('po_suppliers', 'qutations.po_id = po_suppliers.purchase_id', 'left');
        $this->db->join('users', 'users.id = po_suppliers.requested_by', 'left'); 
        $this->db->join('locations', 'po_suppliers.location = locations.id', 'left');  
        $this->db->join('suppliers', 'qutations.supplier_id = suppliers.id', 'left');   
        $this->db->group_by('qutations.id'); 
        $this->db->where('qutations.po_id', $id);
        $this->db->order_by('qutations.id', 'ASC');   
        return $this->db->get()->result(); 
}
// get supplier id requested_by purchase_id for add_qutation same method as above just change where
public function supplier_id($id){ 
    $this->db->select('    
                po_suppliers.id,  
                po_suppliers.purchase_id, 
                po_suppliers.supplier_id, 
                locations.id as loc_id, 
                locations.name as loc_name, 
                suppliers.id as sup_id, 
                suppliers.name as sup_name, 
                users.id as req_by,
                users.fullname as fname, 
            ');
        $this->db->from('po_suppliers');   
        $this->db->join('users', 'users.id = po_suppliers.requested_by', 'left'); 
        $this->db->join('locations', 'po_suppliers.location = locations.id', 'left');  
        $this->db->join('suppliers', 'po_suppliers.supplier_id = suppliers.id', 'left');   
        $this->db->where('po_suppliers.id', $id);   
        return $this->db->get()->result(); 
}
// order detail card.
public function order_detail($id){ 
    // echo $id;exit;
    $this->db->select(' 
                qutations.id as qut_id, 
                qutations.po_id, 
                qutations.requested_by, 
                qutations.supplier_id, 
                qutations.price, 
                qutations.remarks, 
                qutations.qutation as description,
                qutations.created_at,  
                qutations.status as qut_status,
                purchase_orders.id as purchase_id, 
                po_suppliers.id,  
                po_suppliers.purchase_id, 
                po_suppliers.supplier_id as sup_id, 
                po_suppliers.location, 
                po_suppliers.product, 
                po_suppliers.quantity,
                po_suppliers.requested_by as req_by,
                po_suppliers.description,
                po_suppliers.created_at as po_date,
                sub_categories.id as sub_ids,
                sub_categories.name as names,  
                locations.id as loc_id, 
                locations.name as loc_name, 
                suppliers.id as sup_id,
                suppliers.name as sup_name, 
                users.id as users_id, 
                users.fullname as fname, 
            ');
        $this->db->from('po_suppliers');  
        $this->db->join('purchase_orders', 'po_suppliers.purchase_id = purchase_orders.id', 'left');
        $this->db->join('qutations', 'po_suppliers.purchase_id = qutations.po_id', 'left');
        $this->db->join('users', 'po_suppliers.requested_by = users.id', 'left');
        $this->db->join('sub_categories', 'purchase_orders.sub_category_id = sub_categories.id', 'left');
        $this->db->join('locations', 'po_suppliers.location = locations.id', 'left');     
        // $this->db->group_by('purchase_orders.order_number');   
        $this->db->join('suppliers', 'qutations.supplier_id = suppliers.id', 'left');   
        $this->db->group_by('qutations.id'); 
        $this->db->where('qutations.id', $id);
        $this->db->order_by('qutations.id', 'ASC'); 
        return $this->db->get()->result();  
}

    // Count all po by date
    public function count_po_date($date_from, $date_to) {
        $this->db->select('id');
        $this->db->from('purchase_orders');
        $this->db->where('purchase_orders.created_at BETWEEN \'' . $date_from . '\' AND \'' . $date_to . '\'');
        $this->db->where('purchase_orders.location_id', $this->session->userdata('location'));
        $num_results = $this->db->count_all_results();
        return $num_results;
    }
    //  Count qutation where status = 1
    public function count_result($id){ 
        return $this->db->from('qutations')->where(array('po_id' => $id,'status' => 1))->count_all_results();
    }
    // Count qutation
    public function count_qutation($id){
        $this->db->select('purchase_id');
        $this->db->from('po_suppliers');
        $this->db->where('id',$id);
        $p_id = $this->db->get()->row();
       // $po_id = $p_id->purchase_id;  
        // return $this->db->from('qutations')->where(array('po_id' => $po_id))->count_all_results();
        return $this->db->from('qutations')->where(array('po_id' => $id))->count_all_results();
    }
    // Count qutation
    public function count_po($id){
        $this->db->select('purchase_id');
        $this->db->from('po_suppliers');
        $this->db->where('id',$id);
        $p_id = $this->db->get()->row();
       // $po_id = $p_id->purchase_id;  
        // return $this->db->from('qutations')->where(array('po_id' => $po_id))->count_all_results();
        return $this->db->from('po_suppliers')->where(array('purchase_id' => $id))->count_all_results();
    }
    
  // purchase order data for email
  public function po_data($id){
    $this->db->select('id, sub_category_id, quantity,location_id, description');
    $this->db->from('purchase_orders');
    $this->db->where('id', $id);
    return $this->db->get()->row();
}
     // Get available items detail .
 public function get_item_card_detail($id){
    $this->db->select('items.id, 
                       items.location, 
                       items.quantity, 
                       items.category, 
                       items.sub_category,
                       items.type_name, 
                       items.model, 
                       items.serial_number, 
                       items.supplier,
                       items.price, 
                       items.depreciation,
                       items.purchasedate,
                       items.created_at, 
                       locations.id as ids,
                       locations.name,
                       categories.id as cat_id, 
                       categories.cat_name, 
                       sub_categories.name as names, 
                       sub_categories.id as sub_ids, 
                       ');
    $this->db->from('items'); 
    $this->db->join('locations', 'items.location = locations.id', 'left');
    $this->db->join('categories', 'items.category = categories.id', 'left'); 
    $this->db->join('sub_categories', 'items.sub_category = sub_categories.id', 'left');
    $this->db->where('items.id', $id);
    $this->db->order_by('id', 'ASC');
    return $this->db->get()->row(); 
}
//cancel order
public function cancel_order($id,$data){ 
    $this->db->where('id', $id);
    $this->db->update('purchase_orders', $data);
    return true; 
}
//aproved po
public function approved_po($id,$data){ 
    $this->db->where('id', $id);
    $this->db->update('purchase_orders', $data);
    return true; 
}
// approved qutation for pos
public function approved_order($id,$pos_id,$data,$pos_data,$update_qut){  
    $this->db->where('id', $id);
    $this->db->update('qutations', $data);
    $this->db->where('id', $pos_id);
    $this->db->update('purchase_orders', $pos_data); 
    $this->db->where(array('po_id' => $pos_id, 'status' => 0)); 
    $this->db->update('qutations', $update_qut);
    return true; 
}  
}