<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model
{
	public function get_all()
	{
		$this->db->select('products.*, units.name AS unit_name');
		$this->db->from('products');
		$this->db->join('units', 'units.id = products.unit_id');
		$this->db->order_by('products.id', 'DESC');

		return $this->db->get()->result_array();
	}

	public function find($id)
	{
		return $this->db->get_where('products', array('id' => $id))->row_array();
	}

	public function insert($payload)
	{
		return $this->db->insert('products', $payload);
	}

	public function update($id, $payload)
	{
		return $this->db->where('id', $id)->update('products', $payload);
	}

	public function delete($id)
	{
		return $this->db->delete('products', array('id' => $id));
	}
}