<?php namespace App\Models;

use CodeIgniter\Model;

class Employeemodel extends Model
{
    protected $table      = 'employee';
    protected $primaryKey = 'employee_id';
    protected $allowedFields = ['person_id','status_cd', 'created_dttm','created_user','update_dttm','update_user','nullified_dttm','nullified_user'];
    // protected $useTimestamps = true;
    // protected $createdField  = 'created_dttm';
    // protected $updatedField  = 'update_dttm';
    // protected $deletedField  = 'nullified_dttm';

  
}