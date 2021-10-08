<?php

namespace App\Models;

use CodeIgniter\Model;

class UomModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'uoms';
	protected $primaryKey           = 'uom_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
	    'uom_short',
        'uom_full',
        'uom_description',
        'added_by'
        ];

    protected $useTimestamps = true;

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

}
