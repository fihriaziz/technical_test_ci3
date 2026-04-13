<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in')) {
			redirect('dashboard');
		}

		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->render('auth/login', array('page_title' => 'Login Admin'));
			return;
		}

		$user = $this->Auth_model->find_by_username($this->input->post('username', TRUE));
		$password = (string) $this->input->post('password');

		if (!$user || !password_verify($password, $user['password'])) {
			$this->session->set_flashdata('error', 'Username atau password tidak valid.');
			redirect('login');
		}

		$this->session->set_userdata(array(
			'user_id' => $user['id'],
			'name' => $user['name'],
			'username' => $user['username'],
			'role' => $user['role'],
			'logged_in' => TRUE,
		));

		redirect('dashboard');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}