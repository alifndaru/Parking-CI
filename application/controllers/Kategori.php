a<?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Kategori extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$user = $this->session->userdata('user');
			$this->load->model('Kategori_model');
			$this->load->library('form_validation');
			if (!$user) {
				redirect('login');
			}
		}

		public function index()
		{
			$data['kategori'] = $this->Kategori_model->getAll();
			$data['kode_kategori'] = $this->generateKodeKategori(); // Tambahkan kode ini
			$this->template->load('layouts/template', 'kategori/index', $data);
		}

		public function tambah()
		{
			$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');
			$this->form_validation->set_rules('harga', 'Harga', 'required|numeric');

			if ($this->form_validation->run() == FALSE) {
				$data['kategori'] = $this->Kategori_model->getAll();
				$data['kode_kategori'] = $this->generateKodeKategori(); // Tambahkan kode ini
				$this->load->view('kategori/index', $data);
			} else {
				$data = array(
					'nama_kategori' => $this->input->post('nama_kategori'),
					'harga' => $this->input->post('harga'),
					'kode_kategori' => $this->generateKodeKategori()
				);

				$this->Kategori_model->insert($data);
				redirect('kategori');
			}
		}

		public function edit($id)
		{
			$data['kategori'] = $this->Kategori_model->getById($id);
			$this->template->load('layouts/template', 'kategori/edit', $data);
		}

		public function update()
		{
			// Form validation rules
			$this->form_validation->set_rules('id_kategori', 'ID', 'required');
			$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');
			$this->form_validation->set_rules('harga', 'Harga', 'required|numeric');

			if ($this->form_validation->run() == FALSE) {
				$id = $this->input->post('id_kategori');
				$data['kategori'] = $this->Kategori_model->getById($id);
				$this->load->view('kategori/edit', $data);
			} else {
				$id = $this->input->post('id_kategori');
				$data = array(
					'nama_kategori' => $this->input->post('nama_kategori'),
					'harga' => $this->input->post('harga')
				);

				$this->Kategori_model->update($id, $data);
				redirect('kategori');
			}
		}

		private function generateKodeKategori()
		{
			$lastKode = $this->Kategori_model->getLastKodeKategori();
			$newKode = (int) substr($lastKode, 2) + 1;
			$paddedKode = str_pad($newKode, 3, '0', STR_PAD_LEFT);
			return 'KK' . $paddedKode;
		}
	}
