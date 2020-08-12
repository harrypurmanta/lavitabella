<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Discountmodel;

class Discount extends BaseController
{

	
	protected $discountmodel;
	protected $session;
	public function __construct(){

		$this->discountmodel = new Discountmodel();
		$this->session = \Config\Services::session();
		$this->session->start();

	}

	public function index() {
		$data = [
			'title' => 'discount',
			'subtitle' => 'discount',
			'discount' => $this->discountmodel->getbyNormal()
		];
		return view('backend/discount', $data);
	}

	public function tambahdata(){
		$data = [
			'title' => 'Tambah Data discount',
			'subtitle' => 'Tambah Data discount'
		];
		return view('backend/adddiscount', $data);
	}

	public function save(){
		$discount_nm = $this->request->getVar('discount_nm');
		$bykatnm = $this->discountmodel->getbyKatnm($discount_nm);
		if (count($bykatnm)>0) {
			return 'already';
		} else {
			
			$datenow = date('Y-m-d H:i:s');
			$data = [
			'discount_nm' => $discount_nm,
			'created_dttm' => $datenow,
			'created_user' => $this->session->user_id
			];

			$save = $this->discountmodel->save($data);
			if ($save) {
				return true;
			} else {
				return false;
			}
			
		}
	}

	public function update(){
		$id = $this->request->getVar('id');
		$discount_nm = $this->request->getVar('discount_nm');
		
			// $session = \Config\Services::session();
			// $session->start();
			$datenow = date('Y-m-d H:i:s');
			$data = [
			'discount_nm' => $discount_nm,
			'updated_dttm' => $datenow,
			'updated_user' => $this->session->user_id
			];

			$save = $this->discountmodel->update($id,$data);
			if ($save) {
				return true;
			} else {
				return false;
			}
		
	}

	public function formedit(){
		$discount_id = $this->request->getVar('id');
		$res = $this->discountmodel->find($discount_id);
		if (count($res)>0) {
				$ret = "<div class='modal-dialog'>"
	            . "<div class='modal-content'>"
	            . "<div class='modal-header'>"
	            . "<h4 class='modal-title'>Silahkan ganti data</h4>"
	             . "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>"
	            . "</div>"
	            . "<div class='modal-body'>"
	            . "<form>"
	            . "<input type='hidden' value='".$discount_id."' class='form-control' id='discount_id'>"
	            . "<div class='form-group'>"
	            . "<label for='recipient-name' class='control-label'>Nama discount</label>"
	            . "<input type='text' class='form-control' id='discount_nm' value='".$res['discount_nm']."'>"
	            . "</div>"
	            . "</form>"
	            . "</div>"
	            . "<div class='modal-footer'>"
	            . "<button type='button' class='btn btn-default waves-effect' data-dismiss='modal'>Close</button>"
	            . "<button onclick='update(".$discount_id.")' type='button' class='btn btn-danger waves-effect waves-light'>Simpan</button>"
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

		$update = $this->discountmodel->update($id,$data);
		if ($save) {
			return true;
		} else {
			return false;
		}
	}

	

}
