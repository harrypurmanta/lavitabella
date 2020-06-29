<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usersmodel;

class Kategori extends BaseController
{

	public function index() {
		$data = [
			'title' => 'Kategori'
		];
		return view('backend/kategori', $data);
	}

}
