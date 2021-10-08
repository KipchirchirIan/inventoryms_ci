<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class ItemHistoryModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'items_history';
    protected $primaryKey = 'item_history_id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'item_id',
        'check_in',
        'check_out',
        'checked_by',
    ];

    protected $useTimestamps = true;

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    public function findAll(int $limit = 0, int $offset = 0)
    {
        // Todo: Use prepared statements or query builders here
        $query = "SELECT * ";
        $query .= "FROM items_history ";
        $query .= "LEFT JOIN items ON items_history.item_id = items.item_id ";
        $query .= "LEFT JOIN uoms ON items.uom_id = uoms.uom_id ";
        $query .= "LEFT JOIN ( ";
        $query .= "SELECT first_name, last_name, email ";
        $query .= "FROM admins ";
        $query .= "UNION ";
        $query .= "SELECT first_name, last_name, email ";
        $query .= "FROM employees ";
        $query .= ") as users ON items_history.checked_by = users.email ";

        $result = $this->db->query($query);

        return $result->getResultArray();
    }
}
