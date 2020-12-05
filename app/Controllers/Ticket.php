<?php namespace App\Controllers;

class Ticket extends BaseController
{
	public function index()
	{
		$data = [];

		echo view('templates/header', $data);
		echo view('ambil_antrian');
		echo view('templates/footer');
	}

	//--------------------------------------------------------------------

}
