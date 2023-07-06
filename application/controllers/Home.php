<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$user = $this->session->userdata('user');
		if (!$user) {
		  redirect('login');
		}
		
	}

	public function index(){

		$this->template->load('layouts/template', 'welcome_message');
	}
}
