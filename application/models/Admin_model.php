<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Admin_model extends CI_Model{
    // Get pending requisitions.
    public function pending_requisitions($limit, $offset){
        $this->db->select('item_requisitions.id,
                            item_requisitions.item_name,
                            item_requisitions.item_qty,
                            item_requisitions.requested_by,
                            item_requisitions.status,
                            item_requisitions.created_at,
                            item_requisitions.updated_at,
                            users.id as user_id,
                            users.fullname,
                            users.location');
        $this->db->from('item_requisitions');
        $this->db->join('users', 'item_requisitions.requested_by = users.id', 'left');
        $this->db->where('item_requisitions.status', 0);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
    // Get approved requisitions.
    public function approved_requisitions($limit, $offset){
        $this->db->select('item_requisitions.id,
                            item_requisitions.item_name,
                            item_requisitions.item_qty,
                            item_requisitions.requested_by,
                            item_requisitions.status,
                            item_requisitions.created_at,
                            item_requisitions.updated_at,
                            users.id as user_id,
                            users.fullname,
                            users.location');
        $this->db->from('item_requisitions');
        $this->db->join('users', 'item_requisitions.requested_by = users.id', 'left');
        $this->db->where('item_requisitions.status', 1);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
    // Get rejected requisitions.
    public function rejected_requisitions($limit, $offset){
        $this->db->select('item_requisitions.id,
                            item_requisitions.item_name,
                            item_requisitions.item_qty,
                            item_requisitions.requested_by,
                            item_requisitions.status,
                            item_requisitions.created_at,
                            item_requisitions.updated_at,
                            users.id as user_id,
                            users.fullname,
                            users.location');
        $this->db->from('item_requisitions');
        $this->db->join('users', 'item_requisitions.requested_by = users.id', 'left');
        $this->db->where('item_requisitions.status', 2);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
    // View requisition detail.
    public function request_detail($id){
        $this->db->select('item_requisitions.id,
                            item_requisitions.item_name,
                            item_requisitions.item_desc,
                            item_requisitions.item_qty,
                            item_requisitions.requested_by,
                            item_requisitions.status,
                            item_requisitions.created_at,
                            item_requisitions.updated_at,
                            users.id as user_id,
                            users.fullname,
                            users.email,
                            users.location,
                            users.user_role');
        $this->db->from('item_requisitions');
        $this->db->join('users', 'item_requisitions.requested_by = users.id', 'left');
        $this->db->where('item_requisitions.id', $id);
        $this->db->order_by('id', 'DESC');
        return $this->db->get()->row();
    }
    // Count pending requisitions
    public function total_pending(){
        return $this->db->from('item_requisitions')->where(array('status' => 0))->count_all_results();
    }
    // Count approved requisitions
    public function total_approved(){
        return $this->db->from('item_requisitions')->where(array('status' => 1))->count_all_results();
    }
    // Count rejected requisitions
    public function total_rejected(){
        return $this->db->from('item_requisitions')->where(array('status' => 2))->count_all_results();
    }
    // Approve request.
    public function approve_request($id, $data){
        $this->db->where('id', $id);
        $this->db->update('item_requisitions', $data);
        return true;
    }
    // Reject request.
    public function reject_request($id, $data){
        $this->db->where('id', $id);
        $this->db->update('item_requisitions', $data);
        return true;
    }
    // Suppliers - Add new supplier
    public function add_supplier($data){
        $this->db->insert('suppliers', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    // Count suppliers
    public function count_suppliers(){
        return $this->db->from('suppliers')->where(array('status' => 1))->count_all_results();
    }
    // Get suppliers
    public function get_suppliers($limit, $offset){
        $this->db->select('id, name, category, email, phone, region, address, status, created_at');
        $this->db->from('suppliers');
        $this->db->where('status', 1);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
    // Remove supplier
    public function delete_supplier($id){
        $this->db->where('id', $id);
        $this->db->delete('suppliers');
        return true;
    }
    // Get supplier for edit by id
    public function edit_supplier($id){
        $this->db->select('id, name, category, email, phone, region, address, status, created_at');
        $this->db->from('suppliers');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }
    // Update supplier by ID.
    public function update_supplier($id, $data){
        $this->db->where('id', $id);
        $this->db->update('suppliers', $data);
        return true;
    }
    // Inventory - Add inventory.
    public function add_inventory($data){
        $this->db->insert('inventory', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    // Count inventory.
    public function count_inventory(){
        return $this->db->from('inventory')->count_all_results();
    }
    // Inventory - Get inventory.
    public function get_inventory($limit, $offset){
        $this->db->select('id, item_name, item_desc, unit_price, item_qty, item_category, created_at');
        $this->db->from('inventory');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
    // Remove inventory.
    public function delete_inventory($id){
        $this->db->where('id', $id);
        $this->db->delete('inventory');
        return true;
    }
    // Count users.
    public function count_users(){
        return $this->db->from('users')->count_all_results();
    }
    // Users - Get all users
    public function get_users($limit, $offset){
        $this->db->select('id, fullname, email, username, location, user_role, created_at');
        $this->db->from('users');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
    // Users = Remove users.
    public function delete_user($id){
        $this->db->where('id', $id);
        $this->db->delete('users');
        return true;
    }
    // Invoices - Add invoice
    public function add_invoice($data){
        $this->db->insert('invoices', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    // Get suppliers for inovice form
    public function get_suppliers_for_invoice(){
        $this->db->select('id, name');
        $this->db->from('suppliers');
        $this->db->where('status', 1);
        return $this->db->get()->result();
    }
    // Count invoices.
    public function count_invoices(){
        return $this->db->from('invoices')->count_all_results();
    }
    // Invoices - Get invoices
    public function get_invoices($limit, $offset){
        $this->db->select('id, inv_no, inv_date, project, vendor, region, item, amount, inv_desc, status, created_at');
        $this->db->from('invoices');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
    // Invoices - print invoice
    public function print_invoice($id){
        $this->db->select('id, inv_no, inv_date, project, vendor, region, item, amount, inv_desc, status, created_at');
        $this->db->from('invoices');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }
    // Invoices - status change to cleared.
    public function update_status($id, $data){
        $this->db->where('id', $id);
        $this->db->update('invoices', $data);
        return true;
    }
    // Invoices - Remove invoice
    public function delete_invoice($id){
        $this->db->where('id', $id);
        $this->db->delete('invoices');
        return true;
    }
    // Projects - Add project
    public function add_project($data){
        $this->db->insert('projects', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    // Projects - Get projects.
    public function get_projects(){
        $this->db->select('id, project_name, project_desc, status, created_at');
        $this->db->from('projects');
        $this->db->where('status', 1);
        $this->db->order_by('id', 'DESC');
        return $this->db->get()->result();
    }
    // Projects - Remove project
    public function delete_project($id){
        $this->db->where('id', $id);
        $this->db->delete('projects');
        return true;
    }
    // Expenses - region based - Islamabad
    public function expenses_isbd(){
        $this->db->select('SUM(amount) as isbd_total');
        $this->db->from('invoices');
        $this->db->where(array('region' => 'islamabad', 'status' => 1));
        $this->db->like('inv_date', date('Y-m'));
        return $this->db->get()->row();
    }
    // Expenses - region based - Balochistan
    public function expenses_bln(){
        $this->db->select('SUM(amount) as bln_total');
        $this->db->from('invoices');
        $this->db->where(array('region' => 'balochistan', 'status' => 1));
        $this->db->like('inv_date', date('Y-m'));
        return $this->db->get()->row();
    }
    // Expenses - region based - Khyber PK
    public function expenses_kp(){
        $this->db->select('SUM(amount) as kp_total');
        $this->db->from('invoices');
        $this->db->where(array('region' => 'khyber PK', 'status' => 1));
        $this->db->like('inv_date', date('Y-m'));
        return $this->db->get()->row();
    }
    // Expenses - region based - Sindh
    public function expenses_sindh(){
        $this->db->select('SUM(amount) as sindh_total');
        $this->db->from('invoices');
        $this->db->where(array('region' => 'sindh', 'status' => 1));
        $this->db->like('inv_date', date('Y-m'));
        return $this->db->get()->row();
    }
    // Equipment maintenance - Add new record
    public function add_maint_record($data){
        $this->db->insert('equipment_maintenance', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    // Overall stats - Islamabad
    public function overall_stats_isbd(){
        $this->db->select('SUM(amount) as isbd_total');
        $this->db->from('invoices');
        $this->db->where(array('region' => 'islamabad', 'status' => 1));
        return $this->db->get()->row();
    }
    // Overall stats - Balochistan
    public function overall_stats_bln(){
        $this->db->select('SUM(amount) as bln_total');
        $this->db->from('invoices');
        $this->db->where(array('region' => 'balochistan', 'status' => 1));
        return $this->db->get()->row();
    }
    // Overall stats - Khyber PK
    public function overall_stats_khyber(){
        $this->db->select('SUM(amount) as kp_total');
        $this->db->from('invoices');
        $this->db->where(array('region' => 'khyber PK', 'status' => 1));
        return $this->db->get()->row();
    }
    // Overall stats - Sindh
    public function overall_stats_sindh(){
        $this->db->select('SUM(amount) as sindh_total');
        $this->db->from('invoices');
        $this->db->where(array('region' => 'sindh', 'status' => 1));
        return $this->db->get()->row();
    }
    // Overall stats - Annual expenses
    public function annual_expenses(){
        $this->db->select('SUM(amount) as annual_expenses');
        $this->db->from('invoices');
        $this->db->where('status', 1);
        $this->db->like('inv_date', date('Y'));
        return $this->db->get()->row();
    }
    // Count maintenance record.
    public function count_maint_record(){
        return $this->db->from('equipment_maintenance')->count_all_results();
    }
    // Equipment maintenance - Get maintenance record
    public function get_maint_record($limit, $offset){
        $this->db->select('id, region, maint_date, maint_cat, maint_desc, vendor, qty_size, unit_price, total_amount, maint_remarks, created_at');
        $this->db->from('equipment_maintenance');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
    // Equipment maintenance = Delete record
    public function delete_maint_record($id){
        $this->db->where('id', $id);
        $this->db->delete('equipment_maintenace');
        return true;
    }
    // Assets - Add new item
    public function add_item($data){
        $this->db->insert('items_detail', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    // Count all items for asset register
    public function count_assets(){
        return $this->db->from('items_detail')->count_all_results();
    }
    // Get assets/items.
    public function get_assets($limit, $offset){
        $this->db->select('id, year, project, category, item, description, model, asset_code, serial_number, custodian_location, contact, designation, department, quantity, district_region, status, po_no, purchase_date, receive_date, created_at');
        $this->db->from('items_detail');
        $this->db->order_by('id', 'ASC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
    // Asset detail - view and edit.
    public function asset_detail($id){
        $this->db->select('id, year, project, category, item, description, model, asset_code, serial_number, custodian_location, contact, designation, department, quantity, district_region, status, po_no, purchase_date, receive_date, created_at');
        $this->db->from('items_detail');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }
    // Asset detail - Update existing record
    public function update_item($id, $data){
        $this->db->where('id', $id);
        $this->db->update('items_detail', $data);
        return true;
    }
    //== ----------------------------------------- Search filters --------------------------------------- ==\\
    // Search filters - suppliers search
    public function search_suppliers($search){
        $this->db->select('id, name, category, email, phone, region, address, status, created_at');
        $this->db->from('suppliers');
        $this->db->like('name', $search);
        $this->db->or_like('category', $search);
        $this->db->or_like('region', $search);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get()->result();
    }
    // Search filters - inventory search
    public function search_inventory($search){
        $this->db->select('id, item_name, item_desc, unit_price, item_qty, item_category, created_at');
        $this->db->from('inventory');
        $this->db->like('item_name', $search);
        $this->db->or_like('item_desc', $search);
        $this->db->or_like('item_category', $search);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get()->result();
    }
}