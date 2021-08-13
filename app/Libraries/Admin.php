<?php

namespace App\Libraries;
use App\Models\AdminModel;
class Admin
{
    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function adminCount()
    {
        $rowCount = $this->adminModel->countAll(false);

        $data = [
            'admin' => [
                'count' => $rowCount,
            ]
        ];

        return view('admin/_partials/admin_stats', $data);
    }
}