<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
	}

	public function index()
	{
		$data = array(
			'page_title' => 'Master User',
			'active_menu' => 'users',
			'users' => $this->User_model->get_all(),
		);

		$this->render('users/index', $data);
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
		if ((int) $id === (int) $this->session->userdata('user_id')) {
			$this->session->set_flashdata('error', 'User yang sedang login tidak dapat dihapus.');
			redirect('users');
		}

		$this->User_model->delete($id);
		$this->session->set_flashdata('success', 'User berhasil dihapus.');
		redirect('users');
	}

	private function save($id = NULL)
	{
		$user = $id ? $this->User_model->find($id) : NULL;

		if ($id && !$user) {
			show_404();
		}

		$this->form_validation->set_rules('name', 'Nama', 'required|trim');
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('role', 'Role', 'required|trim');

		$password_rule = $id ? 'trim' : 'required|min_length[6]';
		$this->form_validation->set_rules('password', 'Password', $password_rule);

		if ($this->form_validation->run() === TRUE) {
			$payload = array(
				'name' => $this->input->post('name', TRUE),
				'username' => $this->input->post('username', TRUE),
				'role' => $this->input->post('role', TRUE),
			);

			$password = $this->input->post('password');

			if ($password !== '') {
				$payload['password'] = password_hash($password, PASSWORD_BCRYPT);
			}

			if ($id) {
				$this->User_model->update($id, $payload);
				$this->session->set_flashdata('success', 'User berhasil diperbarui.');
			} else {
				$this->User_model->insert($payload);
				$this->session->set_flashdata('success', 'User berhasil ditambahkan.');
			}

			redirect('users');
		}

		$data = array(
			'page_title' => $id ? 'Edit User' : 'Tambah User',
			'active_menu' => 'users',
			'user' => $user,
		);

		$this->render('users/form', $data);
	}
}