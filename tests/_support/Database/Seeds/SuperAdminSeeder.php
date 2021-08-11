<?php

namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
	public function run()
	{
		$data = [
		    'first_name' => 'Ian',
            'last_name' => 'Kipchirchir',
            'email' => 'potterke4@gmail.com',
            'password' => password_hash('1234', PASSWORD_DEFAULT),
        ];

		$this->db->table('db_tbl_superadmins')->insert($data);
	}
}
