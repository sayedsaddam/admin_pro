<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Purchase extends CI_Controller{
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
//purchase product - purchase new product 
    public function purchase_product(){ 
        $data['title'] = 'Purchase Product';
        $data['body'] = 'admin/purchase/purchase-product';  
        $data['categories'] = $this->admin_model->get_item_categories();
        $data['supplier'] = $this->admin_model->get_item_supplier();
        $data['locations'] = $this->admin_model->get_item_location();
        $data['order'] = $this->admin_model->purchase_order_number(); 
        $this->load->view('admin/commons/template', $data);
    } 
    //Purchase order list 
    public function purchase_order_list($offset = null){ 
            $limit = 15;
            if(!empty($offset)){
            $this->uri->segment(3);
            }
        $url = 'admin/purchase_order_list';
        $rowscount = $this->admin_model->count_purchase();
        paginate($url, $rowscount, $limit);
        $data['title'] = 'Purchase Order List | Admin & Procurement';
        $data['body'] = 'admin/purchase/purchase_order_list';
        $data['items'] = $this->admin_model->purchase_order_list($limit, $offset);
        // print_r($data);exit;
        $this->load->view('admin/commons/template', $data);
    }
    // Add multiple Item into the database
    public function purchas(){   
        $id = $this->input->post('id'); 
        $item_name = $this->input->post('product_name[]');
        $quantity = $this->input->post('product_qty[]');
        $model = $this->input->post('model[]');
        $serial_number = $this->input->post('serial_number[]');
        $order_number = $this->input->post('order_number[]');
        $product_price = $this->input->post('product_price[]');
        $order_date = $this->input->post('order_date[]');
        $shipping = $this->input->post('shipping[]');
        $discount = $this->input->post('discountTotal[]');
        $amount = $this->input->post('total_val[]');
        $grand_total = $this->input->post('total[]');
        $data = array(
            'location_id' => $this->input->post('location'),
            'category_id' => $this->input->post('category'),  
            'sub_category_id' => $this->input->post('category'),  
            'supplier_id' => $this->input->post('supplier'), 
            'order_number' => $this->input->post('order_number'),
            'order_date' => $this->input->post('order_date'),
            'purchasedate' => $this->input->post('purchasedate'),  
            'created_at' => date('Y-m-d'), 
            'status' => 1,
        ); 
    foreach ($item_name as $key) {
            $multi_data = array(   
            'item_type' => $key->item_name,   
            'created_at' => date('Y-m-d'),  
            );
    } 
        if($this->admin_model->purchase_order_save($data,$multi_data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Order was created successfully.');
            redirect('admin/purchase_order_list');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again later.');
           redirect('admin/purchase_order_list');
        }
    } 
    public function purchase_order_save(){
            $data2 = array(); // quantity
            $data3 = array(); // product
            $data4 = array(); // supplier 
            foreach ($this->input->post('quantity') as $key2 => $value2) {
                if($value2 != ''){
                    array_push($data2, $value2); // array_push($data2, $value2);
                }
            } 
            foreach($this->input->post('product_name') as $key3 => $value3){
                if($value3 != ''){
                    array_push($data3, $value3);// array_push($data3, $value3);
                }
            } 
            $supplier = explode('/', $this->input->post('supplier')); 
            $supplier_email = $supplier[1];
            $data = array();
            // print_r($data4);exit;
            for($i = 0; $i < count($data3); $i++){ 
                $data[$i] = array(
                    'location_id' => $this->input->post('location'),  
                    'sub_category_id' => $data3[$i],
                    'order_number' => $this->input->post('order_number'),
                    'quantity' => $data2[$i],
                    'payment_mode' => $this->input->post('payment_mode'),
                    'requested_by' => 3, 
                    'created_at' => date('Y-m-d'), 
                    'status' => 0,
                    'supplier_id' =>  $supplier[0],
                ); 
            } 
            if($this->admin_model->purchase_order_save($data)){
                $this->session->set_flashdata('success', '<strong>Success! </strong>Order was created successfully.');
                $this->session->set_flashdata("email_send","Mail Send!"); 
                redirect('Purchase/purchase_order_list');
            }else{
                $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again later.');
                $this->session->set_flashdata("email_send","Something went wrong!");  
                redirect('admin/purchase_order_list');
            }
    }    
        public function add_qutation(){  
            $po_id = $this->input->post('purchase_id'); 
            $data = array(
            'po_id' => $this->input->post('purchase_id'), 
            'requested_by' => $this->input->post('requested_by'),  
            'supplier_id' => $this->input->post('supplier_id'),
            'price' => $this->input->post('price'), 
            'qutation' => $this->input->post('description'), 
            'created_at' => date('Y-m-d'),  
            ); 
            $pos_status = array(
                'status' => 1,  
                );  
            if($this->admin_model->add_qutation($po_id,$data,$pos_status)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>qutation was added successfully.');
            redirect($_SERVER['HTTP_REFERER']); 
            }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again later.');
            redirect($_SERVER['HTTP_REFERER']); 
            } 
        }  
    // edit order   
    public function edit_order($id){   
        // echo "edit called".$id;exit;
        $data['title'] = 'Purchase Product';
        $data['body'] = 'admin/purchase-product';  
        $data['edit'] = $this->admin_model->order_edit($id);
        $data['categories'] = $this->admin_model->get_item_categories();
        $data['supplier'] = $this->admin_model->get_item_supplier();
        $data['locations'] = $this->admin_model->get_item_location(); 
        $this->load->view('admin/commons/template', $data);
    }

    // Update an existing purchase record
    public function modify_purchase_order(){
        $id = $this->input->post('id');  
        $req_by = $this->session->userdata('id'); 
        $data = array(
            'location_id' => $this->input->post('location'),
            'category_id' => $this->input->post('category'),  
            'sub_category_id' => $this->input->post('sub_category'),  
            'supplier_id' => $this->input->post('supplier'), 
            'order_number' => $this->input->post('order_number'),
            'requested_by' => $req_by, 
            'created_at' => date('Y-m-d'), 
            'status' => 0,
        );   
         if($this->admin_model->modify_purchase_record($id, $data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Item was updated successfully.');
            redirect('admin/purchase_order_list');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again.');
            redirect('admin/purchase_order_list');
        }
    }
     //order detail  
        public function order_detail($id,$offset = null){  
                $limit = 15;
                if(!empty($offset)){
                $this->uri->segment(3);
                } 
        //  $id = $this->uri->segment(3);
         $url = 'admin/order-detail';
         $rowscount = $this->admin_model->count_item();
         paginate($url, $rowscount, $limit);
         $data['title'] = 'Order Detail | Admin & Procurement';
         $data['body'] = 'admin/purchase/order-detail';
         $data['items'] = $this->admin_model->order_detail_card($limit, $offset,$id); 
         $data['count_reult'] = $this->admin_model->count_result($id); 
         $data['count'] = $this->admin_model->count_qutation($id); 
         $data['item'] = $this->admin_model->get_item_card_detail($limit, $offset,$id); 
         $this->load->view('admin/commons/template', $data);
     }
       // Cancel - Cancel Order
    public function cancel_order($id){
            $data = array(   
            'status' => 0,
            'created_at' => date('Y-m-d')  
            );
        if($this->admin_model->cancel_order($id,$data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>order cancel successful.');
            redirect('admin/purchase_order_list');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect('admin/purchase_order_list');
        }
    }
       // Cancel - Cancel Order
       public function approved_order(){ 
        $id = $this->input->post('id');   
        $model_explode = explode('/', $id); 
        $qut_id =  $model_explode[0]; 
        $pos_id =  $model_explode[1]; 
                $data = array( 
                'remarks' => $this->input->post('remarks'),    
                'status' => 1,
                'created_at' => date('Y-m-d')  
                );  
                $pos_data = array(  
                'status' => 2, 
                'created_at' => date('Y-m-d'),  
                ); 
                $update_qut = array(  
                'status' => 'rejected',   
                ); 
        if($this->admin_model->approved_order($id,$pos_id,$data,$pos_data,$update_qut)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>order approved successful.');
            redirect($_SERVER['HTTP_REFERER']); 

        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect($_SERVER['HTTP_REFERER']); 
        }
    }
// Search purchase order - search order
public function search_purchase_item(){
    $search = $this->input->get('search');
    $data['title'] = 'Search Results > Suppliers';
    $data['body'] = 'admin/purchase/purchase_order_list';
    $data['results'] = $this->admin_model->search_purchase_item($search);
    $data['locations'] = $this->admin_model->list_locations_suppliers();
    $this->load->view('admin/commons/template', $data);
} 
// Get all suppliers based on city
public function get_location_suplier($loc_id){
       
    $get_location_suplier = $this->admin_model->get_location_suplier($loc_id);
    echo json_encode($get_location_suplier);
}   
    // 404 page.
    public function page_not_found(){
        echo "We're sorry but the page you're looking for could not be found.";
    }
}
