<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class SampleSeed extends Seeder
{
    public function run()
    {
        $now = new Time('now', 'Africa/Nairobi');

        $this->db->disableForeignKeyChecks();

        // Admins
        $data = [
            [
                'admin_id'   => 19,
                'first_name' => 'John',
                'last_name'  => 'Doe',
                'position'   => 'Accountant',
                'email'      => 'johndoe@rescuedada.org',
                'password'   => password_hash('12345678', PASSWORD_DEFAULT),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $this->db->table('admins')->truncate();
        $this->db->table('admins')->insertBatch($data);

        // Employees
        $data = [
            [
                'emp_id'     => 1,
                'first_name' => 'Daniel',
                'last_name'  => 'Copeland',
                'position'   => 'Receptionist',
                'email'      => 'DanielJCopeland@rescuedada.org',
                'password'   => password_hash('12345678', PASSWORD_DEFAULT),
                'added_by'   => 19,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $this->db->table('employees')->truncate();
        $this->db->table('employees')->insertBatch($data);

        // Categories
        $data = [
            [
                'category_id'          => 1,
                'category_name'        => 'Food',
                'category_description' => 'Food',
                'position'             => 1,
                'added_by'             => 19,
                'created_at'           => $now,
                'updated_at'           => $now,
            ],
            [
                'category_id'          => 2,
                'category_name'        => 'Clothing',
                'category_description' => 'Clothing',
                'position'             => 2,
                'added_by'             => 19,
                'created_at'           => $now,
                'updated_at'           => $now,
            ],
            [
                'category_id'          => 3,
                'category_name'        => 'Grooming',
                'category_description' => 'Grooming',
                'position'             => 3,
                'added_by'             => 19,
                'created_at'           => $now,
                'updated_at'           => $now,
            ],
            [
                'category_id'          => 4,
                'category_name'        => 'Cooking',
                'category_description' => 'Cooking',
                'position'             => 4,
                'added_by'             => 19,
                'created_at'           => $now,
                'updated_at'           => $now,
            ],
            [
                'category_id'          => 5,
                'category_name'        => 'Other',
                'category_description' => 'Other',
                'position'             => 5,
                'added_by'             => 19,
                'created_at'           => $now,
                'updated_at'           => $now,
            ],
        ];

        $this->db->table('item_categories')->truncate();
        $this->db->table('item_categories')->insertBatch($data);

        // Unit of Measurements
        $data = [
            [
                'uom_id'     => 1,
                'uom_short'  => 'kg',
                'uom_full'   => 'kilogram',
                'added_by'   => 19,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'uom_id'     => 2,
                'uom_short'  => 'g',
                'uom_full'   => 'gram',
                'added_by'   => 19,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'uom_id'     => 3,
                'uom_short'  => 'pkt',
                'uom_full'   => 'packet',
                'added_by'   => 19,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'uom_id'     => 4,
                'uom_short'  => 'pc',
                'uom_full'   => 'piece',
                'added_by'   => 19,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'uom_id'     => 5,
                'uom_short'  => 'tube',
                'uom_full'   => 'tube',
                'added_by'   => 19,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'uom_id'     => 6,
                'uom_short'  => 'none',
                'uom_full'   => 'none',
                'added_by'   => 19,
                'created_at' => $now,
                'updated_at' => $now
            ],
        ];

        $this->db->table('uoms')->truncate();
        $this->db->table('uoms')->insertBatch($data);

        // Items
        $data = [
            [
                'item_id'           => 1,
                'item_name'         => 'Wheat Flour',
                'item_description'  => 'Wheat Flour',
                'quantity'          => 60,
                'uom_id'            => 1,
                'category_id'       => 1,
                'note'              => 'Wheat Flour',
                'added_by'          => 'johndoe@rescuedada.org',
                'last_modified_by'  => 'johndoe@rescuedada.org',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'item_id'           => 2,
                'item_name'         => 'Green Grams',
                'item_description'  => 'Green Grams',
                'quantity'          => 87,
                'uom_id'            => 1,
                'category_id'       => 1,
                'note'              => 'Green Grams',
                'added_by'          => 'johndoe@rescuedada.org',
                'last_modified_by'  => 'johndoe@rescuedada.org',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'item_id'           => 3,
                'item_name'         => 'Rice',
                'item_description'  => 'Rice',
                'quantity'          => 211,
                'uom_id'            => 1,
                'category_id'       => 1,
                'note'              => 'Rice',
                'added_by'          => 'johndoe@rescuedada.org',
                'last_modified_by'  => 'johndoe@rescuedada.org',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'item_id'           => 4,
                'item_name'         => 'Maize Flour',
                'item_description'  => 'Maize Flour',
                'quantity'          => 150,
                'uom_id'            => 3,
                'category_id'       => 1,
                'note'              => 'Maize Flour',
                'added_by'          => 'johndoe@rescuedada.org',
                'last_modified_by'  => 'johndoe@rescuedada.org',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'item_id'           => 5,
                'item_name'         => 'Steel Wool',
                'item_description'  => 'Steel Wool',
                'quantity'          => 0,
                'uom_id'            => 4,
                'category_id'       => 5,
                'note'              => 'Steel Wool',
                'added_by'          => 'johndoe@rescuedada.org',
                'last_modified_by'  => 'johndoe@rescuedada.org',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'item_id'           => 6,
                'item_name'         => 'Tooth Paste',
                'item_description'  => 'Tooth Paste',
                'quantity'          => 50,
                'uom_id'            => 5,
                'category_id'       => 3,
                'note'              => 'Tooth Paste',
                'added_by'          => 'DanielJCopeland@rescuedada.org',
                'last_modified_by'  => 'DanielJCopeland@rescuedada.org',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'item_id'           => 7,
                'item_name'         => 'Beans',
                'item_description'  => 'Beans',
                'quantity'          => 91,
                'uom_id'            => 1,
                'category_id'       => 1,
                'note'              => 'Beans',
                'added_by'          => 'DanielJCopeland@rescuedada.org',
                'last_modified_by'  => 'johndoe@rescuedada.org',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'item_id'           => 8,
                'item_name'         => 'Powder Soap',
                'item_description'  => 'Powder Soap',
                'quantity'          => 2,
                'uom_id'            => 1,
                'category_id'       => 5,
                'note'              => 'Powder Soap',
                'added_by'          => 'DanielJCopeland@rescuedada.org',
                'last_modified_by'  => 'DanielJCopeland@rescuedada.org',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'item_id'           => 9,
                'item_name'         => 'Bar Soaps',
                'item_description'  => 'Bar Soaps',
                'quantity'          => 25,
                'uom_id'            => 6,
                'category_id'       => 5,
                'note'              => 'Bar Soaps',
                'added_by'          => 'DanielJCopeland@rescuedada.org',
                'last_modified_by'  => 'DanielJCopeland@rescuedada.org',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'item_id'           => 10,
                'item_name'         => 'Cooking Oil',
                'item_description'  => 'Cooking Oil',
                'quantity'          => 30,
                'uom_id'            => 1,
                'category_id'       => 4,
                'note'              => 'Cooking Oil',
                'added_by'          => 'johndoe@rescuedada.org',
                'last_modified_by'  => 'johndoe@rescuedada.org',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
        ];

        $this->db->table('items')->truncate();
        $this->db->table('items')->insertBatch($data);

        // Item History
        $data = [
            [
                'item_history_id' => 1,
                'item_id'         => 1,
                'check_in'        => 12,
                'check_out'       => 0,
                'checked_by'      => 'johndoe@rescuedada.org',
                'created_at'      => Time::parse('45 days ago', 'Africa/Nairobi'),
                'updated_at'      => Time::parse('45 days ago', 'Africa/Nairobi'),
            ],
            [
                'item_history_id' => 2,
                'item_id'         => 9,
                'check_in'        => 0,
                'check_out'       => 3,
                'checked_by'      => 'DanielJCopeland@rescuedada.org',
                'created_at'      => Time::parse('44 days ago', 'Africa/Nairobi'),
                'updated_at'      => Time::parse('44 days ago', 'Africa/Nairobi'),
            ],
            [
                'item_history_id' => 3,
                'item_id'         => 3,
                'check_in'        => 0,
                'check_out'       => 8,
                'checked_by'      => 'johndoe@rescuedada.org',
                'created_at'      => Time::parse('43 days ago', 'Africa/Nairobi'),
                'updated_at'      => Time::parse('43 days ago', 'Africa/Nairobi'),
            ],
            [
                'item_history_id' => 4,
                'item_id'         => 1,
                'check_in'        => 0,
                'check_out'       => 12,
                'checked_by'      => 'johndoe@rescuedada.org',
                'created_at'      => Time::parse('40 days ago', 'Africa/Nairobi'),
                'updated_at'      => Time::parse('40 days ago', 'Africa/Nairobi'),
            ],
            [
                'item_history_id' => 5,
                'item_id'         => 10,
                'check_in'        => 0,
                'check_out'       => 15,
                'checked_by'      => 'DanielJCopeland@rescuedada.org',
                'created_at'      => Time::parse('38 days ago', 'Africa/Nairobi'),
                'updated_at'      => Time::parse('38 days ago', 'Africa/Nairobi'),
            ],
            [
                'item_history_id' => 6,
                'item_id'         => 7,
                'check_in'        => 0,
                'check_out'       => 21,
                'checked_by'      => 'DanielJCopeland@rescuedada.org',
                'created_at'      => Time::parse('36 days ago', 'Africa/Nairobi'),
                'updated_at'      => Time::parse('36 days ago', 'Africa/Nairobi'),
            ],
            [
                'item_history_id' => 7,
                'item_id'         => 2,
                'check_in'        => 17,
                'check_out'       => 0,
                'checked_by'      => 'johndoe@rescuedada.org',
                'created_at'      => Time::parse('31 days ago', 'Africa/Nairobi'),
                'updated_at'      => Time::parse('31 days ago', 'Africa/Nairobi'),
            ],
            [
                'item_history_id' => 8,
                'item_id'         => 5,
                'check_in'        => 0,
                'check_out'       => 33,
                'checked_by'      => 'DanielJCopeland@rescuedada.org',
                'created_at'      => Time::parse('27 days ago', 'Africa/Nairobi'),
                'updated_at'      => Time::parse('27 days ago', 'Africa/Nairobi'),
            ],
            [
                'item_history_id' => 9,
                'item_id'         => 5,
                'check_in'        => 43,
                'check_out'       => 0,
                'checked_by'      => 'DanielJCopeland@rescuedada.org',
                'created_at'      => Time::parse('25 days ago', 'Africa/Nairobi'),
                'updated_at'      => Time::parse('25 days ago', 'Africa/Nairobi'),
            ],
            [
                'item_history_id' => 10,
                'item_id'         => 6,
                'check_in'        => 0,
                'check_out'       => 10,
                'checked_by'      => 'johndoe@rescuedada.org',
                'created_at'      => Time::parse('22 days ago', 'Africa/Nairobi'),
                'updated_at'      => Time::parse('22 days ago', 'Africa/Nairobi'),
            ],
            [
                'item_history_id' => 11,
                'item_id'         => 4,
                'check_in'        => 0,
                'check_out'       => 3,
                'checked_by'      => 'DanielJCopeland@rescuedada.org',
                'created_at'      => Time::parse('20 days ago', 'Africa/Nairobi'),
                'updated_at'      => Time::parse('20 days ago', 'Africa/Nairobi'),
            ],
            [
                'item_history_id' => 12,
                'item_id'         => 2,
                'check_in'        => 0,
                'check_out'       => 10,
                'checked_by'      => 'DanielJCopeland@rescuedada.org',
                'created_at'      => Time::parse('17 days ago', 'Africa/Nairobi'),
                'updated_at'      => Time::parse('17 days ago', 'Africa/Nairobi'),
            ],
            [
                'item_history_id' => 13,
                'item_id'         => 4,
                'check_in'        => 0,
                'check_out'       => 27,
                'checked_by'      => 'DanielJCopeland@rescuedada.org',
                'created_at'      => Time::parse('15 days ago', 'Africa/Nairobi'),
                'updated_at'      => Time::parse('15 days ago', 'Africa/Nairobi'),
            ],
            [
                'item_history_id' => 14,
                'item_id'         => 9,
                'check_in'        => 0,
                'check_out'       => 6,
                'checked_by'      => 'johndoe@rescuedada.org',
                'created_at'      => Time::parse('14 days ago', 'Africa/Nairobi'),
                'updated_at'      => Time::parse('14 days ago', 'Africa/Nairobi'),
            ],
            [
                'item_history_id' => 15,
                'item_id'         => 7,
                'check_in'        => 5,
                'check_out'       => 0,
                'checked_by'      => 'DanielJCopeland@rescuedada.org',
                'created_at'      => Time::parse('10 days ago', 'Africa/Nairobi'),
                'updated_at'      => Time::parse('10 days ago', 'Africa/Nairobi'),
            ],
            [
                'item_history_id' => 16,
                'item_id'         => 10,
                'check_in'        => 0,
                'check_out'       => 2,
                'checked_by'      => 'DanielJCopeland@rescuedada.org',
                'created_at'      => Time::parse('8 days ago', 'Africa/Nairobi'),
                'updated_at'      => Time::parse('8 days ago', 'Africa/Nairobi'),
            ],
            [
                'item_history_id' => 17,
                'item_id'         => 3,
                'check_in'        => 0,
                'check_out'       => 11,
                'checked_by'      => 'johndoe@rescuedada.org',
                'created_at'      => Time::parse('7 days ago', 'Africa/Nairobi'),
                'updated_at'      => Time::parse('7 days ago', 'Africa/Nairobi'),
            ],
            [
                'item_history_id' => 18,
                'item_id'         => 6,
                'check_in'        => 0,
                'check_out'       => 5,
                'checked_by'      => 'DanielJCopeland@rescuedada.org',
                'created_at'      => Time::parse('5 days ago', 'Africa/Nairobi'),
                'updated_at'      => Time::parse('5 days ago', 'Africa/Nairobi'),
            ],
            [
                'item_history_id' => 19,
                'item_id'         => 9,
                'check_in'        => 0,
                'check_out'       => 2,
                'checked_by'      => 'DanielJCopeland@rescuedada.org',
                'created_at'      => Time::parse('3 days ago', 'Africa/Nairobi'),
                'updated_at'      => Time::parse('3 days ago', 'Africa/Nairobi'),
            ],
            [
                'item_history_id' => 20,
                'item_id'         => 7,
                'check_in'        => 0,
                'check_out'       => 1,
                'checked_by'      => 'DanielJCopeland@rescuedada.org',
                'created_at'      => Time::parse('1 days ago', 'Africa/Nairobi'),
                'updated_at'      => Time::parse('1 days ago', 'Africa/Nairobi'),
            ],
        ];

        $this->db->table('items_history')->truncate();
        $this->db->table('items_history')->insertBatch($data);

    }
}
