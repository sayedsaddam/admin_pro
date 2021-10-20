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
        $data['login_page'] = true;
        $this->load->view('admin/commons/new_template', $data);
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
    // Check for credentials and log the user in.
    public function authenticate(){
        $otp = rand(0, 999999);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if($this->form_validation->run() == FALSE){
            $this->index();
        }else{
            $user_email = $this->input->post('email');
            $password = $this->input->post('password');
            $email = $this->db->select('email, password')->from('users')->where(array('email' => $user_email, 'password' => $password))->get()->row();
            if($email != NULL && $password != NULL){
                $data = array(
                'otp' => $otp
                );
                $this->login_model->verify_credentials($email->email, $data); // call the model method and update user otp.
                $this->load->library('email'); // Loading the email library.
                $this->email->from('no-reply@s2smark.com', 'S2S Marketing');
                $this->email->to($email->email);
                // $this->email->cc('another@another-example.com');
                // $this->email->bcc('them@their-example.com');
                $this->email->subject('Security code');
                $this->email->message("Your verification code is " .$otp.". Share with none in order to stay secure. S2S Marketing Pvt. Ltd.");
                $this->email->send();
                $this->session->set_flashdata('otp_sent', '<strong>Information! </strong>A 6 digit code has been sent to your email. Please check your email and return to login.');
                redirect('login/verify_credentials');
            }else{
                $this->session->set_flashdata('not_found', '<strong>Uh oh! </strong>The email or username you entered does not exist on our database. Trying another one might help.');
                redirect($_SERVER['HTTP_REFERER']);
                exit;
            }
        } 
    }
    // load verification page for OTP.
    public function verify_credentials(){
        $data['title'] = 'Login | Operations Dept';
        $data['body'] = 'verify-otp';
        $data['login_page'] = true;
        $this->load->view('admin/commons/new_template', $data);
    }
    // Logout - Terminate session and log the user out.
    public function verify_and_login(){ 
        $otp = $this->input->post('otp');
        $login = $this->login_model->verify_and_login($otp);
        if($login > '0'){
            $id = $login->id;
            $username = $login->username;
            $name = $login->fullname;
            $department = $login->department;
            $location = $login->location;
            $user_role = $login->user_role;
            $this->session->set_userdata(array('id' => $id, 'username' => $username, 'fullname' => $name, 'department' => $department, 'location' => $location, 'user_role' => $user_role));
            redirect('admin/item_register');
        }else{
            $this->session->set_flashdata('login_failed', "<strong>Oops! </strong>Looks like that's not the code we sent you. Try again!");
            $this->verify_credentials();
        }
    }
    public function logout(){
        $this->session->sess_destroy();
        $this->index();
    }
}
