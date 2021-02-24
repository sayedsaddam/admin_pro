<?php

use function PHPSTORM_META\map;

defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Users extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }
    public function index(){
        $data['title'] = 'Dashboard | Admin & Procurement';
        $data['body'] = 'user/user_dashboard';
        $data['pending'] = $this->user_model->total_pending();
        $data['approved'] = $this->user_model->total_approved();
        $data['rejected'] = $this->user_model->total_rejected();
        $data['requisitions'] = $this->user_model->get_requisitions();
        $this->load->view('admin/commons/template', $data);
    }
    // Created requisition
    public function create_requisition(){
        $data = array(
            'item_name' => $this->input->post('item_name'),
            'item_desc' => $this->input->post('description'),
            'item_qty' => $this->input->post('quantity'),
            'requested_by' => $this->session->userdata('id')
        );
        if($this->user_model->create_requisition($data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Request submission was successful.');
            redirect('users');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>An error occured in request submission.');
            redirect('users');
        }
    }
}
