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
			// Jika validasi pertama gagal, kembali ke halaman form input
			$data['kategori'] = $this->KategoriKendaraan_model->getAll();
			$data['data_parkir'] = $this->Parkiran_model->getKendaraanMasuk();
			$data['data_parkir_masuk'] = $this->Parkiran_model->getKendaraanMasuk();
			$data['data_parkir_keluar'] = $this->Parkiran_model->getKendaraanKeluar();
			$this->template->load('layouts/template', 'parkiran/parkiranMasuk', $data);
		} else {
			// Jika validasi sukses, cek status parkir terakhir kendaraan
			$platNomer = $this->input->post('plat_nomer');
			$parkirMasuk = $this->Parkiran_model->getParkirMasukByPlatNomer($platNomer);

			if ($parkirMasuk) {
				if ($parkirMasuk->status == 1) {
					// Jika kendaraan masih dalam status parkir, tampilkan pesan kesalahan
					$data['kategori'] = $this->KategoriKendaraan_model->getAll();
					$data['data_parkir'] = $this->Parkiran_model->getKendaraanMasuk();
					$data['data_parkir_masuk'] = $this->Parkiran_model->getKendaraanMasuk();
					$data['data_parkir_keluar'] = $this->Parkiran_model->getKendaraanKeluar();
					$data['error_message'] = 'Kendaraan sedang dalam status parkir.';
					$this->template->load('layouts/template', 'parkiran/parkiranMasuk', $data);
					return;
				}
			}

			// Generate kode_karcis
			$lastKarcis = $this->Parkiran_model->getLastKarcis();
			$lastNumber = substr($lastKarcis, -4); // Ambil 4 digit terakhir dari kode_karcis terakhir
			$nextNumber = intval($lastNumber) + 1;
			$nextKarcis = 'KC' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

			// Jika kendaraan sudah keluar atau status parkir lainnya, izinkan parkir kembali
			$data = array(
				'kode_karcis' => $nextKarcis,
				'kode_kendaraan' => $this->input->post('kategori'),
				'plat_nomer' => $platNomer,
				'tanggal_masuk' => date('Y-m-d H:i:s'),
				'status' => $this->input->post('status')
			);

			$this->Parkiran_model->insert($data);
			redirect('parkiran/parkiranMasuk');
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

		$this->load->library('pdf');

		// Load view dengan data yang diperlukan
		$data['parkiran'] = $parkiran;
		$html = $this->load->view('parkiran/karcis_pdf', $data, true);

		// Render HTML menjadi PDF
		$this->pdf->loadHtml($html);
		$this->pdf->render();

		// Menyimpan dan menampilkan PDF
		$this->pdf->stream('karcis_parkir.pdf', array('Attachment' => false));
	}



	// end of prosess parkir masuk




	public function parkiranKeluar()
	{
		$data['data_parkir_masuk'] = $this->Parkiran_model->getKendaraanTerparkir();
		$data['data_parkir_keluar'] = $this->Parkiran_model->getKendaraanKeluar();
		$data['data_kendaraan_keluar'] = $this->Parkiran_model->getKendaraanKeluar();


		$this->template->load('layouts/template', 'parkiran/parkiranKeluar', $data);
	}

	public function keluarBener()
	{
		$kodeKarcis = $this->input->post('kode_karcis');

		// Cek apakah kode karcis valid
		$parkirMasuk = $this->Parkiran_model->getParkirMasukByKodeKarcis($kodeKarcis);
		if (!$parkirMasuk) {
			echo "Kode karcis tidak valid.";
			return;
		}

		// Cek apakah kendaraan sudah keluar sebelumnya
		$parkirKeluar = $this->Parkiran_model->getParkirKeluarByKodeKarcis($kodeKarcis);
		if ($parkirKeluar) {
			echo "Kendaraan sudah keluar.";
			return;
		}

		// Hitung durasi parkir
		$tanggalMasuk = strtotime($parkirMasuk->tanggal_masuk);
		$tanggalKeluar = time();
		$durasiParkir = ($tanggalKeluar - $tanggalMasuk) / 3600; // Durasi dalam jam

		// Ambil data kategori kendaraan
		$kategori = $this->KategoriKendaraan_model->getByKode($parkirMasuk->kode_kendaraan);

		// Tentukan harga parkir berdasarkan kategori kendaraan dan durasi parkir
		$hargaPerJam = ($kategori->nama_kategori == 'Motor') ? 500 : 1000; // Harga per jam
		$harga2JamPertama = ($kategori->nama_kategori == 'Motor') ? 1500 : 3000; // Harga 2 jam pertama
		$maksimalPembayaran = ($kategori->nama_kategori == 'Motor') ? 5000 : 10000; // Maksimal pembayaran

		$totalHarga = 0;

		if ($durasiParkir <= 2) {
			$totalHarga = $harga2JamPertama;
		} else {
			$totalHarga = $harga2JamPertama + ($hargaPerJam * ($durasiParkir - 2));
			$totalHarga = min($totalHarga, $maksimalPembayaran); // Batasi total harga dengan maksimal pembayaran
		}

		// Insert data parkir keluar ke database
		$dataParkirKeluar = array(
			'kode_karcis' => $kodeKarcis,
			'waktu_keluar' => date('Y-m-d H:i:s'),
			'durasi_parkir' => $durasiParkir,
			'harga' => $totalHarga,
			'status_keluar' => 2 // Set nilai 'status_keluar' = 2
		);
		$this->Parkiran_model->insertParkirKeluar($dataParkirKeluar);

		// Ubah status parkir masuk menjadi keluar (status = 2)
		$this->Parkiran_model->updateStatusParkirMasuk($parkirMasuk->id_masuk, 2);

		redirect('parkiran/parkiranKeluar');
	}



	public function keluar()
	{
		$kodeKarcis = $this->input->post('kode_karcis');

		// Cek apakah kode karcis valid
		$parkirMasuk = $this->Parkiran_model->getParkirMasukByKodeKarcis($kodeKarcis);
		if (!$parkirMasuk) {
			echo "Kode karcis tidak valid.";
			return;
		}

		// Cek apakah kendaraan sudah keluar sebelumnya
		$parkirKeluar = $this->Parkiran_model->getParkirKeluarByKodeKarcis($kodeKarcis);
		if ($parkirKeluar) {
			echo "Kendaraan sudah keluar.";
			return;
		}

		// Hitung durasi parkir dan harga
		$tanggalMasuk = strtotime($parkirMasuk->tanggal_masuk);
		$tanggalKeluar = time();
		$durasiParkir = ($tanggalKeluar - $tanggalMasuk) / 3600; // Durasi dalam jam

		$kategori = $this->KategoriKendaraan_model->getByKode($parkirMasuk->kode_kendaraan);
		$totalHarga = $kategori->harga * $durasiParkir;

		// Insert data parkir keluar ke database
		$dataParkirKeluar = array(
			'id_masuk' => $parkirMasuk->id_masuk,
			'waktu_keluar' => date('Y-m-d H:i:s'),
			'durasi_parkir' => $durasiParkir,
			'harga' => $totalHarga,
			'status_keluar' => 2
		);
		$this->Parkiran_model->insertParkirKeluar($dataParkirKeluar);

		// Ubah status parkir masuk menjadi keluar (status = 2)
		$this->Parkiran_model->updateStatusParkirMasuk($parkirMasuk->id_masuk, 2);

		redirect('parkiran/parkiranKeluar');
	}
}
