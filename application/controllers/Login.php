<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Login extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('admin_model');
    }
    public function index(){
        $data['title'] = 'Login | Admin & Procurement';
        $data['body'] = 'login';
        $this->load->view('admin/commons/template', $data);
    }
    // Sign up form
    public function signup(){
        $data['title'] = 'Sign Up | Admin & Procurement';
        $data['body'] = 'signup';
        $data['supervisors'] = $this->login_model->get_supervisors();
        $data['locations'] = $this->login_model->get_locations();
        $this->load->view('admin/commons/template', $data);
    }
    // Register/created new user.
    public function register(){
        $data = array(
            'fullname' => $this->input->post('fullname'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => sha1($this->input->post('password')),
            'department' => $this->input->post('department'),
            'location' => $this->input->post('location'),
            'user_role' => $this->input->post('user_role'),
            'supervisor' => $this->input->post('supervisor')
        );
        if($this->login_model->signup($data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>User registration was successful. Now you can use your credentials to login to the system.');
            redirect('admin/users');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again.');
            redirect('login/signup');
        }
    }
    // Edit user.
    public function edit_user($id){
        $data['title'] = 'Edit User | Admin & Procurement';
        $data['body'] = 'signup';
        $data['supervisors'] = $this->login_model->get_supervisors();
        $data['locations'] = $this->login_model->get_locations();
        $data['edit'] = $this->login_model->edit_user($id);
        $this->load->view('admin/commons/template', $data);
    }
    // Update user
    public function update_user(){
        $id = $this->input->post('user_id');
        $data = array(
            'fullname' => $this->input->post('fullname'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'department' => $this->input->post('department'),
            'location' => $this->input->post('location'),
            'user_role' => $this->input->post('user_role'),
            'supervisor' => $this->input->post('supervisor')
        );
        if($this->login_model->update_user($id, $data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Updating user was successful.');
            redirect('admin/users');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again.');
            redirect('login/signup');
        }
    }
    // Check for credentials and log the user in.
    public function authenticate(){
        $username = $this->input->post('username');
        $password = sha1($this->input->post('password'));
        $login = $this->login_model->signin($username, $password);
        if($login > '0'){
            $id = $login->id;
            $username = $login->username;
            $name = $login->fullname;
            $location = $login->location;
            $role = $login->user_role;
            $department = $login->department;
            $this->session->set_userdata(array('id' => $id, 'username' => $username, 'fullname' => $name, 'location' => $location, 'user_role' => $role, 'department' => $department));
            if($this->session->userdata('user_role') == 'admin'){
                redirect('admin');
            }elseif($this->session->userdata('user_role') == 'user'){
                redirect('users');
            }elseif($this->session->userdata('user_role') == 'supervisor'){
                redirect('supervisor');
            }elseif($this->session->userdata('user_role') == 'finance'){
				redirect('finance');
			}
        }else{
            $this->session->set_flashdata('login_failed', "<strong>Oops! </strong>Something went wrong but don't fret, let's give it another shot.");
            redirect('login');
        }
    }
    // Logout - Terminate session and log the user out.
    public function logout(){
        $this->session->sess_destroy();
        $this->index();
    }
}
