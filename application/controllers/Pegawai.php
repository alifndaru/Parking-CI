<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$user = $this->session->userdata('user');
		if (!$user) {
			redirect('login');
		}
	}

	public function index()
	{
		$data['users'] = $this->User_model->getUsers();
		$this->template->load('layouts/template', 'Pegawai', $data);
	}

	public function create()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|alpha');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('noHp', 'No. HP', 'required|numeric');
		$this->form_validation->set_rules('role', 'Role', 'required');

		if ($this->form_validation->run() == FALSE) {
			// Validasi gagal
			$response['success'] = false;
			$response['error'] = validation_errors();
			echo json_encode($response);
		} else {
			// Validasi berhasil, lanjutkan pemrosesan
			$pegawai_data = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'alamat' => $this->input->post('alamat'),
				'noHp' => $this->input->post('noHp'),
				'role' => $this->input->post('role')
			);
			$pegawai_id = $this->User_model->createPegawai($pegawai_data);

			// Set flashdata success
			$this->session->set_flashdata('success', 'Data berhasil ditambahkan.');

			$response['success'] = true;
			echo json_encode($response);
		}
	}

	function edit($pegawai_id)
	{
		// $data['pegawai'] = $this->User_model->getDataById($id);
		$data['pegawai'] = $this->User_model->getDataById($pegawai_id);
		$this->template->load('layouts/template', 'PegawaiEdit', $data);
	}


	public function update()
	{
		// Ambil data dari form
		$pegawai_id = $this->input->post('users_id');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$alamat = $this->input->post('alamat');
		$noHp = $this->input->post('noHp');
		$role = $this->input->post('role');

		// Validasi form
		$this->form_validation->set_rules('username', 'username', 'required|alpha');
		$this->form_validation->set_rules('password', 'password', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('noHp', 'noHp', 'required|numeric');
		$this->form_validation->set_rules('role', 'role', 'required');

		if ($this->form_validation->run() == FALSE) {
			// Jika validasi gagal, kembali ke halaman edit dengan flash data error
			$this->session->set_flashdata('error', validation_errors());
			redirect('pegawai/edit/' . $pegawai_id);
		} else {
			// Jika validasi berhasil, lakukan update data pegawai
			$pegawai_data = array(
				'username' => $username,
				'password' => $password,
				'alamat' => $alamat,
				'noHp' => $noHp,
				'role' => $role
			);

			if ($this->User_model->updatePegawai($pegawai_id, $pegawai_data)) {
				// Jika update berhasil, tampilkan flash data success dan redirect ke halaman pegawai
				$this->session->set_flashdata('success', 'Data berhasil diperbarui.');
				redirect('pegawai');
			} else {
				// Jika update gagal, tampilkan flash data error dan redirect ke halaman edit
				$this->session->set_flashdata('error', 'Terjadi kesalahan saat memperbarui data.');
				redirect('pegawai/edit/' . $pegawai_id);
			}
		}
	}


	// public function update()
	// {
	// 	$this->form_validation->set_rules('username', 'Username', 'required|alpha');
	// 	$this->form_validation->set_rules('password', 'Password', 'required');
	// 	$this->form_validation->set_rules('alamat', 'Alamat', 'required');
	// 	$this->form_validation->set_rules('noHp', 'No. HP', 'required|numeric');
	// 	$this->form_validation->set_rules('role', 'Role', 'required');

	// 	if ($this->form_validation->run() == FALSE) {
	// 		// Validasi gagal, kembali ke halaman edit dengan menampilkan pesan error
	// 		$data['error'] = validation_errors();
	// 		$this->load->view('PegawaiEdit', $data);
	// 	} else {
	// 		// Validasi berhasil, lanjutkan pemrosesan update data
	// 		$pegawai_data = array(
	// 			'users_id' => $this->input->post('users_id'),
	// 			'username' => $this->input->post('username'),
	// 			'password' => $this->input->post('password'),
	// 			'alamat' => $this->input->post('alamat'),
	// 			'noHp' => $this->input->post('noHp'),
	// 			'role' => $this->input->post('role')
	// 		);

	// 		// Panggil model untuk melakukan update data pegawai
	// 		$result = $this->User_model->updatePegawai($pegawai_data);

	// 		if ($result) {
	// 			// Update berhasil, set flash data success
	// 			$this->session->set_flashdata('success', 'Data berhasil diperbarui.');
	// 			redirect('pegawai');
	// 		} else {
	// 			// Update gagal, set flash data error
	// 			$this->session->set_flashdata('error', 'Gagal memperbarui data pegawai.');
	// 			redirect('pegawai/edit/' . $pegawai_data['users_id']);
	// 		}
	// 	}
	// }




	public function delete($pegawai_id)
	{
		// Pastikan id pegawai yang akan dihapus valid
		if (!is_numeric($pegawai_id)) {
			redirect('pegawai');
		}

		// Hapus data pegawai berdasarkan ID
		$this->User_model->deletePegawai($pegawai_id);

		// Set flashdata success
		$this->session->set_flashdata('success', 'Data berhasil dihapus.');

		// Redirect ke halaman /pegawai
		redirect('pegawai');
	}
}
