<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * undocumented class
 */
class Requisition_Model extends CI_Model{
    
    public function AddRequest($data, $user) {
        $this->db->trans_begin();

        $this->db->query("INSERT INTO item_requisitions (`item_name`, `item_desc`, `item_qty`, `requested_by`, `status`) VALUES ('$data->item_name', '$data->item_desc', $data->item_qty, '$user', NULL)");

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return false;
        }
        $this->db->trans_commit();
        return true;
    }

}