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
			$data['data_parkir'] = $this->Parkiran_model->getAllData();
			$this->load->view('parkiran/parkiranMasuk', $data);
		} else {
			// Jika validasi sukses, cek duplikasi plat nomor
			$platNomer = $this->input->post('plat_nomer');
			$isDuplicate = $this->Parkiran_model->checkDuplicatePlatNomor($platNomer);

			if ($isDuplicate) {
				$data['kategori'] = $this->KategoriKendaraan_model->getAll();
				$data['data_parkir'] = $this->Parkiran_model->getAllData();
				$data['error_message'] = 'Plat nomor sudah terdaftar pada hari ini.';
				// $this->load->view('parkiran/parkiranMasuk', $data);
				$this->template->load('layouts/template', 'parkiran/parkiranMasuk', $data);
			} else {
				// Jika tidak ada duplikasi, simpan data ke database
				$data = array(
					'kode_kendaraan' => $this->input->post('kategori'),
					'plat_nomer' => $platNomer,
					'tanggal_masuk' => date('Y-m-d H:i:s')
				);

				$this->Parkiran_model->insert($data);
				redirect('parkiran/parkiranMasuk');
			}
		}
	}

	public function generateKarcisPDF($id_masuk)
	{
		// Load model dan dapatkan data parkiran berdasarkan id_masuk
		$this->load->model('Parkiran_model');
		$parkiran = $this->Parkiran_model->getDataById($id_masuk);

		// Jika data parkiran tidak ditemukan, tampilkan pesan kesalahan atau redirect ke halaman lain
		if (!$parkiran) {
			// Tampilkan pesan kesalahan
			echo "Data parkiran tidak ditemukan.";
			return;
		}

		// Load library TCPDF
		$this->load->library('Tcpdf');

		// Membuat halaman baru
		$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

		// Set margin halaman
		$pdf->SetMargins(10, 10, 10);

		// Menambahkan halaman baru
		$pdf->AddPage();

		// Konten karcis
		// $content = '<h1>Karcis Parkir</h1>';
		// $content .= '<p>Plat Nomor: ' . $parkiran->plat_nomer . '</p>';
		// $content .= '<p>Tanggal Masuk: ' . $parkiran->tanggal_masuk . '</p>';
		// $content .= '<p>Kategori: ' . $parkiran->nama_kategori . '</p>';
		// $content .= '<p>Harga: ' . $parkiran->harga . '</p>';

		// // Menambahkan konten ke halaman PDF
		// $pdf->writeHTML($content, true, false, true, false, '');
		// Konten karcis
		$content = $this->load->view('parkiran/karcis_pdf', ['parkiran' => $parkiran], true);

		// Menambahkan konten ke halaman PDF
		$pdf->writeHTML($content, true, false, true, false, '');

		// Menyimpan dan menampilkan PDF
		$pdf->Output('karcis_parkir.pdf', 'I');
	}





	public function parkiranKeluar()
	{
		$this->template->load('layouts/template', 'parkiran/parkiranKeluar');
	}
}
