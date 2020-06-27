<?php namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'user_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    //protected $allowedFields = ['name', 'email'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_dttm';
    protected $updatedField  = 'update_dttm';
    protected $deletedField  = 'nullified_dttm';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function __construct()
    {
            $this->load->database();
    }

    public function checklogin() {
    	
    }
}