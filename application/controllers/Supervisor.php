<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Supervisor extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('supervisor_model');
    }
    public function index(){
        $data['title'] = 'Supervisor Dashboard | Admin & Procurement';
        $data['body'] = 'supervisor/dashboard';
        $data['leaves'] = $this->supervisor_model->get_leave_applications();
        $this->load->view('admin/commons/template', $data);
    }
}
