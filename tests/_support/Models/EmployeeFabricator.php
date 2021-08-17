<?php

namespace Tests\Support\Models;

use App\Models\EmployeeModel;
use CodeIgniter\Test\Fabricator;

class EmployeeFabricator extends EmployeeModel
{
    public function fake(&$faker)
    {
        return [
            'emp_id' => $faker->unique()->randomDigitNotNull(),
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'email' => $faker->email,
            'password' => password_hash('1234', PASSWORD_DEFAULT),
            'added_by' => random_int(1, Fabricator::getCount('db_tbl_superadmins')),
        ];
    }
}