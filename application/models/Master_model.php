<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_model extends CI_Model
{
	public function get_all($table)
	{
		return $this->db->order_by('id', 'DESC')->get($table)->result_array();
	}

	public function find($table, $id)
	{
		return $this->db->get_where($table, array('id' => $id))->row_array();
	}

	public function insert($table, $payload)
	{
		return $this->db->insert($table, $payload);
	}

	public function update($table, $id, $payload)
	{
		return $this->db->where('id', $id)->update($table, $payload);
	}

	public function delete($table, $id)
	{
		return $this->db->delete($table, array('id' => $id));
	}
}