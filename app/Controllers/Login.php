<?php namespace App\Controllers;

class Login extends BaseController
{

	public function __construct() {
        parent::__construct();
        $this->load->model('UsersModel');
        //$this->load->helper('url_helper');
    }

	public function index() {
		return view('Login');
	}

	public function checklogin($u,$p) {
		
	}

	//--------------------------------------------------------------------

}
