<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Finance extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	// finance dashboard
	public function index(){
		$data['title'] = 'Dashboard > Finance';
        $data['body'] = 'finance/dashboard';
        $this->load->view('admin/commons/template', $data);
	}
}
