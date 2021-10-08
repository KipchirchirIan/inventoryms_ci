<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class SuperAdminModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'superadmins';
	protected $primaryKey           = 'sadmin_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = ['email', 'password'];

    protected $useTimestamps = true;

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;



	public function __construct(ConnectionInterface &$db = null, ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);
        $db = \Config\Database::connect();
    }

    public function getSingle($email)
    {
        $where['email'] = $email;
        $result = $this->db->table('superadmins')->where('email', $where)->get();

        return $result->getRowArray();
    }
}
