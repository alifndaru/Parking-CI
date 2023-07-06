<?php
class User_model extends CI_Model
{
    public function login($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('users');
        return $query->row();
    }
}
