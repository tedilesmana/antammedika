<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienModel extends Model
{
    protected $table      = 'pasiens';
    protected $primaryKey = 'id';

    // protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['user_id', 'name', 'age', 'phone', 'antrian', 'description', 'status', 'address'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // protected $validationRules    = ['password' => 'required'];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

   
}
