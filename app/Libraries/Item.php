<?php

namespace App\Libraries;

use App\Models\ItemModel;

class Item
{
    public function __construct()
    {
        $this->itemModel = new ItemModel();
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
}