<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Produkmodel;
use App\Models\Kategorimodel;
class Produk extends BaseController
{

	
	protected $produkmodel;
	protected $kategorimodel;
	protected $session;
	public function __construct(){

		$this->produkmodel = new Produkmodel();
		$this->kategorimodel = new Kategorimodel();
		$this->session = \Config\Services::session();
		$this->session->start();

	}

	public function index() {
		$data = [
			'title' => 'Produk',
			'subtitle' => 'Produk',
			'produk' => $this->produkmodel->getbyNormal()
		];
		return view('backend/produk', $data);
	}


	public function save(){
		$produk_nm = $this->request->getVar('produk_nm');
		$kategori_id = $this->request->getVar('kategori_id');
		$harga = $this->request->getVar('harga');
		$produk_id = $this->request->getVar('produk_id');
		$datenow = date('Y-m-d H:i:s');

		if ($produk_id=='') {
			$data = [
			'produk_nm' => $produk_nm,
			'kategori_id' => $kategori_id,
			'produk_harga' => $harga,
			'created_dttm' => $datenow,
			'created_user' => $this->session->user_id
			];

			$save = $this->produkmodel->save($data);
			if ($save) {
				return true;
			} else {
				return false;
			}
		} else {
			$data = [
			'produk_nm' => $produk_nm,
			'kategori_id' => $kategori_id,
			'produk_harga' => $harga,
			'updated_dttm' => $datenow,
			'updated_user' => $this->session->user_id
			];

			$update = $this->produkmodel->update($produk_id,$data);
			if ($update) {
				return true;
			} else {
				return false;
			}
		}	
	}

	public function update(){
		$id = $this->request->getVar('id');
		$Produk_nm = $this->request->getVar('Produk_nm');
		
			// $session = \Config\Services::session();
			// $session->start();
			$datenow = date('Y-m-d H:i:s');
			$data = [
			'Produk_nm' => $Produk_nm,
			'updated_dttm' => $datenow,
			'updated_user' => $this->session->user_id
			];

			$save = $this->produkmodel->update($id,$data);
			if ($save) {
				return true;
			} else {
				return false;
			}
		
	}

	public function formadd(){
		$produk_id = $this->request->getVar('id');
		$kategori = $this->kategorimodel->getbyNormal();
		if ($produk_id!=null) {
			$res = $this->produkmodel->getbyId($produk_id);
			foreach ($res->getResult('array') as $key) {
				$ret = "<div class='modal-dialog'>"
	            . "<div class='modal-content'>"
	            . "<div class='modal-header'>"
	            . "<h4 class='modal-title'>Silahkan tambah data</h4>"
	             . "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>"
	            . "</div>"
	            . "<div class='modal-body'>"
	            . "<form>"
	            . "<div class='form-group'>"
	            . "<label for='recipient-name' class='control-label'>Nama Produk</label>"
	            . "<input type='hidden' id='produk_id' value='$produk_id'/>"
	            . "<input type='text' class='form-control' id='produk_nm' value='".$key['produk_nm']."'>"
	            . "</div>"
	            . "<div class='form-group'>"
	            . "<label for='recipient-name' class='control-label'>Kategori Produk</label>"
	            . "<select class='form-control' id='kategori_id' >";
	            foreach ($kategori as $k) {
	            	$ret .= "<option value='".$k['kategori_id']."'>".$k['kategori_nm']."</option>";
	            }
	        
	        $ret .= "</select>"
	            . "</div>"
	            . "<div class='form-group'>"
	            . "<label for='recipient-name' class='control-label'>Harga</label>"
	            . "<input type='text' class='form-control' id='harga' value='".$key['produk_harga']."'>"
	            . "</div>"
	            . "</form>"
	            . "</div>"
	            . "<div class='modal-footer'>"
	            . "<button type='button' class='btn btn-default waves-effect' data-dismiss='modal'>Close</button>"
	            . "<button onclick='simpan()' type='button' class='btn btn-danger waves-effect waves-light'>Simpan</button>"
	            . "</div>"
	            . "</div>"
	            . "</div>";
			}
				
	         return $ret;
		} else {
			$ret = "<div class='modal-dialog'>"
	            . "<div class='modal-content'>"
	            . "<div class='modal-header'>"
	            . "<h4 class='modal-title'>Silahkan tambah data</h4>"
	             . "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>"
	            . "</div>"
	            . "<div class='modal-body'>"
	            . "<form>"
	            . "<div class='form-group'>"
	            . "<label for='recipient-name' class='control-label'>Nama Produk</label>"
	            . "<input type='text' class='form-control' id='produk_nm' >"
	            . "</div>"
	            . "<div class='form-group'>"
	            . "<label for='recipient-name' class='control-label'>Kategori Produk</label>"
	            . "<select class='form-control' id='kategori_id' >";
	            foreach ($kategori as $k) {
	            	$ret .= "<option value='".$k['kategori_id']."'>".$k['kategori_nm']."</option>";
	            }
	        
	        $ret .= "</select>"
	            . "</div>"
	            . "<div class='form-group'>"
	            . "<label for='recipient-name' class='control-label'>Harga</label>"
	            . "<input type='number' class='form-control' id='harga' >"
	            . "</div>"
	            . "</form>"
	            . "</div>"
	            . "<div class='modal-footer'>"
	            . "<button type='button' class='btn btn-default waves-effect' data-dismiss='modal'>Close</button>"
	            . "<button onclick='simpan()' type='button' class='btn btn-danger waves-effect waves-light'>Simpan</button>"
	            . "</div>"
	            . "</div>"
	            . "</div>";
	         return $ret;
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

		$update = $this->produkmodel->update($id,$data);
		if ($update) {
			return true;
		} else {
			return false;
		}
	}

	

}
