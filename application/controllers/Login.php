<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Login extends CI_Controller{
    function __construct()
    {
        parent::__construct();
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
}
