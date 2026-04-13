<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoices extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Invoice_model');
		$this->load->model('Master_model');
		$this->load->model('Product_model');
	}

	public function index()
	{
		$data = array(
			'page_title' => 'Transaksi Faktur',
			'active_menu' => 'invoices',
			'invoices' => $this->Invoice_model->get_all(),
		);

		$this->render('invoices/index', $data);
	}

	public function create()
	{
		$this->save();
	}

	public function edit($id)
	{
		$this->save($id);
	}

	public function show($id)
	{
		$invoice = $this->Invoice_model->find($id);

		if (!$invoice) {
			show_404();
		}

		$data = array(
			'page_title' => 'Detail Faktur',
			'active_menu' => 'invoices',
			'invoice' => $invoice,
		);

		$this->render('invoices/show', $data);
	}

	public function delete($id)
	{
		$this->Invoice_model->delete($id);
		$this->session->set_flashdata('success', 'Faktur berhasil dihapus.');
		redirect('invoices');
	}

	private function save($id = NULL)
	{
		$invoice = $id ? $this->Invoice_model->find($id) : NULL;

		if ($id && !$invoice) {
			show_404();
		}

		$this->form_validation->set_rules('invoice_no', 'Nomor Faktur', 'required|trim');
		$this->form_validation->set_rules('invoice_date', 'Tanggal Faktur', 'required|trim');
		$this->form_validation->set_rules('supplier_id', 'Supplier', 'required');
		$this->form_validation->set_rules('customer_id', 'Customer', 'required');
		$this->form_validation->set_rules('purchasing_name', 'Nama Purchasing', 'required|trim');
		$this->form_validation->set_rules('recipient_name', 'Penerima / Up', 'required|trim');

		$form_items = $this->build_items_from_post();

		if ($this->form_validation->run() === TRUE) {
			if (empty($form_items)) {
				$this->session->set_flashdata('error', 'Minimal harus ada satu item pada faktur.');
			} else {
				$payload = array(
					'invoice_no' => $this->input->post('invoice_no', TRUE),
					'invoice_date' => $this->input->post('invoice_date', TRUE),
					'supplier_id' => $this->input->post('supplier_id', TRUE),
					'customer_id' => $this->input->post('customer_id', TRUE),
					'purchasing_name' => $this->input->post('purchasing_name', TRUE),
					'recipient_name' => $this->input->post('recipient_name', TRUE),
					'notes' => $this->input->post('notes', TRUE),
					'total_quantity' => array_sum(array_column($form_items, 'quantity')),
					'total_unit_price' => array_sum(array_column($form_items, 'price')),
					'grand_total' => array_sum(array_column($form_items, 'total_price')),
				);

				if ($id) {
					$this->Invoice_model->update_invoice($id, $payload, $form_items);
					$this->session->set_flashdata('success', 'Faktur berhasil diperbarui.');
				} else {
					$this->Invoice_model->insert_invoice($payload, $form_items);
					$this->session->set_flashdata('success', 'Faktur berhasil ditambahkan.');
				}

				redirect('invoices');
			}
		}

		if ($this->input->method() === 'post') {
			$invoice = $this->hydrate_invoice_from_post($invoice, $form_items);
		}

		$data = array(
			'page_title' => $id ? 'Edit Faktur' : 'Tambah Faktur',
			'active_menu' => 'invoices',
			'invoice' => $invoice,
			'suppliers' => $this->Master_model->get_all('suppliers'),
			'customers' => $this->Master_model->get_all('customers'),
			'units' => $this->Master_model->get_all('units'),
			'products' => $this->Product_model->get_all(),
		);

		$this->render('invoices/form', $data);
	}

	private function build_items_from_post()
	{
		$product_ids = $this->input->post('product_id');
		$unit_ids = $this->input->post('unit_id');
		$quantities = $this->input->post('quantity');
		$prices = $this->input->post('price');

		if (!is_array($product_ids)) {
			return array();
		}

		$items = array();

		foreach ($product_ids as $index => $product_id) {
			$quantity = isset($quantities[$index]) ? (float) $quantities[$index] : 0;
			$price = isset($prices[$index]) ? (float) $prices[$index] : 0;

			if ((int) $product_id <= 0 || $quantity <= 0) {
				continue;
			}

			$items[] = array(
				'product_id' => (int) $product_id,
				'unit_id' => isset($unit_ids[$index]) ? (int) $unit_ids[$index] : NULL,
				'quantity' => $quantity,
				'price' => $price,
				'total_price' => $quantity * $price,
			);
		}

		return $items;
	}

	private function hydrate_invoice_from_post($invoice, $items)
	{
		$base = is_array($invoice) ? $invoice : array();

		$base['invoice_no'] = set_value('invoice_no', isset($base['invoice_no']) ? $base['invoice_no'] : '');
		$base['invoice_date'] = set_value('invoice_date', isset($base['invoice_date']) ? $base['invoice_date'] : date('Y-m-d'));
		$base['supplier_id'] = set_value('supplier_id', isset($base['supplier_id']) ? $base['supplier_id'] : '');
		$base['customer_id'] = set_value('customer_id', isset($base['customer_id']) ? $base['customer_id'] : '');
		$base['purchasing_name'] = set_value('purchasing_name', isset($base['purchasing_name']) ? $base['purchasing_name'] : '');
		$base['recipient_name'] = set_value('recipient_name', isset($base['recipient_name']) ? $base['recipient_name'] : '');
		$base['notes'] = set_value('notes', isset($base['notes']) ? $base['notes'] : '');
		$base['items'] = !empty($items) ? $items : array(array('product_id' => '', 'unit_id' => '', 'quantity' => 1, 'price' => 0));

		return $base;
	}
}