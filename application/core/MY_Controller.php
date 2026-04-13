<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	protected $current_user = array();

	public function __construct()
	{
		parent::__construct();

		$this->current_user = array(
			'id' => $this->session->userdata('user_id'),
			'name' => $this->session->userdata('name'),
			'username' => $this->session->userdata('username'),
			'role' => $this->session->userdata('role'),
		);
	}

	protected function render($view, $data = array())
	{
		$data['page_title'] = isset($data['page_title']) ? $data['page_title'] : 'Dashboard';
		$data['active_menu'] = isset($data['active_menu']) ? $data['active_menu'] : 'dashboard';
		$data['current_user'] = $this->current_user;

		$this->load->view('layouts/header', $data);
		$this->load->view($view, $data);
		$this->load->view('layouts/footer');
	}
}

class Admin_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}
}