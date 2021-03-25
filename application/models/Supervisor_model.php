<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Supervisor_model extends CI_Model{
    function __construct()
    {
        parent::__construct();
    }
    // Get leave applications by employees.
    public function get_leave_applications(){
        $this->db->select('employee_leaves.id,
                            employee_leaves.emp_id,
                            employee_leaves.leave_from,
                            employee_leaves.leave_to,
                            employee_leaves.no_of_days,
                            employee_leaves.leave_reason,
                            employee_leaves.leave_status,
                            employee_leaves.created_at,
                            users.id as user_id,
                            users.fullname,
                            users.department,
                            users.supervisor');
        $this->db->from('employee_leaves');
        $this->db->join('users', 'employee_leaves.emp_id = users.id', 'left');
        $this->db->where('users.supervisor', $this->session->userdata('id'));
        return $this->db->get()->result();
    }
    // Approve / disapprove leave request.
    public function leave_actions($id, $data){
        $this->db->where('id', $id);
        $this->db->update('employee_leaves', $data);
        return true;
    }
}
