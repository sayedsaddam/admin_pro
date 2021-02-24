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
        $this->load->view('admin/commons/template', $data);
    }
    // Register/created new user.
    public function register(){
        $data = array(
            'fullname' => $this->input->post('fullname'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => sha1($this->input->post('password')),
            'location' => $this->input->post('location'),
            'user_role' => $this->input->post('user_role')
        );
        if($this->login_model->signup($data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>User registration was successful. Now you can use your credentials to login to the system.');
            redirect('login');
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
            $this->session->set_userdata(array('id' => $id, 'username' => $username, 'fullname' => $name, 'location' => $location, 'user_role' => $role));
            if($this->session->userdata('user_role') == 'admin'){
                redirect('admin');
            }elseif($this->session->userdata('user_role') == 'user'){
                redirect('users');
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
