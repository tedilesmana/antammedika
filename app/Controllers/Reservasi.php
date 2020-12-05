<?php

namespace App\Controllers;

class Reservasi extends BaseController
{
	public function index($num = 1)
	{
		$page = ($num * 9) - 9;
		$db      = \Config\Database::connect();
		$builder = $db->table('pasiens');
		$total_data   = $builder->get()->getResultArray();
		$data_pasien   = $builder->getWhere(['user_id' => session()->get('id')], 9, $page)->getResultArray();
		$total_data_pasien   = $builder->getWhere(['user_id' => session()->get('id')])->getResultArray();
		$totalPage = ceil(count($total_data_pasien) / 9);
		$currentPage = $num;
		$data = [
			'data_pasien' => $data_pasien,
			'total_data_pasien' => $total_data_pasien,
			'total_page' => $totalPage,
			'total_data' => $total_data,
			'current_page' => $currentPage
		];

		echo view('layout/header', $data);
		echo view('reservasi');
		echo view('layout/footer');
	}
}
