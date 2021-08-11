<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class AdminModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'tbl_admins';
	protected $primaryKey           = 'admin_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = ['first_name', 'last_name', 'position', 'email', 'password'];

	// Validation
	protected $validationRules      = 'admin_create';
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	public  function __construct(ConnectionInterface &$db = null, ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);
        $db = \Config\Database::connect('default');
    }

    public function create($data)
    {
        $this->db->table($this->table)->insert($data);

        return $this->db->insertID();
    }

    public function getSingle($email)
    {
        $where['email'] = $email;
        $result = $this->db->table($this->table)->where('email', $where)->get();

        return $result->getRowArray();
    }

}
