<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Kategorimodel;

class Kategori extends BaseController
{

	
	protected $kategorimodel;
	public function __construct(){

		$this->kategorimodel = new Kategorimodel();

	}

	public function index() {
		$data = [
			'title' => 'Kategori',
			'subtitle' => 'Kategori',
			'kategori' => $this->kategorimodel->findAll()
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

	public function save(){
		$kategori_nm = $this->request->getVar('kategori_nm');
		$bykatnm = $this->kategorimodel->getbyKatnm($kategori_nm);
		if (count($bykatnm)>0) {
			return 'already';
		} else {
			$session = \Config\Services::session();
			$session->start();
			$datenow = date('Y-m-d H:i:s');
			$data = [
			'kategori_nm' => $kategori_nm,
			'created_dttm' => $datenow,
			'created_user' => $session->user_id
			];

			$save = $this->kategorimodel->save($data);
			if ($save) {
				return true;
			} else {
				return false;
			}
			
		}
		
		
	}

}
