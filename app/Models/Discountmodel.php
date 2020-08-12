<?php namespace App\Models;

use CodeIgniter\Model;

class discountmodel extends Model
{
    protected $table      = 'discount';
    protected $primaryKey = 'discount_id ';
    protected $allowedFields = ['discount_nm', 'status_cd', 'created_dttm','created_user','update_dttm','update_user','nullified_dttm','nullified_user'];
    protected $discountmodel;
    
    // protected $useTimestamps = true;
    // protected $createdField  = 'created_dttm';
    // protected $updatedField  = 'update_dttm';
    // protected $deletedField  = 'nullified_dttm';
    

    public function getbyKatnm($discount_nm) {
        $this->discountmodel = new discountmodel();
        
    	$discount_nm = $this->discountmodel->where('discount_nm', $discount_nm)
                            ->findAll();

        return $discount_nm;
    }

    public function getbyNormal() {
        $this->discountmodel = new discountmodel();
        
        $discount = $this->discountmodel->where('status_cd', 'normal')
                            ->findAll();

        return $discount;
    }
}