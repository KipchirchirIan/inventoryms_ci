<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
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
}
