<?php

namespace Tests\Support\Models;


class SuperAdminFabricator extends \App\Models\SuperAdminModel
{
    public function fake(&$faker)
    {
        return [
            'id' => $faker->unique()->randomDigitNotNull(),
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'email' => $faker->email,
            'password' => password_hash('1234', PASSWORD_DEFAULT),
        ];
    }
}