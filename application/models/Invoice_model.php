<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_model extends CI_Model
{
	public function get_all()
	{
		$this->db->select('invoices.*, suppliers.name AS supplier_name, customers.name AS customer_name');
		$this->db->from('invoices');
		$this->db->join('suppliers', 'suppliers.id = invoices.supplier_id');
		$this->db->join('customers', 'customers.id = invoices.customer_id');
		$this->db->order_by('invoice_date', 'DESC');

		return $this->db->get()->result_array();
	}

	public function find($id)
	{
		$this->db->select('invoices.*, suppliers.name AS supplier_name, suppliers.address AS supplier_address, suppliers.city AS supplier_city, customers.name AS customer_name, customers.address AS customer_address, customers.city AS customer_city, customers.contact_person');
		$this->db->from('invoices');
		$this->db->join('suppliers', 'suppliers.id = invoices.supplier_id');
		$this->db->join('customers', 'customers.id = invoices.customer_id');
		$this->db->where('invoices.id', $id);
		$invoice = $this->db->get()->row_array();

		if (!$invoice) {
			return NULL;
		}

		$this->db->select('invoice_items.*, products.code AS product_code, products.name AS product_name, units.name AS unit_name');
		$this->db->from('invoice_items');
		$this->db->join('products', 'products.id = invoice_items.product_id');
		$this->db->join('units', 'units.id = invoice_items.unit_id', 'left');
		$this->db->where('invoice_items.invoice_id', $id);
		$invoice['items'] = $this->db->get()->result_array();

		return $invoice;
	}

	public function insert_invoice($payload, $items)
	{
		$this->db->trans_start();
		$this->db->insert('invoices', $payload);
		$invoice_id = $this->db->insert_id();

		foreach ($items as &$item) {
			$item['invoice_id'] = $invoice_id;
		}

		$this->db->insert_batch('invoice_items', $items);
		$this->db->trans_complete();

		return $invoice_id;
	}

	public function update_invoice($id, $payload, $items)
	{
		$this->db->trans_start();
		$this->db->where('id', $id)->update('invoices', $payload);
		$this->db->delete('invoice_items', array('invoice_id' => $id));

		foreach ($items as &$item) {
			$item['invoice_id'] = $id;
		}

		$this->db->insert_batch('invoice_items', $items);
		$this->db->trans_complete();

		return TRUE;
	}

	public function delete($id)
	{
		return $this->db->delete('invoices', array('id' => $id));
	}
}