<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Item_assignment extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('admin_model');
        $this->load->model('user_model');
        $this->load->model('supervisor_model');
        $this->load->helper('paginate');
        if(!$this->session->userdata('username') || $this->session->userdata('user_role') != 'admin'){
            redirect('');
        }
    }
    //Item register 
    public function item_register($offset = null){ 
            $limit = 15;
            if(!empty($offset)){
            $this->uri->segment(3);
            }
        $url = 'admin/item_register';
        $rowscount = $this->admin_model->count_item();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Item Register | Admin & Procurement';
        $data['body'] = 'admin/item_assignment/item-register';
        $data['items'] = $this->admin_model->get_items($limit, $offset); 
        $this->load->view('admin/commons/template', $data);
    }
  //Available Item list
  public function available_item_list($offset = null){ 
        $limit = 15;
        if(!empty($offset)){
        $this->uri->segment(3);
        }
    $url = 'admin/item_register';
    $rowscount = $this->admin_model->count_item();
    paginate($url, $rowscount, $limit);
    $data['title'] = 'Item Register | Admin & Procurement';
    $data['body'] = 'admin/item_assignment/item-register';
    $data['items'] = $this->admin_model->get_available_items($limit, $offset); 
    $this->load->view('admin/commons/template', $data);
}
//Assign item list
   public function get_assign_item($offset = null){  
        $limit = 15;
        if(!empty($offset)){
        $this->uri->segment(3);
        }
    $url = 'admin/assign-list';
    $rowscount = $this->admin_model->count_assign_item();
    paginate($url, $rowscount, $limit);
    $data['title'] = 'Item Register | Admin & Procurement';
    $data['body'] = 'admin/item_assignment/assign-list';
    $data['items'] = $this->admin_model->assign_item_list($limit, $offset); 
    $this->load->view('admin/commons/template', $data);
}


    //Assign item 
       public function assign_list($offset = null){ 
            $limit = 15;
            if(!empty($offset)){
            $this->uri->segment(3);
            }
        $url = 'admin/item_register';
        $rowscount = $this->admin_model->count_item();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Item Register | Admin & Procurement';
        $data['body'] = 'admin/item_assignment/assign-list';
        $data['items'] = $this->admin_model->assign_list($limit, $offset); 
        $this->load->view('admin/commons/template', $data);
    }
    // item register - add new item.
    public function add_item(){
        $data['title'] = 'Item Detail';
        $data['body'] = 'admin/item_assignment/item-detail';  
        $data['categories'] = $this->admin_model->get_item_categories();
        $data['supplier'] = $this->admin_model->get_item_supplier();
        $data['locations'] = $this->admin_model->get_item_location(); 
        $this->load->view('admin/commons/template', $data);
    }
    // Add new Item into the database
    public function item_save(){  
        $model = $this->input->post('model');
        $result = $this->input->post('type_name');  
        $data = array(
            'location' => $this->input->post('location'),
            'category' => $this->input->post('category'),
            'sub_category' => $this->input->post('sub_category'),
            'type_name' => $this->input->post('type_name'),
            'status' => $this->input->post('status'),
            'quantity' => $this->input->post('quantity'),
            'model' => $this->input->post('model'),
            'serial_number' => $this->input->post('serial_number'),
            'supplier' => $this->input->post('supplier'),
            'price' => $this->input->post('price'),
            'stat' => 0,
            'purchasedate' => $this->input->post('purchasedate'),
            'depreciation' => $this->input->post('depreciation'), 
            'created_at' => date('Y-m-d')
        ); 
        if($this->admin_model->item_save($data,$model)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Item was added successfully.');
            redirect('admin/item_register');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again later.');
            redirect('admin/item_register');
        }
    }
    // Update an existing asset record
    public function modify_item(){
        $id = $this->input->post('id'); 
        $data = array(
            'location' => $this->input->post('location'),
            'category' => $this->input->post('category'),
            'sub_category' => $this->input->post('sub_category'),
            'type_name' => $this->input->post('type_name'),
            'model' => $this->input->post('model'),
            'serial_number' => $this->input->post('serial_number'),
            'supplier' => $this->input->post('supplier'),
            'price' => $this->input->post('price'),
            'purchasedate' => $this->input->post('purchasedate'),
            'depreciation' => $this->input->post('depreciation'), 
            'created_at' => date('Y-m-d')
        );
        if($this->admin_model->modify_item($id, $data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Item was updated successfully.');
            redirect('admin/item_register');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again.');
            redirect('admin/item_register');
        }
    }
    // Item detail
    public function item_detail($id){   
        $data['title'] = 'Item Detail';
        $data['body'] = 'admin/item_assignment/item-detail';
        $data['edit'] = $this->admin_model->item_detail($id);
        $data['categories'] = $this->admin_model->get_item_categories();
        $data['sub_categories'] = $this->admin_model->get_item_sub_category();    
        $data['supplier'] = $this->admin_model->get_item_supplier();
        $data['locations'] = $this->admin_model->get_item_location();
        $data['depreciation'] = $this->admin_model->get_item_depreciation($id);
        $data['status'] = $this->admin_model->status_items($id); 
        $this->load->view('admin/commons/template', $data);
    }
     // Get all sub categories based on cat_id of items
    public function get_item_sub_categories($cat_id){
        $sub_categories = $this->admin_model->get_item_sub_categories($cat_id);
        echo json_encode($sub_categories);
    }
    // Search filters - search asset register
    public function search_item(){
        $search = $this->input->get('search'); 
        $data['title'] = 'Search Results > Item List';
        $data['body'] = 'admin/item_assignment/item-register'; 
        $data['results'] = $this->admin_model->search_items($search);
        $this->load->view('admin/commons/template', $data);
    }
    // Delete item
    public function delete_item($id){
        if($this->admin_model->delete_item($id)){
            $this->session->set_flashdata('success', '<strong>Delete! </strong>Item was deleted successfully.');
            redirect('admin/asset_register');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect('admin/asset_register');
        }
    }
     // Assignment Item List- 
     public function assign_item_list($offset = null){
            $limit = 15;
            if(!empty($offset)){
            $this->uri->segment(3);
            } 
        $url = 'admin/assign_item_list';
        $rowscount = $this->admin_model->count_item_assign();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Assign Item list';
        $data['body'] = 'admin/item_assignment/assign-item-list'; 
        $data['items'] = $this->admin_model->check_assign_list($limit, $offset); 
        $this->load->view('admin/commons/template', $data);
    }
      // Assignment Item form- To employ
      public function assign_item(){
        $id = $this->uri->segment(3);
        $data['title'] = 'Assign Item';
        $data['body'] = 'admin/item_assignment/assign-item'; 
        $data['assign_to'] = $this->admin_model->assign_to();
        $data['assign_by'] = $this->admin_model->assign_by(); 
        $data['get_item'] = $this->admin_model->get_item();  
        $data['get_model'] = $this->admin_model->get_model(); 
        $data['get_category'] = $this->admin_model->get_category(); 
        $data['locations'] = $this->admin_model->get_item_location(); 
        $data['returning_items'] = $this->admin_model->returning_assignment_list($id); 
        $this->load->view('admin/commons/template', $data);
    }
        // assign_item_save into the database
        public function assign_item_save(){  
        $item_id = $this->input->post('item_id');   
        $assign = $this->input->post('employ');   
        if(!empty($assign)){
        $data = array(
            'assignd_to' => $this->input->post('employ'),
            'item_id' => $this->input->post('item_id'),   
            'quantity' => 1,  
            'status' => 1,  
            'created_at' => date('Y-m-d'),
        );
        $invantory = array( 
            'status' => 1,   
        );
        $item = array( 
            'stat' => 0,   
        );
        $return_back = array( 
            'return_back_date' => null,   
        );
        } 
        if($this->admin_model->assign_item_save($data,$item,$invantory,$item_id)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Item was assignd successfully.');
            redirect('admin/item_register');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again later.');
            redirect('admin/item_register');
        }
        }
        // assign_item_save into the database
        public function return_item(){ 
        $id = $this->input->post('id'); 
         $model_explode = explode('/', $id); 
        $assign_item_id =  $model_explode[0]; 
        $item_id =  $model_explode[1];
        $remarks = $this->input->post('remarks'); 
        $description = $this->input->post('description');
        $file = $this->input->post('userfile'); 
        $config['upload_path']   = './upload/'; 
        $config['allowed_types'] = 'gif|jpg|png';  
        $this->load->library('upload', $config); 
      
        if ( ! $this->upload->do_upload('userfile')) { 
           $error = array('error' => $this->upload->display_errors()); 
           $this->load->view('upload_form', $error); 
        }
        else {   
          
           $datas = $this->upload->data(); 
           $fileUpload = $datas['file_name'];  
            $data = array(   
                'remarks' => $remarks,
                'item_file' => $fileUpload,
                'returning_description' => $description, 
                'status' => 0,  
                'return_back_date' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            );  
            $invantory = array( 
                'status' => 0,   
            );
             $item = array( 
                'stat' => 1,   
            ); 
            if($this->admin_model->return_item_save($data,$invantory,$item,$item_id,$assign_item_id)){
                $this->session->set_flashdata('success', '<strong>Success! </strong>Item was return back successfully.');
                redirect('admin/item_register');
            }else{
                $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again later.');
                redirect('admin/item_register');
            } 
        }
        } 
    // Search filters - search asset register
    public function search_assign_items(){
        $search = $this->input->get('search'); 
        $data['title'] = 'Search Results > Assign Item';
        $data['body'] = 'admin/item_assignment/assign-item-list'; 
        $data['results'] = $this->admin_model->search_assign_item($search);
        $this->load->view('admin/commons/template', $data);
    }   
     // Get all suppliers based on city
     public function get_assign_category($loc_id){
        $get_assign_category = $this->admin_model->get_assign_category($loc_id);
        echo json_encode($get_assign_category);
    }  
    // Get all suppliers based on city
    public function get_location_employ($loc_id){
        $get_location_employ = $this->admin_model->get_location_employ($loc_id);
        echo json_encode($get_location_employ);
    }  
    // Get all suppliers based on city
    public function get_location_suplier($loc_id){
        $get_location_suplier = $this->admin_model->get_location_suplier($loc_id);
        echo json_encode($get_location_suplier);
    }   
    // Get all suppliers based on city
    public function get_suplier_email($loc_id){
        $get_suplier_email = $this->admin_model->get_suplier_email($loc_id);
        echo json_encode($get_suplier_email);
    }  
    // Get all item type based on item
    public function get_item_type($item_id){ 
        $get_item_type = $this->admin_model->get_item_type($item_id);
        echo json_encode($get_item_type);
    }  
    // Get item model against item type
    public function get_item_model($item_type){ 
        $get_item_model = $this->admin_model->get_item_model($item_type);
        echo json_encode($get_item_model);
    }
     // Get assign item data against employ
     public function get_employ_data($data){   
        $get_employ_data = $this->admin_model->get_employ_data($data);
        echo json_encode($get_employ_data);
    } 
    // Get item model against item type
    public function get_item_serial_umber($id){
   
        $get_item_serial_umber = $this->admin_model->get_item_serial_umber($id);
        echo json_encode($get_item_serial_umber);
    }    
    //Item card   
    public function item_card($id,$offset = null){   
        $limit = 15;
     if(!empty($offset)){
         $this->uri->segment(3);
     }
     $url = 'admin/item_register';
     $rowscount = $this->admin_model->count_item();
     paginate($url, $rowscount, $limit);
     $data['title'] = 'Item Register | Admin & Procurement';
     $data['body'] = 'admin/item_assignment/item-card';
     $data['items'] = $this->admin_model->get_item_card($limit, $offset,$id); 
     $data['item'] = $this->admin_model->get_item_card_detail($limit, $offset,$id); 
     $this->load->view('admin/commons/template', $data);
 }  
    // 404 page.
    public function page_not_found(){
        echo "We're sorry but the page you're looking for could not be found.";
    }
}
