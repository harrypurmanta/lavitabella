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

	public function formedit(){
		$kategori_id = $this->request->getVar('id');
		$res = $this->kategorimodel->find($kategori_id);
		if (count($res)>0) {
			foreach ($res->getResultArray() as $k) {
				$ret = "<div class='modal-dialog'>"
	            . "<div class='modal-content'>"
	            . "<div class='modal-header'>"
	            . "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>"
	            . "<h4 class='modal-title'>Modal Content is Responsive</h4>"
	            . "</div>"
	            . "<div class='modal-body'>"
	            . "<form>"
	            . "<input type='hidden' value='".$kategori_id."' class='form-control' id='kategori_id'>"
	            . "<div class='form-group'>"
	            . "<label for='recipient-name' class='control-label'>Recipient:</label>"
	            . "<input type='text' class='form-control' id='kategori_nm' value='".$k->kategori_nm."'>"
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
			}
		} else {
			
			return 'false';
		}
	}

	

}
