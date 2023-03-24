<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{

    public function login($email) 
    {
        $user = $this->db->get_where('user', array('email' => $email))->row_array();
        return $user;
    }

    public function check_user($email)
    {
    	$result = $this->db->get_where('user', array('email' => $email));

    	if($result->num_rows() > 0){
    		$result = $result->row_array();
    		return $result;
    	}
    	else {
    		return false;
    	}
    }
    public function update_reset_code($reset_code, $user_id)
    {
    	$data = array('password_reset_code' => $reset_code);
    	$this->db->where('id_user', $user_id);
    	$this->db->update('user', $data);
    }
    public function save($data)
    {
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

}
