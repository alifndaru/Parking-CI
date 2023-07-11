<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ListKendaraan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('tglindo_helper');
		$this->load->model('KategoriKendaraan_model');
		$this->load->model('Parkiran_model');
		$user = $this->session->userdata('user');
		if (!$user) {
			redirect('login');
		}
	}

	public function index()
	{
		$data['data_parkir_masuk'] = $this->Parkiran_model->getKendaraanTerparkir();
		// $data['kategori'] = $this->KategoriKendaraan_model->getAll();
		// $data['data_parkir'] = $this->Parkiran_model->getAllData();
		// $data['data_parkir_masuk'] = $this->Parkiran_model->getKendaraanMasuk();
		// $data['data_parkir_keluar'] = $this->Parkiran_model->getKendaraanKeluar();
		$this->template->load('layouts/template', 'listKendaraan/index', $data);
	}
}
