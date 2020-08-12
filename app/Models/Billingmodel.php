<?php namespace App\Models;

use CodeIgniter\Model;

class Billingmodel extends Model
{
    protected $table      = 'billing';
    protected $primaryKey = 'billing_id ';
    protected $allowedFields = ['meja_id','member_id','discount_id','order_id','payplan_id','balance','ttl_paid','ttl_amount','ttl_discount','amt_before_discount', 'status_cd', 'created_dttm','created_user','update_dttm','update_user','nullified_dttm','nullified_user'];
    protected $billingmodel;
    
    // protected $useTimestamps = true;
    // protected $createdField  = 'created_dttm';
    // protected $updatedField  = 'update_dttm';
    // protected $deletedField  = 'nullified_dttm';

    public function getbyMejaid($id){
    	$query = $this->db->table('billing a');
    	$query->select('b.qty,c.produk_id,c.produk_nm,c.produk_harga,b.status_cd,b.billing_item_id,a.billing_id,a.status_cd as statusbilling');
    	$query->join('billing_item b','b.billing_id=a.billing_id');
    	$query->join('produk c','c.produk_id=b.produk_id');
    	$query->join('kategori_produk d','d.kategori_id=c.kategori_id');
    	$query->whereIn('a.status_cd',['normal','verified']);
    	$query->where('a.meja_id',$id);
    	return $query->get();
    }

    public function getbyMejaidcustomer($id){
        $query = $this->db->table('billing a');
        $query->select('b.qty,c.produk_id,c.produk_nm,c.produk_harga,b.status_cd,b.billing_item_id');
        $query->join('billing_item b','b.billing_id=a.billing_id');
        $query->join('produk c','c.produk_id=b.produk_id');
        $query->join('kategori_produk d','d.kategori_id=c.kategori_id');
        $query->where('a.status_cd','normal');
        $query->where('b.status_cd','normal');
        $query->where('a.meja_id',$id);
        return $query->get();
    }

    public function getitembyBillid($id) {
    	$query = $this->db->table('billing_item a');
    	$query->select('a.qty,b.produk_nm,b.produk_id');
    	$query->join('produk b','b.produk_id=a.produk_id');
    	$query->where('a.status_cd','normal');
    	$query->where('a.billing_id',$id);
    	return $query->get();
    }

    public function simpanbilling($data) {
    	$builder = $this->db->table('billing');
        $builder->insert($data);
    	return $this->db->insertID();

    }

    public function simpanbillitem($data) {
    	$builder = $this->db->table('billing_item');
        return $builder->insert($data);
    }

    public function getKategoriid(){

    }

    public function setnullifieditem($id){
        $query = $this->db->table('billing_item');
        $query->set('status_cd','nullified');
        $query->where('billing_item_id',$id);
        return $query->update();
    }

    public function setnormalitem($id){
        $query = $this->db->table('billing_item');
        $query->set('status_cd','normal');
        $query->where('billing_item_id',$id);
        return $query->update();
    }

    public function verifybilling($id){
        $query = $this->db->table('billing');
        $query->set('status_cd','verified');
        $query->where('billing_id',$id);
        return $query->update();
    }

    public function batalbilling($id){
        $query = $this->db->table('billing');
        $query->set('status_cd','cancel');
        $query->where('billing_id',$id);
        return $query->update();
    }
    
}
