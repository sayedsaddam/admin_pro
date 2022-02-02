<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */

class api extends CI_Controller{

    // Default constructor for Controller.
    function __construct() {
        parent::__construct();
        $this->load->model('ML_model');
    }
    
}