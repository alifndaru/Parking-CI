<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$user = $this->session->userdata('user');
		if (!$user) {
			redirect('login');
		}
	}

	public function index()
	{
		$this->load->model('Dashboard_model');

		// Ambil data dari model
		$data['jumlahKendaraan'] = $this->Dashboard_model->countKendaraanTerparkir();
		$data['jumlahKategori'] = $this->Dashboard_model->getJumlahKategori();
		$data['jumlahPegawai'] = $this->Dashboard_model->countPegawaiByRole();
		$this->template->load('layouts/template', 'welcome_message', $data);
	}
}
