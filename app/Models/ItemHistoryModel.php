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
        $query .= "LEFT JOIN tbl_items ON tbl_items_history.item_id = tbl_items.item_id ";
        $query .= "LEFT JOIN tbl_uoms ON tbl_items.uom = tbl_uoms.uom_id ";
        $query .= "LEFT JOIN ( ";
        $query .= "SELECT first_name, last_name, email ";
        $query .= "FROM tbl_admins ";
        $query .= "UNION ";
        $query .= "SELECT first_name, last_name, email ";
        $query .= "FROM tbl_employees ";
        $query .= ") as tbl_users ON tbl_items_history.checked_by = tbl_users.email ";

        $result = $this->db->query($query);

        return $result->getResultArray();
    }
}
