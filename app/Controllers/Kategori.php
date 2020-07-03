<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Kategorimodel;

class Kategori extends BaseController
{

	
	protected $kategorimodel;
	protected $session;
	public function __construct(){

		$this->kategorimodel = new Kategorimodel();
		$this->session = \Config\Services::session();
		$this->session->start();

	}

	public function index() {
		$data = [
			'title' => 'Kategori',
			'subtitle' => 'Kategori',
			'kategori' => $this->kategorimodel->getbyNormal()
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
			
			$datenow = date('Y-m-d H:i:s');
			$data = [
			'kategori_nm' => $kategori_nm,
			'created_dttm' => $datenow,
			'created_user' => $this->session->user_id
			];

			$save = $this->kategorimodel->save($data);
			if ($save) {
				return true;
			} else {
				return false;
			}
			
		}
	}

	public function update(){
		$id = $this->request->getVar('id');
		$kategori_nm = $this->request->getVar('kategori_nm');
		
			// $session = \Config\Services::session();
			// $session->start();
			$datenow = date('Y-m-d H:i:s');
			$data = [
			'kategori_nm' => $kategori_nm,
			'updated_dttm' => $datenow,
			'updated_user' => $this->session->user_id
			];

			$save = $this->kategorimodel->update($id,$data);
			if ($save) {
				return true;
			} else {
				return false;
			}
		
	}

	public function formedit(){
		$kategori_id = $this->request->getVar('id');
		$res = $this->kategorimodel->find($kategori_id);
		if (count($res)>0) {
				$ret = "<div class='modal-dialog'>"
	            . "<div class='modal-content'>"
	            . "<div class='modal-header'>"
	            . "<h4 class='modal-title'>Silahkan ganti data</h4>"
	             . "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>"
	            . "</div>"
	            . "<div class='modal-body'>"
	            . "<form>"
	            . "<input type='hidden' value='".$kategori_id."' class='form-control' id='kategori_id'>"
	            . "<div class='form-group'>"
	            . "<label for='recipient-name' class='control-label'>Nama Kategori</label>"
	            . "<input type='text' class='form-control' id='kategori_nm' value='".$res['kategori_nm']."'>"
	            . "</div>"
	            . "</form>"
	            . "</div>"
	            . "<div class='modal-footer'>"
	            . "<button type='button' class='btn btn-default waves-effect' data-dismiss='modal'>Close</button>"
	            . "<button onclick='update(".$kategori_id.")' type='button' class='btn btn-danger waves-effect waves-light'>Simpan</button>"
	            . "</div>"
	            . "</div>"
	            . "</div>";
	         return $ret;
		} else {
			
			return 'false';
		}
	}

	public function hapus(){
		$id = $this->request->getVar('id');
		$session = \Config\Services::session();
		$session->start();
		$datenow = date('Y-m-d H:i:s');
		$data = [
		'status_cd' => 'nullified',
		'nullified_dttm' => $datenow,
		'nullified_user' => $this->session->user_id
		];

		$update = $this->kategorimodel->update($id,$data);
		if ($save) {
			return true;
		} else {
			return false;
		}
	}

	

}
