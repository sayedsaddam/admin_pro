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
    
    // Count all purchase items 
    public function count_purchase(){
        return $this->db->from('purchase_orders')->count_all_results();
    }
 // purchase order list
 public function purchase_order_list($limit, $offset){
    $this->db->select('purchase_orders.id as purchase_id, 
                       purchase_orders.location_id, 
                       purchase_orders.sub_category_id as sub_name,  
                       purchase_orders.supplier_id, 
                       purchase_orders.status, 
                       purchase_orders.created_at,
                       sub_categories.id as sub_ids,
                       sub_categories.name as names,  
                       locations.id as loc_id,
                       locations.name as loc_name, 
                       suppliers.id as sup_id, 
                       suppliers.name as sup_name, 
                       ');
    $this->db->from('purchase_orders'); 
    $this->db->join('sub_categories', 'purchase_orders.sub_category_id = sub_categories.id', 'left');  
    $this->db->join('locations', 'purchase_orders.location_id = locations.id', 'left');  
    $this->db->join('suppliers', 'purchase_orders.supplier_id = suppliers.id', 'left');  
    $this->db->order_by('purchase_orders.id', 'ASC');
    $this->db->limit($limit, $offset);
    return $this->db->get()->result(); 
}  
// purchase order save 
     public function purchase_order_save($data){  
           $this->db->insert('purchase_orders', $data); 
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
  // update purchase - Update existing purchase record
  public function modify_purchase_record($id, $data){
    $this->db->where('id', $id);
    $this->db->update('purchase_orders', $data); 
    return true;
} 
// order detail card.
public function order_detail_card($limit, $offset,$id){
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
                purchase_orders.location_id,  
                purchase_orders.sub_category_id as sub_name, 
                purchase_orders.order_number, 
                purchase_orders.supplier_id, 
                purchase_orders.status, 
                purchase_orders.requested_by,
                purchase_orders.created_at as po_date,
                sub_categories.id as sub_ids,
                sub_categories.name as names,  
                locations.id as loc_id, 
                locations.name as loc_name, 
                suppliers.id as sup_id, 
                suppliers.name as sup_name, 
                users.id as users_id, 
                users.fullname as fname, 
            ');
        $this->db->from('purchase_orders');  
        $this->db->join('qutations', 'purchase_orders.id = qutations.po_id', 'left');
        $this->db->join('users', 'purchase_orders.requested_by = users.id', 'left');
        $this->db->join('sub_categories', 'purchase_orders.sub_category_id = sub_categories.id', 'left');
        $this->db->join('locations', 'purchase_orders.location_id = locations.id', 'left');  
        $this->db->join('suppliers', 'purchase_orders.supplier_id = suppliers.id', 'left');   
        // $this->db->group_by('purchase_orders.order_number'); 
        $this->db->where('purchase_orders.id', $id);
        $this->db->order_by('purchase_orders.id', 'ASC');
        $this->db->limit($limit, $offset);  
        return $this->db->get()->result(); 
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
    // Count qutation
    public function count_qutation($id){ 
        return $this->db->from('qutations')->where(array('po_id' => $id))->count_all_results();
    } 
    //  Count qutation where status = 1
    public function count_result($id){ 
        return $this->db->from('qutations')->where(array('po_id' => $id,'status' => 1))->count_all_results();
    }
    //cancel order
    public function cancel_order($id,$data){ 
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