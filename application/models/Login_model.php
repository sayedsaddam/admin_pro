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
    public function signin($email, $password){
        $this->db->from('users');
        $this->db->where(array('email' => $email, 'password' => $password));
        return $this->db->get()->row();
    }
    // generate otp and verify login
    public function verify_credentials($email, $data){
        $this->db->where('email', $email);
        $this->db->update('users', $data);
        return true;
    }
    // verify otp and continue to login
    public function verify_and_login($otp){
        $this->db->from('users');
        $this->db->where(array('otp' => $otp, 'email' => $this->session->userdata('email')));
        return $this->db->get()->row();
    }
}
