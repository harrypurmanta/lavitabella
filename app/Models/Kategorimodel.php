<?php namespace App\Models;

use CodeIgniter\Model;

class Kategorimodel extends Model
{
    protected $table      = 'kategori_produk';
    protected $primaryKey = 'kategori_id ';
    protected $allowedFields = ['kategori_nm', 'status_cd', 'created_dttm','created_user','update_dttm','update_user','nullified_dttm','nullified_user'];
    protected $kategorimodel;
    
    // protected $useTimestamps = true;
    // protected $createdField  = 'created_dttm';
    // protected $updatedField  = 'update_dttm';
    // protected $deletedField  = 'nullified_dttm';
    

    public function getbyKatnm($kategori_nm) {
        $this->kategorimodel = new Kategorimodel();
        
    	$kategori_nm = $this->kategorimodel->where('kategori_nm', $kategori_nm)
                            ->findAll();

        return $kategori_nm;
    }
}