<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usersmodel;

class Dashboard extends BaseController
{


	public function index() {
		return view('backend/dashboard');
	}

}
