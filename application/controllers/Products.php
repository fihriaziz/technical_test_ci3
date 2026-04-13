<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Product_model');
		$this->load->model('Master_model');
	}

	public function index()
	{
		$data = array(
			'page_title' => 'Master Produk',
			'active_menu' => 'products',
			'products' => $this->Product_model->get_all(),
		);

		$this->render('products/index', $data);
	}

	public function create()
	{
		$this->save();
	}

	public function edit($id)
	{
		$this->save($id);
	}

	public function delete($id)
	{
		$this->Product_model->delete($id);
		$this->session->set_flashdata('success', 'Produk berhasil dihapus.');
		redirect('products');
	}

	private function save($id = NULL)
	{
		$product = $id ? $this->Product_model->find($id) : NULL;

		if ($id && !$product) {
			show_404();
		}

		$this->form_validation->set_rules('code', 'Kode', 'required|trim');
		$this->form_validation->set_rules('name', 'Nama Produk', 'required|trim');
		$this->form_validation->set_rules('unit_id', 'Satuan', 'required');
		$this->form_validation->set_rules('default_price', 'Harga', 'required|numeric');

		if ($this->form_validation->run() === TRUE) {
			$payload = array(
				'code' => $this->input->post('code', TRUE),
				'name' => $this->input->post('name', TRUE),
				'unit_id' => $this->input->post('unit_id', TRUE),
				'default_price' => $this->input->post('default_price', TRUE),
			);

			if ($id) {
				$this->Product_model->update($id, $payload);
				$this->session->set_flashdata('success', 'Produk berhasil diperbarui.');
			} else {
				$this->Product_model->insert($payload);
				$this->session->set_flashdata('success', 'Produk berhasil ditambahkan.');
			}

			redirect('products');
		}

		$data = array(
			'page_title' => $id ? 'Edit Produk' : 'Tambah Produk',
			'active_menu' => 'products',
			'product' => $product,
			'units' => $this->Master_model->get_all('units'),
		);

		$this->render('products/form', $data);
	}
}