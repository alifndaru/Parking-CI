<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Parkiran extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$user = $this->session->userdata('user');
		if (!$user) {
			redirect('login');
		}
	}

	public function parkiranMasuk()
	{
		$this->template->load('layouts/template', 'parkiran/parkiranMasuk');
	}

	public function parkiranKeluar()
	{
		$this->template->load('layouts/template', 'parkiran/parkiranKeluar');
	}
}
