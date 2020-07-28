<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usersmodel;

class Dashboard extends BaseController
{

	public function index() {
		$data = [
			'title' => 'Admin Dashboard'
		];
		return view('backend/dashboard', $data);
	}

	public function error() {
		$data = [
			'title' => 'Error Dashboard'
		];
		return view('erros/cli/error_exception');
	}

}
