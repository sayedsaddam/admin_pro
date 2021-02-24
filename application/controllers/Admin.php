<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Admin extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('admin_model');
        $this->load->model('user_model');
    }
    public function index(){
        $data['title'] = 'Home | Admin & Procurement';
        $data['body'] = 'admin/dashboard';
        $data['pending'] = $this->user_model->total_pending();
        $data['approved'] = $this->user_model->total_approved();
        $data['rejected'] = $this->user_model->total_rejected();
        $data['pending_requisitions'] = $this->admin_model->pending_requisitions();
        $data['approved_requisitions'] = $this->admin_model->approved_requisitions();
        $data['rejected_requisitions'] = $this->admin_model->rejected_requisitions();
        $this->load->view('admin/commons/template', $data);
    }
}
