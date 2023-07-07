<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListKendaraan extends CI_Controller {

	public function index()
	{
		$this->template->load('layouts/template', 'listKendaraan/index');
	}
}
