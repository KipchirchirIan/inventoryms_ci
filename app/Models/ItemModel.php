<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Database\Query;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class ItemModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'items';
    protected $primaryKey = 'item_id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $protectFields = true;
    protected $allowedFields = [
        'item_name',
        'item_description',
        'quantity',
        'uom_id',
        'category_id',
        'note',
        'added_by',
        'last_modified_by',
    ];

    protected $useTimestamps = true;

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    public function addQty($id, $quantity, $subject)
    {
        $this->builder->set('quantity', "quantity + $quantity", false);
        $this->builder->set('last_modified_by', $subject);
        $this->builder->where('item_id', $id);
        $this->builder->limit(1);

        return $this->builder->update();
    }

    public function subtractQty($id, $quantity, $subject)
    {
        $this->builder->set('quantity', "quantity - $quantity", false);
        $this->builder->set('last_modified_by', $subject);
        $this->builder->where('item_id', $id);
        $this->builder->limit(1);

        return $this->builder->update();
    }

    public function getPrevMonthCheckoutData()
    {
        $sql = "select items_history.item_id, items.item_name, uom_full, sum(check_out) as checkout_count
                from items_history
                inner join items
                on items_history.item_id = items.item_id
                inner join uoms
                on uoms.uom_id = items.uom_id
                where month(items_history.created_at) = month(curdate()) - 1
                group by item_id;";

        return $this->db->query($sql)->getResultArray();
    }

    public function getChekoutDataByMonthYear($month, $year)
    {
        $sql = "select items_history.item_id, items.item_name, uom_full, sum(check_out) as checkout_count
                from items_history
                inner join items
                on items_history.item_id = items.item_id
                inner join uoms
                on uoms.uom_id = items.uom_id
                where month(items_history.created_at) = {$month} and year(items_history.created_at) = {$year}
                group by item_id
                limit 5;";

        return $this->db->query($sql)->getResultArray();
    }
}
