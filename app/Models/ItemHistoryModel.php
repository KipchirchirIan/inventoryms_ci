<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemHistoryModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'tbl_items_history';
	protected $primaryKey           = 'item_history_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
	    'item_id',
        'check_in',
        'check_out',
        'checked_by',
    ];

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;
}
