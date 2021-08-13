<?php

namespace App\Libraries;

use App\Models\EmployeeModel;

class Employee
{
    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
    }

    public function employeeCount()
    {
        $rowCount = $this->employeeModel->countAll(false);

        $data = [
            'employee' => [
                'count' => $rowCount,
            ]
        ];

        return view('admin/_partials/employee_stats', $data);
    }
}