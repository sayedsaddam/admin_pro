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
        $this->db->where('item_requisitions.requested_by' , $user);
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

        $this->db->order_by('item_requisitions.id', 'desc');
        $this->db->order_by('item_requisitions.status', '3');

        return $this->db->get()->result();
    } 

    // Approval list
    public function ApprovaltList($limit, $offset, $user,$role_id) {
        
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
        // echo $user_id;exit;
        $this->db->from('item_requisitions');
        $this->db->join('users', 'item_requisitions.requested_by = users.id', 'left');
        $this->db->join('request_access', 'users.user_role = request_access.role_id', 'left');
        // $this->db->where('request_access.role_id', $role_id); 
        $this->db->where('request_access.read', 1); 
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

}
