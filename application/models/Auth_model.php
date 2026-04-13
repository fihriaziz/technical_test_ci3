<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model
{
	public function find_by_username($username)
	{
		return $this->db->get_where('users', array('username' => $username))->row_array();
	}
}