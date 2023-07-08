<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$user = $this->session->userdata('user');
		if (!$user) {
			redirect('login');
		}
	}

	public function laporanHarian()
	{
		$this->template->load('layouts/template', 'laporan/laporanHarian');
	}

	public function laporanBulanan()
	{
		$this->template->load('layouts/template', 'laporan/laporanBulanan');
	}
}
