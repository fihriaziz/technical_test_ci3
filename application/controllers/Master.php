<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends Admin_Controller
{
	private $entities = array(
		'suppliers' => array(
			'table' => 'suppliers',
			'title' => 'Master Supplier',
			'singular' => 'supplier',
			'active_menu' => 'suppliers',
			'fields' => array(
				array('name' => 'code', 'label' => 'Kode', 'rules' => 'required|trim', 'type' => 'text'),
				array('name' => 'name', 'label' => 'Nama Supplier', 'rules' => 'required|trim', 'type' => 'text'),
				array('name' => 'address', 'label' => 'Alamat', 'rules' => 'required|trim', 'type' => 'textarea'),
				array('name' => 'city', 'label' => 'Kota', 'rules' => 'required|trim', 'type' => 'text'),
				array('name' => 'phone', 'label' => 'Telepon', 'rules' => 'trim', 'type' => 'text'),
			),
			'columns' => array('code' => 'Kode', 'name' => 'Nama Supplier', 'city' => 'Kota', 'phone' => 'Telepon'),
		),
		'customers' => array(
			'table' => 'customers',
			'title' => 'Master Customer',
			'singular' => 'customer',
			'active_menu' => 'customers',
			'fields' => array(
				array('name' => 'code', 'label' => 'Kode', 'rules' => 'required|trim', 'type' => 'text'),
				array('name' => 'name', 'label' => 'Nama Customer', 'rules' => 'required|trim', 'type' => 'text'),
				array('name' => 'address', 'label' => 'Alamat', 'rules' => 'required|trim', 'type' => 'textarea'),
				array('name' => 'city', 'label' => 'Kota', 'rules' => 'required|trim', 'type' => 'text'),
				array('name' => 'contact_person', 'label' => 'Up / Contact Person', 'rules' => 'trim', 'type' => 'text'),
			),
			'columns' => array('code' => 'Kode', 'name' => 'Nama Customer', 'city' => 'Kota', 'contact_person' => 'Contact Person'),
		),
		'units' => array(
			'table' => 'units',
			'title' => 'Master Satuan',
			'singular' => 'satuan',
			'active_menu' => 'units',
			'fields' => array(
				array('name' => 'name', 'label' => 'Nama Satuan', 'rules' => 'required|trim', 'type' => 'text'),
				array('name' => 'description', 'label' => 'Deskripsi', 'rules' => 'trim', 'type' => 'textarea'),
			),
			'columns' => array('name' => 'Satuan', 'description' => 'Deskripsi'),
		),
	);

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Master_model');
	}

	public function index($entity = 'suppliers')
	{
		$config = $this->get_entity_config($entity);

		$data = array(
			'page_title' => $config['title'],
			'active_menu' => $config['active_menu'],
			'config' => $config,
			'entity' => $entity,
			'rows' => $this->Master_model->get_all($config['table']),
		);

		$this->render('master/index', $data);
	}

	public function create($entity)
	{
		$config = $this->get_entity_config($entity);
		$this->apply_rules($config['fields']);

		if ($this->form_validation->run() === TRUE) {
			$this->Master_model->insert($config['table'], $this->collect_payload($config['fields']));
			$this->session->set_flashdata('success', ucfirst($config['singular']) . ' berhasil ditambahkan.');
			redirect('master/' . $entity);
		}

		$data = array(
			'page_title' => 'Tambah ' . $config['title'],
			'active_menu' => $config['active_menu'],
			'config' => $config,
			'entity' => $entity,
			'row' => NULL,
		);

		$this->render('master/form', $data);
	}

	public function edit($entity, $id)
	{
		$config = $this->get_entity_config($entity);
		$row = $this->Master_model->find($config['table'], $id);

		if (!$row) {
			show_404();
		}

		$this->apply_rules($config['fields']);

		if ($this->form_validation->run() === TRUE) {
			$this->Master_model->update($config['table'], $id, $this->collect_payload($config['fields']));
			$this->session->set_flashdata('success', ucfirst($config['singular']) . ' berhasil diperbarui.');
			redirect('master/' . $entity);
		}

		$data = array(
			'page_title' => 'Edit ' . $config['title'],
			'active_menu' => $config['active_menu'],
			'config' => $config,
			'entity' => $entity,
			'row' => $row,
		);

		$this->render('master/form', $data);
	}

	public function delete($entity, $id)
	{
		$config = $this->get_entity_config($entity);
		$this->Master_model->delete($config['table'], $id);
		$this->session->set_flashdata('success', ucfirst($config['singular']) . ' berhasil dihapus.');
		redirect('master/' . $entity);
	}

	private function get_entity_config($entity)
	{
		if (!isset($this->entities[$entity])) {
			show_404();
		}

		return $this->entities[$entity];
	}

	private function apply_rules($fields)
	{
		foreach ($fields as $field) {
			$this->form_validation->set_rules($field['name'], $field['label'], $field['rules']);
		}
	}

	private function collect_payload($fields)
	{
		$payload = array();

		foreach ($fields as $field) {
			$payload[$field['name']] = $this->input->post($field['name'], TRUE);
		}

		return $payload;
	}
}