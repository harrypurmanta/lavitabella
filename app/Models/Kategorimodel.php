<?php namespace App\Models;

use CodeIgniter\Model;

class Kategorimodel extends Model
{
    protected $table      = 'kategori_produk';
    // protected $primaryKey = 'user_id';
    // protected $allowedFields = ['user_nm', 'pwd0','user_group','person_id','status_cd', 'created_dttm','created_user','update_dttm','update_user','nullified_dttm','nullified_user'];
    // protected $useTimestamps = true;
    // protected $createdField  = 'created_dttm';
    // protected $updatedField  = 'update_dttm';
    // protected $deletedField  = 'nullified_dttm';


    public function save() {
        $Usersmodel = new Usersmodel();
        
    	$users = $Usersmodel->where('user_nm', $u)
                            ->where('pwd0',$p)
                            ->findAll();

        return $users;
    }
}