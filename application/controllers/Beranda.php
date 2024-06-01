<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Beranda extends CI_Controller
{

    public function __construct()
	{
		parent::__construct();


		date_default_timezone_set('Asia/Jakarta');

	}

    public function index()
    {
		
		
		if ($this->session->userdata('id') == null) redirect('/login', 'refresh');


		

		$this->load->view('home');
		
	
    }

  
}


