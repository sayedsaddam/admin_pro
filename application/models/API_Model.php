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
    
}