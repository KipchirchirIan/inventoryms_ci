<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class EmployeeModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'tbl_employees';
    protected $primaryKey = 'emp_id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $protectFields = true;
    protected $allowedFields = [
        'first_name',
        'last_name',
        'position',
        'email',
        'password',
        'added_by'
    ];

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    public function __construct(ConnectionInterface &$db = null, ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);
        $db = \Config\Database::connect('default');
    }

    public function getSingle($id)
    {
        $where['email'] = $id;
        $result = $this->db->table($this->table)->where('email', $where)->get();

        return $result->getRowArray();
    }
}
