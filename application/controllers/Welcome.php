<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Public_Controller
{

	public function index()
	{
		$this->load->view('themes/public/welcome/index');
	}

}
