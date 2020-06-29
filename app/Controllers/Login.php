<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usersmodel;

class Login extends BaseController
{
	public function index() {
		return view('login');
	}

	public function checklogin() {
		$session = \Config\Services::session();
		$session->start();
		$Usersmodel = new Usersmodel();
		$u = $this->request->getVar('username');
		$p = $this->request->getVar('password');
		$pwd0 = md5($p);
    	
		$res = $Usersmodel->checklogin($u,$pwd0);

			if (count($res) > 0) {
			  foreach ($res as $k) {
			  	$session->set($k);
			}
          return redirect('dashboard');
        } else {
          return redirect('login');
        } 
	}
}
