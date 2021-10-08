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
            'items' => $this->itemModel->join('uoms', 'uoms.uom_id = items.uom_id')->findAll(5)
        ];

        return view('admin/_partials/item_list', $data);
    }

    public function monthlyCheckoutList()
    {
        $data = [
            'items' => $this->itemModel->getPrevMonthCheckoutData(),
        ];

        return view('admin/_partials/monthly_checkout', $data);
    }
}