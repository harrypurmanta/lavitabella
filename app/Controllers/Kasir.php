<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usersmodel;
use App\Models\Mejamodel;
use App\Models\Billingmodel;

class Kasir extends BaseController
{
	protected $mejamodel;
	protected $billingmodel;
	protected $session;
	public function __construct(){
		$this->mejamodel = new Mejamodel();
		$this->billingmodel = new Billingmodel();
		$this->session = \Config\Services::session();
		$this->session->start();
	}
	
	public function index() {
		$data = [
			'title' => 'Kasir Dashboard',
			'subtitle' => 'Kasir',
			'meja' => $this->mejamodel->getbyNormal()
		];
		return view('backend/kasir', $data);
	}

	public function getbymejaidkasir() {
		$id = $this->request->getPost('id');
		$res = $this->billingmodel->getbyMejaidkasir($id)->getResult();

		if (count($res)>0) {
		

			$subtotal = 0;
			$ret = "<div align='center' id='div-item'>
						<div style='margin-top: 30px;'>
							<p>
								<span style='font-size: 20px;'>Butcher Steak & Pasta Palembang</span><br>
								<span style='font-size: 20px;'>Jl. AKBP Cek Agus No. 284, Palembang</span><br>
								<span style='font-size: 20px;'>Sumatera Selatan, 30114, 07115626366</span>
							</p>
						</div>
					</div>";
			$ret .= "<table width='100%' style='margin-top: 20px;font-size: 20px;'>
				        <tr>
				          <td align='left'>Tanggal</td>
				          <td align='right'></td>
				        </tr>
				        <tr>
				          <td align='left'>Bill Name</td>
				          <td align='right'>Pendy</td>
				        </tr>
				        <tr>
				          <td align='left'>Collected By</td>
				          <td align='right'>Fita PS</td>
				        </tr>
				      </table>
				      <hr style='border: 1px solid red'>
				      <table  style='font-size: 30px;' width='100%'>";
			foreach ($res as $key) {
				$total = $key->produk_harga * $key->qty;
				if ($key->statusbilling == 'verified') {
					if ($key->status_cd == "nullified") {
						$buttonproduk = "";
						$style = "style='text-decoration: line-through;'";
					} else {
						$subtotal = $subtotal + $total;
						$buttonproduk = "";
						$style = "";
					}
				} else {
					if ($key->status_cd == "nullified") {
						$buttonproduk = "<button onclick='enableproduk($key->billing_item_id)' type='button' class='btn btn-success'>Enable</button>";
						$style = "style='text-decoration: line-through;'";
					} else {
						$subtotal = $subtotal + $total;
						$buttonproduk = "<button onclick='disableproduk($key->billing_item_id)' type='button' class='btn btn-danger'>Disable</button>";
						$style = "";
					}
				}

				$ret .= "<tr>
				        <td colspan='3' align='left' style='font-weight: bold;font-size: 20px;'>
				            <span ".$style.">$key->produk_nm</span> ".$buttonproduk."
				          </td>
				        </tr>
				        <tr style='font-size: 20px;'>
				          <td align='left' width='50'><span ".$style.">$key->qty X</span></td>
				          <td align='center'><span ".$style.">@".number_format($key->produk_harga)."</span></td>
				          <td align='right'><span ".$style.">".number_format($total)."</span></td>
				        </tr>
				        <tr style='line-height:20px;'>
				        <td>&nbsp </td>
				        <td></td>
				        <td></td>
				        </tr>";
				 }
				$ret .= "</table>
						<hr style='border: 1px solid red'>";
				$tax = $subtotal * 0.10;
				$service = $subtotal * 0.05;
				$grandtotal = $subtotal + $tax + $service;
				        
				$ret .= "<table style='font-size: 20px; margin-top:30px;' width='100%'>
				        <tr>
				          <td align='left'>Subtotal</td>
				          <td colspan='2' align='right'>Rp. ".number_format($subtotal)."</td>
				        </tr>
				        <tr>
				          <td align='left'>Tax</td>
				          <td colspan='2' align='right'>Rp. ".number_format($tax)."</td>
				        </tr>
				        <tr>
				          <td align='left'>Service</td>
				          <td colspan='2' align='right'>Rp. ".number_format($service)."</td>
				        </tr>
				        <tr>
				          <td align='left'>Rounding Amount</td>
				          <td colspan='2' align='right'>Rp. dak tau rumusnyo</td>
				        </tr>
				       
				        <tr>
				          <td align='left' style='font-weight:bold;'>Total</td>
				          <td colspan='2' align='right'>Rp. ".number_format($grandtotal)."</td>
				        </tr>
						</table>
						<hr style='border: 1px solid red;margin-bottom:100px;'>";
		} else {
			$ret = "<div align='center'><h3>TIDAK ADA PESANAN !!</h3> <button class='meja-button' type='button' onclick='backtowaiters()'>Kembali</button></div>";
		}
  		return $ret;
	}

}
