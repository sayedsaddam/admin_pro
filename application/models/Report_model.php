<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Report_model extends CI_Model{
    public function UserRoles() {
        $this->db->from('users_roles');
        return $this->db->get()->result();
    }

// ************************ all report start below *********************** 
 // Search filters - Asset search 
 public function filter_asset($limit, $offset,$data){
    $this->db->select('assets.id,
    assets.category,
    assets.quantity, 
    assets.purchase_date, 
    assets.location, 
    assets.sub_categories, 
    assets.price,  
    assets.user,  
    assets.created_at,
    categories.id as cat_id,
    categories.cat_name,
    locations.id as loc_id,
    locations.name as loc_name');
    $this->db->from('assets');
    $this->db->join('categories', 'assets.category = categories.id', 'left'); 
    $this->db->join('locations', 'assets.location = locations.id', 'left'); 
    if ($this->session->userdata('user_role') != '1') {
        $this->db->where('assets.location', $this->session->userdata('location'));
    } 
    if($data['category'] != null){
    $this->db->where('category', $data['category']); 
}
if($data['sub_categories'] != null) {
    $this->db->where('sub_categories', $data['sub_categories']); 
}
if($data['price'] != null) {
    $this->db->where('price', $data['price']); 
}
if($data['purchase_date'] != null) {
    $this->db->where('purchase_date', $data['purchase_date']);
}
if($data['location'] != null) {
    $this->db->where('location', $data['location']); 
}
if($data['quantity'] != null) {
    $this->db->where('quantity', $data['quantity']); 
} 
$this->db->limit($limit, $offset);
return $this->db->get()->result();

}
// count filter asset
public function count_filter_assets($data){ 
    $this->db->select('assets.id,
    assets.category,
    assets.quantity,
    assets.purchase_date, 
    assets.location, 
    assets.sub_categories, 
    assets.price,
    assets.user, 
    assets.created_at');
    $this->db->from('assets'); 
    if ($this->session->userdata('user_role') != '1') {
        $this->db->where('assets.location', $this->session->userdata('location'));
    } 
    if($data['category'] != null){
    $this->db->where('category', $data['category']); 
    }
    if($data['sub_categories'] != null) {
        $this->db->where('sub_categories', $data['sub_categories']); 
    }
    if($data['price'] != null) {
        $this->db->where('price', $data['price']); 
    }
    if($data['purchase_date'] != null) {
        $this->db->where('purchase_date', $data['purchase_date']);
    }
    if($data['location'] != null) {
        $this->db->where('location', $data['location']); 
    }
    if($data['quantity'] != null) {
        $this->db->where('quantity', $data['quantity']);  
    }
        return $this->db->count_all_results();
    }

// filter supplier 
  public function filter_supplier($limit, $offset,$data){ 
    $this->db->select('suppliers.id, suppliers.name,suppliers.email, suppliers.phone, suppliers.location,suppliers.ntn_number,suppliers.category,suppliers.rating, suppliers.region, suppliers.created_at,locations.id as loc_id,locations.name as loc_name');
    $this->db->from('suppliers');
    $this->db->join('locations', 'suppliers.location = locations.id', 'left'); 
    
    if($data['name'] != null){
        $this->db->where('suppliers.name', $data['name']);
    }

    if($data['category'] != null){
        $this->db->where('category', $data['category']);
    }

    if($data['email'] != null){
        $this->db->where('email', $data['email']);
    }

    if($data['phone'] != null){
        $this->db->where('phone', $data['phone']);
    }

    if($data['location'] != null){
        $this->db->where('location', $data['location']);
    }

    if($data['ntn_number'] != null){
        $this->db->where('ntn_number', $data['ntn_number']);
    }

    if($data['rating'] != null){
        $this->db->where('rating', $data['rating']);
    }
    $this->db->limit($limit, $offset);
    return $this->db->get()->result();
}
// count filter suppler
public function count_filter_suppliers($data){ 
    $this->db->select('id, name,email, phone, location,ntn_number,category,rating, region,created_at');
    $this->db->from('suppliers'); 
    
    if($data['name'] != null){
        $this->db->where('name', $data['name']);
    }

    if($data['category'] != null){
        $this->db->where('category', $data['category']);
    }

    if($data['email'] != null){
        $this->db->where('email', $data['email']);
    }

    if($data['phone'] != null){
        $this->db->where('phone', $data['phone']);
    }

    if($data['location'] != null){
        $this->db->where('location', $data['location']);
    }

    if($data['ntn_number'] != null){
        $this->db->where('ntn_number', $data['ntn_number']);
    }

    if($data['rating'] != null){
        $this->db->where('rating', $data['rating']);
    } 
    return $this->db->count_all_results();
}
     // Filter employee
     public function filter_employee($limit, $offset,$data){
        $this->db->select('users.id as emp_id, users.fullname as emp_name,
                           users.doj, users.email,users.department, 
                           users.phone, users.location,
                           users.address, users.status, 
                           users.created_at,locations.id,locations.name,
                           locations.id as loc_id,
                           locations.name as loc_name,
                           departments.id as dep_id,
                           departments.department as dep_name');
        $this->db->from('users');
        $this->db->join('locations', 'users.location = locations.id', 'left');
        $this->db->join('departments', 'users.department = departments.id', 'left');
        
        if($data['fullname'] != null){
            $this->db->where('fullname', $data['fullname']);
        }  
        if($data['user_name'] != null){
            $this->db->where('username', $data['user_name']);
        }
        if($data['doj'] != null){
            $this->db->where('doj', $data['doj']);
        }
        if($data['dob'] != null){
            $this->db->where('dob', $data['dob']);
        }
        if($data['email'] != null){
            $this->db->where('email', $data['email']);
        }
        if($data['department'] != null){ 
            $this->db->where('department', $data['department']);
        }
        if($data['phone'] != null){
            $this->db->where('phone', $data['phone']);
        }
        if($data['location'] != null){
            $this->db->where('location', $data['location']);
        } 
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
    // count filter employee
  public function count_filter_employee($data){
    $this->db->select('id,fullname,doj,email,department,phone,location,address,status,created_at');
    $this->db->from('users'); 
    
    if($data['fullname'] != null){
        $this->db->where('fullname', $data['fullname']);
    }  
    if($data['user_name'] != null){
        $this->db->where('username', $data['user_name']);
    }
    if($data['doj'] != null){
        $this->db->where('doj', $data['doj']);
    }
    if($data['dob'] != null){
        $this->db->where('dob', $data['dob']);
    }
    if($data['email'] != null){
        $this->db->where('email', $data['email']);
    }
    if($data['department'] != null){ 
        $this->db->where('department', $data['department']);
    }
    if($data['phone'] != null){
        $this->db->where('phone', $data['phone']);
    }
    if($data['location'] != null){
        $this->db->where('location', $data['location']);
    }
    return $this->db->count_all_results();
}

public function filter(){
    $this->db->select('users.id as user_id, users.full_name,item_assignment.id, item_assignment.assigned_to');
    $this->db->from('use');
    $this->db->join('item_assignment', 'items.id = item_assignment.item_id', 'left');
    $this->db->join('users', 'item_assignment.assignd_to = users.id', 'left');

}

    // filter_item 
       public function filter_item($limit, $offset,$data){
        $this->db->select('items.id, items.location as item_location, items.category, items.sub_category, items.type_name, items.model, items.serial_number, items.supplier, items.quantity, items.price, items.depreciation, items.purchasedate, items.created_at, users.fullname as employ_name, users.id as employ_id, sub_categories.name as names, categories.cat_name, locations.name, item_assignment.status, item_assignment.assignd_to, item_assignment.id as item_ids, suppliers.id as sup_id, suppliers.name as sup_name');
        $this->db->from('items');
        $this->db->join('categories', 'items.category = categories.id', 'left');
        $this->db->join('sub_categories', 'items.sub_category = sub_categories.id', 'left');
        $this->db->join('locations', 'items.location = locations.id', 'left');
        $this->db->join('item_assignment', 'items.category = item_assignment.item_id', 'left');
        $this->db->join('users', 'item_assignment.assignd_to = users.id', 'left');
        $this->db->join('suppliers', 'items.supplier = suppliers.id', 'left'); 
        $this->db->join('item_assignment as assignment', 'items.id = assignment.item_id', 'left');
        
        if ($this->session->userdata('user_role') != '1') {
            $this->db->where('items.location', $this->session->userdata('location'));
        } 

        if($data['employee'] != null){ 
            $this->db->where('assignment.assignd_to', $data['employee']);
            $this->db->where('assignment.status',1); 
        }

        if($data['location'] != null){
            $this->db->where('items.location', $data['location']);
        } 
        if($data['department'] != null){
            $this->db->where('items.department', $data['department']);
        } 
        if($data['category'] != null){ // not work
            $this->db->where('items.category', $data['category']);
        } 
        if($data['sub_category'] != null){
            $this->db->where('sub_category', $data['sub_category']);
        } 
        if($data['project'] != null){ 
            $this->db->where('project', $data['project']);
        }  
        if($data['type_name'] != null){
            $this->db->where('type_name', $data['type_name']);
        }  
        if($data['quantity'] != null){
            $this->db->where('items.quantity', $data['quantity']);
        }  
        if($data['model'] != null){
            $this->db->where('model', $data['model']);
        }  
        if($data['serial_number'] != null){
            $this->db->where('serial_number', $data['serial_number']);
        }  
        if($data['supplier'] != null){
            $this->db->where('supplier', $data['supplier']);
        }  
        if($data['price'] != null){
            $this->db->where('price', $data['price']);
        }  
        if($data['purchasedate'] != null){
            $this->db->where('purchasedate', $data['purchasedate']);
        }  
        if($data['depreciation'] != null){
            $this->db->where('depreciation', $data['depreciation']);
        } 
        if($data['status'] != null){
            $this->db->where('item_assignment.status', $data['status']);
        } 
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    } 
    // count filter item
    public function count_filter_item($data){
        $this->db->select('id,location,category,sub_category,type_name,model,serial_number,supplier,quantity,price,depreciation,purchasedate,created_at');
        $this->db->from('items');
        if ($this->session->userdata('user_role') != '1') {
            $this->db->where('location', $this->session->userdata('location'));
        } 

        if($data['location'] != null){
            $this->db->where('location', $data['location']);
        } 
        if($data['department'] != null){
            $this->db->where('department', $data['department']);
        } 
        if($data['category'] != null){ // not work
            $this->db->where('category', $data['category']);
        } 
        if($data['sub_category'] != null){
            $this->db->where('sub_category', $data['sub_category']);
        } 
        if($data['project'] != null){ 
            $this->db->where('project', $data['project']);
        }  
        if($data['type_name'] != null){
            $this->db->where('type_name', $data['type_name']);
        }  
        if($data['quantity'] != null){
            $this->db->where('quantity', $data['quantity']);
        }  
        if($data['model'] != null){
            $this->db->where('model', $data['model']);
        }  
        if($data['serial_number'] != null){
            $this->db->where('serial_number', $data['serial_number']);
        }  
        if($data['supplier'] != null){
            $this->db->where('supplier', $data['supplier']);
        }  
        if($data['price'] != null){
            $this->db->where('price', $data['price']);
        }  
        if($data['purchasedate'] != null){
            $this->db->where('purchasedate', $data['purchasedate']);
        }  
        if($data['depreciation'] != null){
            $this->db->where('depreciation', $data['depreciation']);
        } 
        if($data['status'] != null){
            $this->db->where('item_assignment.status', $data['status']);
        }
        return $this->db->count_all_results();
    } 
// filter_project
public function filter_project($limit, $offset,$data){
    $this->db->select('id,project_name,project_desc,status,created_at');
    $this->db->from('projects');
    if($data['created_at'] != null){ 
        $this->db->like(array('created_at' => $data['created_at']));
    }
    if($data['project_name'] != null){ 
        $this->db->like(array('project_name' => $data['project_name']));
    }
    $this->db->limit($limit, $offset);
    return $this->db->get()->result();
}
// count filter projects
public function count_filter_projects($data){
    $this->db->select('id,project_name,project_desc,status,created_at');
    $this->db->from('projects');
    if($data['created_at'] != null){ 
        $this->db->like(array('created_at' => $data['created_at']));
    }
    if($data['project_name'] != null){ 
        $this->db->like(array('project_name' => $data['project_name']));
    } 
    return $this->db->count_all_results();
}
// filter_invoice 
  public function filter_invoice($limit, $offset,$data){
    $this->db->select('invoices.id, 
    invoices.inv_no, 
    invoices.inv_date, 
    invoices.project, 
    invoices.supplier, 
    invoices.region, 
    invoices.item, 
    invoices.amount, 
    invoices.inv_desc, 
    invoices.status,
    invoices.status_reason,
    invoices.created_at,
    locations.id as loc_id,
    locations.name,
    suppliers.id as sup_id,
    suppliers.name as sup_name,
    projects.id as project_id,
    projects.project_name');
$this->db->from('invoices');
$this->db->join('locations','invoices.region = locations.id');
$this->db->join('suppliers','invoices.supplier = suppliers.id');
$this->db->join('projects','invoices.project = projects.id');

if($data['inv_no'] != null){
    $this->db->where('inv_no', $data['inv_no']);
} 
if($data['inv_date'] != null){ 
    $this->db->like('inv_date', $data['inv_date']);
} 
if($data['project'] != null){
    $this->db->where('project', $data['project']);
} 
if($data['supplier'] != null){
    $this->db->where('supplier', $data['supplier']);
} 
if($data['region'] != null){
    $this->db->where('invoices.region', $data['region']);
} 
if($data['item'] != null){
    $this->db->where('item', $data['item']);
} 
if($data['amount'] != null){
    $this->db->where('amount', $data['amount']);
}
$this->db->limit($limit, $offset);
return $this->db->get()->result();
}
// count filter invoices
public function count_filter_invoices($data){
    $this->db->select('id,inv_no,inv_date,project,supplier,region,item,amount,inv_desc,status,created_at,');
    $this->db->from('invoices'); 

    if($data['inv_no'] != null){
        $this->db->where('inv_no', $data['inv_no']);
    } 
    if($data['inv_date'] != null){ 
        $this->db->like('inv_date', $data['inv_date']);
    } 
    if($data['project'] != null){
        $this->db->where('project', $data['project']);
    } 
    if($data['supplier'] != null){
        $this->db->where('supplier', $data['supplier']);
    } 
    if($data['region'] != null){
        $this->db->where('invoices.region', $data['region']);
    } 
    if($data['item'] != null){
        $this->db->where('item', $data['item']);
    } 
    if($data['amount'] != null){
        $this->db->where('amount', $data['amount']);
    } 
    return $this->db->count_all_results();
    }
}