<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Login_model extends CI_Model{
    function __construct()
    {
        parent::__construct();
    }
    // Get all users where role is supervisor.
    public function get_supervisors(){
        $this->db->select('id, fullname, user_role');
        $this->db->from('users');
        $this->db->where('user_role', 'supervisor');
        return $this->db->get()->result();
    }
    // Get all locations.
    public function get_locations(){
        return $this->db->get('locations')->result();
    }
    // Sign up - Created new user account.
    public function signup($data){
        $this->db->insert('users', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    // Signin - Check for user credentials and login to the system. > This table will no hold all employees data.
    public function signin($username, $password){
        $this->db->select('id, fullname, email, username, department, password, location, user_role, grader');
        $this->db->from('users');
        $this->db->where(array('username' => $username, 'password' => $password));
        return $this->db->get()->row();
    }
    // Edit user
    public function edit_user($id){
        $this->db->select('id, fullname, email, username, department, supervisor, password, location, user_role, grader');
        $this->db->from('users');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }
    // Update user
    public function update_user($id, $data){
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        return true;
    }
}
