<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard_model');
	}

	public function index()
	{
		$data = array(
			'page_title' => 'Dashboard',
			'active_menu' => 'dashboard',
			'stats' => $this->Dashboard_model->get_stats(),
			'latest_invoices' => $this->Dashboard_model->get_latest_invoices(),
		);

		$this->render('dashboard/index', $data);
	}
}