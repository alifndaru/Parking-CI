<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function laporanHarian()
	{
		$this->template->load('layouts/template', 'laporan/laporanHarian');
	}

    public function laporanBulanan()
	{
		$this->template->load('layouts/template', 'laporan/laporanBulanan');
	}
}
