<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Requisition_Model extends CI_Model{
    
    // RequestList() function
    public function RequestList($limit, $offset, $user) {
        
        $this->db->select('
            item_requisitions.id,
            item_requisitions.item_name,
            item_requisitions.item_desc,
            item_requisitions.item_qty,
            item_requisitions.requested_by,
            item_requisitions.status,
            item_requisitions.created_at as date,
            users.id as userId,
            users.fullname'
        );

        $this->db->from('item_requisitions');
        $this->db->join('users', 'item_requisitions.requested_by = users.id', 'left');

        if($this->session->userdata('user_role') != 1){
        $this->db->where('item_requisitions.requested_by' , $user);
        }
        $data = $this->uri->segment(3); // take segment 3 when click on tab
        if(isset($data)) { 
            if($data == 0) { 
                $this->db->where(array('item_requisitions.status' => $data));
            } 
            if($data == 1) { 
                $this->db->where(array('item_requisitions.status' => $data));
            } 
            if($data == 2) { 
                $this->db->where(array('item_requisitions.status' => $data));
            } 
            if($data == 3) { 
                $this->db->where(array('item_requisitions.status' => null));
            } 
            if(!isset($data)) { 
                $this->db->where('item_requisitions.requested_by', $user);
                $this->db->limit($limit, $offset); 
            }
        }
        return $this->db->get()->result();
    }

    // Approval list
    public function ApprovalList($limit, $offset, $user,$role_id) { 
        $role = $this->db->select('role_id,read')->from('request_access')->where(array('role_id' => $role_id, 'read' => 1))->get()->row(); 
        if(!empty($role)){
            $roleId = $role->role_id; // this query is used to take common role id --
        }else{
            $roleId = 0;
        }
      
        $this->db->select('
            item_requisitions.id,
            item_requisitions.item_name,
            item_requisitions.item_desc,
            item_requisitions.item_qty,
            item_requisitions.requested_by,
            item_requisitions.status,
            item_requisitions.created_at as date,
            users.id as userId,
            users.fullname,
            users.user_role,
            request_access.id as access_id,
            request_access.request_id,
            request_access.role_id,
            request_access.read'
        ); 
        // echo $roleId;exit;
        $this->db->from('item_requisitions');
        $this->db->join('users', 'item_requisitions.requested_by = users.id', 'left');
        $this->db->join('request_access', 'users.user_role = request_access.role_id', 'left');
        // $this->db->where('request_access.role_id', $role_id); 
        $this->db->where(array($roleId => $role_id, 'request_access.read' => 1));
        // $this->db->where($roleId,$role_id); 
        // $this->db->where('request_access.read', 1); 
        $this->db->group_by('item_requisitions.id');
        $data = $this->uri->segment(3);
        if(isset($data)) { 
            if($data == 0) { 
                $this->db->where(array('item_requisitions.status' => $data));
            } 
            if($data == 1) { 
                $this->db->where(array('item_requisitions.status' => $data));
            } 
            if($data == 2) { 
                $this->db->where(array('item_requisitions.status' => $data));
            } 
            if($data == 3) { 
                $this->db->where(array('item_requisitions.status' => null));
            } 
            if(!isset($data)) { 
                $this->db->where('item_requisitions.requested_by', $role_id);
                $this->db->limit($limit, $offset); 
            }  
        } 
        $this->db->order_by('item_requisitions.id', 'desc');
        $this->db->order_by('item_requisitions.status', '3'); 
        return $this->db->get()->result();
    } 
    // aproval list end
 
    // SearchRequest() function - Searches the request list in requisitions    
    public function SearchRequest($search, $user) {
    
        $this->db->select('item_requisitions.id,
            item_requisitions.item_name,
            item_requisitions.item_desc,
            item_requisitions.item_qty,
            item_requisitions.requested_by,
            item_requisitions.status,
            item_requisitions.created_at as date,
            users.id as userId,
            users.fullname'
        );
    
        $this->db->from('item_requisitions');
        $this->db->join('users', 'item_requisitions.requested_by = users.id', 'left');

        $this->db->group_start(); //Start Grouping
        $this->db->or_like('item_name', $search);
        $this->db->or_like('item_desc', $search);
        $this->db->or_like('item_qty', $search);
        $this->db->or_like('requested_by', $search);
        $this->db->or_like('fullname', $search); 
        $this->db->group_end(); //Close Grouping
        
        $this->db->where('item_requisitions.requested_by', $user);
        $this->db->order_by('item_requisitions.created_at', 'DESC');

        return $this->db->get()->result();
    }

    // AddRequest() function - Adds request for requisition from user
    public function AddRequest($data, $user) {
        $this->db->trans_begin();

        $this->db->query("INSERT INTO item_requisitions (`item_name`, `item_desc`, `item_qty`,`location_id`,`department_id`,`company_id`, `requested_by`, `status`) VALUES ('$data->item_name', '$data->item_desc', $data->item_qty, ' $data->location','$data->department','$data->company','$user', NULL)");
        $last_insert_id = $this->db->insert_id();
        
        $users_roles = $this->db->query("SELECT `id`, `type` FROM users_roles")->result();
        
        foreach($users_roles as $data) {
            if ($data->type == 'supervisor') {
                $this->db->query("INSERT INTO request_access (`request_id`, `role_id`,`read`) VALUES ('$last_insert_id', '$data->id', 1)");    
            } else {
                $this->db->query("INSERT INTO request_access (`request_id`, `role_id`,`read`) VALUES ('$last_insert_id', '$data->id', 0)");
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        }

        $this->db->trans_commit();

        return true;
    }

    // ViewRequest() function - View details of request
    public function ViewRequest($id) {

        $this->db->select('item_requisitions.id, 
            item_requisitions.item_name,
            item_requisitions.item_desc,
            item_requisitions.item_qty,
            item_requisitions.status,
            item_requisitions.created_at as date, 
            item_requisitions.requested_by,
            item_requisitions.location_id,
            item_requisitions.department_id,
            item_requisitions.company_id,
            users.id as user_id, users.fullname,
            departments.id as dep_id,
            departments.department,
            locations.id as loc_id,
            locations.name as loc_name,
            company.id as company_id,
            company.name as company_name'
        );

        $this->db->from('item_requisitions');
        $this->db->join('users', 'item_requisitions.requested_by = users.id', 'left');
        $this->db->join('locations', 'item_requisitions.location_id = locations.id', 'left');
        $this->db->join('departments', 'item_requisitions.department_id = departments.id', 'left');
        $this->db->join('company', 'item_requisitions.company_id = company.id', 'left');
        $this->db->where('item_requisitions.id', $id);

        return $this->db->get()->row();
    }

    // ForwardList() function - Forwardes the request
    public function ForwardList($id,$role_id, $data,$forward_request) {
        // echo $id;exit;
        $this->db->where('request_id', $id);
        $this->db->where('role_id', $role_id);
        $this->db->update('request_access', $forward_request);

        $this->db->where('id', $id);
        $this->db->update('item_requisitions', $data);

        return true;
    }

    // ApprovedList() function - Approved request List
    public function ApprovedList($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('item_requisitions', $data);
        return true;
    }

    // RejectList() function - Rejects request
    public function RejectList($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('item_requisitions', $data);
        return true;
    }
// slect supplier for po - purchase order
    public function supplier(){
        $this->db->select('suppliers.id as sup_id, suppliers.name sup_name,suppliers.email, suppliers.phone, suppliers.location,suppliers.status');
        $this->db->from('suppliers');
        // $this->db->where('suppliers.status', 1); 
        $this->db->where('suppliers.location', $this->session->userdata('location')); 
        $this->db->order_by('suppliers.rating', 'DESC');
        return $this->db->get()->result();
    }
    // select supplier email
public function supplier_email($vendor){
    $this->db->select('id,email');
    $this->db->from('suppliers');
    $this->db->where('id', $vendor); 
    return $this->db->get()->row();
}
// select product detail for qutation
public function product_detail($request_id){
    $this->db->select('id,item_name,item_desc,item_qty,location_id');
    $this->db->from('item_requisitions');
    $this->db->where('id', $request_id); 
    return $this->db->get()->row();
}
// select location for quotation
public function location($location_id){
    $this->db->select('id,name');
    $this->db->from('locations');
    $this->db->where('id', $location_id);
    return $this->db->get()->row();
}
    // Inventory - send quotation
    public function send_quotation($data){
        $this->db->insert('quotations', $data);
        $last_insert_id = $this->db->insert_id();

        $users_roles = $this->db->query("SELECT `id`, `type` FROM users_roles")->result();
        
        foreach($users_roles as $data) {
            if ($data->type == 'supervisor') {
                $this->db->query("INSERT INTO quotations_access (`quotation_id`, `role_id`,`read`) VALUES ('$last_insert_id', '$data->id', 1)");    
            } else {
                $this->db->query("INSERT INTO quotations_access (`quotation_id`, `role_id`,`read`) VALUES ('$last_insert_id', '$data->id', 0)");
            }
        }

        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
      // Inventory - Add inventory.
      public function SaveQuotation($id,$data){
        $this->db->where('id', $id);
        $this->db->update('quotations', $data);

        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
   // Approval list
   public function QuotationList($limit, $offset) { 
    $this->db->select('
        quotations.id,
        quotations.item,
        quotations.quantity,
        quotations.description,
        quotations.price,
        quotations.requested_by,
        quotations.supplier_id,
        quotations.status,
        quotations.created_at as date,
        item_requisitions.id as req_id,
        item_requisitions.item_name,
        users.id as user_id,
        users.fullname,

        quotations_access.id as quot_id,
        quotations_access.quotation_id,
        quotations_access.read,

        suppliers.id as sup_id,
        suppliers.name as sup_name
        '); 
    $this->db->from('quotations');
    $this->db->join('users', 'quotations.requested_by = users.id', 'left');
    $this->db->join('suppliers', 'quotations.supplier_id = suppliers.id', 'left');
    $this->db->join('item_requisitions', 'quotations.item = item_requisitions.id', 'left');
    $this->db->join('quotations_access', 'quotations.id = quotations_access.quotation_id', 'left');

    $this->db->group_by('quotations.id');
    $this->db->limit($limit, $offset); 
    return $this->db->get()->result();
} 
// qutation list end
// vendor qutation form
public function VendorQuotation($id){
    // $id = base64_decode($id);

        $this->db->select('
            quotations.id as qut_id, 
            quotations.item,
            quotations.quantity,
            quotations.price,
            quotations.created_at as date, 
            quotations.requested_by,
            quotations.supplier_id,
            quotations.location_id,
            item_requisitions.id,
            item_requisitions.item_name,
            item_requisitions.item_qty,
            item_requisitions.location_id,
            item_requisitions.department_id,
            item_requisitions.company_id,
            locations.id as loc_id, 
            locations.name as loc_name,

            suppliers.id as sup_id,
            suppliers.name as sup_name,
            suppliers.email as sup_email,
            users.id as user_id, 
            users.fullname'
        ); 
        $this->db->from('quotations');
        $this->db->join('users', 'quotations.requested_by = users.id', 'left'); 
        $this->db->join('suppliers', 'quotations.supplier_id = suppliers.id', 'left'); 
        $this->db->join('item_requisitions', 'quotations.item = item_requisitions.id', 'left');
        $this->db->join('locations', 'quotations.location_id = locations.id', 'left');
        $this->db->where('quotations.id', $id);
        // echo "<pre>";
        // print_r($this->db->get()->row());exit;
        return $this->db->get()->row();
    }
// vendor qutation form end 

public function ForwardQuotation($id,$role_id, $data,$forward_request) {
    $this->db->where('quotation_id', $id);
    $this->db->where('role_id', $role_id);
    $this->db->update('quotations_access', $forward_request);

    $this->db->where('id', $id);
    $this->db->update('quotations', $data);
    return true;
}

// approved quotation  
 public function ApprovedQuotation($id, $data) {
    $this->db->where('id', $id);
    $this->db->update('quotations', $data);
    return true;
}
// Reject Quotation
public function RejectQuotation($id, $data) {
    $this->db->where('id', $id);
    $this->db->update('quotations', $data);
    return true;
}

}
