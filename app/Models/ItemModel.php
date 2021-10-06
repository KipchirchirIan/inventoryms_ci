<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Database\Query;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class ItemModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'tbl_items';
    protected $primaryKey = 'item_id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'item_name',
        'item_description',
        'quantity',
        'uom',
        'category_id',
        'note',
        'added_by',
        'last_modified_by',
    ];

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
        $sql = "select tbl_items_history.item_id, tbl_items.item_name, uom_full, sum(check_out) as checkout_count
                from tbl_items_history
                inner join tbl_items
                on tbl_items_history.item_id = tbl_items.item_id
                inner join tbl_uoms
                on tbl_uoms.uom_id = tbl_items.uom
                where month(tbl_items_history.created_at) = month(curdate()) - 1
                group by item_id;";

        return $this->db->query($sql)->getResultArray();
    }
}
