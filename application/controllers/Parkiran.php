<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Parkiran extends CI_Controller
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

	public function parkiranMasuk()
	{
		$data['kategori'] = $this->KategoriKendaraan_model->getAll();
		$data['data_parkir'] = $this->Parkiran_model->getAllData();
		$this->template->load('layouts/template', 'parkiran/parkiranMasuk', $data);
	}

	public function simpan()
	{
		// Validasi input
		$this->form_validation->set_rules('plat_nomer', 'Plat Nomer', 'required');
		$this->form_validation->set_rules('kategori', 'Kategori Kendaraan', 'required');

		if ($this->form_validation->run() == FALSE) {
			// Jika validasi gagal, kembali ke halaman form input
			$data['kategori'] = $this->KategoriKendaraan_model->getAll();
			$this->load->view('parkiran/parkiranMasuk', $data);
		} else {
			// Jika validasi sukses, simpan data ke database
			$data = array(
				'kode_kendaraan' => $this->input->post('kategori'),
				'plat_nomer' => $this->input->post('plat_nomer'),
				'tanggal_masuk' => date('Y-m-d H:i:s')
			);

			$this->Parkiran_model->insert($data);
			redirect('parkiran/parkiranMasuk');
		}
	}




	public function parkiranKeluar()
	{
		$this->template->load('layouts/template', 'parkiran/parkiranKeluar');
	}
}
