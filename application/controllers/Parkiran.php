<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parkiran extends CI_Controller {

	public function parkiranMasuk()
	{
		$this->template->load('layouts/template', 'parkiran/parkiranMasuk');
	}

    public function parkiranKeluar()
	{
		$this->template->load('layouts/template', 'parkiran/parkiranKeluar');
	}
}
