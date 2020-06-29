<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usersmodel;

class Kategori extends BaseController
{

	public function index() {
		$data = [
			'title' => 'Kategori',
			'subtitle' => 'Kategori'
		];
		return view('backend/kategori', $data);
	}

	public function tambahdata(){
		$data = [
			'title' => 'Tambah Data Kategori',
			'subtitle' => 'Tambah Data Kategori'
		];
		return view('backend/addkategori', $data);
	}

}
