<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Karyawanmodel;
use App\Models\Employeemodel;
use App\Models\Usersmodel;
class Karyawan extends BaseController
{

	
	protected $karyawanmodel;
	protected $employeemodel;
	protected $usersmodel;
	public function __construct(){
		$this->usersmodel = new Usersmodel();
		$this->karyawanmodel = new Karyawanmodel();
		$this->employeemodel = new Employeemodel();

	}

	public function index() {
		$data = [
			'title' => 'Karyawan',
			'subtitle' => 'Karyawan',
			//'karyawan' => $this->karyawanmodel->findAll()
		];
		return view('backend/karyawan',$data);
	}

	public function formdaftarkaryawan() {
		

		$data = [
			'title' => 'Karyawan',
			'subtitle' => 'Karyawan',
			'id' => $this->request->uri->getSegment(3)
		];

		return view('backend/formdaftarkaryawan',$data);
	}

	public function cariByname(){
		$person_nm = $this->request->getVar('person_nm');
		$karyawan = $this->karyawanmodel->getBylikenm($person_nm);
		if (count($karyawan)>0) {
			$ret = "";
		      foreach ($karyawan as $key) {
		        $ret .= "<a onclick='clickpatient($key->person_id)'>"
		                . "<div style='background-color:yellow;padding:5px;border-radius:10px;margin-top: 5px;margin-bottom: 5px; border-left: 4px solid #ccc;'>"
		                . "<p style='display: inline-block; font-size: 14px;font-weight: bold;margin-left:3px;margin-bottom: 0;'>".$key->person_nm."</p>"
		                . "<p style='float:right;display: inline-block;font-size: 14px;font-weight: bold;margin-left:3px;margin-bottom: 0;'>".$key->ext_id."</p>"
		                . "<p style='font-size: 12px;margin-left:3px;margin-bottom: 0;'>".$key->addr_txt."</p>"
		                . "<p style='font-size: 12px;margin-left:3px;margin-bottom: 0;'>".$key->birth_dttm."</p>"
		                . "</div>"
		                . "</a>";
		      }
			
		} else {
			$ret = "<a>"
                . "<div style='background-color:yellow;padding:5px;border-radius:10px;margin-top: 5px;margin-bottom: 5px; border-left: 4px solid #ccc;'>"
                . "<p style='display: inline-block; font-size: 14px;font-weight: bold;margin-left:3px;margin-bottom: 0;'>DATA KARYAWAN TIDAK ADA . . .</p>"
                . "</div>"
                . "</a>";
		}
		return $ret;

	}

	public function save(){
		$person_id 		= $this->request->getVar('person_id');
		$person_nm 		= $this->request->getVar('person_nm');
		$ext_id 		= $this->request->getVar('ext_id');
		$gender_cd 		= $this->request->getVar('gender_cd');
		$birth_dttm 	= $this->request->getVar('birth_dttm');
		$birth_place	= $this->request->getVar('birth_place');
		$cellphone 		= $this->request->getVar('cellphone');
		$addr_txt 		= $this->request->getVar('addr_txt');
		$ext_idx 		= $this->karyawanmodel->getbyext_id($ext_id);
		
			$session = \Config\Services::session();
			$session->start();
			$datenow = date('Y-m-d H:i:s');
			
			if ($person_id=='') {
				$data = [
					'person_nm' => $person_nm,
					'ext_id' => $ext_id,
					'gender_cd' => $gender_cd,
					'birth_dttm' => $birth_dttm,
					'birth_place' => $birth_place,
					'cellphone' => $cellphone,
					'addr_txt' => $addr_txt,
					'created_dttm' => $datenow,
					'created_user' => $session->user_id
					];
				$person_id = $this->karyawanmodel->simpan($data);
			// echo $person_id;exit;
				if ($person_id !='') {
					$dataemployee = [
					'person_id' => $person_id,
					'created_dttm' => $datenow,
					'created_user' => $session->user_id
					];
					$saveEmp = $this->employeemodel->save($dataemployee);
					return true;
				} else {
					return false;
				}
			} else {
				$data = [
				'person_nm' => $person_nm,
				'ext_id' => $ext_id,
				'gender_cd' => $gender_cd,
				'birth_dttm' => $birth_dttm,
				'birth_place' => $birth_place,
				'cellphone' => $cellphone,
				'addr_txt' => $addr_txt,
				'updated_dttm' => $datenow,
				'updated_user' => $session->user_id
				];
				$update = $this->karyawanmodel->update($person_id,$data);
				if ($update) {
					return true;
				} else {
					return false;
				}
			}
			
			
	}

	public function profiletab(){
		$id = $this->request->getVar('id');
		$res = $this->karyawanmodel->getbyId($id);
		$ret = "";
		foreach ($res as $key) {
		list($dt,$dd) = explode(' ',$key->birth_dttm);
		$newDate = date("m-d-Y", strtotime($dt));
		$date = str_replace('-','/',$newDate);

		$ret = "<div class='p-20'>"
                . "<form action='#' class='form-horizontal'>"
                . "<div class='form-body'>"
                . "<h3 class='box-title'>Person Info</h3>"
                . "<hr class='m-t-0 m-b-40'>"
                . "<div class='row'>"
                . "<div class='col-md-6'>"
                . "<div class='form-group row'>"
                . "<label class='control-label text-right col-md-3'>Nama Lengkap</label>"
                . "<div class='col-md-9'>"
                . "<input type='hidden' value='$id' id='person_id'/>"
                . "<input type='text' class='form-control' id='person_nm' value='$key->person_nm'>"
                . "</div>"
                . "</div>"
                . "</div>"
                . "<!--/span-->"
                . "<div class='col-md-6'>"
                . "<div class='form-group has-danger row'>"
                . "<label class='control-label text-right col-md-3'>Nomor Identitas</label>"
                . "<div class='col-md-9'>"
                . "<input type='text' class='form-control' id='ext_id' value='$key->ext_id'>"
                . "</div>"
                . "</div>"
                . "</div>"
                . "<!--/span-->"
                . "</div>"
                . "<!--/row-->"
                . "<div class='row'>"
                . "<div class='col-md-6'>"
                . "<div class='form-group row'>"
                . "<label class='control-label text-right col-md-3'>Jenis Kelamin</label>"
                . "<div class='col-md-9'>"
                . "<select class='form-control custom-select' id='gender_cd'>"
                . "<option value='m'>Laki-laki</option>"
                . "<option value='f'>Perempuan</option>"
                . "</select>"
                . "</div>"
                . "</div>"
                . "</div>"
                . "<!--/span-->"
                . "<div class='col-md-6'>"
                . "<div class='form-group row'>"
                . "<label class='control-label text-right col-md-3'>Tanggal Lahir</label>"
                . "<div class='col-md-9'>"
                . "<span class='control-label'>$date</span>"
                . "<input type='date' class='form-control' id='birth_dttm' value='$date'>"
                . "</div>"
                . "</div>"
                . "</div>"
                . "<!--/span-->"
                . "</div>"
                . "<!--/row-->"
                . "<div class='row'>"
                . "<div class='col-md-6'>"
                . "<div class='form-group row'>"
                . "<label class='control-label text-right col-md-3'>Tempat Lahir</label>"
                . "<div class='col-md-9'>"
                . "<input type='text' class='form-control' id='birth_place' value='$key->birth_place'>"
                . "</div>"
                . "</div>"
                . "</div>"
                . "<!--/span-->"
                . "<div class='col-md-6'>"
                . "<div class='form-group row'>"
                . "<label class='control-label text-right col-md-3'>No. Telp</label>"
                . "<div class='col-md-9'>"
                . "<input type='text' class='form-control' id='cellphone' value='$key->cellphone'>"
                . "</div>"
                . "</div>"
                . "</div>"
                . "<!--/span-->"
                . "</div>"
                . "<div class='row'>"
                . "<div class='col-md-9'>"
                . "<div class='form-group row'>"
                . "<label class='control-label text-right col-md-3'>Alamat</label>"
                . "<div class='col-md-9'>"
                . "<textarea type='text' class='form-control' id='addr_txt'>$key->addr_txt</textarea>"
                . "</div>"
                . "</div>"
                . "</div>"
                . "</div>"
                . "</div>"
                . "<hr>"
                . "<div class='form-actions'>"
                . "<div class='row'>"
                . "<div class='col-md-6'>"
                . "<div class='row'>"
                . "<div class='col-md-offset-3 col-md-9'>"
                . "<button onclick='simpan()' type='button' class='btn btn-success'>Submit</button> " 
                . "<button type='button' class='btn btn-inverse'>Cancel</button>"
                . "</div>"
                . "</div>"
                . "</div>"
                . "<div class='col-md-6'> </div>"
                . "</div>"
                . "</div>"
                . "</form>"
                . "</div>";

        }
         return $ret;
        
	}

	public function accounttab(){
		$id = $this->request->getVar('id');
		$res = $this->usersmodel->getbyId($id);
		$ret = "";
	foreach ($res as $key) {

		if ($key->user_nm!='') {
		$ret = "<div class='p-20'>"
                . "<form action='#' class='form-horizontal'>"
                . "<div class='form-body'>"
                . "<h3 class='box-title'>Person Info</h3>"
                . "<hr class='m-t-0 m-b-40'>"
                . "<div class='row'>"
                . "<div class='col-md-6'>"
                . "<div class='form-group row'>"
                . "<label class='control-label text-right col-md-3'>Username</label>"
                . "<div class='col-md-9'>"
                . "<input type='hidden' value='$id' id='person_id'/>"
                . "<input type='text' class='form-control' id='person_nm' value='$key->user_nm'>"
                . "</div>"
                . "</div>"
                . "</div>"
                . "<!--/span-->"
                . "<div class='col-md-6'>"
                . "<div class='form-group has-danger row'>"
                . "<label class='control-label text-right col-md-3'>Password</label>"
                . "<div class='col-md-9'>"
                . "<input type='password' class='form-control' id='ext_id' value='$key->pwd0'>"
                . "</div>"
                . "</div>"
                . "</div>"
                . "<!--/span-->"
                . "<div class='col-md-6'>"
                . "<div class='form-group has-danger row'>"
                . "<label class='control-label text-right col-md-3'>Level</label>"
                . "<div class='col-md-9'>"
                . "<select  class='form-control' id='user_group'>"
                . "<option ='owner'>Owner</option>"
                . "<option ='manajer'>Manajer</option>"
                . "<option ='waiters'>Kasir</option>"
                . "<option ='waiters'>Waiters</option>"
                . "</select>"
                . "</div>"
                . "</div>"
                . "</div>"
                . "<!--/span-->"
                . "</div>"
                . "</div>"
                . "<hr>"
                . "<div class='form-actions'>"
                . "<div class='row'>"
                . "<div class='col-md-6'>"
                . "<div class='row'>"
                . "<div class='col-md-offset-3 col-md-9'>"
                . "<button onclick='simpanuser()' type='button' class='btn btn-success'>Submit</button> " 
                . "<button type='button' class='btn btn-inverse'>Cancel</button>"
                . "</div>"
                . "</div>"
                . "</div>"
                . "<div class='col-md-6'> </div>"
                . "</div>"
                . "</div>"
                . "</form>"
                . "</div>";
        	
			} else {
				$ret = "<button onclick='formtambahuser($id)'>Tambah User</button>";
			}
		}
         return $ret;
        
	}

	public function formtambahuser(){
		$id = $this->request->getVar('id');

		$ret = "<div class='p-20'>"
                . "<form action='#' class='form-horizontal'>"
                . "<div class='form-body'>"
                . "<h3 class='box-title'>Person Info</h3>"
                . "<hr class='m-t-0 m-b-40'>"
                . "<div class='row'>"
                . "<div class='col-md-6'>"
                . "<div class='form-group row'>"
                . "<label class='control-label text-right col-md-3'>Username</label>"
                . "<div class='col-md-9'>"
                . "<input type='hidden' value='$id' id='person_id'/>"
                . "<input type='text' class='form-control' id='user_nm'>"
                . "</div>"
                . "</div>"
                . "</div>"
                . "<!--/span-->"
                . "<div class='col-md-6'>"
                . "<div class='form-group has-danger row'>"
                . "<label class='control-label text-right col-md-3'>Password</label>"
                . "<div class='col-md-9'>"
                . "<input type='password' class='form-control' id='pwd0'>"
                . "</div>"
                . "</div>"
                . "</div>"
                . "<!--/span-->"
                . "<div class='col-md-6'>"
                . "<div class='form-group has-danger row'>"
                . "<label class='control-label text-right col-md-3'>Level</label>"
                . "<div class='col-md-9'>"
                . "<select  class='form-control' id='user_group'>"
                . "<option ='owner'>Owner</option>"
                . "<option ='manajer'>Manajer</option>"
                . "<option ='waiters'>Kasir</option>"
                . "<option ='waiters'>Waiters</option>"
                . "</select>"
                . "</div>"
                . "</div>"
                . "</div>"
                . "<!--/span-->"
                . "</div>"
                . "</div>"
                . "<hr>"
                . "<div class='form-actions'>"
                . "<div class='row'>"
                . "<div class='col-md-6'>"
                . "<div class='row'>"
                . "<div class='col-md-offset-3 col-md-9'>"
                . "<button onclick='simpanuser($id)' type='button' class='btn btn-success'>Submit</button> " 
                . "<button type='button' class='btn btn-inverse'>Cancel</button>"
                . "</div>"
                . "</div>"
                . "</div>"
                . "<div class='col-md-6'> </div>"
                . "</div>"
                . "</div>"
                . "</form>"
                . "</div>";
        
		
         return $ret;
        
	}

	// public function update(){
	// 	$id = $this->request->getVar('id');
	// 	$Karyawan_nm = $this->request->getVar('Karyawan_nm');
	// 	$bykatnm = $this->karyawanmodel->getbyKatnm($Karyawan_nm);

	// 	if (count($bykatnm)>0) {
	// 		return 'already';
	// 	} else {
	// 		$session = \Config\Services::session();
	// 		$session->start();
	// 		$datenow = date('Y-m-d H:i:s');
	// 		$data = [
	// 		'Karyawan_nm' => $Karyawan_nm,
	// 		'updated_dttm' => $datenow,
	// 		'updated_user' => $session->user_id
	// 		];

	// 		$save = $this->karyawanmodel->update($id,$data);
	// 		if ($save) {
	// 			return true;
	// 		} else {
	// 			return false;
	// 		}
	// 	}
	// }

	// public function formdaftarkaryawan(){
	// 	return view('backend/formdaftarkaryawan');
	// }



	

}
