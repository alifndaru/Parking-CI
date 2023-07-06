<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	public function index(){

		$this->template->load('layouts/template', 'Pegawai');
	}
}
