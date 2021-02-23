<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Login_model extends CI_Model{
    function __construct()
    {
        parent::__construct();
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
    // Signin - Check for user credentials and login to the system.
    public function signin($username, $password){
        $this->db->select('id, fullname, username, password, location, user_role');
        $this->db->from('users');
        $this->db->where(array('username' => $username, 'password' => $password));
        return $this->db->get()->row();
    }
}
