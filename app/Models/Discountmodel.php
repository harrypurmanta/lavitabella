<?php namespace App\Models;

use CodeIgniter\Model;

class discountmodel extends Model
{
    protected $table      = 'discount';
    protected $primaryKey = 'discount_id ';
    protected $allowedFields = ['discount_nm','value', 'status_cd', 'created_dttm','created_user','update_dttm','update_user','nullified_dttm','nullified_user'];
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
        return $this->db->table($this->table)
                ->where('status_cd','normal')
                ->get();
    }

    public function getbybillid($id) {
        return $this->db->table('billing_discount a')
                    ->select('*')
                    ->join('discount b','b.discount_id=a.discount_id')
                    ->where('a.status_cd','normal')
                    ->where('a.billing_id',$id)
                    ->get();
    }

    
    public function getmemberbynormal($id) {
        return $this->db->table('member a')
                    ->select('*')
                    ->join('discount b','b.discount_id=a.discount_id')
                    ->where('a.status_cd','normal')
                    ->where('a.billing_id',$id)
                    ->get();
    }

    public function removedckasir($id,$data){
        return $this->db->table('billing_discount')
                    ->set($data)
                    ->where('billing_discount_id',$id)
                    ->update();
    }
}