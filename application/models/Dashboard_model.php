<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
	public function get_stats()
	{
		return array(
			'users' => $this->db->count_all('users'),
			'suppliers' => $this->db->count_all('suppliers'),
			'customers' => $this->db->count_all('customers'),
			'products' => $this->db->count_all('products'),
			'invoices' => $this->db->count_all('invoices'),
		);
	}

	public function get_latest_invoices($limit = 5)
	{
		$this->db->select('invoices.*, suppliers.name AS supplier_name, customers.name AS customer_name');
		$this->db->from('invoices');
		$this->db->join('suppliers', 'suppliers.id = invoices.supplier_id');
		$this->db->join('customers', 'customers.id = invoices.customer_id');
		$this->db->order_by('invoice_date', 'DESC');
		$this->db->limit($limit);

		return $this->db->get()->result_array();
	}
}