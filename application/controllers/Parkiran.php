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
		$data['data_parkir'] = $this->Parkiran_model->getKendaraanMasuk();
		$data['data_parkir_masuk'] = $this->Parkiran_model->getKendaraanMasuk();
		$data['data_parkir_keluar'] = $this->Parkiran_model->getKendaraanKeluar();
		$this->template->load('layouts/template', 'parkiran/parkiranMasuk', $data);
	}


	public function simpan()
	{
		// Validasi input
		$this->form_validation->set_rules('plat_nomer', 'Plat Nomer', 'required');
		$this->form_validation->set_rules('kategori', 'Kategori Kendaraan', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');

		if ($this->form_validation->run() == FALSE) {
			// Jika validasi gagal, kembali ke halaman form input
			$data['kategori'] = $this->KategoriKendaraan_model->getAll();
			$data['data_parkir_masuk'] = $this->Parkiran_model->getKendaraanMasuk();
			$data['data_parkir_keluar'] = $this->Parkiran_model->getKendaraanKeluar();
			$this->template->load('layouts/template', 'parkiran/parkiranMasuk', $data);
		} else {
			// Jika validasi sukses, cek status parkir terakhir kendaraan
			$platNomer = $this->input->post('plat_nomer');
			$parkirKeluar = $this->Parkiran_model->getParkirKeluarByPlatNomer($platNomer);

			if ($parkirKeluar && $parkirKeluar->status == 2) {
				// Jika kendaraan sudah keluar dan status = 2, izinkan parkir kembali
				$data = array(
					'kode_kendaraan' => $this->input->post('kategori'),
					'plat_nomer' => $platNomer,
					'tanggal_masuk' => date('Y-m-d H:i:s'),
					'status' => $this->input->post('status')
				);

				$this->Parkiran_model->insert($data);
				redirect('parkiran/parkiranMasuk');
			} else {
				// Jika kendaraan masih dalam status parkir atau status lainnya, tampilkan pesan kesalahan
				$data['kategori'] = $this->KategoriKendaraan_model->getAll();
				$data['data_parkir_masuk'] = $this->Parkiran_model->getKendaraanMasuk();
				$data['data_parkir_keluar'] = $this->Parkiran_model->getKendaraanKeluar();
				$data['error_message'] = 'Kendaraan tidak dapat melakukan parkir kembali.';
				$this->template->load('layouts/template', 'parkiran/parkiranMasuk', $data);
			}
		}
	}


	// public function simpan()
	// {
	// 	// Validasi input
	// 	$this->form_validation->set_rules('plat_nomer', 'Plat Nomer', 'required');
	// 	$this->form_validation->set_rules('kategori', 'Kategori Kendaraan', 'required');
	// 	$this->form_validation->set_rules('status', 'Status', 'required');

	// 	if ($this->form_validation->run() == FALSE) {
	// 		// Jika validasi gagal, kembali ke halaman form input
	// 		$data['kategori'] = $this->KategoriKendaraan_model->getAll();
	// 		$data['data_parkir'] = $this->Parkiran_model->getKendaraanMasuk();
	// 		$data['data_parkir_masuk'] = $this->Parkiran_model->getKendaraanMasuk();
	// 		$data['data_parkir_keluar'] = $this->Parkiran_model->getKendaraanKeluar();
	// 		$this->template->load('layouts/template', 'parkiran/parkiranMasuk', $data);
	// 	} else {
	// 		// Jika validasi sukses, cek duplikasi plat nomor
	// 		$platNomer = $this->input->post('plat_nomer');
	// 		$isDuplicate = $this->Parkiran_model->checkDuplicatePlatNomor($platNomer);

	// 		if ($isDuplicate) {
	// 			$data['kategori'] = $this->KategoriKendaraan_model->getAll();
	// 			$data['data_parkir'] = $this->Parkiran_model->getKendaraanMasuk();
	// 			$data['data_parkir_masuk'] = $this->Parkiran_model->getKendaraanMasuk();
	// 			$data['data_parkir_keluar'] = $this->Parkiran_model->getKendaraanKeluar();
	// 			$data['error_message'] = 'Plat nomor sudah terdaftar pada hari ini.';
	// 			$this->template->load('layouts/template', 'parkiran/parkiranMasuk', $data);
	// 		} else {
	// 			// Jika tidak ada duplikasi, simpan data ke database
	// 			$data = array(
	// 				'kode_kendaraan' => $this->input->post('kategori'),
	// 				'plat_nomer' => $platNomer,
	// 				'tanggal_masuk' => date('Y-m-d H:i:s'),
	// 				'status' => $this->input->post('status')
	// 			);

	// 			$this->Parkiran_model->insert($data);
	// 			redirect('parkiran/parkiranMasuk');
	// 		}
	// 	}
	// }


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
		$content = $this->load->view('parkiran/karcis_pdf', ['parkiran' => $parkiran], true);

		// Menambahkan konten ke halaman PDF
		$pdf->writeHTML($content, true, false, true, false, '');

		// Menyimpan dan menampilkan PDF
		$pdf->Output('karcis_parkir.pdf', 'I');
	}

	// end of prosess parkir masuk




	public function parkiranKeluar()
	{
		$data['data_parkir_masuk'] = $this->Parkiran_model->getKendaraanTerparkir();
		$data['data_kendaraan_keluar'] = $this->Parkiran_model->getKendaraanKeluar();
		$this->template->load('layouts/template', 'parkiran/parkiranKeluar', $data);
	}

	public function keluar()
	{
		$platNomer = $this->input->post('plat_nomer');

		// Cek apakah kendaraan sudah keluar sebelumnya
		$parkirKeluar = $this->Parkiran_model->getParkirKeluarByPlatNomer($platNomer);


		if ($parkirKeluar) {
			// Jika kendaraan sudah keluar, tampilkan pesan kesalahan
			echo "Kendaraan sudah keluar.";
			return;
		}

		// Dapatkan data parkir masuk berdasarkan plat nomor
		$parkirMasuk = $this->Parkiran_model->getParkirMasukByPlatNomer($platNomer);
		if (!$parkirMasuk) {
			// Jika data parkir masuk tidak ditemukan, tampilkan pesan kesalahan
			echo "Data parkir masuk tidak ditemukan.";
			return;
		}


		// Hitung durasi parkir
		$tanggalMasuk = strtotime($parkirMasuk->tanggal_masuk);
		$tanggalKeluar = time();
		$durasiParkir = ($tanggalKeluar - $tanggalMasuk) / 3600; // Durasi dalam jam


		// Ambil data kategori kendaraan berdasarkan kode kendaraan
		$kategori = $this->KategoriKendaraan_model->getByKode($parkirMasuk->kode_kendaraan);

		// Hitung total harga

		$totalHarga = $kategori->harga * $durasiParkir;




		// Insert data parkir keluar ke database
		$dataParkirKeluar = array(
			'id_masuk' => $parkirMasuk->id_masuk,
			'waktu_keluar' => date('Y-m-d H:i:s'),
			'durasi_parkir' => $durasiParkir,
			'harga' => $totalHarga
		);
		$this->Parkiran_model->insertParkirKeluar($dataParkirKeluar);

		// Ubah status parkir masuk menjadi keluar (status = 2)
		$this->Parkiran_model->updateStatusParkirMasuk($parkirMasuk->id_masuk, 2);

		redirect('parkiran/parkiranKeluar');
	}
}
