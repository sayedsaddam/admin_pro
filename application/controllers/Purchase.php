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
        $this->load->model('purchase_model');
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
        $data['categories'] = $this->purchase_model->get_item_categories();
        $data['supplier'] = $this->admin_model->get_item_supplier();
        $data['locations'] = $this->purchase_model->get_item_location();
        $data['order'] = $this->purchase_model->purchase_order_number(); 
        $this->load->view('admin/commons/new_template', $data);
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
        $data['items'] = $this->purchase_model->purchase_order_list($limit, $offset);
        $data['locations'] = $this->purchase_model->list_locations_suppliers();
        // print_r($data);exit;
        $this->load->view('admin/commons/new_template', $data);
    }
    // get_supplier against location 
    public function supplier_against_location($loc_id){
        $location = $this->admin_model->supplier_against_location($loc_id);
        echo json_encode($location);
    }
       //Purchase order forwaded to supplier list
       public function pos(){  
    $data['title'] = 'Purchase Order List | Admin & Procurement';
    $data['body'] = 'admin/purchase/pos';
    $data['items'] = $this->purchase_model->pos();
    $data['locations'] = $this->purchase_model->list_locations_suppliers(); 
    $this->load->view('admin/commons/new_template', $data);
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
        if($this->purchase_model->purchase_order_save($data,$multi_data)){
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
            // $supplier = explode('/', $this->input->post('supplier')); 
            // $supplier_email = $supplier[1];
            $data = array();
            // print_r($data4);exit;
            for($i = 0; $i < count($data3); $i++){ 
                $data[$i] = array(
                    'location_id' => $this->input->post('location'),  
                    'sub_category_id' => $data3[$i],
                    'description' => $this->input->post('description'),
                    'quantity' => $data2[$i], 
                    'requested_by' => $this->session->userdata('id'), 
                    'created_at' => date('Y-m-d'), 
                    'status' => 0,
                    // 'supplier_id' =>  $supplier[0],
                ); 
            } 
            if($this->purchase_model->purchase_order_save($data)){
                $this->session->set_flashdata('success', '<strong>Success! </strong>Order was created successfully.');
                $this->session->set_flashdata("email_send","Mail Send!"); 
                redirect('Purchase/purchase_order_list');
            }else{
                $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again later.');
                $this->session->set_flashdata("email_send","Something went wrong!");  
                redirect('admin/purchase_order_list');
            }
    }    
    // select supplier against location for purchase form
    public function po_supplier($id){  
        $po = $this->purchase_model->po_supplier($id);
        echo json_encode($po);
    } 
    // pos
        // send email to suppier -- also update supplier id in purchase table
        public function po_supplier_order(){
            $id = $this->input->post('purchaseid'); 
            $supplier = $this->input->post('supplier'); 
            $po = $this->purchase_model->po_data($id); 
            $product = $po->sub_category_id;
            $quantity = $po->quantity;
            $location = $po->location_id;
            $description = $po->description;
            // echo $location;exit;
// get supplier email 
            $email = $this->purchase_model->supplier_email($supplier); 
            $sup_email = $email->email;  
// send email code
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|callback_check_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required'); 
                //   below email code check and work
                    $from_email = "no-reply@alhayyatgroup.com";
                    $to_email = $sup_email; 
                    $product = $product;
                    $quantity = $quantity;; 
                    $description = $description;  
                    $this->load->library("email");
                    $this->email->from($from_email,"AH Group");
                    $this->email->to($to_email);
                    $this->email->subject("Product Requisition");
                    $this->email->message("office of Islamabad request for ".' '.$product.' - '.$quantity.'quantity'.'<br> Remarks :'.$description);

            $data = array(   
                'purchase_id' => $id,    
                'supplier_id' => $supplier,    
                'location' => $location,    
                'product' => $product,
                'quantity' => $quantity,   
                'description' => $description,
                'requested_by' => $this->session->userdata('id'), 
                'status' => 0, 
                'created_at' => date('Y-m-d'),  
            );   
             if($this->purchase_model->po_forwarded($data)){
                $this->session->set_flashdata('success', '<strong>Success! </strong>Product was forwaded successfully.');
                redirect('Purchase/purchase_order_list');

            }else{
                $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again.');
                redirect('Purchase/purchase_order_list');
            }
        }
        public function add_qutation(){  
            $po_id = $this->input->post('purchase_id'); 
            $po_id = $this->input->post('purchase_id');

            $id_explode = explode('/', $po_id); 
            $purchase_id =  $id_explode[0]; 
            $sup_id =  $id_explode[1];  
            $data = array(
            'po_id' => $purchase_id, 
            'requested_by' => $this->session->userdata('id'),  
            'supplier_id' => $sup_id,
            'price' => $this->input->post('price'), 
            'qutation' => $this->input->post('description'), 
            'created_at' => date('Y-m-d'),  
            ); 
            $pos_status = array(
                'status' => 1,  
                );  
            if($this->purchase_model->add_qutation($po_id,$data,$pos_status)){
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
        $data['edit'] = $this->purchase_model->order_edit($id);
        $data['categories'] = $this->purchase_model->get_item_categories();
        $data['supplier'] = $this->purchase_model->get_item_supplier();
        $data['locations'] = $this->purchase_model->get_item_location(); 
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
         if($this->purchase_model->modify_purchase_record($id, $data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>Item was updated successfully.');
            redirect('purchase/purchase_order_list');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again.');
            redirect('purchase/purchase_order_list');
        }
    }
     //order detail  
        public function order_detail($id){ 
        // echo $id;exit; 
        //  $id = $this->uri->segment(3);
         $url = 'admin/order-detail';
         $data['title'] = 'Order Detail | Admin & Procurement';
         $data['body'] = 'admin/purchase/order-detail';
         $data['items'] = $this->purchase_model->order_detail_card($id); 
         $data['ids'] = $this->purchase_model->supplier_id($id); 
         $data['order'] = $this->purchase_model->order_detail($id); 
         $data['count_reult'] = $this->purchase_model->count_result($id); 
         $data['count'] = $this->purchase_model->count_qutation($id); 
         $data['item'] = $this->purchase_model->get_item_card_detail($id); 
         $this->load->view('admin/commons/template', $data);
        // redirect($_SERVER['HTTP_REFERER']); 

     }
       // Cancel - Cancel Order
    public function cancel_order($id){
            $data = array(   
            'review' => 0,
            'created_at' => date('Y-m-d')  
            );
        if($this->purchase_model->cancel_order($id,$data)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>order cancel successful.');
            redirect('purchase/purchase_order_list');
        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect('purchase/purchase_order_list');
        }
    }
       // Cancel - Cancel Order
       public function approved_po($id){
        $data = array(   
        'review' => 1,
        'created_at' => date('Y-m-d')  
        );
    if($this->purchase_model->approved_po($id,$data)){
        $this->session->set_flashdata('success', '<strong>Success! </strong>order cancel successful.');
        redirect('purchase/purchase_order_list');
    }else{
        $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
        redirect('purchase/purchase_order_list');
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
        if($this->purchase_model->approved_order($id,$pos_id,$data,$pos_data,$update_qut)){
            $this->session->set_flashdata('success', '<strong>Success! </strong>order approved successful.');
            redirect($_SERVER['HTTP_REFERER']); 

        }else{
            $this->session->set_flashdata('failed', '<strong>Failed! </strong>Something went wrong, please try again!');
            redirect($_SERVER['HTTP_REFERER']); 
        }
    }
    // Search filters - po reports
    public function po_report($offset = null){ 
        $limit = 10;
        if(!empty($offset)){
            $config['uri_segment'] = 3;
        }
        $date_from = $this->input->get('from_date');
        $date_to = $this->input->get('to_date'); 
        $this->load->library('pagination');
        $url = 'admin/purchase_order_list';
        $rowscount = $this->purchase_model->count_po_date($date_from, $date_to);

        $config['base_url'] = $url;
        $config['total_rows'] = $rowscount;
        $config['per_page'] = $limit;
        $config['cur_tag_open'] = '<a class="pagination-link has-background-success has-text-white" aria-current="page">';
        $config['cur_tag_close'] = '</a>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_open'] = '</li>';
        $config['first_link'] = 'First';
        $config['prev_link'] = 'Previous';
        $config['next_link'] = 'Next';
        $config['last_link'] = 'Last';
        $config['attributes'] = array('class' => 'pagination-link');
        $config['reuse_query_string'] = true;

        $this->pagination->initialize($config);
        
        $data['title'] = 'Po Report Results > Report';
        $data['product_report'] = true;
        
        $data['body'] = 'admin/purchase/purchase_order_list';
        $data['items'] = $this->purchase_model->purchase_order_list($limit, $offset,$date_from, $date_to); 
        $this->load->view('admin/commons/new_template', $data);
    } 
    // reports code end
// Search purchase order - search order
public function search_purchase_item(){
    $search = $this->input->get('search');
    $data['title'] = 'Search Results > Suppliers';
    $data['body'] = 'admin/purchase/purchase_order_list';
    $data['results'] = $this->purchase_model->search_purchase_item($search);
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
