<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function get_all()
	{
		return $this->db->order_by('id', 'DESC')->get('users')->result_array();
	}

	public function find($id)
	{
		return $this->db->get_where('users', array('id' => $id))->row_array();
	}

	public function insert($payload)
	{
		return $this->db->insert('users', $payload);
	}

	public function update($id, $payload)
	{
		return $this->db->where('id', $id)->update('users', $payload);
	}

	public function delete($id)
	{
		return $this->db->delete('users', array('id' => $id));
	}
}