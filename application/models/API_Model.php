<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class API_Model extends CI_Model{
    
    // Locations - Get all locations
    public function FetchLocations(){
        $this->db->from('locations');
        return $this->db->get()->result();
    }

    // Departments - Get all departments
    public function FetchDepartments(){
        $this->db->from('departments');
        return $this->db->get()->result();
    }
    
    // Departments - Get all departments
    public function FetchCompanies() {
        $this->db->from('company');
        return $this->db->get()->result();
    }

    // Access Configs - Fetch access configs => $user_role = {USER_SESSION - Role ID}
    public function FetchAccessConfigs($user_role) {
        $this->db->from('acl_configuration');
        $this->db->where('role_id', $user_role);
        return $this->db->get()->result();
    }

    // count request 
    public function CountRequest(){
        $this->db->from('item_requisitions'); 
        return $this->db->count_all_results();
    }
    // CountPendingRequest
    public function CountPendingRequest(){
        $this->db->from('item_requisitions'); 
        $role = $this->session->userdata('user_role');
        if ($role != '1' && $role != 3) {
        $this->db->where('requested_by', $this->session->userdata('id'));
        }
        $this->db->where('status', null);
        return $this->db->count_all_results();
    }
    // CountProcessRequest
    public function CountProcessRequest(){
        $this->db->from('item_requisitions');
        $role = $this->session->userdata('user_role');
        if ($role != '1' && $role != 3) {
            $this->db->where('requested_by', $this->session->userdata('id'));
            } 
        $this->db->where('status', 2);
        return $this->db->count_all_results();
    }
    // CountApprovedRequest
    public function CountApprovedRequest(){
        $this->db->from('item_requisitions');
        $role = $this->session->userdata('user_role');
        if ($role != '1' && $role != 3) {
            $this->db->where('requested_by', $this->session->userdata('id'));
            } 
        $this->db->where('status', 1); 
        return $this->db->count_all_results();
    }
       // CountRejectedRequest
       public function CountRejectedRequest(){
        $this->db->from('item_requisitions'); 
        $role = $this->session->userdata('user_role');
        if ($role != '1' && $role != 3) {
            $this->db->where('requested_by', $this->session->userdata('id'));
            }
        $this->db->where('status', 0); 
        return $this->db->count_all_results();
    }

    // count total assigned item
    public function CountTotalItem(){ 
        $this->db->from('item_assignment'); 
        $role = $this->session->userdata('user_role');
        if ($role != '1' && $role != 3) {
            $this->db->where('assignd_to', $this->session->userdata('id'));
            }
        return $this->db->count_all_results();
    }
// count assigned item
public function CountAssignedItem(){
    $this->db->from('item_assignment'); 
    $role = $this->session->userdata('user_role');
    if ($role != '1' && $role != 3) {
        $this->db->where('assignd_to', $this->session->userdata('id'));
        } 
    $this->db->where(array('status' => 1,'return_back_date' => null));
    return $this->db->count_all_results(); 
}

// count Returned item
public function CountReturnedItem(){
    $this->db->from('item_assignment'); 
    $role = $this->session->userdata('user_role');
    if ($role != '1' && $role != 3) {
        $this->db->where('assignd_to', $this->session->userdata('id'));
        } 
        // $this->db->where('status', 0); 
        $this->db->where('return_back_date !=' , NULL); 
 
    return $this->db->count_all_results(); 
}

}