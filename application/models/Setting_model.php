<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Setting_model extends CI_Model {
 
    var $table = 'setting';
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('nama',$id);
        $query = $this->db->get();
 
        return $query->row_array();
    }
 
    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
}