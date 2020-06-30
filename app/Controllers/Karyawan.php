<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Karyawanmodel;

class Karyawan extends BaseController
{

	
	protected $karyawanmodel;
	public function __construct(){

		$this->karyawanmodel = new karyawanmodel();

	}

	public function index() {
		$data = [
			'title' => 'Karyawan',
			'subtitle' => 'Karyawan',
			'karyawan' => $this->karyawanmodel->findAll()
		];
		return view('backend/karyawan', $data);
	}

	public function tambahdata(){
		$data = [
			'title' => 'Tambah Data Karyawan',
			'subtitle' => 'Tambah Data Karyawan'
		];
		return view('backend/addKaryawan', $data);
	}

	public function save(){
		$Karyawan_nm = $this->request->getVar('Karyawan_nm');
		$bykatnm = $this->karyawanmodel->getbyKatnm($Karyawan_nm);
		if (count($bykatnm)>0) {
			return 'already';
		} else {
			$session = \Config\Services::session();
			$session->start();
			$datenow = date('Y-m-d H:i:s');
			$data = [
			'Karyawan_nm' => $Karyawan_nm,
			'created_dttm' => $datenow,
			'created_user' => $session->user_id
			];

			$save = $this->karyawanmodel->save($data);
			if ($save) {
				return true;
			} else {
				return false;
			}
			
		}
	}

	public function update(){
		$id = $this->request->getVar('id');
		$Karyawan_nm = $this->request->getVar('Karyawan_nm');
		$bykatnm = $this->karyawanmodel->getbyKatnm($Karyawan_nm);

		if (count($bykatnm)>0) {
			return 'already';
		} else {
			$session = \Config\Services::session();
			$session->start();
			$datenow = date('Y-m-d H:i:s');
			$data = [
			'Karyawan_nm' => $Karyawan_nm,
			'updated_dttm' => $datenow,
			'updated_user' => $session->user_id
			];

			$save = $this->karyawanmodel->update($id,$data);
			if ($save) {
				return true;
			} else {
				return false;
			}
		}
	}

	public function formedit(){
		$Karyawan_id = $this->request->getVar('id');
		$res = $this->karyawanmodel->find($Karyawan_id);
		if (count($res)>0) {
				$ret = "<div class='modal-dialog'>"
	            . "<div class='modal-content'>"
	            . "<div class='modal-header'>"
	            . "<h4 class='modal-title'>Silahkan ganti data</h4>"
	             . "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>"
	            . "</div>"
	            . "<div class='modal-body'>"
	            . "<form>"
	            . "<input type='hidden' value='".$Karyawan_id."' class='form-control' id='Karyawan_id'>"
	            . "<div class='form-group'>"
	            . "<label for='recipient-name' class='control-label'>Nama Karyawan</label>"
	            . "<input type='text' class='form-control' id='Karyawan_nm' value='".$res['Karyawan_nm']."'>"
	            . "</div>"
	            . "</form>"
	            . "</div>"
	            . "<div class='modal-footer'>"
	            . "<button type='button' class='btn btn-default waves-effect' data-dismiss='modal'>Close</button>"
	            . "<button onclick='update(".$Karyawan_id.")' type='button' class='btn btn-danger waves-effect waves-light'>Simpan</button>"
	            . "</div>"
	            . "</div>"
	            . "</div>";
	         return $ret;
		} else {
			
			return 'false';
		}
	}

	

}
