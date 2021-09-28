<?php

namespace App\Libraries;

use App\Models\ItemModel;

class Item
{
    public function __construct()
    {
        $this->itemModel = new ItemModel();

        helper('uom');
    }

    public function itemCount()
    {
        $rowCount = $this->itemModel->countAll();

        $data = [
            'item' => [
                'count' => $rowCount,
            ]
        ];

        return view('admin/_partials/item_stats', $data);
    }

    public function itemList()
    {
        $data = [
            'items' => $this->itemModel->join('tbl_uoms', 'tbl_uoms.uom_id = tbl_items.uom')->findAll(5)
        ];

        return view('admin/_partials/item_list', $data);
    }
}